<?php	if(!defined('_source')) die("Error");
	if($_SESSION['login_web']["username"]==''){
		transfer("Bạn chưa đăng nhập.", "dang-nhap.html");
	}
	$user=$_SESSION['login_web']["username"];
	
	$d->reset();
	$sql="select * from #_member where username='".$user."' ";
	$d->query($sql);
	$rs_user=$d->fetch_array();

	
	if(!empty($_POST)){
		if($_POST["passNew"]!=''){
			$data["password"]=md5($_POST["passNew"]);
			$data["old_password"]=$_POST["passNew"];
		}
		$d->reset();
		$d->setTable("member");
		$d->setWhere("username",$user);
		if($d->update($data)){
			transfer("Cập nhật thông tin thành công.", getCurrentPageURL());
		}else{
			transfer("Cập nhật thất bại.", getCurrentPageURL());
		}
	}
	
?>