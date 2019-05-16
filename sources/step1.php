<?php

if (!defined('_source'))
    die("Error");
//check($_POST);
if($_SESSION["login_web"]["id"]!=''){
	redirect("thanh-toan.html");
}

?>