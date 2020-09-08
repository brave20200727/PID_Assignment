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
        <div>
            <h3>各類商品銷售量</h3>
            <canvas id="chart" width="800" height="600"></canvas>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let data2Server = {
                getOrderDetail: 1
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
                    productSales[parseInt(data["productType"])-1] += data["qty"];
                }
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


        });
    </script>
</body>
</html>