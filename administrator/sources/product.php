<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$type = $_REQUEST['type'];
$subcat = $_REQUEST['subcat'];
$urldanhmuc = "";
$urldanhmuc.= (isset($_REQUEST['id_list'])) ? "&id_list=" . addslashes($_REQUEST['id_list']) : "";
$urldanhmuc.= (isset($_REQUEST['id_cat'])) ? "&id_cat=" . addslashes($_REQUEST['id_cat']) : "";
$urldanhmuc.= (isset($_REQUEST['id_item'])) ? "&id_item=" . addslashes($_REQUEST['id_item']) : "";

$id = $_REQUEST['id'];
switch ($act) {

    case "man":
        get_items();
        $template = "product/items";
        break;
    case "add":
        $template = "product/item_add";
        break;
    case "edit":
        get_item();
        $template = "product/item_add";
        break;
    case "save":
        save_item();
        break;
    case "delete":
        delete_item();
        break;
    #===================================================    
    case "man_item":
        get_loais();
        $template = "product/loais";
        break;
    case "add_item":
        $template = "product/loai_add";
        break;
    case "edit_item":
        get_loai();
        $template = "product/loai_add";
        break;
    case "save_item":
        save_loai();
        break;
    case "delete_item":
        delete_loai();
        break;

    #===================================================    
    case "man_cat":
        get_cats();
        $template = "product/cats";
        break;
    case "add_cat":
        $template = "product/cat_add";
        break;
    case "edit_cat":
        get_cat();
        $template = "product/cat_add";
        break;
    case "save_cat":
        save_cat();
        break;
    case "delete_cat":
        delete_cat();
        break;
    #===================================================    
    case "man_list":
        get_lists();
        $template = "product/lists";
        break;
    case "add_list":
        $template = "product/list_add";
        break;
    case "edit_list":
        get_list();
        $template = "product/list_add";
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
        $template = "product/photos";
        break;
    case "add_photo":
        $template = "product/photo_add";
        break;
    case "edit_photo":
        get_photo();
        $template = "product/photo_edit";
        break;
    case "save_photo":
        save_photo();
        break;
    case "delete_photo":
        delete_photo();
        break;
    #===================================================    
    case "man_tab":
        get_tabs();
        $template = "product/tabs";
        break;
    case "add_tab":
        $template = "product/tab_add";
        break;
    case "edit_tab":
        get_tab();
        $template = "product/tab_add";
        break;
    case "save_tab":
        save_tab();
        break;
    case "delete_tab":
        delete_tab();
        break;
    #===================================================    
    case "man_size":
        get_sizes();
        $template = "product/sizes";
        break;
    case "add_size":
        $template = "product/size_add";
        break;
    case "edit_size":
        get_size();
        $template = "product/size_add";
        break;
    case "save_size":
        save_size();
        break;
    case "delete_size":
        delete_size();
        break;
    #===================================================    
    case "man_color":
        get_colors();
        $template = "product/colors";
        break;
    case "add_color":
        $template = "product/color_add";
        break;
    case "edit_color":
        get_color();
        $template = "product/color_add";
        break;
    case "save_color":
        save_color();
        break;
    case "delete_color":
        delete_color();
        break;
    #============================================================
    case "duyetbl":
        get_duyetbl();
        $template = "product/duyetbl";
        break;
    case "delete_binhluan":
        delete_binhluan();
        $template = "product/duyetbl";
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
function get_items() {
    global $d, $items, $paging, $urldanhmuc, $type;
    if(!empty($_POST)){
        $multi=$_REQUEST['multi'];
        $id_array=$_POST['iddel'];
        $count=count($id_array);
        if($multi=='show'){
            for($i=0;$i<$count;$i++){
                $sql = "UPDATE table_product SET hienthi =1 WHERE  id = ".$id_array[$i]."";
                mysql_query($sql) or die("Not query sqlUPDATE_ORDER");              
            }
            redirect("default.php?com=product&act=man&type=".$type);            
        }
        
        if($multi=='hide'){
            for($i=0;$i<$count;$i++){
                $sql = "UPDATE table_product SET hienthi =0 WHERE  id = ".$id_array[$i]."";
                mysql_query($sql) or die("Not query sqlUPDATE_ORDER");              
            }
            redirect("default.php?com=product&act=man&type=".$type);            
        }
        
        if($multi=='del'){
            for($i=0;$i<$count;$i++){
                
                $sql = "select id,thumb, photo from #_product where id= ".$id_array[$i]."";
                $d->query($sql);
                if($d->num_rows()>0){
                    while($row = $d->fetch_array()){
                        delete_file(_upload_product.$row['photo']);
                        delete_file(_upload_product.$row['thumb']);         
                    }
                }
                $sql = "delete from table_product where id = ".$id_array[$i]."";
                
                if(mysql_query($sql)){
                    
                    //Xóa tất cả hình ảnh kèm theo
                    $sql = "select thumb, photo from #_product_hinhanh where id_photo= ".$id_array[$i]."";
                    $d->query($sql);
                    if($d->num_rows()>0){
                        while($row = $d->fetch_array()){
                            delete_file(_upload_product.$row['photo']);
                            delete_file(_upload_product.$row['thumb']);     
                            $sql = "delete from table_product_hinhanh where id = ".$row['id']."";   
                            mysql_query($sql);
                        }
                    }
                }
                            
            }
            redirect("default.php?com=product&act=man&type=".$type);            
        }
        
        
    }
    #-------------------------------------------------------------------------------
    $sql = "select * from #_product where type='".$type."' ";
    if ((int) $_REQUEST['id_list'] != '') {
        $sql.=" and  find_in_set('" . $_REQUEST['id_list'] . "', list_id)";
    }

    if ($_REQUEST['keyword'] != '') {
        $keyword = addslashes($_REQUEST['keyword']);
        $sql.=" where ten_vi LIKE '%$keyword%'";
    }
    $sql.=" order by stt,id desc";

    $d->query($sql);
    $items = $d->result_array();
    
    
    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=product&act=man&type=".$type . $urldanhmuc;
    $maxR = 15;
    $maxP = 20;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_item() {
    global $d, $item, $ds_tags, $type,$ds_photo;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man&type=".$type);
    $sql = "select * from #_product where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=product&act=man&type=".$type);
    $item = $d->fetch_array();
    
    $d->reset();
    $sql_images="select * from #_product_hinhanh where id_photo='".$id."' order by stt, id desc ";
    $d->query($sql_images);
    $ds_photo=$d->result_array();
}

function save_item() {
    global $d, $type;
    $file_name = fns_Rand_digit(0, 9, 12);
    $file_name1 = fns_Rand_digit(0, 9, 12);
    $file_name2 = fns_Rand_digit(0, 9, 12);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man&type=".$type);
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    
    //Phần chung
    $data['ten_vi'] = $_POST['ten_vi'];
    $data['ten_en'] = $_POST['ten_en'];
    $data['ten_jp'] = $_POST['ten_jp'];
    
    $data['masp'] = $_POST['masp'];
    $data['bedroom'] = $_POST['bedroom'];
    $data['toilet'] = $_POST['toilet'];
    $data['dientich'] = $_POST['dientich'];
    $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
    $data['gia'] = $_POST['gia'];
    $data['giakm'] = (int)$_POST['giakm'];
    $data['type'] = $type;
    
    $data['mota_vi'] = magic_quote($_POST['mota_vi']);
    $data['mota_en'] = magic_quote($_POST['mota_en']);
    $data['mota_jp'] = $_POST['mota_jp'];
    
    $data['noidung_vi'] = magic_quote($_POST['noidung_vi']);
    $data['noidung_en'] = magic_quote($_POST['noidung_en']);
    $data['noidung_jp'] = $_POST['noidung_jp'];

    $data['title_vi'] = magic_quote($_POST['title_vi']);
    $data['title_en'] = magic_quote($_POST['title_en']);
    $data['title_jp'] = $_POST['title_jp'];
    
    $data['keywords_vi'] = magic_quote($_POST['keywords_vi']);
    $data['keywords_en'] = magic_quote($_POST['keywords_en']);
    $data['keywords_jp'] = $_POST['keywords_jp'];
    
    $data['description_vi'] = magic_quote($_POST['description_vi']);
    $data['description_en'] = magic_quote($_POST['description_en']);
    $data['description_jp'] = $_POST['description_jp'];
    $data['stt'] = $_POST['stt'];
    $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
    $data['h1'] = $_POST['h1'];
    $data['h2'] = $_POST['h2'];
    $data['h3'] = $_POST['h3'];
    $data['tag_vi'] = $_POST['tag_vi'];
    $data['tag_en'] = $_POST['tag_en'];
    $ar1=array();
    $ar_tag1=explode(",",$_POST["tag_vi"]);
    foreach($ar_tag1 as $k=>$v){
        $ar1[$k]=changeTitle($v);
    }
    
    $data['tag_slug_vi'] = implode($ar1,",");
    
    $ar2=array();
    $ar_tag2=explode(",",$_POST["tag_en"]);
    foreach($ar_tag2 as $k=>$v){
        $ar2[$k]=changeTitle($v);
    }
    
    $data['tag_slug_en'] = implode($ar2,",");
    
    if ($id) { 
        $id = themdau($_POST['id']);
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product, $file_name)) {
            $data['photo'] = $photo;
            //$data['thumb'] = create_thumb($data['photo'], 290, 350, _upload_product, $file_name, 2);
            $d->setTable('product');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_product . $row['photo']);
                //delete_file(_upload_product . $row['thumb']);
            }
        }
        if ($photo = upload_image("file1", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product, $file_name1)) {
            $data['photo1'] = $photo;
            //$data['thumb'] = create_thumb($data['photo'], 290, 350, _upload_product, $file_name, 2);
            $d->setTable('product');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_product . $row['photo']);
                //delete_file(_upload_product . $row['thumb']);
            }
        }
        if ($file = upload_image("file2", 'pdf|doc|docx|xls|xlsx|rar|zip|PDF|DOC|DOCX|XLS|XLSX|RAR|ZIP', _upload_product, $file_name2)) {
            $data['file'] = $file;
            //$data['thumb'] = create_thumb($data['photo'], 290, 350, _upload_product, $file_name, 2);
            $d->setTable('product');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_product . $row['file']);
                //delete_file(_upload_product . $row['thumb']);
            }
        }
        $count=count($_POST["id_parent"]);
        $data['id_item'] = ($_POST["id_parent"][$count-1]);
        if($data['id_item']=='') {
            $data['id_item'] = 0;
        }
        $data['id_list'] = (int) ($_POST["id_parent"][0]);
        $data['id_cat'] = (int) $_POST['id_cat'];
        $data["list_id"]=implode($_POST["id_parent"],",");
        //$data["option_search"]=implode($_POST["option"],",");
        
        $data['ngaysua'] = time();
            
        $d->setTable('product');
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
                        if(move_uploaded_file($myFile["tmp_name"][$i], _upload_product."/".$file_name."_".$myFile["name"][$i])){                                                
                            $data1['stt'] = (int)$_POST['stthinh'][$i];
                            $data1['photo'] = $file_name."_".$myFile["name"][$i];   
                            $data1['id_photo'] = $id;
                            $data1['hienthi'] = 1;
                            $d->setTable('product_hinhanh');
                            $d->insert($data1);
                        }
                    }
                }
            }
            redirect("default.php?com=product&act=man&type=".$type."&curPage=" . $_REQUEST['curPage'] . "");
        }
            
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=product&act=man&type=".$type);
    }else {
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product, $file_name)) {
            $data['photo'] = $photo;
            //$data['thumb'] = create_thumb($data['photo'], 290, 350, _upload_product, $file_name, 2);
        }
        if ($photo = upload_image("file1", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product, $file_name1)) {
            $data['photo1'] = $photo;
            //$data['thumb'] = create_thumb($data['photo'], 290, 350, _upload_product, $file_name, 2);
        }
        if ($file = upload_image("file2", 'pdf|doc|docx|xls|xlsx|rar|zip|PDF|DOC|DOCX|XLS|XLSX|RAR|ZIP', _upload_product, $file_name2)) {
            $data['file'] = $file;
            //$data['thumb'] = create_thumb($data['photo'], 290, 350, _upload_product, $file_name, 2);
        }
        $count=count($_POST["id_parent"]);
        $data['id_item'] = ($_POST["id_parent"][$count-1]);
        if($data['id_item']=='') {
            $data['id_item'] = 0;
        }
        $data['id_list'] = (int) ($_POST["id_parent"][0]);
        $data["list_id"]=implode($_POST["id_parent"],",");
        $data['id_cat'] = (int) $_POST['id_cat'];
        //$data["option_search"]=implode($_POST["option"],",");

        
        $data['ngaytao'] = time();
        
        $d->setTable('product');
        if ($d->insert($data)) {
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
                        if(move_uploaded_file($myFile["tmp_name"][$i], _upload_product."/".$file_name."_".$myFile["name"][$i])){                                                
                            $data1['stt'] = (int)$_POST['stthinh'][$i];
                            $data1['photo'] = $file_name."_".$myFile["name"][$i];   
                            $data1['id_photo'] = $id_insert;
                            $data1['hienthi'] = 1;
                            $d->setTable('product_hinhanh');
                            $d->insert($data1);
                        }
                      }
                }
            }
            redirect("default.php?com=product&act=man&type=".$type);
        } else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=product&act=man&type=".$type);
    }
}

