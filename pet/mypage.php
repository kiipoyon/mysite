<?php

require 'common/common.php';

//ログイン成功フラグ
$flg=0;

//変数宣言
$name="";
$image="";
$place="";
$petdate="";
$kind="";
$choice="";

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

    //マイページ
    //メールアドレスをもとに、自分の投稿履歴を引っ張ってくる
    $st3=$pdo->prepare("SELECT * FROM pet_post_table WHERE mail=?");

    $st3->bindValue(1,$mail);

    $st3->execute();

    //処理結果を配列boardに設定する
    $board=$st3->fetchAll();

    foreach($board as $b){
      $image=$b['image'];
      $place=$b['place'];
      $petdate=$b['petdate'];
      $kind=$b['kind'];
      $choice=$b['choice'];
    }

}

?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>Uchinoko</title>

    <link rel="stylesheet" href="css/mypage.css">
    <link rel="stylesheet" href="css/common.css">
  </head>

  <body>

    <header>

      <div class="gologin">

        <?php

        if($flg==1){
            echo '<a href="mypage.php">ようこそ'.$name.'さん</a>';
            echo '<br>';
            echo '<a href="post1.php">投稿する</a>';
            echo '<br>';
            echo '<a href="session_out.php">ログアウト</a>';
        }else{
            echo '<a href="login.php">ログイン(新規登録)</a>';
        }

        ?>

      </div>

      <h1 class="logo">
        <a href="index.php"><img src="images/logo.png"></a>
      </h1>

      <!-- ナビ -->
      <nav>
        <ul>
          <li>
            <input class="nav" type="button" value="マイページ" onclick="location.href='mypage.php'">
          </li>
          <li>
            <input class="nav" type="button" value="迷子情報" onclick="location.href='index.php'">
          </li>
          <li>
            <input class="nav" type="button" value="目撃情報" onclick="location.href='witness.php'">
          </li>
        </ul>
      </nav>

    </header>

    <!-- マイページ -->
    <main>

      <h2>&#9675;投稿履歴</h2>
      <form action="" method="POST" onsubmit="return confirm_test()">
        <div class="garbage">
        <div class="garbage-img"><input type="image" src="images/garbage.png"></div>
          <div class="pet-img"><img src="images/<?php echo $image ?>"></div>
          <dl>
            <dt>種類</dt>
            <dd><?php echo $kind; ?></dd>
            <dt>場所</dt>
            <dd><?php echo $place; ?></dd>
            <dt>日時</dt>
            <dd><?php echo $petdate; ?></dd>
          </dl>
        </div>
      </form>

      <div class="btn"><a href="poster.php">ポスター作成</a></div>

    </main>

    <p class="copyright"><small>copyright &copy; 2019 Kien Mizukami. All rights reserved.</small><p>

  </body>

</html>