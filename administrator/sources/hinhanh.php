<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch ($act) {
    case "man":
        get_items();
        $template = "hinhanh/items";
        break;
    case "add":
        $template = "hinhanh/item_add";
        break;
    case "edit":
        get_item();
        $template = "hinhanh/item_add";
        break;
    case "save":
        save_item();
        break;
    case "delete":
        delete_item();
        break;
    #===================================================	
    case "man_photo":
        get_photos();
        $template = "hinhanh/photos";
        break;
    case "add_photo":
        $template = "hinhanh/photo_add";
        break;
    case "edit_photo":
        get_photo();
        $template = "hinhanh/photo_edit";
        break;
    case "save_photo":
        save_photo();
        break;
    case "delete_photo":
        delete_photo();
        break;
    #============================================================
    case "man_cat":
        get_cats();
        $template = "hinhanh/cats";
        break;
    case "add_cat":
        $template = "hinhanh/cat_add";
        break;
    case "edit_cat":
        get_cat();
        $template = "hinhanh/cat_add";
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
    global $d, $items, $paging;

    if (@$_REQUEST['update'] != '') {
        $id_up = @$_REQUEST['update'];

        $tinnoibat = time();

        $sql_sp = "SELECT id,tinnoibat FROM table_hinhanh where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $spdc1 = $cats[0]['tinnoibat'];
        //echo "id:". $spdc1;
        if ($spdc1 == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_hinhanh SET tinnoibat ='" . $tinnoibat . "' WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_hinhanh SET tinnoibat =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }

    if (@$_REQUEST['hienthi'] != '') {
        $id_up = @$_REQUEST['hienthi'];
        $sql_sp = "SELECT id,hienthi FROM table_hinhanh where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $hienthi = $cats[0]['hienthi'];
        //echo "id:". $spdc1;
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_hinhanh SET hienthi =1 WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_hinhanh SET hienthi =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }

    $sql = "select * from #_hinhanh ";
    if ((int) $_REQUEST['id_cat'] != '') {
        $sql.=" where  	idlt=" . $_REQUEST['id_cat'] . "";
    }
    $sql.=" order by stt, id desc";

    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=hinhanh&act=man";
    $maxR = 20;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_item() {
    global $d, $item, $ds_photo;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=hinhanh&act=man");

    $sql = "select * from #_hinhanh where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=hinhanh&act=man");
    $item = $d->fetch_array();
	
	$d->reset();
	$sql_images="select * from #_hinhanh_hinhanh where id_photo='".$id."' order by stt, id desc ";
	$d->query($sql_images);
	$ds_photo=$d->result_array();
}

function save_item() {
    global $d;
    $file_name = fns_Rand_digit(0, 9, 8);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=hinhanh&act=man");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) {
        $id = themdau($_POST['id']);

        if ($photo = upload_image("file", 'jpg|png|gif', _upload_hinhanh, $file_name)) {
            $data['photo'] = $photo;
            $data['thumb'] = create_thumb($data['photo'], 250, 250, _upload_hinhanh, $file_name);
            $d->setTable('hinhanh');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_hinhanh . $row['photo']);
                delete_file(_upload_hinhanh . $row['thumb']);
            }
        }
        $data['id_item'] = (int) $_POST['id_item'];
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['ten_jp'] = $_POST['ten_jp'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
        $data['mota_vi'] = $_POST['mota_vi'];
        $data['mota_en'] = $_POST['mota_en'];
        $data['noidung_vi'] = $_POST['noidung_vi'];
        $data['noidung_en'] = $_POST['noidung_en'];

        $data['title_vi'] = $_POST['title_vi'];
        $data['title_jp'] = $_POST['title_jp'];
        $data['chon'] = $_POST['chon'];
        $data['title_en'] = $_POST['title_en'];
        $data['keywords_vi'] = $_POST['keywords_vi'];
        $data['keywords_en'] = $_POST['keywords_en'];

        $data['description_vi'] = $_POST['description_vi'];
        $data['description_en'] = $_POST['description_en'];

        $data['description_jp'] = $_POST['description_jp'];
        $data['keywords_jp'] = $_POST['keywords_jp'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
		$data['h1'] = $_POST['h1'];
		$data['h2'] = $_POST['h2'];
		$data['h3'] = $_POST['h3'];
        $data['ngaysua'] = time();

        $d->setTable('hinhanh');
        $d->setWhere('id', $id);
        if ($d->update($data)){
			//Xử lý hình ảnh kèm theo
			if (isset($_FILES['files'])) {
	            $myFile = $_FILES['files'];
				
	            $fileCount = count($myFile["name"]);
	            $file_name=fns_Rand_digit(0,9,6);
				
	            for ($i = 0; $i < $fileCount; $i++) { 
					$file_info = getimagesize($myFile['tmp_name'][$i]);
					if(empty($file_info)) // No Image?
					{
						$error .= "Không đúng định dạng file hình";
					}else{//A Image
						if(move_uploaded_file($myFile["tmp_name"][$i], _upload_hinhanh."/".$file_name."_".$myFile["name"][$i])){		            							
							$data1['stt'] = (int)$_POST['stthinh'][$i];
							$data1['photo'] = $file_name."_".$myFile["name"][$i];	
							$data1['id_photo'] = $id;
							$data1['hienthi'] = 1;
							$d->setTable('hinhanh_hinhanh');
							$d->insert($data1);
						}
					}
	            }
	        }
			redirect("default.php?com=hinhanh&act=man");
		}
            
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=hinhanh&act=man");
    }else {

        if ($photo = upload_image("file", 'jpg|png|gif', _upload_hinhanh, $file_name)) {
            $data['photo'] = $photo;
            $data['thumb'] = create_thumb($data['photo'], 250, 250, _upload_hinhanh, $file_name);
        }
        $data['id_item'] = (int) $_POST['id_item'];
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['ten_jp'] = $_POST['ten_jp'];
        $data['chon'] = $_POST['chon'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
        $data['mota_vi'] = $_POST['mota_vi'];
        $data['mota_en'] = $_POST['mota_en'];
        $data['noidung_vi'] = $_POST['noidung_vi'];
        $data['noidung_en'] = $_POST['noidung_en'];
        $data['stt'] = $_POST['stt'];

        $data['title_vi'] = $_POST['title_vi'];
        $data['title_jp'] = $_POST['title_jp'];
        $data['title_en'] = $_POST['title_en'];
        $data['keywords_vi'] = $_POST['keywords_vi'];
        $data['keywords_en'] = $_POST['keywords_en'];

        $data['description_vi'] = $_POST['description_vi'];
        $data['description_en'] = $_POST['description_en'];
        $data['description_jp'] = $_POST['description_jp'];
        $data['keywords_jp'] = $_POST['keywords_jp'];
		
		$data['h1'] = $_POST['h1'];
		$data['h2'] = $_POST['h2'];
		$data['h3'] = $_POST['h3'];

        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['tinnoibat'] = isset($_POST['noibat']) ? 1 : 0;
        $data['ngaytao'] = time();

        $d->setTable('hinhanh');
        if ($d->insert($data)){
			$id_insert = $d->insert_id;
			//Xử lý hình ảnh kèm theo
			if (isset($_FILES['files'])) {
	            $myFile = $_FILES['files'];
	            $fileCount = count($myFile["name"]);
	            $file_name=fns_Rand_digit(0,9,6);				
	            for ($i = 0; $i < $fileCount; $i++) { 
					$file_info = getimagesize($myFile['tmp_name'][$i]);
				  if(empty($file_info)) // No Image?
					  {
						  $error .= "Không đúng định dạng file hình";
					  }else{//A Image
						if(move_uploaded_file($myFile["tmp_name"][$i], _upload_hinhanh."/".$file_name."_".$myFile["name"][$i])){		            							
							$data1['stt'] = (int)$_POST['stthinh'][$i];
							$data1['photo'] = $file_name."_".$myFile["name"][$i];	
							$data1['id_photo'] = $id_insert;
							$data1['hienthi'] = 1;
							$d->setTable('hinhanh_hinhanh');
							$d->insert($data1);
						}
					  }
	            }
	        }
			redirect("default.php?com=hinhanh&act=man");
		}
            
        else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=hinhanh&act=man");
    }
}

function delete_item() {
    global $d;

    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);

        $d->reset();
        $sql = "select * from #_hinhanh where id='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            while ($row = $d->fetch_array()) {
                delete_file(_upload_hinhanh . $row['photo']);
                delete_file(_upload_hinhanh . $row['thumb']);
            }
            $sql = "delete from #_hinhanh where id='" . $id . "'";
            $d->query($sql);
        }

        if ($d->query($sql))
            redirect("default.php?com=hinhanh&act=man");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=hinhanh&act=man");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=hinhanh&act=man");
}

