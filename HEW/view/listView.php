<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/list.css">
    <!-- googleアイコン -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="js/list.js"></script>
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
        <a href="cart.php" class="init-bottom">買い物かごを見る</a>
      </li>
      <li class="menu__single">
        <a href="request.php" class="init-bottom">お問い合わせをする</a>
      </li>
    </ul>

  </header>

<!-- メインビジュアル -->
<main>


<div class="main">
  <div class="main_flex1">



      <p class="conditions">絞り込み条件</p>
      <p class="area_title">
        <i class="material-icons miCSS">search</i>
        エリア
      </p>
      <hr>
      <div class="area_conc">
        <a href="list.php?idd=1#abc" class="area" method="GET">北海道</a>
        <a href="list.php?idd=2#abc" class="area" method="GET">東北</a>
        <a href="list.php?idd=3#abc" class="area" method="GET">関東</a>
        <a href="list.php?idd=4#abc" class="area" method="GET">中部</a>
        <a href="list.php?idd=5#abc" class="area" method="GET">関西</a>
        <a href="list.php?idd=6#abc" class="area" method="GET">中国・四国</a>
        <a href="list.php?idd=7#abc" class="area" method="GET">九州・沖縄</a>
      </div>
      <p class="area_title">
        <i class="material-icons miCSS">search</i>
        カテゴリー
      </p>
      <hr>
      <a href="list.php?categoly=1#abc" class="area" method="GET">海鮮・水産加工品</a>
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


  <div class="main_flex2">

    <h1 id="abc"><?php echo $area?></h1>

    <div class="cp_ipselect cp_sl02">
      <form action="list.php" method="post">
        <select id="sort" required name="sort"  onchange="this.form.submit()">
          <option value="">おすすめ順</option>
          <option value="additional_date">新着順</option>
          <option value="cheap_price">価格が安い順</option>
          <option value="high_price">価格が高い順</option>
        </select>
      </form>
    </div>
    <div class="syouhin">
    <?php
        /* 一覧を３つ並べて表示 */
        $idx = 0;
        $col = 3; // カラム数
    ?>


        <table>
            <?php foreach ($product_tbl as $g) { ?>
              <?php if ($idx % $col == 0) { ?>
              <tr>
              <?php } ?>
                <td>
                  <a href="product_details.php?iddd=<?php echo $g['product_id'] ?>" method="GET">
                    <img class="gazou" src="images/<?php echo $g['product_id'] ?>.jpg">
                    <p><?php echo nl2br($g['product_name']) ?></p>
                    <p><?php echo nl2br($g['producing_area']) ?></p>
                    <p><?php echo nl2br($g['additional_date']) ?></p>
                    <p class="price"><?php echo($g['price']) ?>円</p>
                  </a>
                </td>
              <?php if ($idx % $col == $col - 1) { ?>
              </tr>
              <?php } ?>
              <?php $idx++; ?>
            <?php } ?>
            <?php if (($idx - 1) % $col != $col - 1) { ?>
              </tr>
            <?php } ?>
        </table>

        <?php 
          $count=$sta->rowCount();

          if($count == 0){
              $declaration = "該当なし";
              print $declaration;
          }
        ?>




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