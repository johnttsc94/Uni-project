<?php
// Start the session
session_start();
include "Requires/function.php";
include "Connect/connect.php";
include 'Requires/header.php' ;
?>

<?php
if(isset($_POST['submit'])){
    $userResult = $mysqli->query("SELECT * FROM system_admin WHERE admin_username = '".$_POST['admin_name']."'AND admin_trash = 0");
    if(mysqli_num_rows($userResult) > 0){
        $rowUser = $userResult->fetch_assoc();

        $_SESSION['admin_id'] = $rowUser['admin_id'];
        $_SESSION['admin_fullname'] = $rowUser['admin_fullname'];
        $_SESSION['admin_email'] = $rowUser['admin_email'];

        if(md5($_POST['admin_password']) == $rowUser['admin_password']){?>
        
        <!-- <style type="text/css">
           .fancybox-skin {
                background-color:rgb(59,130,246) !important; /* or whatever */
                }
        </style> -->

        <script type='text/javascript'>
            jQuery(document).ready(function ($) {
                $.fancybox({
                    href: "login-otp.php",
                    type: "iframe", // <-- whatever content image, inline, swf, etc
                    width  : "1000",           // set the width
                    height : "1500",          // set the height
                    afterLoad : function() {
                        // $("body").css({"overflow" : "hidden", "padding-right" : "17px"});
                        window.parent.$(".login-wrapper").css("filter","blur(5px)");
                    },
                    afterClose : function() {
                        // $("body").css({"overflow" : "hidden", "padding-right" : "17px"});
                        window.parent.$(".login-wrapper").css("filter","blur(0px)");
                    },

                });
            }); 

        </script>

            <?php
        }else{
            echo "<script>toastr.error('Invalid Credential')</script>";
        }
    }else{
        echo "<script>toastr.error('Account does not exist')</script>";
    }   
}
?>

<script>
     $(document).on("click","#togglePassword",function(){
        $(this).toggleClass("fa-eye fa-eye-slash")
        var password = $(this).parents().find('input[name="admin_password"]')
        var type = password.attr("type")
        if(type == "password"){
            password.prop("type","text")
        }else{
            password.prop("type","password")
        }
    })
    </script>

        <!-- <div class="container">

            <div class="row">

                <div class="col-lg-4 col-lg-offset-4">

                    <h3 class="text-center"><img src="Images/toucan.png" style="width:200px;"></h3>

                    <h3 class="text-center" style="font-size:20px; margin-bottom:40px; color:#000;"><b>Company ABC</b></h3>

                    <hr class="clean">
                    
                    <form method="post" role="form" novalidate>
                            <div class="form-group input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" name="admin_name" class="form-control"  placeholder="Username" required="required" />

                            </div>

                            <div class="form-group input-group" style="position:relative">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                <input type="password" name="admin_password" class="form-control"  placeholder="Password" required="required" />

                                <i class="fa fa-eye password-eye" aria-hidden="true" id="togglePassword"></i>

                            </div>
                            
                            <div class="form-group input-group hidden" id="userOtp">

                                <span class="input-group-addon"><i class="fa fa-ticket" aria-hidden="true"></i></span>

                                <input type="text" name="admin_otp" class="form-control"  placeholder="OTP" required="required" />

                            </div> -->

                            <!-- <div class="form-group">

                                <label class="cr-styled">

                                    <input type="checkbox" name="remeber" value="remeber" ng-model="todo.done">

                                    <i class="fa"></i> 

                                </label>

                                Remember me

                            </div> -->
                            <!-- <button type="submit" class="btn btn-purple btn-block" name="submit"></button> -->
                            <!-- <a class="fancybox_iframe fancybox btn btn-purple btn-block"  data-fancybox-type="iframe" href="login-otp.php">Sign in</a> -->


                            <!-- <button type="submit" class="btn btn-block" style="background-color:rgb(59,130,246);border-color:rgb(59,130,246);color:#fff;" name="submit">Sign in</button>

                    </form>

                    <hr>

                    <p class="text-center text-gray">Developed by <a href="#" target="_blank">Team Fantastic</a></p>

                </div>

            </div>

        </div> -->

        <!--New Design-->
        
        <div class="login-wrapper">
            <div class="login-content">
                <div class="login-userset">
                <div class="login-logo logo-normal">
                    <!-- <img src="../Images/title-dark(small).png" width="150px" alt="img"> -->
                    <img src="Images/title.png" width="150px" alt="img">
                </div>
                <a href="index.html" class="login-logo logo-white">
                    <img src="assets/img/logo-white.png" alt="">
                </a>
                <div class="login-userheading">
                    <h3>Sign In</h3>
                    <h4>Please login to your account</h4>
                </div>
                
                    <form method="post" role="form" novalidate>

                <div class="form-login">
                    <label>Username</label>
                    <div class="form-addons">
                    <input type="text" name="admin_name" placeholder="Enter your username">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="form-login">
                    <label>Password</label>
                    <div class="pass-group">
                    <input type="password" name="admin_password" class="pass-input" placeholder="Enter your password">
                    <span class="fas toggle-password"><i class="fa fa-eye password-eye" aria-hidden="true" id="togglePassword"></i></span>
                    </div>
                </div>
                <div class="form-login">
                    <button type="submit" class="btn btn-login"  name="submit">Sign in</button>
                </div>
                    </form>
                </div>
            </div>

            <div class="login-img">
                <img src="Images/image.png" alt="img">
            </div>
        </div>

    </body>

</html>
<?php


//echo generateNumericOTP('6');
?>

