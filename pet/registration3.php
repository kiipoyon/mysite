<?php

// セッション開始
session_start();

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

      <form action="login.php" method="POST">

        <p class="complete">完了しました</p>

        <div class="button-panel">
          <input type="submit" value="次へ" class="button">
        </div>

      </form>

    </div>

    <div class="backlogin">
      <a href="login.php">＞ログインページに戻る</a>
    </div>

    <p class="copyright"><small>copyright &copy; 2019 Kien Mizukami. All rights reserved.</small><p>

  </body>

</html>