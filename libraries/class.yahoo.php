<?php if(!defined('_lib')) die("Error");
class Support_Online extends Base
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
		$sql="select y.*,yl.ten from #_yahoo_lang as yl,#_yahoo as y where hienthi=1 and y.id=yl.id_yahoo and yl.lang = '".$this->lang."' order by stt, id desc";
		$this->db->query($sql);
		return $this->db->result_array();
	}

	// lấy tổng số lượng record
	function total_record(){
		$sql="select count(*) as total from #_yahoo";
		$this->db->query($sql);
		$rows_rs = $this->db->fetch_array();
		return  $rows_rs['total'];
	}

}