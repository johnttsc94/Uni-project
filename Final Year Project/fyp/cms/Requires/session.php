<?php
    if(!isset($_COOKIE['admin_session'])){
        header("Location: login.php") ;
	    exit ;
    }
?>
