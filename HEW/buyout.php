<?php
// 共通部品を呼び出す
require 'common/common.php';
// データベースに接続する
$pdo = connect();

    // サブミットボタンが押された場合
    if (@$_POST['submit']) {
        // HTTP POSTから入力項目を取得する

        $product_id = "abcd";
        $method = $_POST['method'];
        echo $method;
        $card_no = $_POST['card_no'];
        $expiration_month = $_POST['expiration_month'];
        $expiration_year = $_POST['expiration_year'];
        $nominee = $_POST['nominee'];
        $delivery = $_POST['delivery'];
        $delivery_day = $_POST['delivery_day'];
        $delivery_time = $_POST['delivery_time'];
        $Destination = "fff";

//PDOオブジェクトの生成
$pdo = new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');

//execメソッドでクエリを実行。insert文を実行した場合挿入件数が戻り値として返る
$count = $pdo->exec("INSERT INTO order_tbl(order_id,product_id,method,card_no,expiration_month,expiration_year,nominee,delivery,delivery_day,delivery_time,Destination)
VALUES('','','$method','$card_no','$expiration_month','$expiration_year','$nominee','$delivery','$delivery_day','$delivery_time','$Destination')");


echo "{$count}件データを挿入しました。".PHP_EOL;


        }



    require 'view/insertView.php';
?>