 <?php
 require 'common/common.php';

 // ハッシュ化ファイル
 require "password.php";

 $flg=0;


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

 // セッション情報の取得
 $newpas1 = $_SESSION['newpas1'];

 $errorMessage = "";

 try {
     // 接続完了
     $pdo = new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');
 }catch (PDOException $e) {
     $errorMessage = 'データベースエラー';
     exit();
 }


 if (isset($_POST['change_idpas_last'])) {

     //パスワードをハッシュ化
     $newpas = password_hash($newpas1, PASSWORD_DEFAULT);




     //ユーザ詳細テーブル
     $sql = 'UPDATE user_tbl SET password=:password WHERE user_id=:id';
     $stmt = $pdo -> prepare($sql);
     $stmt->bindParam(':password',$newpas,PDO::PARAM_STR);
     $stmt->bindParam(':id',$id,PDO::PARAM_STR);

     //必須項目置き換え
//      $stmt->bindValue(1, $newpas1);
//      $stmt->bindValue(1,$id);

     $stmt->execute();

     //$pdo->commit();

     $_SESSION = array();


     session_destroy();

     exit;

     header ('location:change_idpas3.php');

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
  <a href="login.php" class="login">
    	<?php


     	if($flg==1){
     	    echo "<a href='mypage.php' class='login-name'>ようこそ".$id."さん!</a>";
    	    echo "<a href='mypage.php' class='login-name'>会員情報</a>";
    	    echo "<a href='session_out.php' class='login-name'>ログアウト</a>";
    	}else{
    	    echo "ログイン(新規登録)";
    	}

    	?>
    </a>

    <header>
      <h1><a href="index.php"><img src="images/rogo.jpg" alt="ろご"></a></h1>
    </header>


<!-- メインビジュアル -->
    <main>

    <h1 class="change">変更内容の確認</h1>

    <form method="POST" action="">

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
          <td class="chan">パスワード</td>
          <td>
			<?php
			if($flg==1){
			    echo $newpas1;
			}
			?>
          </td>
        </tr>

      </table>

      <br>

      <div>
        <input type="submit" value="次へ" class="button" name ="change_idpas_last">
        <input type="button" value="修正" class="button" onclick="history.back()">
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