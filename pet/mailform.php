<?php

require 'common/common.php';

//ログイン成功フラグ
$flg=0;

//変数宣言
$name="";

//ログインボタンが押された場合
if(isset($_POST["loginbtn"])){
    //メールアドレスの未入力チェック
    if(empty($mail)){
        echo "メールアドレスが未入力です";
    }elseif(empty($password)){
        //パスワードの未入力チェック
        echo "パスワードが未入力です";
    }
}

if (isset ($_SESSION['mail'])) {
    $mail = $_SESSION['mail'];
    //画面入力のパスワードを取得する
    $password=$_SESSION["password"];
}

//IDとパスワードが一致しているか確認する
if(!empty($mail) && !empty($password)){

    //データベースに接続する
    $pdo=new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');

    //ログイン情報を検索し、検索結果をステートメントに設定する($loginidはPOSTで持ってきたもの) ここをprepareにする
    $st=$pdo->prepare("SELECT * FROM usertable WHERE mail=?");

    //bindValueメソッドでパラメータをセット
    $st->bindValue(1,$mail);

    //executeでクエリを実行
    $st->execute();

    //処理結果を配列logininfoに設定する loginidが主キーならこの処理はいらない
    $logininfo=$st->fetch();

    //ログイン成功フラグを初期化する（ログイン成功フラグ＝０にする）
    $flg=0;

    //入力されたパスワードをハッシュ化して一致するか確認
    if(password_verify($password, $logininfo['password'])){
        $flg=1;
        session_regenerate_id(true); // セッションIDをふりなおす
        $_SESSION['mail'] = $mail; // セッション変数にセット
        $_SESSION['password'] = $password;
    }

    //名前を検索
    $st2=$pdo->prepare("SELECT username FROM usertable WHERE mail=?");

    //bindValueメソッドでパラメータをセット
    $st2->bindValue(1,$mail);

    //executeでクエリを実行
    $st2->execute();

    $logininfo2=$st2->fetchAll();

    foreach($logininfo2 as $login2){
        $name=$login2['username'];
    }

}

//ここから
require_once '../vendor/autoload.php';

//セッション受け取り
$mail=$_SESSION['mail'];

if (isset($_POST['send'])) {

  $from = 'key03dayo@gmail.com';
  $to = $mail;
  $message = $_POST['message'];

  //送信設定 ここを投稿者のアドレスに変える
  $transport = (new Swift_SmtpTransport('smtp.gmail.com',587,'tls'))
    ->setUsername($from)
    ->setPassword('kiipoyon0810');

  //送信設定をもとにメール送信のインスタンスを作成
  $mailer = new Swift_Mailer($transport);

  //メッセージを作成
  $email = (new Swift_Message('Uchinoko'))
    ->setFrom([$from => $name])
    ->setTo([$to])
    ->setBody("こんにちは!\nUchinokoの他ユーザーからメールです。\nTLSで暗号化しています。\n".$message);

  //メールを送信する
  if($mailer->send($email)){
    echo 'メールを送信しました。';
  }

  header('location:confirm.php');

}
?>

<html>
<head>
  <meta charset="utf-8" />
  <title>Uchinoko</title>

  <link rel="stylesheet" href="css/mail.css">
  <link rel="stylesheet" href="css/common.css">
</head>
<body>

  <div class="mail">
    <form action="" method="POST">
      <p class="form">メッセージ</p><textarea name="message" cols="60" rows="10"></textarea>
      <div class="btn">
        <input type="submit" name="send" value="送信">
      </div>
    </form>
  </div>

  <div class="back">
    <a href="index_details.php">＞前のページに戻る</a>
  </div>

</body>
</html>