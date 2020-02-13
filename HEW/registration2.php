<?php

// ハッシュ化ファイル
require "password.php";

// セッション開始
session_start();

// セッション情報の取得
$id = $_SESSION['id'];
$pas = $_SESSION['pas'];

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

$number = $_SESSION['number'];
$meigi = $_SESSION['meigi'];
$date = $_SESSION['date'];
$security_code = $_SESSION['security_code'];

//変数連結
$name = $lastname.$firstname;
$name_read = $lastkana.$firstkana;
$birthday = $year.$month.$day;
$postal_code = $zip11;
$street_address = $addr11.$address;


// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";


try {
    // 接続完了
    $pdo = new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');
}catch (PDOException $e) {
    $errorMessage = 'データベースエラー';
    exit();
    // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
    // echo $e->getMessage();
}



if (isset($_POST['signup_last'])) {

    //パスワードをハッシュ化
    $pass = password_hash($pas, PASSWORD_DEFAULT);


    //ユーザ詳細テーブル
    $stmt1 = $pdo->prepare("INSERT INTO user_details_tbl(user_id, name, name_read, birthday, mail_address, phone_number, postal_code, street_address)
				  VALUES (:user_id, :name, :name_read, :birthday, :mail_address, :phone_number, :postal_code, :street_address)");
    //必須項目置き換え
    $stmt1->bindValue(':user_id', $id);
    $stmt1->bindValue(':name', $name);
    $stmt1->bindValue(':name_read', $name_read);
    $stmt1->bindValue(':birthday', $birthday);
    $stmt1->bindValue(':mail_address', $mail);
    $stmt1->bindValue(':phone_number', $phone);
    $stmt1->bindValue(':postal_code', $postal_code);
    $stmt1->bindValue(':street_address', $street_address);



    //ユーザテーブル
    $stmt2 = $pdo->prepare("INSERT INTO user_tbl(user_id, password)
				  VALUES (:user_id, :password)");
    //必須項目置き換え
    $stmt2->bindValue(':user_id', $id);
    $stmt2->bindValue(':password', $pass);



    //カード情報テーブル
    $stmt3 = $pdo->prepare("INSERT INTO credit_tbl(user_id, credit_number, nominee, expiration_date,security_code)
				  VALUES (:user_id, :credit_number, :nominee, :expiration_date, :security_code)");
    //任意項目null置き換え
    $stmt3->bindValue(':user_id', $id);
    $stmt3->bindValue(':credit_number', $number);
    $stmt3->bindValue(':nominee', $meigi);
    $stmt3->bindValue(':expiration_date', $date);
    $stmt3->bindValue(':security_code', $security_code);

    //任意事項 クレジットカード
    $stmt3->bindValue(':user_id', $id);
    $stmt3->bindValue(':credit_number', $number);
    $stmt3->bindValue(':nominee', $meigi);
    $stmt3->bindValue(':expiration_date', $date);
    $stmt3->bindValue(':security_code', $security_code);

    $stmt1->execute();
    $stmt2->execute();
    $stmt3->execute();

    header ('location:registration3.php');

}



?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/registration.css">
  </head>

  <body>

    <header>
      <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
    </header>


<!-- メインビジュアル -->
    <main>

    <h1 class="registration">登録内容確認</h1>

    <form method="post" action="">

      <h2>ユーザーID/パスワード</h2>
      <table>
        <tr>
          <td class="regist">ユーザーID</td>
          <td><?php echo $id; ?>

          </td>
        </tr>

        <tr>
          <td class="regist">パスワード</td>
          <td>
          <?php echo str_repeat("*",mb_strlen($pas,"UTF8")) ; ?>
          </td>
        </tr>

      </table>

      <br>

      <h2>お客様の基本情報</h2>
      <table>
        <tr>
          <td class="regist">氏名</td>
          <td><?php echo $name; ?></td>
        </tr>

        <tr>
          <td class="regist">
            フリガナ
          </td>
          <td><?php echo $name_read; ?></td>
        </tr>

        <tr>
          <td class="regist">生年月日</td>
          <td>
            西暦<?php echo $year; ?>年
            <?php echo $month; ?>月
            <?php echo $day; ?>日生
         </td>
        </tr>

        <tr>
          <td>Eメールアドレス</td>
          <td><?php echo $mail; ?></td>
        </tr>

        <tr>
          <td class="regist">電話番号</td>
          <td><?php echo $phone; ?></td>
        </tr>

        <tr>
          <td class="regist">住所</td>
          <td>
            〒<?php echo $postal_code; ?>
            <?php echo $street_address; ?>
          </td>
        </tr>
      </table>

      <br>

      <h2>カード情報</h2>
        <table>
        <tr>
          <td class="regist">カード番号</td>
          <td><?php echo $number; ?></td>
        </tr>

        <tr>
          <td class="regist">名義人</td>
          <td><?php echo $meigi; ?></td>
        </tr>

        <tr>
          <td class="regist">有効期限</td>
          <td><?php echo $date; ?></td>
        </tr>


      </table>

      <br>

      <div>
        <input type="button" value="修正" class="button" onclick="history.back()">
        <input type="submit" value="次へ" class="button" name ="signup_last">
      </div>
    </form>

    <br>

    <a href="login.php">ログインページに戻る</a>

    </main>


<!-- フッター -->
    <hr>
    <footer>
      <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
    </footer>

  </body>

</html>