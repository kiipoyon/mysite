<?php
if (empty($errorMessage)){
    $errorMessage = "";
}

if (empty($msg)){
    $msg = "";
}

require 'common/common.php';

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

/* $flag = "";
 if (empty($flag=htmlspecialchars($_POST["flag"]))){
 $image = htmlspecialchars($_POST["image"]);
 unlink('upload/'.$image);
 } */
?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/request1.css">
    <script src = "js/request.js" type = "text/javascript">
    </script>
<style type="text/css">
  /* タブっぽく並べて */
  #tabs ul {overflow:hidden; height:2em; list-style:none; border-bottom:1px solid #cccccc;}
  #tabs li {float:left; display:inline; margin-left:10px; padding:5px; border:1px solid #ccc; border-bottom:none; border-radius:10px 10px 0 0;}
  /* 最初はパネルは非表示 */
  #tabs .panel {display:none;}
</style>
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
$(function() {
  $('#tabs a[href^="#panel"]').click(function(){
    $("#tabs .panel").hide();
    $(this.hash).fadeIn();
    return false;
  });
  $('#tabs a[href^="#panel"]:eq(0)').trigger('click');
})
</script>
  </head>

  <body>
<!-- ヘッダー -->
<nav class="login">
    <a href="login.php" class="login">
    	<?php
         if ($flg == 1) {
             echo "<a href='mypage.php' class='login-name'>ようこそ".$id.'さん!</a>';
             echo "<a href='mypage.php' class='login-name'>会員情報</a>";
             echo "<a href='session_out.php' class='login-name'>ログアウト</a>";
         } else {
             echo 'ログイン(新規登録)';
         }
        ?>
    </a>
  </nav>
  <header>
    <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
<!-- グローバルナビゲーション -->
    <ul class="menu">
      <li class="menu__single">
        <a href="index.php" class="init-bottom">トップページへ</a>
      </li>
      <li class="menu__single">
        <a href="mypage.php#tobe2" class="init-bottom">購入履歴</a>
      </li>
      <li class="menu__single">
        <a href="mypage.php#tobe1" class="init-bottom">会員情報変更</a>
      </li>
      <li class="menu__single">
        <a href="buy.php" class="init-bottom">買い物かごを見る</a>
      </li>
      <li class="menu__single">
        <a href="request.php" class="init-bottom">お問い合わせをする</a>
      </li>
    </ul>

  </header>

<!-- メインビジュアル -->
<main>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/mailaddress.js"></script>
<script>
$(document).ready(function(){
  $(".request_email").emailautocomplete({ //補完機能をつけたい箇所を指定
    domains: ["yahoo.co.jp", "gmail.com", "gmail.com", "ezweb.ne.jp", "au.com", "docomo.ne.jp", "i.softbank.jp", "softbank.ne.jp", "excite.co.jp", "googlemail.com", "hotmail.com", "icloud.com", "live.jp", "me.com", "mineo.jp", "nifty.com", "outlook.com", "outlook.jp", "yahoo.ne.jp", "ybb.ne.jp", "ymobile.ne.jp", ] //補完機能に追加したいドメインを記述
  });
});
</script>

