<?php 
	$d->query("select id,ten_vi,id_parent,com from #_product_list order by stt asc");
	$list = $d->result_array();
?>
<?php 
	
	
	function generateRandomString($length = 10) {
		$length = $length*2;
		$characters = '-';
		$charactersLength = strlen($characters);
		//return $length;
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function getMenulist($list,$parent_id = 0,$sprate=0,$item,$subcat){
		global $d;
		if(count($list)){
			foreach($list as $k=>$v){
				if($v['id_parent']==$parent_id){
					if($v["com"]<=$subcat-1){
						echo '<option value="'.$v['id'].'" '.((@$item['id']==$v['id']) ? 'disabled' : '').'>'.generateRandomString($sprate).$v['ten_vi'].'</option>';
						getMenulist($list,$v['id'],($sprate+1),$item,$subcat);
					}
				}
				
			}
		}
		
	}
	
?>
<script language="javascript">
    function select_onchange()
	{
		var a=document.getElementById("id_cat");
		window.location ="default.php?com=product&act=man_list&subcat=<?=$_REQUEST["subcat"]?>&type=<?=$_REQUEST["type"]?>&id_parents="+a.value;	
		return true;
	}
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xoá sản phẩm này?'))
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
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="default.php?com=product&act=man_list&type=<?=$_REQUEST["type"]?>&subcat=<?=$_REQUEST["subcat"]?>"><span>Danh mục</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='default.php?com=product&act=add_list&type=<?=$_REQUEST["type"]?>&subcat=<?=$_REQUEST["subcat"]?>'" />
        <input type="button" class="blueB" value="Hiện" onclick="ChangeAction('default.php?com=product&act=man_list&type=<?=$_REQUEST["type"]?>&subcat=<?=$_REQUEST["subcat"]?>&multi=show');return false;" />
        <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('default.php?com=product&act=man_list&type=<?=$_REQUEST["type"]?>&subcat=<?=$_REQUEST["subcat"]?>&multi=hide');return false;" />
        <input type="button" class="blueB" value="Xoá" onclick="ChangeAction('default.php?com=product&act=man_list&type=<?=$_REQUEST["type"]?>&subcat=<?=$_REQUEST["subcat"]?>&multi=del');return false;" />
    </div>
	<?php if($_REQUEST["subcat"]!=1){?>
    <div style="float:right;">
        <div class="selector">
			<select name="id_cat" id="id_cat" onchange="select_onchange()">
                <option value="0">Danh mục chính</option>
                <?=getMenulist($list,$parent_id = 0,$sprate=0,$item, $_REQUEST["subcat"])?>
            </select>
        </div>  
    </div>  
	<?php }?>
    	<img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" style="float:right; margin:5px 5px 0 0;" original-title="Dùng cây thư mục để di chuyển nhanh đến sản phẩm">   
</div>



<div class="widget">
	<div class="title">
		<span class="titleIcon">
			<input type="checkbox" id="titleCheck" name="titleCheck" />
		</span>
		<h6>Danh sách các danh mục cấp <?=$_REQUEST["subcat"]?> hiện có</h6>
	</div>
	<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
		<thead>
			<tr>
				<td></td>
				<td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>
				<td width="150">Hình ảnh</td>
				<td class="sortCol"><div>Tên sản phẩm<span></span></div></td>
				<td class="tb_data_small">Ẩn/Hiện</td>
				<td width="100">Nổi bật</td>
				<td width="200">Thao tác</td>
			</tr>
		</thead>
		<tbody>
			<?php for($i=0, $count=count($items); $i<$count; $i++){?>
			<tr>
				<td>
					<input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
				</td>
				<td align="center">
					<input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự sản phẩm" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('product_list', '<?=$items[$i]['id']?>')" />
					<div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
				</td> 
				<td align="center">
					<?php if($items[$i]['photo']!=''){ ?>
					<img src="<?=_upload_product.$items[$i]['photo']?>" width="100" border="0" />
					<?php } else { ?>
					<img src="images/no_image.jpg"  />
					<?php } ?>
				</td>
				<td class="title_name_data">
					<a href="default.php?com=product&act=edit_list&id=<?=$items[$i]['id']?>&type=<?=$_REQUEST["type"]?>&subcat=<?=$_REQUEST["subcat"]?>&id_list=<?= $items[$i]['id_parent'] ?>&id_parent=<?=$items[$i]["set_level"]?>" class="tipS SC_bold">
						<?=$items[$i]["ten_vi"]?>
					</a>
				</td>
		   
				<td align="center">
					<input type="checkbox" data-com="hienthi" data-table="product_list" data-id="<?=$items[$i]['id']?>" <?php if($items[$i]['hienthi']==1) echo "checked";?> name="hienthi" value="<?=$items[$i]['id']?>" class="check_box" />
				</td>
				<td align="center">
					<input type="checkbox" data-com="noibat" data-table="product_list" data-id="<?=$items[$i]['id']?>" <?php if($items[$i]['noibat']==1) echo "checked";?> name="noibat" value="<?=$items[$i]['id']?>" class="check_box" />
				</td>
				<td class="actBtns">
					<a href="default.php?com=product&act=edit_list&id=<?=$items[$i]['id']?>&type=<?=$_REQUEST["type"]?>&subcat=<?=$_REQUEST["subcat"]?>&id_list=<?= $items[$i]['id_parent'] ?>&id_parent=<?=$items[$i]["set_level"]?>" title="" class="smallButton tipS" original-title="Sửa sản phẩm"><img src="./images/icons/dark/pencil.png" alt=""></a>
					<a href="" onclick="CheckDelete('default.php?com=product&act=delete_list&id=<?=$items[$i]['id']?>&type=<?=$_REQUEST["type"]?>'); return false;" title="" class="smallButton tipS" original-title="Xóa sản phẩm"><img src="./images/icons/dark/close.png" alt=""></a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="10"><div class="pagination paging"><?= $paging['paging'] ?></div></td>
			</tr>
		</tfoot>
	</table>
</div>
</form>