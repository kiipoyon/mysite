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
                if(isset($logininfo['authority'])){
                    $fff = '<a href="insert.php">出品者</a>';
                }else{
                    $fff = "";
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
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>特産横丁</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/common.css">
  <link rel="stylesheet" href="css/resetting.css">
</head>
<body>
    <!-- ヘッダー -->
    <nav class="login">
      <a href="login.php" class="login">
        <div>
            <?php
              if ($flg == 1) {
                  echo "<div><p>ようこそ".$id.'さん!</p></div>';
                  echo "<div><a href='mypage.php'>会員情報</a></div>";
                  echo "<div><a href='session_out.php'>ログアウト</a></div>";
              } else {
                  echo 'ログイン(新規登録)';
              }
              ?>
        </div>
      </a>
    </nav>

    <header>
      <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
    </header>

<p>再設定メールを送信しました。</p>

<footer>
    <div class="footer_copyright"><small>copyright © 2019 K. All rights reserved.</small></div>
  </footer>
</body>
</html>