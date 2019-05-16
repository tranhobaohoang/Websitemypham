<?php
	session_start();
$session = session_id();
@define('_template', '../../templates/');
@define('_source', '../../sources/');
@define('_lib', '../../admin/lib/');
@define(_upload_folder, '../media/upload/');

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

$act=$_REQUEST['act'];
//dump($_POST);
switch ($act){
	case "thongtinuser":
		capnhat_user();
		break;
}
function capnhat_user(){
	global $d;
	$arr=$_POST['arr'];
	foreach($arr as $v){
		$data[$v["name"]]=$v['val'];
	}
	$d->setTable("member");
	$d->setWhere("username",$_SESSION['login_web']['username']);
	$d->update();
}
?>