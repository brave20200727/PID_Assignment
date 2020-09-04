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
    <title>修改會員資料</title>
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
            <form>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="userName">使用者名稱</label>
                        <input class="form-control" type="text" name="userName" id="userName" disabled>
                    </div>
                    <div class="form-group col-6">
                        <label for="birthday">生日</label>
                        <input class="form-control" type="text" name="birthday" id="birthday" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">姓名</label>
                        <input class="form-control" type="text" name="name" id="name">
                    </div>
                    <div class="form-group col-6">
                        <label>性別</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="male" name="gender" class="form-check-input" value="1">
                                <label class="form-check-label" for="male">男</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="female" name="gender" class="form-check-input" value="2">
                                <label class="form-check-label" for="female">女</label>
                            </div>                                 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="phone">電話號碼</label>
                        <input class="form-control" type="text" name="phone" id="phone">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <label for="">居住縣市</label>
                        <input class="form-control" type="text" name="city" id="city">
                    </div>
                    <div class="form-group col-8">
                        <label for="">居住地址</label>
                        <input class="form-control" type="text" name="address" id="address">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <button class="btn btn-outline-primary" type="button" id="updateInfoButton">確認送出</button>
                    </div>
                </div>
            </form>            
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let data2Server = {
                getUserInfo: 1
            }
            $.ajax({
                type: "POST",
                url: "api.php",
                data: data2Server,
                dataType: "json"
            }).then(function(dataFromServer) {
                console.log(dataFromServer);
                $("#userName").prop("value", dataFromServer["userName"]);
                $("#birthday").prop("value", dataFromServer["birthday"]);
                $("#name").prop("value", dataFromServer["name"]);
                $("#phone").prop("value", dataFromServer["phone"]);
                $("#city").prop("value", dataFromServer["city"]);
                $("#address").prop("value", dataFromServer["address"]);
                if(dataFromServer["gender"] == 1) {
                    $("input[name=gender]")[0].checked = true;
                } else {
                    $("input[name=gender]")[1].checked = true;
                }

            }).catch(function(e) {
                console.log(e);
            });   

            $("#updateInfoButton").on("click", function() {
                let data2Server = {
                    name: $("#name").prop("value"),
                    phone: $("#phone").prop("value"),
                    city: $("#city").prop("value"),
                    address: $("#address").prop("value"),
                    updateUserInfo: 1
                }      
                console.log(data2Server);
                $.ajax({
                    type: "POST",
                    url: "api.php",
                    data: data2Server,
                    dataType: "json"
                }).then(function(dataFromServer) {
                    console.log(dataFromServer);
                    if(dataFromServer["errorCode"] == 666) {
                        alert("資料修改成功！");
                        $(location).prop("href", "memberPage.php");
                    }
                }).catch(function(e) {
                    console.log(e);
                });          
            })
        })
    </script>
</body>
</html>