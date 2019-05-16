<?php
 	$d->reset();
	$sql = "SELECT COUNT(*) as num FROM #_member where view=0 ";
	$d->query($sql);
	$row_lienhe = $d->fetch_array();

?>
<div class="wrapper">
        <div class="welcome"><a href="#" title=""><img src="images/userPic.png" alt="" /></a><span>Xin chào, <?=$_SESSION['login']['username']?>!</span></div>
        <div class="userNav">
            <ul>
                <li><a href="http://<?=$config_url?>" title="" target="_blank"><img src="./images/icons/topnav/mainWebsite.png" alt="" /><span>Vào trang web</span></a></li>
                <li><a href="default.php?com=user&act=admin_edit" title=""><img src="images/icons/topnav/profile.png" alt="" /><span>Thông tin tài khoản</span></a></li>

				<li class="ddnew">
					<a title=""><img src="images/icons/topnav/messages.png" alt="" /><span>Thông báo</span><span class="numberTop"><?=$row_lienhe['num']?></span></a>
					<ul class="userMessage">
		
						<li><a href="default.php?com=thanhvien&act=man" title="" class="sInbox"><span>Liên hệ</span> <span class="numberTop" style="float:none; display:inline-block"> <?=$row_lienhe['num']?> </span></a></li>
					</ul>
				</li>
                <li><a href="default.php?com=user&act=logout" title=""><img src="images/icons/topnav/logout.png" alt="" /><span>Đăng xuất</span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>