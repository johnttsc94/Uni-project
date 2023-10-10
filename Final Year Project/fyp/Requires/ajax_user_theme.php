<?php
include "../Connect/connect.php";

if(isset($_POST['id'])){
    $id = $_POST['id'];
    switch($_POST["type"]){
        case "update1":
                $color = $_POST['color'];
                $userResult = $mysqli->query("UPDATE system_user SET user_theme1 = '".$color."' WHERE user_id = '".$id."' AND user_trash = '0' ");
                if($userResult){
                    echo "success";
                }else{
                    echo "fail";
                }
            break;
        
        case "update2":
            $color = $_POST['color'];
            if($color == "dark"){
                $userResult = $mysqli->query("UPDATE system_user SET user_theme2 = 'light' WHERE user_id = '".$id."' AND user_trash = '0' ");
            }else{
                $userResult = $mysqli->query("UPDATE system_user SET user_theme2 = 'dark' WHERE user_id = '".$id."' AND user_trash = '0' ");
            }
            
            if($userResult){
                echo "success";
            }else{
                echo "fail";
            }
        break;
            
        case "retrieve":
            $userResult = $mysqli->query("SELECT * FROM  system_user WHERE user_id = '".$id."' AND user_trash = '0' LIMIT 1");
            if(mysqli_num_rows($userResult) > 0){
                $rowUser = $userResult->fetch_assoc();
                $result["user_theme1"] = $rowUser["user_theme1"];
                $result["user_theme2"] = $rowUser["user_theme2"];
            }
            echo json_encode($result);
            break;
            
    }
    
    
}

?>