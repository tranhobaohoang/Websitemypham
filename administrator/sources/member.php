<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$type = $_REQUEST['type'];
$urldanhmuc = "";
$urldanhmuc.= (isset($_REQUEST['id_list'])) ? "&id_list=" . addslashes($_REQUEST['id_list']) : "";
$urldanhmuc.= (isset($_REQUEST['id_cat'])) ? "&id_cat=" . addslashes($_REQUEST['id_cat']) : "";
$urldanhmuc.= (isset($_REQUEST['id_item'])) ? "&id_item=" . addslashes($_REQUEST['id_item']) : "";

$id = $_REQUEST['id'];
switch ($act) {
    	
    case "man_list":
        get_lists();
		if($type=='doanhnghiep'){
        $template = "member/lists";
		}else{
			$template = "member1/lists";
		}
        break;
    case "add_list":
        if($type=='doanhnghiep'){
        $template = "member/list_add";
		}else{
			$template = "member1/list_add";
		}
        break;
    case "edit_list":
        get_list();
        if($type=='doanhnghiep'){
        $template = "member/list_add";
		}else{
			$template = "member1/list_add";
		}
        break;
    case "save_list":
        save_list();
        break;
    case "delete_list":
        delete_list();
        break;
	
    #===================================================	
    case "man_photo":
        get_photos();
        $template = "member/photos";
        break;
    case "add_photo":
        $template = "member/photo_add";
        break;
    case "edit_photo":
        get_photo();
        $template = "member/photo_edit";
        break;
    case "save_photo":
        save_photo();
        break;
    case "delete_photo":
        delete_photo();
        break;
    #============================================================
    case "duyetbl":
        get_duyetbl();
        $template = "member/duyetbl";
        break;
    case "delete_binhluan":
        delete_binhluan();
        $template = "member/duyetbl";
        break;
    default:
        $template = "index";
}

#====================================

function fns_Rand_digit($min, $max, $num) {
    $result = '';
    for ($i = 0; $i < $num; $i++) {
        $result.=rand($min, $max);
    }
    return $result;
}


function get_lists() {
    global $d, $items, $paging, $type;
    #----------------------------------------------------------------------------------------
    if ($_REQUEST['noibat'] != '') {
        $id_up = $_REQUEST['noibat'];
        $sql_sp = "SELECT id,noibat FROM table_member where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $time = time();
        $hienthi = $cats[0]['noibat'];
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_member SET noibat ='$time' WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_member SET noibat =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }

    #----------------------------------------------------------------------------------------
    if ($_REQUEST['hienthi'] != '') {
        $id_up = $_REQUEST['hienthi'];
        $sql_sp = "SELECT id,hienthi FROM table_member where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $hienthi = $cats[0]['hienthi'];
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_member SET hienthi =1 WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_member SET hienthi =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }

    $sql = "select * from #_member where com='user' ";
	if($_REQUEST["keyword"]!=''){
		$key=$_REQUEST["keyword"];
		$sql.=" and username LIKE '%$key%'";
	}
	if($_REQUEST["email"]!=''){
		$key=$_REQUEST["email"];
		$sql.=" and email = '$key'";
	}
	if($_REQUEST["ngaybd"]!=''){
		$start = $_REQUEST['ngaybd'];
		$Ngay_arr = explode("/", $start); // array(17,11,2010)
		if (count($Ngay_arr) == 3) {
			$thang = $Ngay_arr[0]; //17
			$ngay = $Ngay_arr[1]; //11
			$nam = $Ngay_arr[2]; //2010
			if (checkdate($thang, $ngay, $nam) == false) {
				$coloi = true;
				$error_ngaysinh = "Bạn nhập chưa đúng ngày cấp<br>";
			} else
				$ngaycap = $thang . "/" . $ngay . "/" . $nam;
		}
		$start = (int) strtotime($ngaycap);
		$end = $_REQUEST['ngaykt'];
		$Ngay_arr = explode("/", $end); // array(17,11,2010)
		if (count($Ngay_arr) == 3) {
			$thang = $Ngay_arr[0]; //17
			$ngay = $Ngay_arr[1]; //11
			$nam = $Ngay_arr[2]; //2010
			if (checkdate($thang, $ngay, $nam) == false) {
				$coloi = true;
				$error_ngaysinh = "Bạn nhập chưa đúng ngày cấp<br>";
			} else
				$ngaycap = $thang . "/" . $ngay . "/" . $nam;
		}
		$end = (int) strtotime($ngaycap);
        $sql.=" and ngaytao>'".$start."' and ngaytao<'".$end."'";
	}
    $sql.=" order by stt,id desc";

    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=member&act=man_list&type=".$_REQUEST['type']."";
    $maxR = 20;
    $maxP = 10;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_list() {
    global $d, $item, $type;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=member&act=man_list&type=".$_REQUEST['type']."");
    $sql = "select * from #_member where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=member&act=man_list&type=".$_REQUEST['type']."");
    $item = $d->fetch_array();
}

