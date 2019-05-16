<?php
	$result = mysql_query("SELECT c.id,c.id_parents,l.ten FROM table_post_cat as c,table_post_cat_lang as l where  c.id = l.id_post_cat and type='".@$_REQUEST['type']."' group by l.id_post_cat order by stt,id desc");
	$categoryData = array();
	while ($row = mysql_fetch_array($result)) {
		 $categoryData[$row['id_parents']][$row['id']] = $row['ten'];
	}
	mysql_free_result($result);
?>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="default.php?com=post&act=man_cat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Danh mục bài viết</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script language="javascript">
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xoá mục này?'))
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
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='default.php?com=post&act=add_cat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
        <input type="button" class="blueB" value="Hiện" onclick="ChangeAction('default.php?com=post&act=man_cat&multi=show<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>');return false;" />
        <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('default.php?com=post&act=man_cat&multi=hide<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>');return false;" />
        <input type="button" class="blueB" value="Xoá" onclick="ChangeAction('default.php?com=post&act=man_cat&multi=del<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>');return false;" />
    </div> 
     <div style="float:right;">
        <div class="selector">
		
        </div>  
    </div>
</div>



<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Danh sách các danh mục hiện có</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>
        <td class="sortCol"><div>Tên danh mục<span></span></div></td>
        <td class="tb_data_small">Ẩn/Hiện</td>
        <td width="200">Thao tác</td>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="10">
        <div class="pagination">
            <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?>            
        </div></td>
      </tr>
    </tfoot>
    <tbody>
        <?=getcat_list($categoryData,0)?> 
                </tbody>
  </table>
</div>
</form>               