<?php
  session_start();
  if(isset($_SESSION["userName"])) {
    $isLogin = true;
    $userType = $_SESSION["userType"];
  } else {
    $isLogin = false;
  }
  if(isset($_GET["logout"])) {
    session_destroy();
    header("Location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員登入</title>
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
            <div class="col-8"></div>
            <div class="col-4">
              <form>
                <div class="row">
                    <div class="form-group col-12">
                      <label for="userName">帳號</label>
                      <input class="form-control" type="text" name="userName" id="userName">
                    </div>                        
                </div>
                <div class="row">
                    <div class="form-group col-12">
                      <label for="userPassword">密碼</label>
                      <input class="form-control" type="password" name="userPassword" id="userPassword">
                    </div>                        
                </div>
                <div class="row">
                  <div class="col-12">
                    <button class="btn btn-outline-primary" type="button" name="loginButton" id="loginButton">登入</button>
                    <button class="btn btn-outline-primary" type="button" name="signupButton" id="signupButton" onclick="$(location).prop('href', 'signup.php')">加入會員</button>                    
                  </div>
                </div>                
              </form>
            </div>
        </div>        
    </div>

    <script>
      $(document).ready(function() {
        $("#loginButton").on("click", function() {
          let data2Srever = {
            userName: $("#userName").prop("value"),
            userPassword: $("#userPassword").prop("value"),
            loginButton: 1
          }
          // console.log(data2Srever);
          if(data2Srever["userName"] == "" || data2Srever["userPassword"] == "") {
            alert("使用者名稱或是密碼未輸入喔！");
          } else {
            $.ajax({
              type: "POST",
              url: "api.php",
              data: data2Srever,
              dataType: "json"
            }).then(function(dataFromServer) {
              console.log(dataFromServer);
              if(dataFromServer["errorCode"] == 666) {
                alert("登入成功喔！");
                $(location).prop("href", "index.php");
              } else if(dataFromServer["errorCode"] == 1) {
                alert("這個使用者名稱還沒註冊過喔！");
              } else if(dataFromServer["errorCode"] == 2) {
                alert("密碼輸入錯誤！");
              }
            }).catch(function(e) {
              console.log(e);
            });
          }
        })
      });
    </script>
</body>
</html>