<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/change.css">
  </head>

  <body>

    <header>
      <h1><a href="index.php"><img src="images/rogo.jpg" alt="ろご"></a></h1>
    </header>


<!-- メインビジュアル -->
    <main>

    <h1 class="change">基本情報の確認</h1>

    <form method="post" action="change_basicinfo2.php">

      <table>
        <tr>
          <td class="chan">氏名</td>
          <td>姓　　　　　名　</td>
        </tr>

        <tr>
          <td class="chan">
            フリガナ
          </td>
          <td>セイ　　　　　メイ</td>
        </tr>

        <tr>
          <td class="chan">生年月日</td>
          <td>
            西暦　　　　年
            　　月
            　　日生
         </td>
        </tr>

        <tr>
          <td>Eメールアドレス</td>
          <td></td>
        </tr>

        <tr>
          <td class="chan">電話番号</td>
          <td></td>
        </tr>

        <tr>
          <td class="chan">住所</td>
          <td>
            〒
            
            
          </td>
        </tr>
      </table>


      <br>

      <div>
        <input type="submit" value="修正" class="button">
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