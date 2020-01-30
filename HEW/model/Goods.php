<?php
 //COPYRIGHT="All Rights Reserved. Copyright 2019 (C) HAL.AC.JP"
 //
 /*
 * ショッピングカート
 *
 * ファイル名　　：　Goods.php
 * ファイル説明　：　商品テーブルのアクセッサ―
 * 　　　　　　　　　
 * 更新履歴更新日 担当者内容
 *　1.0.0 2019/06/01 HAL石丸新規作成
 *
 */

 class Goods {

     //プロパティー
     private $product_id = "";
     private $product_name = "";
     private $producing_area = "";
     private $images = "";
     private $region = "";
     private $categoly = "";
     private $descripstion = "";
     private $price = "";
     private $additional_date = "";
     private $num = "";

     //echo()やprint()で文字列への変換が必要なときに呼び出されるメソッド
     //各プロパティーをタブ区切りで表示
     public function __toString(){
         return (string)($this->product_id . "\t" . $this->product_name . "\t" . $this->producing_area . "\t" .$this->images . "\t" . $this->region . "\t" . $this->categoly . "\t" .$this->description . "\t" . $this->price . "\t" . $this->additional_date);
     }

     //codeのgetter
     public function getId(){
         return $this->product_id;
     }
     //codeのsetter
     public function setId($product_id){
          $this->product_id = $product_id;
     }

     //nameのgetter
     public function getName(){
          return $this->product_name;
     }
     //nameのsetter
     public function setName($product_name){
          $this->product_name = $product_name;
     }

     //priceのgetter
     public function getArea(){
          return $this->producing_area;
     }
     //priceのsetter
     public function setArea($producing_area){
          $this->producing_area = $producing_area;
     }

     //commentのgetter
     public function getImages(){
          return $this->images;
     }
     //commentのsetter
     public function setImages($images){
          $this->images = $images;
     }
     //numのgetter
     public function getRegion(){
         return $this->region;
     }
     //numのsetter
     public function setRegion($region){
         $this->region = $region;
     }

     //nameのgetter
     public function getCate(){
          return $this->categoly;
     }
     //nameのsetter
     public function setCate($categoly){
          $this->categoly = $categoly;
     }

     //priceのgetter
     public function getDesc(){
          return $this->descripstion;
     }
     //priceのsetter
     public function setDesc($descripstion){
          $this->descripstion = $descripstion;
     }

     //commentのgetter
     public function getPrice(){
          return $this->price;
     }
     //commentのsetter
     public function setPrice($price){
          $this->price = $price;
     }
     //numのgetter
     public function getDate(){
         return $this->additional_date;
     }
     //numのsetter
     public function setDate($additional_date){
         $this->additional_date = $additional_date;
     }

     //numのgetter
     public function getNum(){
          return $this->num;
      }
      //numのsetter
      public function setNum($num){
          $this->num = $num;
      }
     }
?>