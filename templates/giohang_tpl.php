
<?php
if ($_REQUEST['command'] == 'delete' && $_REQUEST['pid'] > 0) {
    remove_product($_REQUEST['pid'], $_REQUEST['size']);
} else if ($_REQUEST['command'] == 'clear') {
    unset($_SESSION['cart']);
} else if ($_REQUEST['command'] == 'update') {
    $max = count($_SESSION['cart']);
    for ($i = 0; $i < $max; $i++) {
        $pid = $_SESSION['cart'][$i]['productid'];
        $q = intval($_REQUEST['product' . $pid]);
        if ($q > 0 && $q <= 999) {
            $_SESSION['cart'][$i]['qty'] = $q;
        } else {
            $msg = 'Some proudcts not updated!, quantity must be a number between 1 and 999';
        }
    }
}
?>
<script language="javascript">
    function del(pid, $obj) {
		var $x = $obj;
        swal({
            title: "<?=_thongbao?>",
            text: "<?=_bancoxoa?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?=_dongy?>",
            cancelButtonText: "<?=_khongdongy?>",
            closeOnConfirm: false,
            closeOnCancel: false},
			function (isConfirm) {
            if (isConfirm) {
                $.ajax({
					url: "ajax/cart.php?type=remove_order",
					data: { id: pid},
					type: "post",
					success: function (data) {
						$("#"+$obj).remove();
						updatePrice();
						updateCartNum();
					}

				})
                swal("Deleted!", "<?=_daxoathanhcong?>", "success");
            } else {
                swal("Cancelled", "<?=_dahuyxoa?>", "error");
            }
        });
		
    }
    function clear_cart() {
        if (confirm('This will empty your shopping cart, continue?')) {
            document.form1.command.value = 'clear';
            document.form1.submit();
        }
    }
    function update_cart() {
        document.form1.command.value = 'update';
        document.form1.submit();
    }
</script>
<div style="margin-top:50px" class="spct-title"><h2><?=_giohang?></h2></div>
<div class="box_content">
    <div class="content">

        <form name="form1" method="post">
            <input type="hidden" name="pid" />
            <input type="hidden" name="command" /> 
			<?php if(is_array($_SESSION['cart'])){?>
            <div class="table-responsive">
                <table class="table table-bordered service-list" border="0" cellpadding="5px" cellspacing="1px" style="font-size:13px;" width="100%">
                    <?
                    echo '<tr  style="font-weight:bold;color:#111;font-weight:bold">
                    <th align="center" style="border-left: none"></th>
                    <th style="border-left: none; text-align:left; padding-left: 40px; text-transform:uppercase;">'._sanpham.'</th>
                    <th align="center" style="text-transform:uppercase;">'._soluong.'</th>
					<th align="center" style="text-transform:uppercase;">Giá gốc</th>
					<th align="center" style="text-transform:uppercase;">Giá khuyến mãi</th>

                    <th align="center" style="text-transform:uppercase;">'._thanhtien.'</th>

                    </tr>';
                    $max=count($_SESSION['cart']);
                    for($i=0;$i<$max;$i++){
                    $pid=$_SESSION['cart'][$i]['productid'];
                    $size=$_SESSION['cart'][$i]['size'];
					$color=$_SESSION['cart'][$i]['color'];
                    if($size!='') {$psize=get_size_name($size);}
                    else{ $psize=0;}
					if($color!='') {$pcolor=get_color_name($color);}
                    else{ $pcolor=0;}
                    $q=$_SESSION['cart'][$i]['qty'];
                    $pname=get_product_name($pid);
                    if($q==0) continue;
                    ?>
                    <tr id="<?=md5($pid)?>" <?php echo 'style="background:#fff;padding:4px 0"'; ?>>
                        <td width="5%" style="border-left:none;" align="center"><a href="javascript:del(<?= $pid ?>,'<?=md5($pid)?>')"><img src="assets/images/icon_del.png" border="0" /></a></td>
                        <td width="30%" style="border-left:none; text-align:left">
                            <div class="col-xs-3">
								<img src="<?= _upload_product_l . get_product_image($pid) ?>" width="70px" alt="<?= $pname ?>" />
							</div>
							<div class="col-xs-9">
								<?= $pname ?> <br />
								<?php if ($size != '') echo 'Size: ' . $psize  ?><br />
								<?php if ($color != '') echo 'Màu: ' . $pcolor  ?>
							</div>
                        </td>
                        <td width="10%" align="center"><input type="number" data-id="<?= $pid ?>" data-price="<?= (get_price($pid, $size)) ? get_price($pid, $size) : 0 ?>"name="product<?= $pid ?>" value="<?= $q ?>" class="change_qty" maxlength="3" size="2" style="text-align:center; border:1px solid #F0F0F0;width:40px" />&nbsp;</td>
						<td width="10%" align="center"><?= number_format(get_price_goc($pid, $size), 0, ',', '.') ?>&nbsp;VNĐ</td>
						<td width="10%" align="center"><?= number_format(get_price($pid, $size), 0, ',', '.') ?>&nbsp;VNĐ</td>

                        <td width="10%" align="center" class="price_tt"><?= number_format(get_price($pid, $size) * $q, 0, ',', '.') ?>&nbsp;VNĐ</td>

                    </tr>
                    <?php } ?>

                </table>
            </div>
            <div class="total-order">
                <b><?=_tongtien?>: <span class="last_tt"><?= number_format(get_order_total(), 0, ',', '.') ?>&nbsp;VNĐ</span></b>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="themhang"><a href="san-pham.html"><?=_muathem?></a></div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="tienhangdathang"><a href="thanh-toan.html"><?=_thanhtoan?></a></div>
            </div>
            <div class="clear" style="height:30px;"></div>
            <?
            }
            else{
            echo _nocart."!";
            }
            ?>

        </form>
    </div>
	<div class="content">
		<?=$row_setting["luuy1"]?>
	</div>
</div>
<script type="text/javascript">
    
    function updatePrice() {
        $tt = 0;
        $(".price_tt").each(function () {
            $h = $(this).html().replace(/\./g, "");
            $tt += parseInt($h);

        })

        $(".last_tt").html(numberFormat($tt));


    }
    function price($val) {
        return parseInt($val.replace(/\./g, ""));
    }
    $(document).ready(function (e) {
        /* $(".change_qty").change(function () {

            $val = parseInt($(this).val());
            $id = $(this).data("id");
            if (parseInt($val) < 1) {
                $(this).val(1);
                $val = 1;
            }
            $root = $(this).parents("tr");
            $price = parseInt($(this).data("price"));
            if ($price < 1) {
                $price = 0;
            }
            $root.find("td").last().html(numberFormat(parseInt($val * $price)));
            updatePrice();
        }) */

        $(".change_qty").change(function () {
            $val = parseInt($(this).val());
            $id = $(this).data("id");
            if (parseInt($val) < 1) {
                $(this).val(1);
                $val = 1;
            }
            $root = $(this).parents("tr");
            $price = parseInt($(this).data("price"));
            $root.find("td").last().html(numberFormat(parseInt($val * $price)));
            $.ajax({
                url: "ajax/cart.php?type=update_qty",
                data: {"qty": $val, id: $id},
                type: "post",
                success: function (data) {
                    updatePrice();
					updateCartNum();
                }

            })



        })
    });
</script>