<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common85033.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
  </head>

  <body>
<!-- ヘッダー -->

  <header>
    <h1><a href="index.html"><img src="images/rogo.jpg" alt="ろご"></a></h1>

<!-- グローバルナビゲーション -->

  </header>


<!-- ―――――――――――――――――――――――――――――― -->
<br>

<table class="sample">
  <tr>
    <td>
<!-- ――――――――――左側テーブルの中身にあたります―――――――――― -->
<h1 class="credit">お支払方法の選択</h1>
<table class="credit">
  <tr>
    <td>
        <h1 class="credith1">お支払方法</h1>
<!-- ――――――――――――――――――――左側テーブル内テーブル１―――――――――――――――――――― -->
      <form action="buyout.php" method="POST">
      <table class="creditcard">
        <tr>
          <td colspan="2">
            <div class="hurikomi">
              <label>
                <input type="radio" name="method" value="クレジットカード" checked>
                クレジットカード
              </label>
            </div>
          </td>
          <td> <img class="c_logo" src="images/logo_visa.png" alt="visaのロゴ"> </td>
          <td> <img class="c_logo" src="images/logo_master.png" alt="mastercardのロゴ"> </td>
          <td> <img class="c_logo" src="images/logo_jcb2.png" alt="jcbのロゴ"> </td>
        </tr>
      </table>


<!-- ――――――――――――――――――――左側テーブル内テーブル２―――――――――――――――――――― -->
      <table class="creditinfo">
        <tr>
          <td><p>カード番号</p>
          <input type="text" id="disable1" class="input_num" name="card_no" placeholder="0000 0000 0000 0000"></td>
          <td><p>　有効期限</p>
      <label>
        <select id="disable2" name="expiration_month" class="input_mon">
          <option value="月">月
          <option value="1">1
          <option value="2">2
          <option value="3">3
          <option value="4">4
          <option value="5">5
          <option value="6">6
          <option value="7">7
          <option value="8">8
          <option value="9">9
          <option value="10">10
          <option value="11">11
          <option value="12">12
        </select>
      </label>
      <label>
        <select id="disable3" name="expiration_year" class="input_year">
          <option value="年">年
          <option value="2019">2019
          <option value="2020">2020
          <option value="2021">2021
          <option value="2022">2022
          <option value="2023">2023
          <option value="2024">2024
          <option value="2025">2025
          <option value="2026">2026
          <option value="2027">2027
          <option value="2028">2028
          <option value="2029">2029
          <option value="2030">2030
          <option value="2031">2031
          <option value="2032">2032
          <option value="2033">2033
          <option value="2034">2034
          <option value="2035">2035
          <option value="2036">2036
          <option value="2037">2037
          <option value="2038">2038
          </select>
        </label>
        </td>
        </tr>
        <tr>
          <td colspan="2">
            <p>カードに記載された名前</p>
        <div><input type="text" id="disable4" class="input_name" name="nominee" placeholder="TARO TOKUSAN"></div>
          </td>
        </tr>
        </table>
      <input type="button" id="disable5"  class="card" value="カード情報の追加"><br>
<!-- ――――――――――――――――――――左側テーブル内テーブル３―――――――――――――――――――― -->
      <table class="creditcard">
        <tr>
          <td>
            <div class="hurikomi">
              <label>
                <input type="radio" name="method" value="銀行振込">
                銀行振込
              </label>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="hurikomi">
              <label>
                <input type="radio" name="method" value="コンビニ・郵便局等">
                コンビニ・郵便局等
              </label>
            </div>
          </td>
        </tr>
      </table>

    </td>
  </tr>
</table>
<!-- ――――――――――――――――――――――――――――――――――――――――――― -->
    </td>
    <td>
