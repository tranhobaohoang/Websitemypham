<?php if(!defined('_lib')) die("Error");
class Info extends Base
{

	function __construct($d){
		parent::__construct($d);
	}

	function get_info_detail($id='0'){						
		
		  $sql="select info.*,infoL.ten,infoL.noidung from #_info_lang as infoL,#_info as info where info.id = '$id' and info.id  = infoL.id_info and  infoL.lang =  '".$this->lang."' limit 0,1";			
		$this->db->query($sql);
		return $this->db->fetch_array(); 
	}

}