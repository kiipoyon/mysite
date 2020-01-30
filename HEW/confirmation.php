<?php
    $product = htmlspecialchars($_POST["product"]);
    $company = htmlspecialchars($_POST["company"]);
    $sei = htmlspecialchars($_POST["sei"]);
    $mei = htmlspecialchars($_POST["mei"]);
    $image = $_FILES["image"]["name"];
    $k_sei = htmlspecialchars($_POST["k_sei"]);
    $k_mei = htmlspecialchars($_POST["k_mei"]);
    $mail = htmlspecialchars($_POST["mail"]);
    $other = htmlspecialchars($_POST["other"]);
    $rename ="";

    if (pathinfo($image,PATHINFO_EXTENSION) == 'jpg' || pathinfo($image,PATHINFO_EXTENSION) == 'png' || pathinfo($image,PATHINFO_EXTENSION) == 'jpeg' || pathinfo($image,PATHINFO_EXTENSION) == 'gih'){
        if(isset($_FILES)&& isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])){
            if(!file_exists('upload')){
                mkdir('upload');
            }
            $a = 'upload/' . basename($_FILES['image']['name']);
            if(move_uploaded_file($_FILES['image']['tmp_name'], $a)){
                $msg = $a. 'のアップロードに成功しました';
            }else {
                $msg = 'アップロードに失敗しました';
            }
            $rename = $product.date('ymdHis').'.png';
            rename ('upload/'.$image,'upload/'.$rename);
        }
    }
?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/request2.css">
  </head>

  <body>
<!-- ヘッダー -->
  <nav class="login">
    <a href="login.html" class="login">ログイン（新規登録）</a>
  </nav>
  <header>
    <h1><a href="index.html"><img src="images/rogo.jpg" alt="ろご"></a></h1>
<!-- グローバルナビゲーション -->
    <nav>
    <ul class="menu">
      <li class="menu__single">
        <a href="index.html" class="init-bottom">トップページへ</a>
      </li>
      <li class="menu__single">
        <a href="mypage.html#tobe" class="init-bottom">お気に入り</a>
      </li>
      <li class="menu__single">
        <a href="mypage.html#tobe2" class="init-bottom">購入履歴</a>
      </li>
      <li class="menu__single">
        <a href="buy.html" class="init-bottom">買い物かごを見る</a>
      </li>
      <li class="menu__single">
        <a href="request.html" class="init-bottom">お問い合わせをする</a>
      </li>
    </ul>
    </nav>

  </header>

<!-- メインビジュアル -->
<main>

  <h1 class="request">リクエスト内容確認</h1>

  <form action="sousin.php" method="post" enctype="multipart/form-data">

    <table class="confirmation">
      <tr>
        <td rowspan="3" class="left">リクエスト内容</td>
        <td class="center">商品名</td>
        <td class="right">
          <?php echo $product ?>
          <input type="hidden" name="product" value="<?php print $product;?>">
        </td>
      </tr>
      <tr>
        <td class="center">
          生産者<br>
          （生産会社）
        </td>
        <td class="right">
          <?php echo $company ?>
          <input type="hidden" name="company" value="<?php print $company;?>">
        </td>
      </tr>
      <tr>
        <td class="center">
          商品画像
        </td>
        <td class="right">
          <?php echo "<img src=\"upload/$rename\">"; ?>
          <input type="hidden" name="image" value="<?php print $rename;?>">
        </td>
      </tr>
      <tr>
        <td rowspan="4" class="left">お名前</td>
        <td colspan="2" class="connect">姓　：<?php echo $sei ;?></td>
      </tr>
      <tr>
        <td colspan="2" class="connect">名　：<?php echo $mei ;?>
           <?php $name = $sei.','.$mei?>
          <input type="hidden" name="name" value="<?php print $name;?>">
        </td>
      </tr>
      <tr>
        <td colspan="2" class="connect">セイ：<?php echo $k_sei ?></td>
      </tr>
      <tr>
        <td colspan="2" class="connect">メイ：<?php echo $k_mei ?>
          <?php $name_read = $k_sei.','.$k_mei;?>
          <input type="hidden" name="name_read" value="<?php print $name_read;?>">
        </td>
      </tr>
      <tr>
        <td class="left">
          メールアドレス
        </td>
        <td colspan="2" class="connect">
          <?php echo $mail ?>
          <input type="hidden" name="mail_address" value="<?php print $mail;?>">
          </td>
      </tr>
      <tr>
        <td class="left">その他</td>
        <td colspan="2" class="other">
          <?php echo $other ?>
          <input type="hidden" name="other" value="<?php print $other;?>">
        </td>
      </tr>
      <tr>
        <td colspan="3" class="button">
          <input type="submit" name="" value="送信" class="sousin">
          <input type="hidden" name="flag" value="1">
          <input type="hidden" name="image" value="<?php print $rename;?>">
          <input type="reset" name="" value="再入力" class="reverse">
        </td>
      </tr>
    </table>
  </form>
<?php
 /* unlink('upload/'.$image); */
?>



</main>


<!-- フッター -->
<hr>
  <footer>
    <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
  </footer>

  </body>

</html>