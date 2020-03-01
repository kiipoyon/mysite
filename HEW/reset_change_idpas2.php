 <?php
 require 'common/common.php';
// データベースに接続する
$pdo = connect();
 // ハッシュ化ファイル
 require "password.php";

 $flg=0;

 $errorMessage = "";
 $newpas1 = $_SESSION['newpas1'];
 $mail = $_SESSION['mail'];

 try {
     // 接続完了
     $pdo = connect();
 }catch (PDOException $e) {
     $errorMessage = 'データベースエラー';
     exit();
 }


 if (isset($_POST['change_idpas_last'])) {

    // セッション情報の取得
    $newpas1 = $_SESSION['newpas1'];
    $mail = $_SESSION['mail'];
    //パスワードをハッシュ化
    $newpas1 = password_hash($newpas1, PASSWORD_DEFAULT);
    //ユーザ詳細テーブル
    $sql = 'UPDATE user_tbl
            SET user_tbl.password =:password
            WHERE user_tbl.user_id = 
            (SELECT user_id FROM user_details_tbl WHERE mail_address=:mail)';
    $stmt = $pdo -> prepare($sql);
    $stmt->bindParam(':password',$newpas1,PDO::PARAM_STR);
    $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);

     $stmt->execute();

     header ('location:reset_change_idpas3.php');

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
      <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
    </header>


<!-- メインビジュアル -->
    <main>

    <h1 class="change">変更内容の確認</h1>

    <form method="POST" action="">

      <table>
        <tr>
          <td class="chan">メールアドレス</td>
          <td>
			<?php
			    echo $mail;
			?>
          </td>
        </tr>

        <tr>
          <td class="chan">パスワード</td>
          <td>
          <?php echo str_repeat("*",mb_strlen($newpas1,"UTF8")) ; ?>
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