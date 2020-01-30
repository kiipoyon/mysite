<?php
//COPYRIGHT="All Rights Reserved. Copyright 2019 (C) HAL.AC.JP"
//
/*
 * ファイル名　　：　list.php
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

            // セッション情報の取得
            $password = $_SESSION['password'];

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

          $_SESSION['roginid'] = $id; // ユーザーIDをセッション変数にセット

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
              if($login['password']==$password){
                  //一致した場合、成功した（ログイン成功フラグ＝１）と設定する
                  $flg=1;
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




// idを受け取っているかの判断
if (isset($_GET['idd'])) {
    $idd = $_GET['idd'];
    $area = "";

if ($idd == 1) {
    $area = "北海道";
}elseif($idd == 2){
    $area = "東北";
}elseif($idd == 3){
    $area = "関東";
}elseif($idd == 4){
    $area = "中部";
}elseif($idd == 5){
    $area = "関西";
}elseif($idd == 6){
    $area = "中国・四国";
}else{
    $area = "九州・沖縄";
}

// 商品を検索する
    $sta = $pdo->query("SELECT * FROM product_tbl WHERE region = $idd");
    $product_tbl = $sta->fetchAll();

    var_dump($sta);

}elseif (isset($_GET['categoly'])) {
    $categoly = $_GET['categoly'];
    $area = "";

if($categoly == 1){
    $area = "海鮮・水産加工品";
}elseif($categoly == 2){
    $area = "肉・ハム";
}elseif($categoly == 3){
    $area = "野菜";
}elseif($categoly == 4){
    $area = "乳製品";
}elseif($categoly == 5){
    $area = "果物";
}else{
    $area = "日本酒・ワイン・酒";
}

// 商品を検索する
$sta = $pdo->query("SELECT * FROM product_tbl WHERE $categoly = categoly");
$product_tbl = $sta->fetchAll();



}else{
    //詳細検索をする
    //クエリの生成
    $query = "SELECT * FROM product_tbl";
    $area = "検索結果";
    $where ="";
    //ジャンルで検索
    if(!empty($_POST["genre"])){
        $genre = $_POST["genre"];
        var_dump($genre);
        $where .= " categoly = '$genre' AND";
    }
    //キーワードで検索
    if(!empty($_POST["keyword"])){
        $keyword = $_POST["keyword"];
        $where .= " product_name LIKE '%$keyword%' AND";
    }
    //価格で検索
    if(!empty($_POST["mini"])){
        $mini = $_POST["mini"];
        $where .= " price >='$mini' AND";
    }
    if(!empty($_POST["max"])){
        $max = $_POST["max"];
        $where .= " price <='$max'  AND";
    }
    //最後のANDがあった場合は削除
    $where = rtrim($where, 'AND'); 

    //$whereの中身がある場合は$queryにWHEREを付けて追加する。
    if(!empty($where)) {
        $query .= " WHERE";
        $query .= " $where ";
    }



    //sortを指定
    if(!empty($_POST["sort"])){
        $sort = $_POST["sort"];
        if($sort == "cheap_price"){
            print $sort;
            $sort1 = "price";
            $query = rtrim($query, 'WHERE');
            $query .= " ORDER BY ";
            $query .= " $sort1 ";
            $query .= " ASC";
        }elseif($sort == "high_price"){
            print $sort;
            $sort1 = "price";
            $query = rtrim($query, 'WHERE');
            $query .= " ORDER BY ";
            $query .= " $sort1 ";
            $query .= " DESC";
        }else{
        print $sort;
        $query = rtrim($query, 'WHERE');
        $query .= " ORDER BY ";
        $query .= " $sort ";
        $query .= " DESC";
        }
    }
    // SQL文の最後
    $query .= ';';

    // 詳しい情報の表示
    //最後削除
    var_dump($query);

    $sta = $pdo->query($query);
    $product_tbl = $sta->fetchAll();
}

if($sta != ""){
  print "all";
}







// 最初の画面を表示する
require 'view/listView.php';

?>