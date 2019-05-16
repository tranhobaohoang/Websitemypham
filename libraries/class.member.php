<?php if(!defined('_lib')) die("Error");
class Member extends Base
{

	function __construct($d){
		parent::__construct($d);
	}
	//Lấy thông tin member
	public function getMemberInfoById($id='0'){						
		$sql="select email,ten,dienthoai,diachi,ngaysinh,sex,photo,lastlogin from #_member where id = '$id' limit 0,1";					
		$this->db->query($sql);
		return $this->db->fetch_array(); 
	}
	//Chuyển định dạng ngày sinh
	public function transDate($birthday=0){
		$Ngay_arr = explode("/",$birthday); // array(17,11,2010)
		if (count($Ngay_arr)==3) {
			$ngay = $Ngay_arr[0]; //17
			$thang = $Ngay_arr[1]; //11
			$nam = $Ngay_arr[2]; //2010
			if (checkdate($thang,$ngay,$nam)==false){ } else $ngaysinh=$nam."-".$thang."-".$ngay;
		}	
		$ngaysinh = strtotime($ngaysinh);
		return $ngaysinh;
	}
	//Upload avatar
	function UpdateAvatar($img,$id){
		//Bổ sung sau
	}
	//Cập nhật thông tin member
	public function updateMember($id=0,$nameMember,$phoneMember,$addressMember,$birthdayMember,$sexMember,$photoMember){
		//Hàm lọc dữ liệu đầu vào (bổ sung sau) 

		//Kiểm tra cập nhật Avatar
		$data['photo']=$this->UpdateAvatar($photoMember,$id);
		$data['ngaysinh']=$this->transDate($birthdayMember);//Chuyển đổi định dạng ngày tháng (ngày sinh)
		$data['dienthoai']=$phoneMember;
		$data['diachi']=$addressMember;
		$data['ten']=$nameMember;
		$data['sex']=$sexMember;

		$this->db->reset();
		$this->db->setTable('member');
		$this->db->setWhere('id', $id);		
		$this->db->update($data);
	}
	

}