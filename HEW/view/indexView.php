<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>特産横丁</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/common.css">
  <link rel="stylesheet" type="text/css" href="slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" /> </head>
<body>
  <!-- ヘッダー -->
  <nav class="login">
    <a href="login.php" class="login">
      <div>
          <?php
            if ($flg == 1) {
                echo "<div><p>ようこそ".$id.'さん!</p></div>';
                echo "<div><a href='mypage.php'>会員情報</a></div>";
                echo "<div><a href='session_out.php'>ログアウト</a></div>";
            } else {
                echo 'ログイン(新規登録)';
            }
            ?>
      </div>
    </a>
  </nav>
  <header>
    <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>

    <!-- グローバルナビゲーション -->
    <ul class="menu">
      <li class="menu__single"> <a href="index.php" class="init-bottom">トップページへ</a> </li>
      <li class="menu__single"> <a href="mypage.php#tobe2" class="init-bottom">購入履歴</a> </li>
      <li class="menu__single"> <a href="mypage.php#tobe1" class="init-bottom">会員情報変更</a> </li>
      <li class="menu__single"> <a href="buy.php" class="init-bottom">買い物かごを見る</a> </li>
      <li class="menu__single"> <a href="request.php" class="init-bottom">お問い合わせをする</a> </li>
    </ul>
  </header>
  <!-- メインビジュアル -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script src="js/common.js"></script>
  <script type="text/javascript" src="slick/slick.min.js"></script>
  <ul class="slider">
    <li><a href="list.php?idd=1"><img src="images/slide01.png" alt="image01"></a></li>
    <li><a href="list.php?idd=2"><img src="images/slide02.png" alt="image02"></a></li>
    <li><a href="list.php?idd=3"><img src="images/slide03.png" alt="image03"></a></li>
    <li><a href="list.php?idd=4"><img src="images/slide04.png" alt="image04"></a></li>
    <li><a href="list.php?idd=5"><img src="images/slide05.png" alt="image05"></a></li>
    <li><a href="list.php?idd=6"><img src="images/slide06.png" alt="image06"></a></li>
    <li><a href="list.php?idd=7"><img src="images/slide07.png" alt="image07"></a></li>
  </ul>
  <script type="text/javascript">
    $('.slider').slick({
        centerMode: true,
        centerPadding: '100px',
        dots:true,
        focusOnSelect:true,
        autoplay:true,
    });
  </script>
  <!-- メインビジュアル -->
  <main>
    <div id="wrap">
      <!-- 日本地図 -->
      <div class="tizu">
        <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
        <script src="js/jquery.japan-map.min.js"></script>
        <div id="map-container"></div>
        <script type="text/javascript">
          $(function(){
  
              var areas = [
                  {code: 1 , name:"北海道", color:"#ca93ea", hoverColor:"#e0b1fb", prefectures:[1]},
                  {code: 2 , name:"東北", color:"#a7a5ea", hoverColor:"#d6d4fd", prefectures:[2,3,4,5,6,7]},
                  {code: 3 , name:"関東", color:"#84b0f6", hoverColor:"#c1d8fd", prefectures:[8,9,10,11,12,13,14]},
                  {code: 4 , name:"中部", color:"#77e18e", hoverColor:"#aff9bf", prefectures:[15,16,17,18,19,20,21,22,23,24]},
                  {code: 5 , name:"近畿", color:"#f2db7b", hoverColor:"#f6e8ac", prefectures:[25,26,27,28,29,30]},
                  {code: 6 , name:"中国、四国", color:"#f9ca6c", hoverColor:"#ffe5b0", prefectures:[31,32,33,34,35,36,37,38,39]},
                  {code: 7 , name:"九州、沖縄", color:"#f7a6a6", hoverColor:"#ffcece", prefectures:[40,41,42,43,44,45,46,47]},
              ];

              $("#map-container").japanMap(
                  {
                      areas  : areas,
                      selection : "area",
                      borderLineWidth: 0.25,
                      drawsBoxLine : true,
                      movesIslands : true,
                      showsAreaName : true,
                      width: 560.2,
                      font : "MS Mincho",
                      fontSize : 13,
                      fontColor : "black",
                      onSelect:function(data){
                      window.location.href = "list.php" + "?idd=" + data.code;
                      },
                  }
              );
          });
        </script>
      </div>
      <!-- 検索 -->
      <div class="kensaku">
        <form action="list.php" method="post">
          <div class="k_p">
            <p class="k_p3">ジャンルで絞り込む</p> 
            <select name="genre" class="k_p_t">
              <option disabled="" selected="" value="0">ジャンルで絞り込む</option>
              <option value="1">海鮮・水産加工品</option>
              <option value="2">肉・ハム</option>
              <option value="3">野菜</option>
              <option value="4">乳製品</option>
              <option value="5">果物</option>
              <option value="6">日本酒・ワイン・酒</option>
              <option value="7">加工品</option>
            </select> 
          </div>
          <span class="br">
          <div class="k_p">
            <p class="k_p3">キーワード</p>
            <input type="text" name="keyword" class="k_p_t">
          </div>
          <div class="k_p">
            <p class="k_p3">価格帯</p>
              <input type="text" name="mini" class="k_p_t1">
            <p class="k_p4">～</p>
              <input type="text" name="max" class="k_p_t2">
            <p>円</p>
          </div>
          <span class="br">
          <div class="k_p"> <input type="submit" name="submit" value="この条件で検索" class="button3"> </div>
        </form>
      </div>
    </div>
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <!-- ランキング -->
    <h1 class="h_1">売れ筋ランキング</h1>
    <div class="multiple">
      <?php foreach ($product_tbl as $g) {
      ?>
      <div>
        <a href="product_details.php?iddd=<?php echo $g['product_id'] ?>" method="GET">
          <img class="gazou" src="images/<?php echo $g['images'] ?>">
          <p><?php echo nl2br($g['product_name']) ?></p>
          <p><?php echo nl2br($g['producing_area']) ?></p>
          <p class="price"><?php echo($g['price']) ?>円</p>
        </a>
      </div>
      <?php } ?>
    </div>
    <a href="list.php?rank=1">一覧表示</a>
    <hr>
    <h1 class="h_1">おすすめ</h1>
    <div class="multiple">
      <?php foreach ($producta_tbl as $g) {
      ?>
      <div>
        <a href="product_details.php?iddd=<?php echo $g['product_id'] ?>" method="GET">
          <img class="gazou" src="images/<?php echo $g['images'] ?>">
          <p><?php echo nl2br($g['product_name']) ?></p>
          <p><?php echo nl2br($g['producing_area']) ?></p>
          <p class="price"><?php echo($g['price']) ?>円</p>
        </a>
      </div>
      <?php } ?>
    </div>
      <a href="list.php">一覧表示</a>
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
  </main>
  <!-- フッター -->
  <hr>
  <footer>
    <div class="footer_copyright"><small>copyright © 2019 K. All rights reserved.</small></div>
  </footer>
</body>
</html>