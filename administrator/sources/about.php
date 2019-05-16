<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";

switch ($act) {
    case "man":
        get_items();
        $template = "about/items";
        break;
    case "add":
        $template = "about/item_add";
        break;
    case "edit":
        get_item();
        $template = "about/item_add";
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
        $template = "about/cats";
        break;
    case "add_cat":
        $template = "about/cat_add";
        break;
    case "edit_cat":
        get_cat();
        $template = "about/cat_add";
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
				$sql = "UPDATE table_about SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("default.php?com=about&act=man&type=".$type);			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_about SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("default.php?com=about&act=man&type=".$type);			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				
				$sql = "select id,thumb, photo from #_about where id= ".$id_array[$i]."";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_tintuc.$row['photo']);
						delete_file(_upload_tintuc.$row['thumb']);			
					}
				}
				$sql = "delete from table_about where id = ".$id_array[$i]."";
				
				if(mysql_query($sql)){
					
					
				}
							
			}
			redirect("default.php?com=about&act=man&type=".$type);			
		}
		
		
	}
    $sql = "select * from #_about where type='".$type."' ";
    if ((int) $_REQUEST['id_cat'] != '') {
        $sql.=" and  	id_item=" . $_REQUEST['id_item'] . "";
    }
    $sql.=" order by stt,id desc";

    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=about&type=".$type."&act=man";
    $maxR = 20;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_item() {
    global $d,$type, $item;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=about&type=".$type."&act=man");

    $sql = "select * from #_about where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=about&type=".$type."&act=man");
    $item = $d->fetch_array();
}

function save_item() {
    global $d,$type;
    $file_name = fns_Rand_digit(0, 9, 8);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=about&type=".$type."&act=man");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	//Phần dữ liệu chung
	if ($_POST['ten_vi'] != '') {
		$data['ten_vi'] = $_POST['ten_vi'];
	}
	$data['ten_en'] = $_POST['ten_en'];
	$data['ten_jp'] = $_POST['ten_jp'];
	$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
	$data['mota_vi'] = magic_quote($_POST['mota_vi']);
	$data['mota_jp'] = $_POST['mota_jp'];
	$data['mota_en'] = $_POST['mota_en'];
	$data['noidung_vi'] = magic_quote($_POST['noidung_vi']);
	$data['noidung_jp'] = $_POST['noidung_jp'];
	$data['noidung_en'] = $_POST['noidung_en'];

	$data['title_vi'] = $_POST['title_vi'];
	$data['title_en'] = $_POST['title_en'];
	$data['title_jp'] = $_POST['title_jp'];
	$data['keywords_vi'] = $_POST['keywords_vi'];
	$data['keywords_en'] = $_POST['keywords_en'];
	$data['keywords_jp'] = $_POST['keywords_jp'];

	$data['description_vi'] = $_POST['description_vi'];
	$data['description_en'] = $_POST['description_en'];
	$data['description_jp'] = $_POST['description_jp'];
	$data['h1'] = $_POST['h1'];
	$data['h2'] = $_POST['h2'];
	$data['h3'] = $_POST['h3'];
	$data['type'] = $type;

	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
	
    if ($id) {
        $id = themdau($_POST['id']);

        if ($photo = upload_image("file", 'jpg|png|gif', _upload_tintuc, $file_name)) {
            $data['photo'] = $photo;
            //$data['thumb'] = create_thumb($data['photo'], 255, 320, _upload_tintuc, $file_name);
            $d->setTable('about');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_tintuc . $row['photo']);
                delete_file(_upload_tintuc . $row['thumb']);
            }
        }
        
        $data['ngaysua'] = time();

        $d->setTable('about');
        $d->setWhere('id', $id);
        if ($d->update($data))
            redirect("default.php?com=about&type=".$type."&act=man");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=about&type=".$type."&act=man");
    }else {

        if ($photo = upload_image("file", 'jpg|png|gif', _upload_tintuc, $file_name)) {
            $data['photo'] = $photo;
            //$data['thumb'] = create_thumb($data['photo'], 255, 320, _upload_tintuc, $file_name);
        }
       
        $data['ngaytao'] = time();

        $d->setTable('about');
        if ($d->insert($data))
            redirect("default.php?com=about&type=".$type."&act=man");
        else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=about&type=".$type."&act=man");
    }
}

function delete_item() {
    global $d,$type;

    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);

        $d->reset();
        $sql = "select * from #_about where id='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            while ($row = $d->fetch_array()) {
                delete_file(_upload_tintuc . $row['photo']);
                delete_file(_upload_tintuc . $row['thumb']);
            }
            $sql = "delete from #_about where id='" . $id . "'";
            $d->query($sql);
        }

        if ($d->query($sql))
            redirect("default.php?com=about&type=".$type."&act=man");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=about&type=".$type."&act=man");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=about&type=".$type."&act=man");
}

//===========================================================
?>