function save_list() {
    global $d, $type;
    $file_name = fns_Rand_digit(0, 9, 12);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=member&act=man_list&type=".$_REQUEST['type']."");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) {
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_member, $file_name)) {
            $data['photo'] = $photo;
            $d->setTable('member');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_member . $row['photo']);
            }
        }
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
        $data['title_vi'] = $_POST['title_vi'];
        $data['title_en'] = $_POST['title_en'];
        $data['keywords_vi'] = $_POST['keywords_vi'];
        $data['keywords_en'] = $_POST['keywords_en'];
        $data['ten_jp'] = $_POST['ten_jp'];
        $data['keywords_jp'] = $_POST['keywords_jp'];
        $data['description_jp'] = $_POST['description_jp'];
        $data['title_jp'] = $_POST['title_jp'];
        $data['description_vi'] = $_POST['description_vi'];
        $data['description_en'] = $_POST['description_en'];
        $data['stt'] = $_POST['stt'];
        $data['com'] = $type;
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['province'] = $_POST['province'];
		$data['district'] = $_POST['district'];
		$data['diachi'] = $_POST['diachi'];
		$data['email'] = $_POST['email'];
		$data['website'] = $_POST['website'];
		$data['nganhnghe'] = $_POST['nganhnghe'];
		$data['ngayhoatdong'] = strtotime($_POST['ngayhoatdong']);
		$data['dinhmucgia'] = $_POST['dinhmucgia'];
        //$data['trangthai'] = isset($_POST['trangthai']) ? 1 : 0;
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaysua'] = time();
		//dump($data);
        $d->setTable('member');
        $d->setWhere('id', $id);
        if ($d->update($data))
            redirect("default.php?com=member&act=man_list&curPage=" . $_REQUEST['curPage'] . "&type=".$_REQUEST['type']."");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=member&act=man_list&type=".$_REQUEST['type']."");
    }else {
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_member, $file_name)) {
            $data['photo'] = $photo;
        }
		
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
        $data['title_vi'] = $_POST['title_vi'];
        $data['title_en'] = $_POST['title_en'];
        $data['keywords_vi'] = $_POST['keywords_vi'];
        $data['keywords_en'] = $_POST['keywords_en'];
        $data['ten_jp'] = $_POST['ten_jp'];
        $data['keywords_jp'] = $_POST['keywords_jp'];
        $data['description_jp'] = $_POST['description_jp'];
        $data['title_jp'] = $_POST['title_jp'];
        $data['description_vi'] = $_POST['description_vi'];
        $data['description_en'] = $_POST['description_en'];
        $data['com'] = $type;
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['country'] = $_POST['country'];
		$data['province'] = $_POST['province'];
		$data['district'] = $_POST['district'];
		$data['diachi'] = $_POST['diachi'];
		$data['email'] = $_POST['email'];
		$data['website'] = $_POST['website'];
		$data['nganhnghe'] = $_POST['nganhnghe'];
		$data['ngayhoatdong'] = strtotime($_POST['ngayhoatdong']);
		$data['dinhmucgia'] = $_POST['dinhmucgia'];
        //$data['trangthai'] = isset($_POST['trangthai']) ? 1 : 0;
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaytao'] = time();

        $d->setTable('member');
        if ($d->insert($data))
            redirect("default.php?com=member&act=man_list&type=".$_REQUEST['type']."");
        else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=member&act=man_list&type=".$_REQUEST['type']."");
    }
}

function delete_list() {
    global $d, $type;
    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->reset();
        $sql = "select * from #_member where id='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            while ($row = $d->fetch_array()) {
                delete_file(_upload_member . $row['photo']);
                delete_file(_upload_member . $row['thumb']);
            }
            $sql = "delete from #_member where id='" . $id . "'";
            $d->query($sql);
        }
        if ($d->query($sql))
            redirect("default.php?com=member&act=man_list");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=member&act=man_list&type=".$_REQUEST['type']."");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=member&act=man_list&type=".$_REQUEST['type']."");
}

/* --------------------------------------------- */
/* --------------------------------- */


