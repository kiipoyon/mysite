<?php
//COPYRIGHT="All Rights Reserved. Copyright 2019 (C) HAL.AC.JP"
//
/*
 * ショッピングカート
 *
 * ファイル名　　：　index.php
 * ファイル説明　：　初期処理
 * 　　　　　　　　　
 * 更新履歴		更新日	  担当者	内容
 *　1.0.0	 2019/05/01	  HAL石丸	新規作成
 *
 */



// 共通部品を呼び出す
require 'common/common.php';
// Daoを呼び出す
require 'model/Goods.php';
require 'dao/GoodsDao.php';


    // 一覧の初期化
    $rows = array();
    // 合計値を初期化
    $sum = 0;


    // セッションを初期化する
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = array();
    // サブミットボタンが押された場合
    if (@$_POST['submit']) {
        @$_SESSION['cart'][$_POST['code']] += $_POST['num'];
    }

    
    // カート内商品点数分繰り返す
    foreach($_SESSION['cart'] as $code => $num) {
    // 商品テーブルを検索する
    $goods_dao = new GoodsDao();
    $goods = new Goods();
    $goods = $goods_dao->getGoodsByCode($code);




    $goods->setNum($num);


    strip_tags($num);
    $sum += $num * $goods->getPrice();
    $rows[] = $goods;
    // セッション情報の保存
    $_SESSION['sum'] = $sum;
    // セッション情報の取得
    $sum = $_SESSION['sum'];
    }


// 最初の画面を表示する
require 'view/buyView.php';

?>