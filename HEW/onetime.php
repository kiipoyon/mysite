<?php
  // 共通部品を呼び出す
require 'common/common.php';
// Daoを呼び出す
require 'model/Goods.php';
require 'dao/GoodsDao.php';

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
       
       if (isset ($_SESSION['roginid'])) {
        $id = $_SESSION['roginid'];
        //画面入力のパスワードを取得する
        $password=$_SESSION["password"];
      }

  	 //IDとパスワードが一致しているか確認する
  	 if(!empty($id) && !empty($password)){

        
            //データベースに接続する
            $pdo = connect();

            //ログイン情報を検索し、検索結果をステートメントに設定する($loginidはPOSTで持ってきたもの) ここをprepareにする
            $st=$pdo->prepare("SELECT * FROM user_tbl WHERE user_id=?");

            $lo = $pdo->prepare("SELECT * FROM user_details_tbl WHERE user_id=?");

            //bindValueメソッドでパラメータをセット
            $st->bindValue(1,$id);

            //bindValueメソッドでパラメータをセット
            $lo->bindValue(1,$id);

            //executeでクエリを実行
            $st->execute();

            //executeでクエリを実行
            $lo->execute();

            //処理結果を配列logininfoに設定する loginidが主キーならこの処理はいらない
            $logininfo=$st->fetch();

            //処理結果を配列logininfoに設定する loginidが主キーならこの処理はいらない
            $loginin=$lo->fetch();
     }


     //2段階認証
      require_once 'PHPGangsta/GoogleAuthenticator.php';

      $ga = new PHPGangsta_GoogleAuthenticator();

      // 秘密鍵の生成
      $secret = $ga->createSecret();

      // サービス名
      $title = 'tokusan';

      // ユーザー名
      $name = $id;

      // QRコードURLの生成と表示
      $qrCodeUrl = $ga->getQRCodeGoogleUrl($name, $secret, $title);

      //ユーザテーブル秘密鍵insert
      $sql = 'UPDATE user_tbl SET secret_id=:secret_id WHERE user_id=:id';
      $stmt = $pdo -> prepare($sql);
      $stmt->bindParam(':secret_id',$secret,PDO::PARAM_STR);
      $stmt->bindParam(':id',$id,PDO::PARAM_STR);

      $stmt->execute();


      // 変数とタイムゾーンを初期化
      $auto_reply_subject = null;
      $auto_reply_text = null;
      date_default_timezone_set('Asia/Tokyo');

      // 件名を設定
      $auto_reply_subject = '2段階認証の設定を実行しました。';

      // 本文を設定
      $auto_reply_text = "下記の内容で2段階認証の登録を受け付けました。\n\n";
      $auto_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
      $auto_reply_text .= $qrCodeUrl . "\n";
      $auto_reply_text .= "あなたのユーザーID：" . $id . "\n";
      $auto_reply_text .= "メールアドレス：" . $loginin['mail_address'] . "\n\n";
      $auto_reply_text .= "特産横丁";

      // メール送信
      mb_send_mail("k.ishimaru0821@gmail.com", $auto_reply_subject, $auto_reply_text);
      
// 最初の画面を表示する
require 'view/onetimeView.php';


?>