<?php

// ハッシュ化ファイル
require "password.php";

// セッション開始
session_start();

// セッション情報の取得
$name = $_SESSION['name'];
$mail = $_SESSION['mail'];
$pw = $_SESSION['pw1'];

// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";


try {
    // 接続完了
    $pdo = new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');
}catch (PDOException $e) {
    $errorMessage = 'データベースエラー';
    exit();
}



if (isset($_POST['signup_last'])) {

    //パスワードをハッシュ化
    $pass = password_hash($pw, PASSWORD_DEFAULT);


    //ユーザ詳細テーブル
    $stmt = $pdo->prepare("INSERT INTO usertable(password, mail, username)
				  VALUES (:password, :mail, :username)");
    //必須項目置き換え
    $stmt->bindValue(':password', $pass);
    $stmt->bindValue(':mail', $mail);
    $stmt->bindValue(':username', $name);

    //実行
    $stmt->execute();

    header ('location:registration3.php');

}



?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>Uchinoko</title>

    <link rel="stylesheet" href="css/registration.css">
    <link rel="stylesheet" href="css/common.css">

  </head>

  <body>

    <header>
      <h1 class="logo">
        <a href="index.php"><img src="images/logo.png"></a>
      </h1>
    </header>

    <div class="regist">

      <form action="" method="POST">

        <p class="confirm">登録内容を確認してください</p>

        <ul>

          <li>
            <label for="name">ニックネーム</label>
            <p><?php echo $name; ?></p>
          </li>

          <li>
            <label for="mail">メールアドレス</label>
            <p><?php echo $mail; ?></p>
          </li>

          <li>
            <label for="pw">パスワード</label>
            <p><?php echo str_repeat("*",mb_strlen($pw,"UTF8")) ; ?></p>
          </li>

        </ul>

        <div class="button-panel">
          <input type="button" value="修正" class="button" onclick="history.back()">
          <input type="submit" value="次へ" class="button" name="signup_last">
        </div>

      </form>

    </div>

    <div class="backlogin">
      <a href="login.php">＞ログインページに戻る</a>
    </div>

    <p class="copyright"><small>copyright &copy; 2019 Kien Mizukami. All rights reserved.</small><p>

  </body>

</html>