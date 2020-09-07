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
    <title>購物網站首頁</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
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
        <div class="row" style="margin-top: 10px;">
          <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link active" id="v-pills-eBooks-tab" data-toggle="pill" href="#v-pills-eBooks" role="tab" aria-controls="v-pills-eBooks" aria-selected="true">電子書</a>
              <a class="nav-link" id="v-pills-tcBooks-tab" data-toggle="pill" href="#v-pills-tcBooks" role="tab" aria-controls="v-pills-tcBooks" aria-selected="false">繁體中文書</a>
              <a class="nav-link" id="v-pills-scBooks-tab" data-toggle="pill" href="#v-pills-scBooks" role="tab" aria-controls="v-pills-scBooks" aria-selected="false">簡體中文書</a>
              <a class="nav-link" id="v-pills-foreignBooks-tab" data-toggle="pill" href="#v-pills-foreignBooks" role="tab" aria-controls="v-pills-foreignBooks" aria-selected="false">外文書</a>
              <a class="nav-link" id="v-pills-magazine-tab" data-toggle="pill" href="#v-pills-magazine" role="tab" aria-controls="v-pills-magazine" aria-selected="false">雜誌</a>
              <a class="nav-link" id="v-pills-comics-tab" data-toggle="pill" href="#v-pills-comics" role="tab" aria-controls="v-pills-comics" aria-selected="false">漫畫</a>
              <a class="nav-link" id="v-pills-stationery-tab" data-toggle="pill" href="#v-pills-stationery" role="tab" aria-controls="v-pills-stationery" aria-selected="false">文具用品</a>
            </div>
          </div>
          <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-eBooks" role="tabpanel" aria-labelledby="v-pills-eBooks-tab">
              </div>
              <div class="tab-pane fade" id="v-pills-tcBooks" role="tabpanel" aria-labelledby="v-pills-tcBooks-tab">
              </div>
              <div class="tab-pane fade" id="v-pills-scBooks" role="tabpanel" aria-labelledby="v-pills-scBooks-tab">
              </div>
              <div class="tab-pane fade" id="v-pills-foreignBooks" role="tabpanel" aria-labelledby="v-pills-foreignBooks-tab">
              </div>
              <div class="tab-pane fade" id="v-pills-magazine" role="tabpanel" aria-labelledby="v-pills-magazine-tab">
              </div>
              <div class="tab-pane fade" id="v-pills-comics" role="tabpanel" aria-labelledby="v-pills-comics-tab">
              </div>
              <div class="tab-pane fade" id="v-pills-stationery" role="tabpanel" aria-labelledby="v-pills-stationery-tab">
              </div>
            </div>
          </div>
          <div class="col-9" id="test"></div>
        </div> 
    </div>

    <script>
      $(document).ready(function() {
        $("#v-pills-eBooks").empty();
        $("#v-pills-tcBooks").empty();
        $("#v-pills-scBooks").empty();
        $("#v-pills-foreignBooks").empty();
        $("#v-pills-magazine").empty();
        $("#v-pills-comics").empty();
        $("#v-pills-stationery").empty();
        let data2Server = {
          getProductData: 1
        }
        $.ajax({
          type: "POST",
          url: "api.php",
          data: data2Server,
          dataType: "json"
        }).then(function(dataFromServer) {
          if(dataFromServer["errorCode"] == 666) {
            for(let oneData of dataFromServer["allProducts"]) {
              let oneRowProduct = $("<div></div>").addClass("row");
              let imgDiv = $("<div></div>").addClass("col-5").append($("<img>").addClass("img-thumbnail").prop("src", oneData["productPic"]));
              let productDiv = $("<div></div>").addClass("col-5")
              .append($("<h6></h6>").append("商品名稱："))
              .append($("<p></p>").append(oneData["productName"]))
              .append($("<h6></h6>").append("商品介紹："))
              .append($("<p></p>").append(oneData["description"]));
              let numberId = "product" + oneData["productId"];
              let aButton = $(`<button data-numberid=${numberId}></button>`).on("click", function() {
                let data2Server = {
                  addIntoCart: 1,
                  productId: $(this).prop("value"),
                  qty: $(`#${$(this).data("numberid")}`).prop("value")
                }
                $.ajax({
                  type: "POST",
                  url: "api.php",
                  data: data2Server,
                  dataType: "json"
                }).then(function(dataFromServer) {
                  if(dataFromServer["errorCode"] == 666) {
                    alert("加入購物車成功！");
                  }
                  else if(dataFromServer["errorCode"] == 1) {
                    alert("尚未登入喔！");
                  }
                  else {
                    alert("此商品購物車中已經有了喔！");
                  }
                }).catch(function(e) {
                  console.log(e);
                });
              });
              let buyDiv = $("<div></div>").addClass("col-2")
              .append($("<h6></h6>").append("剩餘數量"))
              .append($("<p></p>").append(oneData["inStock"]))
              .append($("<h6></h6>").append("購買數量"))
              .append($("<input>").addClass("form-control").prop("type", "number").prop("value", 1).prop("min", 1).prop("id", "product" + oneData["productId"]))
              .append(aButton.addClass("btn btn-outline-primary").text("加入購物車").prop("value", oneData["productId"]));
              oneRowProduct.append(imgDiv).append(productDiv).append(buyDiv);            
              if(oneData["productType"] == 1) {
                $("#v-pills-eBooks").append(oneRowProduct);
              } else if(oneData["productType"] == 2) {
                // v-pills-tcBooks
                $("#v-pills-tcBooks").append(oneRowProduct);
              } else if(oneData["productType"] == 3) {
                // v-pills-scBooks
                $("#v-pills-scBooks").append(oneRowProduct);
              } else if(oneData["productType"] == 4) {
                // v-pills-foreignBooks
                $("#v-pills-foreignBooks").append(oneRowProduct);
              } else if(oneData["productType"] == 5) {
                // v-pills-magazine
                $("#v-pills-magazine").append(oneRowProduct);
              } else if(oneData["productType"] == 6) {
                // v-pills-comics
                $("#v-pills-comics").append(oneRowProduct);
              } else if(oneData["productType"] == 7) {
                // v-pills-stationery
                $("#v-pills-stationery").append(oneRowProduct);
              }
            }            
          }
          else if(dataFromServer["errorCode"] == 1) {
            $("#v-pills-eBooks").html($("<p></p>").append("沒有商品喔！"));
            $("#v-pills-tcBooks").html($("<p></p>").append("沒有商品喔！"));
            $("#v-pills-scBooks").html($("<p></p>").append("沒有商品喔！"));
            $("#v-pills-foreignBooks").html($("<p></p>").append("沒有商品喔！"));
            $("#v-pills-magazine").html($("<p></p>").append("沒有商品喔！"));
            $("#v-pills-comics").html($("<p></p>").append("沒有商品喔！"));
            $("#v-pills-stationery").html($("<p></p>").append("沒有商品喔！"));
          }
        }).catch(function(e) {
          console.log(e);
        });
      });
    </script>
</body>
</html>