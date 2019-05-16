<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
@define(_table,'prices');
switch($act){
	case "man":
		get_items();
		$template = "prices/items";
		break;
	case "add":
		$template = "prices/item_add";
		break;
	case "add_ajax":
		addpricess();
		break;
	case "edit":
		get_item();
		$template = "prices/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
		
	default:
		$template = "index";
}


function get_items(){
	global $d, $items, $paging;
	
	$sql = "select * from #_prices order by stt";
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="default.php?com=prices&act=man";
	$maxR=10;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "default.php?com=prices&act=man");
	
	$sql = "select * from #_prices where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "default.php?com=prices&act=man");
	$item = $d->fetch_array();
}

function addpricess(){
	global $d;
	$id_baiviet = $_POST['id'];
	$prices = $_POST['prices'];
	$slug = changeTitle($prices);
	$d->query("select id from #_prices where type=0 and slug='".$slug."'");
	if(!$d->num_rows()){
		$d->query("insert into #_prices(ten,slug,type) values ('".$prices."','".$slug."',0)");
		$id = mysql_insert_id();
	}else{
		$r = $d->fetch_array();
		$id = $r['id'];
	}
	/*$d->query("select id from #_prices_content where id_prices = $id and id_baiviet = $id_baiviet and `table` = '".$_POST['xcom']."'");
	if(!$d->num_rows()){
		$d->query("insert into #_prices_content (id_prices,id_baiviet,`table`,`type`) values ($id,$id_baiviet,'".$_POST['xcom']."','".$prices."')");
	}
	*/
	die;
}
function save_item(){
	global $d,$config;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "default.php?com=prices&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$k] = $_POST['ten_'.$k];
	}
	$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['email'] = isset($_POST['email']) ? 1 : 0;
	$data['diachidk'] = isset($_POST['diachidk']) ? 1 : 0;
	$data['diachinhanthu'] = isset($_POST['diachinhanthu']) ? 1 : 0;
	$data['kvtiepkhach'] = isset($_POST['kvtiepkhach']) ? 1 : 0;
	$data['letan'] = (int)isset($_POST['letan']) ? $_POST['letan'] : 1;
	$data['internet'] = (int)$_POST['internet'];
	$data['nuocuong'] = (int)$_POST['nuocuong'];
	$data['bao'] = (int)$_POST['bao'];
	$data['bangten'] = (int)$_POST['bangten'];
	$data['sofax'] = (int)$_POST['sofax'];
	$data['cafe'] = (int)$_POST['cafe'];
	$data['thutucdkkd'] = (int)$_POST['thutucdkkd'];
	$data['thutucdkkd1'] = (int)$_POST['thutucdkkd2'];
	$data['thutucdkkd1'] = (int)$_POST['thutucdkkd2'];
	$data['dienthoai'] = (int)$_POST['dienthoai'];
	$data['domain'] = $_POST['domain'];
	$data['website'] = $_POST['website'];
	$data['phonghop'] = $_POST['phonghop'];
	$data['logo'] = $_POST['logo'];
	$data['gia'] = $_POST['gia'];
	$data['stt'] = $_POST['stt'];
	if($id){ // cap nhat
		$d->setTable('prices');
		$d->setWhere('id', $id);
		if($d->update($data))
			header("Location:default.php?com=prices&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=prices&act=man");
	}else{ // them moi
		$data['ngaytao'] = time();
		$d->setTable('prices');
		if($d->insert($data)){
			header("Location:default.php?com=prices&act=man");
		}
			
		else
			transfer("Lưu dữ liệu bị lỗi", "default.php?com=prices&act=man");
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		
		// xoa item
		$sql = "delete from #_prices where id='".$id."'";
		if($d->query($sql))
			header("Location:default.php?com=prices&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "default.php?com=prices&act=man");
	}else transfer("Không nhận được dữ liệu", "default.php?com=prices&act=man");
}
#--------------------------------------------------------------------------------------------- photo

?>

	
