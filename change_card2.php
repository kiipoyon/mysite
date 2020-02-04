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

    <h1 class="change">カード情報の変更</h1>

    <form method="post" action="change_card3.php">

        <table>
        <tr>
          <td class="chan">カード番号</td>
          <td><input type="number" name="number"></td>
        </tr>

        <tr>
          <td class="chan">名義人</td>
          <td><input type="text" name="meigi"></td>
        </tr>

        <tr>
          <td class="chan">有効期限</td>
          <td><input type="number" name="date"></td>
        </tr>

      </table>

      <br>

      <div>
        <input type="submit" value="次へ" class="button">
        <input type="reset" value="クリア" class="button">
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