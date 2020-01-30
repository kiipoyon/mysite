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
 *　1.0.0　　2019/06/01　HAL牧野　新規作成
 *
 */

class requestdao{

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

    //新規登録
    public function insertrequest($request_tbl){
        is_null($this->mysqli) and $this->connect();
        $sql = "INSERT INTO request_tbl values (
                          '" . $request_tbl->getRequest_no(0) . "',
                          '" . $request_tbl->getProduct_name() . "',
                          '" . $request_tbl->getProducer() . "',
                          '" . $request_tbl->getImages() . "',
                          '" . $request_tbl->getname() . "',
                          '" . $request_tbl->getname_read() . "',
                          '" . $request_tbl->getmail_address() . "',
                          '" . $request_tbl->getother() . "')";
        if( !$this->mysqli->query($sql)){
            print "登録に失敗しました(1002) " . $this->mysqli->error . "\n";
        }
    }


}
?>
