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


 // セッション情報の取得
//セッション取得
$lastname = $_SESSION['lastname'];
$firstname = $_SESSION['firstname'];
$lastkana = $_SESSION['lastkana'];
$firstkana = $_SESSION['firstkana'];
$year = $_SESSION['year'];
$month = $_SESSION['month'];
$day = $_SESSION['day'];
$mail = $_SESSION['mail'];
$phone = $_SESSION['phone'];
$zip11 = $_SESSION['zip11'];
$addr11 = $_SESSION['addr11'];
$address = $_SESSION['address'];


 //変数連結
 $name=$lastname.$firstname;
 $name_read = $lastkana.$firstkana;
 $birthday = $year.$month.$day;
 $postal_code = $zip11;
 $street_address = $addr11.$address;

 $errorMessage = "";

 try {
     // 接続完了
     $pdo = new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');
 }catch (PDOException $e) {
     $errorMessage = 'データベースエラー';
     exit();
 }


 if (isset($_POST['change_idpas_last'])) {


     //ユーザ詳細テーブル
     $sql = 'UPDATE user_details_tbl SET name=:name, name_read=:name_read, birthday=:birthday, mail_address=:mail_address,
            phone_number=:phone_number, postal_code=:postal_code, street_address=:street_address WHERE user_id=:id';

     $stmt = $pdo -> prepare($sql);
     $stmt->bindParam(':name',$name,PDO::PARAM_STR);
     $stmt->bindParam(':name_read',$name_read,PDO::PARAM_STR);
     $stmt->bindParam(':birthday',$birthday,PDO::PARAM_STR);
     $stmt->bindParam(':mail_address',$mail,PDO::PARAM_STR);
     $stmt->bindParam(':phone_number',$phone,PDO::PARAM_STR);
     $stmt->bindParam(':postal_code',$postal_code,PDO::PARAM_STR);
     $stmt->bindParam(':street_address',$street_address,PDO::PARAM_STR);
     $stmt->bindParam(':id',$id,PDO::PARAM_STR);


     $stmt->execute();

     header ('location:change_basicinfo3.php');

 }

 ?>

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
      <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
    </header>


<!-- メインビジュアル -->
    <main>

    <h1 class="change">変更内容の確認</h1>

    <form method="POST" action="">

      <table>
        <tr>
          <td class="chan">氏名</td>
          <td><?php echo $name; ?></td>
        </tr>

        <tr>
          <td class="chan">
            フリガナ
          </td>
           <td><?php echo $name_read; ?></td>
        </tr>

        <tr>
          <td class="chan">生年月日</td>
          <td><?php echo $birthday; ?></td>
        </tr>

        <tr>
          <td>Eメールアドレス</td>
          <td><?php echo $mail; ?></td>
        </tr>

        <tr>
          <td class="chan">電話番号</td>
           <td><?php echo $phone; ?></td>
        </tr>

        <tr>
          <td class="chan">住所</td>
           <td><?php echo $postal_code.$street_address; ?></td>
        </tr>
      </table>

      <br>

      <div>
        <input type="submit" value="次へ" class="button" name="change_idpas_last">
        <input type="button" value="修正" class="button" onclick="history.back()">
      </div>

    </form>

    <br>

    <a href="mypage.php">会員情報変更トップに戻る</a>

    </main>


<!-- フッター -->
    <hr>
    <footer>
      <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
    </footer>

  </body>

</html>