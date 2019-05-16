<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
@define(_table,'tag');
switch($act){
	case "man":
		get_items();
		$template = "tag/items";
		break;
	case "add":
		$admin->initAdd();
		$template = "tag/item_add";
		break;
	case "add_ajax":
		addTags();
		break;
	case "edit":
		get_item();
		$template = "tag/item_add";
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
	
	$sql = "select * from #_tag order by stt";
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="default.php?com=tag&act=man";
	$maxR=10;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "default.php?com=tag&act=man");
	
	$sql = "select * from #_tag where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "default.php?com=tag&act=man");
	$item = $d->fetch_array();
}

function addTags(){
	global $d;
	$id_baiviet = $_POST['id'];
	$tag = $_POST['tag'];
	$slug = changeTitle($tag);
	$d->query("select id from #_tag where type=0 and slug='".$slug."'");
	if(!$d->num_rows()){
		$d->query("insert into #_tag(ten,slug,type) values ('".$tag."','".$slug."',0)");
		$id = mysql_insert_id();
	}else{
		$r = $d->fetch_array();
		$id = $r['id'];
	}
	/*$d->query("select id from #_tag_content where id_tag = $id and id_baiviet = $id_baiviet and `table` = '".$_POST['xcom']."'");
	if(!$d->num_rows()){
		$d->query("insert into #_tag_content (id_tag,id_baiviet,`table`,`type`) values ($id,$id_baiviet,'".$_POST['xcom']."','".$tag."')");
	}
	*/
	die;
}
function save_item(){
	global $d,$config;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "default.php?com=tag&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data['type'] = $_POST['type'];
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$v] = $_POST['ten_'.$v];
		$data['slug_'.$v] = changeTitle($_POST['ten_'.$v]);
		$data['length_'.$v] = strlen($data['ten_'.$v]);
		
	}
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['link'] = $_POST['link'];
	$data['type'] = $_POST['type'];
	if($id){ // cap nhat
	
	
		$d->setTable('tag');
		$d->setWhere('id', $id);
		if($d->update($data))
			header("Location:default.php?com=tag&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=tag&act=man");
	}else{ // them moi
	
		$d->setTable('tag');
		if($d->insert($data))
			header("Location:default.php?com=tag&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "default.php?com=tag&act=man");
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		
		// xoa item
		$sql = "delete from #_tag where id='".$id."'";
		if($d->query($sql))
			header("Location:default.php?com=tag&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "default.php?com=tag&act=man");
	}else transfer("Không nhận được dữ liệu", "default.php?com=tag&act=man");
}
#--------------------------------------------------------------------------------------------- photo

?>

	
