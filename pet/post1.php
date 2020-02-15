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

// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";

// $result初期化
$result = "";


if (isset($_POST['postbtn_1'])) {

    // 必須項目(15個)が入力されているか
    if (!is_null($_POST['choice']) && !empty($_POST['file']) && !empty($_POST['place']) && !empty($_POST['date']) && !empty($_POST['kind'])) {

        // セッション情報の保存
        $_SESSION['choice'] = $_POST['choice'];
        $_SESSION['file'] = $_POST['file'];
        $_SESSION['place'] = $_POST['place'];
        $_SESSION['date'] = $_POST['date'];
        $_SESSION['kind'] = $_POST['kind'];

        // セッション情報の取得
        $choice = $_SESSION['choice'];
        $file = $_SESSION['file'];
        $place = $_SESSION['place'];
        $date = $_SESSION['date'];
        $kind = $_SESSION['kind'];

        header ('location:post2.php');

           
    } else {
            $errorMessage = "必須項目をすべて入力してください";
            echo $_POST['choice'];
    }

} else {

    $choice = "";
    $file = "";
    $place = "";
    $date = "";
    $kind = "";

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

        <div class="message">
        <div><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
        </div>

        <dl>
          <dt>１．迷子情報ですか？目撃情報ですか？</dt>
          <dd><label><input type="radio" name="choice" value="0">迷子</label>　<label><input type="radio" name="choice" value="1">目撃</label></dd>
          <dt>２．写真を選択してください</dt>
          <dd><input type="file" name="file"></dd>
          <dt>３．迷子になった場所を記入して下さい</dt>
          <dd><textarea name="place" placeholder="愛知県名古屋市中村公園付近"></textarea></dd>
          <dt>４．迷子になった日時を記入して下さい</dt>
          <dd><input type="date" name="date"></dd>
          <dt>５．種類を記入して下さい</dt>
          <dd><input type="text" name="kind" placeholder="アメリカンショートヘア"></dd>
        </dl>

        <div  class="btn">
          <input type="reset" value="クリア">
          <input type="submit" name="postbtn_1" value="次へ">
        </div>

      </form>

      <div class="backmypage">
        <a href="mypage.php">＞マイページに戻る</a>
      </div>

    </div>

    <p class="copyright"><small>copyright &copy; 2019 Kien Mizukami. All rights reserved.</small><p>

  </body>

</html>