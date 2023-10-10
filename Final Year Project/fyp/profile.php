

<!doctype html>
<html lang="en">

    <?php
    session_start();
    include "Connect/connect.php";
    include "Requires/header.php";
    ?>
    
    <body>
        
        <?php
        $status = "";
        //check user session
        $userID = "";
        if(isset($_SESSION['user_id'])){
            $userID = $_SESSION['user_id'];
        }
        if(isset($_COOKIE['user_id'])){
            $userID = $_COOKIE['user_id'];
        }?>

        <span style="display:none" id="memoUserID"><?=$userID?></span>

        <?php
        //retrieve user password info
        $userResult = $mysqli->query("SELECT user_password FROM system_user WHERE user_id = '".$userID."' AND user_trash = 0");
        if(mysqli_num_rows($userResult) > 0){
            $rowUser = mysqli_fetch_assoc($userResult);
        }

        //update user info
        if(!empty($_POST) && isset($_POST['submit'])){

            //file size constant
            define('KB', 1024);
            define('MB', 1048576);
            define('GB', 1073741824);
            define('TB', 1099511627776);

            //image info
            $imgName = $_FILES["image"]["name"];
            $tempImgName = $_FILES["image"]["tmp_name"];
            $imgType = pathinfo($imgName, PATHINFO_EXTENSION); 
            $allowTypes = array('jpg','png','jpeg','gif'); 
            $imgFolder = "Images/" . $imgName;

            //cv info
            $fileName = $_FILES["attachmentscv"]["name"];
            $fileSize = round(($_FILES["attachmentscv"]["size"]/MB),2);
            $tempFileName = $_FILES["attachmentscv"]["tmp_name"];
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
            $fileFolder = "CV/" . $fileName;


            //normal update
            if(isset($_POST['business']) && $_POST['business'] != "0"){
                $normalUpdate = $mysqli->query("UPDATE system_user SET user_fname = '".$_POST['firstName']."', user_lname = '".$_POST['lastName']."', user_email = '".$_POST['email']."', user_language = '".$_POST['language']."', user_phone = '".$_POST['phone']."', user_facebook = '".$_POST['facebook']."', user_twitter = '".$_POST['twitter']."', user_skill = '".$_POST['skill']."', user_dob = '".$_POST['dob']."', user_business = '".$_POST['business']."', user_gender = '".$_POST['gender']."', user_country = '".$_POST['country']."' WHERE user_id = '".$userID."' AND user_trash = 0");
                if($normalUpdate != true){
                    $status = "general-info-fail";
                }
            }else{
                $normalUpdate = $mysqli->query("UPDATE system_user SET user_fname = '".$_POST['firstName']."', user_lname = '".$_POST['lastName']."', user_email = '".$_POST['email']."', user_language = '".$_POST['language']."', user_phone = '".$_POST['phone']."', user_facebook = '".$_POST['facebook']."', user_twitter = '".$_POST['twitter']."', user_skill = '".$_POST['skill']."', user_dob = '".$_POST['dob']."', user_gender = '".$_POST['gender']."', user_country = '".$_POST['country']."' , user_business = NULL WHERE user_id = '".$userID."' AND user_trash = 0");
                if($normalUpdate != true){
                    $status = "general-info-fail";
                }
            }
            
            //update content that might include special symbols
            $stmt = $mysqli->prepare("UPDATE system_user SET user_profile = ?, user_address =?  WHERE user_id = ?");
            $stmt->bind_param('ssi',$_POST['profile'],$_POST['address'],$userID);
            $specialUpdate =  $stmt->execute();
            if($specialUpdate != true){
                $status = "special-info-fail";
            }

            //update password
            if($_POST['currentPass'] != "" || $_POST['newPass'] != "" || $_POST['confirmPass'] != "")
            {
                if(md5($_POST['currentPass']) == $rowUser['user_password'])
                {  
                    if(md5($_POST['newPass']) != $rowUser['user_password']){
                        if($_POST['newPass'] == $_POST['confirmPass']){
                            // Validate password strength
                            $uppercase = preg_match('@[A-Z]@', $_POST['newPass']);
                            $lowercase = preg_match('@[a-z]@', $_POST['newPass']);
                            $number    = preg_match('@[0-9]@', $_POST['newPass']);
                            //$specialChars = preg_match('@[^\w]@', $password);

                            if(strlen($_POST['newPass']) < 8){
                                $status = "pass-short-length";
                            }
                            elseif($uppercase != true){
                                $status = "pass-no-upper";
                            }
                            elseif($lowercase != true){
                                $status = "pass-no-lower";
                            }
                            elseif($number != true){
                                $status = "pass-no-number";
                            }
                            else{
                                $stmt = $mysqli->prepare("UPDATE system_user SET user_password = ? WHERE user_id = ?");
                                $encodedPass = md5($_POST['newPass']);
                                $stmt->bind_param('si',$encodedPass,$userID);
                                $passUpdate =  $stmt->execute();
                                if($passUpdate != true){
                                    $status = "pass-update-fail";
                                }
                            }
                            
                            }else{
                                $status = "password-mismatch";
                            }
                    }else{
                        $status = "same-old-password";
                    }
                    
                }else{
                    $status = "wrong-old-password";
                }
            }

            //upload image
            if($imgName != ""){
                if(in_array($imgType, $allowTypes)){ 
                    $mysqli->query("UPDATE system_user SET user_image = '".$imgName."' WHERE user_id = '".$userID."' AND user_trash = 0");
                    //move image into the right folder
                    if (!move_uploaded_file($tempImgName, $imgFolder)) {
                       $status = "image-upload-fail";
                    } 
                }else{
                    $status = "image-upload-format";
                }
            }

            //upload cv
            if($fileName != ""){
                $mysqli->query("UPDATE system_user SET user_cv = '".$fileName."', user_cv_size = '".$fileSize."' WHERE user_id = '".$userID."' AND user_trash = 0");
                //move cv into the right folder
                if (!move_uploaded_file($tempFileName, $fileFolder)) {
                   $status = "cv-upload-fail";
                } 
            }

            //upload user education
            if(isset($_POST['edu_title'])){
            foreach($_POST['edu_title'] as $key => $value){

                if(isset($_POST['edu_start_date'][$key]) && $_POST['edu_start_date'][$key] !=""){
                    $eduStartDate = $_POST['edu_start_date'][$key];
                }else{
                    $eduStartDate = "";
                }

                if(isset($_POST['edu_end_date'][$key]) && $_POST['edu_end_date'][$key] !=""){
                    $eduEndDate = $_POST['edu_end_date'][$key];
                }else{
                    $eduEndDate = "";
                }

                if(isset($_POST['edu_present'][$key]) && $_POST['edu_present'][$key] !=""){
                    $eduPresent = $_POST['edu_present'][$key];
                }else{
                    $eduPresent = "";
                }

                if(isset($_POST['edu_row'][$key]) && $_POST['edu_row'][$key] != ""){
                    //modify the previous record found in database
                    $mysqli->query("UPDATE system_user_edu SET edu_title = '".$value."', edu_start_date = '".$eduStartDate."', edu_end_date = '".$eduEndDate."',edu_present = '".$eduPresent."', edu_institute = '".$_POST['edu_institute'][$key]."',edu_trash = '".$_POST['edu-trash'][$key]."' WHERE edu_id = '".$_POST['edu_row'][$key]."'");

                    $stmt = $mysqli->prepare("UPDATE system_user_edu SET edu_description = ? WHERE edu_id = ?");
                    $stmt->bind_param('si',$_POST['edu_description'][$key],$_POST['edu_row'][$key]);
                    $stmt->execute();
                }else{
                    //insert into database if no previous record found

                    // $mysqli->query("INSERT INTO system_user_edu(edu_title,edu_user_id,edu_start_date,edu_end_date,edu_present,edu_institute,edu_trash) VALUES('".$value."','".$userID."','".$_POST['edu_start_date'][$key]."','".$_POST['edu_end_date'][$key]."','".$_POST['edu_present'][$key]."','".$_POST['edu_institute'][$key]."','0')");
                    if($value != ""){
                        $stmt = $mysqli->prepare("INSERT INTO system_user_edu(edu_title,edu_user_id,edu_start_date,edu_end_date,edu_present,edu_institute,edu_description,edu_trash) VALUES(?,?,?,?,?,?,?,'0')");
                        $stmt->bind_param('sisssss',$value,$userID,$eduStartDate,$eduEndDate,$eduPresent,$_POST['edu_institute'][$key],$_POST['edu_description'][$key]);
                        $stmt->execute();
                    }
                    

                }
            }
        }

            //upload user experience
            if(isset($_POST['exp_title'])){
                foreach($_POST['exp_title'] as $key => $value){

                    if(isset($_POST['exp_start_date'][$key]) && $_POST['exp_start_date'][$key] !=""){
                        $expStartDate = $_POST['exp_start_date'][$key];
                    }else{
                        $expStartDate = "";
                    }

                    if(isset($_POST['exp_end_date'][$key]) && $_POST['exp_end_date'][$key] !=""){
                        $expEndDate = $_POST['exp_end_date'][$key];
                    }else{
                        $expEndDate = "";
                    }

                    if(isset($_POST['exp_present'][$key]) && $_POST['exp_present'][$key] !=""){
                        $expPresent = $_POST['exp_present'][$key];
                    }else{
                        $expPresent = "";
                    }

                    if(isset($_POST['exp_row'][$key]) && $_POST['exp_row'][$key] != ""){
                        //modify the previous record found in database
                        $mysqli->query("UPDATE system_user_exp SET exp_title = '".$value."', exp_start_date = '".$expStartDate."', exp_end_date = '".$expEndDate."',exp_present = '".$expPresent."', exp_institute = '".$_POST['exp_institute'][$key]."',exp_trash = '".$_POST['exp-trash'][$key]."' WHERE exp_id = '".$_POST['exp_row'][$key]."'");
    
                        $stmt = $mysqli->prepare("UPDATE system_user_exp SET exp_description = ? WHERE exp_id = ?");
                        $stmt->bind_param('si',$_POST['exp_description'][$key],$_POST['exp_row'][$key]);
                        $stmt->execute();
                    }else{
                        //insert into database if no previous record found
                        if($value != ""){
                            $stmt = $mysqli->prepare("INSERT INTO system_user_exp(exp_title,exp_user_id,exp_start_date,exp_end_date,exp_present,exp_institute,exp_description,exp_trash) VALUES(?,?,?,?,?,?,?,'0')");
                            $stmt->bind_param('sisssss',$value,$userID,$expStartDate,$expEndDate,$expPresent,$_POST['exp_institute'][$key],$_POST['exp_description'][$key]);
                            $stmt->execute();
                        }
    
                    }
                }
            }

            //upload user abilities
            if(isset($_POST['abilities'])){
                foreach($_POST['abilities'] as $key => $value){
                    if(isset($_POST['ab-row'][$key]) && $_POST['ab-row'][$key] != ""){
                        //modify the previous record found in database
                        $stmt = $mysqli->prepare("UPDATE system_user_abilities SET ab_title = ?, ab_index = ?, ab_trash = ? WHERE ab_id = ?");
                        $stmt->bind_param('sisi',$value,$_POST['abilities-index'][$key],$_POST['ab-trash'][$key],$_POST['ab-row'][$key]);
                        $stmt->execute();
                    }else{
                        //insert into database if no previous record found
                        if($value != ""){
                            $stmt = $mysqli->prepare("INSERT INTO system_user_abilities(ab_title,ab_index,ab_id,ab_user_id,ab_trash) VALUES(?,?,?,?,'0')");
                            $stmt->bind_param('siii',$value,$_POST['abilities-index'][$key],$_POST['ab-row'][$key],$userID);
                            $stmt->execute();
                        }
                        
    
                    }
                }
            }
            
            

            //Feedback on update status
            switch($status){
                case "general-info-fail":
                    echo "<script>toastr.error('Failed to update user info!')</script>";
                    break;
                case "special-info-fail":
                    echo "<script>toastr.error('Failed to update user info!')</script>";
                    break;
                case "image-upload-fail":
                    echo "<script>toastr.error('Failed to upload image!')</script>";
                    break;
                case "image-upload-format":
                    echo "<script>toastr.error('Only .jpg, .jpeg, .png , .gif image format is accepted!')</script>";
                    break;
                case "cv-upload-fail":
                    echo "<script>toastr.error('Failed to upload CV!')</script>";
                    break;
                case "wrong-old-password":
                    echo "<script>toastr.error('Current password mismatch with existing password!')</script>";
                    break;
                case "password-mismatch":
                    echo "<script>toastr.error('New password mismatch!')</script>";
                    break;
                case "same-old-password":
                    echo "<script>toastr.error('New password is same with existing password')</script>";
                    break;
                case "pass-no-upper":
                    echo "<script>toastr.error('New password should contain at least one uppercase letter')</script>";
                    break;
                case "pass-no-lower":
                    echo "<script>toastr.error('New password should contain at least one lowercase letter')</script>";
                    break;
                case "pass-no-number":
                    echo "<script>toastr.error('New password should contain at least one number')</script>";
                    break;
                case "pass-short-length":
                    echo "<script>toastr.error('New password should be longer than 8 digits')</script>";
                    break;
                case "pass-update-fail":
                    echo "<script>toastr.error('Fail to update new password')</script>";
                    break;
                case "":
                    // echo "<script>toastr.success('Info has been updated')
                    // setTimeout(function () {
                    //     location.href = 'profile.php';
                    // }, 500);</script>";
                    echo "<script>toastr.success('Info has been updated')
                     if ( window.history.replaceState ) {
                        window.history.replaceState( null, null, window.location.href );
                      }</script>";
                    break;
                    default:
            }
            //print_r($rowUser);
            //print_r($_FILES);
            //print_r($_POST);
        }

        //retrieve latest user info
        $userResult = $mysqli->query("SELECT * FROM system_user WHERE user_id = '".$userID."' AND user_trash = 0");
        if(mysqli_num_rows($userResult) > 0){
            $rowUser = mysqli_fetch_assoc($userResult);
        }

        
        
        ?>

        <script type="text/javascript">
            
            $(document).ready(function(){

                $("#myForm :input").on("change input click",function() {
                   $("#submit").prop('disabled',false)
                })
                $("#add-edu").click(function(){
                    var edu_length = $(".edu-row").length;
                    edu_length++;
                    var html = '';
                    html += '<div class="row edu-row">';
                    html += '<div class="btn-group col-lg-12 mb-2" id="edu_'+edu_length + '">';
                    html += '<button class="form-control btn dropdown-toggle shadow p-3 rounded text-ellipsis" style="border-top-right-radius:0;border-bottom-right-radius:0;border-bottom: 2px solid rgba(var(--bs-primary-rgb),var(--bs-bg-opacity))!important;--bs-bg-opacity: 1;" type="button" data-bs-toggle="dropdown"aria-expanded="false"><span class="badge bg-primary fs-5" id="edu_title_first_letter_'+edu_length+'"> E </span>&nbsp;&nbsp;&nbsp;<span id="edu_title_full_text_'+edu_length+'">Education Bar</span> <i class="fa-solid fa-caret-down"></i></button><button class="btn btn-danger edu-trash rounded" type="button" style="flex:none;"><i class="uil uil-trash"></i></button>';
                    html += '<div class="form-control dropdown-menu" style="width:97.5%">';
                    html += '<div class="row" data-length="'+edu_length+'">';
                    html += '<div class="col-lg-12"><div class="mb-3"><label for="edu_title_'+edu_length+'" class="form-label">Title<span style="color:red;">*</span></label><input type="text" class="form-control edu_title" name="edu_title[]" id="edu_title_'+edu_length+'" value="" /></div></div><!--end col-->';
                    html += '<div class="col-lg-5" id="edu_start_date_col_'+edu_length+'"><div class="mb-3"><label for="edu_start_date_'+edu_length+'" class="form-label">Start Date</label><input type="date" class="form-control" name="edu_start_date[]" id="edu_start_date_'+edu_length+'" value="" /></div></div><!--end col-->';
                    html += '<div class="col-lg-5" id="edu_end_date_col_'+edu_length+'"><div class="mb-3"><label for="edu_end_date_'+edu_length+'" class="form-label">End Date</label><input type="hidden" name="edu_end_date[]" id="edu_end_date_'+edu_length+'_hidden" value="" disabled><input type="date" class="form-control" name="edu_end_date[]" id="edu_end_date_'+edu_length+'" value="" /></div></div><!--end col-->';
                    html += '<div class="col-lg-2"><div class="mb-2">Present</div><div class="form-check form-switch"><input type="hidden" name="edu_present[]" id="edu_present_'+edu_length+'_hidden" value="0"><input class="form-check-input mySwitch edu_present" type="checkbox" role="switch" id="edu_present_'+edu_length+'" name="edu_present[]" value="1"></div></div><!--end col-->';
                    html += '<div class="col-lg-12"><div class="mb-3"><label for="edu_institute_'+edu_length+'" class="form-label">Institute</label><input type="text" class="form-control" name="edu_institute[]" id="edu_institute_'+edu_length+'" value="" /></div></div><!--end col-->';
                    html += '<div class="col-lg-12"><div class="mb-3"><label for="edu_description_'+edu_length+'" class="form-label">Description</label><textarea class="form-control" id="edu_description_'+edu_length+'" rows="4" name="edu_description[]"></textarea></div></div> <!--end col-->';
                    html += '</div><!--end of row-->';
                    html += '</div><!--end dropdown-menu-->';
                    html += '</div><!--end btn-group-->';
                    html += '<!--end education bar row--></div>';
                    $("#append-edu").append(html);
                });

                $("#add-exp").click(function(){
                    var exp_length = $(".exp-row").length;
                    exp_length++;
                    var html = '';
                    html += '<div class="row exp-row">';
                    html += '<div class="btn-group col-lg-12 mb-2" id="exp_'+exp_length + '">';
                    html += '<button class="form-control btn dropdown-toggle shadow p-3 rounded text-ellipsis" style="border-top-right-radius:0;border-bottom-right-radius:0;border-bottom: 2px solid rgba(var(--bs-primary-rgb),var(--bs-bg-opacity))!important;--bs-bg-opacity: 1;" type="button" data-bs-toggle="dropdown"aria-expanded="false"><span class="badge bg-primary fs-5" id="exp_title_first_letter_'+exp_length+'"> E </span>&nbsp;&nbsp;&nbsp;<span id="exp_title_full_text_'+exp_length+'">Experience Bar</span> <i class="fa-solid fa-caret-down"></i></button><button class="btn btn-danger exp-trash rounded" type="button" style="flex:none;"><i class="uil uil-trash"></i></button>';
                    html += '<div class="form-control dropdown-menu" style="width:97.5%">';
                    html += '<div class="row" data-length="'+exp_length+'">';
                    html += '<div class="col-lg-12"><div class="mb-3"><label for="exp_title_'+exp_length+'" class="form-label">Title<span style="color:red;">*</span></label><input type="text" class="form-control exp_title" name="exp_title[]" id="exp_title_'+exp_length+'" value="" /></div></div><!--end col-->';
                    html += '<div class="col-lg-5" id="exp_start_date_col_'+exp_length+'"><div class="mb-3"><label for="exp_start_date_'+exp_length+'" class="form-label">Start Date</label><input type="date" class="form-control" name="exp_start_date[]" id="exp_start_date_'+exp_length+'" value="" /></div></div><!--end col-->';
                    html += '<div class="col-lg-5" id="exp_end_date_col_'+exp_length+'"><div class="mb-3"><label for="exp_end_date_'+exp_length+'" class="form-label">End Date</label><input type="hidden" name="exp_end_date[]" id="exp_end_date_'+exp_length+'_hidden" value="" disabled><input type="date" class="form-control" name="exp_end_date[]" id="exp_end_date_'+exp_length+'" value="" /></div></div><!--end col-->';
                    html += '<div class="col-lg-2"><div class="mb-2">Present</div><div class="form-check form-switch"><input type="hidden" name="exp_present[]" id="exp_present_'+exp_length+'_hidden" value="0"><input class="form-check-input mySwitch exp_present" type="checkbox" role="switch" id="exp_present_'+exp_length+'" name="exp_present[]" value="1"></div></div><!--end col-->';
                    html += '<div class="col-lg-12"><div class="mb-3"><label for="exp_institute_'+exp_length+'" class="form-label">Institute</label><input type="text" class="form-control" name="exp_institute[]" id="exp_institute_'+exp_length+'" value="" /></div></div><!--end col-->';
                    html += '<div class="col-lg-12"><div class="mb-3"><label for="exp_description_'+exp_length+'" class="form-label">Description</label><textarea class="form-control" id="exp_description_'+exp_length+'" rows="4" name="exp_description[]"></textarea></div></div> <!--end col-->';
                    html += '</div><!--end of row-->';
                    html += '</div><!--end dropdown-menu-->';
                    html += '</div><!--end btn-group-->';
                    html += '<!--end experience bar row--></div>';
                    $("#append-exp").append(html);
                    
                });
                $("#add-ab").click(function(){
                    
                    var html = '';
                    html += '<div class="row mb-3 ab-row" >';
                    html += '<div class="col-lg-12">';
                    html += '<div class="input-group ">';
                    html += '<input type="text" name="abilities[]" placeholder="Abilities possess along with the respective index." class="form-control w-50" required>';
                    html += '<input type="number" name="abilities-index[]" onKeyPress="if(this.value.length==3) return false;" step="10" min="0" max="100" value="50"  class="percentage form-control">';
                    html += '<button class="btn btn-danger ab-trash" type="button"><i class="fa-solid fa-ban"></i></button>';
                    html += ' </div>';
                    html += ' </div>';
                    html += ' </div>';
                    $("#append-ab").append(html);
    
                });
                
            });
            $(document).on('keyup',".percentage", function() {
                var val = $(this).val();
                if(val > 100){
                    $(this).val("100");
                }
            });
            $(document).on("click",".edu-trash",function() {
                var parent = $(this).parent().parent(".row");
                parent.hide();
                var id = $(this).parents(".edu-row").data("id");
                parent.find("input[name='edu-trash[]']").val("1");
                // $.ajax({
                //     url : "Requires/ajax_edu_trash.php",
                //     data : {"id":id},
                //     type : "POST",
                //     success : function(result){
                //         if(result == "true"){
                //             toastr.success("Thank you, your education row has been removed");
                //         }else{
                //             toastr.error("Sorry, your education row was failed to remove");
                //         }
                // }
                // })
            });
            $(document).on("click",".edu_present",function() {
                var length = $(this).parents(".row").data("length");
                
                var name = $("#edu_end_date_"+length).attr("name");
                var display = $("#edu_end_date_col_"+length).css("display");
                $("#edu_end_date_col_"+length).toggle("2000");
                if(display == "none"){
                    $("#edu_end_date_"+length).attr("name","edu_end_date[]");
                    $("#edu_end_date_"+length+"_hidden").prop("disabled",true);
                    $("#edu_present_"+length+"_hidden").prop("disabled",false);
                }else{
                    $("#edu_end_date_"+length).attr("name","");
                    $("#edu_end_date_"+length+"_hidden").prop("disabled",false);
                    $("#edu_present_"+length+"_hidden").prop("disabled",true);
                }
            });
            $(document).on('keyup','.edu_title',function(){
                var value = $(this).val();
                var length = $(this).parents(".row").data("length");
                if(value == ""){
                    $("#edu_title_full_text_"+length).text("Education Bar");
                    $("#edu_title_first_letter_"+length).text("E");
                }else{
                    $("#edu_title_full_text_"+length).text(value);
                    $("#edu_title_first_letter_"+length).text(value.charAt(0).toUpperCase());
                }
            });


            $(document).on("click",".exp-trash",function() {
                var parent = $(this).parent().parent(".row");
                parent.hide();
                var id = $(this).parents(".exp-row").data("id");
                parent.find("input[name='exp-trash[]']").val("1");
                // $.ajax({
                //     url : "Requires/ajax_exp_trash.php",
                //     data : {"id":id},
                //     type : "POST",
                //     success : function(result){
                //         if(result == "true"){
                //             toastr.success("Thank you, your experience row has been removed");
                //         }else{
                //             toastr.error("Sorry, your experience row was failed to remove");
                //         }
                // }
                // })
            });
            $(document).on("click",".ab-trash",function() {
                var parent = $(this).parents(".ab-row");
                parent.hide();
                // var parent2 = $(this).parents(".input-group");
                // parent2.remove();
                parent.find("input[name='ab-trash[]']").val("1");
            });
            
            $(document).on("click",".exp_present",function() {
                var length = $(this).parents(".row").data("length");
                
                var name = $("#exp_end_date_"+length).attr("name");
                var display = $("#exp_end_date_col_"+length).css("display");
                $("#exp_end_date_col_"+length).toggle("2000");
                if(display == "none"){
                    $("#exp_end_date_"+length).attr("name","exp_end_date[]");
                    $("#exp_end_date_"+length+"_hidden").prop("disabled",true);
                    $("#exp_present_"+length+"_hidden").prop("disabled",false);
                }else{
                    $("#exp_end_date_"+length).attr("name","");
                    $("#exp_end_date_"+length+"_hidden").prop("disabled",false);
                    $("#exp_present_"+length+"_hidden").prop("disabled",true);
                }
            });
            $(document).on('keyup','.exp_title',function(){
                var value = $(this).val();
                var length = $(this).parents(".row").data("length");
                if(value == ""){
                    $("#exp_title_full_text_"+length).text("Experience Bar");
                    $("#exp_title_first_letter_"+length).text("E");
                }else{
                    $("#exp_title_full_text_"+length).text(value);
                    $("#exp_title_first_letter_"+length).text(value.charAt(0).toUpperCase());
                }
            });

            $(document).on("click","#cv_delete",function(){
                var id = $(document).find(".cv_doc").data("id");
                //console.log(id);
                event.preventDefault();
                $.ajax({
                    url : "Requires/ajax_cv_trash.php",
                    data : {"id":id},
                    type : "POST",
                    success : function(result){
                        if(result == "true"){
                            toastr.success("Thank you, your file  has been removed");
                            setTimeout(function () {
                                location.reload();
                            }, 500);
                        }else{
                            toastr.error("Sorry, your file was failed to remove");
                        }
                }
                })
            });

            $(document).on("focusout","input[name='abilities-index[]']",function(){
                var num = Math.round($(this).val() / 10) * 10
                $(this).val(num)
            });
            </script>
         <!--start page Loader -->
         <div id="preloader">
            <div id="status">
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                  </ul>
            </div>
        </div>
        <!--end page Loader -->

        <!-- Begin page -->
        <div>
            <!-- START TOP-BAR -->
            <div class="top-bar">
                <div class="container-fluid custom-container">
                    <div class="row g-0 align-items-center">
                        <?php
                        if($userID == ""){
                            ?>
                            <div class="col-md-12">
                            <ul class="list-inline mb-0 text-center">
                                <li class="list-inline-item py-2 me-2 align-middle" style="font-size:19px;color:#da3746">
                                    <b><i class="uil uil-exclamation-triangle"></i> Please login to view your profile! <a href="sign-in.php">Sign in</a></b>
                                </li>
                                
                            </ul>
                        </div>
                        <!--end col-->
                            <?php
                        }
                        ?>
                        
                    </div>
                    <!--end row-->
                </div>
                <!--end container-->
            </div>
            <!-- END TOP-BAR -->

            <!--Navbar Start-->
            <?php
            echo '<nav class="navbar navbar-expand-lg fixed-top sticky '.($userID == "" ? 'space-top' : '').'" id="navbar">';
            ?>
                <div class="container-fluid custom-container">
                    <a class="navbar-brand text-dark fw-bold me-auto" href="javascript:void(0)">
                        <img src="Images/title-dark.png" height="60" alt="" class="logo-dark" />
                        <img src="Images/title-light.png" height="60" alt="" class="logo-light" />
                    </a>
                    <div>
                        <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-label="Toggle navigation">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mx-auto navbar-center">
                            
                            <li class="nav-item">
                                <a href="profile.php" class="nav-link">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="about.php" class="nav-link">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="services.php" class="nav-link">Services</a>
                            </li>
                            <li class="nav-item">
                                <a href="contact.php" class="nav-link">Contact</a>
                            </li>
                            
                        </ul><!--end navbar-nav-->
                    </div>
                    
                    <ul class="header-menu list-inline d-flex align-items-center mb-0">
                        
                        <li class="list-inline-item dropdown">
                            <a href="javascript:void(0)" class="header-item" id="userdropdown" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <?php
                                if($userID == ""){
                                    $text = "Hi, Guest";
                                    $image = "user.png";
                                }else{
                                    if($rowUser['user_lname'] == ""){
                                        $text = "Hi, User";
                                    }else{
                                        $text = "Hi, ".$rowUser['user_lname'];
                                    }
                                    if($rowUser['user_image'] == ""){
                                        $image = "user.png";
                                    }else{
                                        $image = $rowUser['user_image'];
                                    }
                                }
                                ?>
                                <img src="Images/<?=$image?>" alt="mdo" width="35" height="35" class="rounded-circle me-1"> <span class="d-none d-md-inline-block fw-medium"><?=$text?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown">
                                <?php
                                    if($userID == ""){
                                        echo '<li><a class="dropdown-item" href="sign-in.php">Login</a></li>';
                                    }else{
                                        echo '<li><a class="dropdown-item" href="sign-out.php">Logout</a></li>';
                                    }
                                ?>
                                
                            </ul>
                        </li>
                    </ul><!--end header-menu-->
                </div>
                <!--end container-->
            </nav>
            <!-- Navbar End -->

            <div class="main-content">

                <div class="page-content">

                    <!-- Start home -->
                    <section class="page-title-box">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="text-center text-white">
                                        <h3 class="mb-4" style="font-family: 'Nova Square', cursive;">My Profile</h3>
                                        <div class="page-next" style="font-family: 'Montserrat Alternates', sans-serif;">
                                            Let others know more about yourself
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end container-->
                    </section>
                    <!-- end home -->

                    <!-- START SHAPE -->
                    <div class="position-relative" style="z-index: 1">
                        <div class="shape">
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 250">
                                <path fill="#FFFFFF" fill-opacity="1"
                                    d="M0,192L120,202.7C240,213,480,235,720,234.7C960,235,1200,213,1320,202.7L1440,192L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
                            </svg> -->
                            <svg preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg" style="fill: #ffffff; width: 100%; height: 95px; transform: rotate(180deg);">
                                <path d="M321.39 56.44c58-10.79 114.16-30.13 172-41.86 82.39-16.72 168.19-17.73 250.45-.39C823.78 31 906.67 72 985.66 92.83c70.05 18.48 146.53 26.09 214.34 3V0H0v27.35a600.21 600.21 0 00321.39 29.09z" />
                            </svg>
                        </div>
                    </div>
                    <!-- END SHAPE -->


                    <!-- START PROFILE -->
                    <section class="section c">
                    
                    <div class="drop drop2"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card profile-sidebar me-lg-4">
                                        <div class="card-body p-4">
                                            <div class="text-center pb-4 border-bottom">
                                                <?php
                                                if($userID == ""){
                                                    $name = "Guest";
                                                }else{
                                                    if($rowUser['user_fname'] == "" && $rowUser['user_lname'] == ""){
                                                        $name = "User";
                                                    }else{
                                                        $name = $rowUser['user_fname']." ".$rowUser['user_lname'];
                                                    }
                                                }
                                                
                                                ?>
                                                <img src="Images/<?=$image?>" alt=""
                                                    class="avatar-lg img-thumbnail rounded-circle mb-4" />
                                                    <h5 class="mb-0"><?=$name?></h5>

                                                <?php
                                                    if($userID == ""){
                                                        $businessNature = "IT & Software";
                                                    }else{
                                                        if($rowUser['user_business'] == ""){
                                                            $businessNature = "";
                                                        }else{
                                                            $businessNatureResult = $mysqli->query("SELECT * FROM system_user_business WHERE business_id = '".$rowUser['user_business']."' AND business_trash = 0");
                                                            if(mysqli_num_rows($businessNatureResult) > 0){
                                                                $rowBusinessNature = mysqli_fetch_assoc($businessNatureResult);
                                                            }
                                                            $businessNature = $rowBusinessNature['business_name'];
                                                        }
                                                    }
                                                ?>

                                                    <!-- <p class="text-muted">Developer</p> -->
                                                    <p class="text-muted"><?=$businessNature?></p>
                                                
                                                <ul class="candidate-detail-social-menu list-inline mb-0">
                                                  <?php
                                                  if($userID == ""){
                                                    $fbLink = "javascript:void(0)";
                                                    $twLink = "javascript:void(0)";
                                                    $phLink = "javascript:void(0)";
                                                    $gmLink = "javascript:void(0)";
                                                  }else{
                                                    if($rowUser['user_facebook'] == ""){
                                                        $fbLink = "javascript:void(0)";
                                                    }else{
                                                        $fbLink = $rowUser['user_facebook'];
                                                    }
                                                    if($rowUser['user_twitter'] == ""){
                                                        $twLink = "javascript:void(0)";
                                                    }else{
                                                        $twLink = $rowUser['user_twitter'];
                                                    }
                                                    if($rowUser['user_phone'] == ""){
                                                        $phLink = "javascript:void(0)";
                                                    }else{
                                                        $phLink = "tel:".$rowUser['user_phone'];
                                                    }
                                                    if($rowUser['user_email'] == ""){
                                                        $gmLink = "javascript:void(0)";
                                                    }else{
                                                        $gmLink = "mailto:".$rowUser['user_email'];
                                                    }
                                                  }
                                                  ?>
                                                    <li class="list-inline-item">
                                                        
                                                        <a target="_blank" href="<?=$fbLink?>" <?php echo ($fbLink == "javascript:void(0)" ? "onclick = 'return false;'": ""); ?> class="social-link rounded-3 btn-soft-primary"><i
                                                                class="uil uil-facebook-f"></i></a>
                                                            
                                                    </li>
                                                    
                                                    <li class="list-inline-item">
                                                        <a target="_blank" href="<?=$twLink?>" <?php echo ($twLink == "javascript:void(0)" ? "onclick = 'return false;'": ""); ?> class="social-link rounded-3 btn-soft-info"><i
                                                                class="uil uil-twitter-alt"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="<?=$phLink?>" <?php echo ($phLink == "javascript:void(0)" ? "onclick = 'return false;'": ""); ?> class="social-link rounded-3 btn-soft-success"><i
                                                                class="uil uil-phone-alt"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="<?=$gmLink?>" <?php echo ($gmLink == "javascript:void(0)" ? "onclick = 'return false;'": ""); ?> class="social-link rounded-3 btn-soft-danger"><i
                                                                class="uil uil-envelope-alt"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!--end profile-->
                                            <div class="mt-4 border-bottom pb-4">
                                                <h5 class="fs-17 fw-bold mb-3">Virtual Business Card</h5>
                                                <ul class="profile-document list-unstyled mb-0">
                                                    <li>
                                                        <div class="profile-document-list d-flex align-items-center mt-4 ">
                                                            <div class="icon flex-shrink-0">
                                                                <?php
                                                                if($userID == ""){
                                                                    $vcard_link = "";
                                                                }else{
                                                                    $vcard_link = $rowUser['user_vlink'];
                                                                }
                                                                
                                                                
                                                                echo '<a href="'.$vcard_link.'" target="_blank" '.($vcard_link == "" ? "onclick='return false;'" : "").'><i class="uil uil-postcard"></i></a>
                                                            </div>
                                                            <div class="ms-3">
                                                                <p class="text-muted mb-0"><input type="text" class="form-control text-ellipsis" value="'.$vcard_link.'" id="dest-url" readonly></p>';
                                                                ?>
                                                            </div>
                                                            <div class="ms-3">
                                                                <a class="fs-20 text-muted" id="copy" href="#" onclick="event.preventDefault();copyToClipboard('#dest-url');"><i class="uil uil-copy"></i></a>
                                                            </div>
                                                            
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!--end virtual business card-->
                                            <div class="mt-4 border-bottom pb-4">
                                                <h5 class="fs-17 fw-bold mb-3">Documents</h5>
                                                <ul class="profile-document list-unstyled mb-0 cv_doc" data-id="<?= $userID ?>">
                                                    <li>
                                                            <?php
                                                            if($userID == ""){
                                                                $cv_name = "N/A";
                                                                $cv_size = "---";
                                                                $cv_icon = '<i class="uil uil-file-block-alt"></i>';
                                                                $cv_download_icon = '';
                                                                $cv_inline_text = 'href = "javascript:void(0)"';
                                                                $cv_delete_icon = '';
                                                            }else{
                                                                if($rowUser['user_cv'] == ""){
                                                                    $cv_name = "N/A";
                                                                    $cv_size = "---";
                                                                    $cv_icon = '<i class="uil uil-file-block-alt"></i>';
                                                                    $cv_download_icon = '';
                                                                    $cv_delete_icon = '';
                                                                    $cv_inline_text = 'href = "javascript:void(0)"';
                                                                }else{
                                                                    $cv_name = "Resume.pdf";
                                                                    $cv_size = $rowUser['user_cv_size']."MB";
                                                                    $cv_icon = '<i class="uil uil-file"></i>';
                                                                    $cv_download_icon = '<i class="uil uil-import"></i>';
                                                                    $cv_delete_icon = '<i class="uil uil-trash"></i>';
                                                                    $cv_inline_text = 'href = "CV/'.$rowUser['user_cv'].'" download="Resume"';
                                                                }
                                                            }
                                                                

                                                            echo '
                                                                <div class="profile-document-list d-flex align-items-center mt-4 ">
                                                                <div class="icon flex-shrink-0">
                                                                    '.$cv_icon.'
                                                                </div>';

                                                                echo '
                                                                <div class="ms-3">
                                                                    <h6 class="fs-16 mb-0">'.$cv_name.'</h6>
                                                                    <p class="text-muted mb-0">'.$cv_size.'</p>
                                                                </div>
                                                                <div class="ms-auto">
                                                                    ';
                                                                
                                                                echo '<a '.$cv_inline_text.' class="fs-20 text-muted">'.$cv_download_icon.'</a>';
                                                                echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="cv_delete" style="color:red" class="fs-20 ">'.$cv_delete_icon.'</a>';
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!--end document-->
                                            <div class="mt-4">
                                                <h5 class="fs-17 fw-bold mb-3">Contacts</h5>
                                                <div class="profile-contact">
                                                    <ul class="list-unstyled mb-0">
                                                        <li>
                                                            <div class="d-flex">
                                                                <label>Email</label>
                                                                <div>
                                                                    <?php
                                                                    if($userID == ""){
                                                                        $emailLink = "user@gmail.com";
                                                                    }else{
                                                                        if($rowUser['user_email'] == ""){
                                                                            $emailLink = "";
                                                                        }else{
                                                                            $emailLink = $rowUser['user_email'];
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <p class="text-muted mb-0"><?=$emailLink?></p>
                                                                    
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="d-flex">
                                                                <label>Phone Number</label>
                                                                <div>
                                                                <?php
                                                                    if($userID == ""){
                                                                        $phone = "0123456789";
                                                                    }else{
                                                                        if($rowUser['user_phone'] == ""){
                                                                            $phone = "";
                                                                        }else{
                                                                            $phone = $rowUser['user_phone'];
                                                                        }
                                                                    }
                                                                    ?>
                                                                    
                                                                    <p class="text-muted mb-0"><?=$phone?></p>
                                                                    
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <!-- <li>
                                                            <div class="d-flex">
                                                                <label>Business</label>
                                                                <div>
                                                                    
                                                                    <p class="text-muted mb-0">temp</p>
                                                                </div>
                                                            </div>
                                                        </li> -->
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--end contact-details-->
                                        </div>
                                        <!--end card-body-->
                                    </div>
                                    <!--end profile-sidebar-->
                                </div>
                                <!--end col-->
                                <div class="col-lg-8">
                                    <div class="card profile-content-page mt-4 mt-lg-0">
                                        <ul class="profile-content-nav nav nav-pills border-bottom mb-4" id="pills-tab"
                                                role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="overview-tab" data-bs-toggle="pill"
                                                        data-bs-target="#overview" type="button" role="tab" aria-controls="overview"
                                                        aria-selected="true">
                                                        Overview
                                                    </button>
                                                </li>
                                                <?php
                                                if($userID == ""){
                                                    echo "";
                                                }else{
                                                    echo '<li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="settings-tab" data-bs-toggle="pill"
                                                        data-bs-target="#settings" type="button" role="tab" aria-controls="settings"
                                                        aria-selected="false">
                                                        Settings
                                                    </button>
                                                </li>';
                                                }
                                                ?>
                                            </ul>
                                            <!--end profile-content-nav-->
                                        <div class="card-body p-4">
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                                    aria-labelledby="overview-tab">
                                                    <div>
                                                        <h5 class="fs-18 fw-bold">About</h5>
                                                        <!-- <p class="text-muted mt-4">
                                                            Developer with over 5 years' experience working in both
                                                            the public and private sectors. Diplomatic, personable,
                                                            and adept at managing sensitive situations. Highly
                                                            organized, self-motivated, and proficient with
                                                            computers. Looking to boost students’ satisfactions
                                                            scores for <b>International University</b>. Bachelor's
                                                            degree in communications.
                                                        </p>
                                                        <p class="text-muted">
                                                            It describes the candidate's relevant experience,
                                                            skills, and achievements. The purpose of this career
                                                            summary is to explain your qualifications for the job in
                                                            3-5 sentences and convince the manager to read the whole
                                                            resume document.
                                                        </p> -->
                                                        <?php
                                                        if($userID == ""){
                                                            $profileText = "Developer with over 5 years' experience working in both
                                                            the public and private sectors. Diplomatic, personable,
                                                            and adept at managing sensitive situations. Highly
                                                            organized, self-motivated, and proficient with
                                                            computers. Looking to boost students’ satisfactions
                                                            scores for <b>International University</b>. Bachelor's
                                                            degree in communications.";
                                                        }else{
                                                            if($rowUser['user_profile'] == ""){
                                                                $profileText = "";
                                                            }else{
                                                                $profileText = $rowUser['user_profile'];
                                                            }
                                                        }
                                                        ?>
                                                            <p class="text-muted mt-4"><?=$profileText?></p>
                                                        

                                                    </div>
                                                    <div class="candidate-education-details mt-4">
                                                        <h6 class="fs-18 fw-bold mb-0">Education</h6>
                                                        <?php
                                                        if($userID == ""){
                                                            echo '<div class="candidate-education-content mt-4 d-flex" id="edu-row-height-1">
                                                            <div class="circle flex-shrink-0 bg-soft-primary">
                                                                B
                                                            </div>
                                                            <div class="ms-4">
                                                                <h6 class="fs-16 mb-1">
                                                                    BCA - Bachelor of Computer Applications
                                                                </h6>
                                                                <p class="mb-2 text-muted">
                                                                    International University - (2004 - 2010)
                                                                </p>
                                                                <p class="text-muted">
                                                                    There are many variations of passages of available,
                                                                    but the majority alteration in some form. As a
                                                                    highly skilled and successfull product development
                                                                    and design specialist with more than 4 Years of My
                                                                    experience.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="candidate-education-content mt-3 d-flex" id="edu-row-height-2">
                                                            <div class="circle flex-shrink-0 bg-soft-primary">
                                                                M
                                                            </div>
                                                            <div class="ms-4">
                                                                <h6 class="fs-16 mb-1">
                                                                    MCA - Master of Computer Application
                                                                </h6>
                                                                <p class="mb-2 text-muted">
                                                                    International University - (2010 - 2012)
                                                                </p>
                                                                <p class="text-muted">
                                                                    There are many variations of passages of available,
                                                                    but the majority alteration in some form. As a
                                                                    highly skilled and successfull product development
                                                                    and design specialist with more than 4 Years of My
                                                                    experience.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="candidate-education-content mt-3 d-flex" id="edu-row-height-3">
                                                            <div class="circle flex-shrink-0 bg-soft-primary">
                                                                D
                                                            </div>
                                                            <div class="ms-4">
                                                                <h6 class="fs-16 mb-1">Design Communication Visual</h6>
                                                                <p class="text-muted mb-2">
                                                                    International University - (2012-2015)
                                                                </p>
                                                                <p class="text-muted">
                                                                    There are many variations of passages of available,
                                                                    but the majority alteration in some form. As a
                                                                    highly skilled and successfull product development
                                                                    and design specialist with more than 4 Years of My
                                                                    experience.
                                                                </p>
                                                            </div>
                                                        </div>';
                                                        }else{
                                                            $eduResult = $mysqli->query("SELECT * FROM system_user_edu WHERE edu_user_id = '".$userID."' AND edu_trash = 0");
                                                            if(mysqli_num_rows($eduResult) > 0){
                                                                $edu_counter = "1";
                                                                while($rowEdu = mysqli_fetch_assoc($eduResult)){ 
                                                                    echo '<div class="candidate-education-content mt-4 d-flex" id="edu-row-height-'.$edu_counter.'">
                                                                    <div class="circle flex-shrink-0 bg-soft-primary">
                                                                            '.substr($rowEdu['edu_title'],0,1).'
                                                                    </div>
                                                                    <div class="ms-4">
                                                                        <h6 class="fs-16 mb-1">
                                                                            '.$rowEdu['edu_title'].'
                                                                        </h6>
                                                                        <p class="mb-2 text-muted">
                                                                            '.($rowEdu['edu_institute']  == "" ? "N/A"  : $rowEdu['edu_institute']).' - ('.($rowEdu['edu_start_date'] == "0000-00-00" ? "0" : date('Y', strtotime($rowEdu['edu_start_date']))).' - '.($rowEdu['edu_present'] == "1" ? "Present" : ($rowEdu['edu_end_date'] == "0000-00-00" ? "0" : date('Y', strtotime($rowEdu['edu_end_date'])))  ).')
                                                                        </p>
                                                                        <p class="text-muted">
                                                                            '.$rowEdu['edu_description'].'
                                                                        </p>
                                                                    </div>
                                                                </div>';
                                                                $edu_counter++;
                                                                }
                                                            }else{
                                                                echo '<div class="candidate-education-content mt-3 d-flex" id="edu-row-height-1">
                                                                <div class="circle flex-shrink-0 bg-soft-primary">
                                                                    N/A
                                                                </div>
                                                                <div class="ms-4">
                                                                    <h6 class="fs-16 mb-1">User Education</h6>
                                                                    <p class="text-muted mb-2">
                                                                        Not Available
                                                                    </p>
                                                                    <p class="text-muted">
                                                                        To be filled in...
                                                                    </p>
                                                                </div>
                                                            </div>';
                                                            }
                                                            
                                                        }
                                                        ?>
                                                        
                                                        
                                                    </div>
                                                    <div class="candidate-education-details mt-4">
                                                        <h6 class="fs-18 fw-bold mb-0">Experiences</h6>
                                                        <?php
                                                            if($userID == ""){
                                                                echo '<div class="candidate-education-content mt-4 d-flex" id="exp-row-height-1">
                                                                <div class="circle flex-shrink-0 bg-soft-primary"> W </div>
                                                                <div class="ms-4">
                                                                    <h6 class="fs-16 mb-1">Web Design & Development Team Leader</h6>
                                                                    <p class="mb-2 text-muted">Creative Agency - (2013 - 2016)</p>
                                                                    <p class="text-muted">There are many variations of passages of available, but the majority alteration in some form. As a highly skilled and successfull product development and design specialist with more than 4 Years of My experience.</p>
                                                                </div>
                                                            </div>
                                                            <div class="candidate-education-content mt-4 d-flex" id="exp-row-height-2">
                                                                <div class="circle flex-shrink-0 bg-soft-primary"> P </div>
                                                                <div class="ms-4">
                                                                    <h6 class="fs-16 mb-1">Project Manager</h6>
                                                                    <p class="mb-2 text-muted">Jobcy Technology Pvt.Ltd - (Pressent)</p>
                                                                    <p class="text-muted mb-0">There are many variations of passages of available, but the majority alteration in some form. As a highly skilled and successfull product development and design specialist with more than 4 Years of My experience.</p>
                                                                </div>
                                                            </div>';
                                                            }else{
                                                                
                                                                $expResult = $mysqli->query("SELECT * FROM system_user_exp WHERE exp_user_id = '".$userID."' AND exp_trash = 0");
                                                                if(mysqli_num_rows($expResult) > 0){
                                                                    $exp_counter = "1";
                                                                    while($rowExp = mysqli_fetch_assoc($expResult)){ 
                                                                        echo '
                                                                        <div class="candidate-education-content mt-4 d-flex" id="exp-row-height-'.$exp_counter.'">
                                                                        <div class="circle flex-shrink-0 bg-soft-primary">
                                                                            '.substr($rowExp['exp_title'],0,1).'
                                                                        </div>
                                                                        <div class="ms-4">
                                                                            <h6 class="fs-16 mb-1">'.$rowExp['exp_title'].'</h6>
                                                                            <p class="mb-2 text-muted">'.($rowExp['exp_institute']!="" ? $rowExp['exp_institute'] : "N/A").' - ('.($rowExp['exp_start_date'] == "0000-00-00" ? "0" : date('Y', strtotime($rowExp['exp_start_date']))).' - '.($rowExp['exp_present'] == "1" ? "Present" : ($rowExp['exp_end_date'] == "0000-00-00" ? "0" : date('Y', strtotime($rowExp['exp_end_date'])))  ).')</p>
                                                                            <p class="text-muted mb-0">'.$rowExp['exp_description'].'</p>
                                                                        </div>
                                                                    </div>';
                                                                    $exp_counter++;
                                                                    }
                                                                }else{
                                                                    echo '
                                                                    <div class="candidate-education-content mt-4 d-flex" id="exp-row-height-1">
                                                                    <div class="circle flex-shrink-0 bg-soft-primary"> N/A </div>
                                                                    <div class="ms-4">
                                                                        <h6 class="fs-16 mb-1">User Experience</h6>
                                                                        <p class="mb-2 text-muted">Not Available</p>
                                                                        <p class="text-muted mb-0">To be filled in...</p>
                                                                    </div>
                                                                </div>';
                                                                }
                                                            }
                                                        ?>
                                                        
                                                    </div>
                                                    <div class="mt-4">
                                                        <h5 class="fs-18 fw-bold">Skills</h5>
                                                        
                                                        <?php
                                                        if($userID == ""){
                                                            $skillObtained = '
                                                            <span class="badge fs-13 bg-soft-blue mt-2">Cloud Management</span>
                                                            <span class="badge fs-13 bg-soft-blue mt-2">Responsive Design</span>
                                                            <span class="badge fs-13 bg-soft-blue mt-2">Network Architecture</span>
                                                            <span class="badge fs-13 bg-soft-blue mt-2">PHP</span>
                                                            <span class="badge fs-13 bg-soft-blue mt-2">Bootstrap</span>
                                                            <span class="badge fs-13 bg-soft-blue mt-2">UI & UX Designer</span>';
                                                        }else{
                                                            if($rowUser['user_skill'] == ""){
                                                                $skillObtained = "";
                                                            }else{
                                                                $skills = explode(",",$rowUser['user_skill']);
                                                                $skillObtained = "";
                                                                foreach($skills as $skill){
                                                                    $skillObtained .= '<span class="badge fs-13 bg-soft-blue mt-2">'.$skill.'</span>&nbsp;';
                                                                }
                                                            }    
                                                        }
                                                        echo $skillObtained;
                                                        ?>
                                                    </div>
                                                    <div class="mt-4">
                                                        <h5 class="fs-18 fw-bold">Spoken languages</h5>
                                                        <?php
                                                        if($userID == ""){
                                                            $spokeLanguage = '
                                                            <span class="badge fs-13 bg-soft-success mt-2">English</span>
                                                            <span class="badge fs-13 bg-soft-success mt-2">German</span>
                                                            <span class="badge fs-13 bg-soft-success mt-2">French</span>';
                                                        }else{
                                                            if($rowUser['user_language'] == ""){
                                                                $spokeLanguage = "";
                                                            }else{
                                                                $languages = explode(",",$rowUser['user_language']);
                                                                $spokeLanguage = "";
                                                                foreach($languages as $language){
                                                                    $spokeLanguage .= '<span class="badge fs-13 bg-soft-success mt-2">'.$language.'</span>&nbsp;';
                                                                }
                                                            }    
                                                        }
                                                        echo $spokeLanguage;
                                                        ?>
                                                        
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                                    <form method="post" enctype="multipart/form-data" id="myForm">
                                                        <div>
                                                            <h5 class="fs-17 fw-semibold mb-3 mb-0">My Account</h5>
                                                            <div class="text-center">
                                                                <div class="mb-4 profile-user">
                                                                    <?php
                                                                    echo '<img src="Images/'.($rowUser['user_image'] == "" ? "user.png" : $rowUser['user_image']).'" class="rounded-circle img-thumbnail profile-img" id="profile-img" alt="">';
                                                                    ?>
                                                                    <div class="p-0 rounded-circle profile-photo-edit">
                                                                        <input id="profile-img-file-input" type="file"  name="image" class="profile-img-file-input" onchange="previewImg(this)" >
                                                                        <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                                            <i class="uil uil-edit"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="firstName" class="form-label">First Name</label>
                                                                        <?php
                                                                            echo '<input type="text" class="form-control" id="firstName"
                                                                        name="firstName" value="'.($rowUser['user_fname'] == "" ? "" : $rowUser['user_fname']).'" />';
                                                                        ?>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="lastName" class="form-label">Last Name</label>
                                                                        <?php
                                                                        echo '<input type="text" class="form-control" id="lastName"
                                                                        name="lastName" value="'.($rowUser['user_lname'] == "" ? "" : $rowUser['user_lname']).'" />';
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                
                                                                
                                                            </div>
                                                            <!--end row-->
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="gender" class="form-label">Gender</label>
                                                                        <?php
                                                                        echo '<select class="form-select form-control" aria-label="Default select example" name="gender">
                                                                        <option '.($rowUser['user_gender'] != "" ? "" : "selected").'>Choose your gender</option>
                                                                        <option value="M" '.($rowUser['user_gender'] == "M" ? "selected" : "").'>Male</option>
                                                                        <option value="F" '.($rowUser['user_gender'] == "F" ? "selected" : "").'>Female</option>
                                                                        <option value="E" '.($rowUser['user_gender'] == "E" ? "selected" : "").'>Prefer not to say</option>
                                                                      </select>';
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="dob" class="form-label">Date Of Birth</label>
                                                                        <?php
                                                                        echo '<input type="date" class="form-control" id="dob"
                                                                        name="dob" value="'.($rowUser['user_dob'] == "" ? "" : $rowUser['user_dob']).'" />';
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                            </div>
                                                            <!--end row-->
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label for="languages" class="form-label">Languages</label>
                                                                        <?php
                                                                        echo '<input type="text" class="form-control" id="languages"
                                                                        name="language" value="'.($rowUser['user_language'] == "" ? "" : $rowUser['user_language']).'" />';
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                            </div>
                                                            <!--end row-->
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3"> 
                                                                        <label for="address" class="form-label">Address</label>
                                                                        <?php
                                                                        echo '<textarea class="form-control" id="" rows="3" name="address">'.($rowUser['user_address']).'</textarea>'
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                            </div>
                                                            <!--end row-->
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <label for="country" class="form-label">Country</label>
                                                                    <?php
                                                                    echo '<input type="text" class="form-control" name="country" value="'.($rowUser['user_country'] != "" ? $rowUser['user_country'] : "N/A").'" />'
                                                                    ?>
                                                                </div>
                                                                <!--end col-->
                                                            </div>
                                                            <!--end row-->
                                                        </div>
                                                        <!--end account-->
                                                        <div class="mt-4">
                                                            <h5 class="fs-17 fw-semibold mb-3">Profile</h5>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label for="exampleFormControlTextarea1"
                                                                            class="form-label">Introduce Yourself</label>
                                                                            <?php
                                                                        echo '<textarea class="form-control" id="exampleFormControlTextarea1"
                                                                            rows="5" name="profile">'.($rowUser['user_profile'] == "" ? "" : $rowUser['user_profile']).'</textarea>';
                                                                            ?>
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="skills" class="form-label">Skills</label>
                                                                        <?php
                                                                        echo '<input type="text" class="form-control" id="skills"
                                                                        name="skill" value="'.($rowUser['user_skill'] == "" ? "" : $rowUser['user_skill']).'" />';
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="business" class="form-label">Business Nature</label>
                                                                        <select class="form-select form-control" data-trigger
                                                                            name="business"
                                                                            id="business"
                                                                            aria-label="Default select example">
                                                                            <?php
                                                                            echo '<option value="0"><-- Select --></option>';
                                                                            //retrieve business nature info
                                                                            $businessResult = $mysqli->query("SELECT * FROM system_user_business WHERE business_trash = 0");
                                                                            if(mysqli_num_rows($businessResult) > 0){
                                                                                while($rowBusiness = mysqli_fetch_assoc($businessResult)){
                                                                                    echo '<option value="'.$rowBusiness['business_id'].'" '.($rowBusiness['business_id'] == $rowUser['user_business'] ? "selected" : "").'>'.$rowBusiness['business_name'].'</option>';
                                                                                }
                                                                                
                                                                            }
                                                                            
                                                                            // echo'
                                                                            // <option value="4">Accounting</option>
                                                                            // <option value="1">IT & Software</option>
                                                                            // <option value="3">Marketing</option>
                                                                            // <option value="5">Banking</option>';
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                <!-- <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label for="ability" class="form-label">Abilities</label>
                                                                        <input class="form-range" name="ability[]" id="ability" type="range" min="0" max="100" value="50"/>
                                                                    </div>
                                                                </div> -->
                                                                <!--end col-->
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label for="attachmentscv" class="form-label">Attachments
                                                                            CV</label>
                                                                            <?php
                                                                        echo '<input class="form-control" name="attachmentscv" type="file" id="attachmentscv"/>';
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                            </div>
                                                            <!--end row-->
                                                        </div>
                                                        <!--end profile-->
                                                        <div class="mt-4" id="append-edu">
                                                            <div class="row mb-3">
                                                                <div class="col-lg-8"><h5 class="fs-17 fw-semibold mb-3">Education</h5></div>
                                                                <div class="col-lg-4 text-end"><button id="add-edu" type="button" class="btn btn-primary btn-sm"><i class="uil uil-plus-circle"></i></button></div>  
                                                            </div>
                                                            <?php
                                                                $eduResult = $mysqli->query("SELECT * FROM system_user_edu WHERE edu_user_id = '".$userID."' AND edu_trash = 0");
                                                                if(mysqli_num_rows($eduResult) > 0){
                                                                    $edu_length = "1";
                                                                    while($rowEdu = mysqli_fetch_assoc($eduResult)){
                                                                    echo '<div class="row edu-row"  data-id="'.$rowEdu['edu_id'].'">
                                                                    <input type="hidden" name="edu_row[]" value="'.($rowEdu['edu_id'] == "" ? "" : $rowEdu['edu_id']).'"><input type="hidden" name="edu-trash[]" value="0">
                                                                    <div class="btn-group col-lg-12 mb-2" id="edu_'.$edu_length.'">
                                                                        <button class="form-control btn dropdown-toggle shadow p-3 rounded text-ellipsis" style="border-top-right-radius:0;border-bottom-right-radius:0;border-bottom: 2px solid rgba(var(--bs-primary-rgb),var(--bs-bg-opacity))!important;--bs-bg-opacity: 1;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <span class="badge bg-primary fs-5" id="edu_title_first_letter_'.$edu_length.'"> '.($rowEdu['edu_title'] == "" ? "" : substr($rowEdu['edu_title'], 0, 1)).' </span>&nbsp;&nbsp;&nbsp; <span id="edu_title_full_text_'.$edu_length.'">'.($rowEdu['edu_title'] == "" ? "" : $rowEdu['edu_title'] ).'</span>
                                                                        <i class="fa-solid fa-caret-down"></i>
                                                                        </button>
                                                                        <button class="btn btn-danger edu-trash rounded" type="button" style="flex:none;">
                                                                        <i class="uil uil-trash"></i>
                                                                        </button>
                                                                        <div class="form-control dropdown-menu" style="width:97.5%">
                                                                        <div class="row">
                                                                        <div class="row" data-length="'.$edu_length.'">
                                                                            <div class="col-lg-12">
                                                                            <div class="mb-3">
                                                                                <label for="edu_title_'.$edu_length.'" class="form-label">Title<span style="color:red;">*</span></label>
                                                                                <input type="text" class="form-control edu_title" name="edu_title[]" id="edu_title_'.$edu_length.'" value="'.($rowEdu['edu_title'] == "" ? "" : $rowEdu['edu_title']).'" />
                                                                            </div>
                                                                            </div>
                                                                            <!--end col-->
                                                                            <div class="col-lg-5" id="edu_start_date_col_'.$edu_length.'">
                                                                            <div class="mb-3">
                                                                                <label for="edu_start_date_'.$edu_length.'" class="form-label">Start Date</label>
                                                                                <input type="date" class="form-control" name="edu_start_date[]" id="edu_start_date_'.$edu_length.'" value="'.($rowEdu['edu_start_date'] == "" ? "" : $rowEdu['edu_start_date']).'" />
                                                                            </div>
                                                                            </div>
                                                                            <!--end col-->
                                                                            <div class="col-lg-5" id="edu_end_date_col_'.$edu_length.'" '.($rowEdu['edu_present'] == "1" ? "style='display:none;'" : "").'>
                                                                            <div class="mb-3">
                                                                                <label for="edu_end_date_'.$edu_length.'" class="form-label">End Date</label>
                                                                                <input type="hidden" name="edu_end_date[]" id="edu_end_date_'.$edu_length.'_hidden" value="" '.($rowEdu['edu_present'] == "1" ? "" : "disabled").'>
                                                                                <input type="date" class="form-control" name="'.($rowEdu['edu_present'] == "1" ? "" : "edu_end_date[]").'" id="edu_end_date_'.$edu_length.'" value="'.($rowEdu['edu_end_date'] == "" ? "" : $rowEdu['edu_end_date']).'" />
                                                                            </div>
                                                                            </div>
                                                                            <!--end col-->
                                                                            <div class="col-lg-2">
                                                                            <div class="mb-2">Present</div>
                                                                            <div class="form-check form-switch">
                                                                                <input type="hidden" name="edu_present[]" id="edu_present_'.$edu_length.'_hidden" value="0" '.($rowEdu['edu_present'] == "1" ? "" : "disabled").'>
                                                                                <input class="form-check-input mySwitch edu_present" type="checkbox" role="switch" id="edu_present_'.$edu_length.'" name="edu_present[]" value="1" '.($rowEdu['edu_present'] == "1" ? "checked" : "").'>
                                                                            </div>
                                                                            </div>
                                                                            <!--end col-->
                                                                            <div class="col-lg-12">
                                                                            <div class="mb-3">
                                                                                <label for="edu_institute_'.$edu_length.'" class="form-label">Institute</label>
                                                                                <input type="text" class="form-control" name="edu_institute[]" id="edu_institute_'.$edu_length.'" value="'.($rowEdu['edu_institute'] == "" ? "" : $rowEdu['edu_institute']).'" />
                                                                            </div>
                                                                            </div>
                                                                            <!--end col-->
                                                                            <div class="col-lg-12">
                                                                            <div class="mb-3">
                                                                                <label for="edu_description_'.$edu_length.'" class="form-label">Description</label>
                                                                                <textarea class="form-control" id="edu_description_'.$edu_length.'" rows="4" name="edu_description[]">'.($rowEdu['edu_description'] == "" ? "" : $rowEdu['edu_description']).'</textarea>
                                                                            </div>
                                                                            </div>
                                                                            <!--end col-->
                                                                        </div>
                                                                        <!--end of row-->
                                                                        </div>
                                                                        </div>
                                                                        <!--end dropdown-menu-->
                                                                    </div>
                                                                    <!--end btn-group-->
                                                                    <!--end education bar row-->
                                                                    </div>';
                                                                    $edu_length++;
                                                                    }
                                                                }
                                                            ?>
                                                        </div>
                                                        <!--end education-->

                                                        <div class="mt-4" id="append-exp">
                                                            <div class="row mb-3">
                                                                <div class="col-lg-8"><h5 class="fs-17 fw-semibold mb-3">Experiences</h5></div>
                                                                <div class="col-lg-4 text-end"><button id="add-exp" type="button" class="btn btn-primary btn-sm"><i class="uil uil-plus-circle"></i></button></div>  
                                                            </div>
                                                            <?php
                                                                $expResult = $mysqli->query("SELECT * FROM system_user_exp WHERE exp_user_id = '".$userID."' AND exp_trash = 0");
                                                                if(mysqli_num_rows($expResult) > 0){
                                                                    $exp_length = "1";
                                                                    while($rowExp = mysqli_fetch_assoc($expResult)){
                                                                    echo '<div class="row exp-row"  data-id="'.$rowExp['exp_id'].'">
                                                                    <input type="hidden" name="exp_row[]" value="'.($rowExp['exp_id'] == "" ? "" : $rowExp['exp_id']).'"><input type="hidden" name="exp-trash[]" value="0">
                                                                    <div class="btn-group col-lg-12 mb-2" id="exp_'.$exp_length.'">
                                                                        <button class="form-control btn dropdown-toggle shadow p-3 rounded text-ellipsis" style="border-top-right-radius:0;border-bottom-right-radius:0;border-bottom: 2px solid rgba(var(--bs-primary-rgb),var(--bs-bg-opacity))!important;--bs-bg-opacity: 1;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <span class="badge bg-primary fs-5" id="exp_title_first_letter_'.$exp_length.'"> '.($rowExp['exp_title'] == "" ? "" : substr($rowExp['exp_title'], 0, 1)).' </span>&nbsp;&nbsp;&nbsp; <span id="exp_title_full_text_'.$exp_length.'">'.($rowExp['exp_title'] == "" ? "" : $rowExp['exp_title'] ).'</span>
                                                                        <i class="fa-solid fa-caret-down"></i>
                                                                        </button>
                                                                        <button class="btn btn-danger exp-trash rounded" type="button" style="flex:none;">
                                                                        <i class="uil uil-trash"></i>
                                                                        </button>
                                                                        <div class="form-control dropdown-menu" style="width:97.5%">
                                                                        <div class="row" data-length="'.$exp_length.'">
                                                                            <div class="col-lg-12">
                                                                            <div class="mb-3">
                                                                                <label for="exp_title_'.$exp_length.'" class="form-label">Title<span style="color:red;">*</span></label>
                                                                                <input type="text" class="form-control exp_title" name="exp_title[]" id="exp_title_'.$exp_length.'" value="'.($rowExp['exp_title'] == "" ? "" : $rowExp['exp_title']).'" />
                                                                            </div>
                                                                            </div>
                                                                            <!--end col-->
                                                                            <div class="col-lg-5" id="exp_start_date_col_'.$exp_length.'">
                                                                            <div class="mb-3">
                                                                                <label for="exp_start_date_'.$exp_length.'" class="form-label">Start Date</label>
                                                                                <input type="date" class="form-control" name="exp_start_date[]" id="exp_start_date_'.$exp_length.'" value="'.($rowExp['exp_start_date'] == "" ? "" : $rowExp['exp_start_date']).'" />
                                                                            </div>
                                                                            </div>
                                                                            <!--end col-->
                                                                            <div class="col-lg-5" id="exp_end_date_col_'.$exp_length.'" '.($rowExp['exp_present'] == "1" ? "style='display:none;'" : "").'>
                                                                            <div class="mb-3">
                                                                                <label for="exp_end_date_'.$exp_length.'" class="form-label">End Date</label>
                                                                                <input type="hidden" name="exp_end_date[]" id="exp_end_date_'.$exp_length.'_hidden" value="'.($rowExp['exp_end_date'] == "0000-00-00" ? "" : $rowExp['exp_end_date']).'" '.($rowExp['exp_present'] == "1" ? "" : "disabled").'>
                                                                                <input type="date" class="form-control" name="'.($rowExp['exp_present'] == "1" ? "" : "exp_end_date[]").'" id="exp_end_date_'.$exp_length.'" value="'.($rowExp['exp_end_date'] == "" ? "" : $rowExp['exp_end_date']).'" />
                                                                            </div>
                                                                            </div>
                                                                            <!--end col-->
                                                                            <div class="col-lg-2">
                                                                            <div class="mb-2">Present</div>
                                                                            <div class="form-check form-switch">
                                                                                <input type="hidden" name="exp_present[]" id="exp_present_'.$exp_length.'_hidden" value="0" '.($rowExp['exp_present'] == "1" ? "" : "disabled").'>
                                                                                <input class="form-check-input mySwitch exp_present" type="checkbox" role="switch" id="exp_present_'.$exp_length.'" name="exp_present[]" value="1" '.($rowExp['exp_present'] == "1" ? "checked" : "").'>
                                                                            </div>
                                                                            </div>
                                                                            <!--end col-->
                                                                            <div class="col-lg-12">
                                                                            <div class="mb-3">
                                                                                <label for="exp_institute_'.$exp_length.'" class="form-label">Institute</label>
                                                                                <input type="text" class="form-control" name="exp_institute[]" id="exp_institute_'.$exp_length.'" value="'.($rowExp['exp_institute'] == "" ? "" : $rowExp['exp_institute']).'" />
                                                                            </div>
                                                                            </div>
                                                                            <!--end col-->
                                                                            <div class="col-lg-12">
                                                                            <div class="mb-3">
                                                                                <label for="exp_description_'.$exp_length.'" class="form-label">Description</label>
                                                                                <textarea class="form-control" id="exp_description_'.$exp_length.'" rows="4" name="exp_description[]">'.($rowExp['exp_description'] == "" ? "" : $rowExp['exp_description']).'</textarea>
                                                                            </div>
                                                                            </div>
                                                                            <!--end col-->
                                                                        </div>
                                                                        <!--end of row-->
                                                                        </div>
                                                                        <!--end dropdown-menu-->
                                                                    </div>
                                                                    <!--end btn-group-->
                                                                    <!--end experience bar row-->
                                                                    </div>';
                                                                    $exp_length++;
                                                                    }
                                                                }
                                                            ?>
                                                        </div>
                                                        <!--end experiences-->

                                                        <div class="mt-4" id="append-ab">

                                                            <div class="row mb-3">
                                                                <div class="col-lg-8">
                                                                    <h5 class="fs-17 fw-semibold mb-3">Abilities</h5>
                                                                </div>
                                                                <div class="col-lg-4 text-end">
                                                                    <button id="add-ab" type="button" class="btn btn-primary btn-sm"><i class="uil uil-plus-circle"></i></button>
                                                                </div>
                                                            </div>
                                                            <?php 
                                                                $abResult = $mysqli->query("SELECT * FROM system_user_abilities WHERE ab_user_id = '".$userID."' AND ab_trash = 0");
                                                                if(mysqli_num_rows($abResult) > 0){
                                                                    while($rowAb = mysqli_fetch_assoc($abResult)){
                                                                        echo '<div class="row mb-3 ab-row" >
                                                                        <input type="hidden" name="ab-row[]" value="'.$rowAb['ab_id'].'">
                                                                        <input type="hidden" name="ab-trash[]" value="0">
                                                                        <div class="col-lg-12">
                                                                            <div class="input-group ">
                                                                            <input type="text" name="abilities[]" placeholder="Abilities Possess along with the respective index." class="form-control w-50" value="'.$rowAb['ab_title'].'" required>
                                                                            <input type="number" name="abilities-index[]" onKeyPress="if(this.value.length==3) return false;" step="10" min="0" max="100" value="'.$rowAb['ab_index'].'"  class="percentage form-control">
                                                                            <button class="btn btn-danger ab-trash" type="button"><i class="fa-solid fa-ban"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>';
                                                                    }
                                                                }
                                                                    
                                                            ?>
                                                            
                                                        </div>
                                                                                
                                                                                <div class="mt-4">
                                                                                    <h5 class="fs-17 fw-semibold mb-3">Social Media</h5>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-6">
                                                                                            <div class="mb-3">
                                                                                                <label for="facebook" class="form-label">Facebook</label>
                                                                                                <?php
                                                                                                echo '<input type="text" class="form-control" name="facebook" id="facebook" value="'.($rowUser['user_facebook'] == "" ? "" : $rowUser['user_facebook']).'" />';
                                                                                                ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--end col-->
                                                                                        <div class="col-lg-6">
                                                                                            <div class="mb-3">
                                                                                                <label for="twitter" class="form-label">Twitter</label>
                                                                                                <?php
                                                                                                echo '<input type="text" name="twitter" class="form-control" id="twitter" value="'.($rowUser['user_twitter'] == "" ? "" : $rowUser['user_twitter']).'" />';
                                                                                                ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--end col-->
                                                                                        <div class="col-lg-6">
                                                                                            <div class="mb-3">
                                                                                                <label for="linkedin" class="form-label">Phone</label>
                                                                                                <?php
                                                                                                echo '<input type="text" name="phone" class="form-control" id="phone" value="'.($rowUser['user_phone'] == "" ? "" : $rowUser['user_phone']).'"/>';
                                                                                                ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--end col-->
                                                                                        <div class="col-lg-6">
                                                                                            <div class="mb-3">
                                                                                                <label for="email" class="form-label">Email</label>
                                                                                                <?php
                                                                                                echo '<input type="text" class="form-control" id="email" name="email" value="'.($rowUser['user_email'] == "" ? "" : $rowUser['user_email']).'" />';
                                                                                                    ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--end col-->
                                                                                    </div>
                                                                                    <!--end row-->
                                                                                </div>
                                                                                <!--end socia-media-->
                                                                                <div class="mt-4">
                                                                                    <h5 class="fs-17 fw-semibold mb-3 mb-3">
                                                                                        Change Password
                                                                                    </h5>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="mb-3">
                                                                                                <label for="current-password-input" class="form-label">Current
                                                                                                    password</label>
                                                                                                <input type="password" class="form-control"
                                                                                                    placeholder="Enter Current password" name="currentPass"
                                                                                                    id="current-password-input" />
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--end col-->
                                                                                        <div class="col-lg-6">
                                                                                            <div class="mb-3">
                                                                                                <label for="new-password-input" class="form-label">New
                                                                                                    password</label>
                                                                                                <input type="password" class="form-control"
                                                                                                    placeholder="Enter new password" name="newPass"
                                                                                                    id="new-password-input" />
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--end col-->
                                                                                        <div class="col-lg-6">
                                                                                            <div class="mb-3">
                                                                                                <label for="confirm-password-input" class="form-label">Confirm Password</label>
                                                                                                <input type="password" class="form-control"
                                                                                                    placeholder="Confirm Password" name="confirmPass"
                                                                                                    id="confirm-password-input" />
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--end col-->
                                                                                        <!-- <div class="col-lg-12">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" type="checkbox" value=""
                                                                                                    id="verification" />
                                                                                                <label class="form-check-label" for="verification">
                                                                                                    Enable Two-Step Verification via email
                                                                                                </label>
                                                                                            </div>
                                                                                        </div> -->
                                                                                        <!--end col-->
                                                                                    </div>
                                                                                    <!--end row-->
                                                                                </div>
                                                                                <!--end Change-password-->
                                                                                <div class="mt-4 text-end">
                                                                                    <button type="submit" id="submit" name="submit" class="btn btn-primary" disabled>Update</button>
                                                                                </div>
                                                                            </form>
                                                                            <!--end form-->
                                                                        </div>
                                                                        <!--end tab-pane-->
                                                                    </div>
                                            <!--end tab-content-->
                                        </div>
                                        <!--end card-body-->
                                    </div>
                                    <!--end profile-content-page-->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end container-->
                    </section>
                    <!-- END PROFILE -->

                </div>
                <!-- End Page-content -->

                <?php
                include "Requires/page_footer.php";
                ?>

                <!-- Style switcher -->
                <div id="style-switcher" onclick="toggleSwitcher()" style="left: -165px;">
                    <div>
                        <h6>Select your color</h6>
                        <ul class="pattern list-unstyled mb-0">
                            <li>
                                <a class="color-list color2" href="javascript: void(0);" onclick="setColor('blue')"></a>
                            </li>
                            <li>
                                <a class="color-list color1" href="javascript: void(0);" onclick="setColorGreen()"></a>
                            </li>
                            <li>
                                <a class="color-list color3" href="javascript: void(0);" onclick="setColor('green')"></a>
                            </li>
                        </ul>
                        <div class="mt-3">
                            <h6>Light/dark Layout</h6>
                            <div class="text-center mt-3">
                                <!-- light-dark mode -->
                                <a href="javascript: void(0);" id="mode" class="mode-btn text-white rounded-3">
                                    <i class="uil uil-brightness mode-dark mx-auto"></i>
                                    <i class="uil uil-moon mode-light"></i>
                                </a>
                                <!-- END light-dark Mode -->
                            </div>
                        </div>
                    </div>
                    <div class="bottom d-none d-md-block" >
                        <a href="javascript: void(0);" class="settings rounded-end"><i class="mdi mdi-cog mdi-spin"></i></a>
                    </div>
                </div>
                <!-- end switcher-->

                <!--start back-to-top-->
                <button onclick="topFunction()" id="back-to-top">
                    <i class="mdi mdi-arrow-up"></i>
                </button>
                <!--end back-to-top-->
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- JAVASCRIPT -->
        <script src="Scripts/bootstrap.bundle.min.js"></script>
        <script src="Scripts/bundle.js"></script>


        <!-- Choice Js -->
        <script src="Scripts/choices.min.js"></script>

        <!-- Switcher Js -->
        <script src="Scripts/switcher.init.js"></script>

        <!-- App Js -->
        <script src="Scripts/app.js"></script>
                                                                
        <script type="text/javascript">

            var temp_edu_counter = "1";
            var temp_exp_counter = "1";
            var edu_num_row = document.querySelectorAll(".edu-row").length;
            var exp_num_row = document.querySelectorAll(".exp-row").length;

            while(temp_edu_counter < edu_num_row+1){
                const row = document.getElementById('edu-row-height-'+temp_edu_counter);
                let line  = document.querySelector("#edu-row-height-"+temp_edu_counter+".candidate-education-content");
                //let css = window.getComputedStyle(box,'::before');
                var adjustedLength = row.offsetHeight - 25;
                line.style.setProperty('--custom',adjustedLength+"px")
                temp_edu_counter++;
            }

            while(temp_exp_counter < exp_num_row+1){
                const row = document.getElementById('exp-row-height-'+temp_exp_counter);
                let line  = document.querySelector("#exp-row-height-"+temp_exp_counter+".candidate-education-content");
                //let css = window.getComputedStyle(box,'::before');
                var adjustedLength = row.offsetHeight - 25;
                line.style.setProperty('--custom',adjustedLength+"px")
                temp_exp_counter++;
            }

        </script>
    </body>
</html>