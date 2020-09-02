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
                <a class="nav-link" href="signup.php">加入會員</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="memberPage.php">會員中心</a>
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
        <div style="margin-top: 20px;">
            <form>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="oldPassword">舊密碼</label>
                        <input class="form-control" type="text" name="oldPassword" id="oldPassword">
                    </div>                    
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="newPassword">新密碼</label>
                        <input class="form-control" type="text" name="newPassword" id="newPassword">
                    </div>                    
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="newPasswordAgain">新密碼確認</label>
                        <input class="form-control" type="text" name="newPasswordAgain" id="newPasswordAgain">
                    </div>                    
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <button class="btn btn-outline-primary" type="button">確認送出</button>
                    </div>
                </div>
            </form>
        </div>
    </div>    
</body>
</html>