<?php 
	$d->reset();
	$sql="select ten, id from #_place_city order by stt";
	$d->query($sql);
	$rs_province=$d->result_array();
?>
<div style="margin-top:50px" class="spct-title"><h2><?=_thanhtoan?></h2></div>
<div class="box_content">
    <div class=" nds">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box_dh">
                    <div class="title-dh">
                        <?=_thongtindonhang?>
                    </div>
                    <?php if (is_array($_SESSION['cart'])) { ?>
                        <div class="table-responsive">
                            <table class="table table-bordered service-list" border="0" cellpadding="5px" cellspacing="1px" style="font-size:13px;" width="100%">
                                <?php
                                echo '<tr  style="font-weight:bold;font-weight:bold">
							<th style="border-left: none; text-align:left; padding-left: 40px; text-transform:uppercase;">' . _sanpham . '</th>
							<th align="center" style="text-transform:uppercase;">Số lượng</th>
							<th align="center" style="text-transform:uppercase;">Giá gốc</th>
							<th align="center" style="text-transform:uppercase;">Giá Khuyến Mãi</th>
							
							<th align="center" style="text-transform:uppercase;">'._thanhtien.'</th>
							
						</tr>';
                                $max = count($_SESSION['cart']);
                                for ($i = 0; $i < $max; $i++) {
                                    $pid = $_SESSION['cart'][$i]['productid'];
                                    $size = $_SESSION['cart'][$i]['size'];
									$color = $_SESSION['cart'][$i]['color'];
                                    if ($size != '') {
                                        $psize = get_size_name($size);
                                    } else {
                                        $psize = 0;
                                    }
									if ($color != '') {
                                        $pcolor = get_color_name($color);
                                    } else {
                                        $pcolor = 0;
                                    }
                                    $q = $_SESSION['cart'][$i]['qty'];
                                    $pname = get_product_name($pid);
                                    if ($q == 0)
                                        continue;
                                    ?>
                                    <tr <?php echo 'style="background:#fff;padding:4px 0; color: #000"'; ?>>
                                        <td width="30%" style="border-left:none; text-align:left">
                                            <span><img src="<?= _upload_product_l . get_product_image($pid) ?>" width="70px" alt="<?= $pname ?>" />
											<?= $pname ?> <br />
											<?php if ($size != '') echo 'Size: ' . $psize  ?><br />
											<?php if ($color != '') echo 'Màu: ' . $pcolor  ?>
											</span>
                                        </td>
                                        <td width="10%" align="center"><?= $q ?></td>                  
                                        <td width="10%" align="center"><?= number_format(get_price_goc($pid, $size), 0, ',', '.') ?>&nbsp;VNĐ</td>
										<td width="10%" align="center"><?= number_format(get_price($pid, $size), 0, ',', '.') ?>&nbsp;VNĐ</td>

                                        <td width="10%" align="center" class="price_tt"><?= number_format(get_price($pid, $size) * $q, 0, ',', '.') ?>&nbsp;VNĐ</td>

                                    </tr>
                                <?php } ?>
								<tr>
									<td colspan="5">
										<div class="total-order" ><b>Tổng tiền: <span class="last_tt"><?= number_format((get_order_total($_SESSION['cart'])), 0, ',', '.') ?>&nbsp;VNĐ</span></b></div>
									</td>
								</tr>

                            </table>
                        </div>
                        <?
                        }
                        else{
                        echo "Không có sản phẩm nào trong giỏ hàng!";
                        }
                        ?>
                </div>
				<form method="post" action="" name="step1" id="step1">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="box-form">
								<div class="title-form">Thông tin thanh toán và nhận hàng</div>
								
								<div class="pad-contact">
									<div class="col-md-4 col-sm-4 col-xs-12 text-right" ><?= _hovaten ?>:</div>
									<div class="col-md-8 col-sm-8 col-xs-12"><input type="text" class="form-control" name="hoten" id="hoten" placeholder="<?= _hovaten ?>" value="<?= $rs_user['ten_vi'] ?>" required oninvalid="this.setCustomValidity('<?= _hovaten ?>')" oninput="setCustomValidity('')">
									</div>
									<div class="clear"></div>
								</div>
								<div class="pad-contact">
									<div class="col-md-4 col-sm-4 col-xs-12 text-right" ><?= _diachi ?>:</div>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<div class="row">
											<div class="col-xs-6">
												<select name="province_chon" id="province_chon" class="input form-control">
													<option value='0'> Chọn tỉnh/ thành phố </option>
													<?php foreach($rs_province as $v){?>
													<option <?php if($v['id']==$rs_user['province']) echo "selected"; ?> value="<?=$v['id']?>" ><?=$v["ten"]?></option>
													<?php }?>
												</select>
											</div>
											<div class="col-xs-6">
												<?php 
													$d->reset();
													$sql="select * from #_place_dist where id_city='".$rs_user['province']."' order by id";
													$d->query($sql);
													$rs_district=$d->result_array();
												?>
												<select name="district_chon" id="district_chon" class="input form-control">
													<option value='0'> Chọn quận huyện </option>
													<?php foreach($rs_district as $v){?>
													<option value="<?=$v['id']?>" <?php if($v['id']==$rs_user['district']) echo "selected"; ?> ><?=$v["ten"]?></option>
													<?php }?>
												</select>
											</div>
										</div>
										<div class="clear height"></div>
										<input type="text" value="<?= $rs_user['diachi'] ?>" class="form-control" name="diachi" id="diachi" placeholder="<?= _diachi ?>" required oninvalid="this.setCustomValidity('Nhập địa chỉ của bạn')" oninput="setCustomValidity('')">
									</div>
									<div class="clear"></div>
								</div>
								
								<div class="pad-contact">
									<div class="col-md-4 col-sm-4 col-xs-12 text-right" ><?= _sodienthoai ?>:</div>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<div class="row">
											<div class="col-xs-6">
												<input type="tel" pattern="[0][0-9]{9,10}" min="10" max="13" class="form-control" name="dienthoai" id="dienthoai" placeholder="<?=_sodienthoai?>" value="<?= $rs_user['dienthoai'] ?>" required oninvalid="this.setCustomValidity('Nhập số điện thoại của bạn')" oninput="setCustomValidity('')">
											</div>
											<div class="col-xs-6">
												Nhân viên giao nhận NAHEE BEAUTY sẽ liên hệ với SĐT này.
											</div>
										</div>
										
									</div>
									<div class="clear"></div>
								</div>
								<div class="pad-contact">
									<div class="col-md-4 col-sm-4 col-xs-12 text-right" >Email:</div>
									<div class="col-md-8 col-sm-8 col-xs-12"><input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php if($_SESSION["thanhtoan"]["email"]=='') echo $rs_user['email']; else echo $_SESSION["thanhtoan"]["email"]; ?>" required oninvalid="this.setCustomValidity('Nhập email của bạn')" oninput="setCustomValidity('')">
									</div>
									<div class="clear"></div>
								</div>
								<div class="pad-contact">
									<div class="col-md-4 col-sm-4 col-xs-12 text-right" ><?=_ghichudonhang?>:</div>
									<div class="col-md-8 col-sm-8 col-xs-12"><textarea name="noidung" class="form-control" rows="5" id="noidung"></textarea>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="box-form">
								
								<div class="title-form">Hình thức thanh toán</div>
								<div class="pad-contact">
									<div class="col-md-4 col-sm-4 col-xs-12 text-right" ><?=_chonhinhthucthanhtoan?>:</div>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<input id="thanhtoan1" checked class="checkbox_search" type="radio" name="hinhthuc" value="1"><label for="thanhtoan1"> <span></span> Thanh toán tại cửa hàng </label><br />
										<input id="thanhtoan2" value="2" class="checkbox_search" type="radio" name="hinhthuc"><label for="thanhtoan2"> <span></span> Thanh toán khi nhận được hàng. </label><br />
										<input id="thanhtoan3" class="checkbox_search" type="radio" name="hinhthuc" value="3"><label for="thanhtoan3"> <span></span> Thanh toán qua chuyển khoản ngân hàng </label><br />
										
									</div>
									<div class="clear"></div>
								</div>
								<div class="pad-contact">
									<div class="ht-thanhtoan-bao">
										<div class="ht-thanhtoan-box">
											<?php foreach ($pt_thanhtoan as $k => $v) { ?>
												<div class="httt-tab <?php if($k==0) echo 'active'; ?>" rel="#httt-<?=$k+1?>"><img src="<?=thumb($v["photo"],_upload_tintuc_l,$v["tenkhongdau"],119,56,2,80)?>" class="img-responsive"></div>
											<?php } ?>
										</div>
										<?php foreach ($pt_thanhtoan as $k => $v) { ?>
											<div id="httt-<?=$k+1?>" class="ht-thanhtoan-nd">
												<?=$v['noidung']?>
											</div>
										<?php } ?>
										<div class="clear"></div>
									</div>
								</div>

								<div class="pad-contact">
									<div class="col-md-4 col-sm-4 col-xs-12">&nbsp;</div>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<div id="thanhtoan-div" class="continue" ><?= _tieptuc ?> >></div>
										<button id="thanhtoan-btn" style="display: none;" name="continue" class="continue" ><?= _tieptuc ?> >></button>
									</div>
								</div>
							</div>
						</div>
							
							
							<div class="clear"></div>
					</div>
					<!-- Tham biến thanh toán paypal -->
					<input type="hidden" name="PAY[cmd]" value="_cart" />
					<input type="hidden" name="PAY[upload]" value="1" />
					<input type="hidden" name="PAY[business]" value="ashleyshop0919@yahoo.com" />
					<?php 
						$max = count($_SESSION['cart']);
						$stt=1;
							for ($i = 0; $i < $max; $i++) {
								$pid = $_SESSION['cart'][$i]['productid'];
								$q = $_SESSION['cart'][$i]['qty'];
								$pname = get_product_name($pid);
							
							echo '<input name="PAY[item_name_'.$stt.']" type="hidden" value="'.$pname.'" />';
							echo '<input name="PAY[amount_'.$stt.']" type="hidden" value="'.(get_price($pid) * $q).'" />';
							$stt++;
						}
						
						
						
					?>
					<input type="hidden" name="PAY[rm]" value="1" />
					<input type="hidden" name="PAY[return]" value="<?=$config_url?>" />
					<input type="hidden" name="PAY[cancel_return]" value="<?=$config_url?>" />
					<input type="hidden" name="PAY[notify_url]" value="<?=$config_url?>" />
				</form>
			</div>
		</div>
			<div class="clear"></div>    
    </div>  
