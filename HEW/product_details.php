<?php
//COPYRIGHT="All Rights Reserved. Copyright 2019 (C) HAL.AC.JP"
//
/*
 * ショッピングカート
 *
 * ファイル名　　：　index.php
 * ファイル説明　：　初期処理
 * 　　　　　　　　　
 * 更新履歴		更新日	  担当者	内容
 *　1.0.0	 2019/05/01	  HAL石丸	新規作成
 *
 */



// 共通部品を呼び出す
require 'common/common.php';
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

      if ($_SESSION['roginid'] ) {
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

          //bindValueメソッドでパラメータをセット
          $st->bindValue(1,$id);

          //executeでクエリを実行
          $st->execute();

          //処理結果を配列logininfoに設定する loginidが主キーならこの処理はいらない
          $logininfo=$st->fetchAll();

          //ログイン成功フラグを初期化する（ログイン成功フラグ＝０にする）
          $flg=0;
          //パスワードが一致しているかどうかチェックする
          foreach($logininfo as $login){
              //ログイン情報のパスワードと画面入力したパスワードが一致しているか比較する
              if($login['password'] == $password){
                  //一致した場合、成功した（ログイン成功フラグ＝１）と設定する
                  $flg = 1;
                session_regenerate_id(true); // セッションIDをふりなおす
                $_SESSION['roginid'] = $id; // ユーザーIDをセッション変数にセット
                $_SESSION['password'] = $password;
                echo 'ログインしました！';
              }
          }

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







/* idを受け取っているかの判断 */
if (isset($_GET['iddd'])) {
    $iddd = $_GET['iddd'];
}

// 商品を検索する
$sta = $pdo->query("SELECT * FROM product_tbl where $iddd = product_id");
$product_tbl = $sta->fetchAll();


// セッション情報の保存
$_SESSION['code'] = $iddd;

// セッション情報の取得
$product_id = $_SESSION['code'];

// 最初の画面を表示する
require 'view/product_detailsView.php';

?>