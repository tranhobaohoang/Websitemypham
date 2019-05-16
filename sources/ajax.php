<?php

if (!defined('_source'))
    die("Error");
if (isAjaxRequest()) {
    switch ($_GET['act']) {

        case 'location':
            getLocationProvince($_POST['type']);
            break;
        case 'cart':
            cartProgress();
            break;
        case 'addcart':
            addCart();
            break;
        case 'addcart1':
            addCart1();
            break;

        default:
            die("ERROR");
            break;
    }
}

function cartProgress() {
    switch ($_GET['object']) {
        case 'update':
            updateCart();
            break;
        case 'delete':
            deleteCart();
            break;
    }
    die;
}

function deleteCart() {
    if ((int) $_POST['id'] > 0) {
        remove_product($_POST['id']);
        echo refreshCart();
    } else {
        eraseCart();
    }
}

function updateCart() {

    foreach ($_POST['product'] as $k => $v) {
        updateProduct($k, $v);
    }
    echo refreshCart();
}

function refreshCart() {
    $content = null;

    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        $pid = $_SESSION['cart'][$i]['productid'];
        $pcolor = $_SESSION['cart'][$i]['color'];
        $psize = $_SESSION['cart'][$i]['size'];
        $q = $_SESSION['cart'][$i]['qty'];
        $pname = get_product_name($pid);
        if ($pcolor != '') {
            $pcolor = get_color($pcolor);
        }
        if ($psize != '') {
            $psize = get_size($psize);
        }
        $product = getProductInfo($pid);
        $content.='<tr bgcolor="#FFFFFF"><td width="5%" align="center">' . ($i + 1);
        $content.='<td width="10%"><img class="img-thumbnail" src="' . _upload_product_l . $product['thumb'] . '" style="width:100px" /></td>';
        $content.='<td width="20%"><a href="san-pham/' . $product['id'] . '/' . $product['tenkhongdau'] . '.html" title="' . $pname . '">' . $pname . '</a></td>';
        $content.='<td width="10%">' . $pcolor . '</td>';
        $content.='<td width="10%">' . $psize . '</td>';
        $content.='<td width="15%" align="center">' . number_format(get_price($pid), 0, ',', '.') . '&nbsp;VNĐ</td>';
        $content.='<td width="10%" align="center"><input type="text" name="product[' . $pid . ']" value="' . $q . '" maxlength="3" size="2" style="text-align:center; border:1px solid #F0F0F0" />&nbsp;<a href="" onclick="updateCart();return false;"><i class="glyphicon glyphicon-refresh"></i></a></td>';
        $content.='<td width="15%" align="center">' . number_format(get_price($pid) * $q, 0, ',', '.') . '&nbsp;VNĐ</td>';
        $content.='<td width="5%" align="center"><a onclick="deleteCart(' . $pid . ');return false;" href="#" data-toggle="tooltip" data-placement="top" title="Xóa	"><i class="glyphicon glyphicon-trash"></i></a></td>';
        $content.='</tr>';
    }
    return $content;
}

function getLocationProvince($type) {
    global $d;
    switch ($type) {
        case 'province';
            getDistrictArray($_POST['id']);
            break;
        case 'district':
            getWardArray($_POST['id']);
            break;
        default:
            die("ERROR");
            break;
    }
}

function addCart() {
    $array = array("name" => $_POST['rq_full_name'],
        "phone" => $_POST['rq_phone'],
        "gender" => $_POST['rq_gender'],
        "birth" => $_POST['rq_year'],
        "address" => $_POST['rq_address'],
        "province" => $_POST['rq_province'],
        "district" => $_POST['rq_district'],
        "ward" => $_POST['rq_ward'],
        "email" => $_POST['rq_email']);
    $_SESSION['user_reg'] = $array;
}

function addCart1() {
    $array = array("name" => $_POST['rq_full_name'],
        "phone" => $_POST['rq_phone'],
        "gender" => $_POST['rq_gender'],
        "birth" => $_POST['rq_year'],
        "address" => $_POST['rq_address'],
        "province" => $_POST['rq_province'],
        "district" => $_POST['rq_district'],
        "ward" => $_POST['rq_ward'],
        "email" => $_POST['rq_email']);
    $_SESSION['user_reg'] = $array;
    $pid = $_POST['productid'];
    $q = $_POST['quantity'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    if (is_array($_SESSION['cart'])) {
        if (product_exists($pid, $q, $color, $size))
            return;
        $max = count($_SESSION['cart']);
        $_SESSION['cart'][$max]['productid'] = $pid;
        $_SESSION['cart'][$max]['color'] = $color;
        $_SESSION['cart'][$max]['size'] = $size;
        $_SESSION['cart'][$max]['qty'] = $q;
    }
    else {
        $_SESSION['cart'] = array();
        $_SESSION['cart'][0]['productid'] = $pid;
        $_SESSION['cart'][0]['color'] = $color;
        $_SESSION['cart'][0]['size'] = $size;
        $_SESSION['cart'][0]['qty'] = $q;
    }
}

function getDistrictArray($id) {
    global $d;
    $d->query("select districtid as id,name,type from #_district where provinceid = " . $id . " order by districtid asc");
    echo json_encode($d->result_array());
    die;
}

function getWardArray($id) {
    global $d;
    $d->query("select  wardid as id,name,type from #_ward where districtid = " . $id . " order by wardid asc");
    echo json_encode($d->result_array());
    die;
}

die;