function delete_item() {
    global $d, $type;
    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);

        $d->reset();
        $sql = "select * from #_product where id='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            while ($row = $d->fetch_array()) {
                delete_file(_upload_product . $row['photo']);
                delete_file(_upload_product . $row['thumb']);
                
                $d->reset();
                $sql="select * from #_product_hinhanh where id_photo='".$row['id']."' order by id";
                $d->query($sql);
                if($d->num_rows()>0){
                    $rs=$d->result_array();
                    foreach($rs as $v){
                        delete_file(_upload_product . $v['photo']);
                        $sql = "delete from #_product_hinhanh where id='" . $v["id"] . "'";
                        $d->query($sql);
                    }
                }
                
            }
            $sql = "delete from #_product where id='" . $id . "'";
            $d->query($sql);
        }

        if ($d->query($sql))
            redirect("default.php?com=product&act=man&type=".$type);
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=product&act=man&type=".$type);
    }elseif (isset($_GET['listid']) == true) {
        $listid = explode(",", $_GET['listid']);
        for ($i = 0; $i < count($listid); $i++) {
            $idTin = $listid[$i];
            $id = themdau($idTin);
            $d->reset();
            $sql = "select * from #_product where id='" . $id . "'";
            $d->query($sql);
            if ($d->num_rows() > 0) {
                while ($row = $d->fetch_array()) {
                    delete_file(_upload_product . $row['photo']);
                    delete_file(_upload_product . $row['thumb']);
                    $d->reset();
                    $sql="select * from #_product_hinhanh where id_photo='".$row['id']."' order by id";
                    $d->query($sql);
                    if($d->num_rows()>0){
                        $rs=$d->result_array();
                        foreach($rs as $v){
                            delete_file(_upload_product . $rs['photo']);
                            $sql = "delete from #_product_hinhanh where id='" . $v["id"] . "'";
                            $d->query($sql);
                        }
                    }
                }
                $sql = "delete from #_product where id='" . $id . "'";
                $d->query($sql);
            }
        } redirect("default.php?com=product&act=man&type=".$type);
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man&type=".$type);
}

