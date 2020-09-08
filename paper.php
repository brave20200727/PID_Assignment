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
    <title>報表頁面</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="node_modules/chart.js/dist/Chart.min.js"></script>
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
        <div id="paper">
            <h3>報表查詢</h3>
            <form>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="searchItem">選擇查詢項目</label>
                        <select class="form-control" id="searchItem">
                            <option value="0">---</option>
                            <option value="1">區間各商品銷售量</option>
                            <option value="2">區間各月份銷售額</option>
                        </select>                    
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-5">
                        <label for="startTime">開始時間</label>
                        <input class="form-control" type="date" id="startTime">
                    </div>
                    <div class="form-group col-5">
                        <label for="endTime">結束時間</label>
                        <input class="form-control" type="date" id="endTime">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-1">
                        <button type="button" class="btn btn-outline-primary" id="okButton">查詢</button>
                    </div>
                </div>            
            </form>
            <canvas id="chart" width="800" height="600"></canvas>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#okButton").on("click", function() {
                let startTime = new Date($("#startTime").prop("value"));
                let endTime = new Date($("#endTime").prop("value"));
                console.log(startTime);
                console.log(endTime);
                if($("#searchItem").prop("value") == "0"){
                    alert("沒有選擇要查詢的項目喔！");
                }
                else if(startTime - endTime > 0) {
                    alert("開始時間必須早於結束時間喔！");
                }
                else if($("#searchItem").prop("value") == "1") {
                    let data2Server = {
                        getOrderDetail: 1,
                        searchItem: $("#searchItem").prop("value"),
                        startTime: $("#startTime").prop("value"),
                        endTime: $("#endTime").prop("value")
                    }
                    $.ajax({
                        type: "POST",
                        url: "api.php",
                        data: data2Server,
                        dataType: "json"
                    }).then(function(dataFromServer) {
                        console.log(dataFromServer);
                        let productSales = [0, 0, 0, 0, 0, 0, 0];                
                        for(let data of dataFromServer["allOrderDetails"]) {
                            productSales[parseInt(data["productType"])-1] += parseInt(data["qty"]);
                        }
                        console.log(productSales);
                        $("#chart").remove();
                        $("#paper").append('<canvas id="chart" width="800" height="600"></canvas>');
                        let ctx = $("#chart");
                        let chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ["電子書", "繁體中文書", "簡體中文書", "外文書", "雜誌", "漫畫", "文具用品"],
                                datasets: [{
                                    label: '商品銷售數量',
                                    data: productSales,
                                    backgroundColor: 'rgba(245, 150, 170, 0.5)'
                                }]
                            }
                        });                               
                    }).catch(function(e) {
                        console.log(e);
                    });
                }
                else if($("#searchItem").prop("value") == "2"){
                    let data2Server = {
                        getOrderDetail: 1,
                        searchItem: $("#searchItem").prop("value"),
                        startTime: $("#startTime").prop("value"),
                        endTime: $("#endTime").prop("value")
                    }
                    $.ajax({
                        type: "POST",
                        url: "api.php",
                        data: data2Server,
                        dataType: "json"
                    }).then(function(dataFromServer) {
                        console.log(dataFromServer);
                        let month = Array(), money = Array();
                        for(let i = 0; i <= (endTime.getMonth() - startTime.getMonth()); i++) {
                            month.push(startTime.getMonth()+1+i);
                            money.push(0);
                        }
                        let productSales = Array();
                        productSales.push(month);
                        productSales.push(money);
                        for(let data of dataFromServer["allOrderDetails"]) {
                            let tempDate = new Date(data["orderTime"])
                            let month = tempDate.getMonth() + 1;
                            let index = 0;
                            for(let i = 0; i < productSales[0].length; i++) {
                                if(month == productSales[0][i]) {
                                    index = i;
                                    break;
                                }
                            }
                            productSales[1][index] += parseInt(data["price"]) * parseInt(data["qty"]);
                        }
                        console.log(productSales);
                        $("#chart").remove();
                        $("#paper").append('<canvas id="chart" width="800" height="600"></canvas>');                        
                        let ctx = $("#chart");
                        let chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: productSales[0],
                                datasets: [{
                                    label: '月份銷售額',
                                    data: productSales[1],
                                    backgroundColor: 'rgba(245, 150, 170, 0.5)'
                                }]
                            }
                        });                               
                    }).catch(function(e) {
                        console.log(e);
                    });  
                }
            });
        });
    </script>
</body>
</html>