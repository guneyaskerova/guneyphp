<?php

session_start();
session_destroy();

if(isset($SESSİON['kadi'])){
    die('Giriş Yetkiniz Yoktur');
}


?>

