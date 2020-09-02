<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>購物網站首頁</title>
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
        <div class="row" style="margin-top: 10px;">
          <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link active" id="v-pills-eBooks-tab" data-toggle="pill" href="#v-pills-eBooks" role="tab" aria-controls="v-pills-eBooks" aria-selected="true">電子書</a>
              <a class="nav-link" id="v-pills-tcBooks-tab" data-toggle="pill" href="#v-pills-tcBooks" role="tab" aria-controls="v-pills-tcBooks" aria-selected="false">繁體中文書</a>
              <a class="nav-link" id="v-pills-scBooks-tab" data-toggle="pill" href="#v-pills-scBooks" role="tab" aria-controls="v-pills-scBooks" aria-selected="false">簡體中文書</a>
              <a class="nav-link" id="v-pills-foreignBooks-tab" data-toggle="pill" href="#v-pills-foreignBooks" role="tab" aria-controls="v-pills-foreignBooks" aria-selected="false">外文書</a>
              <a class="nav-link" id="v-pills-magazine-tab" data-toggle="pill" href="#v-pills-magazine" role="tab" aria-controls="v-pills-magazine" aria-selected="false">雜誌</a>
              <a class="nav-link" id="v-pills-comics-tab" data-toggle="pill" href="#v-pills-comics" role="tab" aria-controls="v-pills-comics" aria-selected="false">漫畫</a>
              <a class="nav-link" id="v-pills-stationery-tab" data-toggle="pill" href="#v-pills-stationery" role="tab" aria-controls="v-pills-stationery" aria-selected="false">文具用品</a>
            </div>
          </div>
          <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-eBooks" role="tabpanel" aria-labelledby="v-pills-eBooks-tab">
                <h1>熱門商品</h1>
                <div class="row">
                  <div class="col-6"><img src="img/tasos-mansour-DslcVKYR0XU-unsplash.jpg" alt="" height="250px" class="img-thumbnail"></div>
                  <div class="col-6">
                    <h5>商品名稱：</h5>
                    <p>蜻蜓圖片</p>
                    <h5>商品介紹：</h5>
                    <p>這就是一張蜻蜓的圖片而已！</p>
                    <button class="btn btn-outline-primary" value="1" onclick='$(location).prop("href", "productPage.php?productId=" + $(this).prop("value"));'>加入購物車</button>
                  </div>
                </div>
                <div class="row float-right">
                  <a href="#">更多>>></a>
                </div> 
              </div>
              <div class="tab-pane fade" id="v-pills-tcBooks" role="tabpanel" aria-labelledby="v-pills-tcBooks-tab">
                <h1>熱門商品</h1>
                <div class="row">
                  <div class="col-6"><img src="img/veronica-reverse-diAIZW5IWBY-unsplash.jpg" alt="" height="250px" class="img-thumbnail"></div>
                  <div class="col-6">
                    <h5>商品名稱：</h5>
                    <p>蝴蝶圖片</p>
                    <h5>商品介紹：</h5>
                    <p>這就是一張蝴蝶的圖片而已！</p>
                  </div>
                </div>
                <div class="row float-right">
                  <a href="#">更多>>></a>
                </div> 
              </div>
              <div class="tab-pane fade" id="v-pills-scBooks" role="tabpanel" aria-labelledby="v-pills-scBooks-tab">
                <h1>熱門商品</h1>
                <div class="row">
                  <div class="col-6"><img src="img/racim-amr-8KKGTKmULU8-unsplash.jpg" alt="" height="250px" class="img-thumbnail"></div>
                  <div class="col-6">
                    <h5>商品名稱：</h5>
                    <p>海獅圖片</p>
                    <h5>商品介紹：</h5>
                    <p>這就是一張海獅的圖片而已！</p>
                  </div>
                </div>
                <div class="row float-right">
                  <a href="#">更多>>></a>
                </div> 
              </div>
              <div class="tab-pane fade" id="v-pills-foreignBooks" role="tabpanel" aria-labelledby="v-pills-foreignBooks-tab">
                <h1>熱門商品</h1>
                <div class="row">
                  <div class="col-6"><img src="img/jakob-owens-_jYLJodqEoY-unsplash.jpg" alt="" height="250px" class="img-thumbnail"></div>
                  <div class="col-6">
                    <h5>商品名稱：</h5>
                    <p>GoPro圖片</p>
                    <h5>商品介紹：</h5>
                    <p>這就是一張GoPro的圖片而已！</p>
                  </div>
                </div>
                <div class="row float-right">
                  <a href="#">更多>>></a>
                </div>
              </div>
              <div class="tab-pane fade" id="v-pills-magazine" role="tabpanel" aria-labelledby="v-pills-magazine-tab">
                <h1>熱門商品</h1>
                <div class="row">
                  <div class="col-6"><img src="img/juvnsky-ru-_jn3oOccQtM-unsplash.jpg" alt="" height="250px" class="img-thumbnail"></div>
                  <div class="col-6">
                    <h5>商品名稱：</h5>
                    <p>雷蛇耳機圖片</p>
                    <h5>商品介紹：</h5>
                    <p>這就是一張雷蛇耳機的圖片而已！</p>
                  </div>
                </div>
                <div class="row float-right">
                  <a href="#">更多>>></a>
                </div>
              </div>
              <div class="tab-pane fade" id="v-pills-comics" role="tabpanel" aria-labelledby="v-pills-comics-tab">
                <h1>熱門商品</h1>
                <div class="row">
                  <div class="col-6"><img src="img/filip-baotic-FF8Kqb86V38-unsplash.jpg" alt="" height="250px" class="img-thumbnail"></div>
                  <div class="col-6">
                    <h5>商品名稱：</h5>
                    <p>Apple Watch圖片</p>
                    <h5>商品介紹：</h5>
                    <p>這就是一張Apple Watch的圖片而已！</p>
                  </div>
                </div>
                <div class="row float-right">
                  <a href="#">更多>>></a>
                </div>
              </div>
              <div class="tab-pane fade" id="v-pills-stationery" role="tabpanel" aria-labelledby="v-pills-stationery-tab">
                <h1>熱門商品</h1>
                <div class="row">
                  <div class="col-6"><img src="img/sean-stone-dkb3wApu5XQ-unsplash.jpg" alt="" height="250px" class="img-thumbnail"></div>
                  <div class="col-6">
                    <h5>商品名稱：</h5>
                    <p>Dual Shock圖片</p>
                    <h5>商品介紹：</h5>
                    <p>這就是一張Dual Shock的圖片而已！</p>
                  </div>
                </div>
                <div class="row float-right">
                  <a href="#">更多>>></a>
                </div>
              </div>
            </div>
          </div>
        </div>        
    </div>

    <script>
      function test(){
        console.log($(this).parent());
      }
    </script>
</body>
</html>