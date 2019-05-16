<h3>Quảng lý banner phải</h3>

<form name="frm" method="post" action="index.php?com=bannerqc&act=save_banner_phai" enctype="multipart/form-data" class="nhaplieu">


    <b>Hình hiện tại:</b> 
    <?php
    if ($item_banner['photo'] != NULL) {
        ?>
        <img src="<?= _upload_hinhanh . $item_banner['photo'] ?>" width="505" height="414"  />
        <?php
    } else {
        echo "Chưa có banner";
    }
    ?><br /><br />
    <b>Banner hiện tại: </b> 
    <input type="file" name="file" /> <strong>Width:505px&nbsp;-&nbsp;Height:414px&nbsp;Type:&nbsp;.jpg|.gif|png</strong><br />
    <b>Hiển thị</b> <input type="checkbox" name="hienthi" checked="checked" /> <br /><br />



    <input type="submit" value="Lưu" class="btn" />
    <input type="button" value="Thoát" onclick="javascript:window.location = 'index.php?com=bannerqc&act=banner_phai'" class="btn" />
</form>