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

//セッション取得
$image=$_SESSION['image'];
$place=$_SESSION['place'];
$petdate=$_SESSION['petdate'];
$kind=$_SESSION['kind'];
$choice=$_SESSION['choice'];
$mail=$_SESSION['mail'];

//メールフォームに投稿者メールアドレスを送る
$_SESSION['mail']=$mail;

?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>Uchinoko</title>

    <link rel="stylesheet" href="css/details.css">
    <link rel="stylesheet" href="css/common.css">
    <!-- twitter -->
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <!-- facebook -->
    <meta property="og:url"           content="https://www.your-domain.com/your-page.php" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Your Website Title" />
    <meta property="og:description"   content="Your description" />
    <meta property="og:image"         content="https://www.your-domain.com/path/image.jpg" />

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

    <!-- ペット詳細 -->
    <main>

      <div class="details">
        <img src="images/<?php echo $image ?>" style="width:250px;">
        <p>&#x25BC;拡散お願いします&#x25BC;</p>

        <div class="share">
          <a href="https://twiter.com/share?url=https://webdesign-trends.net/entry/3632" class="twitter">twitter</a>
          <a href="http://www.facebook.com/share.php?u={URL}" rel="nofollow" target="_blank" class="facebook">facebook</a>
        </div>

      <dl>
        <dt>迷子になった場所</dt>
        <dd><?php echo $place; ?></dd>
        <dt>迷子になった日時</dt>
        <dd><?php echo $petdate; ?></dd>
        <dt>種類</dt>
        <dd><?php echo $kind; ?></dd>
      </dl>

      <a href="mailform.php" class="mail">&#9654;投稿者にメールを送る</a>

    </main>

    <p class="copyright"><small>copyright &copy; 2019 Kien Mizukami. All rights reserved.</small><p>

  </body>

</html>