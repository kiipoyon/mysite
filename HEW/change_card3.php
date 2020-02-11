<?php

require 'common/common.php';

if (isset ($_SESSION['roginid'])) {
  $id = $_SESSION['roginid'];
  //画面入力のパスワードを取得する
  $password=$_SESSION["password"];
}else{
  header("Location: login.php");
  exit;
}

// セッション情報の取得
$number = $_SESSION['number'];
$meigi = $_SESSION['meigi'];
$date = $_SESSION['date'];
$security_code = $_SESSION['security_code'];


$errorMessage = "";

try {
    // 接続完了
    $pdo = new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');
}catch (PDOException $e) {
    $errorMessage = 'データベースエラー';
    exit();
}

if (isset($_POST['syusei'])) {
  //ユーザ詳細テーブル
  $sql = 'UPDATE credit_tbl SET credit_number=:number, nominee=:meigi, expiration_date=:date, security_code=:security_code WHERE user_id=:id';
  $stmt = $pdo -> prepare($sql);
  $stmt->bindParam(':number',$number,PDO::PARAM_STR);
  $stmt->bindParam(':meigi',$meigi,PDO::PARAM_STR);
  $stmt->bindParam(':date',$date,PDO::PARAM_STR);
  $stmt->bindParam(':security_code',$security_code,PDO::PARAM_STR);
  $stmt->bindParam(':id',$id,PDO::PARAM_STR);

  //必須項目置き換え
//      $stmt->bindValue(1, $newpas1);
//      $stmt->bindValue(1,$id);

  $stmt->execute();

  //$pdo->commit();

  header ('location:change_card4.php');
  exit;
}

?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" href="css/change.css">
  </head>

  <body>

    <header>
      <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
    </header>


<!-- メインビジュアル -->
    <main>

    <h1 class="change">変更内容の確認</h1>

    <form method="post" action="">

      <table>
      <tr>
        <td class="chan">カード番号</td>
        <td><?php echo $number; ?></td>
      </tr>

      <tr>
        <td class="chan">名義人</td>
        <td><?php echo $meigi; ?></td>
      </tr>

      <tr>
        <td class="chan">有効期限</td>
        <td><?php echo $date; ?></td>
      </tr>

      <tr>
        <td class="chan">セキュリティコード</td>
        <td><?php echo $security_code; ?></td>
      </tr>

      </table>

      <br>

      <div>
      <input type="submit" value="次へ" class="button" name="syusei">
      <input type="button" value="修正" class="button" onclick="history.back()">
      </div>

    </form>

    <br>

    <a href="change.php">会員情報変更トップに戻る</a>

    </main>


<!-- フッター -->
    <hr>
    <footer>
      <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
    </footer>

  </body>

</html>