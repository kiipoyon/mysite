<?php
// 共通部品を呼び出す
require 'common/common.php';
// データベースに接続する
$pdo = connect();

$protocol = empty($_SERVER["HTTPS"]) ? "http://" : "https://";
$thisurl = $protocol . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

$flg=0;

          if(isset($_POST['submit'])){
            //画面入力のユーザーIDを取得する
            $mail=$_POST["mail"];

            $_SESSION['mail'] = $mail;
          $st2=$pdo->prepare("SELECT * FROM user_details_tbl WHERE mail_address = ?");
          //bindValueメソッドでパラメータをセット
          $st2->bindValue(1,$mail);

          //executeでクエリを実行
          $st2->execute();

          $logininfo2=$st2->fetch();
          if(!empty($logininfo2)){

            $passResetToken = md5(uniqid(rand(),true));
            $passToken = "http://localhost/HEW/reset_change_idpas1.php?passReset=$passResetToken&Mail=$mail";
            $code = date("Y/m/d H:i:s");
            //execメソッドでクエリを実行。insert文を実行した場合挿入件数が戻り値として返る
            $count = $pdo->exec("INSERT INTO password_tbl(password_id,currenta_time,parameters)
            VALUES('','$code','$passResetToken')");

            // 変数とタイムゾーンを初期化
              $auto_reply_subject = null;
              $auto_reply_text = null;
              date_default_timezone_set('Asia/Tokyo');

              // 件名を設定
              $auto_reply_subject = 'パスワード再設定のご案内';

              // 本文を設定
              $auto_reply_text = $logininfo2['name'] ."様". "\n";
              $auto_reply_text .= "こちらは特産横丁運営事務局です。" . "\n";
              $auto_reply_text .= "平素より特産横丁をご利用いただきありがとうございます。" . "\n\n";
              $auto_reply_text .= "以下のリンクよりパスワードの再設定を行ってください。" . "\n";
              $auto_reply_text .= $passToken . "\n";
              $auto_reply_text .= "特産横丁" . "\n";

              // メール送信
              mb_send_mail($logininfo2['mail_address'], $auto_reply_subject, $auto_reply_text);
              header ('location:resetting_after.php');
          }else{
            echo "error";
            exit;
          }
        }



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>特産横丁</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/common.css">
  <link rel="stylesheet" href="css/resetting.css">
</head>
<body>
    <!-- ヘッダー -->
    <nav class="login">
      <a href="login.php" class="login">
        <div>
            <?php
              if ($flg == 1) {
                  echo "<div><p>ようこそ".$id.'さん!</p></div>';
                  echo "<div><a href='mypage.php'>会員情報</a></div>";
                  echo "<div><a href='session_out.php'>ログアウト</a></div>";
              } else {
                  echo 'ログイン(新規登録)';
              }
              ?>
        </div>
      </a>
    </nav>

    <header>
      <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
    </header>

<form method="POST" action="resetting.php" name="submit">
  <div class="pass_reset">
    <p class="pass_reset">パスワード再設定</p>
      <div class="pass_reset1">
        <p>パスワードの再設定が必要になります。</p>
        <p class="mail_address">登録しているメールアドレス</p>
        <input class="mail_address1" type="text" name="mail" placeholder="Email address">
        <input class="mail_address2" type="submit" name="submit">
        <p class="mail_address">※パスワードを忘れた方は、パスワードの再発行をして下さい。会員登録時にご登録して頂いたメールアドレスにパスワード再発行手続きのメールをお送りします。</p>
      </div>
  </div>
</form>

<footer>
    <div class="footer_copyright"><small>copyright © 2019 K. All rights reserved.</small></div>
  </footer>
</body>
</html>