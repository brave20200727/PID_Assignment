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
            <div class="card" id="cartList"></div>
            <div style="margin-top: 20px; background-color: lightgray; border-radius: 5px;" id="summary"></div>                            
        </div>
        <div style="margin-top: 20px;" class="float-right">
        <button class="btn btn-outline-primary" type="button" id="buyButton" onclick="buyCartProduct()">確定購買</button>
        <button class="btn btn-outline-primary" type="button" id="clearCartButton" onclick="deleteAllCart()">清空購物車</button>
        </div>
    </div>
    <script>
        function countAlert(parameter) {
            if(parameter.prop("value") == 0){
                alert("已幫您從購物車移除！");
                let data2Server = {
                    deleteCartProduct: 1,
                    productId: parameter.data("productid")
                }
                console.log(data2Server);
                $.ajax({
                    type: "POST",
                    url: "api.php",
                    data: data2Server
                }).then(function(dataFromServer) {
                    console.log(dataFromServer);
                    $(location).prop("href", "cart.php");
                }).catch(function(e) {
                    console.log(e)
                })
            }
            else if(parameter.prop("value") < 0) {
                alert("數量不可為負！");
            }
        }
        function deleteCartProduct(parameter) {
            alert("已幫您從購物車移除！");
            let data2Server = {
                deleteCartProduct: 1,
                productId: parameter.prop("value")
            }
            console.log(data2Server);
            $.ajax({
                type: "POST",
                url: "api.php",
                data: data2Server
            }).then(function(dataFromServer) {
                console.log(dataFromServer);
                $(location).prop("href", "cart.php");
            }).catch(function(e) {
                console.log(e)
            })
        }
        function buyCartProduct() {
            let data2Server = {
                buyCartProduct: 1,
            }
            $.ajax({
                type: "POST",
                url: "api.php",
                data: data2Server,
                dataType: 'json'
            }).then(function(dataFromServer) {
                console.log(dataFromServer);
                if(dataFromServer["errorCode"] == 666) {
                    alert("購買完成，轉跳至首頁！");
                    $(location).prop("href", "index.php");                    
                }
            }).catch(function(e) {
                console.log(e);
            })
        }
        function deleteAllCart() {
            let data2Server = {
                deleteAllCart: 1,
            }
            $.ajax({
                type: "POST",
                url: "api.php",
                data: data2Server,
                dataType: 'json'
            }).then(function(dataFromServer) {
                console.log(dataFromServer);
                if(dataFromServer["errorCode"] == 666) {
                    alert("購物車已清空！");
                    $(location).prop("href", "cart.php");                    
                }
            }).catch(function(e) {
                console.log(e);
            })
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
                let productCount = 0;
                let number = 0;
                let totalMoney = 0;                
                for(let index in dataFromServer) {
                    productCount += 1;
                    number += parseInt(dataFromServer[index]["qty"]);
                    totalMoney += parseInt(dataFromServer[index]["price"]) * parseInt(dataFromServer[index]["qty"]);
                    let productImg = $("<img>").addClass("card-img");
                    let imgDiv = $("<div></div>").addClass("col-4").append(productImg);
                    let productText = $("<div></div>").addClass("card-body");
                    let textDiv = $("<div></div>").addClass("col-6");
                    let buyText = $("<div></div>").addClass("card-body");
                    let buyDiv = $("<div></div>").addClass("col-2");
                    productImg.prop("src", dataFromServer[index]["productPic"])
                    productText.append($("<h6></h6>").append("商品名稱：")).append($("<p></p>").append(dataFromServer[index]["productName"]));
                    productText.append($("<h6></h6>").append("商品介紹：")).append($("<p></p>").append(dataFromServer[index]["description"]));
                    productText.append($("<h6></h6>").append("價格：")).append($("<p></p>").append(dataFromServer[index]["price"]));
                    textDiv.append(productText);
                    buyText.append("<h5>購買數量</h5>").append
                    buyText.append($("<p></p>").append(`<input class="form-control" type="number" min="0" onchange="countAlert($(this));" value="${dataFromServer[index]["qty"]}" data-productid=${dataFromServer[index]["productId"]}>`))
                    .append(`<button type="button" class="btn btn-outline-primary" value="${dataFromServer[index]["productId"]}" onclick="deleteCartProduct($(this));">刪除</button>`);
                    buyDiv.append(buyText);
                    let oneRowProduct = $("<div></div>").addClass("row");
                    oneRowProduct.append(imgDiv).append(textDiv).append(buyDiv);
                    $("#cartList").append(oneRowProduct);
                }

                $("#summary").append(`共 ${productCount} 項商品，數量 ${number} 個，總金額NT$ ${totalMoney} 元`)
                
            }).catch(function(e) {
                console.log(e);
            });
        });
    </script>    
</body>
</html>