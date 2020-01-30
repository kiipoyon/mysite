<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" href="css/change.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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

    <h1>会員情報変更</h1>

<!-- サブメニュー -->
    <ul class="changemenu">
      <li class="a">
        <a href="change_idpas1.php">ID/パスワード</a>
          <ul>
            <li>
              <a href="change_idpas1.php">ユーザーID</a>
            </li>
            <li>
              <a href="change_idpas1.php">パスワード</a>
            </li>
          </ul>
      </li>
      <li class="a">
        <a href="change_basicinfo1.php">基本情報</a>
          <ul>
            <li>
              <a href="change_basicinfo1.php">氏名</a>
            </li>
            <li>
              <a href="change_basicinfo1.php">生年月日</a>
            </li>
            <li>
              <a href="change_basicinfo1.php">Eメールアドレス</a>
            </li>
            <li>
              <a href="change_basicinfo1.php">電話番号</a>
            </li>
            <li>
              <a href="change_basicinfo1.php">住所</a>
            </li>
          </ul>
      </li>
      <li class="a">
        <a href="change_card1.php">カード情報</a>
        <ul>
          <li>
            <a href="change_card1.php">カード番号</a>
          </li>
          <li>
            <a href="change_card1.php">名義人</a>
          </li>
          <li>
            <a href="change_card1.php">有効期限</a>
          </li>
        </ul>
      </li>
    </ul>

<!-- サブメニューscript -->
    <script type="text/javascript">
      $(function() {
    var nav = $('.changemenu');
    $('li', nav)
    .mouseover(function(e) {
    $('ul', this).stop().slideDown('fast');
    })
    .mouseout(function(e) {
    $('ul', this).stop().slideUp('fast');
    });
    });
    </script>

    <div class="backmypage"><a href="mypage.php">マイページに戻る</a></div>

  </main>

<!-- フッター -->
<hr>
  <footer>
    <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
  </footer>

  </body>

</html>