function get_lists() {
    global $d, $items, $paging, $type, $subcat;
    #----------------------------------------------------------------------------------------
    if(!empty($_POST)){
        $multi=$_REQUEST['multi'];
        $id_array=$_POST['iddel'];
        $count=count($id_array);
        if($multi=='show'){
            for($i=0;$i<$count;$i++){
                $sql = "UPDATE table_product_list SET hienthi =1 WHERE  id = ".$id_array[$i]."";
                mysql_query($sql) or die("Not query sqlUPDATE_ORDER");              
            }
            redirect("default.php?com=product&act=man_list&type=".$type."&subcat=".$subcat);            
        }
        
        if($multi=='hide'){
            for($i=0;$i<$count;$i++){
                $sql = "UPDATE table_product_list SET hienthi =0 WHERE  id = ".$id_array[$i]."";
                mysql_query($sql) or die("Not query sqlUPDATE_ORDER");              
            }
            redirect("default.php?com=product&act=man_list&type=".$type."&subcat=".$subcat);            
        }
        
        if($multi=='del'){
            for($i=0;$i<$count;$i++){
                
                $sql = "select id,thumb, photo from #_product_list where id= ".$id_array[$i]."";
                $d->query($sql);
                if($d->num_rows()>0){
                    while($row = $d->fetch_array()){
                        delete_file(_upload_product.$row['photo']);
                        delete_file(_upload_product.$row['thumb']);         
                    }
                }
                $sql = "delete from table_product_list where id = ".$id_array[$i]."";
                
                if(mysql_query($sql)){
                }
            }
            redirect("default.php?com=product&act=man_list&type=".$type."&subcat=".$subcat);        
        }
        
        
    }

    $sql = "select * from #_product_list where com='".$subcat."' and type='".$type."' ";
    if($_REQUEST["id_parents"]!=''){
        $sql.=" and id_parent='".$_REQUEST["id_parents"]."' ";
    }
    $sql.=" order by id_parent,stt,id desc";

    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=product&act=man_list&type=".$type."&subcat=".$subcat." ";
    $maxR = 15;
    $maxP = 10;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_list() {
    global $d, $item, $type,$subcat;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man_list&type=".$type."&subcat=".$subcat."");
    $sql = "select * from #_product_list where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=product&act=man_list&type=".$type."&subcat=".$subcat."");
    $item = $d->fetch_array();
}

