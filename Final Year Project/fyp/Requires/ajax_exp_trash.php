<?php
include "../Connect/connect.php";

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $status = $mysqli->query("UPDATE system_user_exp SET exp_trash = '1' WHERE exp_id = '".$id."'");
    if($status){
        echo "true";
    }else{
        echo "false";
    }
}else{
    echo "true";
}

?>