<?php
include "../Connect/connect.php";
$key = $_POST['key'];
$userResult = $mysqli->query("SELECT * FROM system_user WHERE user_username = '".$key."' AND user_trash = 0 ");
if(mysqli_num_rows($userResult) > 0){
    $status = "false";
}else{
    $status = "true";
}
echo $status;
?>