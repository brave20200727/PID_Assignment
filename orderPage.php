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
            <div class="accordion" id="accordionExample">
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        訂單編號：202009021640
                      </button>
                      <button class="btn btn-success float-right" disabled>已出貨</button>
                    </h2>
                  </div>
                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
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
                </div>
            </div>            
        </div>
    </div>
</body>
</html>