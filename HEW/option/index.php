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
    <link rel="stylesheet" href="css/index.css">

  </head>

  <body>

    <div class="top">
      <p>ようこそ<?php echo $user_id; ?>さん</p>
      <a href="session_out.php">ログアウト</a>
    </div>

    <main>


      <ul>
        <li><a href="product.php">商品</a></li>
        <li><a href="order.php">注文履歴</a></li>
        <li><a href="inquiry.php">お問い合わせ確認</a></li>
        <li><a href="request.php">リクエスト確認</a></li>
      </ul>

    </main>

  </body>

</html>