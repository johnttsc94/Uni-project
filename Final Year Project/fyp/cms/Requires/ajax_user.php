<?php
include "../Connect/connect.php";
$type = $_POST['type'];

switch($type){
    case 'all':
        $userResult = $mysqli->query("SELECT * FROM system_user WHERE user_trash = 0");
        
        $i = 0;
        if(mysqli_num_rows($userResult) > 0){
            while($rowUser = $userResult->fetch_assoc()){

                $userBusinessResult = $mysqli->query("SELECT * FROM system_user_business WHERE business_id = '".$rowUser['user_business']."'");
                $businessName = "";
                if(mysqli_num_rows($userBusinessResult) > 0){
                    $rowUserBusiness = mysqli_fetch_assoc($userBusinessResult);
                    $businessName = $rowUserBusiness['business_name'];
                }else{
                    $businessName = "";
                }

                $userEduResult = $mysqli->query("SELECT * FROM system_user_edu WHERE edu_user_id = '".$rowUser['user_id']."' AND edu_trash = 0");
                if(mysqli_num_rows($userEduResult) > 0){
                    
                    $tempTitle="";
                    $tempStart="";
                    $tempEnd="";
                    $tempPresent="";
                    $tempInstitute="";
                    $tempDescription="";

                    while($rowUserEdu = mysqli_fetch_assoc($userEduResult)){
                        $tempTitle .= $rowUserEdu['edu_title']."//@@//";
                        $tempStart .= $rowUserEdu['edu_start_date']."//@@//";
                        $tempEnd .= $rowUserEdu['edu_end_date']."//@@//";
                        $tempPresent .= $rowUserEdu['edu_present']."//@@//";
                        $tempInstitute .= $rowUserEdu['edu_institute']."//@@//";
                        $tempDescription .= $rowUserEdu['edu_description']."//@@//";
                    }
                    $array[$i]['user_edu_title'] = $tempTitle;
                    $array[$i]['user_edu_start'] = $tempStart;
                    $array[$i]['user_edu_end'] = $tempEnd;
                    $array[$i]['user_edu_present'] = $tempPresent;
                    $array[$i]['user_edu_institute'] = $tempInstitute;
                    $array[$i]['user_edu_description'] = $tempDescription;
                }else{
                    $array[$i]['user_edu_title'] = "";
                    $array[$i]['user_edu_start'] = "";
                    $array[$i]['user_edu_end'] = "";
                    $array[$i]['user_edu_present'] = "";
                    $array[$i]['user_edu_institute'] = "";
                    $array[$i]['user_edu_description'] = "";
                }

                $userExpResult = $mysqli->query("SELECT * FROM system_user_exp WHERE exp_user_id = '".$rowUser['user_id']."' AND exp_trash = 0");
                if(mysqli_num_rows($userExpResult) > 0){
                    
                    $tempTitle="";
                    $tempStart="";
                    $tempEnd="";
                    $tempPresent="";
                    $tempInstitute="";
                    $tempDescription="";

                    while($rowUserExp = mysqli_fetch_assoc($userExpResult)){
                        $tempTitle .= $rowUserExp['exp_title']."//@@//";
                        $tempStart .= $rowUserExp['exp_start_date']."//@@//";
                        $tempEnd .= $rowUserExp['exp_end_date']."//@@//";
                        $tempPresent .= $rowUserExp['exp_present']."//@@//";
                        $tempInstitute .= $rowUserExp['exp_institute']."//@@//";
                        $tempDescription .= $rowUserExp['exp_description']."//@@//";
                    }
                    $array[$i]['user_exp_title'] = $tempTitle;
                    $array[$i]['user_exp_start'] = $tempStart;
                    $array[$i]['user_exp_end'] = $tempEnd;
                    $array[$i]['user_exp_present'] = $tempPresent;
                    $array[$i]['user_exp_institute'] = $tempInstitute;
                    $array[$i]['user_exp_description'] = $tempDescription;
                }else{
                    $array[$i]['user_exp_title'] = "";
                    $array[$i]['user_exp_start'] = "";
                    $array[$i]['user_exp_end'] = "";
                    $array[$i]['user_exp_present'] = "";
                    $array[$i]['user_exp_institute'] = "";
                    $array[$i]['user_exp_description'] = "";
                }

                $userAbResult = $mysqli->query("SELECT * FROM system_user_abilities WHERE ab_user_id = '".$rowUser['user_id']."' AND ab_trash = 0");
                if(mysqli_num_rows($userAbResult) > 0){
                    
                    $tempTitle="";
                    $tempIndex="";

                    while($rowUserAb = mysqli_fetch_assoc($userAbResult)){
                        $tempTitle .= $rowUserAb['ab_title']."//@@//";
                        $tempIndex .= $rowUserAb['ab_index']."//@@//";
                        
                    }
                    $array[$i]['user_ab_title'] = $tempTitle;
                    $array[$i]['user_ab_index'] = $tempIndex;
                    
                }else{
                    $array[$i]['user_ab_title'] = "";
                    $array[$i]['user_ab_index'] = "";
                }

                $array[$i]['user_id'] = $rowUser['user_id'];
                $array[$i]['user_gender'] = $rowUser['user_gender'];
                $array[$i]['user_address'] = $rowUser['user_address'];
                $array[$i]['user_country'] = $rowUser['user_country'];
                $array[$i]['user_business'] = $businessName;
                $array[$i]['user_fname'] = $rowUser['user_fname'];
                $array[$i]['user_lname'] = $rowUser['user_lname'];
                $array[$i]['user_image'] = $rowUser['user_image'];
                $array[$i]['user_email'] = $rowUser['user_email'];
                $array[$i]['user_facebook'] = $rowUser['user_facebook'];
                $array[$i]['user_twitter'] = $rowUser['user_twitter'];
                $array[$i]['user_profile'] = $rowUser['user_profile'];
                $array[$i]['user_dob'] = $rowUser['user_dob'];
                $array[$i]['user_language'] = $rowUser['user_language'];
                $array[$i]['user_skill'] = $rowUser['user_skill'];
                $array[$i]['user_cv'] = $rowUser['user_cv'];
                $array[$i]['user_phone'] = $rowUser['user_phone'];
                $array[$i]['user_username'] = $rowUser['user_username'];
                $array[$i]['user_vlink'] = $rowUser['user_vlink'];
                $array[$i]['user_createdDate'] = $rowUser['user_createdDate'];
                $i++;
            }
        }
        else{
                $array[$i]['user_id'] = "";
                $array[$i]['user_gender'] = "";
                $array[$i]['user_address'] = "";
                $array[$i]['user_country'] = "";
                $array[$i]['user_business'] = "";
                $array[$i]['user_fname'] = "";
                $array[$i]['user_lname'] = "";
                $array[$i]['user_image'] = "";
                $array[$i]['user_email'] = "";
                $array[$i]['user_facebook'] = "";
                $array[$i]['user_twitter'] = "";
                $array[$i]['user_profile'] = "";
                $array[$i]['user_dob'] = "";
                $array[$i]['user_language'] = "";
                $array[$i]['user_skill'] = "";
                $array[$i]['user_cv'] = "";
                $array[$i]['user_phone'] = "";
                $array[$i]['user_username'] = "";
                $array[$i]['user_vlink'] = "";
                $array[$i]['user_createdDate'] = "";

                $array[$i]['user_edu_title'] = "";
                $array[$i]['user_edu_start'] = "";
                $array[$i]['user_edu_end'] = "";
                $array[$i]['user_edu_present'] = "";
                $array[$i]['user_edu_institute'] = "";
                $array[$i]['user_edu_description'] = "";

                $array[$i]['user_exp_title'] = "";
                $array[$i]['user_exp_start'] = "";
                $array[$i]['user_exp_end'] = "";
                $array[$i]['user_exp_present'] = "";
                $array[$i]['user_exp_institute'] = "";
                $array[$i]['user_exp_description'] = "";

                $array[$i]['user_ab_title'] = "";
                $array[$i]['user_ab_index'] = "";
        }
    break;

    case 'search':
        $keyword = $_POST['keyword'];
        $userResult = $mysqli->query("SELECT * FROM system_user WHERE user_username LIKE '%".$keyword."%'AND user_trash = 0");
        $i = 0;
        if(mysqli_num_rows($userResult) > 0){
            while($rowUser = $userResult->fetch_assoc()){
                $userBusinessResult = $mysqli->query("SELECT * FROM system_user_business WHERE business_id = '".$rowUser['user_business']."'");
                $businessName = "";
                if(mysqli_num_rows($userBusinessResult) > 0){
                    $rowUserBusiness = mysqli_fetch_assoc($userBusinessResult);
                    $businessName = $rowUserBusiness['business_name'];
                }else{
                    $businessName = "";
                }

                $userEduResult = $mysqli->query("SELECT * FROM system_user_edu WHERE edu_user_id = '".$rowUser['user_id']."' AND edu_trash = 0");
                if(mysqli_num_rows($userEduResult) > 0){
                    
                    $tempTitle="";
                    $tempStart="";
                    $tempEnd="";
                    $tempPresent="";
                    $tempInstitute="";
                    $tempDescription="";

                    while($rowUserEdu = mysqli_fetch_assoc($userEduResult)){
                        $tempTitle .= $rowUserEdu['edu_title']."//@@//";
                        $tempStart .= $rowUserEdu['edu_start_date']."//@@//";
                        $tempEnd .= $rowUserEdu['edu_end_date']."//@@//";
                        $tempPresent .= $rowUserEdu['edu_present']."//@@//";
                        $tempInstitute .= $rowUserEdu['edu_institute']."//@@//";
                        $tempDescription .= $rowUserEdu['edu_description']."//@@//";
                    }
                    $array[$i]['user_edu_title'] = $tempTitle;
                    $array[$i]['user_edu_start'] = $tempStart;
                    $array[$i]['user_edu_end'] = $tempEnd;
                    $array[$i]['user_edu_present'] = $tempPresent;
                    $array[$i]['user_edu_institute'] = $tempInstitute;
                    $array[$i]['user_edu_description'] = $tempDescription;
                }else{
                    $array[$i]['user_edu_title'] = "";
                    $array[$i]['user_edu_start'] = "";
                    $array[$i]['user_edu_end'] = "";
                    $array[$i]['user_edu_present'] = "";
                    $array[$i]['user_edu_institute'] = "";
                    $array[$i]['user_edu_description'] = "";
                }

                $userExpResult = $mysqli->query("SELECT * FROM system_user_exp WHERE exp_user_id = '".$rowUser['user_id']."' AND exp_trash = 0");
                if(mysqli_num_rows($userExpResult) > 0){
                    
                    $tempTitle="";
                    $tempStart="";
                    $tempEnd="";
                    $tempPresent="";
                    $tempInstitute="";
                    $tempDescription="";

                    while($rowUserExp = mysqli_fetch_assoc($userExpResult)){
                        $tempTitle .= $rowUserExp['exp_title']."//@@//";
                        $tempStart .= $rowUserExp['exp_start_date']."//@@//";
                        $tempEnd .= $rowUserExp['exp_end_date']."//@@//";
                        $tempPresent .= $rowUserExp['exp_present']."//@@//";
                        $tempInstitute .= $rowUserExp['exp_institute']."//@@//";
                        $tempDescription .= $rowUserExp['exp_description']."//@@//";
                    }
                    $array[$i]['user_exp_title'] = $tempTitle;
                    $array[$i]['user_exp_start'] = $tempStart;
                    $array[$i]['user_exp_end'] = $tempEnd;
                    $array[$i]['user_exp_present'] = $tempPresent;
                    $array[$i]['user_exp_institute'] = $tempInstitute;
                    $array[$i]['user_exp_description'] = $tempDescription;
                }else{
                    $array[$i]['user_exp_title'] = "";
                    $array[$i]['user_exp_start'] = "";
                    $array[$i]['user_exp_end'] = "";
                    $array[$i]['user_exp_present'] = "";
                    $array[$i]['user_exp_institute'] = "";
                    $array[$i]['user_exp_description'] = "";
                }

                $userAbResult = $mysqli->query("SELECT * FROM system_user_abilities WHERE ab_user_id = '".$rowUser['user_id']."' AND ab_trash = 0");
                if(mysqli_num_rows($userAbResult) > 0){
                    
                    $tempTitle="";
                    $tempIndex="";

                    while($rowUserAb = mysqli_fetch_assoc($userAbResult)){
                        $tempTitle .= $rowUserAb['ab_title']."//@@//";
                        $tempIndex .= $rowUserAb['ab_index']."//@@//";
                        
                    }
                    $array[$i]['user_ab_title'] = $tempTitle;
                    $array[$i]['user_ab_index'] = $tempIndex;
                    
                }else{
                    $array[$i]['user_ab_title'] = "";
                    $array[$i]['user_ab_index'] = "";
                }

                $array[$i]['user_id'] = $rowUser['user_id'];
                $array[$i]['user_gender'] = $rowUser['user_gender'];
                $array[$i]['user_address'] = $rowUser['user_address'];
                $array[$i]['user_country'] = $rowUser['user_country'];
                $array[$i]['user_business'] = $businessName;
                $array[$i]['user_fname'] = $rowUser['user_fname'];
                $array[$i]['user_lname'] = $rowUser['user_lname'];
                $array[$i]['user_image'] = $rowUser['user_image'];
                $array[$i]['user_email'] = $rowUser['user_email'];
                $array[$i]['user_facebook'] = $rowUser['user_facebook'];
                $array[$i]['user_twitter'] = $rowUser['user_twitter'];
                $array[$i]['user_profile'] = $rowUser['user_profile'];
                $array[$i]['user_dob'] = $rowUser['user_dob'];
                $array[$i]['user_language'] = $rowUser['user_language'];
                $array[$i]['user_skill'] = $rowUser['user_skill'];
                $array[$i]['user_cv'] = $rowUser['user_cv'];
                $array[$i]['user_phone'] = $rowUser['user_phone'];
                $array[$i]['user_username'] = $rowUser['user_username'];
                $array[$i]['user_vlink'] = $rowUser['user_vlink'];
                $array[$i]['user_createdDate'] = $rowUser['user_createdDate'];
                $i++;
            }
        }
        else{
            $array[$i]['user_id'] = "";
            $array[$i]['user_gender'] = "";
            $array[$i]['user_address'] = "";
            $array[$i]['user_country'] = "";
            $array[$i]['user_business'] = "";
            $array[$i]['user_fname'] = "";
            $array[$i]['user_lname'] = "";
            $array[$i]['user_image'] = "";
            $array[$i]['user_email'] = "";
            $array[$i]['user_facebook'] = "";
            $array[$i]['user_twitter'] = "";
            $array[$i]['user_profile'] = "";
            $array[$i]['user_dob'] = "";
            $array[$i]['user_language'] = "";
            $array[$i]['user_skill'] = "";
            $array[$i]['user_cv'] = "";
            $array[$i]['user_phone'] = "";
            $array[$i]['user_username'] = "";
            $array[$i]['user_vlink'] = "";
            $array[$i]['user_createdDate'] = "";

            $array[$i]['user_edu_title'] = "";
            $array[$i]['user_edu_start'] = "";
            $array[$i]['user_edu_end'] = "";
            $array[$i]['user_edu_present'] = "";
            $array[$i]['user_edu_institute'] = "";
            $array[$i]['user_edu_description'] = "";

            $array[$i]['user_exp_title'] = "";
            $array[$i]['user_exp_start'] = "";
            $array[$i]['user_exp_end'] = "";
            $array[$i]['user_exp_present'] = "";
            $array[$i]['user_exp_institute'] = "";
            $array[$i]['user_exp_description'] = "";

            $array[$i]['user_ab_title'] = "";
            $array[$i]['user_ab_index'] = "";
        }
    break;

    case 'delete':
        $id = $_POST['id'];
        $mysqli->query("UPDATE system_user SET user_trash = '1' WHERE user_id = '".$id."'");
    break;

    default:
}
echo json_encode($array);
?>