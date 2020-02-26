<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/product_details.css">
    <link rel="stylesheet" href="css/common.css">
    <!-- googleアイコン -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
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


<div class="main">
  <div class="main_flex1">
  <p class="conditions">絞り込み条件</p>
  <p class="area_title">
    <i class="material-icons miCSS">search</i>
    エリア
  </p>
  <hr>
  <div class="area_conc">
        <form name="form1" method="POST" action="list.php" >
        <a href="javascript:document.form1.submit()">北海道</A>
        <input type="hidden" name="hogehoge_status" value="1">
        </form>
        <form name="form2" method="POST" action="list.php" >
        <a href="javascript:document.form2.submit()">東北</A>
        <input type="hidden" name="hogehoge_status" value="2">
        </form>
        <form name="form3" method="POST" action="list.php" >
        <a href="javascript:document.form3.submit()">関東</A>
        <input type="hidden" name="hogehoge_status" value="3">
        </form>
        <form name="form4" method="POST" action="list.php" >
        <a href="javascript:document.form4.submit()">中部</A>
        <input type="hidden" name="hogehoge_status" value="4">
        </form>
        <form name="form5" method="POST" action="list.php" >
        <a href="javascript:document.form5.submit()">関西</A>
        <input type="hidden" name="hogehoge_status" value="5">
        </form>
        <form name="form6" method="POST" action="list.php" >
        <a href="javascript:document.form6.submit()">中国・四国</A>
        <input type="hidden" name="hogehoge_status" value="6">
        </form>
        <form name="form7" method="POST" action="list.php" >
        <a href="javascript:document.form7.submit()">九州・沖縄</A>
        <input type="hidden" name="hogehoge_status" value="7">
        </form>
      </div>
      <p class="area_title">
        <i class="material-icons miCSS">search</i>
        カテゴリー
      </p>
      <hr>
        <form name="cateform1" method="POST" action="list.php" >
        <a href="javascript:document.cateform1.submit()">海鮮・水産加工品</A>
        <input type="hidden" name="categoly" value="1">
        </form>
        <form name="cateform2" method="POST" action="list.php" >
        <a href="javascript:document.cateform2.submit()">肉・ハム</A>
        <input type="hidden" name="categoly" value="2">
        </form>
        <form name="cateform3" method="POST" action="list.php" >
        <a href="javascript:document.cateform3.submit()">野菜</A>
        <input type="hidden" name="categoly" value="3">
        </form>
        <form name="cateform4" method="POST" action="list.php" >
        <a href="javascript:document.cateform4.submit()">乳製品</A>
        <input type="hidden" name="categoly" value="4">
        </form>
        <form name="cateform5" method="POST" action="list.php" >
        <a href="javascript:document.cateform5.submit()">果物</A>
        <input type="hidden" name="categoly" value="5">
        </form>
        <form name="cateform6" method="POST" action="list.php" >
        <a href="javascript:document.cateform6.submit()">日本酒・ワイン・酒</A>
        <input type="hidden" name="categoly" value="6">
        </form>
        <form name="cateform7" method="POST" action="list.php" >
        <a href="javascript:document.cateform7.submit()">加工品</A>
        <input type="hidden" name="categoly" value="7">
        </form>
  <p class="area_title">
  <i class="material-icons miCSS">search</i>
    価格
  </p>
  <hr>
    <div class="cost">
      <p>価格（税込）を指定</p>
        <form action="list.php" method="post">
          <input type="text" name="mini" class="cost_t">～<input type="text" name="max" class="cost_t">円
          <input type="submit" name="submit" value="絞り込み" class="btn-square">
        </form>
    </div>
  </div>


    <?php foreach ($product_tbl as $g) { ?>
    <div class="main_flex2">
        <div class="container">

            <div class="container_flex1">
              <img src="images/<?php echo $g['images'] ?>">
            </div>

            <div class="container_flex2">
              <p class="p_name"><?php echo($g['product_name']) ?></p>
              <p class="p_area"><?php echo nl2br($g['producing_area']) ?></p>
              <a href="#syohin">レビュー数:<?php echo $row_count; ?></a>
              <div class="wrap">
                <?php
                if($reviewc == 1){
                ?>
                <span class="rate rate1"></span>
                <?php
                }elseif($reviewc == 1.5){
                  ?>
                  <span class="rate rate1-5"></span>
                  <?php
                }elseif($reviewc == 2){
                  ?>
                  <span class="rate rate2"></span>
                  <?php
                }elseif($reviewc == 2.5){
                  ?>
                  <span class="rate rate2-5"></span>
                  <?php
                }elseif($reviewc == 3){
                  ?>
                  <span class="rate rate3"></span>
                  <?php
                }elseif($reviewc == 3.5){
                  ?>
                  <span class="rate rate3-5"></span>
                  <?php
                }elseif($reviewc == 4){
                  ?>
                  <span class="rate rate4"></span>
                  <?php
                }elseif($reviewc == 4.5){
                  ?>
                  <span class="rate rate4-5"></span>
                  <?php
                }elseif($reviewc == 5){
                  ?>
                  <span class="rate rate5"></span>
                  <?php
                }elseif($reviewc == 0){
                  ?>
                  <p>まだレビューがありません</p>
                  <?php
                }
                ?>
              </div>

              <div class="kago">
                <p>価格</p>
                <p class="price"><?php echo($g['price']) ?>円（税込み）</p>
                <p class="amount">数量</p>
                <form action="buy.php" method="POST">
                  <div class="cp_ipselect cp_sl02">
                    <select name = "num">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                    </select>
                  </div>
                    <input type = "hidden" name = "code" value="<?php echo $g['product_id'] ?>">
                    <input type = "submit" name = "submit" value = "&#xf07a; カートに入れる" class="fas cart fa-lg">
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
      <div>
        <p class="syohin">商品説明<hr></p>
        <p><?php echo nl2br($g['description']) ?></p>
      </div>

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-ja.js"></script>
      <p class="syohin" id="syohin">商品レビュー<hr></p>
        <form method="post" action="product_details.php" method="POST" enctype="multipart/form-data" onsubmit="return reviewCheck()" id="form-name">

        <div class="cp_iptxt">
          <label class="ef">
          <input type="text" placeholder="お名前" name="view_name" id="view_name"  class="validate[required]">
          <p class="review_m"><span id = "msg1"></span></p>
          </label>
        </div>

        <div class="box">
          <div class="textarea-wrap">
            <textarea rows="4" cols="40" placeholder="ひと言レビュー" name="message" id="message" class="validate[required]"></textarea>
            <p class="review_m"><span id = "msg2"></span></p>
          </div>
        </div>

        <div class="evaluation">
          <input id="star1" type="radio" name="star" value="5" class="validate[required]" />
          <label for="star1">★</label>
          <input id="star2" type="radio" name="star" value="4" class="validate[required]" />
          <label for="star2">★</label>
          <input id="star3" type="radio" name="star" value="3" class="validate[required]" />
          <label for="star3">★</label>
          <input id="star4" type="radio" name="star" value="2" class="validate[required]" />
          <label for="star4">★</label>
          <input id="star5" type="radio" name="star" value="1" class="validate[required]" />
          <label for="star5">★</label>
        </div>

          <input type = "submit" class = "btn_submit" name = "btn_submit" value = "書き込む">
        </form>

        <script> 
        $(document).ready(function () {
          $("#form-name").validationEngine('attach', {
            promptPosition: "bottomLeft" //アラートの吹き出しを左下に設定
          });
        });
        </script>

        <hr>
        <form action="product_details.php" method="POST" onSubmit="return allCheck()">
        <?php foreach ($data as $g) { ?>
          <div class="postreview">
            <div class="postreview_flex">
              <p class="post_name"><?php echo nl2br($g['post_name']) ?></p>
              <p class="additional_date"><?php echo nl2br($g['additional_date']) ?></p>
              <p class="post_star">
                <?php 
                  if($g['star'] == "1"){
                          echo "★";
                        }elseif($g['star'] == "2"){
                          echo "★★";
                        }elseif($g['star'] == "3"){
                          echo "★★★";
                        }elseif($g['star'] == "4"){
                          echo "★★★★";
                        }elseif($g['star'] == "5"){
                          echo "★★★★★";
                        } 
                ?>
              </p>
            </div>
              <p class="post_review"><?php echo nl2br($g['post_review']) ?></p>
          </div>
        <?php } ?>
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