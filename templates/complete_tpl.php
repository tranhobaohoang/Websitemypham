<?php
$sql = "UPDATE table_donhang SET trangthai='2' WHERE madonhang=$_GET[order_id]";
mysql_query($sql) or die(mysql_error());
?>
<div class="box_content">
    <div class="tcat"><div class="icon"><?= _thanhtoan ?></div></div>
    <div class="content">
        Giao dịch thành công !
        <br/><br/>
        Mã hóa đơn: <?= $_GET['order_id'] ?>
        <br/><br/>
        Mã giao dịch thanh toán trên baokim.vn: <?= $_GET['transaction_id'] ?>
        <br/><br/>
        Thời gian giao dịch: <?= date('d/m/Y H:i:s', $_GET['created_on']); ?>
        <br/><br/>
        Hình thức thanh toán: <?= $_GET['payment_type'] ?>
        <br/><br/>
        Tổng số tiền thanh toán (có thể bao gồm thêm phí khi thanh toán qua internet banking, phí chuyển tiền…): <?= $_GET['total_amount'] ?>
        <br/><br/>
        Phí dịch vụ: <?= $_GET['fee_amount'] ?>
        <br/><br/>
        Tên người thanh toán: <?= $_GET['customer_name'] ?>
        <br/><br/>
        Email người thanh toán: <?= $_GET['customer_email'] ?>
        <br/><br/>
        Số điện thoại người thanh toán: <?= $_GET['customer_phone'] ?>
        <br/><br/>
        Địa chỉ người thanh toán: <?= $_GET['customer_address'] ?>
        <br/><br/>
    </div>
</div>