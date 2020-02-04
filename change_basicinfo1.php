<?php
require 'common/common.php';

$flg=0;

$errormessage="";


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

    if(password_verify($password, $logininfo['password'])){
        $flg=1;
        session_regenerate_id(true); // セッションIDをふりなおす
        $_SESSION['roginid'] = $id; // ユーザーIDをセッション変数にセット
        $_SESSION['password'] = $password; // パスワードをセッション変数にセット

    }else{
        print '認証成功しない';
    }

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

$_SESSION['lastname'] = $_POST['lastname'];
$_SESSION['firstname'] = $_POST['firstname'];
$_SESSION['lastkana'] = $_POST['lastkana'];
$_SESSION['firstkana'] = $_POST['firstkana'];
$_SESSION['year'] = $_POST['year'];
$_SESSION['month'] = $_POST['month'];
$_SESSION['day'] = $_POST['day'];
$_SESSION['mail'] = $_POST['mail'];
$_SESSION['phone'] = $_POST['phone'];
$_SESSION['zip11'] = $_POST['zip11'];
$_SESSION['addr11'] = $_POST['addr11'];
$_SESSION['address'] = $_POST['address'];

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

?>
<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/change.css">
  </head>

  <body>
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
      <h1><a href="index.php"><img src="images/rogo.jpg" alt="ろご"></a></h1>
    </header>


<!-- メインビジュアル -->
    <main>

    <h1 class="change">基本情報の確認</h1>

    <form method="post" action="change_basicinfo2.php">

      <table>
        <tr>
          <td class="chan">氏名</td>
          <td>姓　<?php echo $lastname;?>　　　　名　</td>
        </tr>

        <tr>
          <td class="chan">
            フリガナ
          </td>
          <td>セイ　　　　　メイ</td>
        </tr>

        <tr>
          <td class="chan">生年月日</td>
          <td>
            西暦　　　　年
            　　月
            　　日生
         </td>
        </tr>

        <tr>
          <td>Eメールアドレス</td>
          <td></td>
        </tr>

        <tr>
          <td class="chan">電話番号</td>
          <td></td>
        </tr>

        <tr>
          <td class="chan">住所</td>
          <td>
            〒


          </td>
        </tr>
      </table>


      <br>

      <div>
        <input type="submit" value="修正" class="button">
      </div>
    </form>

    <br>

    <a href="mypage.php">会員情報変更トップに戻る</a>

    </main>


<!-- フッター -->
    <hr>
    <footer>
      <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
    </footer>

  </body>

</html>