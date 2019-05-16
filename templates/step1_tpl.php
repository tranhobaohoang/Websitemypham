<div class="box_content">
    <ul id="breadcrumbs-two">
		<li><a class="active" href="thanh-toan-step1.html">Đăng nhập</a></li>
		<li><a href="">Thông tin giao hàng</a></li>
		<li><a href="">Hình thức thanh toán</a></li>
	</ul>
    <div class=" nds">
        <div class="row">
            <div class="col-xs-4 pull-right">
                <div class="box_dh">
                    <div class="title-dh">
                        <?=_thongtindonhang?>
                    </div>
                    <?php if (is_array($_SESSION['cart'])) { ?>
                        <div class="table-responsive">
                            <table class="table table-bordered service-list" border="0" cellpadding="5px" cellspacing="1px" style="font-size:13px;" width="100%">
                                <?php
                                echo '<tr  style="font-weight:bold;color:#111;font-weight:bold">
							<th style="border-left: none; text-align:left; padding-left: 40px; text-transform:uppercase;">' . _sanpham . '</th>
							<th align="center" style="text-transform:uppercase;">Số lượng</th>
							<th align="center" style="text-transform:uppercase;">'._dongia.'</th>
							
							<th align="center" style="text-transform:uppercase;">'._thanhtien.'</th>
							
						</tr>';
                                $max = count($_SESSION['cart']);
                                for ($i = 0; $i < $max; $i++) {
                                    $pid = $_SESSION['cart'][$i]['productid'];
                                    $size = $_SESSION['cart'][$i]['size'];
                                    if ($size != '') {
                                        $psize = get_product_size($size);
                                    } else {
                                        $size = 0;
                                    }
                                    $q = $_SESSION['cart'][$i]['qty'];
                                    $pname = get_product_name($pid);
                                    if ($q == 0)
                                        continue;
                                    ?>
                                    <tr <?php echo 'style="background:#fff;padding:4px 0"'; ?>>
                                        <td width="30%" style="border-left:none; text-align:left">
                                            <span><img src="<?= _upload_product_l . get_product_image($pid) ?>" width="70px" alt="<?= $pname ?>" /> <?= $pname ?> <?php if ($size != '') echo '(' . $psize . ')' ?></span>
                                        </td>
                                        <td width="10%" align="center"><?= $q ?></td>                  
                                        <td width="10%" align="center"><?= number_format(get_price($pid, $size), 0, ',', '.') ?>&nbsp;VNĐ</td>

                                        <td width="10%" align="center" class="price_tt"><?= number_format(get_price($pid, $size) * $q, 0, ',', '.') ?>&nbsp;VNĐ</td>

                                    </tr>
                                <?php } ?>

                            </table>
                        </div>
                        <div class="total-order">
                            <b><?=_tongtien?>: <span class="last_tt"><?= number_format(get_order_total(), 0, ',', '.') ?>&nbsp;VNĐ</span></b>
                        </div>
                        <div class="clear" style="height:30px;"></div>
                        <?
                        }
                        else{
                        echo "Không có sản phẩm nào trong giỏ hàng!";
                        }
                        ?>
                </div>
            </div>
                <?php
                $d->query("select * from #_user where username='" . $_SESSION['login_web']['username'] . "'");
                $rs_u = $d->fetch_array();
                ?>
                <div class="col-xs-8">
                    <div class="box-form">
                        <div class="title-form"><?=_thongtinthanhtoan?></div>
						
                        <form method="post" action="" class="step1" name="step1">
							<div class="error"></div>
                            <div class="form-group">
								<label for="email">Vui lòng điền Email/Số điện thoại của bạn:</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Ví dụ: email@gmail.com" required oninvalid="this.setCustomValidity('Bạn chưa nhập email của mình')" oninput="setCustomValidity('')" value="<?=$rs_user["email"]?>" >
							</div>
							<div class="form-group">
								<input id="checkbox1" class="checkbox_search noibat" type="radio" name="checkbox" value="1" checked><label for="checkbox1"> <span></span> Tôi đã có tài khoản <?=$row_setting["ten_vi"]?> </label><br />
								<input id="checkbox2" class="checkbox_search noibat" type="radio" name="checkbox" value="2"><label for="checkbox2"> <span></span>Tôi là khách hàng mới của <?=$row_setting["ten_vi"]?> </label><br />
							</div>
							<div class="form-group">
								<input type="password" class="form-control" id="pass" name="password" placeholder="Mật khẩu của tôi" required oninvalid="this.setCustomValidity('Bạn chưa nhập email của mình')" oninput="setCustomValidity('')" value="<?=$rs_user["email"]?>" >
							</div>


                            <div class="pad-contact">
                                <div class="col-md-4 col-sm-4 col-xs-12">&nbsp;</div>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="button" name="continue" class="continue" value="Tiếp tục thanh toán" >
                            </div>
                            <div class="clear"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear"></div>    
    </div>  
</div>  
<script type="text/javascript" src="admin/media/scripts/my_script.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".checkbox_search").click(function(){
			if($(this).val()==1){
				document.getElementById('pass').disabled = true;
				$(".continue").value="Tiếp tục thanh toán";
			}else{
				document.getElementById('pass').disabled = false;
				$(".continue").value="Đăng nhập và đặt hàng";
			}
		});
		$(".continue").click(function(){
			var frm = document.step1;
			if (!validEmail(frm.email.value)) {
				alert('Vui lòng nhập đúng địa chỉ email');
				frm.email.focus();
				$('#RegLoading').hide();
				return false;
			}
			
			if(frm.checkbox.value==2){
				if (frm.password.value == '')
				{
					alert("Bạn chưa nhập mật khẩu");
					frm.password.focus();
					$('#RegLoading').hide();
					return false;
				}
			}
			$("#loading").fadeIn();
			$.ajax({
				url:"ajax/xuly.php",
				type:"post",
				data:{email: frm.email.value, pass: $('#pass').val(), act:"step1", chon:frm.checkbox.value},
				success:function(response){
					$k=$.parseJSON(response);
					if($k.id==1){
						setTimeout(function(){
							location.href=$k.url;
						},1000)
					}else{
						$("#loading").fadeOut(1000);
						$(".error").html($k.thongbao);
						$(".error").fadeIn(500);
					}
				}
			})
			
		})
	})
</script>