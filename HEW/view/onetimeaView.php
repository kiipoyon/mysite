<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/login.css">
  </head>

  <body>

  <nav class="login">
    <a href="login.php" class="login">
    	<?php
         if ($flg == 1) {
             echo "<a href='mypage.php' class='login-name'>ようこそ".$id.'さん!</a>';
             echo "<a href='mypage.php' class='login-name'>会員情報</a>";
             echo "<a href='session_out.php' class='login-name'>ログアウト</a>";
         } else {
             echo 'ログイン(新規登録)';
         }
        ?>
    </a>
  </nav>

    <header>
      <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
    </header>


<!-- メインビジュアル -->
    <main>

      <h1 class="login">ログイン</h1>

      <br><br>

      <form method=post action=>

      <br>

      <input type="text" name="oneCode">
      <input type="submit">

      </form>

      <br>

      <br>
      <br>
      <br>
      <br>

        <a href="index.php"><font size="2.0em">トップページに戻る</font></a>

    </main>


<!-- フッター -->
    <hr>
    <footer>
      <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
    </footer>

  </body>

</html>