<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , '../libraries/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";		
	$login_name = 'NINACO';	
	
	
	$d = new database($config['database']);
	
	$do = (isset($_REQUEST['do'])) ? addslashes($_REQUEST['do']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	
	//Kiem tra dang nhap admin
	if($do=='admin'){
		if($act=='login'){
			$username = $_POST['email'];
			$password = $_POST['pass'];
			$username=trim($username);
			$password=trim($password);			
			if (get_magic_quotes_gpc()== false) {
				$username=trim(mysql_real_escape_string($username));
				$password=trim(mysql_real_escape_string($password));
			}			
			$sql = "select * from #_user where username='".$username."'";
			$d->query($sql);
			if($d->num_rows() == 1){
				$row = $d->fetch_array();
				
				//echo (encrypt_password($password,$config['salt']));
				//die();
				//if($row['password'] == encrypt_password($password,$config['salt'])){
				if($row['password'] == md5(md5("@Ibrand".$password.$config["salt"]))){
					if($row['hienthi']==1){
						$_SESSION[$login_name] = true;
						$_SESSION['isLoggedIn'] = true;
						$_SESSION['login']['id']=$row['id'];
						$_SESSION['login']['role']=$row['id_role'];
						$_SESSION['login']['username'] = $row['username'];
						 if (strlen($_SESSION['back'])>0){
							$back = $_SESSION['back'];
							unset($_SESSION['back']);
							die('{"page":"'.$back.'"}');
						 }					
						die('{"page":"default.php"}');
					}else die('{"mess":"Tài khoản bạn chưa kích hoạt!"}');					
				}else die('{"mess":"Mật khẩu không chính xác!"}');
			}else die('{"mess":"Tên đăng nhập không tồn tại!"}');					
		}				
	}

if(!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false) die('Vui lòng đăng nhập!');		

	//Cap nhat so thu tu
	if($do=='number'){
		if($act=='update'){
			$table=addslashes($_POST['table']);
			$id=addslashes($_POST['id']);;
			$num=(int)$_POST['num'];
			$sql="update #_$table set stt='$num' where id='$id' ";
			$d->query($sql);
		}
	}
	
	//Cap nhat trang thai
	if($do=='status'){
		if($act=='update'){						
			$table=addslashes($_POST['table']);
			$id=addslashes($_POST['id']);
			$field=addslashes($_POST['field']);
			$d->reset();						
			$sql="update #_$table set $field =  where id='$id' ";
						
			$cart=array('thanhtien'=>$thanhtien,'tongtien'=>get_tong_tien($id_cart));
			echo json_encode($cart);
		}
	}
	
	//Cap nhat gio hang
	if($do=='cart'){
		if($act=='update'){						
			$id=(int)$_POST['id'];
			$sl=(int)$_POST['sl'];			
			
			$d->reset();						
			$d->query("update #_dhct set soluong='".$sl."' where id='".$id."'");
			$d->reset();
			$sql="select * from #_dhct where id='".$id."'";
			$d->query($sql);
			$result=$d->fetch_array();		
			$id_order = $result['id_dh'];
			$thanhtien=get_price($result['id_sp'])*$result['soluong'];
			$cart=array('thanhtien'=>$thanhtien,'tongtien'=>get_tong_tien($id_order));
			echo json_encode($cart);
		}
	}
	
	//Xoa gio hang
	if($do=='cart'){
		if($act=='delete'){						
			$id=(int)$_POST['id'];			
			$d->reset();			
			$d->query("delete from #_dhct where id='".$id."'");
			
			$d->reset();
			$sql="select * from #_dhct where id='".$id."'";
			$d->query($sql);
			$result=$d->fetch_array();
			$id_order = $result['id_dh'];					
			$cart=array('tongtien'=>get_tong_tien($id_order));
			echo json_encode($cart);
			
		}
	}
	
	//Xoa tag san pham
	if($do=='products'){
		if($act=='tags'){						
			$uni_tag = $_POST['uni_tag'];
			$id=(int)$_POST['id'];			
			$d->reset();			
			$d->query("delete from #_tag where item_id='".$id."' and  	unique_key_tag='$uni_tag'");
		}
	}
	
?>