<?php
	function get_list_user_permissions($id=0){
		$sql_parent="select * from table_user_permissions where id_parent=0 order by stt,id desc";
		$result_parent=mysql_query($sql_parent);		
		$str='';
		
		while ($row_parent=@mysql_fetch_array($result_parent)) {
			
			$str.='<div class="formRow">
			  <label><h6 class="red">'.$row_parent["ten"].'</h6></label>
			  <div class="formRight">        				          
			  </div>
			  <div class="clear"></div>
			</div>';		
			
			$sql="select * from table_user_permissions where id_parent='".$row_parent['id']."' order by stt,id desc";
			$stmt=mysql_query($sql);
			while ($row=@mysql_fetch_array($stmt)) 
			{
							
				$sql="select * from table_user_role_perms where id_role= '$id' and id_permission = '".$row["id"]."'";
				$temp=mysql_query($sql);	
				$result = mysql_fetch_array($temp);
				
				//Check quyen xem
				if($result['permission'] & 1)
					$view='checked="checked"';
				else $view='';
				
				//Check quyen them
				if($result['permission'] & 2)
					$add='checked="checked"';
				else $add='';
				
				//Check quyen sua
				if($result['permission'] & 4)
					$edit='checked="checked"';
				else $edit='';
				
				//Check quyen xoa
				if($result['permission'] & 8)
					$delete='checked="checked"';
				else $delete='';
				
				
				$str.=' <div class="formRow">
			  <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row["ten"].'</label>
			  <div class="formRight">        
				  <input type="hidden" name="perm[]"  value="'.$row["id"].'" />
				<input type="checkbox" name="view'.$row["id"].'" value="1" '.$view.'/>
				<label>Xem</label>   
				 <input type="checkbox" name="add'.$row["id"].'" value="2" '.$add.'/>
				<label>Thêm</label>   			 
				 <input type="checkbox" name="edit'.$row["id"].'" value="4" '.$edit.' />
				<label>Sửa</label>    
				 <input type="checkbox" name="delete'.$row["id"].'" value="8" '.$delete.' />
				<label>Xóa</label>          
			  </div>
			  <div class="clear"></div>
			</div>';			
			}//End for child
		}//End for of parent
	return $str;	
	}
?>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
</script>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="default.php?com=user&act=man_cat"><span>Danh sách nhóm</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Chỉnh sửa nhóm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="default.php?com=user&act=save_cat" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Thông tin nhóm</h6>
		</div>		
		
        <div class="formRow">
			<label>Tên danh mục:</label>
			<div class="formRight">
                <input type="text" name="name" title="Nhập tên nhóm" id="name" class="tipS validate[required]" value="<?=@$item['ten']?>" />
			</div>
			<div class="clear"></div>
		</div>
		     
       
		
       
       
		<div class="formRow">
			<label>Mô tả:</label>
			<div class="formRight">
				<textarea rows="8" cols="" title="Viết mô tả cho nhóm thành viên" class="tipS validate[required]" name="short" id="short"><?=@$item['mota']?></textarea>
			</div>
			<div class="clear"></div>
		</div>
		 <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">           
            <input type="checkbox" name="active" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
            <label for="check1">Hiển thị</label>            
          </div>
          <div class="clear"></div>
        </div>
		 <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="num" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
		
	</div>  
	<div class="widget">						
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Phân quyền cho nhóm</h6>
		</div>	
        
        <?=get_list_user_permissions($item['id'])?>
        <div class="formRow">
			<div class="formRight">
                <input type="hidden" name="id" id="id_this_user" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />

			</div>
			<div class="clear"></div>
		</div>
	</div>
</form>        

