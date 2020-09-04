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
    <title>訂單查詢</title>
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
            <div class="accordion" id="orderAccordion">
                <!-- <div class="card">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        訂單編號：202009021640
                      </button>
                      <button class="btn btn-success float-right" disabled>已出貨</button>
                    </h2>
                  </div>
                  
                  
                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#orderAccordion">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">商品名稱</th>
                                <th scope="col">單價</th>
                                <th scope="col">購買數量</th>
                                <th scope="col">小計</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Apple Watch圖片</td>
                                <td>81000</td>
                                <td>1</td>
                                <td>81000</td>
                            </tr>
                            <tr>
                                <td>總價</td>
                                <td></td>
                                <td></td>
                                <td>81000</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div> -->
            </div>            
        </div>
    </div>
    

    <script>
        $(document).ready(function() {
            let data2Server = {
                getUserOrder: 1
            }
            $.ajax({
                type: "POST",
                url: "api.php",
                data: data2Server,
                dataType: "json"
            }).then(function(dataFromServer) {
                console.log(dataFromServer);
                for(let i = 0; i < dataFromServer.length; i++) {
                  let oneOrderHead = '<thead><tr><th scope="col">商品名稱</th><th scope="col">單價</th><th scope="col">購買數量</th><th scope="col">小計</th></tr></thead>'
                  let oneOrderTotalNum = 0;
                  let oneOrder = $("<tbody></tbody>");
                  for(let j = 0; j < dataFromServer[i]["orderDetails"].length; j++) {
                    console.log(dataFromServer[i]["orderDetails"][j]);
                    let productName = $("<td></td>").append(dataFromServer[i]["orderDetails"][j]["productName"]);
                    let price = $("<td></td>").append(dataFromServer[i]["orderDetails"][j]["price"]);
                    let qty = $("<td></td>").append(dataFromServer[i]["orderDetails"][j]["qty"]);
                    let smallTotal = $("<td></td>").append(parseInt(dataFromServer[i]["orderDetails"][j]["price"]) * parseInt(dataFromServer[i]["orderDetails"][j]["qty"]));
                    oneOrderTotalNum += parseInt(dataFromServer[i]["orderDetails"][j]["price"]) * parseInt(dataFromServer[i]["orderDetails"][j]["qty"]);
                    let oneProduct = $("<tr></tr>").append(productName).append(price).append(qty).append(smallTotal);
                    oneOrder.append(oneProduct);
                  }
                  let oneOrderTotalNumItem = $("<td></td>").append(oneOrderTotalNum);
                  let oneOrderTotal = $("<tr></tr>").append('<td>總價</td><td></td><td></td>').append(oneOrderTotalNumItem);
                  oneOrder.append(oneOrderTotal);
                  // console.log(oneOrderTotalNum);
                  let oneTable = $("<table class='table'></table>").append(oneOrderHead).append(oneOrder);
                  let cardBody = $("<div class='card-body'></div>").append(oneTable);

                  let oneCollapse = $(`<div class='collapse' data-parent='#orderAccordion' id='collapse${i}' aria-labelledby='heading${i}'></div>`).append(cardBody);
                  let OrderButton = $(`<button class='btn btn-link text-left' type='button' data-target='#collapse${i}' data-toggle='collapse' aria-expanded='true' aria-controls='collapse${i}'></button>`).append("訂單編號：").append(dataFromServer[i]["orderId"]);
                  let shippingButton;
                  if(dataFromServer[i]["shippingStatus"] ==  "1") {
                    shippingButton = '<button class="btn btn-primary float-right" disabled>未出貨</button>';
                  } else if(dataFromServer[i]["shippingStatus"] ==  "2") {
                    shippingButton = '<button class="btn btn-success float-right" disabled>已出貨</button>';
                  } else {
                    shippingButton = '<button class="btn btn-danger float-right" disabled>已取消</button>';
                  }
                  let headingH2 = $("<h2 class='mb-0'></h2>").append(OrderButton).append(shippingButton);
                  let oneOrderHeading = $(`<div class='card-header' id='heading${i}'></div>`).append(headingH2);
                  let oneCard = $("<div class='card'></div>").append(oneOrderHeading).append(oneCollapse);
                  $("#orderAccordion").append(oneCard);
                }
                
            }).catch(function(e) {
                console.log(e);
            });
        });
    </script>
</body>
</html>