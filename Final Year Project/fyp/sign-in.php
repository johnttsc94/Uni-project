
<!doctype html>
<html lang="en">

    <?php
   session_start();
   include "Connect/connect.php";
   include "Requires/header.php";

   ?>

   <script>
        $(document).on("click","#togglePassword",function(){
            $(this).toggleClass("fa-eye fa-eye-slash")
            var password = $(this).parent().find('input[name="password"]')
            var type = password.attr("type")
            if(type == "password"){
                password.attr("type","text")
            }else{
                password.attr("type","password")
            }
        })
    </script>

    <body>

    <?php
     //print_r($_POST);
     
    if(!empty($_POST) && isset($_POST['submit'])){
        $userResult = $mysqli->query("SELECT * FROM system_user WHERE user_username = '".$_POST['username']."' AND user_trash = 0");
        if(mysqli_num_rows($userResult) > 0){
            $rowUser = mysqli_fetch_assoc($userResult);
            if(md5($_POST['password']) == $rowUser['user_password']){
                $_SESSION['user_id'] = $rowUser['user_id'];
                if($_POST['remember'] == "on"){
                    setcookie("user_id", $rowUser['user_id'], time() + (86400 * 30)); // 86400 = 1 day; here we set cookie valid for 30 days
                }
                header("Location:profile.php");
                exit();
            }else{
                echo "<script>toastr.error('Username or password incorrect')</script>";
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

                    <!-- START SIGN-IN -->
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
                                                        <img src="Images/sign-in.png" alt="" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-6">
                                                <div class="auth-content card-body p-5 h-100 text-white">
                                                    <div class="w-100">
                                                        <div class="text-center mb-4">
                                                            <h5>Welcome Back !</h5>
                                                            <p class="text-white-70">Sign in to continue to Company ABC.</p>
                                                        </div>
                                                        <form method="post" class="auth-form">
                                                            <div class="mb-3">
                                                                <label for="usernameInput" class="form-label">Username</label>
                                                                <input type="text" class="form-control" name="username" id="usernameInput" placeholder="Enter your username" required>
                                                            </div>
                                                            <div class="mb-3" style="position:relative">
                                                                <label for="passwordInput" class="form-label">Password</label>
                                                                <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Enter your password" required>
                                                                <i class="far fa-eye password-eye" id="togglePassword" ></i>
                                                            </div>
                                                            <div class="mb-4">
                                                                <div class="form-check">
                                                                <input type="hidden" value="off" name="remember"><input class="form-check-input" value="on" type="checkbox" name="remember"  id="flexCheckDefault">
                                                                    <a href="reset-password.php" class="float-end text-white">Forgot Password?</a>
                                                                    <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                                                                </div>
                                                            </div>
                                                            <div class="text-center">
                                                                <button type="submit" name="submit" class="btn btn-white btn-hover w-100">Sign In</button>
                                                            </div>
                                                        </form>
                                                        <div class="mt-4 text-center">
                                                            <p class="mb-0">Don't have an account ? <a href="sign-up.php" class="fw-medium text-white text-decoration-underline"> Sign Up </a></p>
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
                    <!-- END SIGN-IN -->
                    
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