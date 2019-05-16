<h3>Thêm danh mục</h3>

<form name="frm" method="post" action="default.php?com=dknhantin&act=save_cat" enctype="multipart/form-data" class="nhaplieu">
    <b>Tên </b> <input type="text" name="ten" value="<?= $item['ten'] ?>" class="input" /><br />
    <b>Điện thoại </b> <input type="text" name="dienthoai" value="<?= $item['dienthoai'] ?>" class="input" /><br />
    <b>Email </b> <input type="text" name="ten_vi" value="<?= $item['email'] ?>" class="input" /><br />

    <b>Số thứ tự</b> <input type="text" name="stt" value="<?= isset($item['stt']) ? $item['stt'] : 1 ?>" style="width:30px"><br>
    <input type="hidden" name="id" id="id" value="<?= @$item['id'] ?>" />
    <input type="submit" value="Lưu" class="btn" />
    <input type="button" value="Thoát" onclick="javascript:window.location = 'default.php?com=dknhantin&act=man_cat'" class="btn" />
</form>