<?php

require 'common/common.php';

if (isset ($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
}else{
  header("Location: login.php");
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
    <link rel="stylesheet" href="css/product.css">

  </head>

  <body>

  <div class="top">
    <p>ようこそ<?php echo $user_id; ?>さん</p>
    <a href="session_out.php">ログアウト</a>
  </div>

  <main>

    <a href="product1.php">商品一覧</a><br>
    <a href="insert.php">商品の追加</a>
  </main>

  <a href="index.php" class="return">トップに戻る</a>

  </body>

</html>