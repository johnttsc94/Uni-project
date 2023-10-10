
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
        //print_r($_POST);
        if(!empty($_POST) && isset($_POST['submit'])){
            $status = $mysqli->query("INSERT INTO system_user_feedback(feedback_name,feedback_email,feedback_subject,feedback_message,feedback_trash) VALUES('".$_POST['name']."','".$_POST['email']."','".$_POST['subject']."','".$_POST['message']."','0')");
            echo $status;
            if($status){
                echo "<script>toastr.success('Feedback has been sent')</script>";
            }else{
                //echo("Error description: " . $mysqli -> error);
                echo "<script>toastr.error('Feedback failed to sent')</script>";
            }
            
        }

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
                                        <h3 class="mb-4" style="font-family: 'Nova Square', cursive;">Contact Us</h3>
                                        <div class="page-next" style="font-family: 'Montserrat Alternates', sans-serif;">
                                            We would like to hear from you
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


                    <!-- START CONTACT-PAGE -->
                    <section class="section">
                        <div class="container">
                            <div class="row align-items-center mt-5">
                                <div class="col-lg-6">
                                    <div class="section-title mt-4 mt-lg-0">
                                        <h3 class="title">Get in touch</h3>
                                        <p class="text-muted">Start sharing your ideas or opinions to us to help us serves you well and better</p>
                                        <form method="post" class="contact-form mt-4" name="myForm" id="myForm">
                                            <span id="error-msg"></span>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Name</label>
                                                        <input type="text" name="name" id="name" class="form-control"
                                                            placeholder="Enter your name">
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="emailInput" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="emaiol" name="email"
                                                            placeholder="Enter your email">
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="subjectInput" class="form-label">Subject</label>
                                                        <input type="text" class="form-control" id="subjectInput" name="subject" id="subject"
                                                            placeholder="Enter your subject">
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="meassageInput" class="form-label">Your Message</label>
                                                        <textarea class="form-control" id="meassageInput" placeholder="Enter your message" name="message" id="message" rows="3"></textarea>
                                                    </div>
                                                </div><!--end col-->
                                            </div><!--end row-->
                                            <div class="text-end">
                                                <button type="submit" id="submit" name="submit" class="btn btn-primary"> Send Message <i class="uil uil-message ms-1"></i></button>
                                            </div>
                                        </form><!--end form-->
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-5 ms-auto order-first order-lg-last">
                                    <div class="text-center">
                                        <img src="Images/contact.png" alt="" class="img-fluid">
                                    </div>
                                    <div class="mt-4 pt-3">
                                        <div class="d-flex text-muted align-items-center mt-2">
                                            <div class="flex-shrink-0 fs-22 text-primary">
                                                <i class="uil uil-map-marker"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <p class="mb-0">Lot.153, Jalan Murni, Johor, Malaysia</p>
                                            </div>
                                        </div>
                                        <div class="d-flex text-muted align-items-center mt-2">
                                            <div class="flex-shrink-0 fs-22 text-primary">
                                                <i class="uil uil-envelope"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <p class="mb-0"><a href="mailto:kahchuan1911@gmail.com">kahchuan1911@gmail.com</a></p>
                                            </div>
                                        </div>
                                        <div class="d-flex text-muted align-items-center mt-2">
                                            <div class="flex-shrink-0 fs-22 text-primary">
                                                <i class="uil uil-phone-alt"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <p class="mb-0"><a href="tel:+6017-6226799">(+60) 17 622 6799</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end container-->
                    </section>
                   

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