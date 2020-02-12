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


    // サブミットボタンが押された場合
    if (@$_POST['submit']) {
        // HTTP POSTから入力項目を取得する

        $method = $_POST['method'];
        echo $method;
        $card_no = $_POST['card_no'];
        $expiration_month = $_POST['expiration_month'];
        $expiration_year = $_POST['expiration_year'];
        $nominee = $_POST['nominee'];
        $delivery = $_POST['delivery'];
        $delivery_day = $_POST['delivery_day'];
        $delivery_time = $_POST['delivery_time'];
        $Destination = "fff";



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
//PDOオブジェクトの生成
$pdo = new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');

//execメソッドでクエリを実行。insert文を実行した場合挿入件数が戻り値として返る
$count = $pdo->exec("INSERT INTO order_tbl(order_id,product_id,method,card_no,expiration_month,expiration_year,nominee,delivery,delivery_day,delivery_time,Destination)
VALUES('','$id','$method','$card_no','$expiration_month','$expiration_year','$nominee','$delivery','$delivery_day','$delivery_time','$Destination')");

echo "{$count}件データを挿入しました。".PHP_EOL;

// 変数とタイムゾーンを初期化
$auto_reply_subject = null;
$auto_reply_text = null;
date_default_timezone_set('Asia/Tokyo');

// 件名を設定
$auto_reply_subject = 'ご購入ありがとうございます。';

// 本文を設定
$auto_reply_text = "この度は、お問い合わせ頂き誠にありがとうございます。
下記の内容でお問い合わせを受け付けました。\n\n";
$auto_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
$auto_reply_text .= "" . "\n";
$auto_reply_text .= "メールアドレス：" . "k.ishimaru0821@gmail.com" . "\n\n";
$auto_reply_text .= "GRAYCODE 事務局";

// メール送信
mb_send_mail("k.ishimaru0821@gmail.com", $auto_reply_subject, $auto_reply_text);


foreach($_SESSION['cart'] as $code => $num) {
//execメソッドでクエリを実行。insert文を実行した場合挿入件数が戻り値として返る
$count1 = $pdo->exec("INSERT INTO orderdetails_tbl(order_id,user_id,product_id,quantity)
VALUES('','$id','$code','$num')");
        }
    }



    require 'view/insertView.php';
?>