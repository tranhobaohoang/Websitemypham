<?php
	$data = '';
	foreach($product as $k=>$v){
		$data.='<div class="result_comment">
				<div class="content_comment">
					<div class="name"><span>'.$v['hoten'].'</span> - '.date("h:i:s d/m/Y",$v["ngaytao"]).'</div>
					<div class="noidung">'.$v['noidung'].'</div>
				</div>
		</div>';
	}
	echo $data;