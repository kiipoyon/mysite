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
            $pdo=new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');

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
                if(!empty($logininfo['secret_id'])){
                    echo"入ってる";
                }else{
                    echo"入ってない";
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

     require_once 'PHPGangsta/GoogleAuthenticator.php';

     $ga = new PHPGangsta_GoogleAuthenticator();
     
     // ユーザーが生成したTOTP
     $oneCode = filter_input(INPUT_POST, 'oneCode');
     echo $oneCode;
     
     // サーバーとクライアントで許容する時間のずれ
     // $discrepancy × 30秒 許容します（デフォルト値は1です）
     $discrepancy = 2;
     
     // TOTPの検証
     $checkResult = $ga->verifyCode($logininfo['secret_id'], $oneCode, $discrepancy);
     if ($checkResult) {
        $_SESSION['secret_id'] = $logininfo['secret_id'];
         echo 'OK';
         header ('location:index.php');
     } else {
         echo 'FAILED';
     }


      
// 最初の画面を表示する
require 'view/onetimeaView.php';


?>