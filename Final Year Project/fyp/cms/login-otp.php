<?php
session_start();
include "Requires/function.php";
include "Connect/connect.php";
include 'Requires/header.php' ;

$timeNow = date('Y-m-d H:i:s');
$otpResult = $mysqli->query("SELECT * FROM system_admin_otp WHERE otp_admin_id = '".$_SESSION['admin_id']."' AND otp_trash = 0 AND '".$timeNow."' < otp_expired_time ORDER BY otp_id DESC LIMIT 1");

if(isset($_POST['submit']) && mysqli_num_rows($otpResult) > 0){
    $rowOTP = $otpResult->fetch_assoc();
    if($_POST['admin_otp'] == $rowOTP['otp_number']){?>
        <script type='text/javascript'>
            toastr.success('Successful')
            setTimeout(function () {
                //javascript:parent.jQuery.fancybox.close();
                window.parent.location.href = 'index.php';
                }, 300); //will call the function after 0.3 sec


            
        </script>
<?php

 setcookie("admin_session", "true", time() + 86400); // 60seconds * 60minutes  * 24hours
 setcookie("admin_id", $_SESSION['admin_id'], time() + 86400); // 60seconds * 60minutes  * 24hours
    }else{?>
    
     <script type='text/javascript'>
        toastr.error('OTP Mismatch')
     </script>
     
        <?php
    }
}else if(isset($_POST['submit']) && mysqli_num_rows($otpResult) <= 0){
    echo "<script type='text/javascript'>
            toastr.error('OTP Expired')
        </script>";
}

// if($_POST['admin_otp'] == $otp){
    
// }
?>
        <script type='text/javascript'>
                $(document).ready(function(){

                    $('#sendOtp').click(function() {
                        event.preventDefault();
                        $('#submit-verify').attr("disabled",false);
                        $.ajax({
                            url:"login-otp-detail.php",
                            type:"POST",
                            data:{"action":"send"},
                            
                            success:function(result){
                                toastr.success("OTP has been send to your email");
                                //alert("OTP has been send to your email")
                            },
                            error: function(jqXHR, textStatus, errorThrown){
                                toastr.error("OTP failed to send");
                                console.log(errorThrown);
                            }
                        });
                        $('#sendOtp').addClass("hidden");
                        $('#resendOtp').removeClass("hidden");
                    });

                    $('#resendOtp').click(function() {
                        event.preventDefault();

                        $.ajax({
                            url:"login-otp-detail.php",
                            type:"POST",
                            data:{"action":"resend"},
                            dataType: "json",
                            success:function(result){
                                
                                if(result['status'] == "true"){
                                    toastr.success("OTP has been send to your email");
                                }else{
                                    toastr.error("OTP has been expired");
                                    $('#sendOtp').removeClass("hidden");
                                    $('#resendOtp').addClass("hidden");
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown){
                                toastr.error("OTP failed to send");
                                console.log(errorThrown);
                                $('#sendOtp').removeClass("hidden");
                                $('#resendOtp').addClass("hidden");
                            }
                        });
                       
                    });
                });
            </script>

        <div class="container">

            <div class="row">

                <div class="col-lg-4 col-lg-offset-4">

                    <h3 class="text-center"><img src="Images/toucan.png" style="width:200px;"></h3>

                    <h3 class="text-center" style="font-size:20px; margin-bottom:40px; color:#000;"><b>Company ABC</b></h3>

                    <hr class="clean">
                    
                    <form method="post" role="form" novalidate>
                            
                            <div class="form-group input-group " id="userOtp">

                                <span class="input-group-addon"><i class="fa fa-ticket" aria-hidden="true"></i></span>

                                <input type="text" name="admin_otp" class="form-control"  placeholder="OTP" required="required" />

                            </div>

                            <!-- <div class="form-group">

                                <label class="cr-styled">

                                    <input type="checkbox" name="remeber" value="remeber" ng-model="todo.done">

                                    <i class="fa"></i> 

                                </label>

                                Remember me

                            </div> -->
                            <?php
                            echo '
                            <button type="submit" class="btn btn-block" style="background-color:rgb(59,130,246);border-color:rgb(59,130,246);color:#fff;" id="submit-verify" '.(mysqli_num_rows($otpResult) > 0 ? '':'disabled="true"').' name="submit">Verify</button>
                            ';
                            ?>

                    </form>

                    <hr>
                    <?php
                    echo 
                    '
                    <p class="text-right text-gray"><a class="'.(mysqli_num_rows($otpResult) > 0 ? 'hidden':'').'"  href="#" id="sendOtp" >Send OTP via email</a></p>
                    <p class="text-right text-gray"><a class="'.(mysqli_num_rows($otpResult) > 0 ? '':'hidden').'" href="#" id="resendOtp" >Re-send OTP via email</a></p>
                    ';
                    ?>
                </div>

            </div>

        </div>
    </body>

</html>


