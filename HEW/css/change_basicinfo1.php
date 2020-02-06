<?php
require 'common/common.php';

$flg=0;

$errormessage="";


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

    if(password_verify($password, $logininfo['password'])){
        $flg=1;
        session_regenerate_id(true); // セッションIDをふりなおす
        $_SESSION['roginid'] = $id; // ユーザーIDをセッション変数にセット
        $_SESSION['password'] = $password; // パスワードをセッション変数にセット

    }else{
        print '認証成功しない';
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

if(isset($_POST['syusei'])){

    if (!empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['lastkana']) && !empty($_POST['firstkana'])
        && !empty($_POST['year']) && !empty($_POST['month']) && !empty($_POST['day']) && !empty($_POST['mail'])
        && !empty($_POST['phone']) && !empty($_POST['zip11']) && !empty($_POST['addr11']) && !empty($_POST['address'])){

            //入力された値を取得
            $lastname=$_POST['lastname'];
            $firstname=$_POST['firstname'];
            $lastkana=$_POST['lastkana'];
            $firstkana=$_POST['firstkana'];
            $year=$_POST['year'];
            $month=$_POST['month'];
            $day=$_POST['day'];
            $mail=$_POST['mail'];
            $phone=$_POST['phone'];
            $zip11=$_POST['zip11'];
            $addr11=$_POST['addr11'];
            $address=$_POST['address'];

            //セッション保存
            $_SESSION['lastname'] = $_POST['lastname'];
            $_SESSION['firstname'] = $_POST['firstname'];
            $_SESSION['lastkana'] = $_POST['lastkana'];
            $_SESSION['firstkana'] = $_POST['firstkana'];
            $_SESSION['year'] = $_POST['year'];
            $_SESSION['month'] = $_POST['month'];
            $_SESSION['day'] = $_POST['day'];
            $_SESSION['mail'] = $_POST['mail'];
            $_SESSION['phone'] = $_POST['phone'];
            $_SESSION['zip11'] = $_POST['zip11'];
            $_SESSION['addr11'] = $_POST['addr11'];
            $_SESSION['address'] = $_POST['address'];

            //セッション取得
            $lastname = $_SESSION['lastname'];
            $firstname = $_SESSION['firstname'];
            $lastkana = $_SESSION['lastkana'];
            $firstkana = $_SESSION['firstkana'];
            $year = $_SESSION['year'];
            $month = $_SESSION['month'];
            $day = $_SESSION['day'];
            $mail = $_SESSION['mail'];
            $phone = $_SESSION['phone'];
            $zip11 = $_SESSION['zip11'];
            $addr11 = $_SESSION['addr11'];
            $address = $_SESSION['address'];

            header('location:change_basicinfo1.php');

    }else{
        $errormessage="必須項目をすべて入力してください。";
    }

}else{
    //入力された値クリア
}

?>
<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/change.css">
  </head>

  <body>

    <header>
      <h1><a href="index.php"><img src="images/rogo.jpg" alt="ろご"></a></h1>
    </header>


<!-- メインビジュアル -->
    <main>

    <h1 class="change">基本情報の変更</h1>
	<a>現在のパスワード、新しいパスワードを入力してください。</a><br>
	<br><a>全て必須項目です。</a>
    <form method="POST" action="">
    <div style="color:red;"><?php echo htmlspecialchars($errormessage, ENT_QUOTES); ?></div>

    <form method="post" action="change_basicinfo3.php">

      <table>
        <tr>
          <td class="regist">氏名</td>
          <td>姓　<input type="text" name="lastname" maxlength="10" size="10"> 名　<input type="text" name="firstname" maxlength="10" size="10"></td>
        </tr>

        <tr>
          <td class="regist">
            フリガナ
          </td>
          <td>セイ<input type="text" name="lastkana" maxlength="10" size="10"> メイ<input type="text" name="firstkana" maxlength="10" size="10"></td>
        </tr>

        <tr>
          <td class="regist">生年月日</td>
          <td>
            西暦 <select>
              <option value="">----</option>
              <option value="1970">1970</option>
              <option value="1971">1971</option>
              <option value="1972">1972</option>
              <option value="1973">1973</option>
              <option value="1974">1974</option>
              <option value="1975">1975</option>
              <option value="1976">1976</option>
              <option value="1977">1977</option>
              <option value="1978">1978</option>
              <option value="1979">1979</option>
              <option value="1980">1980</option>
              <option value="1981">1981</option>
              <option value="1982">1982</option>
              <option value="1983">1983</option>
              <option value="1984">1984</option>
              <option value="1985">1985</option>
              <option value="1986">1986</option>
              <option value="1987">1987</option>
              <option value="1988">1988</option>
              <option value="1989">1989</option>
              <option value="1990">1990</option>
              <option value="1991">1991</option>
              <option value="1992">1992</option>
              <option value="1993">1993</option>
              <option value="1994">1994</option>
              <option value="1995">1995</option>
              <option value="1996">1996</option>
              <option value="1997">1997</option>
              <option value="1998">1998</option>
              <option value="1999">1999</option>
              <option value="2000">2000</option>
              <option value="2001">2001</option>
              <option value="2002">2002</option>
              <option value="2003">2003</option>
              <option value="2004">2004</option>
              <option value="2005">2005</option>
              <option value="2006">2006</option>
              <option value="2007">2007</option>
              <option value="2008">2008</option>
              <option value="2009">2009</option>
              <option value="2010">2010</option>
              <option value="2011">2011</option>
              <option value="2012">2012</option>
              <option value="2013">2013</option>
              <option value="2014">2014</option>
              <option value="2015">2015</option>
              <option value="2016">2016</option>
              <option value="2017">2017</option>
              <option value="2018">2018</option>
              <option value="2019">2019</option>
            </select> 年
            <select name="month">
              <option value="">----</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select> 月
            <select name="day">
              <option value="">----</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
              <option value="17">17</option>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>
              <option value="22">22</option>
              <option value="23">23</option>
              <option value="24">24</option>
              <option value="25">25</option>
              <option value="26">26</option>
              <option value="27">27</option>
              <option value="28">28</option>
              <option value="29">29</option>
              <option value="30">30</option>
              <option value="31">31</option>
            </select> 日生
         </td>
        </tr>

        <tr>
          <td>Eメールアドレス</td>
          <td><input type="text" name="mail"></td>
        </tr>

        <tr>
          <td class="regist">電話番号</td>
          <td><input type="number" name="phone"></td>
        </tr>

        <tr>
          <td class="regist">住所</td>
          <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
          <td>
            〒<input type="text" name="zip11" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');">
            <br>
            <input type="text" name="addr11" size="60">
            <br>
            丁目・番地・マンション名等
            <br>
            <input type="text" name="address" size="50">
          </td>
        </tr>
      </table>

      <br>

      <div>
        <input type="submit" value="次へ" class="button">
        <input type="reset" value="クリア" class="button">
      </div>

    </form>

    <br>

    <a href="mypage.php">会員情報変更トップに戻る</a>

    </main>


<!-- フッター -->
    <hr>
    <footer>
      <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
    </footer>

  </body>

</html>