<?php
$d->query("select id, ten_vi as ten, gia from #_giatu where hienthi=1 order by stt, id desc");
$giatu = $d->result_array();

$d->query("select id, ten_vi as ten, gia from #_giaden where hienthi=1 order by stt, id desc");
$giaden = $d->result_array();
?>
<div class="text">
    TÌM KIẾM SẢN PHẨM
</div>
<div class="name">
    <input type="text" name="keyword" id="keyword" value="Tìm kiếm sản phẩm..." onblur="textboxChange(this, false, 'Tìm kiếm sản phẩm...')" onfocus="textboxChange(this, true, 'Tìm kiếm sản phẩm...')" onkeypress="doEnter(event, 'keyword');"/>

    <div id="searchres" class="searchres"></div>
</div>
<div class="giatu">
    <select name="giatu" id="giatu">
        <option value="0">Giá từ</option>
        <?php foreach ($giatu as $v) { ?>
            <option value="<?= $v['gia'] ?>"><?= $v['ten'] ?></option>
        <?php } ?>
    </select>
</div>
<div class="giaden">
    <select name="giaden" id="giaden">
        <option value="0">Giá đến</option>
        <?php foreach ($giaden as $v) { ?>
            <option value="<?= $v['gia'] ?>"><?= $v['ten'] ?></option>
        <?php } ?>
    </select>
</div>
<input type="button" value=" " onclick="onSearch(event, 'keyword')"/>
<div class="clear"></div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#keyword").keyup(function () {
            var search_string = $("#keyword").val();
            if (search_string == '') {
                $("#searchres").html('');
            } else {
                postdata = {'string': search_string}
                $.post("ajax/check.php", postdata, function (data) {
                    $("#searchres").html(data);
                });
            }
        });
    });
    function fillme(name) {
        $("#keyword").val(name);
        $("#searchres").html('');
    }

</script>  