//===========================================================
function get_cats() {
    global $d, $items, $paging;
    $sql = "select * from #_hinhanh_item order by stt";
    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=hinhanh&act=man_cat";
    $maxR = 20;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_cat() {
    global $d, $item;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=hinhanh&act=man_cat");

    $sql = "select * from #_hinhanh_item where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=hinhanh&act=man_cat");
    $item = $d->fetch_array();
}

function save_cat() {
    global $d;
    $file_name_item = fns_Rand_digit(0, 9, 5);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=hinhanh&act=man_cat");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) {
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['ten_jp'] = $_POST['ten_jp'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
        $data['noidung_vi'] = $_POST['noidung_vi'];
        $data['noidung_en'] = $_POST['noidung_en'];
        $data['noidung_jp'] = $_POST['noidung_jp'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaysua'] = time();
        $d->setTable('hinhanh_item');
        $d->setWhere('id', $id);
        if ($d->update($data))
            redirect("default.php?com=hinhanh&act=man_cat&curPage=" . $_REQUEST['curPage'] . "");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=hinhanh&act=man_cat");
    }else {
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['ten_jp'] = $_POST['ten_jp'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
        $data['noidung_vi'] = $_POST['noidung_vi'];
        $data['noidung_en'] = $_POST['noidung_en'];
        $data['noidung_jp'] = $_POST['noidung_jp'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaytao'] = time();

        $d->setTable('hinhanh_item');
        if ($d->insert($data))
            redirect("default.php?com=hinhanh&act=man_cat");
        else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=hinhanh&act=man_cat");
    }
}

function delete_cat() {
    global $d;
    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->reset();
        $sql = "delete from #_hinhanh_item where id='" . $id . "'";
        if ($d->query($sql))
            redirect("default.php?com=hinhanh&act=man_cat");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=hinhanh&act=man_cat");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=hinhanh&act=man_cat");
}

/* --------------------------------------------- */

function get_photos() {
    global $d, $items, $paging;
    #----------------------------------------------------------------------------------------
    if ($_REQUEST['hienthi'] != '') {
        $id_up = $_REQUEST['hienthi'];
        $sql_sp = "SELECT id,hienthi FROM table_hinhanh_hinhanh where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $hienthi = $cats[0]['hienthi'];
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_hinhanh_hinhanh SET hienthi =1 WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_hinhanh_hinhanh SET hienthi =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }


    $sql = "select * from #_hinhanh_hinhanh where ( id_photo = '" . $_REQUEST['idc'] . "' OR '" . $_REQUEST['idc'] . "'=0  ) order by stt,id desc ";
    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=hinhanh&act=man_photo&idc=" . $_REQUEST['idc'] . "";
    $maxR = 10;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_photo() {
    global $d, $item, $list_cat;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=hinhanh&act=man_photo&idc=" . $_REQUEST['idc'] . "");

    $d->setTable('hinhanh_hinhanh');
    $d->setWhere('com', 'hinhanh');
    $d->setWhere('id', $id);
    $d->select();
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=hinhanh&act=man_photo&idc=" . $_REQUEST['idc'] . "");
    $item = $d->fetch_array();
    $d->reset();
}

function save_photo() {
    global $d;
    $file_name = fns_Rand_digit(0, 9, 10);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=hinhanh&act=man_photo&idc=" . $_REQUEST['idc'] . "");

    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) { // cap nhat
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|Jpg|JPEG', _upload_hinhanh, $file_name)) {
            $data['photo'] = $photo;
            $data['thumb'] = create_thumb($data['photo'], 300, 300, _upload_hinhanh, $file_name . $i, 1);
            $d->setTable('hinhanh_hinhanh');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_hinhanh . $row['photo']);
                delete_file(_upload_hinhanh . $row['thumb']);
            }
        }
        $data['id'] = $_REQUEST['id'];
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['ten_jp'] = $_POST['ten_jp'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
        $data['noidung_vi'] = $_POST['noidung_vi'];
        $data['noidung_en'] = $_POST['noidung_en'];
        $data['noidung_jp'] = $_POST['noidung_jp'];
        $data['title_vi'] = $_POST['title_vi'];
        $data['title_jp'] = $_POST['title_jp'];
        $data['title_en'] = $_POST['title_en'];
        $data['keywords_vi'] = $_POST['keywords_vi'];
        $data['keywords_en'] = $_POST['keywords_en'];

        $data['description_vi'] = $_POST['description_vi'];
        $data['description_en'] = $_POST['description_en'];
        $data['description_jp'] = $_POST['description_jp'];
        $data['keywords_jp'] = $_POST['keywords_jp'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['com'] = 'hinhanh';
        $d->reset();
        $d->setTable('hinhanh_hinhanh');
        $d->setWhere('id', $id);
        if (!$d->update($data))
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=hinhanh&act=man_photo&idc=" . $_REQUEST['idc'] . "");
        redirect("default.php?com=hinhanh&act=man_photo&idc=" . $_REQUEST['idc'] . "");
    } { // them moi
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|Jpg|JPEG', _upload_hinhanh, $file_name)) {
            $data['photo'] = $photo;
            $data['thumb'] = create_thumb($data['photo'], 300, 300, _upload_hinhanh, $file_name, 1);


            $data['stt'] = $_POST['stt'];
            $data['ten_vi'] = $_POST['ten_vi'];
            $data['ten_en'] = $_POST['ten_en'];
            $data['ten_jp'] = $_POST['ten_jp'];
            $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
            $data['noidung_vi'] = $_POST['noidung_vi'];
            $data['noidung_en'] = $_POST['noidung_en'];
            $data['noidung_jp'] = $_POST['noidung_jp'];
            $data['title_vi'] = $_POST['title_vi'];
            $data['title_jp'] = $_POST['title_jp'];
            $data['title_en'] = $_POST['title_en'];
            $data['keywords_vi'] = $_POST['keywords_vi'];
            $data['keywords_en'] = $_POST['keywords_en'];

            $data['description_vi'] = $_POST['description_vi'];
            $data['description_en'] = $_POST['description_en'];
            $data['description_jp'] = $_POST['description_jp'];
            $data['keywords_jp'] = $_POST['keywords_jp'];

            $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
            $data['com'] = 'hinhanh';

            $data['id_photo'] = $_REQUEST['idc'];

            $d->setTable('hinhanh_hinhanh');
            if (!$d->insert($data))
                transfer("Lưu dữ liệu bị lỗi", "default.php?com=hinhanh&act=man_photo&idc=" . $_REQUEST['idc'] . "");
        }
    }
    redirect("default.php?com=hinhanh&act=man_photo&idc=" . $_REQUEST['idc'] . "");
}

function delete_photo() {
    global $d;

    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->setTable('hinhanh_hinhanh');
        $d->setWhere('id', $id);
        $d->select();
        if ($d->num_rows() == 0)
            transfer("Dữ liệu không có thực", "default.php?com=hinhanh&act=man_photo&idc=" . $_REQUEST['idc'] . "");
        $row = $d->fetch_array();
        delete_file(_upload_hinhanh . $row['photo']);
        delete_file(_upload_hinhanh . $row['thumb']);
        if ($d->delete())
            redirect("default.php?com=hinhanh&act=man_photo&idc=" . $_REQUEST['idc'] . "");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=hinhanh&act=man_photo&idc=" . $_REQUEST['idc'] . "");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=hinhanh&act=man_photo&idc=" . $_REQUEST['idc'] . "");
}

?>