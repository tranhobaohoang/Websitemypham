<h3>Hinh ảnh</h3>

<form name="frm" method="post" action="default.php?com=news&act=save_photo&idc=<?= $_REQUEST['idc'] ?>" enctype="multipart/form-data" class="nhaplieu">


    <?php for ($i = 0; $i < 5; $i++) { ?>

        <b>Hình ảnh <?= $i + 1 ?></b> <input type="file" name="file<?= $i ?>" /> <?= _hinhanh_type ?><br />	       
        <b>Số thứ tự </b> <input type="text" name="stt<?= $i ?>" value="1" style="width:30px" />	<br />
        <b>Hiển thị</b> <input type="checkbox" name="hienthi<?= $i ?>" checked="checked" /> <br /><br />

    <? }?>


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