function save_list() {
    global $d, $type,$subcat;
    $file_name = fns_Rand_digit(0, 9, 12); $file_name1 = fns_Rand_digit(0, 9, 12);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man_list&type=".$type."&subcat=".$subcat."");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    //$data['parent_id'] = $_POST['parent_id'];
    //Phần dữ liệu chung
    $data['ten_vi'] = $_POST['ten_vi'];
    $data['ten_en'] = $_POST['ten_en'];
    $data['ten_jp'] = $_POST['ten_jp'];
    $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
    $data['title_vi'] = $_POST['title_vi'];
    $data['title_en'] = $_POST['title_en'];
    $data['title_jp'] = $_POST['title_jp'];
    $data['keywords_vi'] = $_POST['keywords_vi'];
    $data['keywords_en'] = $_POST['keywords_en'];
    $data['keywords_jp'] = $_POST['keywords_jp'];
    $data['description_jp'] = $_POST['description_jp'];
    $data['description_vi'] = $_POST['description_vi'];
    $data['description_en'] = $_POST['description_en'];
    $data['noidung_jp'] = $_POST['noidung_jp'];
    $data['noidung_vi'] = $_POST['noidung_vi'];
    $data['noidung_en'] = $_POST['noidung_en'];
    $data['com'] = $subcat;
    $data['type'] = $type;
    $data['h1'] = $_POST['h1'];
    $data['h2'] = $_POST['h2'];
    $data['h3'] = $_POST['h3'];
    if ($id) {
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product, $file_name)) {
            $data['photo'] = $photo;
            $d->setTable('product_list');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_product . $row['file']);
            }
        }
        if ($photo1 = upload_image("file1", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product, $file_name1)) {
            $data['avata'] = $photo1;
            $d->setTable('product_list');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_product . $row['file']);
            }
        }
        
        if(!empty($_POST["id_parent"])){
        $data['set_level'] = implode($_POST["id_parent"],'|');
        }
        $count=count($_POST["id_parent"]);
        $data['id_parent'] = ($_POST["id_parent"][$count-1]);
        if ($data['id_parent']=='') {
            $data['id_parent'] = 0;
        }
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaysua'] = time();
        
        $d->setTable('product_list');
        $d->setWhere('id', $id);
        if ($d->update($data))
            redirect("default.php?com=product&act=man_list&type=".$type."&subcat=".$subcat."&curPage=" . $_REQUEST['curPage'] . "");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=product&act=man_list&type=".$type."&subcat=".$subcat."");
    }else {
        
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product, $file_name)) {
            $data['photo'] = $photo;
        }
        if ($photo1 = upload_image("file1", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product, $file_name1)) {
            $data['avata'] = $photo1;
        }
        
        if(!empty($_POST["id_parent"])){
        $data['set_level'] = implode($_POST["id_parent"],'|');
        }
        $count=count($_POST["id_parent"]);
        $data['id_parent'] = ($_POST["id_parent"][$count-1]);
        if ($data['id_parent']=='') {
            $data['id_parent'] = 0;
        }
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaytao'] = time();

        $d->setTable('product_list');
        if ($d->insert($data))
            redirect("default.php?com=product&act=man_list&type=".$type."&subcat=".$subcat."");
        else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=product&act=man_list&type=".$type."&subcat=".$subcat."");
    }
}

