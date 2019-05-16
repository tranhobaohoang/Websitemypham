<?php if(!defined('_lib')) die("Error");
class Load_Photo extends Base
{

	//	
	function __construct($d){
		parent::__construct($d);		
	}
	//Hien thi tin
	function show_image_detail($fetch_array){
		$str='<div class="image_detail">';
		$str='<div class="img">'.$fetch_array['photo'].'</div>';
		$str='<div class="name">'.$fetch_array['ten'].'</div>';
		$str='</div>';
		

	}
	
	
	//Lấy hình ảnh theo type
	function get_photo_from_type($lang,$type){

		$sql="select p.*,pl.ten from #_photo_lang as pl,#_photo as p where p.com = '$type' and p.id  = pl.id_photo and  pl.lang = '$lang' ";

		$this->db->query($sql);
		return $this->db->result_array();
	}
	
	//Lấy chi tiết hình ảnh
	function get_photo_detail($id='0',$lang='vi',$flagurl=false){						

		//Lấy theo tên không dấu hoặc id
		if($flagurl==true) $sql="select p.*,pl.ten from #_photo_lang as pl,#_photo as p where pl.tenkhongdau = '$id' and p.id  = pl.id_photo and  pl.lang = '$lang' limit 0,1";
		else $sql="select p.*,pl.ten from #_photo_lang as pl,#_photo as p where p.id = '$id' and p.id  = pl.id_photo and  pl.lang = '$lang' limit 0,1";			
		
		$this->db->query($sql);
		return $this->db->fetch_array(); 
		
	}

	//Cập nhật lượt xem
	function update_view($id=0){

		$sql_lanxem = "UPDATE #_photo SET luotxem=luotxem+1  WHERE id ='".$id."'";
		$this->db->query($sql_lanxem);
	}

	//Lấy hình ảnh khác
	function get_orther_photo($id=0,$lang,$type,$number=10){

		$sql="select p.id,pl.ten from #_photo_lang as pl,#_photo as p where p.com = '$type' and  p.id <> $id and p.id  = pl.id_photo and  pl.lang = '$lang' limit 0,$number";
		
		$this->db->query($sql);
		return $this->db->result_array();
	}

	

}