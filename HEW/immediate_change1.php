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

$errormessage="";

if(isset($_POST['syusei'])){
    if (!empty($_POST['zip11']) && !empty($_POST['addr11']) && !empty($_POST['address'])){

            //入力された値を取得
            $zip11=$_POST['zip11'];
            $addr11=$_POST['addr11'];
            $address=$_POST['address'];

            $postal_code = $zip11;
            $street_address = $addr11.$address;
            try {
              // データベースに接続する
              $pdo = connect();
          }catch (PDOException $e) {
              $errorMessage = 'データベースエラー';
              exit();
          }

              //ユーザ詳細テーブル
              $sql = 'UPDATE user_details_tbl SET postal_code=:postal_code, street_address=:street_address WHERE user_id=:id';
              $stmt = $pdo -> prepare($sql);
              $stmt->bindParam(':postal_code',$postal_code,PDO::PARAM_STR);
              $stmt->bindParam(':street_address',$street_address,PDO::PARAM_STR);
              $stmt->bindParam(':id',$id,PDO::PARAM_STR);

              $stmt->execute();
              var_dump($stmt);
              header("Location: immediate_change3.php");

    }else{
        $errormessage="必須項目をすべて入力してください。";
    }

}else{
    //入力された値クリア
    $zip11="";
    $addr11="";
    $address="";
    $errormessage="";
    $name="";
    $name_read="";
    $birthday="";
    $postal_code="";
    $street_address="";
}


?>
<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/change.css">
    <link rel="stylesheet" href="css/immediate_change.css">
  </head>

  <body>

    <header>
      <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
    </header>


<!-- メインビジュアル -->
    <main>

      <a>全ての項目を入力してください。</a>
	   <div style="color:red;"><?php echo htmlspecialchars($errormessage, ENT_QUOTES); ?></div>
    <form method="POST" action="">
      <table>
        <tr>
          <td class="regist">住所</td>
          <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
          <td>
            〒<input type="text" name="zip11" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');">
            <br>
            <input type="text" name="addr11" size="60">
            <br>
            丁目・番地・マンション名等
            <br>
            <input type="text" name="address" size="50">
          </td>
        </tr>
      </table>

      <div class="button">
        <input type="submit" value="完了" name="syusei" onclick="complete()" class="settlement">
        <input type="reset" value="クリア" class="settlement">
      </div>

    </form>


    </main>


<!-- フッター -->
    <hr>
    <footer>
      <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
    </footer>

  </body>

</html>