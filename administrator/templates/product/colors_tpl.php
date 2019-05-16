<script type="text/javascript">
	$(document).ready(function(){
		initSwitch();
	})
	function initSwitch(){
		$(".switch-input").bootstrapSwitch({onColor:'info',size:'mini',offColor:'danger',onSwitchChange:function(event, state){
				$id=$(this).data('id');
				$act=$(this).data('com');
				$table=$(this).data('table');
				$.ajax({
					type:"POST",
					url:"ajax/xulysp.php",
					data:{id:$id,act:"capnhat", fiel: $act,table:$table},
					success: function(data){
					}
				})
			}
		});
	}
</script>
<h3><a href="default.php?com=product&act=add_color&idc=<?= $_REQUEST['idc']; ?>">Thêm color</a></h3>

<div class="table-responsive">
<table class="table table-bordered blue_table">
    <tr>
        <th style="width:10%;">Stt</th>
        <th style="width:30%;">Tên</th>
		<th style="width:30%;">Color</th>
        <th style="width:10%;">Hiển thị</th>
        <th style="width:10%;">Sửa</th>
		<th style="width:10%;">Xóa</th>
    </tr>
    <?php for ($i = 0, $count = count($items); $i < $count; $i++) { ?>
        <tr>
            <td style="width:10%;"><?= $items[$i]['stt'] ?></td>
            <td style="width:30%;">      
                <?=$items[$i]['ten'] ?>
            </td>
			<td style="width:20%;">      
                <div style="margin:auto; background:<?=$items[$i]['color'] ?>; width: 15px; height: 15px;"></div>
            </td>
            <td style="width:10%;">
                <input class="switch-input hienthi" data-com="hienthi" data-table="product_color" data-id="<?=$items[$i]['id']?>" type="checkbox" <?php if($items[$i]['hienthi']==1) echo "checked";?> data-off-color="warning" data-size="mini">    
            </td>
            <td style="width:10%;"><a href="default.php?com=product&act=edit_color&idc=<?= $_REQUEST['idc'] ?>&id=<?= $items[$i]['id'] ?>"><i style="font-size:22px;" class="fa fa-edit"></i></a></td>
			<td style="width:10%;"><a href="default.php?com=product&act=delete_color&idc=<?= $_REQUEST['idc'] ?>&id=<?= $items[$i]['id'] ?>" onClick="if (!confirm('Xác nhận xóa'))
                        return false;"><i style="font-size:22px;" class="fa fa-times-circle"></i></a></td>
        </tr>
    <?php } ?>
</table>
</div>
<a href="default.php?com=product&act=add_color&idc=<?= $_REQUEST['idc']; ?>"><i style="font-size:22px" class="fa fa-plus-square"></i></a>
<div class="paging"><?= $paging['paging'] ?></div>