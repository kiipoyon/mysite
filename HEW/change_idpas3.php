<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" href="css/change.css">
  </head>

  <body>

    <header>
      <h1><a href="index.php"><img src="images/rogo.jpg" alt="ろご"></a></h1>
    </header>


<!-- メインビジュアル -->
    <main>

    <h1 class="change">変更内容の確認</h1>

    <form method="post" action="change_idpas4.php">

      <table>
        <tr>
          <td class="chan">ユーザーID</td>
          <td></td>
        </tr>

        <tr>
          <td class="chan">パスワード</td>
          <td></td>
        </tr>

      </table>

      <br>

      <div>
        <input type="submit" value="次へ" class="button">
        <input type="button" value="修正" class="button" onclick="history.back()">
      </div>

    </form>

    <br>

    <a href="change.php">会員情報変更トップに戻る</a>

    </main>


<!-- フッター -->
    <hr>
    <footer>
      <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
    </footer>

  </body>

</html>