
<!doctype html>
<html lang="en">

   <?php
   session_start();
   include "Connect/connect.php";
   include "Requires/header.php";
   ?>

    <body>

    <?php
    //print_r($_POST);
    if(!empty($_POST)){
        $userResult = $mysqli->query("SELECT * FROM system_user WHERE user_username = '".$_POST['username']."' AND user_trash = 0");
        if(mysqli_num_rows($userResult) == 0 && $_POST['check'] == 'on'){


            $md5Pass = md5($_POST['password']);
            $stmt = $mysqli->prepare("INSERT INTO system_user(user_username,user_password,user_email,user_trash, user_fname,user_lname,user_address,user_country,user_image,user_cv,user_cv_size,user_facebook,user_twitter,user_profile,user_dob,user_language,user_skill,user_phone,user_gender) VALUES(?,?,?,'0','','','','','user.png','','0.00','','','','0000-00-00','','','','')");
            $stmt->bind_param('sss',$_POST['username'],$md5Pass,$_POST['email']);
            $userInsert =  $stmt->execute();
            if($userInsert != true){
                echo "<script>toastr.error('Failed to sign up!')</script>";
            }
            $tempResult = $mysqli->query("SELECT * FROM system_user WHERE user_username = '".$_POST['username']."' AND user_trash = 0");
            $rowTemp = mysqli_fetch_assoc($tempResult);
            $_SESSION['user_id'] = $rowTemp['user_id'];
            $vlink = "http://localhost/fyp/vcard/index.php?id=".$rowTemp['user_id'];
            $stmt2 = $mysqli->prepare("UPDATE system_user SET user_vlink = ? WHERE user_trash = 0 AND user_id = ?");
            $stmt2->bind_param('si',$vlink,$rowTemp['user_id']);
            $stmt2->execute();
            // $updateLink = $mysqli->query("INSERT INTO system_user SET user_vlink = '".$vlink."' WHERE user_trash = 0 AND user_id = '".$rowTemp['user_id']."'");
            header("Location:profile.php");
        }else if($_POST['check'] != 'on'){
            echo "<script>toastr.error('Please make sure you have go through our terms and condition')</script>";
        }else if(mysqli_num_rows($userResult) > 0){
            echo "<script>toastr.error('Username existed! Please create a new one')</script>";
        }else{
            echo "<script>toastr.error('Error occured')</script>";
        }
    }
    ?>

        <script type="text/javascript">
            $(document).ready(function(){
                function hideNotification(){
                    $("#username-status").fadeOut("slow");
                }
                var timer;
                $("#usernameInput").on("keyup",function(){
                    var key = $(this).val();
                    //console.log(key);
                    $.ajax({
                        url:"Requires/ajax_checkUsername.php",
                        type:"POST",
                        data:{"key":key},
                        success:function(result){
                            $("#username-status").removeClass("hidden");
                            if(result == "true"){
                                $("#username-status").css("display","inline");
                                $("#username-status").text("Username accepted");
                                $("#username-status").css("color","yellow");
                                
                            }else{
                                $("#username-status").css("display","inline");
                                $("#username-status").text("Username existed");
                                $("#username-status").css("color","red"); 
                            }
                        }
                    });                    
                    clearTimeout(timer);  //clear any running timeout on key up
                    timer = setTimeout(hideNotification, 2000);//then give it two seconds to see if the user is finished
                });

                $("#submit").click(function(){
                    event.preventDefault();
                    var password = $("#passwordInput").val();
                    var upperCase= new RegExp('[A-Z]');
                    var lowerCase= new RegExp('[a-z]');
                    var numbers = new RegExp('[0-9]');
                    if(password !== ""){
                        //alert(password.length);
                        if(password.length < 8){
                            //event.preventDefault();
                            toastr.error("Password length must be longer than 8 digits");
                        }else if(!password.match(upperCase)){
                            //event.preventDefault();
                            toastr.error("Password must contain at least one upper case");
                        }else if(!password.match(lowerCase)){
                            //event.preventDefault();
                            toastr.error("Password must contain at least one lower case");
                        }else if(!password.match(numbers)){
                            //event.preventDefault();
                            toastr.error("Password must contain at least one number");
                        }else{
                            $(this).unbind("click").click();
                        }
                        
                    }else{
                        toastr.warning("Please insert required information");
                    }
                    
                })
            })
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

            
            <div class="main-content">

                <div class="page-content">

                    <!-- START SIGN-UP -->
                    <section class="bg-auth">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-xl-10 col-lg-12">
                                    <div class="card auth-box">
                                        <div class="row align-items-center">
                                            <div class="col-lg-6 text-center">
                                                <div class="card-body p-4">
                                                    <a href="javascript:void(0)">
                                                        <img src="Images/title-light(small).png" alt="" class="logo-light">
                                                        <img src="Images/title-dark(small).png" alt="" class="logo-dark">
                                                    </a>
                                                    <div class="mt-5">
                                                        <img src="Images/sign-up.png" alt="" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-6">
                                                <div class="auth-content card-body p-5 text-white">
                                                    <div class="w-100">
                                                        <div class="text-center">
                                                            <h5>Let's Get Started</h5>
                                                            <p class="text-white-70">Sign Up and get access to all the features of Company ABC</p>
                                                        </div>
                                                        <form class="auth-form" method="post" id="form">
                                                            <div class="mb-3">
                                                                <label for="usernameInput" class="form-label">Username</label>
                                                                <input type="text" name="username" class="form-control" required id="usernameInput" placeholder="Enter your username">
                                                                <span class="hidden" id="username-status" style="font-weight:bold"></span>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="emailInput" class="form-label">Email</label>
                                                                <input type="email" name="email" class="form-control" required id="emailInput" placeholder="Enter your email">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="passwordInput" class="form-label">Password</label>
                                                                <input type="password" name="password" class="form-control"  id="passwordInput" placeholder="Enter your password">
                                                                <div><small>*Password must be at least 8 characters*</small></div>
                                                                <div><small>*Password must contain at least one upper case *</small></div>
                                                                <div><small>*Password must contain at least one lower case *</small></div>
                                                                <div><small>*Password must contain at least one digit *</small></div>
                                                            </div>
                                                            <div class="mb-4">
                                                                <div class="form-check"><input type="hidden" name="check" value="off"><input class="form-check-input" name="check" type="checkbox" value="on" id="flexCheckDefault">
                                                                
                                                                    <label class="form-check-label" for="flexCheckDefault">I agree to the <a href="privacy-policy.php" class="text-white text-decoration-underline">Terms and conditions</a></label>
                                                                </div>
                                                            </div>
                                                            <div class="text-center">
                                                                <button type="submit" id="submit" class="btn btn-white btn-hover w-100">Sign Up</buttom>
                                                            </div>
                                                        </form>
                                                        <div class="mt-3 text-center">
                                                            <p class="mb-0">Already a member ? <a href="sign-in.php" class="fw-medium text-white text-decoration-underline"> Sign In </a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                        </div><!--end row-->
                                    </div><!--end auth-box-->
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end container-->
                    </section>
                    <!-- END SIGN-UP -->
                    
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