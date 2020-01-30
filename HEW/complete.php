<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/request.css">
    <meta http-equiv="refresh"content="10; url=index.php">
  </head>

  <body>
<!-- ヘッダー -->
  <nav class="login">
    <a href="login.php" class="login">ログイン（新規登録）</a>
  </nav>
  <header>
    <h1><a href="index.php"><img src="images/rogo.jpg" alt="ろご"></a></h1>
<!-- グローバルナビゲーション -->
    <ul class="menu">
      <li class="menu__single">
        <a href="index.php" class="init-bottom">トップページへ</a>
      </li>
      <li class="menu__single">
        <a href="mypage.php#tobe" class="init-bottom">お気に入り</a>
      </li>
      <li class="menu__single">
        <a href="mypage.php#tobe2" class="init-bottom">購入履歴</a>
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
<main>

  <h1 class="request">送信完了</h1>

  <p>
    リクエスト送信が完了しました。
  </p>

  <p id="PassageArea">5秒後にTOPページに移動します。</p>

  <script type="text/javascript">
  <!--
  count = 5; //カウントの初期値
  timerID = setInterval('countdown()',1000);

  function countdown() {
    count--;
    var msg = count + "秒後にTOPページに移動します。";   // 表示文作成
    document.getElementById("PassageArea").innerHTML = msg;   // 表示更新
  }
  -->
  </script>


</main>

  <a href="index.php" class="link">TOPページに戻る</a>


<!-- フッター -->
<hr>
  <footer>
    <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
  </footer>


<SCRIPT LANGUAGE="JavaScript">
<!--
function autoLink()
{
location.href="index.php";
}
setTimeout("autoLink()",5000);
// -->
</SCRIPT>

<!-- <script type="text/javascript" src="js/request.js"></script> -->
  </body>

</html>