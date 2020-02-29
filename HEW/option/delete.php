<?php

require 'common/common.php';

if (isset ($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
}else{
  header("Location: login.php");
  exit;
}

if(!empty($_POST['del'])){
  $del_id=$_POST['del'];
  $c="";
  foreach ($del_id as $d){
    $c.= ",".$d;
    var_dump($c);
  }


  $pdo=new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');

  //ログイン情報を検索し、検索結果をステートメントに設定する($loginidはPOSTで持ってきたもの) ここをprepareにする
  $st=$pdo->prepare("SELECT * FROM product_tbl where product_id IN(0$c)");


  //executeでクエリを実行
  $st->execute();

  $deleteinfo=$st->fetchall();
}

if (isset($_POST['delete'])) {
  $product_id =$_POST['product_id'];

  $pdo=new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');
  $st1=$pdo->prepare("delete FROM product_tbl where product_id IN(0$product_id)");

  $st1->execute();

  header ('location:product1.php');
  exit;


}

?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁管理者画面</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/del.css">

  </head>

  <body>

  <div class="top">
    <p>ようこそ<?php echo $user_id; ?>さん</p>
    <a href="session_out.php">ログアウト</a>
  </div>

<form method="POST" action="">
  <table>
    <tr>
      <td>商品ID</td>
      <td>商品名</td>
      <td>都道府県</td>
      <td>画像</td>
      <td>地方ID</td>
      <td>カテゴリ</td>
      <td>値段</td>
      <td>登録日時</td>
    </tr>
    <?php 
      if(!empty($_POST['del'])){
        foreach ($deleteinfo as $i) { 
    ?>
    <tr>
      <td class="i_1"><?php print $i['product_id']; ?><input type="hidden" name="product_id" value="<?php echo $c;?>"></td>
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
      }
    ?>
  </table>

  <div class="button">

  <input type="submit" class="delete" name="delete" value="削除する">
  <button type="button" class="button" onclick="history.back()">戻る</button>

    </div>

</form>

  <a href="index.php" class="return">トップに戻る</a>

  </body>

</html>