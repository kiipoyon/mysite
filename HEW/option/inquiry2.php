<?php

require 'common/common.php';

if (isset ($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
}else{
  header("Location: login.php");
  exit;
}

/* idを受け取っているかの判断 */
if (isset($_GET['iddd'])) {
  $inquiry_no = $_GET['iddd'];
}

$pdo=new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');

//ログイン情報を検索し、検索結果をステートメントに設定する($loginidはPOSTで持ってきたもの) ここをprepareにする
$st=$pdo->prepare("SELECT * FROM inquiry_tbl WHERE inquiry_no=?");

//$id = $_POST['id']; // ユーザーIDをセッション変数にセット

//bindValueメソッドでパラメータをセット
$st->bindValue(1,$inquiry_no);

//executeでクエリを実行
$st->execute();

//処理結果を配列logininfoに設定する loginidが主キーならこの処理はいらない
$inquiryinfo=$st->fetch();

$inquiry_name = $inquiryinfo["name"];
$inquiry_mail = $inquiryinfo["mail_address"];
$inquiry_content = $inquiryinfo["content"];

?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁管理者画面</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/inquiry2.css">

  </head>

  <body>

    <h1>お問い合わせ確認</h1>
    <h2><?php print $inquiry_name; ?>さんのお問い合わせ</h2>

    <table>
      <tr>
        <td class="i_first">お問い合わせ内容</td>
        <td class="i_connect"><?php print $inquiry_content; ?></td>
      </tr>
      <tr>
        <td  class="i_first">お名前</td>
        <td class="i_third"><?php print $inquiry_name; ?></td>
      </tr>
      <tr>
        <td class="i_first">メールアドレス</td>
        <td class="i_connect"><?php print $inquiry_mail; ?></td>
      </tr>
    </table>

    <a href="inquiry.php">お問い合わせ一覧に戻る</a>



  </body>

</html>