<?php

require 'common/common.php';

$flg=0;

  	 //ログインボタンが押された場合
  	 if(isset($_POST["loginbtn"])){

            //画面入力のユーザーIDを取得する
            $id=$_POST["id"];

            //画面入力のパスワードを取得する
            $password=$_POST["password"];

  	     //ユーザIDの未入力チェック
  	     if(empty($id)){
  	         echo "メールアドレスが未入力です";
  	     }elseif(empty($password)){
  	         //パスワードの未入力チェック
  	         echo "パスワードが未入力です";
  	     }
       }
       
       if (isset ($_SESSION['roginid'])) {
        $id = $_SESSION['roginid'];
        //画面入力のパスワードを取得する
        $password=$_SESSION["password"];
      }





  	 //IDとパスワードが一致しているか確認する
  	 if(!empty($id) && !empty($password)){

        
            //データベースに接続する
            $pdo=new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');

            //ログイン情報を検索し、検索結果をステートメントに設定する($loginidはPOSTで持ってきたもの) ここをprepareにする
            $st=$pdo->prepare("SELECT * FROM user_tbl WHERE user_id=?");

            //$id = $_POST['id']; // ユーザーIDをセッション変数にセット

            //bindValueメソッドでパラメータをセット
            $st->bindValue(1,$id);

            //executeでクエリを実行
            $st->execute();

            //処理結果を配列logininfoに設定する loginidが主キーならこの処理はいらない
            $logininfo=$st->fetch();

            //ログイン成功フラグを初期化する（ログイン成功フラグ＝０にする）
            $flg=0;
            //パスワードが一致しているかどうかチェックする
            //foreach($logininfo as $login){
            //ログイン情報のパスワードと画面d入力したパスワードが一致しているか比較する





            if(password_verify($password, $logininfo['password'])){
            print '認証成功';
            $flg=1;
            session_regenerate_id(true); // セッションIDをふりなおす
            $_SESSION['roginid'] = $id; // ユーザーIDをセッション変数にセット
            $_SESSION['password'] = $password;
            }else{
            print '認証成功しない';
            }

          //}


          $st2=$pdo->prepare("select name from user_details_tbl where user_id=?");
          //bindValueメソッドでパラメータをセット
          $st2->bindValue(1,$id);

          //executeでクエリを実行
          $st2->execute();

          $logininfo2=$st2->fetchAll();

          foreach($logininfo2 as $login2){
              $name=$login2['name'];
          }


      }

if (isset ($_SESSION['roginid'])) {
  $user_id = $_SESSION['roginid'];
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
      $a = 'images/' . basename($_FILES['image']['name']);
      if(move_uploaded_file($_FILES['image']['tmp_name'], $a)){
          $msg = $a. 'のアップロードに成功しました';
      }else {
          $msg = 'アップロードに失敗しました';
      }
      $rename = $user_id.date('ymdHis').'.png';
      rename ('images/'.$image,'images/'.$rename);
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
    
  header ('location:insert3.php');
  exit;
}



?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/insert.css">
  </head>

  <body>
  <header>
    <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
<!-- グローバルナビゲーション -->
    <ul class="menu">
      <li class="menu__single">
        <a href="index.php" class="init-bottom">トップページへ</a>
      </li>
      <li class="menu__single">
        <a href="mypage.php#tobe2" class="init-bottom">購入履歴</a>
      </li>
      <li class="menu__single">
        <a href="mypage.php#tobe1" class="init-bottom">会員情報変更</a>
      </li>
      <li class="menu__single">
        <a href="buy.php" class="init-bottom">買い物かごを見る</a>
      </li>
      <li class="menu__single">
        <a href="request.php" class="init-bottom">お問い合わせをする</a>
      </li>
    </ul>

  </header>

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