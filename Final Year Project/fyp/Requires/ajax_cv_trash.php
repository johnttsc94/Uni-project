<?php
include "../Connect/connect.php";

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $status = $mysqli->query("UPDATE system_user SET user_cv = NULL AND user_cv_size = NULL WHERE user_id = '".$id."'");
    if($status){
        echo "true";
    }else{
        echo "false";
    }
}else{
    echo "true";
}

?>