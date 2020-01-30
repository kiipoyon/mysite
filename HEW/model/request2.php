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
    private $inquiry_no = "";
    private $name = "";
    private $name_read = "";
    private $mail_address = "";
    private $content = "";

    //echo()やprint()で文字列への変換が必要なときに呼び出されるメソッド
    //各プロパティーをタブ区切りで表示
    public function __toString(){
        return (string)($this->inquiry_no . "\t" .$this->name . "\t" .$this->name_read . "\t" .$this->mail_address . "\t" .$this->content);
    }

    //inquiry_noのgetter
    public function getinquiry_no(){
        return $this->inquiry_no;
    }
    //inquiry_noのsetter
    public function setinquiry_no($inquiry_no){
        $this->inquiry_no = $inquiry_no;
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

    //contentのgetter
    public function getcontent(){
        return $this->content;
    }
    //contentのsetter
    public function setcontent($content){
        $this->content = $content;
    }
 }
 ?>