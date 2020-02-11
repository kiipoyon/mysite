<?php

require 'common/common.php';

$flg=0;

//ログインボタンが押された場合
if(isset($_POST["loginbtn"])){

    //画面入力のユーザーIDを取得する
    $id=$_POST["id"];

    //画面入力のパスワードを取得する
    $password=$_POST["password"];

    //ユーザIDの未入力チェック
    if(empty($id)){
        echo "メールアドレスが未入力です";
    }elseif(empty($password)){
        //パスワードの未入力チェック
        echo "パスワードが未入力です";
    }
}

if (isset ($_SESSION['roginid'])) {
    $id = $_SESSION['roginid'];
    //画面入力のパスワードを取得する
    $password=$_SESSION["password"];
}





//IDとパスワードが一致しているか確認する
if(!empty($id) && !empty($password)){


    //データベースに接続する
    $pdo=new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');

    //ログイン情報を検索し、検索結果をステートメントに設定する($loginidはPOSTで持ってきたもの) ここをprepareにする
    $st=$pdo->prepare("SELECT * FROM user_tbl WHERE user_id=?");

    //$id = $_POST['id']; // ユーザーIDをセッション変数にセット

    //bindValueメソッドでパラメータをセット
    $st->bindValue(1,$password);

    //executeでクエリを実行
    $st->execute();

    //処理結果を配列logininfoに設定する loginidが主キーならこの処理はいらない
    $logininfo=$st->fetch();

    //ログイン成功フラグを初期化する（ログイン成功フラグ＝０にする）
    $flg=0;
    //パスワードが一致しているかどうかチェックする
    //foreach($logininfo as $login){
    //ログイン情報のパスワードと画面d入力したパスワードが一致しているか比較する





    if(password_verify($password, $logininfo['password'])){
        $flg=1;
        session_regenerate_id(true); // セッションIDをふりなおす
        $_SESSION['roginid'] = $id; // ユーザーIDをセッション変数にセット
        $_SESSION['password'] = $password;

    }else{
        print '認証成功しない';
    }

    //}


    $st2=$pdo->prepare("select name from user_details_tbl where user_id=?");
    //bindValueメソッドでパラメータをセット
    $st2->bindValue(1,$id);

    //executeでクエリを実行
    $st2->execute();

    $logininfo2=$st2->fetchAll();

    foreach($logininfo2 as $login2){
        $name=$login2['name'];
    }


}

?>


<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" href="css/change.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  </head>

  <body>
<!-- ヘッダー -->
   <nav class="login">
    <a href="login.php" class="login">
    	<?php


     	if($flg==1){
     	    echo "<a href='mypage.php' class='login-name'>ようこそ".$id."さん!</a>";
    	    echo "<a href='change.php' class='login-name'>会員情報</a>";
    	    echo "<a href='session_out.php' class='login-name'>ログアウト</a>";
    	}else{
    	    echo "ログイン(新規登録)";
    	}

    	?>
    </a>
  </nav>
  <header>
    <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
<!-- グローバルナビゲーション -->
    <ul class="menu">
      <li class="menu__single">
        <a href="index.php" class="init-bottom">トップページへ</a>
      </li>
      <li class="menu__single">
        <a href="mypage.php#tobe2" class="init-bottom">購入履歴</a>
      </li>
      <li class="menu__single">
        <a href="mypage.php#tobe1" class="init-bottom">会員情報変更</a>
      </li>
      <li class="menu__single">
        <a href="buy.php" class="init-bottom">買い物かごを見る</a>
      </li>
      <li class="menu__single">
        <a href="request.php" class="init-bottom">お問い合わせをする</a>
      </li>
    </ul>
  </header>
<!-- メインビジュアル -->
  <main>

    <h1>会員情報変更</h1>

<!-- サブメニュー -->
    <ul class="changemenu">
      <li class="a">
        <a href="change_idpas1.php">ID/パスワード</a>
          <ul>
            <li>
              <a href="change_idpas1.php">ユーザーID</a>
            </li>
            <li>
              <a href="change_idpas1.php">パスワード</a>
            </li>
          </ul>
      </li>
      <li class="a">
        <a href="change_basicinfo1.php">基本情報</a>
          <ul>
            <li>
              <a href="change_basicinfo1.php">氏名</a>
            </li>
            <li>
              <a href="change_basicinfo1.php">生年月日</a>
            </li>
            <li>
              <a href="change_basicinfo1.php">Eメールアドレス</a>
            </li>
            <li>
              <a href="change_basicinfo1.php">電話番号</a>
            </li>
            <li>
              <a href="change_basicinfo1.php">住所</a>
            </li>
          </ul>
      </li>
      <li class="a">
        <a href="change_card1.php">カード情報</a>
        <ul>
          <li>
            <a href="change_card1.php">カード番号</a>
          </li>
          <li>
            <a href="change_card1.php">名義人</a>
          </li>
          <li>
            <a href="change_card1.php">有効期限</a>
          </li>
        </ul>
      </li>
    </ul>

<!-- サブメニューscript -->
    <script type="text/javascript">
      $(function() {
    var nav = $('.changemenu');
    $('li', nav)
    .mouseover(function(e) {
    $('ul', this).stop().slideDown('fast');
    })
    .mouseout(function(e) {
    $('ul', this).stop().slideUp('fast');
    });
    });
    </script>

    <div class="backmypage"><a href="mypage.php">マイページに戻る</a></div>

  </main>

<!-- フッター -->
<hr>
  <footer>
    <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
  </footer>

  </body>

</html>