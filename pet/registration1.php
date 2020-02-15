<?php

// ハッシュ化ファイル
require "password.php";

// セッション開始
session_start();


// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";

// $result初期化
$result = "";


if (isset($_POST['signup'])) {

    // 必須項目(15個)が入力されているか
    if (!empty($_POST['name']) && !empty($_POST['mail']) && !empty($_POST['pw1']) && !empty($_POST['pw2'])) {

            $pw1 = $_POST['pw1'];
            $pw2 = $_POST['pw2'];

            if ($pw1 == $pw2) {

                $result = 1;
                if($result == 1){

                    // セッション情報の保存
                    $_SESSION['name'] = $_POST['name'];
                    $_SESSION['mail'] = $_POST['mail'];
                    $_SESSION['pw1'] = $_POST['pw1'];

                    // セッション情報の取得
                    $name = $_SESSION['name'];
                    $mail = $_SESSION['mail'];
                    $pw = $_SESSION['pw1'];

                    header ('location:registration2.php');
                }

           } else {
                $errorMessage = "パスワードが一致しません";
           }
        } else {
            $errorMessage = "必須項目をすべて入力してください";
        }

} else {

    $pw1 = "";
    $pw2 = "";

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


        <div class="message">
        <div><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
        <p><span>&#8251;</span>のところは必須項目です</p>
        </div>


        <ul>

          <li>
            <label for="name">ニックネーム</label>
            <input type="text" name="name" placeholder="Ichiro" maxlength="20">
          </li>

          <li>
            <label for="mail">メールアドレス</label>
            <input type="text" name="mail" placeholder="info@example.com" maxlength="50">
          </li>

          <li>
            <label for="pw">パスワード</label>
            <input type="text" name="pw1" placeholder="password" maxlength="20">
          </li>

          <li>
            <label for="pw">パスワード(確認)</label>
            <input type="text" name="pw2" placeholder="password" maxlength="20">
          </li>

        </ul>

        <div class="button-panel">
          <input type="submit" value="次へ" class="button" name="signup">
        </div>

      </form>

    </div>

    <div class="backlogin">
      <a href="login.php">＞ログインページに戻る</a>
    </div>

    <p class="copyright"><small>copyright &copy; 2019 Kien Mizukami. All rights reserved.</small><p>

  </body>

</html>