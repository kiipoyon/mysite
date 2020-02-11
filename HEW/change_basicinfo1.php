<?php

require 'common/common.php';

if (isset ($_SESSION['roginid'])) {
    $id = $_SESSION['roginid'];
    //画面入力のパスワードを取得する
    $password=$_SESSION["password"];
}else{
    header("Location: login.php");
    exit;
}

$errormessage="";

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
            $_SESSION['lastname'] = $lastname;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastkana'] = $lastkana;
            $_SESSION['firstkana'] = $firstkana;
            $_SESSION['year'] = $year;
            $_SESSION['month'] = $month;
            $_SESSION['day'] = $day;
            $_SESSION['mail'] = $mail;
            $_SESSION['phone'] = $phone;
            $_SESSION['zip11'] = $zip11;
            $_SESSION['addr11'] = $addr11;
            $_SESSION['address'] = $address;


            header('location:change_basicinfo2.php');

    }else{
        $errormessage="必須項目をすべて入力してください。";
    }

}else{
    //入力された値クリア
    $lastname="";
    $firstname="";
    $lastkana="";
    $firstkana="";
    $year="";
    $month="";
    $day="";
    $mail="";
    $phone="";
    $zip11="";
    $addr11="";
    $address="";
    $errormessage="";
    $name="";
    $name_read="";
    $birthday="";
    $postal_code="";
    $street_address="";
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
      <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
    </header>


<!-- メインビジュアル -->
    <main>

    <h1 class="change">基本情報の変更</h1>
	<br><a>全ての項目を入力してください。</a>
	   <div style="color:red;"><?php echo htmlspecialchars($errormessage, ENT_QUOTES); ?></div>
    <form method="POST" action="">

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
            西暦 <select name="year">
              <option value="">----</option>
              <option value="1900">1900</option>
              <option value="1901">1901</option>
              <option value="1902">1902</option>
              <option value="1903">1903</option>
              <option value="1904">1904</option>
              <option value="1905">1905</option>
              <option value="1906">1906</option>
              <option value="1907">1907</option>
              <option value="1908">1908</option>
              <option value="1909">1909</option>
              <option value="1910">1910</option>
              <option value="1911">1911</option>
              <option value="1912">1912</option>
              <option value="1913">1913</option>
              <option value="1914">1914</option>
              <option value="1915">1915</option>
              <option value="1916">1916</option>
              <option value="1917">1917</option>
              <option value="1918">1918</option>
              <option value="1919">1919</option>
              <option value="1920">1920</option>
              <option value="1921">1921</option>
              <option value="1922">1922</option>
              <option value="1923">1923</option>
              <option value="1924">1924</option>
              <option value="1925">1925</option>
              <option value="1926">1926</option>
              <option value="1927">1927</option>
              <option value="1928">1928</option>
              <option value="1929">1929</option>
              <option value="1930">1930</option>
              <option value="1931">1931</option>
              <option value="1932">1932</option>
              <option value="1933">1933</option>
              <option value="1934">1934</option>
              <option value="1935">1935</option>
              <option value="1936">1936</option>
              <option value="1937">1937</option>
              <option value="1938">1938</option>
              <option value="1939">1939</option>
              <option value="1940">1940</option>
              <option value="1941">1941</option>
              <option value="1942">1942</option>
              <option value="1943">1943</option>
              <option value="1944">1944</option>
              <option value="1945">1945</option>
              <option value="1946">1946</option>
              <option value="1947">1947</option>
              <option value="1948">1948</option>
              <option value="1949">1949</option>
              <option value="1950">1950</option>
              <option value="1951">1951</option>
              <option value="1952">1952</option>
              <option value="1953">1953</option>
              <option value="1954">1954</option>
              <option value="1955">1955</option>
              <option value="1956">1956</option>
              <option value="1957">1957</option>
              <option value="1958">1958</option>
              <option value="1959">1959</option>
              <option value="1960">1960</option>
              <option value="1961">1961</option>
              <option value="1962">1962</option>
              <option value="1963">1963</option>
              <option value="1964">1964</option>
              <option value="1965">1965</option>
              <option value="1966">1966</option>
              <option value="1967">1967</option>
              <option value="1968">1968</option>
              <option value="1969">1969</option>
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
        <input type="submit" value="次へ" class="button" name="syusei">
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