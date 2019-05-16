<?php 
include ("configajax.php");
$noibat=$_POST["thuoctinh"];
$page=$_POST["page"];
$where='';

if(!empty($noibat)){
	$where.=' and '.$noibat.'=1';
}
if($_POST['page']) {
	$curPg = $_POST['page'];
	$current_page = $curPg;
	$curPg -= 1;
	$display = 12;
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
			
            $data.='<div class="col-md-3 col-sm-4 col-xs-12 tablet">
				<div class="item_product_content ';
                $data.='" >
				<div class="item">
                    <div class="images">
                        <a href="san-pham/'.$v["tenkhongdau"].'-'.$v["id"].'.html" >
                            <img src="timthumb.php?src='. _upload_product_l . $v['photo'] .'&w=320&h=335&zc=2" class="img-responsive" alt="'.$v['ten'].'" />
                        </a>
                    </div>
                    <div class="name">
                        <a href="san-pham/'.$v["tenkhongdau"].'-'.$v["id"].'.html" >
                            '.$v['ten'] .'
                        </a>
                    </div>
					<div class="col-xs-6">
						<a href="san-pham/'.$v["tenkhongdau"].'-'.$v["id"].'.html">
							<img src="assets/images/btn_chitiet.png" alt="'.$v["ten"].'" />
						</a>
					</div>
					<div class="col-xs-6">
						<img src="assets/images/btn_dathang.png" onclick="addtocart('.$v["id"].',1)" alt="'.$v["ten"].'" class="cursor" />
					</div>
					<div class="clear"></div>
				</div>
            </div></div>';
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
	$display = 12;
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
			
            $data.='<div class="col-md-3 col-sm-4 col-xs-12 tablet">
				<div class="item_product_content ';
                $data.='" >
				<div class="item">
                    <div class="images">
                        <a href="san-pham/'.$v["tenkhongdau"].'-'.$v["id"].'.html" >
                            <img src="timthumb.php?src='. _upload_product_l . $v['photo'] .'&w=320&h=335&zc=2" class="img-responsive" alt="'.$v['ten'].'" />
                        </a>
                    </div>
                    <div class="name">
                        <a href="san-pham/'.$v["tenkhongdau"].'-'.$v["id"].'.html" >
                            '.$v['ten'] .'
                        </a>
                    </div>
					<div class="col-xs-6">
						<a href="san-pham/'.$v["tenkhongdau"].'-'.$v["id"].'.html">
							<img src="assets/images/btn_chitiet.png" alt="'.$v["ten"].'" />
						</a>
					</div>
					<div class="col-xs-6">
						<img src="assets/images/btn_dathang.png" onclick="addtocart('.$v["id"].',1)" alt="'.$v["ten"].'" class="cursor" />
					</div>
					<div class="clear"></div>
				</div>
            </div></div>';
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
