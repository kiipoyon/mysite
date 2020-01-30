<?php
$content ="";
$sei ="";
$mei ="";
$k_sei ="";
$k_mei ="";
$mail ="";
$name ="";
$name_read ="";

$content = htmlspecialchars($_POST["content"]);
$sei = htmlspecialchars($_POST["sei"]);
$mei = htmlspecialchars($_POST["mei"]);
$k_sei = htmlspecialchars($_POST["k_sei"]);
$k_mei = htmlspecialchars($_POST["k_mei"]);
$mail = htmlspecialchars($_POST["mail"]);
?>
<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/request2.css">
  </head>

  <body>
<!-- ヘッダー -->
  <nav class="login">
    <a href="login.php" class="login">ログイン（新規登録）</a>
  </nav>
  <header>
    <h1><a href="index.php"><img src="images/rogo.jpg" alt="ろご"></a></h1>
<!-- グローバルナビゲーション -->
    <nav>
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
    </nav>

  </header>

<!-- メインビジュアル -->
<main>

  <h1 class="request">お問い合わせ内容確認</h1>

  <form action="sousin2.php" method="post">

    <table class="confirmation">
      <tr>
        <td class="left2">お問い合わせ内容</td>
        <td colspan="2" class="other" >
          <?php echo $content ?>
          <input type="hidden" name="content" value="<?php print $content;?>">
        </td>
      </tr>
      <tr>
        <td rowspan="4" class="left2">お名前</td>
        <td colspan="2" class="connect">姓　：<?php echo $sei ?></td>
      </tr>
      <tr>
        <td colspan="2" class="connect">名　：<?php echo $mei ?>
           <?php $name = $sei.','.$mei?>
          <input type="hidden" name="name" value="<?php print $name;?>">
        </td>
      </tr>
      <tr>
        <td colspan="2" class="connect">セイ：<?php echo $k_sei ?></td>
      </tr>
      <tr>
        <td colspan="2" class="connect">メイ：<?php echo $k_mei ?>
          <?php $name_read = $k_sei.','.$k_mei;?>
          <input type="hidden" name="name_read" value="<?php print $name_read;?>">
        </td>
      </tr>
      <tr>
        <td class="left2">メールアドレス</td>
        <td colspan="2" class="other"><?php echo $mail ?>
          <input type="hidden" name="mail_address" value="<?php print $mail;?>">
        </td>
      </tr>
      <tr>
        <td colspan="3" class="button">
          <input type="submit" name="" value="送信" class="sousin">
          <input type="submit" name="" value="再入力" class="reverse">
        </td>
      </tr>
    </table>
  </form>



</main>


<!-- フッター -->
<hr>
  <footer>
    <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
  </footer>

  </body>

</html>