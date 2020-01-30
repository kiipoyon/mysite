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


$gggg = $_SESSION['cart'];
$product_id = $_SESSION['code'];

    // セッション情報の取得
    $sum = $_SESSION['sum'];



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
    }

// 最初の画面を表示する
require 'view/creditView.php';

?>