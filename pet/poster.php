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

?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>Uchinoko</title>

    <link rel="stylesheet" href="css/poster.css">
    <link rel="stylesheet" href="css/common.css">

  </head>

  <body>

    <header>
      <h1 class="logo">
        <a href="index.php"><img src="images/logo.png"></a>
      </h1>
    </header>

    <div class="poster">

      <form>

        <dl>
          <dt>１．写真を選択してください</dt>
          <dd><input type="file" name="file"></dd>
          <dt>２．迷子になった場所を記入して下さい</dt>
          <dd><textarea placeholder="愛知県名古屋市中村公園付近"></textarea></dd>
          <dt>３．迷子になった日時</dt>
          <dd><input type="date" name="date"></dd>
          <dt>４．種類</dt>
          <dd><input type="text" name="kind" placeholder="アメリカンショートヘア"></dd>
        </dl>

        <div  class="btn">
          <input type="button" name="btn" value="プレビュー">
        </div>

      </form>

      <div class="backmypage">
        <a href="mypage.php">＞マイページに戻る</a>
      </div>

    </div>

    <p class="copyright"><small>copyright &copy; 2019 Kien Mizukami. All rights reserved.</small><p>

  </body>

</html>