
<h3>Hinh ảnh</h3>

<form name="frm" method="post" action="default.php?com=news&act=save_photo&id=<?= $_REQUEST['id']; ?>&idc=<?= $_REQUEST['idc'] ?>" enctype="multipart/form-data" class="nhaplieu">

    <b>&nbsp;</b> <img src="<?= _upload_tintuc . $item['photo'] ?>"  width="100" height="100"/><br />
    <b>Hình ảnh </b> <input type="file" name="file" /> <strong>Width:468px; height: 468px;</strong><?= _hinhanh_type ?><br />

    <b>Số thứ tự </b> <input type="text" name="stt" value="<?= $item['stt'] ?>" style="width:30px" />	<br />
    <b>Hiển thị</b> <input type="checkbox" name="hienthi" <?= $item['hienthi'] ? 'checked="checked"' : "" ?> /> <br /><br />

    <input type="hidden" name="id" value="<?= $item['id'] ?>" />
    <input type="submit" value="Lưu" class="btn" />
    <input type="button" value="Thoát" onclick="javascript:window.location = 'default.php?com=news&act=man_photo'" class="btn" />
</form>
<script type="text/javascript">
    var editor = CKEDITOR.replace('noidung_vi', {
        uiColor: '#EAEAEA',
        language: 'en',
        skin: 'moono',
        width: 1000,
        resize_enabled: false,
        removePlugins: 'resize',
        removePlugins : 'elementspath',
                height: 300,
        filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?Type=Flash',
        filebrowserLinkBrowseUrl: 'ckfinder/ckfinder.html',
        filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        filebrowserLinkUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload',
    });
</script>

<script type="text/javascript">
    var editor = CKEDITOR.replace('noidung_en', {
        uiColor: '#EAEAEA',
        language: 'en',
        skin: 'moono',
        width: 1000,
        resize_enabled: false,
        removePlugins: 'resize',
        removePlugins : 'elementspath',
                height: 300,
        filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?Type=Flash',
        filebrowserLinkBrowseUrl: 'ckfinder/ckfinder.html',
        filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        filebrowserLinkUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload',
    });
</script>
<script type="text/javascript">
    var editor = CKEDITOR.replace('noidung_jp', {
        uiColor: '#EAEAEA',
        language: 'en',
        skin: 'moono',
        width: 1000,
        resize_enabled: false,
        removePlugins: 'resize',
        removePlugins : 'elementspath',
                height: 300,
        filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?Type=Flash',
        filebrowserLinkBrowseUrl: 'ckfinder/ckfinder.html',
        filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        filebrowserLinkUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload',
    });
</script>

<script type="text/javascript">
    var editor = CKEDITOR.replace('chungchi_en', {
        uiColor: '#EAEAEA',
        language: 'en',
        skin: 'moono',
        width: 1000,
        resize_enabled: false,
        removePlugins: 'resize',
        removePlugins : 'elementspath',
                height: 300,
        filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?Type=Flash',
        filebrowserLinkBrowseUrl: 'ckfinder/ckfinder.html',
        filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        filebrowserLinkUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload',
    });
</script>
