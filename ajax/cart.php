<?php

include ("configajax.php");

switch ($_REQUEST['type']) {
    case 'update_qty':
        updateQty();
        break;
	case 'remove_order':
        delete_order();
        break;
    case 'clear_coupon':
        Clearcoupon();
        break;
}

function Clearcoupon() {
    unset($_SESSION['couple']);
	$kq=number_format(get_order_total($_POST["user"]),0,",",".")."VNĐ";
	echo $kq;
}

function updateQty() {
    $id = $_POST['id'];
    $qty = $_POST['qty'];

    $tmp = array();
    foreach ($_SESSION['cart'] as $k => $v) {
        if ($v['productid'] == $id) {
            $v['qty'] = $qty;
        }
        $tmp[$k] = $v;
    }
    $_SESSION['cart'] = $tmp;
    echo number_format(get_order_total(), 0, ',', '.');
}
function delete_order(){
	$id=$_POST["id"];
	remove_product($id);
	echo $id;
}
	if($_POST['cmd']=='check_couple' and isset($_POST['pc_code'])){
			if($_POST['cmd']=='loadcart' and isset($_POST['lang'])){
			$lang=$_POST['lang'];
			$res['total']=get_total();
			$res['cart_detail']=get_detail_cart($lang);
			if($lang=='en') $tiente='USD';
			else if($lang=='ge') $tiente='DEM';
			else $tiente='VND';
			$res['order_total']=number_format(get_order_total($_POST["user"]),0,",",".").' '.$tiente;
			
			echo json_encode($res);
		}else{
			if(isset($_SESSION['couple'])) unset($_SESSION['couple']);
			$lang='vi';
			$pc_code=strtoupper(magic_quote($_POST['pc_code']));
			$timetodate=time();
			$d->reset();
			$sql = "select * from #_couple where couple_code='$pc_code' and hienthi=1 and (lansd-dadung)>0 and thoigian>'".time()."'";
			$d->query($sql);
			
			if($d->num_rows() == 1){
				$result=$d->fetch_array();
					$res['0']=1;
					$res['value']=number_format(($result["gia_$lang"]*get_order_total()/100),0,",",".");
					$res['id']=$result['id'];	
				
			}else{
				$d->reset();
				$sql = "select * from #_couple where couple_code='$pc_code' and hienthi=1";
				$d->query($sql);
				if($d->num_rows()==0){
					$res["result"]='Mã giảm giá này không tồn tại trong hệ thống.';
				}else{
					$d->reset();
					$sql = "select * from #_couple where couple_code='$pc_code' and hienthi=1 and (lansd-dadung)>0";
					$d->query($sql);
					if($d->num_rows()==0){
						$res["result"]='Mã giảm giá này đã hết lần sử dụng.';
					}else{
						$d->reset();
						$sql = "select * from #_couple where couple_code='$pc_code' and hienthi=1 and (lansd-dadung)>0 and thoigian>'".time()."'";
						$d->query($sql);
						if($d->num_rows()==0){
							$res["result"]='Mã giảm giá này đã quá hạn sử dụng.';
						}
					}
				}
				$res['0']=0;
			}
		}
			echo json_encode($res);
	}else if($_POST['cmd']=='use_couple' and isset($_POST['id'], $_POST['pc_code'], $_POST['gia'])){
		$id=(int)$_POST['id'];
		$code=$_POST['pc_code'];
		$lang='vi';
		if($lang=='en') $tiente='USD';
		else if($lang=='ge') $tiente='DEM';
		else $tiente='VNĐ';
		$d->reset();
		$sql = "select * from #_couple where id='$id'";
		$d->query($sql);
		$result=$d->fetch_array();
		$_SESSION['couple']['id']=$result['id'];
		$_SESSION['couple']['code']=$result['couple_code'];
		$_SESSION['couple']['gia_vi']=$result["gia_vi"];
		$_SESSION['couple']['gia_en']=$result["gia_en"];
		$_SESSION['couple']['gia_ge']=$result["gia_ge"];
		$_SESSION['couple']['gtri']=$result["gtri"];
		$res['gia']=number_format(($result["gia_vi"]*get_order_total()/100),0,",",".");
		$res['giano']=($result["gia_vi"]*get_order_total()/100);
		$res['total']=number_format((get_order_total()-($_SESSION['couple']["gia_vi"]*get_order_total()/100)),0,",",".").'VNĐ';
		$res['totalno']=((get_order_total()-($_SESSION['couple']["gia_vi"]*get_order_total()/100)));
		$_SESSION['couple']['gia']=$res['gia'];
		$_SESSION['couple']['total']=$res['totalno'];
		$_SESSION['couple']['giano']=$res['giano'];
		echo json_encode($res);
	}
?>