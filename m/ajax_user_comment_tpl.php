<?php
	$data = '';
	foreach($product as $k=>$v){
		$data.='<div class="result_comment">
		<div class="row">
			
			<div class="col-md-12 col-sm-12 col-xs-12 content_comment">';
				
				$data.='<div class="tieude">'.
					echo_comment($v["com"],$v["id_sp"],$v["username"],$v["taikhoan"],$v["ngaytao"]).'
				</div>
				<div class="star_date">'; 
					$star=$v["danhgia"];
					$arr=explode(".",$v["danhgia"]);
					if($star==5){
						for($i=1;$i<=$star; $i++){
								$data.= "<img src='images/star5.png' class='star' alt='star' />";
							}
					}else{
						if($arr[1]>0){
							for($i=1;$i<=$star+0.5; $i++){
								if($i==$star+0.5){
									$data.= "<img src='images/star3.png' class='star' alt='star' />";
								}else 
								$data.= "<img src='images/star4.png' class='star' alt='star' />";
							}
						}else{
							for($i=1;$i<$star+0.5; $i++){
								$data.= "<img src='images/star4.png' class='star' alt='star' />";
							}
						}
					} 
					$data.=date("d/m/Y",$v["ngaytao"]).'
					<div class="delete" onclick="dels('.$v["id"].');">X</div>
				</div>
				<div class="name">'.$v['ten'].'</div>
				<div class="noidung">'.$v['noidung'].'</div>
				<div class="gallery">';
					$d->reset();
					$sql="select * from #_comment_hinhanh where id_photo='".$v['id']."' order by id";
					$d->query($sql);
					$rs_gallery=$d->result_array();
					if(count($rs_gallery)>0){
						foreach($rs_gallery as $k){
					$data.='<div class="item">
						<a class="fancybox" rel="'.$v['id'].'" href="'._upload_comment_l.$k['photo'].'" >
							<img src="'._upload_comment_l.$k['photo'].'" class="img-responsive" alt="'.$v['ten'].'" />
						</a>
					</div>';
					}
					}
					
					$data.='<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>';
	}
	echo $data;
				
				
				
			