</div>  
<script type="text/javascript">
	$(document).ready(function(e) {
		$(".used-coupon").click(function(){
			if(confirm("Bạn có muốn hủy mã khuyến mãi này?")){
			$.ajax({
				type:"POST",
				url:"ajax/cart.php",
				data:{type:"clear_coupon",user:"<?=$user?>"},
				success:function(data){
					console.log(data);
					$("#pc_code").val("");
					$(".coupon-wrap").addClass("hide");
					$(".aj-promotion").html(0);
					$("#notice_couple").html("").hide();
					$(".last_tt").html(data);
					updatePriceAfterGiftCode();
				}
			})
			}
			return false;
		})
		
		$('#pc_code').focus(function(e) {
            $('#notice_couple').html('').hide();
			$('#notice_couple').removeClass('error_couple').removeClass('success_couple');
        });
		$(".check_code").click(function(){
			$(".coupon-wrap").addClass("hide");
			pc_code=$('#pc_code').val();
            if(pc_code==''){
				alert("Bạn chưa nhập mã giảm giá",function(){$('#pc_code').focus();},{title:'Message',afterShow: function() { $('#boxy_button_OK').focus();} });
				return false;
			}
			
			tiente='VNĐ';
			giamgia='Giảm giá';
			notice_error='Rất tiếc! Mã giảm giá này không được nhận diện bởi hệ thống.';	
		
			
			$.ajax({
				url:'ajax/cart.php',
				type: "POST",
				async:true,
				dataType: "json",
				data: {cmd:'check_couple',pc_code:pc_code,user: '<?=$user?>'},
				success: function(res){
					
					$(".aj-promotion").html(0);
					if(res[0]==1){
						$(".aj-promotion").html(numberFormat(res['value']));
						
						$('#notice_couple').addClass('success_couple');
						$('#notice_couple').html('Mã giảm giá có giá trị '+res['value']+' '+tiente+'.');
						$('#notice_couple').fadeIn();
						
						
						$.ajax({
							url:'ajax/cart.php',
							type: "POST",
							async:true,
							dataType: "json",
							data: {cmd:'use_couple',id:res['id'],pc_code:pc_code,gia:res['value'],user: '<?=$user?>'},
							success: function(res){
								$('.last_tt').html(res["total"]);
								$(".coupon-wrap").removeClass("hide");
								
							}
						});
						
						//return res['value'];
					}else{
						$('#notice_couple').html(res["result"]);
						$('#notice_couple').fadeIn();
					}
					
					updatePriceAfterGiftCode();
				}
			});
		})
	})
	function updatePrice(){
		$tt = 0;
		$(".price_tt").each(function(){
			$h = $(this).html().replace(/\./g,"");
			$tt+=parseInt($h);
			
		})
		
		$(".last_tt").html(numberFormat($tt));
		updatePriceAfterGiftCode();
		
	}
	function price($val){
		//return parseInt($($val).replace(/\./g,""));
	}
	function updatePriceAfterGiftCode(){
		$fi_gh = price($(".fi_gh").html());
		$km = price($(".aj-promotion").html());
		$total = price($(".last_tt").html());
		
	$("#total_tr").html(numberFormat($total-$km+$fi_gh));

	//alert("Đơn hàng chỉ được thanh toán khi có giá trị > 90.000đ")
	}
	function numberFormat(num,ext) {
	ext = (!ext) ? '  VNĐ' : ext;
   return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")+ext;
}
</script>
<script type="text/javascript">
	$(document).ready(function(e) {
        $('#province_chon').change(function(){
			var pro = $(this).val();
			$('#district_chon').load("ajax/xuly.php?act=load-quan&id="+$(this).val());
		})
		$('#province_nhan').change(function(){
			var pro = $(this).val();
			$('#district_nhan').load("ajax/xuly.php?act=load-quan&id="+$(this).val());
		})
		$('#same').click(function(){
			var frm = $('#step1');
			var name = frm.find('#hoten');
			var address = frm.find('#diachi');
			var city = frm.find('#province_chon');
			var district = frm.find('#district_chon');
			var dienthoai = frm.find('#dienthoai');
			var name2 = frm.find('#hotennhan');
			var city2 = frm.find('#province_nhan');
			var district2 = frm.find('#district_nhan');
			var address2= frm.find("#diachinhan");
			var dienthoai2=frm.find("#dienthoainhan");

			if($(this).is(':checked') == true){
				name2.val(name.val());
				address2.val(address.val());
				city2.val(city.val());
				dienthoai2.val(dienthoai.val());
				$.ajax({
					type: "POST",
					url: "ajax/xuly.php",
					data: {id: city.val(),act:"load-quan",idi: district.val()},
					success: function(result){
						$('#district_nhan').html(result);
						
					}
				});
			}else{
				name2.val('');
				address2.val('');
				city2.val('');
				district2.val('');
				dienthoai2.val('');
			}
		
		})

    });
</script>