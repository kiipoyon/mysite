<?php

require 'common/common.php';

if (isset ($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
}else{
  header("Location: login.php");
  exit;
}

$pdo=new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');

//ログイン情報を検索し、検索結果をステートメントに設定する($loginidはPOSTで持ってきたもの) ここをprepareにする
$st=$pdo->query("SELECT * FROM request_tbl");

//処理結果を配列inquiryに設定する loginidが主キーならこの処理はいらない
$inquiry=$st->fetchAll();

?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁管理者画面</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/inquiry.css">

  </head>

  <body>

<h1>リクエスト確認</h1>

<div class="inquiry">

  <table>
    <?php 
      $cnt = 1;
      foreach ($inquiry as $i) { 
    ?>
    <tr>
      <td class="left"><?php print $cnt; ?></td>
      <td class="right"><a href="request2.php?iddd=<?php echo $i['request_no'] ?>" method="GET"><?php echo $i['name']; ?>さんのリクエスト</a></td>
    </tr>
    <?php 
      $cnt++;
      } 
    ?>
  </table>

</div>

<a href="index.php" class="return">トップに戻る</a>

</body>



  </body>

</html>