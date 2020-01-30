<!DOCTYPE html>

  <html>

    <head>

    <meta charset="utf-8">

    <title>特産横丁 マイページ</title>

      <link rel="stylesheet" href="css/reset.css">
      <link rel="stylesheet" href="css/common.css">
      <link rel="stylesheet" href="css/mypage.css">
      <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
      <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    </head>
  <body>
      <div class="login-name">
        <div>
          <a href="change.php">
            〇〇〇〇さん<br>
            会員情報
          </a>
        </div>
        </label>
        <a href="index.php">ログアウト</a>
      </div>
    <header>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="js/common.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
      <a href="index.php"><img class="rogo" src="images/rogo.jpg" alt="ろご"></a>

<!-- グローバルナビゲーション -->
    <ul class="menu">
      <li class="menu__single">
        <a href="index.php" class="init-bottom">トップページへ</a>
      </li>
      <li class="menu__single">
        <a href="mypage.php#tobe" class="init-bottom">お気に入り</a>
      </li>
      <li class="menu__single">
        <a href="mypage.php#tobe2" class="init-bottom">購入履歴</a>
      </li>
      <li class="menu__single">
        <a href="buy.php" class="init-bottom">買い物かごを見る</a>
      </li>
      <li class="menu__single">
        <a href="request.php" class="init-bottom">お問い合わせをする</a>
      </li>
    </ul>

    </header>


  <section id="tobe"><h1 class="first">お気に入り一覧</h1></section>
    <div class="multiple">
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/4.jpg" alt=""><p>15,980</p><p>まつたけ～</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/5.jpg" alt=""><p>15,980</p><p>りんご</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/7.jpg" alt=""><p>15,980</p><p>オレンジ</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>

    </div>
      <h1 class="midasi">閲覧履歴</h1>
          <div class="multiple">
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/4.jpg" alt=""><p>15,980</p><p>まつたけ～</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/5.jpg" alt=""><p>15,980</p><p>りんご</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/7.jpg" alt=""><p>15,980</p><p>オレンジ</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>

    </div>
            <section id="tobe2"><h1 class="midasi">購入履歴</h1></section>
          <div class="multiple">
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/4.jpg" alt=""><p>15,980</p><p>まつたけ～</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/5.jpg" alt=""><p>15,980</p><p>りんご</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/7.jpg" alt=""><p>15,980</p><p>オレンジ</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>

    </div>
    <script type="text/javascript">
      $('.multiple').slick({
        infinite: true, //スライドのループ有効化
        dots: true, //ドットのナビゲーションを表示
        slidesToShow: 5, //表示するスライドの数
        slidesToScroll: 5, //スクロールで切り替わるスライドの数
        responsive: [{
          breakpoint: 768, //ブレークポイントが768px
          settings: {
            slidesToShow: 3, //表示するスライドの数
            slidesToScroll: 3, //スクロールで切り替わるスライドの数
          }
        }, {
          breakpoint: 480, //ブレークポイントが480px
          settings: {
            slidesToShow: 2, //表示するスライドの数
            slidesToScroll: 2, //スクロールで切り替わるスライドの数
          }
        }]
      });
    </script>
    <br>
        <ul class="menu">
      <li class="menu__single">
        <a href="index.php" class="init-bottom">トップページ</a>
      </li>
      <li class="menu__single">
        <a href="#tobe" class="init-bottom">お気に入り</a>
      </li>
      <li class="menu__single">
        <a href="#tobe2" class="init-bottom">購入履歴</a>
      </li>
      <li class="menu__single">
        <a href="cart.php" class="init-bottom">買い物かごを見る</a>
      </li>
      <li class="menu__single">
        <a href="request.php" class="init-bottom">お問い合わせをする</a>
      </li>
    <!-- 他グローバルナビメニュー省略 -->
    </ul>
    <hr>
  <footer>
    <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
  </footer>
  </body>
</html>