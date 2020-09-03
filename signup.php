<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員註冊</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="login.php">登入</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="memberPage.php">會員中心</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminPage.php">管理中心</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">購物車</a>
                </li>
                <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li> -->
            </ul>
            </div>
        </nav>
        <div style="margin-top: 10px;">
            <form>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="userName">使用者名稱</label>
                        <input class="form-control" type="text" id="userName">
                    </div>
                    <div class="form-group col-6">
                        <label for="email">電子信箱</label>
                        <input class="form-control" type="text" id="email">
                    </div>                                     
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="userPassword">密碼</label>
                        <input class="form-control" type="password" id="userPassword">
                    </div>
                    <div class="form-group col-6">
                        <label for="userPasswordAgain">密碼確認</label>
                        <input class="form-control" type="password" id="userPasswordAgain">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="birthday">生日</label>
                        <input class="form-control" type="date" id="birthday">
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
                        <button type="button" class="btn btn-outline-primary" id="signupButton">確認送出</button>
                    </div>
                </div>
            </form>            
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // $("input[name=gender]").on("change", function(){
            //     console.log($("input[name=gender]:checked").val());
            // })
            $("#signupButton").on("click", function() {
                let data2Server = {
                    userName: $("#userName").prop("value"),
                    userPassword: $("#userPassword").prop("value"),
                    userPasswordAgain: $("#userPasswordAgain").prop("value"),
                    email: $("#email").prop("value"),
                    birthday: $("#birthday").prop("value"),
                    gender: $("input[name=gender]:checked").prop("value"),
                    signupButton: 1                 
                }
                let re = /\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/;
                if(data2Server["userPassword"] != data2Server["userPasswordAgain"]){
                    alert("兩次輸入密碼不一致！");
                }
                else if(data2Server["userPassword"] == "" || data2Server["userPasswordAgain"] == "") {
                    alert("密碼或密碼確認不可以沒輸入東西！");
                }
                else if(!re.test(data2Server["email"])) {
                    alert("信箱格式不符！");
                }
                else if(!data2Server["userName"] || !data2Server["birthday"] || !data2Server["gender"]) {
                    alert("有資料沒填到喔！");
                }
                else {
                    
                    $.ajax({
                        type: "POST",
                        url: "api.php",
                        data: data2Server
                    }).then(function(dataFromServer) {
                        console.log(dataFromServer);
                    }).catch(function(e) {
                        console.log(e);
                    });
                }
            })
        })
    </script>
</body>
</html>