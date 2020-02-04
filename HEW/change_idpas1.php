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

// $result初期化
$result = "";

if (isset($_POST['syusei'])) {

    // 必須項目(3個)が入力されているか
    if (!empty($_POST['pas']) && !empty($_POST['newpas1']) && !empty($_POST['newpas2'])){
      //このページで入力された値を取得する
        $pas2 = $_POST['pas'];
        $newpas1 = $_POST['newpas1'];
        $newpas2 = $_POST['newpas2'];


        if($password != $pas2){
            $errormessage = "現在のパスワードが正しくありません。";
        }else{

            if ($newpas1 == $newpas2){

                $result = 1;

                if($result == 1){
                    // セッション情報の保存
                    $_SESSION['newpas1'] = $_POST['newpas1'];
                    // セッション情報の取得
                    $newpas1 = $_SESSION['newpas1'];

                    header ('location:change_idpas2.php');
                }
            }else{
                $errormessage="新しいパスワードの入力が異なっています。";
                }
        }
    }else{
        $errormessage="必須項目をすべて入力してください。";
    }
}else{
    $newpas1="";
    $newpas2="";
}

?>
<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
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

    <h1 class="change">パスワードの変更</h1>
	<a>現在のパスワード、新しいパスワードを入力してください。</a><br>
	<br><a>全て必須項目です。</a>
    <form method="POST" action="">
    <div style="color:red;"><?php echo htmlspecialchars($errormessage, ENT_QUOTES); ?></div>

      <table>
        <tr>
          <td class="chan">ユーザーID</td>
          <td>
			<?php
			if($flg==1){
			    echo $id;
			}
			?>
          </td>
        </tr>
     	<tr>
     	  <td> 現在のパスワード </td>
     	  <td><input type="password" name="pas" maxlength="20"></td>
     	</tr>
        <tr>
          <td class="chan">新しいパスワード</td>
     	  <td><input type="password" name="newpas1" maxlength="20"></td>
        </tr>
        <tr>
          <td class="chan">新しいパスワード(確認用)</td>
     	  <td><input type="password" name="newpas2" maxlength="20"></td>
        </tr>

      </table>


      <br>

      <div>
        <input type="submit" value="修正" class="button" name="syusei">
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