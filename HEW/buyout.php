<?php
// 共通部品を呼び出す
require 'common/common.php';
// Daoを呼び出す
require 'model/Goods.php';
require 'dao/GoodsDao.php';
// データベースに接続する
$pdo = connect();

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
        //セッションがある場合
        if (isset ($_SESSION['roginid'])) {
        $id = $_SESSION['roginid'];
        $password=$_SESSION["password"];
      }





  	 //IDとパスワードが一致しているか確認する
  	 if(!empty($id) && !empty($password)){

        
            //データベースに接続する
            $pdo = connect();

            //ログイン情報を検索し、検索結果をステートメントに設定する($loginidはPOSTで持ってきたもの) ここをprepareにする
            $st=$pdo->prepare("SELECT * FROM user_tbl WHERE user_id=?");

            //bindValueメソッドでパラメータをセット
            $st->bindValue(1,$id);

            //executeでクエリを実行
            $st->execute();

            //処理結果を配列logininfoに設定する loginidが主キーならこの処理はいらない
            $logininfo=$st->fetch();

            //ログイン成功フラグを初期化する（ログイン成功フラグ＝０にする）
            $flg=0;
            //パスワードが一致しているかどうかチェックする
            if(password_verify($password, $logininfo['password'])){
            $flg=1;
            session_regenerate_id(true); // セッションIDをふりなおす
            $_SESSION['roginid'] = $id; // ユーザーIDをセッション変数にセット
            $_SESSION['password'] = $password;
            }else{
            }

      }






            // セッション情報の取得
    $sum = $_SESSION['sum'];


    foreach($_SESSION['cart'] as $code => $num) {
        // 商品テーブルを検索する
        $goods_dao = new GoodsDao();
        $goods = new Goods();
        $goods = $goods_dao->getGoodsByCode($code);
    
        $goods->setNum($num);
    
        strip_tags($num);
        $sum += $num * $goods->getPrice();
        $rows[] = $goods;
        }

        $res = $_SESSION["res"];

//PDOオブジェクトの生成
$pdo = new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');


            $lo = "SELECT * FROM orderdetails_tbl
            INNER JOIN product_tbl
            ON orderdetails_tbl.product_id = product_tbl.product_id
            where orderdetails_tbl.order_no= '$res'";
            //処理結果を配列logininfoに設定する loginidが主キーならこの処理はいらない
	// SQL実行
	$log = $pdo->query($lo);


// 変数とタイムゾーンを初期化
$auto_reply_subject = null;
$auto_reply_text = null;
date_default_timezone_set('Asia/Tokyo');

// 件名を設定
$auto_reply_subject = 'ご購入ありがとうございます。';



// 本文を設定
$auto_reply_text = "この度は、ご購入頂き誠にありがとうございます。\n下記の内容で注文を受け付けました。\n\n";
$auto_reply_text .= "ご注文内容：" . "\n";
$auto_reply_text .= "ご注文番号：" . $res . "\n";
$auto_reply_text .= "ご注文日時：" . date("Y-m-d H:i") . "\n";
// 取得したデータを出力
foreach( $log as $logber ) {
$auto_reply_text .= "商品名：" . "$logber[product_name] ". "\n\n";
$auto_reply_text .= "価格：" . "$logber[price] ". "\n\n";
}
$auto_reply_text .= "あなたのユーザーID：" . $id . "\n";
//$auto_reply_text .= "メールアドレス：" . $loginin['mail_address'] . "\n\n";
$auto_reply_text .= "特産横丁";

// メール送信
mb_send_mail("k.ishimaru0821@gmail.com", $auto_reply_subject, $auto_reply_text);






    require 'view/insertView.php';
?>