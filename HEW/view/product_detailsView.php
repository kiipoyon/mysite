<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/product_details.css">
    <!-- googleアイコン -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
    <style type="text/css">
      /* タブっぽく並べて */
      #tabs ul {overflow:hidden; height:2em; list-style:none; border-bottom:1px solid #cccccc;}
      #tabs li {float:left; display:inline; margin-left:10px; padding:5px; border:1px solid #ccc; border-bottom:none; border-radius:10px 10px 0 0;}
      /* 最初はパネルは非表示 */
      #tabs .panel {display:none;}
    </style>
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
$(function() {
  $('#tabs a[href^="#panel"]').click(function(){
    $("#tabs .panel").hide();
    $(this.hash).fadeIn();
    return false;
  });
  $('#tabs a[href^="#panel"]:eq(0)').trigger('click');
})
</script>
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
        <a href="mypage.html#tobe" class="init-bottom">お気に入り</a>
      </li>
      <li class="menu__single">
        <a href="mypage.html#tobe2" class="init-bottom">購入履歴</a>
      </li>
      <li class="menu__single">
        <a href="cart.html" class="init-bottom">買い物かごを見る</a>
      </li>
      <li class="menu__single">
        <a href="request.html" class="init-bottom">お問い合わせをする</a>
      </li>
    </ul>

  </header>

<!-- メインビジュアル -->
<main>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/mailaddress.js"></script>
<script>
$(document).ready(function(){
  $(".email").emailautocomplete({ //補完機能をつけたい箇所を指定
    domains: ["yahoo.co.jp", "gmail.com", "gmail.com", "ezweb.ne.jp", "au.com", "docomo.ne.jp", "i.softbank.jp", "softbank.ne.jp", "excite.co.jp", "googlemail.com", "hotmail.com", "icloud.com", "live.jp", "me.com", "mineo.jp", "nifty.com", "outlook.com", "outlook.jp", "yahoo.ne.jp", "ybb.ne.jp", "ymobile.ne.jp", ] //補完機能に追加したいドメインを記述
  });
});
</script>


<div class="main">
  <div class="main_flex1">



  <p class="conditions">絞り込み条件</p>
  <p class="area_title">
    <i class="material-icons miCSS">search</i>
    エリア
  </p>
  <hr>
  <div class="area_conc">
    <a href="list.php?id=1#abc" class="area" method="GET">北海道</a>
    <a href="list.php?id=2#abc" class="area" method="GET">東北</a>
    <a href="list.php?id=3#abc" class="area" method="GET">関東</a>
    <a href="list.php?id=4#abc" class="area" method="GET">中部</a>
    <a href="list.php?id=5#abc" class="area" method="GET">関西</a>
    <a href="list.php?id=6#abc" class="area" method="GET">中国・四国</a>
    <a href="list.php?id=7#abc" class="area" method="GET">九州・沖縄</a>
  </div>
  <p class="area_title">
    <i class="material-icons miCSS">search</i>
    カテゴリー
  </p>
  <hr>
  <a href="list.php?categoly='#abc" class="area" method="GET">海鮮・水産加工品</a>
  <a href="list.php?categoly=2#abc" class="area" method="GET">肉・ハム</a>
  <a href="list.php?categoly=3#abc" class="area" method="GET">野菜</a>
  <a href="list.php?categoly=4#abc" class="area" method="GET">乳製品</a>
  <a href="list.php?categoly=5#abc" class="area" method="GET">果物</a>
  <a href="list.php?categoly=6#abc" class="area" method="GET">日本酒・ワイン・酒</a>
  <p class="area_title">
    <i class="material-icons miCSS">search</i>
    価格
  </p>
  <hr>
    <div class="cost">
      <p>価格（税込）を指定</p>
        <form action="list.php" method="post">
          <input type="text" name="mini" class="cost_t">～<input type="text" name="max" class="cost_t">円
          <input type="submit" name="submit" value="絞り込み" class="btn-square">
        </form>
    </div>
  </div>


    <?php foreach ($product_tbl as $g) { ?>
    <div class="main_flex2">
        <div class="container">

            <div class="container_flex1">
              <img src="images/<?php echo $g['product_id'] ?>.jpg">
            </div>

            <div class="container_flex2">
              <p class="p_name"><?php echo($g['product_name']) ?></p>
              <p class="p_area"><?php echo nl2br($g['producing_area']) ?></p>

              <div class="kago">
                <p>価格</p>
                <p class="price"><?php echo($g['price']) ?>円（税込み）</p>
                <p class="amount">数量</p>
                <form action="buy.php" method="POST">
                  <div class="cp_ipselect cp_sl02">
                    <select name = "num">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                    </select>
                  </div>
                    <input type = "hidden" name = "code" value="<?php echo $g['product_id'] ?>">
                    <input type = "submit" name = "submit" value = "&#xf07a; カートに入れる" class="fas cart fa-lg">
                </form>
                <?php } ?>

              <form action="#" method="POST" id="contact">
                <input type="submit" value="&#xf004; お気に入り追加" class="fas favorite fa-lg">
              </form>
            </div>
        </div>
    </div>
      <div>
        <p class="syohin">商品説明<hr></p>
        <p><?php echo nl2br($g['description']) ?></p>
      </div>

      <p class="syohin">仕様<hr></p>
      <div class="siyou">
        <p>仕様</p>
      </div>

      <p class="syohin">商品レビュー<hr></p>
        <p>最新レビュー</p>
  </div>
</div>


</main>


<!-- フッター -->
<hr>
  <footer>
    <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
  </footer>

  </body>

</html>