function get_photos() {
    global $d, $items, $paging;
    #----------------------------------------------------------------------------------------
    if ($_REQUEST['hienthi'] != '') {
        $id_up = $_REQUEST['hienthi'];
        $sql_sp = "SELECT id,hienthi FROM table_member_hinhanh where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $hienthi = $cats[0]['hienthi'];
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_member_hinhanh SET hienthi =1 WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_member_hinhanh SET hienthi =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }



    $sql = "select * from #_member_hinhanh where ( id_photo = '" . $_REQUEST['idc'] . "' OR '" . $_REQUEST['idc'] . "'=0  ) order by stt,id desc ";
    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=member&act=man_photo&idc=" . $_REQUEST['idc'] . "&type=".$_REQUEST['type']."";
    $maxR = 10;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_photo() {
    global $d, $item, $list_cat;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=member&act=man_photo&idc=" . $_REQUEST['idc'] . "&type=".$_REQUEST['type']."");

    $d->setTable('member_hinhanh');
    $d->setWhere('com', 'member');
    $d->setWhere('id', $id);
    $d->select();
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=member&act=man_photo&idc=" . $_REQUEST['idc'] . "&type=".$_REQUEST['type']."");
    $item = $d->fetch_array();
    $d->reset();
}

function save_photo() {
    global $d;
    $file_name = fns_Rand_digit(0, 9, 10);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=member&act=man_photo&idc=" . $_REQUEST['idc'] . "&type=".$_REQUEST['type']."");

    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) { // cap nhat
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|Jpg|JPEG', _upload_member, $file_name)) {
            $data['photo'] = $photo;
            $data['thumb'] = create_thumb($data['photo'], 300, 300, _upload_member, $file_name . $i, 1);
            $d->setTable('member_hinhanh');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload . $row['photo']);
                delete_file(_upload . $row['thumb']);
            }
        }
        $data['id'] = $_REQUEST['id'];
        $data['mota'] = $_POST['mota'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['com'] = 'member';
        $d->reset();
        $d->setTable('member_hinhanh');
        $d->setWhere('id', $id);
        if (!$d->update($data))
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=member&act=man_photo&idc=" . $_REQUEST['idc'] . "&type=".$_REQUEST['type']."");
        redirect("default.php?com=member&act=man_photo&idc=" . $_REQUEST['idc'] . "&type=".$_REQUEST['type']."");
    } { // them moi
        for ($i = 0; $i < 5; $i++) {
            if ($photo = upload_image("file" . $i, 'jpg|png|gif|JPG|jpeg|Jpg|JPEG', _upload_member, $file_name . $i)) {
                $data['photo'] = $photo;
                $data['thumb'] = create_thumb($data['photo'], 300, 300, _upload_member, $file_name . $i, 1);

                $data['mota'] = "mota :" . $i;

                $data['stt'] = $_POST['stt' . $i];
                $data['mota'] = $_POST['mota' . $i];

                $data['hienthi'] = isset($_POST['hienthi' . $i]) ? 1 : 0;
                $data['com'] = 'member';

                $data['id_photo'] = $_REQUEST['idc'];

                $d->setTable('member_hinhanh');
                if (!$d->insert($data))
                    transfer("Lưu dữ liệu bị lỗi", "default.php?com=member&act=man_photo&idc=" . $_REQUEST['idc'] . "&type=".$_REQUEST['type']."");
            }
        }
        redirect("default.php?com=member&act=man_photo&idc=" . $_REQUEST['idc'] . "&type=".$_REQUEST['type']."");
    }
}

function delete_photo() {
    global $d;

    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->setTable('member_hinhanh');
        $d->setWhere('id', $id);
        $d->select();
        if ($d->num_rows() == 0)
            transfer("Dữ liệu không có thực", "default.php?com=member&act=man_photo&idc=" . $_REQUEST['idc'] . "&type=".$_REQUEST['type']."");
        $row = $d->fetch_array();
        delete_file(_upload_member . $row['photo']);
        delete_file(_upload_member . $row['thumb']);
        if ($d->delete())
            redirect("default.php?com=member&act=man_photo&idc=" . $_REQUEST['idc'] . "&type=".$_REQUEST['type']."");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=member&act=man_photo&idc=" . $_REQUEST['idc'] . "&type=".$_REQUEST['type']."");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=member&act=man_photo&idc=" . $_REQUEST['idc'] . "&type=".$_REQUEST['type']."");
}

function get_duyetbl() {
    global $d, $items, $paging;
    if (@$_REQUEST['hienthi'] != '') {
        $id_up = @$_REQUEST['hienthi'];
        $sql_sp = "SELECT id,hienthi FROM table_member_bl where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $hienthi = $cats[0]['hienthi'];
        //echo "id:". $spdc1;
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_member_bl SET hienthi =1 WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_member_bl SET hienthi =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }

    $sql = "select * from #_member_bl";
    $sql.=" order by id desc";
    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=member&act=duyetbl";
    $maxR = 20;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function delete_binhluan() {
    global $d;
    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $sql = "delete from #_member_bl where id='" . $id . "'";
        if ($d->query($sql))
            redirect("default.php?com=member&act=duyetbl");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=member&act=duyetbl");
    }elseif (isset($_GET['listid']) == true) {
        $listid = explode(",", $_GET['listid']);
        for ($i = 0; $i < count($listid); $i++) {
            $idTin = $listid[$i];
            $id = themdau($idTin);
            $d->reset();

            $sql = "delete from #_member_bl where id='" . $id . "'";
            $d->query($sql);
        }redirect("default.php?com=member&act=duyetbl");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=member&act=duyetbl");
}

?>