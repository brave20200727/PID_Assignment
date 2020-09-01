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
            <a class="navbar-brand" href="index.php">購物網站</a>
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
                <li class="nav-item dropdown">
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
                </li>
            </ul>
            </div>
        </nav>       
        <form style="margin-top: 10px;">
            <div class="row">
                <div class="form-group col-12">
                    <label for="userName">使用者名稱</label>
                    <input class="form-control" type="text" id="userName">
                </div>                
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="email">電子信箱</label>
                    <input class="form-control" type="text" id="email">
                </div>                
            </div>
            <div class="row">
                <div class="form-group col-6">
                    <label for="userPassword">密碼</label>
                    <input class="form-control" type="text" id="userPassword">
                </div>
                <div class="form-group col-6">
                    <label for="userPasswordAgain">密碼確認</label>
                    <input class="form-control" type="text" id="userPasswordAgain">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="birthday">生日</label>
                    <input class="form-control" type="date" id="birthday">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline1">男</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline2">女</label>
                    </div>                      
                </div>
            </div>
        </form>
    </div>
</body>
</html>