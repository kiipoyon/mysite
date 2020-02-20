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





/* idを受け取っているかの判断 */
if (isset($_GET['iddd'])) {
    $_SESSION['syouhin'] = $_GET['iddd'];
    $iddd = $_SESSION['syouhin'];
}

if (isset($_SESSION['syouhin'])) {
    $iddd = $_SESSION['syouhin'];
}


// 商品を検索する
$sta = $pdo->query("SELECT * FROM product_tbl where $iddd = product_id");
$product_tbl = $sta->fetchAll();


// セッション情報の保存
$_SESSION['code'] = $iddd;

// セッション情報の取得
$product_id = $_SESSION['code'];


// レビュー機能
if (isset($_POST['btn_submit'])) {
    $view_name = $_POST['view_name'];
    $message = $_POST['message'];
    $star = $_POST['star'];
    if (isset ($_SESSION['roginid'])) {
        $id = $_SESSION['roginid'];
      }else{
          $id = "";
      }
    //execメソッドでクエリを実行。insert文を実行した場合挿入件数が戻り値として返る
    $count = $pdo->exec("INSERT INTO postreview_tbl(review_id,user_id,product_id,post_name,post_review,star,additional_date)
    VALUES('','$id',$product_id,'$view_name','$message','$star',now())");
    header('Location: ');
}

//表示する記事を取得するSQLを準備
$select = $pdo->prepare("SELECT * FROM postreview_tbl WHERE product_id = $iddd");
$select->execute();
$data = $select->fetchAll(PDO::FETCH_ASSOC);

//レビューの数をカウント
$selectc = ("SELECT COUNT(*) FROM postreview_tbl WHERE product_id = $iddd");

$row_count = $select->rowCount();

//レビューの星の数をカウント
$selectcs = ("SELECT SUM(star) FROM postreview_tbl WHERE product_id = $iddd");
$stmt = $pdo->prepare($selectcs); $stmt->execute();
$row = $stmt->fetchColumn();
$rowa = intval($row);

if(isset($rowa)){
    if($row_count != 0){
        $review = $rowa / $row_count;
        $reviewa = $review * 2;
        $reviewb = floor($reviewa);
        $reviewc = $reviewb/2;
    }else{
        $reviewc = 0;
    }
}



if (isset($_POST['delete'])) {
// SQL文を作成
$sql = "DELETE FROM postreview_tbl WHERE user_id = '$id' AND product_id = '$iddd'";

// クエリ実行（データを取得）
$res = $pdo->query($sql);
}
// 最初の画面を表示する
require 'view/product_detailsView.php';

?>