<?php
//エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$msg = "";
// 共通部品を呼び出す
require 'common/common.php';
// Daoを呼び出す
require 'model/request.php';
require 'dao/requestDao.php';

    $product = htmlspecialchars($_POST["product"]);
    $company = htmlspecialchars($_POST["company"]);
    $image = htmlspecialchars($_POST["image"]);
    $name = htmlspecialchars($_POST["name"]);
    $name_read = htmlspecialchars($_POST["name_read"]);
    $mail_address = htmlspecialchars($_POST["mail_address"]);
    $other = htmlspecialchars($_POST["other"]);


    //画像の名前を変更し、ファイルに格納する


    $request_dao = new requestdao();

  try {
      $request = new request ();
      /* $request->setRequest_no(); */
      $request->setProduct_name($product);
      $request->setProducer($company);
      $request->setImages($image);
      $request->setname($name);
      $request->setname_read($name_read);
      $request->setmail_address($mail_address);
      $request->setother($other);

      $request_dao->insertrequest($request);

  } catch (Exception $e) {
      $errorMessage = 'データベースエラー';
      // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
      // echo $e->getMessage();
  }

require 'complete.php';
$request_dao = null;

?>
