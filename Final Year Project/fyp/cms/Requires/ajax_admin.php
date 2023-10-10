<?php
include "../Connect/connect.php";
$type = $_POST['type'];

switch($type){
    case 'all':
        $userResult = $mysqli->query("SELECT * FROM system_admin WHERE admin_trash = 0");
        $i = 0;
        if(mysqli_num_rows($userResult) > 0){
            while($rowUser = $userResult->fetch_assoc()){
                $array[$i]['admin_id'] = $rowUser['admin_id'];
                $array[$i]['admin_username'] = $rowUser['admin_username'];
                $array[$i]['admin_fullname'] = $rowUser['admin_fullname'];
                $array[$i]['admin_contact'] = $rowUser['admin_contact'];
                $array[$i]['admin_email'] = $rowUser['admin_email'];
                $i++;
            }
        }
        else{
            $array[$i]['admin_id'] = '';
            $array[$i]['admin_username'] = '';
            $array[$i]['admin_fullname'] = '';
            $array[$i]['admin_contact'] = '';
            $array[$i]['admin_email'] = '';
        }
    break;

    case 'search':
        $keyword = $_POST['keyword'];
        $userResult = $mysqli->query("SELECT * FROM system_admin WHERE admin_username LIKE '%".$keyword."%'AND admin_trash = 0");
        $i = 0;
        if(mysqli_num_rows($userResult) > 0){
            while($rowUser = $userResult->fetch_assoc()){
                $array[$i]['admin_id'] = $rowUser['admin_id'];
                $array[$i]['admin_username'] = $rowUser['admin_username'];
                $array[$i]['admin_fullname'] = $rowUser['admin_fullname'];
                $array[$i]['admin_contact'] = $rowUser['admin_contact'];
                $array[$i]['admin_email'] = $rowUser['admin_email'];
                $i++;
            }
        }
        else{
            $array[$i]['admin_id'] = '';
            $array[$i]['admin_username'] = '';
            $array[$i]['admin_fullname'] = '';
            $array[$i]['admin_contact'] = '';
            $array[$i]['admin_email'] = '';
        }
    break;

    case 'delete':
        $id = $_POST['id'];
        $mysqli->query("UPDATE system_admin SET admin_trash = '1' WHERE admin_id = '".$id."'");
    break;

    default:
}
echo json_encode($array);
?>