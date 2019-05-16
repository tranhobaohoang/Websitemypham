<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch ($act) {
    case "man":
        get_items();
        $template = "video/items";
        break;
    case "add":
        $template = "video/item_add";
        break;
    case "edit":
        get_item();
        $template = "video/item_add";
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

function fns_Rand_digit($min, $max, $num) {
    $result = '';
    for ($i = 0; $i < $num; $i++) {
        $result.=rand($min, $max);
    }
    return $result;
}

function get_items() {
    global $d, $items, $paging;
    if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_video SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("default.php?com=video&act=man");			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_video SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("default.php?com=video&act=man");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				
				$sql = "select id,thumb, photo from #_video where id= ".$id_array[$i]."";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_hinhanh.$row['photo']);
						delete_file(_upload_hinhanh.$row['thumb']);			
					}
				}
				$sql = "delete from table_video where id = ".$id_array[$i]."";
				
				if(mysql_query($sql)){
					
					
				}
			}
			redirect("default.php?com=video&act=man");			
		}
		
		
	}

    $sql = "select * from #_video ";
    $sql.=" order by stt,id desc";

    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=video&act=man";
    $maxR = 20;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_item() {
    global $d, $item;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=video&act=man");

    $sql = "select * from #_video where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=video&act=man");
    $item = $d->fetch_array();
}

function save_item() {
    global $d;
    $file_name = fns_Rand_digit(0, 9, 8);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=video&act=man");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) {
        $id = themdau($_POST['id']);
        if ($photo = upload_image("file", 'jpg|png|gif', _upload_hinhanh, $file_name)) {
            $data['photo'] = $photo;
            $data['thumb'] = create_thumb($data['photo'], 50, 37, _upload_hinhanh, $file_name);
            $d->setTable('video');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_hinhanh . $row['photo']);
                delete_file(_upload_hinhanh . $row['thumb']);
            }
        }
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['ten_jp'] = $_POST['ten_jp'];
        $data['link'] = $_POST['link'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaysua'] = time();

        $d->setTable('video');
        $d->setWhere('id', $id);
        if ($d->update($data))
            redirect("default.php?com=video&act=man");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=video&act=man");
    }else {

        if ($photo = upload_image("file", 'jpg|png|gif', _upload_hinhanh, $file_name)) {
            $data['photo'] = $photo;
            $data['thumb'] = create_thumb($data['photo'], 50, 37, _upload_hinhanh, $file_name);
        }
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['ten_jp'] = $_POST['ten_jp'];
        $data['link'] = $_POST['link'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaytao'] = time();

        $d->setTable('video');
        if ($d->insert($data))
            redirect("default.php?com=video&act=man");
        else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=video&act=man");
    }
}

function delete_item() {
    global $d;
    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->reset();
        $d->reset();
        $sql = "select * from #_video where id='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            while ($row = $d->fetch_array()) {
                delete_file(_upload_hinhanh . $row['photo']);
                delete_file(_upload_hinhanh . $row['thumb']);
            }
            $sql = "delete from #_video where id='" . $id . "'";
            $d->query($sql);
        }
        if ($d->query($sql))
            redirect("default.php?com=video&act=man");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=video&act=man");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=video&act=man");
}

?>