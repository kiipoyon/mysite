<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
  </head>

  <body>
<!-- ヘッダー -->
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


  </header>
<!-- メインビジュアル -->


<!-- メインビジュアル -->
  <main>
    <p align="center">
      お買い上げありがとうございます
    </p>
    <br>
    <a href="mypage.php">
      マイページへ
    </a>
  <br>
  </main>


<!-- フッター -->
<hr>
  <footer>
    <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
  </footer>

  </body>

</html>