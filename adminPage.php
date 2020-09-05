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
    <title>管理中心</title>
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
        <div>
            <div style="margin-top: 20px;">
                <h4><span>管理者&nbsp;您好～</span></h2>            
            </div>
            <div style="margin-top: 20px;">
                <h5>交易紀錄</h5>
                <div class="card-columns">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title"><a href="adminOrder.php">訂單查詢</a></h5>
                        <p class="card-text" style="color: gray;">查看消費者訂單資訊</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#">報表</a></h5>
                            <p class="card-text" style="color: gray;">觀看各商品銷售狀況</p>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 20px;">
                <h5>會員管理</h5>
                <div class="card-columns">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="usersPage.php">會員列表</a></h5>
                            <p class="card-text" style="color: gray;">可顯示、停用會員 (停用該會員則該會員不可登入 或操作)</p>
                        </div>
                    </div>            
                </div>
            </div>
            <div style="margin-top: 20px;">
                <h5>商品管理</h5>
                <div class="card-columns">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="productPage.php">商品列表</a></h5>
                            <p class="card-text" style="color: gray;">新增刪除修改商品</p>
                        </div>
                    </div>            
                </div>
            </div>
        </div>
    </div>
</body>
</html>