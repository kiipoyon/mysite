<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>特産横丁</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/list.css">

    <!-- googleアイコン -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
  <!-- サイドバー -->
  <div class="main_flex1">
    <p>対象商品数</p>
    <p class="count"><?php echo $row_count; ?>件</p>
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
          <input type="submit" name="narrow_down" value="絞り込み" class="btn-square">
        </form>
      </div>
  </div>

<!-- メインコンテンツ -->
  <div class="main_flex2">

    <!-- 並べ替え -->
    <div class="cp_ipselect cp_sl02">
      <form action="list.php" method="post">
        <select id="sort" required name="sort"  onchange="this.form.submit()">
          <option value="">おすすめ順</option>
          <option value="additional_date">新着順</option>
          <option value="cheap_price">価格が安い順</option>
          <option value="high_price">価格が高い順</option>
        </select>
      </form>
    </div>

    <div class="syouhin">
    <?php
        /* 一覧を３つ並べて表示 */
        $idx = 0;
        $col = 3; // カラム数
    ?>
        <table>
            <?php foreach ($data as $g) { ?>
              <?php if ($idx % $col == 0) { ?>
              <tr>
              <?php } ?>
                <td>
                  <a href="product_details.php?iddd=<?php echo $g['product_id'] ?>" method="GET">
                    <img class="gazou" src="images/<?php echo $g['images'] ?>">
                    <p><?php echo nl2br($g['product_name']) ?></p>
                    <p><?php echo nl2br($g['producing_area']) ?></p>
                    <p><?php echo($g['price']) ?>円</p>
                  </a>
                </td>
              <?php if ($idx % $col == $col - 1) { ?>
              </tr>
              <?php } ?>
              <?php $idx++; ?>
            <?php } ?>
            <?php if (($idx - 1) % $col != $col - 1) { ?>
              </tr>
            <?php } ?>
        </table>

            </div>
    <div>
      <p class = "pagination">
        <?php
          //ページネーションを表示
              for ( $n = 1; $n <= $pages; $n ++){
                  if ( $n == $now ){
                      echo "<span style='padding: 5px;'>$now</span>";
                  }else{
                      echo "<a href='list.php?page_id=$n' style='padding: 5px;'>$n</a>";
                  }
              }
        ?>
      </p>
    </div>





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