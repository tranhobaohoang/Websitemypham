<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$id=$_REQUEST['id'];
switch($act){
	case "man":
		get_items();
		$template = "lichsu/items";
		break;
	case "add":
		$template = "lichsu/item_add";
		break;
	case "edit":
		get_item();
		$template = "lichsu/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	#===================================================	
	
		
	#===================================================	
	
	default:
		$template = "index";
}

#====================================
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}

function get_items(){
	global $d, $items, $paging;
	
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_lichsu where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_lichsu SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_lichsu SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	$sql = "select * from #_lichsu where id<>0";
	$sql.=" order by stt asc,id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="default.php?com=lichsu&act=man";
	$maxR=20;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "default.php?com=lichsu&act=man");
	
	$sql = "select * from #_lichsu where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "default.php?com=lichsu&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d;
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "default.php?com=lichsu&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['mota_vi'] = $_POST['mota_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['mota_en'] = $_POST['mota_en'];
		$data['ten_cn'] = $_POST['ten_cn'];
		$data['mota_cn'] = $_POST['mota_cn'];
		
		
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		$d->setTable('lichsu');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("default.php?com=lichsu&act=man&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=lichsu&act=man");
	}else{
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['mota_vi'] = $_POST['mota_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['mota_en'] = $_POST['mota_en'];
		$data['ten_cn'] = $_POST['ten_cn'];
		$data['mota_cn'] = $_POST['mota_cn'];
		
				
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('lichsu');
		if($d->insert($data))
			redirect("default.php?com=lichsu&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "default.php?com=lichsu&act=man");
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select * from #_lichsu where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			$sql = "delete from #_lichsu where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("default.php?com=lichsu&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "default.php?com=lichsu&act=man");
	}else transfer("Không nhận được dữ liệu", "default.php?com=lichsu&act=man");
}

#====================================



#====================================

?>