<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>Uchinoko</title>

    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/common.css">

  </head>

  <body>

    <header>
      <h1 class="logo">
        <a href="index.php"><img src="images/logo.png"></a>
      </h1>
    </header>

    <div class="form-wrapper">

      <div class="login">

      <h1>Login</h1>

      <form action="index.php" method="POST">
        <div class="form-item">
          <label for="id"></label>
          <input type="text" name="mail" placeholder="メールアドレス"></input>
        </div>
        <div class="form-item">
          <label for="password"></label>
          <input type="password" name="password" placeholder="パスワード"></input>
        </div>
        <div class="button-panel">
          <input type="submit" class="button" name="loginbtn" value="ログイン"></input>
        </div>
      </form>

      </div>

      <a href="registration1.php">＞新規登録はこちら</a>

    </div>

    <p class="copyright"><small>copyright &copy; 2019 Kien Mizukami. All rights reserved.</small><p>

  </body>

</html>