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
$st=$pdo->query("SELECT * FROM product_tbl");

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

  <div class="top">
    <p>ようこそ<?php echo $user_id; ?>さん</p>
    <a href="session_out.php">ログアウト</a>
  </div>

<h1>商品一覧</h1>

<div class="inquiry">

  <form method="post" action="delete.php">
    <table>
      <tr>
        <td>商品ID</td>
        <td>選択</td>
        <td>商品名</td>
        <td>都道府県</td>
        <td>画像</td>
        <td>地方ID</td>
        <td>カテゴリ</td>
        <td>値段</td>
        <td>登録日時</td>
      </tr>
      <?php 
        foreach ($inquiry as $i) { 
      ?>
      <tr>
        <td class="i_1"><?php print $i['product_id']; ?></td>
        <td class="i_ex"><input type="checkbox" name="del[]" value="<?php echo $i['product_id']?>">
        <td class="i_2"><?php echo $i['product_name']; ?></td>
        <td class="i_3"><?php echo $i['producing_area']; ?></td>
        <td class="i_4"><?php echo $i['images']; ?></td>
        <td class="i_5"><?php echo $i['region']; ?></td>
        <td class="i_6"><?php echo $i['categoly']; ?></td>
        <td class="i_8"><?php echo $i['price']; ?></td>
        <td class="i_9"><?php echo $i['additional_date']; ?></td>
      </tr>
      <?php 
        } 
      ?>
    </table>

    <input type="submit" class="delete" value="削除する">

  </form>

</div>

  <a href="insert.php" class="return">商品を追加する</a><br>

  <a href="index.php" class="return">トップに戻る</a>

  </body>

</html>