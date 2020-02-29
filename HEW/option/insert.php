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
    <link rel="stylesheet" href="css/insert.css">

  </head>

  <body>

  <h1>商品登録</h1>

  <form method="post" action="insert2.php" enctype="multipart/form-data">

  <table>
    <tr>
      <td class="left">商品名</td>
      <td class="right"><input type="text" name="product_name"></td>
    </tr>
    <tr>
      <td class="left">都道府県</td>
      <td class="right">
        <select name="pref_name">
          <option value="" selected>都道府県</option>
          <option value="北海道">北海道</option>
          <option value="青森県">青森県</option>
          <option value="岩手県">岩手県</option>
          <option value="宮城県">宮城県</option>
          <option value="秋田県">秋田県</option>
          <option value="山形県">山形県</option>
          <option value="福島県">福島県</option>
          <option value="茨城県">茨城県</option>
          <option value="栃木県">栃木県</option>
          <option value="群馬県">群馬県</option>
          <option value="埼玉県">埼玉県</option>
          <option value="千葉県">千葉県</option>
          <option value="東京都">東京都</option>
          <option value="神奈川県">神奈川県</option>
          <option value="新潟県">新潟県</option>
          <option value="富山県">富山県</option>
          <option value="石川県">石川県</option>
          <option value="福井県">福井県</option>
          <option value="山梨県">山梨県</option>
          <option value="長野県">長野県</option>
          <option value="岐阜県">岐阜県</option>
          <option value="静岡県">静岡県</option>
          <option value="愛知県">愛知県</option>
          <option value="三重県">三重県</option>
          <option value="滋賀県">滋賀県</option>
          <option value="京都府">京都府</option>
          <option value="大阪府">大阪府</option>
          <option value="兵庫県">兵庫県</option>
          <option value="奈良県">奈良県</option>
          <option value="和歌山県">和歌山県</option>
          <option value="鳥取県">鳥取県</option>
          <option value="島根県">島根県</option>
          <option value="岡山県">岡山県</option>
          <option value="広島県">広島県</option>
          <option value="山口県">山口県</option>
          <option value="徳島県">徳島県</option>
          <option value="香川県">香川県</option>
          <option value="愛媛県">愛媛県</option>
          <option value="高知県">高知県</option>
          <option value="福岡県">福岡県</option>
          <option value="佐賀県">佐賀県</option>
          <option value="長崎県">長崎県</option>
          <option value="熊本県">熊本県</option>
          <option value="大分県">大分県</option>
          <option value="宮崎県">宮崎県</option>
          <option value="鹿児島県">鹿児島県</option>
          <option value="沖縄県">沖縄県</option>
        </select>
      </td>
    </tr>
    <tr>
      <td class="left">商品画像</td>
      <td class="right"><input type="file" name="image"></td>
    </tr>
    <tr>
      <td class="left">カテゴリー</td>
      <td class="right">
        <select name="categoly">
          <option disabled="" selected="" value="0">カテゴリーを選択</option>
          <option value="1">海鮮・水産加工品</option>
          <option value="2">肉・ハム</option>
          <option value="3">野菜</option>
          <option value="4">乳製品</option>
          <option value="5">果物</option>
          <option value="6">日本酒・ワイン・酒</option>
          <option value="7">加工品</option>
        </select>
      </td>
    </tr>
    <tr>
      <td class="left">商品説明</td>
      <td class="right"><textarea class="description" name="description"></textarea></td>
    </tr>
    <tr>
      <td class="left">値段</td>
      <td class="right"><input type="number" name="price"></td>
    </tr>
  </table>

  <div class="button">
    <input type="reset" class="reset">
    <input type="submit" value="登録">
  </div>

  </form>

  <a href="index.php" class="return">トップに戻る</a>

  </body>

</html>