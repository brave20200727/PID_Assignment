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
    <title>購物車</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="http://localhost:8888/PID_Assignment/">購物網站</a>
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
            <h3>購物車列表</h5>
            <div class="card" id="cartList">
                <div class="row">
                    <div class="col-4">
                        <img src="img/filip-baotic-FF8Kqb86V38-unsplash.jpg" class="card-img">
                    </div>
                    <div class="col-6">
                        <div class="card-body">
                            <h6>商品名稱：</h6>
                            <p>Apple Watch圖片</p>
                            <h6>商品介紹</h6>
                            <p>這就只是一張Apple watch的圖片而已</p>
                            <h6>價格：</h5>
                            <p>NT$81000</p>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card-body">
                            <h5>購買數量</h5>
                            <p><input class="form-control" type="number" min="0" onchange="countAlert($(this));" value="1"></p>
                            <button type="button" class="btn btn-outline-primary" value="1" onclick="showModal($(this));">刪除</button>    
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 20px; background-color: lightgray; border-radius: 5px;" id="summary">
                共 1 項商品，數量 1 個，總金額NT$ 81000 元
            </div>                            
        </div>
        <div id="test"></div>
    </div>
    <script>
        function countAlert(parameter) {
            if(parameter.prop("value") == 0){
                alert("已將商品中購物車中移除！");
                $("#cartList").empty();
            }
            else if(parameter.prop("value") < 0) {
                alert("數量不可為負！");
            }
        }
        function showModal(parameter) {
            alert(parameter.prop("value"));
        }

        $(document).ready(function() {
            let data2Server = {
                getCart: 1
            }
            $.ajax({
                type: "POST",
                url: "api.php",
                data: data2Server,
                dataType: "json"
            }).then(function(dataFromServer) {
                console.log(dataFromServer);
                let productImg = $("<img>").addClass("card-img");
                let imgDiv = $("<div></div>").addClass("col-4").append(productImg);
                let productText = $("<div></div>").addClass("card-body");
                productText.append($("<h6></h6>").append("商品名稱：")).append($("<h6></h6>").append(dataFromServer[0]["productName"]));
                productText.append($("<h6></h6>").append("商品介紹：")).append($("<h6></h6>").append(dataFromServer[0]["description"]));
                productText.append($("<h6></h6>").append("價格：")).append($("<h6></h6>").append(dataFromServer[0]["price"]));
                let textDiv = $("<div></div>").addClass("col-6").append(productText);
                $("#test").append(textDiv);
            }).catch(function(e) {
                console.log(e);
            });
        });
    </script>    
</body>
</html>