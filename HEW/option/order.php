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
$st=$pdo->query("SELECT * FROM orderdetails_tbl");

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
    <link rel="stylesheet" href="css/product1.css">

  </head>

  <body>

    <table>
      <tr>
        <td></td>
        <td>注文ユーザ</td>
        <td>注文商品</td>
        <td>個数</td>
        <td>注文日</td>
      </tr>
      <?php 
        $cnt = 1;
        foreach ($inquiry as $i) { 
      ?>
      <tr>
        <td><?php print $cnt; ?></td>
        <td><?php print $i['user_id']; ?></td>
        <td><?php print $i['product_id']; ?></td>
        <td><?php print $i['quantity']; ?></td>
        <td><?php print $i['order_date']; ?></td>
      </tr>
      <?php 
        $cnt++;
        } 
      ?>
    </table>

    <a href="index.php" class="return">トップに戻る</a>



  </body>

</html>