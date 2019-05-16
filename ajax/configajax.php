<?php
session_start();
$session = session_id();
error_reporting(0);
@define('_source', '../sources/');
@define('_lib', '../libraries/');
@define(_upload_folder, 'media/upload/');

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'vi';
}

$lang = $_SESSION['lang']; //Lấy ngỗn ngữ
include_once _lib . "config.php";
include_once _lib . "constant.php";
include_once _lib . "functions.php";
include_once _lib . "functions_giohang.php";
include_once _lib . "class.database.php";
$d= new database($config['database']);	