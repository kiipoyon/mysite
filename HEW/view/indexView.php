<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    </head>
    <body>

    <!-- ヘッダー -->
  <nav class="login">
    <a href="login.php" class="login">
    	<?php


     	if($flg==1){
    	    echo "<a href='mypage.php' class='login-name'>ようこそ".$id."さん!</a>";
    	    echo "<a href='mypage.php' class='login-name'>会員情報</a>";
    	    echo "<a href='index.php' class='login-name'>ログアウト</a>";
    	}else{
    	    echo "ログイン(新規登録)";
    	}

    	?>
    </a>
  </nav>

  <header>
    <h1><a href="index.html"><img src="images/rogo.jpg" alt="ろご"></a></h1>
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
<!-- メインビジュアル -->

    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script src="js/common.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
      <ul class="slider">
          <li><a href="#"><img src="images/01.jpg" alt="image01"></a></li>
          <li><a href="#"><img src="images/02.jpg" alt="image02"></a></li>
          <li><a href="#"><img src="images/03.jpg" alt="image03"></a></li>
          <li><a href="#"><img src="images/04.jpg" alt="image04"></a></li>
          <li><a href="#"><img src="images/05.jpg" alt="image05"></a></li>
          <li><a href="#"><img src="images/06.jpg" alt="image06"></a></li>
          <li><a href="#"><img src="images/07.jpg" alt="image07"></a></li>
          <li><a href="#"><img src="images/08.jpg" alt="image08"></a></li>
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
                {code: 8 , name:"九州、沖縄", color:"#f7a6a6", hoverColor:"#ffcece", prefectures:[40,41,42,43,44,45,46,47]},
            ];

            $("#map-container").japanMap(
                {
                    areas  : areas,
                    selection : "area",
                    borderLineWidth: 0.25,
                    drawsBoxLine : true,
                    movesIslands : true,
                    showsAreaName : true,
                    width: 600,
                    font : "MS Mincho",
                    fontSize : 12,
                    fontColor : "black",
                    fontShadowColor : "white",
                    onSelect:function(data){
                    window.location.href = "list.php" + "?id=" + data.code;
                    },
                }
            );
        });
        </script>
</div>
    <div class="kensaku">
    <form action="list.php" method="post">
      <div class="k_p">
      <p class="k_p1">ジャンルで絞り込む</p>
        <select name="genre">
          <option disabled="" selected="" value="0">ジャンルで絞り込む</option>
          <option value="1">海鮮・水産加工品</option>
          <option value="2">肉・ハム</option>
          <option value="3">野菜</option>
          <option value="4">乳製品</option>
          <option value="5">果物</option>
          <option value="6">日本酒・ワイン・酒</option>
        </select>
      </div>
      <div class="k_p">
        <p class="k_p3">キーワード</p>
        <input type="text" name="keyword">
      </div>

      <div class="k_p">
        <label><input type="radio" name="hyouka" value="all">すべて</label>
        <label><input type="radio" name="hyouka" value="or">いずれか のキーワードを含む</label>
      </div>
      <div class="k_p2">
        <label><input type="checkbox" name="riyu" value="1">商品名・商品番号で探す</label>
      </div>
      <div class="k_p">
        <p>価格帯</p>
          <input type="text" name="mini"><p>～</p><input type="text" name="max"><p>円</p>
      </div>
      <div class="k_p">
      <input type="submit" name="submit" value="この条件で検索" class="button3">
      </div>
    </form>
    </div>

  </div>
    <script type="text/javascript" src="slick/slick.min.js"></script>
<!-- ランキング -->
  <h1 class="h_1">売れ筋ランキング</h1>
  <a href="buyout.php" method="GET">hhhh</a>
    <div class="multiple">
        <div><a href="product_details.html"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="product_details.html"><img src="images/4.jpg" alt=""><p>15,980</p><p>松茸</p><p>静岡県</p></a></div>
        <div><a href="#"><img src="images/5.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
    </div>
  <a href="#">一覧表示</a>

  <hr>

  <h1 class="h_1">おすすめ</h1>
    <div class="multiple">
        <div><a href="#"><img src="images/3.jpg" alt=""><p class="multiple_p1">¥15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p class="multiple_p2">15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
        <div><a href="#"><img src="images/3.jpg" alt=""><p>15,980</p><p>パイナップル</p><p>熊本県</p></a></div>
    </div>

  <a href="#">一覧表示</a>
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
    <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
  </footer>

  </body>
</html>