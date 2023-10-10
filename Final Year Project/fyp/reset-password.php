
<!doctype html>
<html lang="en">

   <?php
   include "Connect/connect.php";
   include "Requires/function.php";
   include "Plug-ins/PhpMailer/class.phpmailer.php";
   include "Plug-ins/PhpMailer/class.smtp.php";
   include "Requires/header.php"
   ?>

    <body>
        <?php
        //print_r($_POST);
        if(!empty($_POST) && isset($_POST['submit'])){
            $userResult = $mysqli->query("SELECT * FROM system_user WHERE user_username = '".$_POST['username']."' AND user_trash = 0");
            if(mysqli_num_rows($userResult) > 0){
                $rowUser = mysqli_fetch_assoc($userResult);
                $randPass = randomPassword();

                //Update temporary password in database
                $mysqli->query("UPDATE system_user SET user_password = '".md5($randPass)."'WHERE user_id = '".$rowUser['user_id']."' AND user_trash = 0");

                //Send email
                $email_title   = 'Company ABC - Reset Password' ;
                $email_body    = "Need to reset your password?<br/>Use your secret code!<br/><br/><span style='font-weight:bold;'>[ ".$randPass." ]</span><br/><br/>Regards,<br/>Company ABC<br/><br/><br/><br/><br/>Please note: This is an automatically generated email, please do not reply. ";
                $email 				= new PHPMailer() ;

                $email->From 		= '1191100577@student.mmu.edu.my' ;
                $email->FromName 	= 'Company ABC' ;
                $email->Subject 	= $email_title ;
                $email->Body 		= $email_body ;
                $email->IsSMTP();
                $email->Host        = 'smtp.gmail.com' ;
                $email->Username    = '1191100577@student.mmu.edu.my' ;
                $email->Password    = 'B@s/!94' ;
                $email->SMTPSecure  = 'tls' ;
                $email->SMTPAuth    = true ;
                $email->Port        = '587' ;
                $email->IsHTML(true) ;
                $email->addAddress($rowUser['user_email']);
                $result = $email->Send() ;
                if(!$result){
                    echo '<script>toastr.error("Mailer Error")</script>';
                    //echo "Mailer Error:".$email->ErrorInfo;
                }else{
                    echo "<script>toastr.success('Email has been sent')</script>";
                }   
            }else{
                echo "<script>toastr.error('Account does not exist')</script>";
            }
        }
        ?>
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

            
            <div class="main-content">

                <div class="page-content">

                    <!-- START RESET-PASSWORD -->
                    <section class="bg-auth">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-xl-10 col-lg-12">
                                    <div class="card auth-box">
                                        <div class="row g-0">
                                            <div class="col-lg-6 text-center">
                                                <div class="card-body p-4">
                                                    <a href="javascript:void(0)">
                                                        <img src="Images/title-light(small).png" alt="" class="logo-light">
                                                        <img src="Images/title-dark(small).png" alt="" class="logo-dark">
                                                    </a>
                                                    <div class="mt-5">
                                                        <img src="Images/reset-password.png" alt="" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-6">
                                                <div class="auth-content card-body p-5 h-100 text-white">
                                                    <div class="text-center mb-4">
                                                        <h5>Reset Password</h5>
                                                        <p class="text-white-50">Reset your password with Company ABC.</p>
                                                    </div>
                                                    <form class="auth-form text-white" method="post">
                                                        <div class="alert alert-warning text-center mb-4" role="alert">  Enter your username and instructions will be sent to you!  </div>
                                                        <div class="mb-4">
                                                            <label class="form-label" for="email">Username</label>
                                                            <input type="text" class="form-control" id="username" name="username"
                                                                placeholder="Enter username">
                                                        </div>
                                                        <div class="mt-3">
                                                            <button type="submit" name="submit" class="btn btn-white w-100">Send Request</button>
                                                        </div>
                                                    </form><!-- end form -->
                
                                                    <div class="mt-5 text-center text-white-50">
                                                        <p>Remembered It ? <a href="sign-in.php" class="fw-medium text-white text-decoration-underline"> Go to Login </a></p>
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                        </div><!--end row-->
                                    </div><!--end auth-box-->
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end container-->
                    </section>
                    <!-- END RESET-PASSWORD -->
                    
                </div>
                <!-- End Page-content -->

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Style switcher -->
        <div id="style-switcher" onclick="toggleSwitcher()" style="left: -165px;">
            <div>
                <h6>Select your color</h6>
                <ul class="pattern list-unstyled mb-0">
                    <li>
                        <a class="color-list color1" href="javascript: void(0);" onclick="setColorGreen()"></a>
                    </li>
                    <li>
                        <a class="color-list color2" href="javascript: void(0);" onclick="setColor('blue')"></a>
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

       <!-- JAVASCRIPT -->
       <script src="Scripts/bootstrap.bundle.min.js"></script>
        <script src="Scripts/bundle.js"></script>


        <!-- Switcher Js -->
        <script src="Scripts/switcher.init.js"></script>

    </body>
</html>