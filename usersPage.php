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
    <title>使用者頁面</title>
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
            <div class="card">
                <div class="card-header">
                    使用者列表
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">使用者一號<button class="btn btn-outline-success float-right" value="brave20200727" onclick="console.log($(this).prop('value'));">啟用</button><button class="btn btn-outline-danger float-right">禁用</button></li>
                    <li class="list-group-item">使用者二號<button class="btn btn-outline-success float-right">啟用</button><button class="btn btn-outline-danger float-right">禁用</button></li>
                    <li class="list-group-item">使用者三號<button class="btn btn-outline-success float-right">啟用</button><button class="btn btn-outline-danger float-right">禁用</button></li>
                </ul> 
            </div>
        </div>        
    </div>
</body>
</html>