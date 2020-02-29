<?php

require 'common/common.php';

$errormessage = "";

if (isset($_POST['loginbtn'])) {
  $user_id = $_POST["user_id"];
  $user_pass = $_POST["user_pass"];
  if (empty($user_id) && empty($user_pass)){
    $errormessage = "ID又はパスワードが入力されていません";
  }else{
    //データベースに接続する
    $pdo=new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');

    //ログイン情報を検索し、検索結果をステートメントに設定する($loginidはPOSTで持ってきたもの) ここをprepareにする
    $st=$pdo->prepare("SELECT * FROM option_user_tbl WHERE user_id=?");

    //$id = $_POST['id']; // ユーザーIDをセッション変数にセット

    //bindValueメソッドでパラメータをセット
    $st->bindValue(1,$user_id);

    //executeでクエリを実行
    $st->execute();

    //処理結果を配列logininfoに設定する loginidが主キーならこの処理はいらない
    $logininfo=$st->fetch();

    if ($user_pass==$logininfo['user_pass']){
      $_SESSION['user_id'] = $user_id;
      header ('location:index.php');
      exit;
    }else{
      $errormessage = "ID又はパスワードが正しくありません";
    }
  }
}

?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁管理者画面</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/login.css">

  </head>

  <body>

    <h1>ログイン</h1>

    <?php echo $errormessage; ?>

    <form method="post" action="">

      <table>
        <tr>
          <td class="left">ユーザID：</td>
          <td class="right"><input type="text" name="user_id"></td>
        </tr>
        <tr>
          <td>パスワード：</td>
          <td><input type="text" name="user_pass"></td>
        </tr>
      </table>


      <div class="login">
        <input type=submit value="ログイン" class="button" name="loginbtn">
        <input type=reset value="クリア" class="button">
      </div>

    </form>

  </body>

</html>