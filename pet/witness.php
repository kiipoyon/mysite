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

//掲示板
//データベースに接続する
$pdo=new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');

//choiceが0だったら迷子、1だったら目撃
$st=$pdo->query("SELECT * FROM pet_post_table WHERE choice=1");

//処理結果を配列boardに設定する
$board=$st->fetchAll();

foreach($board as $b){
  $image=$b['image'];
  $place=$b['place'];
  $petdate=$b['petdate'];
  $kind=$b['kind'];
  $choice=$b['choice'];
}

?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>Uchinoko</title>

    <link rel="stylesheet" href="css/index.css">
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

    <!-- 掲示板 -->
    <form action="witness_details.php" method="post">

      <main>

        <div class="flex">
          <h1>目撃</h1>
          <img src="images/<?php echo $image ?>" style="width:250px;">
          <p>
            種類　
            <?php
            if($choice == 1){
              echo $kind;
            }
            ?>
          </p>
          <p>
            場所
            <?php
            if($choice == 1){
              echo $place;
            }
            ?>　
          </p>
          <p>
            日時　
            <?php
            if($choice == 1){
              echo $petdate;
            }
            ?>
          </p>
          <div class="button-panel">
            <input type="submit" name="btn" value="詳細" class="button">
          </div>
        </div>

        <div class="flex">
          <h1>目撃</h1>
          <img class="img" src="images/cat.jpg">
          <p>種類　〇〇</p>
          <p>場所　名古屋市中区</p>
          <p>日時　12月1日</p>
          <div class="button-panel">
            <input type="submit" name="btn" value="詳細" class="button">
          </div>
        </div>

        <div class="flex">
          <h1>目撃</h1>
          <img class="img" src="images/cat.jpg">
          <p>種類　〇〇</p>
          <p>場所　名古屋市中区</p>
          <p>日時　12月1日</p>
          <div class="button-panel">
            <input type="submit" name="btn" value="詳細" class="button">
          </div>
        </div>

        <div class="flex">
          <h1>目撃</h1>
          <img class="img" src="images/cat.jpg">
          <p>種類　〇〇</p>
          <p>場所　名古屋市中区</p>
          <p>日時　12月1日</p>
          <div class="button-panel">
            <input type="button" name="btn" value="詳細" class="button">
          </div>
        </div>

        <div class="flex">
          <h1>目撃</h1>
          <img class="img" src="images/cat.jpg">
          <p>種類　〇〇</p>
          <p>場所　名古屋市中区</p>
          <p>日時　12月1日</p>
          <div class="button-panel">
            <input type="submit" name="btn" value="詳細" class="button">
          </div>
        </div>

        <div class="flex">
          <h1>目撃</h1>
          <img class="img" src="images/cat.jpg">
          <p>種類　〇〇</p>
          <p>場所　名古屋市中区</p>
          <p>日時　12月1日</p>
          <div class="button-panel">
            <input type="submit" name="btn" value="詳細" class="button">
          </div>
        </div>

      </main>

    </form>

    <p class="copyright"><small>copyright &copy; 2019 Kien Mizukami. All rights reserved.</small><p>

  </body>

</html>