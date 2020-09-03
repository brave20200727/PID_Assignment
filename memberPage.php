<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員中心</title>
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
        <div>
            <div style="margin-top: 20px;">
                <h4><span>鑽石會員 陳柏程&nbsp;您好～</span></h2>            
            </div>
            <div style="margin-top: 20px;">
                <h5>交易紀錄</h5>
                <div class="card-columns">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title"><a href="orderPage.php">訂單查詢</a></h5>
                        <p class="card-text" style="color: gray;">查看訂單資訊</p>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 20px;">
                <h5>會員資料</h5>
                <div class="card-columns">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="memberInfo.php">修改會員資料</a></h5>
                            <p class="card-text" style="color: gray;">修改姓名、e-mail...等個人資料</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="memberPassword.php">修改密碼</a></h5>
                            <p class="card-text" style="color: gray;">修改您的會員登入密碼</p>
                        </div>
                    </div>               
                </div>
            </div>            
        </div>
    </div>        
</body>
</html>