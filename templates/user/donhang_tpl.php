<link href="assets/css/login_register.css" media="all" rel="stylesheet" type="text/css" />
<div class="box_content">
	<div class="container_right">
	<div class="content">
		<div class="title" >THỐNG KÊ ĐƠN HÀNG</div>
		<div class="table-responsive">
			<table class="table table-bordered service-list" border="0" cellpadding="5px" cellspacing="1px" style="font-size:13px;" width="100%">

				<tr>
					<th style="width:5%" align="center">STT</th>
					<th style="width:20%;">Mã đơn hàng</th>	
					<th style="width:20%;">Ngày đặt</th>
					<th style="width:20%;">Tổng tiền</th>	
					<th style="width:20%;">Trạng thái đơn hàng</th>
					  
				</tr>

				<?php
				for ($i = 0, $count = count($items_dh); $i < $count; $i++) {
					$tongthu = $tongthu + $items_dh[$i]['tonggia'];
					?>
					<tr>
						<td style="width:5%;" align="center"><?=$i+1?></td>
						<td style="width:20%;" align="center"><?= $items_dh[$i]['madonhang'] ?></td>  
						<td style="width:20%;" align="center"><?= date('d/m/Y', $items_dh[$i]['ngaytao']) ?></td>
						<td style="width:20%;" align="center"><?=number_format($items_dh[$i]['tonggia'],"0",",","." ) ?> VNĐ</td>
						<td style="width:20%;" align="center">
							<?php 
								$sql="select trangthai from #_tinhtrang where id= '".$items_dh[$i]['trangthai']."' ";
								$d->query($sql);
								$result=$d->fetch_array();
								echo $result['trangthai'];
						   ?>
						</td>
						

					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
	</div>
	<div class="container_left">
		<?php include_once _template . "user/left.php"; ?> 
	</div>
	
	<div class="clear"></div>
</div>
<script>
$(window).on('load', function(){
	function qertyui($id){
		if(confirm("Bạn có muốn xóa tin đăng này!")==true){
			$.ajax({
				url:"ajax/xuly.php",
				type:"POST",
				data:{id:$id, act: "delete_tin"},
				success: function(data){
					alert(data);
					location.reload();
				}
			})
		}else{
			return false;
		}
	}
	function update($id){
		$.ajax({
			url:"ajax/xuly.php",
			type:"POST",
			data:{id:$id, act: "update_time"},
			success: function(data){
				alert(data);
				location.reload();
			}
		})
	}
});
</script>
<script type="text/javascript">
	$(document).ready(function(e) {
        $('#province1').change(function(){
			var pro = $(this).val();
			$('#district1').load("ajax/xuly.php?act=load-quan&id="+$(this).val());
		})
    });
</script>