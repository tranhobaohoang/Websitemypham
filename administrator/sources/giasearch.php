<?php

if (!defined('_source'))
    die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";

switch ($act) {
    case "man":
        get_items();
        $template = "giasearch/items";
        break;
    case "add":
        $template = "giasearch/item_add";
        break;
    case "edit":
        get_item();
        $template = "giasearch/item_add";
        break;
    case "save":
        save_item();
        break;
    case "delete":
        delete_item();
        break;
    #===================================================	
    case "man_cat":
        get_cats();
        $template = "giasearch/cats";
        break;
    case "add_cat":
        $template = "giasearch/cat_add";
        break;
    case "edit_cat":
        get_cat();
        $template = "giasearch/cat_add";
        break;
    case "save_cat":
        save_cat();
        break;
    case "delete_cat":
        delete_cat();
        break;
    default:
        $template = "index";

    default:
        $template = "index";
}

function fns_Rand_digit($min, $max, $num) {
    $result = '';
    for ($i = 0; $i < $num; $i++) {
        $result.=rand($min, $max);
    }
    return $result;
}

function get_items() {
    global $d,$type, $items, $paging;
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_giasearch SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("default.php?com=giasearch&act=man&type=".$type);			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_giasearch SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("default.php?com=giasearch&act=man&type=".$type);			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				
				$sql = "select id from #_giasearch where id= ".$id_array[$i]."";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_tintuc.$row['photo']);
						delete_file(_upload_tintuc.$row['thumb']);			
					}
				}
				$sql = "delete from table_giasearch where id = ".$id_array[$i]."";
				
				if(mysql_query($sql)){
					
					
				}
							
			}
			redirect("default.php?com=giasearch&act=man&type=".$type);			
		}
		
		
	}
    $sql = "select * from #_giasearch ";
    $sql.=" order by stt,id desc";

    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=giasearch&act=man";
    $maxR = 20;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_item() {
    global $d,$type, $item;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=giasearch&act=man");

    $sql = "select * from #_giasearch where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=giasearch&act=man");
    $item = $d->fetch_array();
}

function save_item() {
    global $d,$type;
    $file_name = fns_Rand_digit(0, 9, 8);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=giasearch&act=man");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	//Phần dữ liệu chung
	if ($_POST['ten'] != '') {
		$data['ten'] = $_POST['ten'];
	}
	$data['tenkhongdau'] = changeTitle($_POST['ten']);
	$data['giatu'] = (int)$_POST['giatu'];
	$data['giaden'] = (int)$_POST['giaden'];

	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	
    if ($id) {
        $id = themdau($_POST['id']);
		
        $d->setTable('giasearch');
        $d->setWhere('id', $id);
        if ($d->update($data))
            redirect("default.php?com=giasearch&act=man");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=giasearch&act=man");
    }else {

        $d->setTable('giasearch');
        if ($d->insert($data))
            redirect("default.php?com=giasearch&act=man");
        else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=giasearch&act=man");
    }
}

function delete_item() {
    global $d,$type;

    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);

        $d->reset();
        $sql = "select * from #_giasearch where id='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            $sql = "delete from #_giasearch where id='" . $id . "'";
            $d->query($sql);
        }

        if ($d->query($sql))
            redirect("default.php?com=giasearch&act=man");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=giasearch&act=man");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=giasearch&act=man");
}

//===========================================================
?>