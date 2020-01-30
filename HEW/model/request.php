<?php
 //COPYRIGHT="All Rights Reserved. Copyright 2019 (C) HAL.AC.JP"
 //
 /*
 * ショッピングカート
 *
 * ファイル名　　：　request.php
 * ファイル説明　：　CSVのアクセッサ―
 * 　　　　　　　　　
 * 更新履歴 更新日  担当者 内容
 *　1.0.0 2019/10/31  HAL牧野 新規作成
 *
 */

class request {

    //プロパティー
    private $request_no = "";
    private $product_name = "";
    private $producer = "";
    private $images = "";
    private $name = "";
    private $name_read = "";
    private $mail_address = "";
    private $other = "";

    //echo()やprint()で文字列への変換が必要なときに呼び出されるメソッド
    //各プロパティーをタブ区切りで表示
    public function __toString(){
        return (string)($this->request_no . "\t" . $this->product_name . "\t" .$this->producer . "\t" .$this->images . "\t" .$this->name . "\t" .$this->name_read . "\t" .$this->mail_address . "\t" .$this->other);
    }

    //request_noのgetter
    public function getrequest_no(){
        return $this->request_no;
    }
    //request_noのsetter
    public function setrequest_no($request_no){
        $this->request_no = $request_no;
    }

    //product_nameのgetter
    public function getproduct_name(){
        return $this->product_name;
    }
    //product_nameのsetter
    public function setproduct_name($product_name){
        $this->product_name = $product_name;
    }

    //producerのgetter
    public function getproducer(){
        return $this->producer;
    }
    //producerのsetter
    public function setproducer($producer){
        $this->producer = $producer;
    }

    //imagesのgetter
    public function getimages(){
        return $this->images;
    }
    //imagesのsetter
    public function setimages($images){
        $this->images = $images;
    }

    //nameのgetter
    public function getname(){
        return $this->name;
    }
    //nameのsetter
    public function setname($name){
        $this->name = $name;
    }

    //name_readのgetter
    public function getname_read(){
        return $this->name_read;
    }
    //name_readのsetter
    public function setname_read($name_read){
        $this->name_read = $name_read;
    }

    //mail_addressのgetter
    public function getmail_address(){
        return $this->mail_address;
    }
    //mail_addressのsetter
    public function setmail_address($mail_address){
        $this->mail_address = $mail_address;
    }

    //otherのgetter
    public function getother(){
        return $this->other;
    }
    //otherのsetter
    public function setother($other){
        $this->other = $other;
    }
 }
 ?>