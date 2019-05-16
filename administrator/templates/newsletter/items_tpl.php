<script type="text/javascript">
	$(document).ready(function() {
							   
	$("#chonhet").click(function(){
		var status=this.checked;
		$("input[name='chon']").each(function(){this.checked=status;})
	});
	
	$("#send").click(function(){
		var listid="";
		$("input[name='chon']").each(function(){
			if (this.checked) listid = listid+","+this.value;
			})
		listid=listid.substr(1);	 //alert(listid);
		if (listid=="") { alert("Bạn chưa chọn email nào"); return false;}
		hoi= confirm("Xác nhận muốn gửi thư đi?");
		if (hoi==true){ document.frm.listid.value=listid; document.frm.submit();}
	});
	});
	
	
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xoá mục này?'))
		{
			location.href = l;	
		}
	}	
	
	function ChangeAction(str){
		if(confirm("Bạn có chắc chắn?"))
		{
			document.frm.action = str;
			document.frm.submit();
		}
	}	
	
</script>


<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=newsletter&act=man"><span>Email đăng ký nhận tin</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>


<form  id="f" class="form" name="frm" method="post" action="index.php?com=newsletter&act=send" enctype="multipart/form-data">
<?php /*?><input type="hidden" name="listid"><?php */?>
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=newsletter&act=add'" />
        <input type="button" class="blueB" value="Hiện" onclick="ChangeAction('index.php?com=newsletter&act=man&multi=show');return false;" />
        <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('index.php?com=newsletter&act=man&multi=hide');return false;" />
        <input type="button" class="blueB" value="Xoá" id="xoahet" onclick="ChangeAction('index.php?com=newsletter&act=man&multi=del');return false;"  />
        
        
         <input type="button" class="blueB" value="Gửi Mail Phản Hồi"  onclick="ChangeAction('index.php?com=newsletter&act=man&multi=send_newsletter');return false;"  />
        
        

        
    </div> 
     <div style="float:right;">
        <div class="selector">
			
        </div>  
    </div>
  	
</div>



<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox"  name="chonhet" id="chonhet"  />
    </span>
    <h6>Danh sách  hiện có</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>
        <td class="sortCol"><div>Họ Tên<span></span></div></td>
         <td style="width:15%;">Email</td>
                 <td style="width:35%;">Nội Dung</td>

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
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
            <input type="checkbox" name="chon[]" onclick="chon" id="chon" value="<?=$items[$i]['id']?>" class="chonxoa" />
        </td>
        <td align="center">
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự sản phẩm" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('newsletter', '<?=$items[$i]['id']?>')" />
            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td> 
        
      
        <td class="title_name_data">
         <a href="index.php?com=newsletter&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['hoten']?></a>
        </td>
        
        
        
      
        
        
          <td>
         <a href="index.php?com=newsletter&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['email']?></a>
        </td>
        
        
          <td>
         <a href="index.php?com=newsletter&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['noidung']?></a>
        </td>
       
        <td align="center">
           <?php 
			if(@$items[$i]['hienthi']==1)
				{
		?>
            <a href="index.php?com=newsletter&act=man&hienthi=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Click để ẩn"><img src="./images/icons/color/tick.png" alt=""></a>
            <?php } else { ?>
         <a href="index.php?com=newsletter&act=man&hienthi=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Click để hiện"><img src="./images/icons/color/hide.png" alt=""></a>
         <?php } ?>
        </td>
        
        <td class="actBtns">
      <a href="index.php?com=newsletter&act=edit&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Sửa"><img src="./images/icons/dark/pencil.png" alt=""></a>
            <a href="index.php?com=newsletter&act=delete&id=<?=$items[$i]['id']?>" onclick="CheckDelete('index.php?com=newsletter&act=delete&id=<?=$items[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa"><img src="./images/icons/dark/close.png" alt=""></a>        </td>
      </tr>
         <?php } ?>
                </tbody>
    
    
    
  </table>
</div>

<br />


<div class="widget">

 <div class="formRow">
			<label>Tiêu đề:</label>
              
           <div class="formRight">
 <input type="text" name="FullName" title="Nhập tên" id="FullName" class="tipS validate[required]"  />
			</div>   
              
			<div class="clear"></div>
		</div><!--end formRow-->
        
        
        <div class="formRow">
			<label>Đính kèm file: </label>
			<div class="formRight">

		
                    
             <input type="file"  name="file" /><img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải File (ảnh JPEG, GIF , JPG , PNG or doc, docx, pdf, rar, zip, ppt, pptx, DOC, DOCX, PDF, RAR, ZIP, PPT, PPTX, xls)">  <?=$kichthuoc?>
                               
			</div>
			<div class="clear"></div>
		</div>
        
        
       <div class="formRow">
			<label>Nội dung chính: <img src="./images/question-button.png" alt="Chọn loại"  class="icon_que tipS" original-title="Viết nội dung chính"> </label>
            
            <div class="clear"></div>
			<div class="formRight-full"><textarea name="Content" rows="8" cols="60"><?=@$item['Content']?></textarea>
<script type="text/javascript">//<![CDATA[
window.CKEDITOR_BASEPATH='ckeditor/';
//]]></script>
<script type="text/javascript" src="ckeditor/ckeditor.js?t=B5GJ5GG"></script>
<script type="text/javascript">//<![CDATA[
CKEDITOR.replace('Content', {"width":890,"height":300});
//]]></script>
</div>
			<div class="clear"></div>
		</div> 


	</div>


</form>
