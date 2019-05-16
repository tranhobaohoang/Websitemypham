<?php

include ("configajax.php");
	$act=$_POST['act'];
	switch ($act){
		case 'checkemail':
			check_email_create();
			break;
		case 'checkuser_tv':
			check_user_tv();
			break;
		case 'checkpass_tv':
			check_pass_tv();
			break;
		case 'checkrepass_tv':
			check_repass_tv();
			break;
		case 'loaddoanhnghiep':
			load_dn();
			break;
		case 'checkdoanhnghiep':
			check_dn();
			break;
		case 'loadprovince':
			load_provice();
			break;
		case 'district':
			load_district();
			break;
	}
	
?>
<?php


	function load_provice($province){
		global $d;
		$d->reset();
		$sql="select * from #_province";
		$d->query($sql);
		$rs=$d->result_array();
		//$id=$_POST['province'];
		$kq='';
		$kq.= "<option value='0'> --- Chọn tỉnh thành phố ---</option>";
		foreach($rs as $v){
			$kq.= "<option value='".$v['provinceid']."'"; 
			if($v['provinceid']==$province) $kq.=" selected";
			$kq.=" >".$v['type']." ".$v["name"]."</option>";
		}
		return $kq;
	}
	function load_district($province, $district){
		global $d;
		$d->reset();
		$sql="select * from #_district where provinceid='".$province."' order by districtid";
		$d->query($sql);
		$rs=$d->result_array();

		$kq='';
		$kq.= "<option value='0'> --- Chọn quận huyện --- </option>";
		foreach($rs as $v){
			$kq.= "<option value='".$v['districtid']."'"; 
			if($v['districtid']==$district) $kq.=" selected";
			$kq.=" >".$v['type']." ".$v["name"]."</option>";
		}
		return $kq;
	}
	function load_nganhnghe($nganhnghe){
		global $d;
		$d->reset();
		$sql="select * from #_product_danhmuc";
		$d->query($sql);
		$rs=$d->result_array();
		//$id=$_POST['province'];
		$kq='';
		$kq.= "<option value='0'> --- Chọn ngành nghề hoạt động ---</option>";
		foreach($rs as $v){
			$kq.= "<option value='".$v['id']."'"; 
			if($v['id']==$nganhnghe) $kq.=" selected";
			$kq.=" >".$v["ten_vi"]."</option>";
		}
		return $kq;
	}
	function check_email_create(){
		global $d;
		$email=$_POST['email'];
		$d->reset();
		$sql="select email from #_member where email='".$email."' ";
		$d->query($sql);
		$rs_email=$d->result_array();
		
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  echo "<i class='glyphicon glyphicon-remove red-color'></i> <span class='blue-color'>Email không đúng định dạng.</span>";
		}
		else if(count($rs_email)>0){
			echo "<i class='glyphicon glyphicon-remove red-color'></i> <span class='blue-color'>Email này đã được sử dụng.</span>";
			
		}else{
			echo "<i class='glyphicon glyphicon-ok green-color'></i> <span class='blue-color'>Bạn có thể sử dụng email này</span> ";
		}
	}
	function check_user_tv(){
		global $d;
		$username=$_POST['username'];
		$d->reset();
		$sql="select email from #_member where username='".$username."' ";
		$d->query($sql);
		$rs_email=$d->result_array();
		
		if (!isset($username) || (strlen ($username)<8)) {
		  echo "<i class='glyphicon glyphicon-remove red-color'></i> <span class='blue-color'>Tên đăng nhập phải lớn hơn 8 kí tự.</span>";
		}else if (preg_match('/[^a-zA-Z0-9_]/', $username) != 0) {
		  echo "<i class='glyphicon glyphicon-remove red-color'></i> <span class='blue-color'>Tên đăng nhập không hợp lệ. Tên đăng nhập không chứa ký tự đặc biệt</span>";
		}
		else if(count($rs_email)>0){
			echo "<i class='glyphicon glyphicon-remove red-color'></i> <span class='blue-color'>Tài khoản này đã được sử dụng.</span>";
			
		}else{
			echo "<i class='glyphicon glyphicon-ok green-color'></i> <span class='blue-color'>Bạn có thể sử dụng tài khoản này</span> ";
		}
	}
	function check_pass_tv(){
		global $d;
		$pass=$_POST['matkhau'];

		if (!isset($pass) || (strlen ($pass)<8)) {
		  echo "<i class='glyphicon glyphicon-remove red-color'></i> <span class='blue-color'>Mật khẩu quá ngắn. Mật khẩu phải lớn hơn 8 kí tự.</span>";
		}
		else if(preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $pass)){
			echo "<i class='glyphicon glyphicon-ok green-color'></i> <span class='blue-color'>Độ bảo mật của mật khẩu tốt.</span>";
		}
		else {
			echo "<i class='glyphicon glyphicon-ok green-color'></i> <span class='blue-color'>Độ bảo mật của mật khẩu trung bình.</span>";
		}
			
	}
	function check_repass_tv(){
		global $d;
		$pass=$_POST['pass'];
		$repass=$_POST['repass'];

		if ($repass==$pass) {
		  echo "<i class='glyphicon glyphicon-ok green-color'></i>";
		}
		
		else {
			echo "<i class='glyphicon glyphicon-remove red-color'></i> <span class='blue-color'>Nhập lại mật khẩu sai.</span>";
		}
			
	}
	function load_dn(){
		global $d;
		$key=mysql_real_escape_string($_POST['string']);
		
		$d->reset();
		$sql="select ten_vi, id from #_member where ten_vi LIKE '%$key%' and com='doanhnghiep' and trangthai=0 order by id desc";
		$d->query($sql);
		$rs=$d->result_array();
		
		foreach($rs as $v){
			echo '<div class="dn_item" data-name="'.$v['ten_vi'].'" data-id="'.$v['id'].'">'.$v['ten_vi'].'</div>';
		}
		echo '<script type="text/javascript">
					$(document).ready(function(e) {
						$(".dn_item").click(function(){
							$name=$(this).attr("data-name");
							$id=$(this).attr("data-id");
							fillme($name,$id);
							
						})
						$("body").click(function(){
							if($(".load_dn").height()>2){
								$(".load_dn").html("");
							}
						})
					});
				</script>';
	}
	function check_dn(){
		global $d;
		$id=$_POST['username'];
		$d->reset();
		$sql="select * from #_member where ten_vi='".$id."'";
		$d->query($sql);
		$rs=$d->fetch_array();
		
		if ($rs['trangthai']==0) {
		  $thongbao= "<i class='glyphicon glyphicon-ok green-color'></i> Bạn có thể đăng ký doanh nghiệp này";
			$rs['thongbao']=$thongbao;
			$rs['date']= date("d/m/Y",$rs['ngayhoatdong']);
			$rs['load_province']=load_provice($rs['province']);
			$rs['load_district']=load_district($rs['province'],$rs['district']);
			$rs['load_nganhnghe']=load_nganhnghe($rs['nganhnghe']);
			echo json_encode($rs);
		}
		
		else {
			$thongbao= "<i class='glyphicon glyphicon-remove red-color'></i> <span class='blue-color'>Doanh nghiệp này đã có người sở hữu, bạn vui lòng chọn tên khác.</span>";
			$rs_1['thongbao']=$thongbao;
			$rs_1['load_province']=load_provice(79);
			$rs_1['load_district']=load_district(79,0);
			$rs_1['load_nganhnghe']=load_nganhnghe(0);
			echo json_encode($rs_1);
		}
		
		die;
	}
?>
