<?php
require 'common/common.php';
// データベースに接続する
$pdo = connect();

$flg=0;

$errormessage="";

// $result初期化
$result = "";

if(isset($_POST['syusei'])) {
    // 必須項目(3個)が入力されているか
    if (!empty($_POST['newpas1']) && !empty($_POST['newpas2'])){
      //このページで入力された値を取得する
        $newpas1 = $_POST['newpas1'];
        $newpas2 = $_POST['newpas2'];
        $mail = $_GET['Mail'];
        $_SESSION['mail'] = $mail;
            if ($newpas1 == $newpas2){
                $result = 1;
                if($result == 1){
                    // セッション情報の保存
                    $_SESSION['newpas1'] = $newpas1;
                    header ('location:reset_change_idpas2.php');
                }
            }else{
                $errormessage="新しいパスワードの入力が異なっています。";
                }
        }
    }else{
        $errormessage="必須項目をすべて入力してください。";
}

if(isset($_GET['passReset'])){
  $parameters = $_GET['passReset'];
  $_SESSION['parameters'] = $parameters;
  $parameters = $_SESSION['parameters'];
  
  $st3 = $pdo->prepare("SELECT * FROM password_tbl WHERE parameters = ?");
  //bindValueメソッドでパラメータをセット
  $st3->bindValue(1,$parameters);
  
  //executeでクエリを実行
  $st3->execute();
  
  $logininfo3=$st3->fetch();
  if(empty($logininfo3)){
    echo "error";
    exit;
  }else{
    $limittime = date("Y-m-d H:i:s",strtotime("-1 minute"));
    if(strtotime($logininfo3['currenta_time']) >= ($limittime)){
      echo "成功";
    }else{
      exit;
    }
  }
  
  $st4 = $pdo->prepare("DELETE FROM password_tbl WHERE parameters = ?");
  //bindValueメソッドでパラメータをセット
  $st4->bindValue(1,$parameters);
  
  //executeでクエリを実行
  $st4->execute();
  
  }


?>
<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" href="css/change.css">
  </head>

  <body>

    <header>
      <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
    </header>


<!-- メインビジュアル -->
    <main>

    <h1 class="change">パスワードの変更</h1>
	<a>現在のパスワード、新しいパスワードを入力してください。</a><br>
	<br><a>全て必須項目です。</a>
    <form method="POST" action="">
    <div style="color:red;"><?php echo htmlspecialchars($errormessage, ENT_QUOTES); ?></div>

      <table>
        <tr>
          <td class="chan">新しいパスワード</td>
     	    <td><input type="password" name="newpas1" maxlength="20"></td>
        </tr>
        <tr>
          <td class="chan">新しいパスワード(確認用)</td>
     	    <td><input type="password" name="newpas2" maxlength="20"></td>
        </tr>
      </table>

      <div>
        <input type="submit" value="修正" class="button" name="syusei">
      </div>
    </form>
    <script>
      
    </script>
    </main>


<!-- フッター -->
    <hr>
    <footer>
      <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
    </footer>

  </body>

</html>