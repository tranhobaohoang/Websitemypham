<?php if(!defined('_lib')) die("Error");
class video extends Base
{

	function __construct($d){
		parent::__construct($d);
	}
	//Hiển thị video
	function show_video($fetch_array){
		$str='<div class="">';
		$str='<div class="name">'.$fetch_array['ten'].'</div>';
		$str='</div>';
	}
	
	//Lấy danh sách video
	function getVideo($pageNum=1, $pageSize = 10 ){								
		$startRow = ($pageNum-1)*$pageSize;
		$sql="select v.*,vl.tenkhongdau,vl.ten from #_video_lang as vl,#_video as v where v.id  = vl.id_video and  vl.lang = '".$this->lang."' limit $startRow , $pageSize";
		$this->db->query($sql);
		return $this->db->result_array();
	}
	
	//Lấy chi tiết video
	function getVideoById($id='0',$flagurl=false){						
		//Lấy theo tên không dấu hoặc id video
		if($flagurl==true) $sql="select v.*,vl.ten from #_video_lang as vl,#_video as v where vl.tenkhongdau = '$id' and v.id  = vl.id_video and  vl.lang = '".$this->lang."' limit 0,1";
		else $sql="select v.*,vl.ten from #_video_lang as vl,#_video as v where v.id = '$id' and v.id  = vl.id_video and  vl.lang = '".$this->lang."' limit 0,1";					
		$this->db->query($sql);
		return $this->db->fetch_array(); 
	}
	//Cập nhật lượt xem
	function updateView($id=0){		
		$sql_lanxem = "UPDATE #_video SET luotxem=luotxem+1  WHERE id ='".$id."'";
		$this->db->query($sql_lanxem);
	}
	//Lấy video khác
	function getOrtherVideo($id=0,$number=10){		
		$sql="select v.id,v.gia,vl.ten from #_video_lang as vl,#_video as v where v.id <> $id and v.id  = vl.id_video and  vl.lang = '".$this->lang."' limit 0,$number";
		$this->db->query($sql);
		return $this->db->result_array();
	}

	//Số lượng video
	function getNumberVideo(){		
		$sql="select count(*) as sumnumber from #_video_lang as vl,#_video as v where v.id  = vl.id_video and  vl.lang = '".$this->lang."' ";
		$this->db->query($sql);
		$rows_rs = $this->db->fetch_array();
		return  $rows_rs['sumnumber'];
	}
}