<?php

session_start();

if($_SERVER['HTTP_REFERER'] == "http://localhost/HEW/buy.php"){
  unset($_SESSION["cart"]);
  header('Location: buy.php');
  exit;
}elseif($_SERVER['HTTP_REFERER'] == "http://localhost/HEW/buyout.php"){
  unset($_SESSION["cart"]);
  header('Location: mypage.php');
  exit;
}


?>
