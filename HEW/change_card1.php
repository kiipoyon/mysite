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
     $pdo = connect();

     //ログイン情報を検索し、検索結果をステートメントに設定する($loginidはPOSTで持ってきたもの) ここをprepareにする
     $st=$pdo->prepare("SELECT * FROM user_tbl WHERE user_id=?");

     //$id = $_POST['id']; // ユーザーIDをセッション変数にセット

     //bindValueメソッドでパラメータをセット
     $st->bindValue(1,$id);

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

 if ($flg == 0) {
  header ('location:login.php');

}

$creditinfo=$st->fetchAll();

foreach($creditinfo as $credit){
    $number=$credit['credit_number'];
    $nominee=$credit['nominee'];
    $expiration_date=$credit['expiration_date'];
}

if (empty($number) || empty($nominee) || empty($expiration_date)){
  $number = "登録されていません";
  $nominee = "登録されていません";
  $expiration_date = "登録されていません";
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
    <div>
        <?php
          if ($flg == 1) {
              echo "<p>ようこそ".$id.'さん!</p>';
              echo "<a href='session_out.php'>ログアウト</a>";
          }
          ?>
    </div>
  </nav>
    <header>
      <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
    </header>


<!-- メインビジュアル -->
    <main>

    <h1 class="change">カード情報の確認</h1>

    <form method="post" action="change_card2.php">

        <table>
        <tr>
          <td class="chan">カード番号</td>
          <td><?php echo $number; ?></td>
        </tr>

        <tr>
          <td class="chan">名義人</td>
          <td><?php echo $nominee; ?></td>
        </tr>

        <tr>
          <td class="chan">有効期限</td>
          <td><?php echo $expiration_date; ?></td>
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
