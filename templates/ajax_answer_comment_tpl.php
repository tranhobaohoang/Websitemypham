<?php
	$data = '';
	foreach($product as $k=>$v){
		$data.='<div class="result_comment" id="'.md5($v["id"]).'" >
			<div class="content_comment">
				<div class="name"><span>'.$v['hoten'].'</span> - '.date("h:i:s d/m/Y",$v["ngaytao"]).'</div>';
				
				$data.='<div class="noidung">'.$v['noidung'].'</div>';
				$data.='<div class="clear"></div>
			</div>
		</div>
	</div>';
	}
	
	echo $data;