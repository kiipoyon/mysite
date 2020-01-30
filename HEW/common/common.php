<?php
    //COPYRIGHT="All Rights Reserved. Copyright 2019 (C) HAL.AC.JP"
    //
    /*
     * ショッピングカート
     *
     * ファイル名　　：　common.php
     * ファイル説明　：　共通部品
     * 　　　　　　　　　
     * 更新履歴		更新日	  担当者	内容
     *　1.0.0	 2019/05/01	  HAL石丸	新規作成
     *
     */


    /**
     * <pre>
     *  セッションを開始する
     * </pre>
     *
     * @author HAL〇〇
     * @version 1.0.0
     */
    session_start();

    function connect() {
        // 接続するデータベースの設定をする
        return new PDO('mysql:host=localhost;dbname=haldb;charset=utf8','dbadmin','dbadmin');
    }





    /**
     * <pre>
     *  画像を設定する
     * </pre>
     *
     * @author HAL〇〇
     * @version 1.0.0
     */
    function img_tag($code) {
        if (file_exists("images/$code.jpg")) $name = $code;
        else $name = 'noimage';

        return '<img src="images/' . $name . '.jpg" alt="">';
    }
?>