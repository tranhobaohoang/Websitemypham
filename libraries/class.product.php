<?php if(!defined('_lib')) die("Error");
class Product extends Base
{

	function __construct($d){
		parent::__construct($d);
	}
	//Hien thi san pham
	function show_product($fetch_array){
		$str='<div class="">';
		$str='<div class="name">'.$fetch_array['ten'].'</div>';
		$str='</div>';
	}
	//Lấy chi tiết sản phẩm
	function getProductById($id='0',$flagurl=false){						
		//Lấy theo tên không dấu hoặc id sản phẩm
		if($flagurl==true) $sql="select p.*,pl.ten from #_product_lang as pl,#_product as p where pl.tenkhongdau = '$id' and p.id  = pl.id_product and  pl.lang = '".$this->lang."' limit 0,1";
		else $sql="select p.*,pl.ten from #_product_lang as pl,#_product as p where p.id = '$id' and p.id  = pl.id_product and  pl.lang = '".$this->lang."' limit 0,1";					
		$this->db->query($sql);
		return $this->db->fetch_array(); 
	}
	//Cập nhật lượt xem
	function updateView($id=0){		
		$sql_lanxem = "UPDATE #_product SET luotxem=luotxem+1  WHERE id ='".$id."'";
		$this->db->query($sql_lanxem);
	}
	//Lấy sản phẩm khác
	function getOrtherProduct($id=0,$id_cat=0,$number=10){		
		$sql="select p.id,p.gia,pl.ten from #_product_lang as pl,#_product as p where p.id_cat = '$id_cat' and p.id <> $id and p.id  = pl.id_product and  pl.lang = '".$this->lang."' limit 0,$number";
		$this->db->query($sql);
		return $this->db->result_array();
	}
	//Lấy chi tiết danh mục sản phẩm
	function getDetailProductCat($id='0',$flagurl=false){			
		//Lấy theo tên không dấu hoặc id sản phẩm
		if($flagurl==true) $sql="select p.*,pl.ten from #_product_cat_lang as pl,#_product_cat as p where pl.tenkhongdau = '$id' and p.id  = pl.id_product_cat and  pl.lang = '".$this->lang."' limit 0,1";
		else $sql="select p.*,pl.ten from #_product_cat_lang as pl,#_product_cat as p where p.id = '$id' and p.id  = pl.id_product_cat and  pl.lang = '".$this->lang."' limit 0,1";
		$this->db->query($sql);
		return $this->db->fetch_array();		
	}
	//Lấy danh sách sản phẩm theo danh sách danh mục
	function getListProductByCat($list_arrcat_child='0',$pageNum=1, $pageSize = 10 ){								
		$startRow = ($pageNum-1)*$pageSize;
		$sql="select p.*,pl.tenkhongdau,pl.ten from #_product_lang as pl,#_product as p where p.id_cat IN (".$list_arrcat_child.") and p.id  = pl.id_product and  pl.lang = '".$this->lang."' limit $startRow , $pageSize";
		$this->db->query($sql);
		return $this->db->result_array();
			
	}

	function getNumberProductByCat($list_arrcat_child='0'){		
		$sql="select count(*) as sumnumber from #_product_lang as pl,#_product as p where p.id_cat IN (".$list_arrcat_child.") and p.id  = pl.id_product and  pl.lang = '".$this->lang."' ";
		$this->db->query($sql);
		$rows_rs = $this->db->fetch_array();
		return  $rows_rs['sumnumber'];
	}

}