<?php
//エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$msg = "";
// 共通部品を呼び出す
require 'common/common.php';
// Daoを呼び出す
require 'model/request2.php';
require 'dao/requestDao2.php';

    $name = htmlspecialchars($_POST["name"]);
    $name_read = htmlspecialchars($_POST["name_read"]);
    $mail_address = htmlspecialchars($_POST["mail_address"]);
    $content = htmlspecialchars($_POST["content"]);

    $request_dao = new requestdao();

  try {
      $request = new request ();
      $request->setname($name);
      $request->setname_read($name_read);
      $request->setmail_address($mail_address);
      $request->setcontent($content);

      $request_dao->insertrequest($request);

  } catch (Exception $e) {
      $errorMessage = 'データベースエラー';
      // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
      // echo $e->getMessage();
  }

require 'complete.php';
$request_dao = null;

?>
