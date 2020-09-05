<?php
  session_start();
  if(isset($_SESSION["userName"])) {
    $isLogin = true;
    $userType = $_SESSION["userType"];
  } else {
    $isLogin = false;
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
                        <input class="form-control" type="text" id="productName" name="productName">
                    </div>
                    <div class="form-group">
                        <label for="">價格</label>
                        <input class="form-control" type="text" id="price" name="price">
                    </div>
                    <div class="form-group">
                        <label for="">庫存</label>
                        <input class="form-control" type="text" id="inStock" id="inStock">
                    </div>
                    <div class="form-group">
                        <label for="">商品圖片</label>
                        <input class="form-control-file" type="file" id="productPicture" name="productPicture">
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
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">商品名稱</th>
                        <th scope="col">價格</th>
                        <th scope="col">庫存</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>商品一號</td>
                        <td>
                            81000
                        </td>
                        <td>
                            20
                            <span class="float-right" style="margin-right: 5px;"><button class="btn btn-outline-success" value="1" onclick='$("#editModal").modal({backdrop: "static"});'>編輯</button></span>
                            <span class="float-right"><button class="btn btn-outline-danger" value="1" onclick="console.log($(this).prop('value'));">刪除</button></span>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>商品二號</td>
                        <td>
                            5487
                        </td>
                        <td>
                            10
                            <span class="float-right" style="margin-right: 5px;"><button class="btn btn-outline-success" value="2" onclick='$("#editModal").modal({backdrop: "static"});'>編輯</button></span>
                            <span class="float-right"><button class="btn btn-outline-danger" value="2" onclick="console.log($(this).prop('value'));">刪除</button></span>                            
                        </td>
                      </tr>                      
                    </tbody>
                  </table>                
            </div>
        </div>        
    </div>
    <script>
        $(document).ready(function() {
            $("#newItem").on("click", function() {
                $("#editModal").modal({backdrop: "static"});
            })

            $("#okButton").on("click", function() {
                // var reader = new FileReader;
                // reader.onload = function(e) {
                //     $('#demo').prop('src', e.target.result);
                //     console.log(e);
                // };
                // reader.readAsDataURL(data2Server.productPicture);
                var data2Server = new FormData();
                data2Server.append('productName', $("#productName").prop("value"));
                data2Server.append('price', $("#price").prop("value"));
                data2Server.append('inStock', $("#inStock").prop("value"));
                data2Server.append('productPicture', $('#productPicture')[0].files[0]);
                $.ajax({
                    type:"POST",
                    url:"api.php",
                    data: data2Server,  
                    contentType: false,
                    processData: false
                }).then(function(dataFromServer) {
                    console.log(dataFromServer);
                }).catch(function(e) {

                })
            })
        })
    </script>    
</body>
</html>