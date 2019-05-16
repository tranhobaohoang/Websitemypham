<?php
session_start();
@define('_template', '../templates/');
@define('_source', '../sources/');
@define ( '_lib' , '../../libraries/');
error_reporting(-1);
include_once _lib . "config.php";
include_once _lib . "constant.php";
include_once _lib . "functions.php";
include_once _lib . "library.php";
include_once _lib . "class.database.php";

$d = new database($config['database']);
$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch ($act) {
	case 'province':
		$pro=$_REQUEST['pro'];
		load_district($pro);
		break;
	
}
function load_district($pro){
	global $d;
	$d->reset();
	$sql="select * from #_district where provinceid='".$pro."' order by districtid";
	//echo $sql;
	$d->query($sql);
	$rs_district=$d->result_array();
	$kq='';
	foreach($rs_district as $v){
		$kq.= '<option value="'.$v['districtid'].'">'.$v['type'].' '. $v["name"].'</option>';
	}
	echo $kq;
}
?>