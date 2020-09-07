<?php
  session_start();
  if(isset($_SESSION["userName"])) {
    $isLogin = true;
    $userType = $_SESSION["userType"];
  } else {
    $isLogin = false;
    header("Location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>產品頁面</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
  <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Modal title</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="">商品名稱</label>
                        <input class="form-control" type="text" id="productName">
                    </div>
                    <div class="form-group">
                        <label for="">商品介紹</label>
                        <!-- <input class="form-control" type="text" id="productName" name="productName"> -->
                        <textarea class="form-control" id="description" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">商品類別</label>
                        <!-- <input class="form-control" type="text" id="productType"> -->
                        <select class="form-control" id="productType">
                          <option value="1">電子書</option>
                          <option value="2">繁體中文書</option>
                          <option value="3">簡體中文書</option>
                          <option value="4">外文書</option>
                          <option value="5">雜誌</option>
                          <option value="6">漫畫</option>
                          <option value="7">文具用品</option>
                        </select>
                    </div>                   
                    <div class="form-group">
                        <label for="">價格</label>
                        <input class="form-control" type="number" id="price" name="price" min="0">
                    </div>
                    <div class="form-group">
                        <label for="">庫存</label>
                        <input class="form-control" type="number" id="inStock" id="inStock" min="0">
                    </div>
                    <div class="form-group">
                        <label for="">商品圖片</label>
                        <input class="form-control-file" type="file" id="productPicture" name="productPicture">
                        <img src="" alt="尚未上傳圖片喔" id="productImg" width="400px">
                    </div>                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="okButton" value="1">確定送出</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            </div>
        </div>
        </div>
    </div>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="index.php">購物網站</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <?php if($isLogin) {?>
                  <li class="nav-item">
                    <a class="nav-link" href="login.php?logout=1">登出</a>
                  </li>
                  <?php if($userType == 1) {?>
                    <li class="nav-item">
                      <a class="nav-link" href="memberPage.php">會員中心</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">購物車</a>
                    </li>                         
                  <?php } else {?>
                    <li class="nav-item">
                      <a class="nav-link" href="adminPage.php">管理中心</a>
                    </li>
                  <?php }?>
                <?php } else {?>
                  <li class="nav-item">
                    <a class="nav-link" href="login.php">登入</a>
                  </li>
                <?php } ?>
            </ul>
            </div>
        </nav>
        <div style="margin-top: 20px;">
            <div class="card">
                <div class="card-header">
                    商品列表
                    <button class="btn btn-outline-primary float-right" id="newItem">新增商品</button>
                </div>
                <table class="table" id="productList">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">商品名稱</th>
                      <th scope="col">價格</th>
                      <th scope="col">庫存</th>
                      <th scope="col">操作</th>
                    </tr>
                  </thead>
                  <tbody id="productTableBody"></tbody>
                </table>
                <div id="message"></div>                  
            </div>
        </div>
              
    </div>
    <script>
        $(document).ready(function() {
          let currentProductIndex = 0;
          let data2Server = {
            getProductData: 1
          }
          $.ajax({
            type: "POST",
            url: "api.php",
            data: data2Server,
            dataType: "json"
          }).then(function(dataFromServer) {
            if(dataFromServer["errorCode"] == 1) {
              $("#productList").hide();
              $("#message").append("目前還沒有任何商品喔！");
            }
            else {
              for(let oneData of dataFromServer["allProducts"]) {
                let productId = $("<td></td>").append(oneData["productId"]);
                let productName = $("<td></td>").append(oneData["productName"]);
                let price = $("<td></td>").append(oneData["price"]);
                let inStock = $("<td></td>").append(oneData["inStock"]);
                let editButton = $("<button></button>").addClass("btn btn-outline-success").prop("value", oneData["productId"]).append("編輯");
                editButton.on("click", function() {
                  currentProductIndex = oneData["productId"];
                  $("#editModal").modal({backdrop: "static"});
                  let data2Server2 = {
                    getOneProduct: 1,
                    productId: $(this).prop("value")
                  }
                  $.ajax({
                    type: "POST",
                    url: "api.php",
                    data: data2Server2,
                    dataType: "json"
                  }).then(function(dataFromServer2) {
                    $("#productName").prop("value", dataFromServer2["productName"]);
                    $("#description").prop("value", dataFromServer2["description"]);
                    $("#productType").val(dataFromServer2["productType"]).prop("selected", true);
                    $("#productImg").prop("src", dataFromServer2["productPic"])
                    $("#price").prop("value", dataFromServer2["price"]);
                    $("#inStock").prop("value", dataFromServer2["inStock"]);
                  }).catch(function(e2) {
                    console.log(e2);
                  });
                });
                let deleteButton = $("<button></button>").addClass("btn btn-outline-danger").prop("value", oneData["productId"]).append("刪除");
                deleteButton.on("click", function() {
                  let data2Server2 = {
                    deleteProduct: 1,
                    productId: $(this).prop("value")
                  } 
                  $.ajax({
                      type: "POST",
                      url: "api.php",
                      data: data2Server2,
                      dataType: "json"
                  }).then(function(dataFromServer2) {
                    if(dataFromServer2["errorCode"] == 666) {
                      alert("刪除成功喔！");
                      $(location).prop("href", "productPage.php");
                    }
                  }).catch(function(e2) {
                    console.log(e2);
                  });
                });
                let operate = $("<span></span>").append(editButton).append(deleteButton);
                let oneProduct = $("<tr></tr>").append(productId).append(productName).append(price).append(inStock).append($("<td></td>").append(operate));
                $("#productTableBody").append(oneProduct);
              }     
            }
          }).catch(function(e) {
            console.log(e);
          });

          $("#newItem").on("click", function() {
              $("#editModal").modal({backdrop: "static"});
              currentProductIndex = 0;
              $("#productName").prop("value", "");
              $("#description").prop("value", "");
              $("#productType").val("1").prop("selected", true);
              $("#productImg").prop("src", "")
              $("#price").prop("value", "");
              $("#inStock").prop("value", "")
              $("#productType").val('1').prop("selected", true);
          })

          $("#okButton").on("click", function() {
            let price = parseInt($("#price").prop("value"));
            let inStock = parseInt($("#inStock").prop("value"));
            if(price < 0 || inStock < 0) {
              alert("價錢與庫存不可為負數");
            }
            else {
              if(currentProductIndex < 1) {
                var data2Server = new FormData();
                data2Server.append('addProduct', 1);
                data2Server.append('productName', $("#productName").prop("value"));
                data2Server.append("description",  $("#description").prop("value"));
                data2Server.append("productType", $("#productType").prop("value"));
                data2Server.append('price', $("#price").prop("value"));
                data2Server.append('inStock', $("#inStock").prop("value"));
                data2Server.append('productPicture', $('#productPicture')[0].files[0]);
                $.ajax({
                  type:"POST",
                  url:"api.php",
                  data: data2Server, 
                  dataType: "json", 
                  contentType: false,
                  processData: false
                }).then(function(dataFromServer) {
                  if(dataFromServer["errorCode"] == 666) {
                    $("#editModal").modal("hide");
                    alert("新增成功！");
                    $(location).prop("href", "productPage.php");
                  }
                }).catch(function(e) {
                  console.log(e);
                })
              }
              else {
                var data2Server = new FormData();
                data2Server.append('updateProduct', 1);
                data2Server.append('productId', currentProductIndex);
                data2Server.append('productName', $("#productName").prop("value"));
                data2Server.append("description",  $("#description").prop("value"));
                data2Server.append("productType", $("#productType").prop("value"));
                data2Server.append('price', $("#price").prop("value"));
                data2Server.append('inStock', $("#inStock").prop("value"));
                data2Server.append('productPicture', $('#productPicture')[0].files[0]);
                $.ajax({
                  type:"POST",
                  url:"api.php",
                  data: data2Server, 
                  dataType: "json", 
                  contentType: false,
                  processData: false
                }).then(function(dataFromServer) {
                  if(dataFromServer["errorCode"] == 666) {
                    $("#editModal").modal("hide");
                    alert("修改成功！");
                    $(location).prop("href", "productPage.php");
                  }
                }).catch(function(e) {
                  console.log(e);
                })
              }                
            }
          })
        })
    </script>    
</body>
</html>