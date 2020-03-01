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

          $st2=$pdo->prepare("SELECT name FROM user_details_tbl WHERE user_id=?");
          //bindValueメソッドでパラメータをセット
          $st2->bindValue(1,$id);
          //executeでクエリを実行
          $st2->execute();
          $logininfo2=$st2->fetchAll();

          foreach($logininfo2 as $login2){
              $name=$login2['name'];
          }
      }

    // 一覧の初期化
    $rows = array();
    // 合計値を初期化
    $sum = 0;

    // セッションを初期化する
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = array();
    // サブミットボタンが押された場合
    if (@$_POST['submit']) {
        @$_SESSION['cart'][$_POST['code']] += $_POST['num'];
    }

    	// 削除するボタンを押した場合
	if(isset($_POST['deletebtn'])) {
		// チェックボックスにチェックを入れた場合
		if(isset($_POST['checkbox'])) {
			// チェックボックスをチェックした数分繰り返す
			foreach($_POST['checkbox'] as $chkkey => $chkval) {
                // チェックした配列を削除する。
                unset($_SESSION['cart'][$chkval]);
			}
        }

    }

    // カート内商品点数分繰り返す
    foreach($_SESSION['cart'] as $code => $num) {
    // 商品テーブルを検索する
    if(isset($_POST['amount'])){
        $fgt = $_POST['amount'];
        echo $fgt;
        $num = $fgt;
    }
    
    $goods_dao = new GoodsDao();
    $goods = new Goods();
    $goods = $goods_dao->getGoodsByCode($code);

    $goods->setNum($num);

    strip_tags($num);
    $sum += $num * $goods->getPrice();
    $rows[] = $goods;

    // セッション情報の保存
    $_SESSION['sum'] = $sum;
    // セッション情報の取得
    $sum = $_SESSION['sum'];
    }

    if (!empty ($_SESSION['cart'])) {
        $cart = "";
      }else{
        $cart = "カートが空です";
      }

// 最初の画面を表示する
require 'view/buyView.php';

?>