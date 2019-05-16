<?php
	session_start();
	error_reporting(E_ALL & ~E_NOTICE & ~8192);
	
	if(isset($_POST["status"])){
		switch ($_POST["status"]) {
			case "mini":
				$_SESSION["status_cart"] = "mini";  
				break;
			case "show":
				$_SESSION["status_cart"] = "show";  
				break;
			case "hidden":
				$_SESSION["status_cart"]= "hidden";  
				break;
			default:
				$_SESSION["status_cart"] = "hidden";  
				break;
		}
	}
    
?>