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





// セッション情報の取得
$choice = $_SESSION['choice'];
$file = $_SESSION['file'];
$place = $_SESSION['place'];
$date = $_SESSION['date'];
$kind = $_SESSION['kind'];

// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";


try {
    // 接続完了
    $pdo = new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');
}catch (PDOException $e) {
    $errorMessage = 'データベースエラー';
    exit();
}



if (isset($_POST['postbtn_2'])) {

    //ユーザ詳細テーブル
    $stmt = $pdo->prepare("INSERT INTO pet_post_table(image, place, petdate, kind, choice,mail)
				  VALUES (:image, :place, :petdate, :kind, :choice, :mail)");
    //必須項目置き換え
    $stmt->bindValue(':image', $file);
    $stmt->bindValue(':place', $place);
    $stmt->bindValue(':petdate', $date);
    $stmt->bindValue(':kind', $kind);
    $stmt->bindValue(':choice', $choice);
    $stmt->bindValue(':mail', $mail);

    //実行
    $stmt->execute();

    header ('location:post3.php');

}

?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>Uchinoko</title>

    <link rel="stylesheet" href="css/post.css">
    <link rel="stylesheet" href="css/common.css">

  </head>

  <body>

    <header>
      <h1 class="logo">
        <a href="index.php"><img src="images/logo.png"></a>
      </h1>
    </header>

    <div class="post">

      <form action="" method="POST">

        <p>以下の内容でよろしいですか？</p>

        <dl>
          <dt>１．迷子情報か目撃情報か</dt>
          <dd>
            <?php
            if($choice==0){
              echo '迷子情報';
            }else{
              echo '目撃情報';
            }
            ?>
          <dd>
          <dt>２．写真</dt>
          <dd><?php echo $file; ?></dd>
          <dt>３．迷子になった場所</dt>
          <dd><?php echo $place; ?></dd>
          <dt>４．迷子になった日時</dt>
          <dd><?php echo $date; ?></dd>
          <dt>５．種類</dt>
          <dd><?php echo $kind; ?></dd>
        </dl>

        <div  class="btn">
          <input type="submit" value="修正" class="button" onclick="history.back()">
          <input type="submit" name="postbtn_2" value="次へ">
        </div>

      </form>

      <div class="backmypage">
        <a href="mypage.php">＞マイページに戻る</a>
      </div>

    </div>

    <p class="copyright"><small>copyright &copy; 2019 Kien Mizukami. All rights reserved.</small><p>

  </body>

</html>