<!-- ――――――――――中央テーブルの中身にあたります―――――――――― -->
<h1 class="credit">配送方法とお届け日時の選択</h1>
<table class="credit">
  <tr>
    <td>
      <h1 class="credith1">配送方法</h1>
      <table class="creditinfo">
        <tr>
          <td>
            <div class="hurikomi">
              <label>
                <input type="radio" name="delivery" value="宅配便" checked>
                宅配便
              </label>
            </div>
          </td>
          <td><p><font class="haisou_free">送料無料</font></p></td>
        </tr>
        <tr>
          <td>
            <div class="hurikomi">
            <label>
            <input type="radio" name="delivery" value="コンビニ受取">
            コンビニ受取
            </label>
          </div>
          </td>
          <td><p><font class="haisou_free">送料無料</font></p></td>
        </tr>
      </table>


      <table class="credit2">
        <tr>
          <td><h1 class="credith1">お届け日時</h1></td>
        </tr>
        <tr>
          <td>
            <table class="creditinfo">
              <tr>
                <td>
                  <label>
                    <select name="delivery_day" class="input_2">
                      <option value="指定なし">指定なし</option>
                      <option value="1日後">1日後</option>
                      <option value="2日後">2日後</option>
                      <option value="3日後">3日後</option>
                      <option value="4日後">4日後</option>
                      <option value="5日後">5日後</option>
                      <option value="6日後">6日後</option>
                      <option value="7日後">7日後</option>
                    </select>
                  </label>
                </td>
                <td>
                  <label>
                    <select name="delivery_time" class="input_2">
                      <option value="指定なし">指定なし</option>
                      <option value="午前中">午前中</option>
                      <option value="12~14">12:00-14:00</option>
                      <option value="14~16">14:00-16:00</option>
                      <option value="16~18">16:00-18:00</option>
                      <option value="18~20">18:00-20:00</option>
                      <option value="20~22">20:00-22:00</option>
                    </select>
                  </label>
                </td>
                </tr>
              </table>
          </td>
        </tr>
        <tr>
          <td>
  <tr>
    <td>
      <h1 class="credith1">送付先</h1>
        <p id="jyuusyo" class="addtext">
          <div class="text01">
          〒450-0002<br>
          愛知県名古屋市中村区<br>
          名駅4丁目27-1<br>
          総合校舎スパイラルタワーズ
          </div>
        </p>
        <p id="jyuusyo" class="addtext">
          <div class="text02">
          〒450-0002<br>
          愛知県名古屋市中村区<br>
          名駅４丁目２７−１<br>
          ファミリーマート内
          </div>
        </p>
        <input class="addtext" type="button" value="変更">
        <hr>
    </td>
  </tr>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<!-- ――――――――――――――――――――――――――――――――――――――――――― -->
    </td>
    <td>
<!-- ――――――――――右側テーブルの中身にあたります―――――――――― -->
<h1 class="credit">送付先とご注文商品の確認</h1>
<table class="credit">

  <tr>
    <td>
      <h1 class="credith1">ご注文商品</h1>
      <div class="scroll">
            <?php foreach($rows as $r) { ?>
              <div class="scroll_d">
                <div class="scroll_d1">
                  <img class="gazou" src="images/<?php echo $r->getId() ?>.jpg">
                </div>
                <div class="scroll_d2">
                  <p><?php echo $r->getName() ?></p>
                  <p>数量 <?php echo $r->getNum() ?> 個</p>
                  <p><?php echo $r->getPrice() * $r->getNum() ?> 円</p>
                </div>
              </div>
                <hr>
            <?php } ?>
      </div>
      <div class="kaikei"><p>合計 <?php echo $sum ?> 円 </p></div>
      <div class="submit_iti">
        <input class="submit" type="submit" name="submit" value="購入する">
      </div>
</form>
    </td>
  </tr>
</table>
<!-- ――――――――――――――――――――――――――――――――――――――――――― -->
</td>
</tr>
</table>
<br>

<a href="list.php">お買い物に戻る</a>

<hr>
  <footer>
    <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
  </footer>


  </body>

</html>