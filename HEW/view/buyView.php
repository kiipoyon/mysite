<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/buy.css">
    <link rel="stylesheet" href="css/common.css">
  </head>

  <body>

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
      <li class="menu__single">
        <a href="index.php" class="init-bottom">トップページへ</a>
      </li>
      <li class="menu__single">
        <a href="mypage.php#tobe2" class="init-bottom">購入履歴</a>
      </li>
      <li class="menu__single">
        <a href="mypage.php#tobe1" class="init-bottom">会員情報変更</a>
      </li>
      <li class="menu__single">
        <a href="buy.php" class="init-bottom">買い物かごを見る</a>
      </li>
      <li class="menu__single">
        <a href="request.php" class="init-bottom">お問い合わせをする</a>
      </li>
    </ul>
  </header>


<main>
<div class="main">
  <h1 class="h_1">ご注文内容</h1>
<hr>
          <form action="credit.php" method="POST">

          <div class="text_right">
            <input class="buy_submit" type="submit" value="レジに進む">
          </div>
          </form>
          <table class="cart_t">
            <tr>
              <th colspan="2">商品名</th>
              <th>数量</th>
              <th>小計（税込み）</th>
              <th></th>
            </tr>
            <?php foreach($rows as $r) { ?>
            <tr class="cart_tr1">
                <td class="cart_td"><img src="images/<?php echo $r->getImages() ?>"></td>
                <td class="cart_td"><?php echo $r->getName() ?></td>
                <form action="buy.php" method="POST">
                <td class="cart_td">
                  <?php echo $r->getNum() ?> 個 
                </td>
                <td class="cart_td"><?php echo $r->getPrice() * $r->getNum() ?> 円</td>
                <td class="cart_td">
                <input type="checkbox" name="checkbox[]" value="<?php echo $r->getId(); ?>">
                </td>
            </tr>
            <?php } ?>
            <tr>
              <td class="cart_tr"></td>
              <td class="cart_tr"></td>
              <td colspan="2" class="cart_tr"><p>合計金額（税込み） <?php echo $sum ?> 円 </p></td>
              <td class="cart_tr"><input type="submit" value="×削除" name="deletebtn" onclick="doReload()"></td>
              </form>
            </tr>
        </table>
          <a href="session_outcart.php">カートを空にする</a>
          <a href="list.php">お買い物に戻る</a>
  </div>


  </main>
<!-- フッター -->
<hr>
  <footer>
    <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
  </footer>
  </body>
</html>