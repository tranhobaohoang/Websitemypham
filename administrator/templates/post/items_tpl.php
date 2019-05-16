<?php
	$result = mysql_query("SELECT c.id,c.id_parents,l.ten FROM table_post_cat as c,table_post_cat_lang as l where  c.id = l.id_post_cat group by l.id_post_cat order by stt,id desc");
	$categoryData = array();
	while ($row = mysql_fetch_array($result)) {
		 $categoryData[$row['id_parents']][$row['id']] = $row['ten'];
	}
	mysql_free_result($result);
?>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="default.php?com=post&act=man"><span>Bài viết</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script language="javascript">
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xoá bài viết này?'))
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
function select_onchange()
	{
		var a=document.getElementById("id_cat");
		window.location ="default.php?com=post&act=man&id_cat="+a.value;	
		return true;
	}					
</script>
<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='default.php?com=post&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
        <input type="button" class="blueB" value="Hiện" onclick="ChangeAction('default.php?com=post&act=man&multi=show<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>');return false;" />
        <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('default.php?com=post&act=man&multi=hide<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>');return false;" />
        <input type="button" class="blueB" value="Xoá" onclick="ChangeAction('default.php?com=post&act=man&multi=del<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>');return false;" />
    </div>  
    <div style="float:right;">
        <div class="selector">
				<select name="id_cat" id="id_cat" onchange="select_onchange()">
                        <option value="0">Danh mục chính</option>
                        <?=getcat_view_all($_REQUEST['id_cat'],0,$categoryData,'0');?>
                    </select>
        </div>  
    </div>  
    	<img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" style="float:right; margin:5px 5px 0 0;" original-title="Dùng cây thư mục để di chuyển nhanh đến bài viết">   
</div>



<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Danh sách các bài viết hiện có</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>       
        <td width="150">Hình ảnh</td>
        <td class="sortCol"><div>Tên bài viết<span></span></div></td>
        <td class="tb_data_small">Ẩn/Hiện</td>
        <td width="100">Nổi bật</td>
        <td width="200">Thao tác</td>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="10"><div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?>     </div></td>
      </tr>
    </tfoot>
    <tbody>
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
            <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>
        <td align="center">
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự bài viết" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('post', '<?=$items[$i]['id']?>')" />
            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td> 
        <td align="center">
                <?php if($items[$i]['thumb']!=''){ ?>
                <img src="<?=_upload_post.$items[$i]['thumb']?>" width="100" border="0" />
                <?php } else { ?>
                <img src="images/no_image.jpg"  />
                <?php } ?>
                </td>
      
        <td class="title_name_data">
            <a href="default.php?com=post&act=edit&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold">
                  <?php
                    $d->reset();
                    $sql="select ten from #_post_lang where id_post = '".$items[$i]['id']."' order by id asc";
                    $d->query($sql);
                    $result = $d->fetch_array();
                    echo $result['ten']
                  ?>
            </a>
        </td>
       
        <td align="center">
           <?php 
			if(@$items[$i]['hienthi']==1)
				{
		?>
            <a href="default.php?com=post&act=man&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Click để ẩn"><img src="./images/icons/color/tick.png" alt=""></a>
            <?php } else { ?>
         <a href="default.php?com=post&act=man&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Click để hiện"><img src="./images/icons/color/hide.png" alt=""></a>
         <?php } ?>
        </td>
        <td align="center">
             <?php 
			if(@$items[$i]['noibat']>1)
				{
		?>
            <a href="default.php?com=post&act=man&noibat=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Click để tắt nổi bật"><img src="./images/icons/color/tick.png" alt=""></a>
            <?php } else { ?>
         <a href="default.php?com=post&act=man&noibat=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Click để sét nổi bật"><img src="./images/icons/color/hide.png" alt=""></a>
         <?php } ?>
        </td>
        <td class="actBtns">
            <a href="default.php?com=post&act=edit&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Sửa bài viết"><img src="./images/icons/dark/pencil.png" alt=""></a>
            <a href="" onclick="CheckDelete('default.php?com=post&act=delete&id=<?=$items[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa bài viết"><img src="./images/icons/dark/close.png" alt=""></a>        </td>
      </tr>
         <?php } ?>
                </tbody>
  </table>
</div>
</form>               