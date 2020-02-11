<?php

require 'common/common.php';

if (isset ($_SESSION['roginid'])) {
  $id = $_SESSION['roginid'];
  //画面入力のパスワードを取得する
  $password=$_SESSION["password"];
}else{
  header("Location: login.php");
  exit;
}

// $errormessage初期化
$errormessage = "";

if (isset($_POST['syusei'])) {

    // 必須項目(3個)が入力されているか
    if (!empty($_POST['number']) && !empty($_POST['meigi']) && !empty($_POST['date']) && !empty($_POST['security_code'])){
      //このページで入力された値を取得する
        $number = $_POST['number'];
        $meigi = $_POST['meigi'];
        $date = $_POST['date'];
        $security_code = $_POST['security_code'];

        // セッション情報の保存
        $_SESSION['number'] = $number;
        $_SESSION['meigi'] = $meigi;
        $_SESSION['date'] = $date;
        $_SESSION['security_code'] = $security_code;

        header ('location:change_card3.php');
        exit;

    }else{
        $errormessage="必須項目をすべて入力してください。";
    }
}else{
    $number="";
    $meigi="";
    $date="";
    $mesecurity_codeigi="";
    $errormessage = "";
}

?>

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
      <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
    </header>


<!-- メインビジュアル -->
    <main>

    <?php echo $errormessage; ?>

    <h1 class="change">カード情報の変更</h1>

    <form method="post" action="">

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

        <tr>
          <td class="chan">セキュリティコード</td>
          <td><input type="number" name="security_code"></td>
        </tr>

      </table>

      <br>

      <div>
        <input type="submit" value="次へ" class="button" name="syusei">
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