<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/login.css">
  </head>

  <body>

    <header>
      <h1><a href="index.html"><img src="images/logo.png" alt="ろご"></a></h1>
    </header>


<!-- メインビジュアル -->
    <main>

      <h1 class="login">ログイン</h1>

      <br><br>

      <form method=post action=index.php>
        <table>
          <tr>
            <td>ユーザーID:</td>
            <td><input type=text name="id"></td>
          </tr>
          <tr>
            <td>パスワード:</td>
            <td><input type=password name="password"></td>
          </tr>
        </table>

      <br>

      <div>
        <input type=submit value="ログイン" class="button" name="loginbtn">
        <input type=reset value="クリア" class="button">
      </div>
      </form>

      <br>

      <a href="registration1.php" class="btn-border-bottom">新規会員登録の方はこちら</a>

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