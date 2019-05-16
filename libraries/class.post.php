<?php if(!defined('_lib')) die("Error");
class Post extends Base
{

	function __construct($d){
		parent::__construct($d);
	}

	//Hien thi bài viết
	function show_post($fetch_array){
		$str='<div class="">';
		$str='<div class="name">'.$fetch_array['ten'].'</div>';
		$str='</div>';
	}
	//Lấy chi tiết bài viết
	function getPostById($id='0',$flagurl=false,$type){						
		//Lấy theo tên không dấu hoặc id bài viết
		if($flagurl==true) $sql="select p.*,pl.ten from #_post_lang as pl,#_post as p where pl.tenkhongdau = '$id' and p.id  = pl.id_post and  pl.lang = '".$this->lang."' and  p.type='".$type."' limit 0,1";
		else $sql="select p.*,pl.ten from #_post_lang as pl,#_post as p where p.id = '$id' and p.id  = pl.id_post and  pl.lang = '".$this->lang."' and  p.type='".$type."' limit 0,1";					
		$this->db->query($sql);
		return $this->db->fetch_array(); 
	}
	//Cập nhật lượt xem
	function updateView($id=0,$type){		
		$sql_lanxem = "UPDATE #_post SET luotxem=luotxem+1  WHERE id ='".$id."' and type='$type'";
		$this->db->query($sql_lanxem);
	}
	//Lấy bài viết khác
	function getOrtherPost($id=0,$id_cat=0,$number=10,$type){		
		$sql="select p.id,p.gia,pl.ten from #_post_lang as pl,#_post as p where p.id_cat = '$id_cat' and p.id <> $id and p.id  = pl.id_post and  pl.lang = '".$this->lang."' and  p.type='".$type."' limit 0,$number";
		$this->bd->query($sql);
		return $this->db->result_array();
	}
	//Lấy chi tiết danh mục bài viết
	function getDetailPostCat($id='0',$flagurl=false,$type){			
		//Lấy theo tên không dấu hoặc id bài viết
		if($flagurl==true) $sql="select p.*,pl.ten from #_post_cat_lang as pl,#_post_cat as p where pl.tenkhongdau = '$id' and p.id  = pl.id_post_cat and  pl.lang = '".$this->lang."' and  p.type='".$type."' limit 0,1";
		else $sql="select p.*,pl.ten from #_post_cat_lang as pl,#_post_cat as p where p.id = '$id' and p.id  = pl.id_post_cat and  pl.lang = '".$this->lang."' and  p.type='".$type."' limit 0,1";
		$this->db->query($sql);
		return $this->db->fetch_array();		
	}
	//Lấy danh sách bài viết theo danh sách danh mục
	function getListPostByCat($list_arrcat_child='0',$pageNum=1, $pageSize = 10,$type ){								
		$startRow = ($pageNum-1)*$pageSize;
		$sql="select p.*,pl.tenkhongdau,pl.ten from #_post_lang as pl,#_post as p where p.id_cat IN (".$list_arrcat_child.") and p.id  = pl.id_post and  pl.lang = '".$this->lang."' and  p.type='".$type."' limit $startRow , $pageSize";
		$this->db->query($sql);
		return $this->db->result_array();
			
	}

	function getNumberPostByCat($list_arrcat_child='0',$type){		
		$sql="select count(*) as sumnumber from #_post_lang as pl,#_post as p where p.id_cat IN (".$list_arrcat_child.") and p.id  = pl.id_post and  pl.lang = '".$this->lang."' and  p.type='".$type."' ";
		$this->db->query($sql);
		$rows_rs = $this->db->fetch_array();
		return  $rows_rs['sumnumber'];
	}

}