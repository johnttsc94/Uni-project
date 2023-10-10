<?php
    if(!isset($_COOKIE['user_id']) || !isset($_SESSION['user_id'])){
        header("Location: sign-in.php") ;
	    exit ;
    }
?>
