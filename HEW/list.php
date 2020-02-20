<?php
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
            $pdo = connect();

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
            if(password_verify($password, $logininfo['password'])){
            $flg=1;
            session_regenerate_id(true); // セッションIDをふりなおす
            $_SESSION['roginid'] = $id; // ユーザーIDをセッション変数にセット
            $_SESSION['password'] = $password;
            }else{
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

    //一ページに表示する記事の数をmax_viewに定数として定義
    define('max_view',9);

if(isset($_GET['idd'])){
    $idd = $_GET['idd'];
    echo $idd;
    //地図から検索
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

        //商品を検索する
        //基本の構文
        $sta = $pdo->query("SELECT * FROM product_tbl WHERE region = $idd");
        //$product_tbl = $sta->fetchAll();
        $sta = " WHERE region = $idd ";

        //sql文をセッションに入れる
        $_SESSION['sql'] = $sta;


}



if(isset($_POST['hogehoge_status'])){
    $idd = $_POST['hogehoge_status'];
    $area = "";
    unset($_SESSION["query"]);

//地図から検索
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

    //商品を検索する
    //基本の構文
    $sta = $pdo->query("SELECT * FROM product_tbl WHERE region = $idd");
    //$product_tbl = $sta->fetchAll();
    $sta = " WHERE region = $idd ";

    //sql文をセッションに入れる
    $_SESSION['sql'] = $sta;






//カテゴリーを検索
}elseif (isset($_POST['categoly'])) {
    $categoly = $_POST['categoly'];
    $area = "";
    unset($_SESSION["query"]);

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
}elseif($categoly == 6){
    $area = "日本酒・ワイン・酒";
}else{
    $area = "加工品";
}

    // 商品を検索する
    //基本の構文
    $sta = $pdo->query("SELECT * FROM product_tbl WHERE $categoly = categoly");
    //$product_tbl = $sta->fetchAll();

    $sta = " WHERE $categoly = categoly ";

    //sql文をセッションに入れる
    $_SESSION['sql'] = $sta;

}elseif (isset($_POST['submit'])){
    //詳細検索をする
    $area = "検索結果";
    $sta = "";
    //ジャンルで検索
    if(!empty($_POST["genre"])){
        $genre = $_POST["genre"];
        $sta .= " categoly = '$genre' AND";
    }
    //キーワードで検索
    if(!empty($_POST["keyword"])){
        $keyword = $_POST["keyword"];
        $sta .= " product_name LIKE '%$keyword%' AND";
    }
    //価格で検索
    if(!empty($_POST["mini"])){
        $mini = $_POST["mini"];
        $sta .= " price >='$mini' AND";
    }
    if(!empty($_POST["max"])){
        $max = $_POST["max"];
        $sta .= " price <='$max' AND";
    }


    if(!empty($sta)){
        //最後のANDがあった場合は削除
        $sta = rtrim($sta, 'AND');
        $where = " WHERE";
        $where .= $sta;
        $sta = $where;
        //sql文をセッションに入れる
        $_SESSION['sql'] = $sta;
    }else{
        $_SESSION['sql'] = $sta;
    }
//sortを指定
}elseif(!empty($_POST["sort"])){
    if (isset ($_SESSION['sql'])) {
        $sta = $_SESSION['sql'];
        var_dump($sta);
      }
    $sort = $_POST["sort"];
    if($sort == "cheap_price"){
        $sort1 = "price";
        $query = " ORDER BY ";
        $query .= " $sort1 ";
        $query .= " ASC";
        $_SESSION['query'] = $query;
        var_dump($query);
    }elseif($sort == "high_price"){
        $sort1 = "price";
        $query = " ORDER BY ";
        $query .= " $sort1 ";
        $query .= " DESC";
        $_SESSION['query'] = $query;
        var_dump($query);
    }elseif($sort == "additional_date"){
        $sort1 = "additional_date";
        $query = " ORDER BY ";
        $query .= " $sort1 ";
        $query .= " DESC";
        $_SESSION['query'] = $query;
        var_dump($query);
    }
}else{
    $sta = "";
}
        if(isset($_SESSION['sql'])){
            $sta = $_SESSION['sql'];
        }

        if(isset($_SESSION['query'])){
            $query = $_SESSION['query'];
            $sta .= $query;
        }

        //必要なページ数を求める
        $count = "SELECT COUNT(*) AS count FROM product_tbl";
        $count .= $sta;
        $count = $pdo->prepare($count);
        $count->execute();

        $total_count = $count->fetch(PDO::FETCH_ASSOC);
        $total = intval($total_count);
        $pages = ceil($total_count['count'] / max_view);

        //現在いるページのページ番号を取得
        if(!isset($_GET['page_id'])){ 
            $now = 1;
        }else{
            $now = $_GET['page_id'];
        }

        //基本構文
        $def = "SELECT * FROM product_tbl ";
        $def .= $sta;
        $def .= " LIMIT :start,:max ";
        //表示する記事を取得するSQLを準備
        $select = $pdo->prepare($def);

        if ($now == 1){
        //1ページ目の処理
                $select->bindValue(":start",$now -1,PDO::PARAM_INT);
                $select->bindValue(":max",max_view,PDO::PARAM_INT);
            } else {
        //1ページ目以外の処理
                $select->bindValue(":start",($now -1 ) * max_view,PDO::PARAM_INT);
                $select->bindValue(":max",max_view,PDO::PARAM_INT);
            }
        //実行し結果を取り出しておく
            $select->execute();
            $data = $select->fetchAll(PDO::FETCH_ASSOC);


// 最初の画面を表示する
require 'view/listView.php';

?>