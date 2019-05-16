<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";
$id_photo = (isset($_REQUEST['id_photo'])) ? addslashes($_REQUEST['id_photo']) : "";

switch ($act) {
    case "man_photo":
        get_photos();
        $template = "thuonghieu/photos";
        break;
    case "add_photo":
        $template = "thuonghieu/photo_add";
        break;
    case "edit_photo":
        get_photo();
        $template = "thuonghieu/photo_add";
        break;
    case "save_photo":
        save_photo();
        break;
    case "delete_photo":
        delete_photo();
        break;

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

function get_photos() {
    global $d,$type, $id_photo, $items, $paging;
    #----------------------------------------------------------------------------------------
    if ($_REQUEST['footer'] != '') {
        $id_up = $_REQUEST['footer'];
        $sql_sp = "SELECT id,footer FROM table_thuonghieu where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $time = time();
        $hienthi = $cats[0]['footer'];
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_thuonghieu SET footer ='$time' WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_thuonghieu SET footer =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_thuonghieu SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("default.php?com=thuonghieu&act=man_photo&type=".$type);			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_thuonghieu SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("default.php?com=thuonghieu&act=man_photo&type=".$type);			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				
				$sql = "select id,thumb, photo from #_thuonghieu where id= ".$id_array[$i]."";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_hinhanh.$row['photo']);
						delete_file(_upload_hinhanh.$row['thumb']);			
					}
				}
				$sql = "delete from table_thuonghieu where id = ".$id_array[$i]."";
				
				if(mysql_query($sql)){
					
					
				}
							
			}
			redirect("default.php?com=thuonghieu&act=man_photo&type=".$type);			
		}
		
		
	}
    $d->setTable('thuonghieu');
    $d->setWhere('com', $type);
	if($_REQUEST["id_photo"]){
		$d->setWhere('id_photo', $_REQUEST["id_photo"]);
	}
    $d->setOrder('stt,id desc');
    $d->select('*');
    $d->query();
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=thuonghieu&type=".$type."&id_photo=".$id_photo."&act=man_photo";
    $maxR = 10;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_photo() {
    global $d,$type, $id_photo, $item, $list_cat;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=thuonghieu&type=".$type."&id_photo=".$id_photo."&act=man_photo");

    $d->setTable('thuonghieu');
    $d->setWhere('com', $type);
    $d->setWhere('id', $id);
    $d->select();
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=thuonghieu&type=".$type."&id_photo=".$id_photo."&act=man_photo");
    $item = $d->fetch_array();
    $d->reset();
}

function save_photo() {
    global $d,$type, $id_photo;
    $file_name = fns_Rand_digit(0, 9, 15);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=thuonghieu&type=".$type."&id_photo=".$id_photo."&act=man_photo");

    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) { // cap nhat
        if ($photo = upload_image("file", 'jpg|png|gif', _upload_hinhanh, $file_name)) {
            $data['photo'] = $photo;
            $data['thumb'] = create_thumb($data['photo'], 310, 310, _upload_hinhanh, $file_name, 2);
            $d->setTable('thuonghieu');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_hinhanh . $row['photo']);
                delete_file(_upload_hinhanh . $row['thumb']);
            }
        }

		$data['id_photo'] = (int)$_REQUEST['id_photo'];
        $data['id'] = $_REQUEST['id'];
        $data['stt'] = $_POST['stt'];
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
        $data['noidung_vi'] = $_POST['noidung_vi'];
        $data['noidung_en'] = $_POST['noidung_en'];
        $data['title_vi'] = $_POST['title_vi'];
        $data['title_en'] = $_POST['title_en'];
        $data['keywords_vi'] = $_POST['keywords_vi'];
        $data['keywords_en'] = $_POST['keywords_en'];
        $data['description_vi'] = $_POST['description_vi'];
        $data['description_en'] = $_POST['description_en'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['com'] = $type;

        $data['mota'] = $_POST['mota'];
        $data['height'] = $_POST['chieucao'];

        $d->reset();
        $d->setTable('thuonghieu');
        $d->setWhere('id', $id);
        if (!$d->update($data))
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=thuonghieu&type=".$type."&id_photo=".$id_photo."&act=man_photo");


        header("Location:default.php?com=thuonghieu&type=".$type."&id_photo=".$id_photo."&act=man_photo");
    } { // them moi
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh, $file_name)) {
            $data['photo'] = $photo;
            $data['thumb'] = create_thumb($data['photo'], 310, 310, _upload_hinhanh, $file_name, 2);
        }
		$data['id_photo'] = (int)$_REQUEST['id_photo'];
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['noidung_vi'] = $_POST['noidung_vi'];
        $data['noidung_en'] = $_POST['noidung_en'];
        $data['title_vi'] = $_POST['title_vi'];
        $data['title_en'] = $_POST['title_en'];
        $data['keywords_vi'] = $_POST['keywords_vi'];
        $data['keywords_en'] = $_POST['keywords_en'];
        $data['description_vi'] = $_POST['description_vi'];
        $data['description_en'] = $_POST['description_en'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['com'] = $type;
        $d->setTable('thuonghieu');
        if ($d->insert($data)) {
            redirect("default.php?com=thuonghieu&type=".$type."&id_photo=".$id_photo."&act=man_photo");
        } else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=thuonghieu&type=".$type."&id_photo=".$id_photo."&act=man_photo");
    }
}

function delete_photo() {
    global $d,$type, $id_photo;

    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->setTable('thuonghieu');
        $d->setWhere('id', $id);
        $d->select();
        if ($d->num_rows() == 0)
            transfer("Dữ liệu không có thực", "default.php?com=thuonghieu&type=".$type."&id_photo=".$id_photo."&act=man_photo");
        $row = $d->fetch_array();
        delete_file(_upload_hinhanh . $row['photo']);
        if ($d->delete())
            header("Location:default.php?com=thuonghieu&type=".$type."&id_photo=".$id_photo."&act=man_photo");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=thuonghieu&type=".$type."&id_photo=".$id_photo."&act=man_photo");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=thuonghieu&type=".$type."&id_photo=".$id_photo."&act=man_photo");
}
?>


