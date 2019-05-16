<?php
session_start();
$session = session_id();
error_reporting(0);
@define('_lib', './libraries/');
@define(_upload_folder, './media/upload/');


include_once _lib . "Mobile_Detect.php";
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
@define('_source', './sources/');


if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'vi';
}

$lang = $_SESSION['lang']; //Lấy ngỗn ngữ
require_once _source . "lang_$lang.php";

include_once _lib . "config.php";

include_once _lib . "constant.php";
include_once _lib . "functions.php";
include_once _lib . "functions_giohang.php";
include_once _lib . "class.database.php";
include_once _lib . "file_requick.php";
include_once _source . "counter.php";
include_once _source . "useronline.php";


if(!empty($_GET['ajax']) && $_GET['ajax'] == 'number'){
		echo get_total();
		die;
	}	
$_SESSION['cur_url'] = 'http://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];
//unset($_SESSION["cart"]);

//check_data($_SESSION["cart"]);
$title_custom = (!empty($title_custom) ? $title_custom : '');
$title_bar = (!empty($title_bar) ? $title_bar : '');
$row_setting['title_' . $lang] = (!empty($row_setting['title_' . $lang]) ? $row_setting['title_' . $lang] : '');

if($deviceType=="computer"){
	@define ( '_template' , './templates/');
	include_once "index_pc.php";
}else{
	@define ( '_template' , './m/');
	include_once "index_mb.php";
}
?>
