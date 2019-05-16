<?php
$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$d = new database($config['database']);

$d->reset();
$sql_setting = "select * from #_setting limit 0,1";
$d->query($sql_setting);
$row_setting = $d->fetch_array();

//lấy logo trang
$d->reset();
$sql="select photo_$lang as photo, logo from #_photo where com='banner_top'";
$d->query($sql);
$row_photo = $d->fetch_array();

if(isset($_SESSION["login_web"]["id"]) && $_SESSION["login_web"]["id"]!=''){
	$d->reset();
	$sql="select * from #_member where id='".$_SESSION["login_web"]["id"]."'";
	$d->query($sql);
	$rs_user=$d->fetch_array();
}

$title_custom = '';
$keywords_custom = '';
$description_custom = '';

		
switch ($com) {
    case 'thoat':
        $source = "logout";
        $template = "index";
        break;
    case 'about':
        $source = "about";
		$table="time";
		$type='gioi-thieu';
		$title_bar = _gioithieu . ' - ';
		$title_tcat = _gioithieu;
        $template = "about";
        break;
	case 'bao-mat-thong-tin':
        $source = "about";
		$table="time";
		$type='bao-mat';
		$title_bar = 'Bảo mật thông tin - ';
		$title_tcat = "Bảo mật thông tin";
        $template = "about";
        break;
	case 'dieu-khoan-su-dung':
        $source = "about";
		$table="time";
		$type='dieu-khoan';
		$title_bar = 'Điều khoản sử dụng - ';
		$title_tcat = "Điều khoản sử dụng";
        $template = "about";
        break;
	case 'tuyen-dung':
        $source = "amthuc";
		$table="about";
		$type='tuyen-dung';
		$title_bar = _tuyendung . ' - ';
		$title_tcat = _tuyendung;
        $template = isset($_GET['id']) ? "news_detail" : "news";
        break;
	case 'tin-tuc':
		$table='about';
		$type="tin-tuc";
		$title_bar = 'Em đẹp - ';
		$title_tcat = "Em đẹp";
        $source = "amthuc";
        $template = isset($_GET['id']) ? "news_detail" : "news";
        break;
	case 'thong-tin-dai-ly':
		$table='about';
		$type="thong-tin-dai-ly";
		$title_bar = 'Thông tin đại lý';
		$title_tcat = 'Thông tin đại lý';
        $source = "amthuc";
        $template = isset($_GET['id']) ? "news_detail" : "news";
        break;
	case 'chinh-sach':
		$table='about';
		$type="chinh-sach";
		$title_bar = 'Những chính sách của chúng tôi';
		$title_tcat = 'Chính sách của công ty';
        $source = "amthuc";
        $template = isset($_GET['id']) ? "news_detail" : "news";
        break;
	case 'gio-hang':
        $source = "giohang";
        $template = "giohang";
        break;
	case 'thanh-toan':
        $source = "thanhtoan";
        $template = "thanhtoan";
        break;
	case 'dang-ky':
        $source = "dangki";
        $template = "dangki";
        break;
	case 'dang-nhap':
        $source = "dangnhap";
        $template = "dangnhap";
        break;
	case 'quan-ly-ca-nhan':
        $source = "quanlycanhan";
        $template = "quanlycanhan";
        break;
	case 'doi-mat-khau':
        $source = "doimatkhau";
        $template = "doimatkhau";
        break;
	case 'tag':
        $source = "tag";
        $template = "product";
        break;
    case 'thanh-toan-banking':
			$source = "banking";
			$template ="banking";
			break;
	case 'bang-gia':
		$source = "banggia";
		$template ="banggia";
		break;
    case 'cong-trinh':
        $source = "hinhanh";
        $template = isset($_GET['id']) ? "hinhanh_detail" : "hinhanh";
        break;
    case 'sitemap':
        $source = "sitemap";
        $template = "sitemap";
        break;
    

    case 'lien-he':
        $source = "contact";
        $template = "contact";
        break;
	case 'video':
        $source = "video";
        $template = "video";
        break;

    case 'tim-kiem':
        $source = "search";
        $template = "search";
        break;
    case 'ajax':
        $source = "ajax";
        break;
    
	case 'san-pham':
		$type='san-pham';
		$title_bar = 'Sản phẩm - ';
		$title_tcat = "Sản phẩm";
        $source = "product";
        $template = isset($_GET['id']) ? "product_detail" : "product";
        break;
	case 'khuyen-mai':
		$type='khuyen-mai';
		$title_bar = 'Sản phẩm khuyến mãi - ';
		$title_tcat = "Sản phẩm khuyến mãi";
        $source = "product";
        $template = isset($_GET['id']) ? "product_detail" : "product";
        break;
	case 'user':
        switch ($act){
			case 'kich-hoat-tai-khoan':
				$source = "user/kichhoat";
				$template = "user/kichhoat";
				break;
		}
        break;
    case 'ngonngu':
        if (isset($_GET['lang'])) {
            switch ($_GET['lang']) {
                case 'vi':
                    $_SESSION['lang'] = 'vi';
                    break;
                case 'en':
                    $_SESSION['lang'] = 'en';
                    break;
                case 'jp':
                    $_SESSION['lang'] = 'jp';
                    break;
                default:
                    $_SESSION['lang'] = 'vi';
                    break;
            }
        } else {
            $_SESSION['lang'] = 'vi';
        }
        redirect($_SERVER['HTTP_REFERER']);
        break;

    default:
        $source = "index";
        $template = "index";
        break;
}

if ($source != "")
    include _source . $source . ".php";

if (isset($_REQUEST['com']) && $_REQUEST['com'] == 'logout') {
    session_unregister($login_name);
    header("Location:index.php");
}
?>