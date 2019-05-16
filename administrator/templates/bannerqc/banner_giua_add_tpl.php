<h3>Quảng lý banner</h3>

<form name="frm" method="post" action="index.php?com=bannerqc&act=save_banner_giua" enctype="multipart/form-data" class="nhaplieu">


    <b>Hình hiện tại:</b> 
    <?php
    if ($item_banner['photo'] != NULL) {
        ?>
        <object width="724" height="269"  codebase="http://active.macromedia.com/flash4/cabs/swflash.cab#version=4,0,0,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
            <param NAME="_cx" VALUE="13414">
            <param NAME="_cy" VALUE="6641">
            <param NAME="FlashVars" VALUE>
            <param NAME="Movie" VALUE="<?= _upload_hinhanh . $item_banner['photo'] ?>">
            <param NAME="Src" VALUE="<?= _upload_hinhanh . $item_banner['photo'] ?>">
            <param NAME="Quality" VALUE="High">
            <param NAME="AllowScriptAccess" VALUE>
            <param NAME="DeviceFont" VALUE="0">
            <param NAME="EmbedMovie" VALUE="0">
            <param NAME="SWRemote" VALUE>
            <param NAME="MovieData" VALUE>
            <param NAME="SeamlessTabbing" VALUE="1">
            <param NAME="Profile" VALUE="0">
            <param NAME="ProfileAddress" VALUE>
            <param NAME="ProfilePort" VALUE="0">
            <param NAME="AllowNetworking" VALUE="all">
            <param NAME="AllowFullScreen" VALUE="false">
            <param name="scale" value="ExactFit">
            <embed src="<?= _upload_hinhanh . $item_banner['photo'] ?>" quality="High" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" width="724" height="269" scale="ExactFit"></embed>
        </object>
        <?php
    } else {
        echo "Chưa có banner top";
    }
    ?><br /><br />
    <b>Hình ảnh </b> <input type="file" name="file" /> <strong>Width:724px&nbsp;-&nbsp;Height:269px&nbsp;Type:&nbsp;.swf</strong><br />
    <b>Số thứ tự </b> <input type="text" name="stt" value="1" style="width:30px" />	<br />
    <b>Hiển thị</b> <input type="checkbox" name="hienthi" checked="checked" /> <br /><br />



    <input type="submit" value="Lưu" class="btn" />
    <input type="button" value="Thoát" onclick="javascript:window.location = 'index.php?com=bannerqc&act=add_bnt'" class="btn" />
</form>