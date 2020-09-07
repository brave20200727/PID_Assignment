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
    <title>消費者訂單</title>
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
        <div style="margin-top: 20px;">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>請選擇使用者</td>
                        <td>
                            <select class="form-control" id="userSelector">
                                <option selected>請選擇...</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="accordion" id="orderAccordion"></div>
        <div id="message"></div>
    </div>
    <script>
        $(document).ready(function() {
            $("#deleteButton").on("click", function() {
                console.log($(this).prop("value"));
            });
            let data2Server =  {
              getUserId: 1
            }
            $.ajax({
              type: "POST",
              url: "api.php",
              data: data2Server,
              dataType: "json"
            }).then(function(dataFromServer) {
              console.log(dataFromServer);
              for(let i = 1; i < dataFromServer["users"].length; i++) {
                $("#userSelector").append($("<option></option>").append(dataFromServer["users"][i]["userName"]).prop("value", dataFromServer["users"][i]["userId"]));
              }
            }).catch(function(e) {
              console.log(e);
            });
            $("#userSelector").on("change", function() {
              let data2Server = {
                  getUserOrderByAdmin: 1,
                  userId: $(this).prop("value")
              }
              $.ajax({
                  type: "POST",
                  url: "api.php",
                  data: data2Server,
                  dataType: "json"
              }).then(function(dataFromServer) {
                  console.log(dataFromServer);
                  $("#orderAccordion").empty();
                  $("#message").empty();
                  if(dataFromServer["errorCode"] == 666) {
                    for(let i = 0; i < dataFromServer["orders"].length; i++) {
                      let oneOrderHead = '<thead><tr><th scope="col">商品名稱</th><th scope="col">單價</th><th scope="col">購買數量</th><th scope="col">小計</th></tr></thead>'
                      let oneOrderTotalNum = 0;
                      let oneOrder = $("<tbody></tbody>");
                      for(let j = 0; j < dataFromServer["orders"][i]["orderDetails"].length; j++) {
                        console.log(dataFromServer["orders"][i]["orderDetails"][j]);
                        let productName = $("<td></td>").append(dataFromServer["orders"][i]["orderDetails"][j]["productName"]);
                        let price = $("<td></td>").append(dataFromServer["orders"][i]["orderDetails"][j]["price"]);
                        let qty = $("<td></td>").append(dataFromServer["orders"][i]["orderDetails"][j]["qty"]);
                        let smallTotal = $("<td></td>").append(parseInt(dataFromServer["orders"][i]["orderDetails"][j]["price"]) * parseInt(dataFromServer["orders"][i]["orderDetails"][j]["qty"]));
                        oneOrderTotalNum += parseInt(dataFromServer["orders"][i]["orderDetails"][j]["price"]) * parseInt(dataFromServer["orders"][i]["orderDetails"][j]["qty"]);
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
                      let OrderButton = $(`<button class='btn btn-link text-left' type='button' data-target='#collapse${i}' data-toggle='collapse' aria-expanded='true' aria-controls='collapse${i}'></button>`).append("訂單編號：").append(dataFromServer["orders"][i]["orderId"]);
                      let shippingButton;
                      if(dataFromServer["orders"][i]["shippingStatus"] ==  "1") {
                        shippingButton = '<button class="btn btn-primary float-right" disabled>未出貨</button>';
                      } else if(dataFromServer["orders"][i]["shippingStatus"] ==  "2") {
                        shippingButton = '<button class="btn btn-success float-right" disabled>已出貨</button>';
                      } else {
                        shippingButton = '<button class="btn btn-danger float-right" disabled>已取消</button>';
                      }
                      // if(dataFromServer[i]["shippingStatus"] ==  "1") {
                      //   cancelButton = $("<button></button>").addClass("btn btn-outline-danger float-right").prop("value", "").append("取消訂單");
                      // } else {
                      //   cancelButton = $("<button></button>").addClass("btn btn-outline-danger float-right").prop("value", "").prop("disable", true).append("取消訂單");
                      // }
                      let headingH2 = $("<h2 class='mb-0'></h2>").append(OrderButton).append(shippingButton);
                      let oneOrderHeading = $(`<div class='card-header' id='heading${i}'></div>`).append(headingH2);
                      let oneCard = $("<div class='card'></div>").append(oneOrderHeading).append(oneCollapse);
                      $("#orderAccordion").append(oneCard);
                    }
                  }
                  else {
                    $("#message").html("此使用者沒有訂單！");
                  }
              }).catch(function(e) {
                  console.log(e);
              });              
            })
        })
    </script>
</body>
</html>