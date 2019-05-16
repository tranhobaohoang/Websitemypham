<?php
include ("configajax.php");

$noibat=$_POST["noibat"];
$khoanggia=$_POST["khoanggia"];
$option=$_POST["option"];
$id_list=$_POST["id_list"];
$page=$_POST["page"];
$where='';
if($id_list!=0){
	$where.=' and find_in_set("'.$id_list.'",list_id) >0';
}

if(!empty($khoanggia)){
	$where.=' and (';
	foreach($khoanggia as $k=>$v){
		if($k==0){
			$d->reset();
			$sql="select gia,giaden from #_giaden where id='".$v."' ";
			$d->query($sql);
			$rs=$d->fetch_array();
			if($rs["giaden"]==0){
				$where.=' (gia >'.$rs["gia"].')';
			}else{
				$where.=' (gia >'.$rs["gia"].' and gia <'.$rs["giaden"].')';
			}
		}else{
			$d->reset();
			$sql="select gia,giaden from #_giaden where id='".$v."' ";
			$d->query($sql);
			$rs=$d->fetch_array();
			if($rs["giaden"]==0){
				$where.=' or (gia >'.$rs["gia"].')';
			}else{
				$where.=' or (gia >'.$rs["gia"].' and gia <'.$rs["giaden"].')';
			}
		}
	}
	$where.=')';
}
if(!empty($noibat)){
	$where.=' and (';
	foreach($noibat as $k=>$v){
		if($k==0){
			$where.=' ('.$v.' >0)';
		}else{
			$where.=' or ('.$v.'>0)';
		}
	}
	$where.=')';
}
if(!empty($option)){
	$where.=' and (';
	foreach($option as $k=>$v){
		if($k==0){
			$where.="(find_in_set('".$v."',option_search)>0) ";
		}else{
			$where.="or (find_in_set('".$v."',option_search)>0) ";
			
		}
	}
	$where.=')';

}
if($_POST['page']) {
	$curPg = $_POST['page'];
	$current_page = $curPg;
	$curPg -= 1;
	$display = 20;
	$start = ($curPg * $display);
	$_SESSION['page'] =$display;
	$_SESSION['page'] = ($_SESSION['page']*$current_page)-$display;
	if($_SESSION['page']<0){$_SESSION['page']=0;}
	$d->reset();
	$sql = "select * from #_product where hienthi=1 $where order by stt, id desc";
	$d->query($sql);
	$totalRows = $d->num_rows();
	
	$d->reset();
	$sql = "select * from #_product where hienthi=1 $where order by stt, id desc  limit $start,$display";
	$d->query($sql);

	$product = $d->result_array();
	
	$data='';
	if($product){
		foreach ($product as $i => $v) {
			
            $data.='<div class="item_product_content ';
                if (($i + 1) % 4 == 0) {
                    $data.= 'margin-0';
                }
                $data.='" >
				<div class="item">
                    <div class="images">
                        <a href="san-pham/'.$v["tenkhongdau"].'-'.$v["id"].'.html" >
                            <img src="'. _upload_product_l . $v['thumb'] .'" class="img-responsive" alt="'.$v['ten'].'" />
                        </a>
                    </div>
                    <div class="name">
                        <a href="san-pham/'.$v["tenkhongdau"].'-'.$v["id"].'.html" >
                            '.$v['ten'] .'
                        </a>
                    </div>
					<div class="prices">
						<div class="'; if($v["giakm"]>0) $data.= "throught"; else $data.="gia"; $data.='">'; if($v["gia"]>0) $data.= number_format($v["gia"])." VNĐ"; else $data.= "Liên hệ"; $data.='</div>
						'; if($v["giakm"]>0) $data.='<div class="gia">'.number_format($v["giakm"]).'" VNĐ"'; $data.='</div>';
						if($v["giakm"]<$v["gia"] && $v["gia"]>0 && $v["giakm"]>0) $data.='<div class="giamgia">'.count_sale($v["gia"],$v["giakm"]).'%</div>';
					$data.='</div>
					<div class="clear"></div>
				</div>
            </div>';
            }
		
		$totalPages = ceil($totalRows / $display);


		//$data .= "<div class='clear'></div><div class='phantrang'>";
		$paging1 =""; $paging ="";

		if($totalRows>$display){
			$pag = "<div class='clear'></div><div class='phantrang'>";
			$from = $current_page - 2;
			$to = $current_page + 2;
			if($curPg <= $totalPages && $current_page >= $totalPages-1){$from = $totalPages - 4;}
			if ($from <=0) { $from = 1;   $to = 5; }
			if ($to > $totalPages) { $to = $totalPages; } 
			for($j = $from; $j <= $to; $j++) {
			   if ($j == $current_page){
				   $paging1.=" <span>".$j."</span> ";
			   } 
			   else{                            
				$paging1 .= " <a page=".$j." class='paginate_button transitionAll' >".$j."</a> ";	
			   }       
			} 
			$paging .=" <a page='1' style='display: inline-block; font-size: 20px; line-height: 20px;' >&laquo;</a> "; //ve dau
					if(($current_page-1)<=0){$abc=1;}else{$abc=$current_page-1;}
					
					$paging .=" <a page=".$abc." style='display: inline-block; font-size: 20px; line-height: 20px;' >&#8249;</a> "; 
				
				$paging.=$paging1; 
				
					if($current_page == $totalPages){$abc=$totalPages;}else{$abc=$current_page+1;}
					$paging .=" <a page=".$abc." style='display: inline-block; font-size: 20px; line-height: 20px;' >&#8250;</a> "; 
					
					$paging .=" <a page=".($totalPages)." style='display: inline-block; font-size: 20px; line-height: 20px;' >&raquo;</a> ";  
			}

		$kq = $data.'<div class="clear"></div>'.$pag.$paging;	
	}else{ $kq='Không có sản phẩm nào phù hợp với yêu cầu của bạn.';}
}else{
	$curPg = $_POST['page'];
	$current_page = $curPg;
	$curPg -= 1;
	$display = 20;
	$start = ($current_page * $display);
	$_SESSION['page'] =$display;
	$_SESSION['page'] = ($_SESSION['page']*$current_page)-$display;
	if($_SESSION['page']<0){$_SESSION['page']=0;}
	
	$d->reset();
	$sql = "select * from #_product where hienthi=1 $where order by stt, id desc";
	$d->query($sql);
	$totalRows = $d->num_rows();
	
	$d->reset();
	$sql = "select * from #_product where hienthi=1 $where order by stt, id desc limit $start,$display";
	$d->query($sql);

	$product = $d->result_array();
	
	$data='';
	if($product){
		foreach ($product as $i => $v) {
			
            $data.='<div class="item_product_content ';
                if (($i + 1) % 4 == 0) {
                    $data.= 'margin-0';
                }
                $data.='" >
				<div class="item">
                    <div class="images">
                        <a href="san-pham/'.$v["tenkhongdau"].'-'.$v["id"].'.html" >
                            <img src="'. _upload_product_l . $v['thumb'] .'" class="img-responsive" alt="'.$v['ten'].'" />
                        </a>
                    </div>
                    <div class="name">
                        <a href="san-pham/'.$v["tenkhongdau"].'-'.$v["id"].'.html" >
                            '.$v['ten'] .'
                        </a>
                    </div>
					<div class="prices">
						<div class="'; if($v["giakm"]>0) $data.= "throught"; else $data.="gia"; $data.='">'; if($v["gia"]>0) $data.= number_format($v["gia"])." VNĐ"; else $data.= "Liên hệ"; $data.='</div>
						'; if($v["giakm"]>0) $data.='<div class="gia">'.number_format($v["giakm"]).'" VNĐ"'; $data.='</div>';
						if($v["giakm"]<$v["gia"] && $v["gia"]>0 && $v["giakm"]>0) $data.='<div class="giamgia">'.count_sale($v["gia"],$v["giakm"]).'%</div>';
					$data.='</div>
					<div class="clear"></div>
				</div>
            </div>';
        }
		$totalPages = ceil($totalRows / $display);


		
		$paging1 =""; $paging ="";

		if($totalRows>$display){
			$pag = "<div class='clear'></div><div class='phantrang'>";
			$from = $current_page - 2;
			$to = $current_page + 2;
			if($curPg <= $totalPages && $current_page >= $totalPages-1){$from = $totalPages - 4;}
			if ($from <=0) { $from = 1;   $to = 5; }
			if ($to > $totalPages) { $to = $totalPages; } 
			for($j = $from; $j <= $to; $j++) {
			   if ($j == $current_page){
				   $paging1.=" <span>".$j."</span> ";
			   } 
			   else{                            
				$paging1 .= " <a page=".$j." class='paginate_button transitionAll' >".$j."</a> ";	
			   }       
			} 
			$paging .=" <a page='1' style='display: inline-block; font-size: 20px; line-height: 20px;' >&laquo;</a> "; //ve dau
					if(($current_page-1)<=0){$abc=1;}else{$abc=$current_page-1;}
					
					$paging .=" <a page=".$abc." style='display: inline-block; font-size: 20px; line-height: 20px;' >&#8249;</a> "; 
				
				$paging.=$paging1; 
				
					if($current_page == $totalPages){$abc=$totalPages;}else{$abc=$current_page+1;}
					$paging .=" <a page=".$abc." style='display: inline-block; font-size: 20px; line-height: 20px;' >&#8250;</a> "; 
					
					$paging .=" <a page=".($totalPages)." style='display: inline-block; font-size: 20px; line-height: 20px;' >&raquo;</a> ";  
			}

		$kq = $data.'<div class="clear"></div>'.$pag.$paging;		
	}else{ $kq='Không có sản phẩm nào phù hợp với yêu cầu của bạn.';}
	
}
echo $kq;
?>