function delete_list() {
    global $d, $type,$subcat;
    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->reset();
        $sql = "select * from #_product_list where id='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            while ($row = $d->fetch_array()) {
                delete_file(_upload_product . $row['photo']);
                delete_file(_upload_product . $row['thumb']);
            }
            $sql = "delete from #_product_list where id='" . $id . "'";
            $d->query($sql);
        }
        if ($d->query($sql))
            redirect("default.php?com=product&act=man_list&type=".$type."&subcat=".$subcat."");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=product&act=man_list&type=".$type."&subcat=".$subcat."");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man_list&type=".$type."&subcat=".$subcat."");
}

/* --------------------------------------------- */

function get_photos() {
    global $d, $items, $paging, $subcat;
    #----------------------------------------------------------------------------------------
    if ($_REQUEST['hienthi'] != '') {
        $id_up = $_REQUEST['hienthi'];
        $sql_sp = "SELECT id,hienthi FROM table_product_hinhanh where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $hienthi = $cats[0]['hienthi'];
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_product_hinhanh SET hienthi =1 WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_product_hinhanh SET hienthi =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }



    $sql = "select * from #_product_hinhanh where ( id_photo = '" . $_REQUEST['idc'] . "' OR '" . $_REQUEST['idc'] . "'=0  ) and com='".$subcat."' order by stt,id desc ";
    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=product&act=man_photo&idc=" . $_REQUEST['idc'] . "&subcat=".$subcat;
    $maxR = 10;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_photo() {
    global $d, $item, $list_cat, $subcat;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man_photo&idc=" . $_REQUEST['idc'] . "&subcat=".$subcat);

    $d->setTable('product_hinhanh');
    $d->setWhere('com', $subcat);
    $d->setWhere('id', $id);
    $d->select();
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=product&act=man_photo&idc=" . $_REQUEST['idc'] . "&subcat=".$subcat);
    $item = $d->fetch_array();
    $d->reset();
}

function save_photo() {
    global $d, $subcat;
    $file_name = fns_Rand_digit(0, 9, 10);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man_photo&idc=" . $_REQUEST['idc'] . "&subcat=".$subcat);

    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) { // cap nhat
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|Jpg|JPEG', _upload_product, $file_name)) {
            $data['photo'] = $photo;
            $data['thumb'] = create_thumb($data['photo'], 300, 300, _upload_product, $file_name . $i, 1);
            $d->setTable('product_hinhanh');
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
        $data['vitri'] = $_POST['vitri'];
        $data['stt'] = $_POST['stt'];
        $data['link'] = $_POST['link'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['com'] = $subcat;
        $d->reset();
        $d->setTable('product_hinhanh');
        $d->setWhere('id', $id);
        if (!$d->update($data))
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=product&act=man_photo&idc=" . $_REQUEST['idc'] . "&subcat=".$subcat);
        redirect("default.php?com=product&act=man_photo&idc=" . $_REQUEST['idc'] . "&subcat=".$subcat);
    } { // them moi
        for ($i = 0; $i < 5; $i++) {
            if ($photo = upload_image("file" . $i, 'jpg|png|gif|JPG|jpeg|Jpg|JPEG', _upload_product, $file_name . $i)) {
                $data['photo'] = $photo;
                $data['thumb'] = create_thumb($data['photo'], 300, 300, _upload_product, $file_name . $i, 1);

                $data['mota'] = "mota :" . $i;

                $data['stt'] = $_POST['stt' . $i];
                $data['mota'] = $_POST['mota' . $i];
                $data['vitri'] = $_POST['vitri' . $i];
                $data['link'] = $_POST['link'.$i];
                $data['hienthi'] = isset($_POST['hienthi' . $i]) ? 1 : 0;
                $data['com'] = $subcat;

                $data['id_photo'] = $_REQUEST['idc'];

                $d->setTable('product_hinhanh');
                if (!$d->insert($data))
                    transfer("Lưu dữ liệu bị lỗi", "default.php?com=product&act=man_photo&idc=" . $_REQUEST['idc'] . "&subcat=".$subcat);
            }
        }
        redirect("default.php?com=product&act=man_photo&idc=" . $_REQUEST['idc'] . "&subcat=".$subcat);
    }
}

function delete_photo() {
    global $d, $subcat;

    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->setTable('product_hinhanh');
        $d->setWhere('id', $id);
        $d->select();
        if ($d->num_rows() == 0)
            transfer("Dữ liệu không có thực", "default.php?com=product&act=man_photo&idc=" . $_REQUEST['idc'] . "&subcat=".$subcat);
        $row = $d->fetch_array();
        delete_file(_upload_product . $row['photo']);
        delete_file(_upload_product . $row['thumb']);
        if ($d->delete())
            redirect("default.php?com=product&act=man_photo&idc=" . $_REQUEST['idc'] . "&subcat=".$subcat);
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=product&act=man_photo&idc=" . $_REQUEST['idc'] . "&subcat=".$subcat);
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man_photo&idc=" . $_REQUEST['idc'] . "&subcat=".$subcat);
}
function get_tabs() {
    global $d, $items, $paging;
    #----------------------------------------------------------------------------------------
    if ($_REQUEST['hienthi'] != '') {
        $id_up = $_REQUEST['hienthi'];
        $sql_sp = "SELECT id,hienthi FROM table_product_tab where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $hienthi = $cats[0]['hienthi'];
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_product_tab SET hienthi =1 WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_product_tab SET hienthi =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }



    $sql = "select * from #_product_tab where ( id_photo = '" . $_REQUEST['idc'] . "' OR '" . $_REQUEST['idc'] . "'=0  ) order by stt,id desc ";
    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=product&act=man_tab&idc=" . $_REQUEST['idc'] . "";
    $maxR = 10;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_tab() {
    global $d, $item, $list_cat;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man_tab&idc=" . $_REQUEST['idc'] . "");

    $d->setTable('product_tab');
    $d->setWhere('id', $id);
    $d->select();
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=product&act=man_tab&idc=" . $_REQUEST['idc'] . "");
    $item = $d->fetch_array();
    $d->reset();
}

function save_tab() {
    global $d;
    $file_name = fns_Rand_digit(0, 9, 10);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man_tab&idc=" . $_REQUEST['idc'] . "");

    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) { // cap nhat
        
        $data['id'] = $_REQUEST['id'];
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['noidung_vi'] = $_POST['noidung_vi'];
        $data['noidung_en'] = $_POST['noidung_en'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['com'] = 'product';
        $d->reset();
        $d->setTable('product_tab');
        $d->setWhere('id', $id);
        if (!$d->update($data))
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=product&act=man_tab&idc=" . $_REQUEST['idc'] . "");
        redirect("default.php?com=product&act=man_tab&idc=" . $_REQUEST['idc'] . "");
    } { // them moi
        $data['stt'] = $_POST['stt'];
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['noidung_vi'] = $_POST['noidung_vi'];
        $data['noidung_en'] = $_POST['noidung_en'];
        $data['id_photo'] = $_REQUEST['idc'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $d->setTable('product_tab');
        if (!$d->insert($data))
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=product&act=man_tab&idc=" . $_REQUEST['idc'] . "");
        else
        redirect("default.php?com=product&act=man_tab&idc=" . $_REQUEST['idc'] . "");
    }
}

function delete_tab() {
    global $d;

    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->setTable('product_tab');
        $d->setWhere('id', $id);
        $d->select();
        if ($d->num_rows() == 0)
            transfer("Dữ liệu không có thực", "default.php?com=product&act=man_tab&idc=" . $_REQUEST['idc'] . "");
        $row = $d->fetch_array();
        delete_file(_upload_product . $row['tab']);
        delete_file(_upload_product . $row['thumb']);
        if ($d->delete())
            redirect("default.php?com=product&act=man_tab&idc=" . $_REQUEST['idc'] . "");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=product&act=man_tab&idc=" . $_REQUEST['idc'] . "");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man_tab&idc=" . $_REQUEST['idc'] . "");
}
//Quản trị màu sắc sản phẩm
function get_colors() {
    global $d, $items, $paging;

    $sql = "select * from #_product_color where ( id_item = '" . $_REQUEST['idc'] . "' OR '" . $_REQUEST['idc'] . "'=0  ) order by stt,id desc ";
    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=product&act=man_color&idc=" . $_REQUEST['idc'] . "";
    $maxR = 10;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_color() {
    global $d, $item, $list_cat;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man_color&idc=" . $_REQUEST['idc'] . "");

    $d->settable('product_color');
    $d->setWhere('id', $id);
    $d->select();
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=product&act=man_color&idc=" . $_REQUEST['idc'] . "");
    $item = $d->fetch_array();
    $d->reset();
}

function save_color() {
    global $d;
    $file_name = fns_Rand_digit(0, 9, 10);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man_color&idc=" . $_REQUEST['idc'] . "");

    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) { // cap nhat
        
        $data['id'] = $_REQUEST['id'];
        $data['ten'] = $_POST['ten'];
        $data['color'] = $_POST['color'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['com'] = 'product';
        $d->reset();
        $d->settable('product_color');
        $d->setWhere('id', $id);
        if (!$d->update($data))
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=product&act=man_color&idc=" . $_REQUEST['idc'] . "");
        redirect("default.php?com=product&act=man_color&idc=" . $_REQUEST['idc'] . "");
    } { // them moi
        $data['stt'] = $_POST['stt'];
        $data['ten'] = $_POST['ten'];
        $data['color'] = $_POST['color'];
        $data['id_item'] = $_REQUEST['idc'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $d->settable('product_color');
        if (!$d->insert($data))
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=product&act=man_color&idc=" . $_REQUEST['idc'] . "");
        else
        redirect("default.php?com=product&act=man_color&idc=" . $_REQUEST['idc'] . "");
    }
}

function delete_color() {
    global $d;

    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->settable('product_color');
        $d->setWhere('id', $id);
        $d->select();
        if ($d->num_rows() == 0)
            transfer("Dữ liệu không có thực", "default.php?com=product&act=man_color&idc=" . $_REQUEST['idc'] . "");
        $row = $d->fetch_array();
        delete_file(_upload_product . $row['color']);
        delete_file(_upload_product . $row['thumb']);
        if ($d->delete())
            redirect("default.php?com=product&act=man_color&idc=" . $_REQUEST['idc'] . "");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=product&act=man_color&idc=" . $_REQUEST['idc'] . "");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man_color&idc=" . $_REQUEST['idc'] . "");
}
//Quản trị size sản phẩm
function get_sizes() {
    global $d, $items, $paging;
    
    $sql = "select * from #_product_size where ( id_item = '" . $_REQUEST['idc'] . "' OR '" . $_REQUEST['idc'] . "'=0  ) order by stt,id desc ";
    $d->query($sql);

    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=product&act=man_size&idc=" . $_REQUEST['idc'] . "";
    $maxR = 10;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_size() {
    global $d, $item, $list_cat;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man_size&idc=" . $_REQUEST['idc'] . "");

    $d->settable('product_size');
    $d->setWhere('id', $id);
    $d->select();
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=product&act=man_size&idc=" . $_REQUEST['idc'] . "");
    $item = $d->fetch_array();
    $d->reset();
}

function save_size() {
    global $d;
    $file_name = fns_Rand_digit(0, 9, 10);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man_size&idc=" . $_REQUEST['idc'] . "");

    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) { // cap nhat
        
        $data['id'] = $_REQUEST['id'];
        $data['ten'] = $_POST['ten'];
        $data['gia'] = (int)$_POST['gia'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['com'] = 'product';
        $d->reset();
        $d->settable('product_size');
        $d->setWhere('id', $id);
        if (!$d->update($data))
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=product&act=man_size&idc=" . $_REQUEST['idc'] . "");
        redirect("default.php?com=product&act=man_size&idc=" . $_REQUEST['idc'] . "");
    } { // them moi
        $data['stt'] = $_POST['stt'];
        $data['ten'] = $_POST['ten'];
        $data['gia'] = (int)$_POST['gia'];
        $data['id_item'] = $_REQUEST['idc'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $d->settable('product_size');
        if (!$d->insert($data))
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=product&act=man_size&idc=" . $_REQUEST['idc'] . "");
        else
        redirect("default.php?com=product&act=man_size&idc=" . $_REQUEST['idc'] . "");
    }
}

function delete_size() {
    global $d;

    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->settable('product_size');
        $d->setWhere('id', $id);
        $d->select();
        if ($d->num_rows() == 0)
            transfer("Dữ liệu không có thực", "default.php?com=product&act=man_size&idc=" . $_REQUEST['idc'] . "");
        $row = $d->fetch_array();
        delete_file(_upload_product . $row['size']);
        delete_file(_upload_product . $row['thumb']);
        if ($d->delete())
            redirect("default.php?com=product&act=man_size&idc=" . $_REQUEST['idc'] . "");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=product&act=man_size&idc=" . $_REQUEST['idc'] . "");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=man_size&idc=" . $_REQUEST['idc'] . "");
}
function get_duyetbl() {
    global $d, $items, $paging;
    if (@$_REQUEST['hienthi'] != '') {
        $id_up = @$_REQUEST['hienthi'];
        $sql_sp = "SELECT id,hienthi FROM table_product_bl where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $hienthi = $cats[0]['hienthi'];
        //echo "id:". $spdc1;
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_product_bl SET hienthi =1 WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_product_bl SET hienthi =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }

    $sql = "select * from #_product_bl";
    $sql.=" order by id desc";
    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=product&act=duyetbl";
    $maxR = 20;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function delete_binhluan() {
    global $d;
    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $sql = "delete from #_product_bl where id='" . $id . "'";
        if ($d->query($sql))
            redirect("default.php?com=product&act=duyetbl");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=product&act=duyetbl");
    }elseif (isset($_GET['listid']) == true) {
        $listid = explode(",", $_GET['listid']);
        for ($i = 0; $i < count($listid); $i++) {
            $idTin = $listid[$i];
            $id = themdau($idTin);
            $d->reset();

            $sql = "delete from #_product_bl where id='" . $id . "'";
            $d->query($sql);
        }redirect("default.php?com=product&act=duyetbl");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=product&act=duyetbl");
}

?>