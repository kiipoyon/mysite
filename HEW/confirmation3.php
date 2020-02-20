<?php
if (isset($_POST['submit'])) {
  $company = htmlspecialchars($_POST["company"]);
  $sei = htmlspecialchars($_POST["sei"]);
  $mei = htmlspecialchars($_POST["mei"]);
  $k_sei = htmlspecialchars($_POST["k_sei"]);
  $k_mei = htmlspecialchars($_POST["k_mei"]);
  $mail = htmlspecialchars($_POST["mail"]);
}

if (isset($_POST['submit2'])) {
  $company = htmlspecialchars($_POST["company"]);
  $name = htmlspecialchars($_POST["name"]);
  $name_read = htmlspecialchars($_POST["name_read"]);
  $mail_address = htmlspecialchars($_POST["mail_address"]);

  require 'common/common.php';
  $id = $_SESSION['roginid'];

  $pdo = new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');
  $count = $pdo->exec("INSERT INTO seller_tbl(user_id,company_name,name,name_read,mail_address)
  VALUES('$id','$company','$name','$name_read','$mail_address')");

  $sql = 'UPDATE user_tbl SET authority=:authority WHERE user_id=:id';
  $stmt = $pdo -> prepare($sql);
  $stmt->bindParam(':id',$id,PDO::PARAM_STR);
  $stmt->bindParam(':authority',$id,PDO::PARAM_STR);

  $stmt->execute();

  header ('location:complete3.php');
  exit;


}


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
  <header>
    <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
<!-- グローバルナビゲーション -->
    <nav>
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
    </nav>

  </header>

<!-- メインビジュアル -->
<main>

  <h1 class="request">出品者登録</h1>

  <form action="" method="post">

    <table class="confirmation">
      <tr>
        <td class="left2">企業名<br>(出品者名)</td>
        <td colspan="2" class="other" >
          <?php echo $company; ?>
          <input type="hidden" name="company" value="<?php print $company;?>">
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
          <input type="submit" name="submit2" value="送信" class="sousin">
          <button type="button" onclick="history.back()">再入力</button>
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