<script type="text/javascript">
    // JavaScript Document
    function re_capcha()
    {
        document.getElementById('vimg').src = "./captcha_image.php";
    }
</script>
<div class="breadcrumb-arrow"><?=$breakcrumb?></div>
<div class="spct-title"><h2><?=_lienhe?></h2></div>
<div class="inner trang-lienhe">
    <div class="content">
		<div class="clear" style="height:20px;"></div>
		<div class="post-share" style="margin-top:10px;">
			<div class="addthis_sharing_toolbox"></div>
		</div>
		<div class="clear" style="height:20px;"></div>
		<div class="col-md-6 col-sm-12 col-xs-12">
			<?= $company_contact['noidung']; ?>
			
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12">
        <form method="post" name="frm" class="forms" action="">    
            <div class="tbl-contacts">
                <div class="form-group">
                    <input type="text" class="form-control" name="ten" id="ten" placeholder="<?= _hovaten ?>" required oninvalid="this.setCustomValidity('<?= _hotengui ?>')" oninput="setCustomValidity('')">
                </div>                        
                <div class="form-group">
                    <input type="text" class="form-control" name="diachi" id="diachi" placeholder="<?= _diachi ?>" required oninvalid="this.setCustomValidity('<?= _diachigui ?>')" oninput="setCustomValidity('')">
                </div>
                <div class="form-group">
                    <input class="form-control" name="dienthoai" id="dienthoai" placeholder="<?= _sodienthoai ?>" type="tel" required oninvalid="this.setCustomValidity('<?= _dienthoaigui ?>')" oninput="setCustomValidity('')"></div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required oninvalid="this.setCustomValidity('<?= _emailgui ?>')" oninput="setCustomValidity('')"></div>
                <div class="form-group">
                    <input type="text" class="form-control" name="tieude1" id="tieude1" placeholder="<?= _chude ?>" required oninvalid="this.setCustomValidity('<?= _chudegui ?>')" oninput="setCustomValidity('')">
                </div>                         
                <div class="form-group">
                    <textarea name="noidung" id="noidung" class="form-control" rows="3" required oninvalid="this.setCustomValidity('<?= _noidunggui ?>')" oninput="setCustomValidity('')"></textarea>
                </div>
				<div class="form-group">
						<input type="text" name="capt" id="capt" class="form-control" placeholder="Nhập mã bảo vệ bên dưới">
						<img src="captcha_image.php" id="vimg"><span><img src="assets/images/Refresh-icon.png" alt="" width="35px" onclick="re_capcha()" /></span>
					</div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success" onclick="">
                        <?= _gui ?></button>
                    <input class="btn btn-primary" type="button" value="<?= _nhaplai ?>" onclick="document.frm.reset();" />
                </div>

            </div>
        </form>
		</div>
        
        
        <div class="clear"></div>    
		<div id="map_canvas"></div>
    </div>
</div>