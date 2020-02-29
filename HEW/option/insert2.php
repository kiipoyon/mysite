<?php

require 'common/common.php';

if (isset ($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
}else{
  header("Location: login.php");
  exit;
}

$product_name = htmlspecialchars($_POST["product_name"]);
$pref_name = htmlspecialchars($_POST["pref_name"]);
$categoly = htmlspecialchars($_POST["categoly"]);
$image = $_FILES["image"]["name"];
$description = htmlspecialchars($_POST["description"]);
$price = htmlspecialchars($_POST["price"]);

if (pathinfo($image,PATHINFO_EXTENSION) == 'jpg' || pathinfo($image,PATHINFO_EXTENSION) == 'png' || pathinfo($image,PATHINFO_EXTENSION) == 'jpeg' || pathinfo($image,PATHINFO_EXTENSION) == 'gih'){
  if(isset($_FILES)&& isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])){
      if(!file_exists('upload')){
          mkdir('upload');
      }
      $a = '../HEW/images/' . basename($_FILES['image']['name']);
      if(move_uploaded_file($_FILES['image']['tmp_name'], $a)){
          $msg = $a. 'のアップロードに成功しました';
      }else {
          $msg = 'アップロードに失敗しました';
      }
      $rename = $user_id.date('ymdHis').'.png';
      rename ('../HEW/images/'.$image,'../HEW/images/'.$rename);
  }
}

if($categoly == 1){
  $c_code = "海鮮・水産加工品";
}elseif ($categoly == 2) {
  $c_code = "肉・ハム";
}elseif ($categoly == 3) {
  $c_code = "野菜";
}elseif ($categoly == 4) {
  $c_code = "乳製品";
}elseif ($categoly == 5) {
  $c_code = "果物";
}elseif ($categoly == 6) {
  $c_code = "日本酒・ワイン・酒";
}elseif ($categoly == 7) {
  $c_code = "加工品";
}

if (isset($_POST['submit'])) {
  $product_name1 = htmlspecialchars($_POST["product_name"]);
  $pref_name1 = htmlspecialchars($_POST["pref_name"]);
  $categoly1 = htmlspecialchars($_POST["categoly"]);
  $image1 = htmlspecialchars($_POST["image"]);
  $description1 = htmlspecialchars($_POST["description"]);
  $price1 = htmlspecialchars($_POST["price"]);

  if ($pref_name == "北海道") {
    $region = "1";
  }elseif($pref_name == "青森県"||$pref_name == "岩手県"||$pref_name == "宮城県"||$pref_name == "秋田県"||$pref_name == "山形県"||$pref_name == "福島県"){
    $region = "2";
  }elseif($pref_name == "茨城県"||$pref_name == "栃木県"||$pref_name == "群馬県"||$pref_name == "埼玉県"||$pref_name == "千葉県"||$pref_name == "東京都"||$pref_name == "神奈川県"){
    $region = "3";
  }elseif($pref_name == "新潟県"||$pref_name == "富山県"||$pref_name == "石川県"||$pref_name == "福井県"||$pref_name == "山梨県"||$pref_name == "長野県"||$pref_name == "岐阜県"||$pref_name == "静岡県"||$pref_name == "愛知県"){
    $region = "4";
  }elseif($pref_name == "三重県"||$pref_name == "滋賀県"||$pref_name == "京都府"||$pref_name == "大阪府"||$pref_name == "兵庫県"||$pref_name == "奈良県"||$pref_name == "和歌山県"){
    $region = "5";
  }elseif($pref_name == "鳥取県"||$pref_name == "島根県"||$pref_name == "岡山県"||$pref_name == "広島県"||$pref_name == "山口県"||$pref_name == "徳島県"||$pref_name == "香川県"||$pref_name == "愛媛県"||$pref_name == "高知県"){
    $region = "6";
  }else{
    $region = "7";
  }

  $pdo = new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');

 $count = $pdo->exec("INSERT INTO product_tbl(product_name,producing_area,images,region,categoly,description,price,additional_date)
 VALUES('$product_name1','$pref_name1','$image1','$region','$categoly1','$description1','$price1',NOW())");
    
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
    <link rel="stylesheet" href="css/insert.css">

  </head>

  <body>

    <h1>商品登録</h1>

    <form method="post" method="">

      <table>
        <tr>
          <td class="left">商品名</td>
          <td class="right"><?php print $product_name; ?><input type="hidden" name="product_name" value="<?php echo $product_name;?>"></td>
        </tr>
        <tr>
          <td class="left">都道府県</td>
          <td class="right"><?php print $pref_name; ?><input type="hidden" name="pref_name" value="<?php echo $pref_name;?>"></td>
        </tr>
        <tr>
          <td class="left">商品画像</td>
          <td class="right"><?php echo "<img src=\"..\HEW\images/$rename\" class=\"insert_img\">"; ?><input type="hidden" name="image" value="<?php echo $rename;?>"></td>
        </tr>
        <tr>
          <td class="left">カテゴリー</td>
          <td class="right"><?php print $c_code; ?><input type="hidden" name="categoly" value="<?php echo $categoly;?>"></td>
        </tr>
        <tr>
          <td class="left">商品説明</td>
          <td class="right"><?php print $description; ?><input type="hidden" name="description" value="<?php echo $description;?>"></td>
        </tr>
        <tr>
          <td class="left">値段</td>
          <td class="right"><?php print $price; ?><input type="hidden" name="price" value="<?php echo $price;?>"></td>
        </tr>
      </table>

      <input type="submit" name="submit" value="登録">
      <button type="button" onclick="history.back()">再入力</button>

    </form>

  </body>

</html>