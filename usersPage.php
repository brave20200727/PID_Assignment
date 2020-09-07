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
    <title>使用者頁面</title>
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
            <div class="card">
                <div class="card-header">
                    使用者列表
                </div>
                <ul class="list-group list-group-flush" id="userList"></ul> 
            </div>
        </div>        
    </div>
    
    <script>
      $(document).ready(function() {
        let data2Server = {
          getUserId: 1
        }
        $.ajax({
          type: "POST",
          url: "api.php",
          data: data2Server,
          dataType: "json"
        }).then(function(dataFromServer) {
          $("#userList").empty();
          for(let i =  1; i < dataFromServer["users"].length; i++) {
            let activeButton = $("<button></button>").on("click", function() {
              let data2Server = {
                userBan: 1,
                userStatus: 1,
                userId: $(this).prop('value')
              }
              $.ajax({
                type: "POST",
                url: "api.php",
                data: data2Server,
                dataType: "json"
              }).then(function(dataFromServer) {
                $(location).prop("href", "usersPage.php")
              }).catch(function(e) {
                console.log(e);
              });
            });
            activeButton.addClass("btn btn-success float-right").prop("value", dataFromServer["users"][i]["userId"]).append("啟用");
            let banButton = $("<button></button>").on("click", function() {
              let data2Server = {
                userBan: 1,
                userStatus: 2,
                userId: $(this).prop('value')
              }
              $.ajax({
                type: "POST",
                url: "api.php",
                data: data2Server,
                dataType: "json"
              }).then(function(dataFromServer) {
                $(location).prop("href", "usersPage.php")
              }).catch(function(e) {
                console.log(e);
              });
            });
            banButton.addClass("btn btn-danger float-right").prop("value", dataFromServer["users"][i]["userId"]).append("禁用");
            let user;
            if(dataFromServer["users"][i]["userStatus"] == 1) {
              user = $("<li></li>").addClass("list-group-item").append(dataFromServer["users"][i]["userName"]).append(banButton);
            }
            else {
              user = $("<li></li>").addClass("list-group-item").append(dataFromServer["users"][i]["userName"]).append(activeButton);
            }
            $("#userList").append(user);
          }
        }).catch(function(e) {
          console.log(e);
        });
      });
    </script>
</body>
</html>