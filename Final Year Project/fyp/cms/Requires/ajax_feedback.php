<?php
include "../Connect/connect.php";
$type = $_POST['type'];

switch($type){
    case 'all':
        $feedbackResult = $mysqli->query("SELECT * FROM system_user_feedback WHERE feedback_trash = 0");
        $i = 0;
        if(mysqli_num_rows($feedbackResult) > 0){
            while($rowFeedback = $feedbackResult->fetch_assoc()){
                $array[$i]['feedback_id'] = $rowFeedback['feedback_id'];
                $array[$i]['feedback_name'] = $rowFeedback['feedback_name'];
                $array[$i]['feedback_email'] = $rowFeedback['feedback_email'];
                $array[$i]['feedback_subject'] = $rowFeedback['feedback_subject'];
                $array[$i]['feedback_message'] = $rowFeedback['feedback_message'];
                $array[$i]['feedback_status'] = $rowFeedback['feedback_status'];
                $i++;
            }
        }
        else{
            $array[$i]['feedback_id'] = '';
            $array[$i]['feedback_name'] = '';
            $array[$i]['feedback_email'] = '';
            $array[$i]['feedback_subject'] = '';
            $array[$i]['feedback_message'] = '';
            $array[$i]['feedback_status'] = '';
        }
    break;

    case 'search':
        $keyword = $_POST['keyword'];
        $feedResult = $mysqli->query("SELECT * FROM system_user_feedback WHERE feedback_subject LIKE '%".$keyword."%'AND feedback_trash = 0");
        $i = 0;
        if(mysqli_num_rows($feedResult) > 0){
            while($rowFeedback = $feedResult->fetch_assoc()){
                $array[$i]['feedback_id'] = $rowFeedback['feedback_id'];
                $array[$i]['feedback_name'] = $rowFeedback['feedback_name'];
                $array[$i]['feedback_email'] = $rowFeedback['feedback_email'];
                $array[$i]['feedback_subject'] = $rowFeedback['feedback_subject'];
                $array[$i]['feedback_message'] = $rowFeedback['feedback_message'];
                $array[$i]['feedback_status'] = $rowFeedback['feedback_status'];
                $i++;
            }
        }
        else{
            $array[$i]['feedback_id'] = '';
            $array[$i]['feedback_name'] = '';
            $array[$i]['feedback_email'] = '';
            $array[$i]['feedback_subject'] = '';
            $array[$i]['feedback_message'] = '';
            $array[$i]['feedback_status'] = '';
        }
    break;

    case 'delete':
        $id = $_POST['id'];
        $mysqli->query("UPDATE system_user_feedback SET feedback_trash = '1' WHERE feedback_id = '".$id."'");
    break;

    default:
}
echo json_encode($array);
?>