<?php
// 共通部品を呼び出す
require 'common/common.php';
// Daoを呼び出す
require 'model/Goods.php';
require 'dao/GoodsDao.php';

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
      }else{
              header("Location: login.php");
       exit;
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

            if(password_verify($password, $logininfo['password'])){
            $flg=1;
            session_regenerate_id(true); // セッションIDをふりなおす
            $_SESSION['roginid'] = $id; // ユーザーIDをセッション変数にセット
            $_SESSION['password'] = $password;
            }else{
            }

          $st2=$pdo->prepare("SELECT * FROM user_details_tbl WHERE user_id=?");
          
          //bindValueメソッドでパラメータをセット
          $st2->bindValue(1,$id);

          //executeでクエリを実行
          $st2->execute();

          $logininfo2=$st2->fetchAll();

          $st3=$pdo->prepare("SELECT * FROM credit_tbl WHERE user_id=?");
          
          //bindValueメソッドでパラメータをセット
          $st3->bindValue(1,$id);

          //executeでクエリを実行
          $st3->execute();

          $logininfo3=$st3->fetchAll();
      }

    if (isset ($_SESSION['sum'])) {
        // セッション情報の取得
        $sum = $_SESSION['sum'];
      }else{
        //買い物かごの中身が無ければ商品一覧を表示する
        header("Location: list.php");
       exit;
      }

    // カート内商品点数分繰り返す
    foreach($_SESSION['cart'] as $code => $num) {
      // 商品テーブルを検索する
      $goods_dao = new GoodsDao();
      $goods = new Goods();
      $goods = $goods_dao->getGoodsByCode($code);
  
      $goods->setNum($num);
  
      strip_tags($num);
      $rows[] = $goods;
    }


        // サブミットボタンが押された場合
        if (@$_POST['submit']) {

          $method = $_POST['method'];
          $card_no = $_POST['card_no'];
          $expiration_month = $_POST['expiration_month'];
          $expiration_year = $_POST['expiration_year'];
          $nominee = $_POST['nominee'];
          $delivery = $_POST['delivery'];
          $delivery_day = $_POST['delivery_day'];
          $delivery_time = $_POST['delivery_time'];
          //注文ID作成
          $res = null;
          $string_length = 26;
          $base_string = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',0,1,2,3,4,5,6,7,8,9];
  
          for( $i=0; $i<$string_length; $i++ ) {
              $res .= $base_string[mt_rand( 0, count($base_string)-1)];
          }
          $_SESSION["res"] = $res;

          foreach($_SESSION['cart'] as $code => $num) {
            //execメソッドでクエリを実行。insert文を実行した場合挿入件数が戻り値として返る
            $count = $pdo->exec("INSERT INTO order_tbl(order_id,product_id,method,card_no,expiration_month,expiration_year,nominee,delivery,delivery_day,delivery_time,Destination)
            VALUES('','$code','$method','$card_no','$expiration_month','$expiration_year','$nominee','$delivery','$delivery_day','$delivery_time','$res')");
            }

          foreach($_SESSION['cart'] as $code => $num) {
            //execメソッドでクエリを実行。insert文を実行した場合挿入件数が戻り値として返る
            $count1 = $pdo->exec("INSERT INTO orderdetails_tbl(order_id,user_id,product_id,quantity,order_no)
            VALUES('','$id','$code','$num','$res')");
            }
          header("Location: buyout.php");
        }

//再送信のエラーを消す
header('Expires: -1');
header('Cache-Control:');
header('Pragma:');

// 最初の画面を表示する
require 'view/creditView.php';

?>