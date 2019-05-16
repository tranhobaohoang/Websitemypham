<?php	if(!defined('_source')) die("Error");
	if($_SESSION['login_web']["username"]==''){
		transfer("Bạn chưa đăng nhập.", "dang-nhap.html");
	}
	$user=$_SESSION['login_web']["username"];
	$d->reset();
	$sql="select * from #_member where username='".$user."' ";
	$d->query($sql);
	$rs_user=$d->fetch_array();

	$d->reset();
	$sql="select * from #_donhang where username='".$user."' order by id desc";
	$d->query($sql);
	$items_dh = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "thong-tin-tai-khoan.html";
    $maxR = 20;
    $maxP = 20;
    $paging = paging($items_dh, $url, $curPage, $maxR, $maxP);
    $items_dh = $paging['source'];
	
?>