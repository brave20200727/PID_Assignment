<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>消費者訂單</title>
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
            </ul>
            </div>
        </nav>
        <div style="margin-top: 20px;">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>請選擇使用者</td>
                        <td>
                            <select class="form-control" name="" id="">
                                <option selected>請選擇...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="accordion" id="accordionExample">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    訂單編號：202009021640
                  </button>
                  <button class="btn btn-danger float-right" value="202009021640" id="deleteButton">刪除</button>
                  <button class="btn btn-success float-right" style="margin-right: 10px;" disabled>已出貨</button>
                </h2>
              </div>
              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">商品名稱</th>
                            <th scope="col">單價</th>
                            <th scope="col">購買數量</th>
                            <th scope="col">小計</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Apple Watch圖片</td>
                            <td>81000</td>
                            <td>1</td>
                            <td>81000</td>
                        </tr>
                        <tr>
                            <td>總價</td>
                            <td></td>
                            <td></td>
                            <td>81000</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-link text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    訂單編號：202009021650
                  </button>
                  <button class="btn btn-danger float-right">刪除</button>
                  <button class="btn btn-primary float-right" style="margin-right: 10px;" disabled>待出貨</button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    這是第二筆訂單內容
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                  <button class="btn btn-link text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    訂單編號：202009021700
                  </button>
                  <button class="btn btn-danger float-right">刪除</button>
                  <button class="btn btn-primary float-right" style="margin-right: 10px;" disabled>待出貨</button>
                </h2>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                    這是第三筆訂單內容
                </div>
              </div>
            </div>
        </div>
        <div id="testDiv">
                        
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#deleteButton").on("click", function() {
                console.log($(this).prop("value"));
            });
        })
    </script>
</body>
</html>