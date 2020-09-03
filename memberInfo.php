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
                                <input type="radio" id="male" name="gender" class="form-check-input" value="male">
                                <label class="form-check-label" for="male">男</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="female" name="gender" class="form-check-input" value="female">
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
                        <input class="form-control" type="text" name="" id="">
                    </div>
                    <div class="form-group col-8">
                        <label for="">居住地址</label>
                        <input class="form-control" type="text" name="" id="">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <button class="btn btn-outline-primary" type="button">確認送出</button>
                    </div>
                </div>
            </form>            
        </div>
    </div>
</body>
</html>