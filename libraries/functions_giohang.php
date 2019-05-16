<?php



function get_product_name($pid) {
    global $d, $row, $lang;
	
    $sql = "select ten_$lang as ten from #_product where id=$pid";

    $d->query($sql);
    $row = $d->fetch_array();
    return $row['ten'];
}

function get_product_image($pid) {
    global $d, $row;
    $sql = "select photo from #_product where id=$pid";
    $d->query($sql);
    $row = $d->fetch_array();
    return $row['photo'];
}

function get_price($pid) {
    global $d, $row;
    $sql = "select gia,giakm from table_product where id=$pid";
    $d->query($sql);
    $row = $d->fetch_array();
	if($row["giakm"]>0){
		return $row["giakm"];
	}else{
		return $row["gia"];
	}
}
function get_price_goc($pid) {
    global $d, $row;
    $sql = "select gia from table_product where id=$pid";
    $d->query($sql);
    $row = $d->fetch_array();
    return $row['gia'];
}

function remove_product($pid) {
    $pid = intval($pid);
    $max = count($_SESSION['cart']);
    for ($i = 0; $i < $max; $i++) {
        if ($pid == $_SESSION['cart'][$i]['productid']) {
            unset($_SESSION['cart'][$i]);
            break;
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

function get_order_total() {
    $max = count($_SESSION['cart']);
    $sum = 0;
    for ($i = 0; $i < $max; $i++) {
        $pid = $_SESSION['cart'][$i]['productid'];
        $q = $_SESSION['cart'][$i]['qty'];
        $price = get_price($pid);
        $sum+=$price * $q;
    }
    return $sum;
}

function get_total() {
    $max = count($_SESSION['cart']);
    $sum = 0;
    for ($i = 0; $i < $max; $i++) {
        $pid = $_SESSION['cart'][$i]['productid'];
        $q = $_SESSION['cart'][$i]['qty'];
        $sum+=$q;
    }
    return $sum;
}

function addtocart($pid, $q,$size,$color) {
    if ($pid < 1 or $q < 1)
        return;

    if (is_array($_SESSION['cart'])) {
        if (product_exists($pid,$q))
            return;
        $max = count($_SESSION['cart']);
        $_SESSION['cart'][$max]['productid'] = $pid;
        $_SESSION['cart'][$max]['qty'] = $q;
		$_SESSION['cart'][$max]['size'] = $size;
		$_SESSION['cart'][$max]['color'] = $color;
    }
    else {
        $_SESSION['cart'] = array();
        $_SESSION['cart'][0]['productid'] = $pid;
        $_SESSION['cart'][0]['qty'] = $q;
		$_SESSION['cart'][0]['size'] = $size;
		$_SESSION['cart'][0]['color'] = $color;
    }
}

function product_exists($pid,$q) {
    $pid = intval($pid);
    $max = count($_SESSION['cart']);
    $flag = 0;
    for ($i = 0; $i < $max; $i++) {
        if ($pid == $_SESSION['cart'][$i]['productid']) {
            $_SESSION['cart'][$i]['qty'] = $_SESSION['cart'][$i]['qty'] + $q;
            $flag = 1;
            break;
        }
    }
    return $flag;
}
function get_tong_tien($id_order){
	global $d;
	
	$d->reset();
	$sql="select * from #_dhct where id_dh='".$id_order."'";
	$d->query($sql);
	$rs=$d->result_array();
	$sum=0;
	foreach($rs as $v){
		$sum=$sum+get_price($v["id_sp"])*$v["soluong"];
	}
	return $sum;
}
?>