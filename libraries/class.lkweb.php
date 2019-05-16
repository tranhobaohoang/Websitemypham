<?php if(!defined('_lib')) die("Error");
class LKWeb extends Base
{

	function __construct($d){
		parent::__construct($d);
	}

	//show record
	function show_record($item){	
		$str='......';
		return $str;
	}

	//Lấy tất cả record
	function list_record(){						
		$sql="select l.*,ll.ten from #_lkweb_lang as ll,#_lkweb as l where hienthi=1 and l.id=ll.id_lkweb and ll.lang = '".$this->lang."' order by stt, id desc";
		$this->db->query($sql);
		return $this->db->result_array();
	}

	// lấy tổng số record
	function total_record(){
		$sql="select count(*) as total from #_lkweb";
		$this->db->query($sql);
		$rows_rs = $this->db->fetch_array();
		return  $rows_rs['total'];
	}

}