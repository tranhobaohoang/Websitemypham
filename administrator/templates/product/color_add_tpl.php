<h3>Color</h3>

<form name="frm" method="post" action="default.php?com=product&act=save_color&idc=<?= $_REQUEST['idc'] ?>" enctype="multipart/form-data" class="nhaplieu">

    <b>Tên màu </b> <input type="text" name="ten" value="<?= $item['ten'] ?>" class="form-control input" /><br /> 
	<b>Mã màu </b><input type="text" id="color" name="color" class="form-control input" value="<?= $item['color'] ?>" /> <br />
	
	<b>Số thứ tự</b> <input type="text" name="stt" value="<?= isset($item['stt']) ? $item['stt'] : 1 ?>" style="width:30px"><br />

    <b>Hiển thị</b> <input type="checkbox" name="hienthi" <?= (!isset($item['hienthi']) || $item['hienthi'] == 1) ? 'checked="checked"' : '' ?>><br />
	<input type="hidden" name="id" id="id" value="<?= @$item['id'] ?>" />
    <input type="submit" value="Lưu" class="btn btn-succes" />
    <input type="button" value="Thoát" onclick="javascript:window.location = 'default.php?com=product&act=man_color'" class="btn btn-danger" />
</form>
<script type="text/javascript">
   
	
	$(document).ready(function(){
		$('#color').colorpicker({
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        });
	})
</script>
<link href="../assets/css/bootstrap-colorpicker.css" rel="stylesheet">
<script src="../assets/js/bootstrap-colorpicker.js"></script>
<style>
    .colorpicker-2x .colorpicker-saturation {
        width: 200px;
        height: 200px;
    }
    .colorpicker-2x .colorpicker-hue,
    .colorpicker-2x .colorpicker-alpha {
        width: 30px;
        height: 200px;
    }
    .colorpicker-2x .colorpicker-color,
    .colorpicker-2x .colorpicker-color div{
        height: 30px;
    }
</style>