<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/common85033.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
  </head>

  <body>

    <header>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="js/common.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
      <a href="index.html"><img class="rogo" src="images/rogo.jpg" alt="ろご"></a>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="js/common.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>

  <script type="text/javascript">
    $('.slider').slick({
        centerMode: true,
        centerPadding: '100px',
        dots:true,
        focusOnSelect:true,
        autoplay:true,
    });
  </script>
<!-- ―――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――― -->
<article>
<br>
  <h1 class="h_1">カートの中身</h1>
<hr>

          <table class="cart_t">
            <?php foreach($rows as $r) { ?>
            <tr>
                <td><img class="gazou" src="images/<?php echo $r->getId() ?>.jpg"></td>
                <td><?php echo $r->getName() ?></td>
                <td><?php echo $r->getPrice() ?></td>
                <td><?php echo $r->getNum() ?></td>
                <td><?php echo $r->getPrice() * $r->getNum() ?> 円</td>
                <td>
                  <input type="submit" value="削除">
                </td>
                <td>
                <label class="select-wrap entypo-down-open-mini">
                  <select name="category">
                  <option value="" selected>HTML</option>
                  <option value="">CSS</option>
                  <option value="">JavaScript</option>
                  <option value="">IA</option>
                  <option value="">UI</option>
                  <option value="">UX</option>
                  </select>
                </label>
                </td>
            </tr>
            <?php } ?>
        </table>

<hr>
<div class="text_right">
  <p>合計 <?php echo $sum ?> 円 </p>
</div>
<br>
<a href="list.php">お買い物に戻る</a>
<div class="text_right"><form action="credit.php" method="POST" id="contact"><input class="buy_submit" type="submit" value="レジに進む"></form></div>

</article>
<!-- ―――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――― -->
<!-- ランキング -->

  </main>


<!-- フッター -->
<hr>
  <footer>
    <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
  </footer>

  </body>

</html>