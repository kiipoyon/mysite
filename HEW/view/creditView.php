<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>特産横丁</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/common.css">
  <link rel="stylesheet" href="css/credit.css">
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
              ?> </div>
    </a>
  </nav>
  <header>
    <h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
    <!-- グローバルナビゲーション -->
  </header>
  <div class="table">
    <div class="table_flex1">
        <!-- ――――――――――左側テーブルの中身にあたります―――――――――― -->
        <h1 class="credit">お支払方法の選択</h1>
        <table class="credit">
          <tr>
            <td>
              <h1 class="credith1">お支払方法</h1>
              <!-- ――――――――――――――――――――左側テーブル内テーブル１―――――――――――――――――――― -->
              <form action="" method="POST">
                    <div class="hurikomi1">
                      <label>
                        <input type="radio" name="method" value="クレジットカード" checked>クレジットカード
                      </label>
                    <img class="c_logo" src="images/logo_visa.png" alt="visaのロゴ">
                    <img class="c_logo" src="images/logo_master.png" alt="mastercardのロゴ">
                    <img class="c_logo" src="images/logo_jcb2.png" alt="jcbのロゴ">
                    </div>
                <!-- ――――――――――――――――――――左側テーブル内テーブル２―――――――――――――――――――― -->
                <table class="creditinfo">
                  <?php foreach ($logininfo3 as $g) { ?>
                  <tr>
                    <td>
                      <?php
                        $get = substr(($g['expiration_date']),2);
                        $left = substr(($g['expiration_date']),0,2);
                      ?>
                    </td>
                    <td>
                      <p>カード番号</p> <input type="text" id="disable1" class="input_num" name="card_no" placeholder="0000 0000 0000 0000" value="<?php echo($g['credit_number']) ?>"></td>
                    <td>
                      <p>有効期限</p>
                      <div style="display:inline-flex"> <input type="text" id="disable2" class="input_mon" name="expiration_month" placeholder="年" value="<?php print($get) ?>"> <input type="text" id="disable3" class="input_year" name="expiration_year" placeholder="月" value="<?php print($left); ?>"> </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <p>カードに記載された名前</p>
                      <div><input type="text" id="disable4" class="input_name" name="nominee" placeholder="TARO TOKUSAN" value="<?php echo($g['nominee'])?>"></div>
                    </td>
                  </tr>
                  <?php } ?> </table>
                <!-- ――――――――――――――――――――左側テーブル内テーブル３―――――――――――――――――――― -->
                <table class="creditcard">
                  <tr>
                    <td>
                      <div class="hurikomi"> 
                        <label>
                          <input type="radio" name="method" value="銀行振込">銀行振込
                        </label>
                      </div>
                    </td>
                  </tr>
                </table>
            </td>
          </tr>
        </table>
      </div>
        <!-- ――――――――――――――――――――――――――――――――――――――――――― -->
        <!-- ――――――――――中央テーブルの中身にあたります―――――――――― -->
      <div class="table_flex2">
        <h1 class="credit">配送方法とお届け日時の選択</h1>
        <table class="credit">
          <tr>
            <td>
              <h1 class="credith1">配送方法</h1>
              <table class="creditinfo">
                <tr>
                  <td>
                    <div class="hurikomi"> <label>
                <input type="radio" name="delivery" value="宅配便" checked>
                宅配便
              </label> </div>
                  </td>
                  <td>
                    <p>
                      <font class="haisou_free">送料無料</font>
                    </p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="hurikomi"> <label>
            <input type="radio" name="delivery" value="コンビニ受取">
            コンビニ受取
            </label> </div>
                  </td>
                  <td>
                    <p>
                      <font class="haisou_free">送料無料</font>
                    </p>
                  </td>
                </tr>
              </table>
              <table class="credit2">
                <tr>
                  <td>
                    <h1 class="credith1">お届け日時</h1>
                  </td>
                </tr>
                <tr>
                  <td>
                    <table class="creditinfo">
                      <tr>
                        <td> <label>
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
                  </label> </td>
                        <td> <label>
                    <select name="delivery_time" class="input_2">
                      <option value="指定なし">指定なし</option>
                      <option value="午前中">午前中</option>
                      <option value="12~14">12:00-14:00</option>
                      <option value="14~16">14:00-16:00</option>
                      <option value="16~18">16:00-18:00</option>
                      <option value="18~20">18:00-20:00</option>
                      <option value="20~22">20:00-22:00</option>
                    </select>
                  </label> </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td>
                    <tr>
                      <td>
                        <script type="text/javascript">
                          function disp(url){
                          window.open(url, "window_name", "top=50,left=300,width=700,height=500,scrollbars=yes");
                        }
                        </script>
                        <?php foreach ($logininfo2 as $g) { ?>
                        <div class="change_button">
                          <h1 class="credith1">送付先</h1>
                          <input type="button" class="change" value="変更" onClick="disp('immediate_change1.php')">
                        </div>
                        <hr>
                        <p id="jyuusyo" class="addtext">
                          <div class="text01">
                            <p>〒
                              <?php echo($g['postal_code']) ?>
                            </p>
                            <p>
                              <?php echo($g['street_address']) ?>
                            </p>
                          </div>
                        </p>
                        <?php } ?>
                        </td>
                    </tr>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        </div>
        <!-- ――――――――――――――――――――――――――――――――――――――――――― -->
        <!-- ――――――――――右側テーブルの中身にあたります―――――――――― -->
        <div class="table_flex3">
        <h1 class="credit">ご注文商品の確認</h1>
        <table class="credit">
          <tr>
            <td>
              <h1 class="credith1">ご注文商品</h1>
              <div class="scroll">
                <?php foreach($rows as $r) { ?>
                <div class="scroll_d">
                  <div class="scroll_d1"> <img class="gazou" src="images/<?php echo $r->getImages() ?>"> </div>
                  <div class="scroll_d2">
                    <p>
                      <?php echo $r->getName() ?>
                    </p>
                    <p>数量
                      <?php echo $r->getNum() ?> 個</p>
                    <p>
                      <?php echo $r->getPrice() * $r->getNum() ?> 円</p>
                  </div>
                </div>
                <hr>
                <?php } ?> </div>
              <div class="kaikei">
                <p>合計
                  <?php echo $sum ?> 円 </p>
              </div>
              <div class="submit_iti">
                <input class="submit" type="submit" name="submit" value="購入する">
              </div>
              </form>
            </td>
          </tr>
        </table>
        </div>
        <!-- ――――――――――――――――――――――――――――――――――――――――――― -->
  <!-- <a href="list.php">お買い物に戻る</a> -->
  </div>
  <hr>
  <footer>
    <div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
  </footer>
</body>
</html>