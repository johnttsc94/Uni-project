<?php
include "../Connect/connect.php";

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $status = $mysqli->query("UPDATE system_user_edu SET edu_trash = '1' WHERE edu_id = '".$id."'");
    if($status){
        echo "true";
    }else{
        echo "false";
    }
}else{
    echo "true";
}

?>