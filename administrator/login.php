<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , '../libraries/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	include_once _lib."pclzip.php";		
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";	
	$login_name = 'NINACO';	
	$d = new database($config['database']);	
	$archive = new PclZip($file);
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator - Hệ thống quản trị nội dung</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/external.js"></script>
</head>

<body class="nobg loginPage">
<!-- Top fixed navigation -->
<div class="topNav">
    <div class="wrapper">
        <div class="userNav">
            <ul>
                <li><a href="https://<?=$config_url?>" title="" target="_blank"><img src="images/icons/topnav/mainWebsite.png" alt="" /><span>Vào trang web</span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>

<!-- Main content wrapper -->
<div class="loginWrapper">
    <!--<div class="loginLogo"><img src="images/logo.png" alt="" /></div>-->
    <div class="widget" id="loginForm">
        <div class="title"><img src="images/icons/dark/files.png" alt="" class="titleIcon" /><h6>Đăng nhập</h6></div>
        <form action="default.php?com=user&act=login" id="validate" class="form" method="post">
            <fieldset>
                <div class="formRow">
                    <label for="login">Tên đăng nhập:</label>
                    <div class="loginInput"><input type="text" name="username" class="validate[required]" id="username" /></div>
                    <div class="clear"></div>
                </div>
                
                <div class="formRow">
                    <label for="pass">Mật khẩu:</label>
                    <div class="loginInput"><input type="password" name="password" class="validate[required]" id="pass" /></div>
                    <div class="clear"></div>
                </div>
                
                <div class="loginControl">
                    <!--<div class="rememberMe"><a href="#" class="forgot-pwd">Bạn quên mật khẩu?</a></div>-->
                    <input type="submit" value="Đăng nhập" class="dredB logMeIn" />
                    <div class="clear"></div>
                </div>
                <div class="ajaxloader"><img src="images/loader.gif" alt="loader" /></div>
                <div id="loginError">
                </div>
            </fieldset>
        </form>
    </div>
    
    <div class="widget" id="forgotForm" style="display:none;">
        <div class="title"><img src="images/icons/dark/files.png" alt="" class="titleIcon" /><h6>Khôi phục mật khẩu</h6></div>
        <form action="" class="form" method="post" id="validate1">
            <fieldset>
                <div class="formRow">
                	<label for="login">Bạn hãy nhập email vào ô bên dưới:</label>
                    <div class="clear"></div>
                </div>
                
                <div class="formRow">
                    <label for="pass">Email:</label>
                    <div class="loginInput"><input type="text" id="email" class="validate[required,custom[email]]" name="email"></div>
                    <div class="clear"></div>
                </div>
                
                <div class="loginControl">
                    <div class="rememberMe"><a href="#" class="back-login">Quay lại khung đăng nhập</a></div>
                    <input type="submit" value="Gửi" class="dredB sendEmail" style="float:right;" />
                    <div class="clear"></div>
                </div>
                <div class="ajaxloader"><img src="images/loader.gif" alt="loader" /></div>
                <div id="echoMessage">
                </div>
            </fieldset>
        </form>
    </div>
</div>    
<!-- Footer line -->
<div id="footer">
  <div class="wrapper"> <a href="" title=""></a></div>

</div>
</body>
</html>
