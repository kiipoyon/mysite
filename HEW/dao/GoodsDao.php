<?php
//COPYRIGHT="All Rights Reserved. Copyright 2019 (C) HAL.AC.JP"
//
/*
 * ショッピングカート
 *
 * ファイル名　　：　GoodsDao.php
 * ファイル説明　：　商品テーブルのアクセッサ―
 * 　　　　　　　　　
 * 更新履歴　　更新日　　担当者　　内容
 *　1.0.0　　2019/06/01　HAL石丸　新規作成
 *
 */

class GoodsDao{

    private $mysqli = null;

    //コンストラクタ
    function __construct(){
        $this->connect();
    }

    //デストラクタ
    function __destruct(){
        $this->disconnect();
    }

    //MySQLサーバへ接続
    private function connect(){
        if(is_null($this->mysqli)){
            $this->mysqli = new mysqli("localhost", "dbadmin", "dbadmin", "haldb");
            $this->mysqli->query("SET NAMES utf8");
            if(mysqli_connect_errno()){
                die("MySQLサーバ接続に失敗しました<br> 理由：" . mysqli_connect_error());
            }
        }
    }

    //MySQLサーバと切断
    private function disconnect(){
        is_null($this->mysqli) or $this->mysqli->close();
    }


    //全商品の取得
    public function getAllGoods(){
        is_null($this->mysqli) and $this->connect();
        $result = $this->mysqli->query("SELECT * FROM product_tbl");
        $goods_array = array();

        while($row = $result->fetch_array(MYSQLI_ASSOC)){ ##<--MYSQLI_NUMではない
            $goods = new Goods();
            $goods->setId($row["product_id"]);
            $goods->setName($row["product_name"]);
            $goods->setArea($row["producing_area"]);
            $goods->setImages($row["images"]);
            $goods->setRegion($row["region"]);
            $goods->setCate($row["categoly"]);
            $goods->setDesc($row["description"]);
            $goods->setPrice($row["price"]);
            $goods->setDate($row["additional_date"]);
            $goods_array[] = $goods;
        }
        $result->close();
        return $goods_array;
    }

    //指定された商品の取得
    private function getGoods($sql){
        is_null($this->mysqli) and $this->connect();
        $result = $this->mysqli->query($sql);

        $goods = null;

        if($result->num_rows != 0){
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $goods = new Goods();
            $goods->setId($row["product_id"]);
            $goods->setName($row["product_name"]);
            $goods->setArea($row["producing_area"]);
            $goods->setImages($row["images"]);
            $goods->setRegion($row["region"]);
            $goods->setCate($row["categoly"]);
            $goods->setDesc($row["description"]);
            $goods->setPrice($row["price"]);
            $goods->setDate($row["additional_date"]);
        }
        $result->close();

        return $goods;
    }

    //codeで商品を取得
    public function getGoodsByCode($product_id){
        $sql = "SELECT * FROM product_tbl WHERE product_id = '$product_id'";
        return $this->getGoods($sql);
    }

    //nameで商品を取得
    public function getGoodsByName($product_name){
        $sql = "SELECT * FROM product_tbl WHERE product_name = '$product_name'";
        return $this->getGoods($sql);
    }

    //商品の更新
    public function updateGoods($goods){
        is_null($this->mysqli) and $this->connect();
        $sql = "UPDATE goods SET
                          name = '" . $goods->getName() . "',
                          price ='" . $goods->getPrice() . "'
                          comment ='" . $goods->getComment() . "'
            WHERE code = '" . $goods->getCode() . "'";
        if( !$this->mysqli->query($sql)){
            print "登録に失敗しました(1001) " . $this->mysqli->error . "\n";
        }
    }

    //指定された商品の削除
    public function deleteGoods($goods){
        $this->deleteGoodsByCode($goods->getId());
    }

    //codeで指定された商品の削除
    public function deleteGoodsByCode($code){
        is_null($this->mysqli) and $this->connect();

        $sql = "DELETE FROM goods WHERE code = '" . $code . "'";
        if( !$this->mysqli->query($sql)){
            print "削除に失敗しました(1003) " . $this->mysqli->error . "\n";
        }
    }

}
?>