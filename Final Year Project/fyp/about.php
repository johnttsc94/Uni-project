
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
                                        <h3 class="mb-4" style="font-family: 'Nova Square', cursive;">About Us</h3>
                                        <div class="page-next" style="font-family: 'Montserrat Alternates', sans-serif;">
                                             We make business easier
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


                    <!-- START ABOUT -->
                    <section class="section overflow-hidden">
                        <div class="container">
                            <div class="row align-items-center g-0">
                                <div class="col-lg-6">
                                    <div class="section-title me-lg-5">
                                        <h6 class="sub-title">About Us</h6>
                                        <h2 class="title mb-4">Why <span class="text-warning fw-bold">people</span> use our services</h2>

                                        <p class="text-muted">Start working with Company ABC that can provide everything you need to broaden your business opportunity</p>
                                        
                                        <div class="row mt-4 pt-2">
                                            <div class="col-md-6">
                                                <ul class="list-unstyled about-list text-muted mb-0 mb-md-3">
                                                    <li> Digital Marketing Solutions</li>
                                                    <li> Creative Design</li>
                                                    <li> Promote yourself</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="list-unstyled about-list text-muted">
                                                    <li> Create Virtual Business Card</li>
                                                    <li> Broaden Connection</li>
                                                    <li> and more...</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- <div class="mt-3">
                                                <a href="javascript:void(0)" class="btn btn-primary btn-hover">Learn More <i class="uil uil-angle-right-b align-middle"></i></a>
                                        </div> -->
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-6">
                                <div class="about-img mt-4 mt-lg-0">
                                    <img src="Images/skill.png" width= "700px" alt="" class="img-fluid rounded">
                                </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end container-->
                    </section>
                    <!-- END ABOUT -->

                    <!-- COUNTER START -->
                    <section class="section bg-light">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="counter-box mt-3">
                                        <div class="counters text-center">
                                            <h5 class="counter mb-0">10,000+</h5>
                                            <h6 class="fs-16 mt-3">Business Opportunity</h6>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-3 col-md-6">
                                    <div class="counter-box mt-3">
                                        <div class="counters text-center">
                                            <h5 class="counter mb-0">2550+</h5>
                                            <h6 class="fs-16 mt-3">Partner</h6>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-3 col-md-6">
                                    <div class="counter-box mt-3">
                                        <div class="counters text-center">
                                            <h5 class="counter mb-0">8.85K</h5>
                                            <h6 class="fs-16 mt-3">Positive Feedback</h6>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-3 col-md-6">
                                    <div class="counter-box mt-3">
                                        <div class="counters text-center">
                                            <h5 class="counter mb-0">6800</h5>
                                            <h6 class="fs-16 mt-3">Users</h6>
                                        </div>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end container-->
                    </section>
                    <!-- COUNTER END -->

                    <!-- START feature -->
                    <section class="section">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <div class="section-title text-center mb-5">
                                        <h3 class="title mb-4">Key Features</h3>
                                        <p class="para-desc text-muted mx-auto">One stop solution to your business needs</p>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                            <div class="row">
                                <div class="col-lg-4 col-md-6 mt-4 pt-2">
                                    <div class="about-feature p-3 d-flex align-items-center rounded-3">
                                        <div class="featrue-icon flex-shrink-0">
                                            <i class="uim uim-object-ungroup"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-18 mb-0">Manage Business Card</h6>
                                        </div>
                                    </div><!--about-feature-->
                                </div><!--end col-->
                                <div class="col-lg-4 col-md-6 mt-4 pt-2">
                                    <div class="about-feature p-3 d-flex align-items-center rounded-3">
                                        <div class="featrue-icon flex-shrink-0">
                                            <i class="uim uim-telegram-alt"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-18 mb-0">Fast Sharing</h6>
                                        </div>
                                    </div><!--about-feature-->
                                </div><!--end col-->
                                
                                <div class="col-lg-4 col-md-6 mt-4 pt-2">
                                    <div class="about-feature p-3 d-flex align-items-center rounded-3">
                                        <div class="featrue-icon flex-shrink-0">
                                            <i class="uim uim-airplay"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-18 mb-0">Effective Self Promotion</h6>
                                        </div>
                                    </div><!--about-feature-->
                                </div><!--end col-->
                                
                                <div class="col-lg-4 col-md-6 mt-4 pt-2">
                                    <div class="about-feature p-3 d-flex align-items-center rounded-3">
                                        <div class="featrue-icon flex-shrink-0">
                                            <i class="uim uim-history"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-18 mb-0">Quick Support</h6>
                                        </div>
                                    </div><!--about-feature-->
                                </div><!--end col-->

                                <div class="col-lg-4 col-md-6 mt-4 pt-2">
                                    <div class="about-feature p-3 d-flex align-items-center rounded-3">
                                        <div class="featrue-icon flex-shrink-0">
                                            <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" width="1em"><path class="uim-quaternary" d="M21,2H9C8.44803,1.99969,8.00031,2.44689,8,2.99886C8,2.99924,8,2.99962,8,3v4h8c0.55197-0.00031,0.99969,0.44689,1,0.99886C17,7.99924,17,7.99962,17,8v8h4c0.55197,0.00031,0.99969-0.44689,1-0.99886c0-0.00038,0-0.00076,0-0.00114V3c0.00031-0.55197-0.44689-0.99969-0.99886-1C21.00076,2,21.00038,2,21,2z"></path><path class="uim-primary" d="M3,12h8c0.55229,0,1,0.44771,1,1v8c0,0.55228-0.44771,1-1,1H3c-0.55228,0-1-0.44772-1-1v-8C2,12.44771,2.44772,12,3,12z"></path><path class="uim-tertiary" d="M16,7H6C5.44803,6.99969,5.00031,7.44689,5,7.99886C5,7.99924,5,7.99962,5,8v4h6c0.55197-0.00031,0.99969,0.44689,1,0.99886c0,0.00038,0,0.00076,0,0.00114v6h4c0.55197,0.00031,0.99969-0.44689,1-0.99886c0-0.00038,0-0.00076,0-0.00114V8c0.00031-0.55197-0.44689-0.99969-0.99886-1C16.00076,7,16.00038,7,16,7z"></path></svg></span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-18 mb-0">Creative Design</h6>
                                        </div>
                                    </div><!--about-feature-->
                                </div><!--end col-->

                                <div class="col-lg-4 col-md-6 mt-4 pt-2">
                                    <div class="about-feature p-3 d-flex align-items-center rounded-3">
                                        <div class="featrue-icon flex-shrink-0">
                                            <i class="uil uil-anchor"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-18 mb-0">Stratagy & Research</h6>
                                        </div>
                                    </div><!--about-feature-->
                                </div><!--end col-->
                                
                                
                            </div><!--end row-->
                        </div><!--end container-->
                    </section>
                    <!-- END feature -->


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


        <!-- Counter Js -->
        <script src="Scripts/counter.init.js"></script>
        
       <!-- Switcher Js -->
       <script src="Scripts/switcher.init.js"></script>

        <!-- App Js -->
        <script src="Scripts/app.js"></script>

    </body>
</html>