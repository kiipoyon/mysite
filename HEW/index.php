<?php
// 共通部品を呼び出す
require 'common/common.php';
// データベースに接続する
$pdo = connect();

$protocol = empty($_SERVER["HTTPS"]) ? "http://" : "https://";
$thisurl = $protocol . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

$flg=0;

unset($_SESSION["query"]);

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

            if(password_verify($password, $logininfo['password'])){
                $flg=1;
                session_regenerate_id(true); // セッションIDをふりなおす
                $_SESSION['roginid'] = $id; // ユーザーIDをセッション変数にセット
                $_SESSION['password'] = $password;
                if(isset($logininfo['secret_id'])){
                    //2段階認証
                    if(isset($_SESSION['secret_id'])){
                    }else{
                    header ('location:onetimea.php');
                    }
                }else{
                }
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


      //売れ筋ランキングとおすすめの表示
      $st = $pdo->query("SELECT * FROM product_tbl
                        INNER JOIN orderdetails_tbl 
                        ON product_tbl.product_id = orderdetails_tbl.product_id
                        WHERE orderdetails_tbl.order_date > current_timestamp + interval -30 day
                        group by product_tbl.product_id
                        ORDER BY SUM(orderdetails_tbl.quantity) DESC");
      $product_tbl = $st->fetchAll();

      $sta = $pdo->query("SELECT * FROM product_tbl LIMIT 10");
      $producta_tbl = $sta->fetchAll();

    // 最初の画面を表示する
    require 'view/indexView.php';

?>
