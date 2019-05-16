<h3>Thêm Video</h3>
<h3>
    <!--	
          <b>Số thứ tự</b> <input type="text" name="stt" value="<?= isset($item['stt']) ? $item['stt'] : 1 ?>" style="width:30px"><br>
    -->	
    <form name="frm" method="post" action="default.php?com=video&act=save" enctype="multipart/form-data" class="nhaplieu">

        <b>Tên video:</b> 



        <input type="text" name="ten" value="<?= @$item['ten'] ?>" class="input" />
        <br />
        <?php
        if (@$_REQUEST['act'] == 'edit') {
            ?>
            <b>Video hiện tại:</b> 
            <?php if ($item['url'] != NULL) {
                ?>
                <?php echo "Đã tồn tại video"; ?>

                <?php
            } else {
                echo "Chưa có file video";
            }
            ?><br />
        <?php } ?>
        <br />

        <?php if (@$_REQUEST['act'] == 'edit') {
            ?>
            <b>Hình hiện tại:</b><img src="<?= _upload_video . $item['image'] ?>" alt="NO PHOTO"  width="237" height="160"/>



            <br />
        <?php } ?>




        <b>File video:</b> 
        <input type="file" name="file" />
        Dạng .flv&nbsp;Dung lượng:&nbsp;5mb
        <br />
        <br />
        <b>Hình ảnh:</b> 
        <input type="file" name="image" id="image" />	
        Dạng .jpg&nbsp;|&nbsp;.gif&nbsp;|&nbsp;.png &nbsp;Width:500px - Height:350px
        <br />

        <b>Số thứ tự</b> <input type="text" name="stt" value="<?= isset($item['stt']) ? $item['stt'] : 1 ?>" style="width:30px"><br>

        <b>Hiển thị</b> 
        <input type="checkbox" name="hienthi" <?= (!isset($item['hienthi']) || $item['hienthi'] == 1) ? 'checked="checked"' : '' ?>>
        <br />
        <input type="hidden" name="id" id="id" value="<?= @$item['id'] ?>" />
        <input type="submit" value="Lưu" class="btn" />
        <input type="button" value="Thoát" onclick="javascript:window.location = 'default.php?com=video&act=man'" class="btn" />
    </form>
</h3>
