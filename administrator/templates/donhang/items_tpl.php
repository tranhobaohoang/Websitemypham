<?php
function tinhtrang($i=0)
	{
		$sql="select * from table_tinhtrang order by id";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_tinhtrang" name="id_tinhtrang" class="main_font">					
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$i)
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["trangthai"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
?>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="default.php?com=order&act=man"><span>Đơn hàng</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<script src="js/datetimpicker/jquery.datetimepicker.js"></script>
<link href="js/datetimpicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
  $(document).ready(function() {
    $(".datetimepicker").datetimepicker({
      yearOffset:0,
      lang:'vi',
      timepicker:false,
      format:'m/d/Y',
      formatDate:'Y/m/d',
      minDate:'-1970/01/02', // yesterday is minimum date
      maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
  });
</script>
<div class="widget">
  <div class="titlee" style="padding-bottom:5px;">

     <div class="timkiem" >
    <form name="search" action="default.php" method="GET" class="form giohang_ser">
      <input name="com" value="order" type="hidden"  />
      <input name="act" value="man" type="hidden" />
      <input name="p" value="<?=($_GET['p']=='')?'1':$_GET['p']?>" type="hidden" />

      <input class="form_or" name="keyword" placeholder="Nhập từ khóa.." value="<?=$_GET['keyword']?>" type="text" />
      <input class="form_or datetimepicker" name="ngaybd" id="datefm" type="text" value="<?=$_GET['ngaybd']?>" placeholder="Từ ngày.."/>
      <input class="form_or datetimepicker" name="ngaykt" id="dateto" type="text" value="<?=$_GET['ngaykt']?>" placeholder="Đến ngày.." />

      <select name="sotien">
      <option value="0">Chọn giá</option>
        <?php 
          $sql="select id,ten from #_giasearch order by id";
          $d->query($sql);
          $giasearch = $d->result_array();
          for ($i=0,$count=count($giasearch); $i < $count; $i++) { 
        ?>
          <option value="<?=$giasearch[$i]["id"]?>" <?php if($giasearch[$i]["id"]==$_GET['sotien']) echo "selected='selected'";?> >
            <?=$giasearch[$i]["ten"]?>
          </option>
        <?php }?>
      </select>
      <!--<select name="httt">
      <option value="0">Hình thức thanh toán</option>
        <?php 
          $sql="select id,ten from #_httt order by id";
          $d->query($sql);
          $httt_sr = $d->result_array();
          for ($i=0,$count=count($httt_sr); $i < $count; $i++) { 
        ?>
          <option value="<?=$httt_sr[$i]["id"]?>" <?php if($httt_sr[$i]["id"]==$_GET['httt']) echo "selected='selected'";?>>
            <?=$httt_sr[$i]["ten"]?>
          </option>
        <?php }?>
      </select>-->
      <select name="tinhtrang">
      <option value="0">Tình trạng</option>
        <?php 
          $sql="select id,trangthai from #_tinhtrang order by id";
          $d->query($sql);
          $tinhtrang_sr = $d->result_array();
          for ($i=0,$count=count($tinhtrang_sr); $i < $count; $i++) { 
        ?>
          <option value="<?=$tinhtrang_sr[$i]["id"]?>" <?php if($tinhtrang_sr[$i]["id"]==$_GET['tinhtrang']) echo "selected='selected'";?> >
            <?=$tinhtrang_sr[$i]["trangthai"]?>
          </option>
        <?php }?>
      </select>
      <input type="submit" class="blueB" value="Tìm kiếm" style="width:100px; margin:0px 0px 0px 10px;"  />
    </form>
    </div><!--end tim kiem-->
  </div>
</div>
<script language="javascript">
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xoá đơn hàng này?'))
		{
			location.href = l;	
		}
	}	
	function ChangeAction(str){
		if(confirm("Bạn có chắc chắn?"))
		{
			document.f.action = str;
			document.f.submit();
		}
	}		
					
</script>
<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	
        <input type="button" class="blueB" value="Xoá" onclick="ChangeAction('default.php?com=order&act=man&multi=del');return false;" />
    </div>  

</div>

<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Danh sách đơn hàng</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
       <td class="sortCol" width="120"><div>Mã đơn hàng<span></span></div></td>     
        <td class="sortCol"><div>Họ tên<span></span></div></td>
        <td class="sortCol" width="150"><div>Ngày đặt<span></span></div></td>
        <td width="150">Số tiền</td>
        <td width="150">Tình trạng</td>
        <td width="150">Thao tác</td>
      </tr>
    </thead>
    
    <tbody>
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
            <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>
        <td align="center">
            <?=$items[$i]['madonhang']?>
        </td> 
        <td>
               <?=$items[$i]['hoten']?>
                </td>
                <td align="center">
               <?=date('d/m/Y',$items[$i]['ngaytao'])?>
                </td>
      
        <td align="center">
           <?= number_format($items[$i]['tonggia'], 0, ',', '.') ?>&nbsp;VNĐ
        </td>
       
        <td align="center">
           <?php 
		   		$sql="select trangthai from #_tinhtrang where id= '".$items[$i]['trangthai']."' ";
				$d->query($sql);
				$result=$d->fetch_array();
				echo $result['trangthai'];
		   ?>
        </td>
       
        <td class="actBtns">
            <a href="export.php?id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Xuất đơn hàng"><img src="./images/icons/dark/excel.png" alt=""></a>
            
            <a href="default.php?com=order&act=edit&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Xem đơn hàng"><img src="./images/icons/dark/preview.png" alt=""></a>
            <a href="" onclick="CheckDelete('default.php?com=order&act=delete&id=<?=$items[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa đơn hàng"><img src="./images/icons/dark/close.png" alt=""></a>        </td>
      </tr>
         <?php } ?>
    </tbody>
	<tfoot>
      <tr>
        <td colspan="10"><div class="pagination"><?= $paging['paging'] ?></div></td>
      </tr>
    </tfoot>
  </table>
</div>
</form>               
