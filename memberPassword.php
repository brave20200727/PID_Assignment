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
    <title>修改會員密碼</title>
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
            </div>
        </nav>
        <div style="margin-top: 20px;">
            <form>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="oldPassword">舊密碼</label>
                        <input type="password" class="form-control" type="text" name="oldPassword" id="oldPassword">
                    </div>                    
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="newPassword">新密碼</label>
                        <input type="password" class="form-control" type="text" name="newPassword" id="newPassword">
                    </div>                    
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="newPasswordAgain">新密碼確認</label>
                        <input type="password" class="form-control" type="text" name="newPasswordAgain" id="newPasswordAgain">
                    </div>                    
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <button class="btn btn-outline-primary" type="button" id="updatePasswordButton">確認送出</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            $("#updatePasswordButton").on("click", function() {
                let data2Server = {
                    oldPassword: $("#oldPassword").prop("value"),
                    newPassword: $("#newPassword").prop("value"),
                    newPasswordAgain: $("#newPasswordAgain").prop("value"),
                    updatePassword: 1
                }
                if(data2Server["oldPassword"] == "") {
                    alert("舊密碼沒有填喔！");
                }else if(data2Server["newPassword"] == "" || data2Server["newPasswordAgain"] == "") {
                    alert("新密碼與新密碼確認有沒填到的喔！");
                } else if(data2Server["newPassword"] != data2Server["newPasswordAgain"]) {
                    alert("兩次密碼輸入的不一樣喔！");
                } else if(data2Server["oldPassword"] == data2Server["newPassword"]) {
                    alert("新密碼與舊密碼不可以相同！");
                } else {
                    $.ajax({
                        type: "POST",
                        url: "api.php",
                        data: data2Server,
                        dataType: 'json'
                    }).then(function(dataFromServer) {
                        if(dataFromServer["errorCode"] == 1) {
                            alert("舊密碼輸入錯誤！");
                        }
                        else{
                            alert("密碼修改成功！");
                            $(location).prop("href", "memberPage.php");
                        }
                    }).catch(function(e) {
                        console.log(e);
                    });
                }
            });
        });
    </script>
</body>
</html>