<div id="tabs">
  <ul>
    <li><a href="#panel1">リクエスト</a></li>
    <li><a href="#panel2">お問い合わせ</a></li>
  </ul>

  <div id="panel1" class="panel">
    <h1 class="request">リクエスト</h1>
    <p class="main">
      特産横丁のWebページに新しく掲載してほしい商品をリクエストするフォームです。下記に必要事項を入力の上、送信してください。<br>
      リクエストのあった商品は生産者・生産会社にお問い合わせ・協議の結果、掲載されない場合がございます。<br>
      また、リクエストから回答までお時間をいただく場合がございます。あらかじめご了承の上、リクエストをお願いします。<br>
      リクエストの結果はお客様のメールアドレス宛に送信させていただきます。<br>
      <span style="color:red;">＊</span>は必須項目です
    </p>

    <form action="confirmation.php" method="post" enctype="multipart/form-data" onsubmit="return requestCheck()">

      <table class="request">
        <tr>
          <td rowspan="3" class="r_first">リクエスト内容</td>
          <td class="r_second"><span>＊</span>商品名</td>
          <td class="r_third"><input type="text" id="r_t1" name="product"></td>
          <td class="r_fourth"><span id="r_msg1"></span></td>
        </tr>
        <tr>
          <td class="r_second">
            <span>＊</span>生産者<br>
            （生産会社）
          </td>
          <td class="r_third"><input type="text" id="r_t2" name="company"></td>
          <td class="r_fourth"><span id="r_msg2"></span></td>
        </tr>
        <tr>
          <td class="r_second">商品画像</td>
          <td class="r_third"><input type="file" name="image"></td>
          <td class="r_fourth"><span id="r_msg3"></span></td>
        </tr>
        <tr>
          <td rowspan="4" class="r_first"><span>＊</span>お名前</td>
          <td class="r_second"><span>＊</span>姓　：</td>
          <td class="r_third"><input type="text" id="r_t4" name="sei"></td>
          <td class="r_fourth"><span id="r_msg4"></span></td>
        </tr>
        <tr>
          <td class="r_second"><span>＊</span>名　：</td>
          <td class="r_third"><input type="text" id="r_t5" name="mei"></td>
          <td class="r_fourth"><span id="r_msg5"></span></td>
        </tr>
        <tr>
          <td class="r_second"><span>＊</span>セイ：</td>
          <td class="r_third"><input type="text" id="r_t6" name="k_sei"></td>
          <td class="r_fourth"><span id="r_msg6"></span></td>
        </tr>
        <tr>
          <td class="r_second"><span>＊</span>メイ：</td>
          <td class="r_third"><input type="text" id="r_t7" name="k_mei"></td>
          <td class="r_fourth"><span id="r_msg7"></span></td>
        </tr>
        <tr>
          <td class="r_first"><span>＊</span>メールアドレス</td>
          <td colspan="2" class="r_connect"><input type="email" id="r_t8" class="request_email" name="mail" placeholder="tokusan@email.com"></td>
          <td class="r_fourth"><span id="r_msg8"></span></td>
        </tr>
        <tr>
          <td class="r_first">その他</td>
          <td colspan="2" class="r_connect"><textarea class="request_other" id="r_t9" name="other"></textarea></td>
          <td class="r_fourth"><span id="r_msg9"></span></td>
        </tr>
        <tr>
          <td colspan="4" class="button">
            <input type="submit" name="submit" value="確認" class="kakunin">
            <input type="reset" class="reset">
          </td>
        </tr>
      </table>
    </form>
  </div>

  <div id="panel2" class="panel">
    <h1 class="request">お問い合わせ</h1>
    <p class="main">
      特産横丁に関するご意見・ご質問・ご提案などを承るお問い合わせフォームです。下記に必要事項をご入力のうえ、送信してください。<br>
      お問い合わせの内容により、返信させていただくまでにお時間を頂戴する場合や返信いたしかねる場合、お電話・お手紙を差し上げる場合などもございます。あらかじめご了承ください。<br>
      <span style="color:red;">＊</span>は必須項目です
    </p>

    <form action="confirmation2.php" method="post" onsubmit="return inquiryCheck()">

      <table class="inquiry">
        <tr>
          <td class="i_first"><span>＊</span>お問い合わせ内容</td>
          <td colspan="2" class="i_connect"><textarea class="inquiry_other" id="i_t1" name="content"></textarea></td>
          <td class="r_fourth"><span id="i_msg1"></span></td>
        </tr>
        <tr>
          <td rowspan="4" class="i_first"><span>＊</span>お名前</td>
          <td class="i_second"><span>＊</span>姓　：</td>
          <td class="i_third"><input type="text" id="i_t2" name="sei"></td>
          <td class="i_fourth"><span id="i_msg2"></span></td>
        </tr>
        <tr>
          <td class="i_second"><span>＊</span>名　：</td>
          <td class="i_third"><input type="text" id="i_t3" name="mei"></td>
          <td class="i_fourth"><span id="i_msg3"></span></td>
        </tr>
        <tr>
          <td class="i_second"><span>＊</span>セイ：</td>
          <td class="i_third"><input type="text" id="i_t4" name="k_sei"></td>
          <td class="i_fourth"><span id="i_msg4"></span></td>
        </tr>
        <tr>
          <td class="i_second"><span>＊</span>メイ：</td>
          <td class="i_third"><input type="text" id="i_t5" name="k_mei"></td>
          <td class="i_fourth"><span id="i_msg5"></span></td>
        </tr>
        <tr>
          <td class="i_first"><span>＊</span>メールアドレス</td>
          <td colspan="2" class="i_connect"><input type="email" id="i_t6" class="request_email" name="mail" placeholder="tokusan@email.com"></td>
          <td class="i_fourth"><span id="i_msg6"></span></td>
        </tr>
        <tr>
          <td colspan="4" class="button">
            <input type="submit" name="submit" value="確認" class="kakunin">
            <input type="reset" class="reset">
          </td>
        </tr>
      </table>
    </form>

  </div>


</div>
</main>


<!-- フッター -->
<hr>
  <footer>
    <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
  </footer>

  </body>

</html>