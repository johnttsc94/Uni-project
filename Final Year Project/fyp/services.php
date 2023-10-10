
<!doctype html>
<html lang="en">

    <?php
    session_start();
    include "Connect/connect.php";
    include "Requires/header.php";
    ?>

    <body>
        <?php

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
        //retrieve latest user info
        $userResult = $mysqli->query("SELECT * FROM system_user WHERE user_id = '".$userID."' AND user_trash = 0");
        if(mysqli_num_rows($userResult) > 0){
            $rowUser = mysqli_fetch_assoc($userResult);
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

            

            <!--Navbar Start-->
            <nav class="navbar navbar-expand-lg fixed-top sticky" id="navbar">
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
                                <!-- <img src="Images/profile.jpg" alt="mdo" width="35" height="35" class="rounded-circle me-1"> <span class="d-none d-md-inline-block fw-medium">Hi, Guest</span> -->
                                <?php
                                if($userID == ""){
                                    $text = "Hi, Guest";
                                    $image = "user.png";
                                }else{
                                    if(!isset($rowUser['user_lname']) || $rowUser['user_lname'] == ""){
                                        $text = "Hi, User";
                                    }else{
                                        $text = "Hi, ".$rowUser['user_lname'];
                                    }
                                    if(!isset($rowUser['user_image']) || $rowUser['user_image'] == ""){
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
                                        <h3 class="mb-4" style="font-family: 'Nova Square', cursive;">Services</h3>
                                        <div class="page-next" style="font-family: 'Montserrat Alternates', sans-serif;">
                                            Our goals and objectives
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


                    <!-- START SERVICE-PAGE --> 
                    <section class="section">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="section-title text-center">
                                        <h3 class="title mb-3">Providing our trusted <span class="text-warning">Services</span></h3>
                                        <p class="text-muted">It is a long established fact that a reader will be of a page when established fact looking at its layout.</p>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="card service-box mt-4">
                                        <div class="card-body p-4">
                                            <div class="service-icon icons-md">
                                                <i class="uim uim-object-ungroup"></i>
                                            </div>
                                            <div class="mt-4">
                                                <h5>Manage Business Card</h5>
                                                <p class="text-muted">All update on your information will immediately reflect on your business card</p>
                                            </div>
                                            <!-- <div class="learn-more">
                                                <a href="javascript:void(0)" class="form-text text-primary">Learn More <i class="uil uil-angle-right-b"></i></a>
                                            </div> -->
                                        </div>
                                        
                                    </div><!--end service-->
                                </div><!--end col-->

                                <div class="col-lg-4 col-md-6">
                                    <div class="card service-box mt-4">
                                        <div class="card-body p-4">
                                            <div class="service-icon icons-md">
                                                <i class="uim uim-telegram-alt"></i>
                                            </div>
                                            <div class="mt-4">
                                                <h5>Fast Sharing</h5>
                                                <p class="text-muted">Share your info to anyone or anyplace immediately</p>
                                                <!-- <div class="learn-more">
                                                    <a href="javascript:void(0)" class="form-text text-primary">Learn More <i class="uil uil-angle-right-b"></i></a>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div><!--end service-->
                                </div><!--end col-->

                                <div class="col-lg-4 col-md-6">
                                    <div class="card service-box mt-4">
                                        <div class="card-body p-4">
                                            <div class="service-icon icons-md">
                                                <i class="uim uim-airplay"></i>
                                            </div>
                                            <div class="mt-4">
                                                <h5>Effective Self Promotion</h5>
                                                <p class="text-muted">Instantly let others knows you at the tips of finger</p>
                                                <!-- <div class="learn-more">
                                                    <a href="javascript:void(0)" class="form-text text-primary">Learn More <i class="uil uil-angle-right-b"></i></a>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div><!--end service-->
                                </div><!--end col-->


                                <div class="col-lg-4 col-md-6">
                                    <div class="card service-box mt-4">
                                        <div class="card-body p-4">
                                            <div class="service-icon icons-md">
                                                <i class="uim uim-history"></i>
                                            </div>
                                            <div class="mt-4">
                                                <h5>Quick Support</h5>
                                                <p class="text-muted">We provide 24 x 7 x 365 technical maintenance and support services. We make sure that you stay ahead of your competition.</p>
                                                <!-- <div class="learn-more">
                                                    <a href="javascript:void(0)" class="form-text text-primary">Learn More <i class="uil uil-angle-right-b"></i></a>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div><!--end service-->
                                </div><!--end col-->

                                <div class="col-lg-4 col-md-6">
                                    <div class="card service-box mt-4">
                                        <div class="card-body p-4">
                                            <div class="service-icon icons-md">
                                                <i class="uim uim-layers-alt"></i>
                                            </div>
                                            <div class="mt-4">
                                                <h5>Creative Design</h5>
                                                <p class="text-muted">Implement the latest design concept to attract the eyeball of viewers</p>
                                                <!-- <div class="learn-more">
                                                    <a href="javascript:void(0)" class="form-text text-primary">Learn More <i class="uil uil-angle-right-b"></i></a>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div><!--end service-->
                                </div><!--end col-->

                                <div class="col-lg-4 col-md-6">
                                    <div class="card service-box mt-4">
                                        <div class="card-body p-4">
                                            <div class="service-icon icons-md">
                                                <i class="uim uim-anchor"></i>
                                            </div>
                                            <div class="mt-4">
                                                <h5>Stratagy & Research</h5>
                                                <p class="text-muted">The most important aspect of beauty was, therefore, an inherent part of an object, rather than something.</p>
                                                <!-- <div class="learn-more">
                                                    <a href="javascript:void(0)" class="form-text text-primary">Learn More <i class="uil uil-angle-right-b"></i></a>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div><!--end service-->
                                </div><!--end col-->

                                
                            </div><!--end row-->
                        </div><!--end container-->
                    </section>
                    <!-- END SERVICE-PAGE -->

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

    </body>
</html>