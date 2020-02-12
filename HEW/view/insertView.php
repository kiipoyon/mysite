<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
  </head>

  <body>
<!-- ヘッダー -->
  <nav class="login">
      <a href="login.php" class="login">
        <?php
        if($flg == 1){
            echo "<a href='mypage.php' class='login-name'>ようこそ".$id."さん!</a>";
            echo "<a href='mypage.php' class='login-name'>会員情報</a>";
            echo "<a href='index.php' class='login-name'>ログアウト</a>";
        }else{
            echo "ログイン(新規登録)";
        }
        ?>
      </a>
    </nav>
  <header>
    <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
<!-- グローバルナビゲーション -->
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