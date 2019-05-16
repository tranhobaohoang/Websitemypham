<?php	if(!defined('_source')) die("Error");
	@$idl =  addslashes($_GET['user']);
	$d->reset();
	$sql='select * from #_member';
	$d->query($sql);
	$user=$d->result_array();
	$tilte_tcat="Kích hoạt tài khoản";
	$tilte_bar="Kích hoạt tài khoản -";
	$url='http://'.$config_url.'/dang-nhap.html';

	for($i=0;$i<count($user); $i++) {
				
		if(md5($user[$i]['username'])==$idl ){
			if($user[$i]['trangthai']==0){
				$update="update table_member set hienthi='1' where username='".$user[$i]['username']."'";
				$d->query($update);
				transfer("Tài khoản của bạn đã được kích hoạt. Bạn đã có thể đăng nhập vào hệ thống !", $url);	
			}
			else
			{
				transfer("Tài khoản này đã được kích hoạt trước đó. Bạn đã có thể đăng nhập vào hệ thống", $url);
			}
		}
	}
	$breadcrumb = '<a href="http://'.$config_url.'" class="transitionAll" >Trang chủ</a> <i class="fa fa-caret-right"></i> <span>Kích hoạt tài khoản</span>';
	//dump($user);
	
	
	if(isset($_POST['loginE'])){
		login();
	}
	
	
	
	function login(){
	global $d, $login_name;
	if($_POST['txtUser']=="") transfer("Chưa nhập tên tài khoản", "dang-nhap.html");
	if($_POST['txtPass']=="") transfer("Chưa nhập mật khẩu", "dang-nhap.html");
	$username = magic_quote($_POST['txtUser']);
	$password = magic_quote($_POST['txtPass']);
	$sql = "select * from #_user where username='".$username."' and hienthi='1' and active='1'";
	$d->query($sql);
	if($d->num_rows() == 1){
		$row = $d->fetch_array();
		if(($row['password'] == md5($password)) && ($row['role'] == 1)){
			$_SESSION['login_web']['username']=$username;
			$_SESSION['login_web']['tenuser'] = $row['ten'];
			$_SESSION['login_web']['id_user'] = $row['id'];
			if(isset($_POST['remember']) and $_POST['remember']==1){
				setcookie("tenuser", $row['ten'], time()+3600*24*7);
				setcookie("username", $username, time()+3600*24*7);
				setcookie("id_user", $row['id'], time()+3600*24*7);
			}
			$url="index.html";
			transfer("Đăng nhập thành công","trang-chu.html");
			exit();
		}
	}
	transfer("Tên đăng nhập, mật khẩu không chính xác <br/> Hoặc tài khoản của bạn chưa được xác nhận từ Administrator !", "dang-nhap.html");
	exit();
}
?>