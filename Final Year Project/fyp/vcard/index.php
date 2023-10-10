<?php
$id = $_GET['id'];

if($id == ""){
    header("Location:../404-error.php");
}else{
    include "../Connect/connect.php";
    include "../Plug-ins/PhpMailer/class.phpmailer.php";
    include "../Plug-ins/PhpMailer/class.smtp.php";  
    
    $userResult = $mysqli->query("SELECT * FROM system_user WHERE user_id = '".$id."' AND user_trash = '0'");
    if(mysqli_num_rows($userResult) > 0){
        $rowUser = mysqli_fetch_assoc($userResult);
        
        if($rowUser['user_image'] == ""){
          $image = "user.png";
        }else{
            $image = $rowUser['user_image'];
        }
        ?>
            
<!DOCTYPE html>
<html lang="en" class="no-js">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <title>Company ABC - vCard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Company ABC - vCard" />
    <link rel="shortcut icon" href="../Images/logo.ico">


    <link rel="stylesheet" href="Css/reset.css" type="text/css">
    <link rel="stylesheet" href="Css/bootstrap-grid.min.css" type="text/css">
    <link rel="stylesheet" href="Css/animations.css" type="text/css">
    <link rel="stylesheet" href="Css/perfect-scrollbar.css" type="text/css">
    <link rel="stylesheet" href="Css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="Css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="Css/main.css" type="text/css">

    <script src="Scripts/modernizr.custom.js"></script>
    <script src="Scripts/jquery-2.1.3.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    
  </head>

  <body>

    <script>
      $(document).on("click","#download_cv",function(){
        var val = $(this).attr("href")
        if(val == "javascript:void(0)"){
          toastr.error("No resume is available to be download. Please insert a new one in your profile page")
        }
      });
      </script>
    <?php
      if(isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message'])){
        $email_title   = 'Company ABC - Approacher Contact Email' ;
        $email_body    = "Company ABC: Forwarded email from ".$_POST['email'].".<br/><br/> Dear user,<br/>You have received an email from  Mr/Mrs. ".$_POST['name']." with concerns subject to '".$_POST['subject']."'.<br/>The following section will depict the content of the email:<br/><br/>&emsp;&emsp;[".$_POST['message']."] <br/><br/>Thank you.<br/><br/>Regards,<br/>Company ABC<br/><br/><br/><br/>Please note: This is an automatically generated email, please do not reply. ";
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
        $email->addAddress($_POST['email']);
        $result = $email->Send() ;
        $array['status'] = "true";
        if(!$result){
            echo '<script>toastr.error("Mailer Error")</script>';
            //echo "Mailer Error:".$email->ErrorInfo;
        }else{
          echo '<script>toastr.success("Thank you, your email has been sent")</script>';
        }
      }
    ?>
    <!-- Animated Background -->
    <div class="lm-animated-bg" style="background-image: url(Images/main_bg.png);"></div>
    <!-- /Animated Background -->

    <!-- Loading animation -->
    <div class="preloader">
      <div class="preloader-animation">
        <div class="preloader-spinner">
        </div>
      </div>
    </div>
    <!-- /Loading animation -->

    <div class="page">
      <div class="page-content">

          <header id="site_header" class="header mobile-menu-hide">
            <div class="header-content">
              <div class="header-photo">
                <img src="../Images/<?=$image?>" alt="Alex Smith">
              </div>
              <div class="header-titles">
                <h2><?=$rowUser['user_fname']?> <?=$rowUser['user_lname']?></h2>
                <?php
                  $businessResult = $mysqli->query("SELECT * FROM system_user_business WHERE business_id = '".$rowUser['user_business']."' AND business_trash ='0' ");
                  if(mysqli_num_rows($businessResult) > 0){
                    $rowBusiness = mysqli_fetch_assoc($businessResult);
                    echo "<h4>".$rowBusiness['business_name']."</h4>";
                  }
                ?>
                
              </div>
            </div>

            <ul class="main-menu">
              <li class="active">
                <a href="#home" class="nav-anim">
                  <!-- <span class="menu-icon lnr lnr-home"></span> -->
                  <span class="menu-icon"> <i class="fa-solid fa-house"></i></span>
                  <span class="link-text">Home</span>
                </a>
              </li>
              <li>
                <a href="#about-me" class="nav-anim">
                  <!-- <span class="menu-icon lnr lnr-user"></span> -->
                  <span class="menu-icon"><i class="fa-solid fa-user"></i></span>
                  <span class="link-text">About Me</span>
                </a>
              </li>
              <li>
                <a href="#resume" class="nav-anim">
                  <!-- <span class="menu-icon lnr lnr-graduation-hat"></span> -->
                  <span class="menu-icon "><i class="fa-solid fa-graduation-cap"></i></span>
                  <span class="link-text">Resume</span>
                </a>
              </li>
              
              
              <li>
                <a href="#contact" class="nav-anim">
                  <!-- <span class="menu-icon lnr lnr-envelope"></span> -->
                  <span class="menu-icon "><i class="fa-solid fa-address-book"></i></span>
                  <span class="link-text">Contact</span>
                </a>
              </li>
            </ul>

            <div class="social-links">
              <ul>
                <li><a href="<?=($rowUser['user_facebook'] != "" ? $rowUser['user_facebook'] : "javascript:void(0)")?>" target="<?=($rowUser['user_facebook'] != "" ? "_blank" : "")?>"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="<?=($rowUser['user_twitter'] != "" ? $rowUser['user_twitter'] : "javascript:void(0)")?>" target="<?=($rowUser['user_twitter'] != "" ? "_blank" : "")?>"><i class="fab fa-twitter"></i></a></li>
                <li><a href="<?=($rowUser['user_phone'] != "" ? "tel:".$rowUser['user_phone'] : "javascript:void(0)")?>"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
                <li><a href="mailto:<?=($rowUser['user_email'] != "" ? $rowUser['user_email'] : "javascript:void(0)")?>"><i class="fa fa-envelope" aria-hidden="true"></i></i></a></li>
                
              </ul>
            </div>

            <div class="header-buttons">
              <a id = "download_cv" href="<?=($rowUser['user_cv'] != "" ? "../CV/".$rowUser['user_cv'] : "javascript:void(0)")?>" target="<?=($rowUser['user_cv'] != "" ? "_blank" : "")?>" class="btn btn-primary" <?=($rowUser['user_cv'] != "" ? "download='Resume'" : "")?>>Download CV</a>
            </div>

            <div class="copyrights">Copyright<!--Copyright--> <?= date('Y', time()) ?> &copy; Company ABC.</div>
          </header>

          <!-- Mobile Navigation -->
          <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <!-- End Mobile Navigation -->

          <!-- Arrows Nav -->
          <div class="lmpixels-arrows-nav">
            <!-- <div class="lmpixels-arrow-right"><i class="lnr lnr-chevron-right"></i></div> -->
            <div class="lmpixels-arrow-right"><i class="fa-solid fa-caret-right"></i></div>
            <!-- <div class="lmpixels-arrow-left"><i class="lnr lnr-chevron-left"></i></div> -->
            <div class="lmpixels-arrow-left"><i class="fa-solid fa-caret-left"></i></div>
          </div>
          <!-- End Arrows Nav -->

          <div class="content-area">
            <div class="animated-sections">
              <!-- Home Subpage -->
              <section data-id="home" class="animated-section start-page custom-cover">
                <div class="section-content vcentered">

                    <div class="row">
                      <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="title-block">
                          <h2><?=$rowUser['user_fname']?> <?=$rowUser['user_lname']?></h2>
                          <div class="owl-carousel text-rotation">                                    
                            <div class="item">
                              <?php
                                $businessResult = $mysqli->query("SELECT * FROM system_user_business WHERE business_id = '".$rowUser['user_business']."' AND business_trash ='0' ");
                                if(mysqli_num_rows($businessResult) > 0){
                                  $rowBusiness = mysqli_fetch_assoc($businessResult);
                                  echo "<h4>".$rowBusiness['business_name']."</h4>";
                                }
                              ?>
                            </div>
                            
                            <!-- <div class="item">
                              <div class="sp-subtitle">Frontend-developer</div>
                            </div> -->
                          </div>
                        </div>
                      </div>
                    </div>

                </div>
              </section>
              <!-- End of Home Subpage -->

              <!-- About Me Subpage -->
              <section data-id="about-me" class="animated-section">
                <div class="page-title">
                  <h2>About <span>Me</span></h2>
                </div>

                <div class="section-content">
                  <!-- Personal Information -->
                  <div class="row">
                    

                    <div class="col-xs-12 col-sm-12">
                      <div class="info-list">
                        <ul>
                          <li>
                            <span class="title">Age</span>
                            <span class="value">
                              <?php 
                              if($rowUser['user_dob'] != "0000-00-00"){
                                $age = date('Y', time()) - date('Y', strtotime($rowUser['user_dob']));
                              }else{
                                $age = "";
                              }
                                
                                echo $age;
                              ?></span>
                          </li>

                          <li>
                            <span class="title">Gender</span>
                            <?php
                            switch($rowUser['user_gender']){
                              case 'M':
                                $genderText = "Male";
                                break;
                              case 'F':
                                $genderText = "Female";
                                break;
                              case 'E':
                                $genderText = "N/A";
                                break;
                              default:
                                $genderText = "N/A";
                            }
                            echo '<span class="value">'.$genderText.'</span>';
                            ?>
                          </li>

                          <li>
                            <span class="title">Address</span>
                            <span class="value"><?=$rowUser['user_address']?></span>
                          </li>

                          <li>
                            <span class="title">E-mail</span>
                            <span class="value"><?=$rowUser['user_email']?></span>
                          </li>

                          <li>
                            <span class="title">Phone</span>
                            <span class="value"><?=$rowUser['user_phone']?></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                    
                      <div class="white-space-40" style="width:100%"></div>

                    <div class="col-xs-12 col-sm-12">
                      <div style="color: #09aeea; margin-right: 5px; font-weight: 600;">Brief description: </div>
                      <p><?=$rowUser['user_profile']?></p>
                    </div>

                  </div>
                  <!-- End of Personal Information -->

                  

                  <!-- Services -->
                  <!--
                  <div class="row">
                    <div class="col-xs-12 col-sm-12">
                      <div class="block-title">
                        <h3>What <span>I Do</span></h3>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-sm-6">
                      <div class="col-inner">
                        <div class="info-list-w-icon">
                          <div class="info-block-w-icon">
                            <div class="ci-icon">
                              <i class="lnr lnr-store"></i>
                            </div>
                            <div class="ci-text">
                              <h4>Ecommerce</h4>
                              <p>Pellentesque pellentesque, ipsum sit amet auctor accumsan, odio tortor bibendum massa, sit amet ultricies ex lectus scelerisque nibh. Ut non sodales.</p>
                            </div>
                          </div>
                          <div class="info-block-w-icon">
                            <div class="ci-icon">
                              <i class="lnr lnr-laptop-phone"></i>
                            </div><div class="ci-text">
                              <h4>Web Design</h4>
                              <p>Pellentesque pellentesque, ipsum sit amet auctor accumsan, odio tortor bibendum massa, sit amet ultricies ex lectus scelerisque nibh. Ut non sodales.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-6">
                      <div class="col-inner">
                        <div class="info-list-w-icon">
                          <div class="info-block-w-icon">
                            <div class="ci-icon">
                              <i class="lnr lnr-pencil"></i>
                            </div>
                            <div class="ci-text">
                              <h4>Copywriting</h4>
                              <p>Pellentesque pellentesque, ipsum sit amet auctor accumsan, odio tortor bibendum massa, sit amet ultricies ex lectus scelerisque nibh. Ut non sodales.</p>
                            </div>
                          </div>
                          <div class="info-block-w-icon">
                            <div class="ci-icon">
                              <i class="lnr lnr-flag"></i>
                            </div><div class="ci-text">
                              <h4>Management</h4>
                              <p>Pellentesque pellentesque, ipsum sit amet auctor accumsan, odio tortor bibendum massa, sit amet ultricies ex lectus scelerisque nibh. Ut non sodales.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                          -->
                  <!-- End of Services -->
                </div>
              </section>
              <!-- End of About Me Subpage -->

              <!-- Resume Subpage -->
              <section data-id="resume" class="animated-section">
                <div class="page-title">
                  <h2>Resume</h2>
                </div>

                <div class="section-content">

                  <div class="row">
                    <div class="col-xs-12 col-sm-7">

                      <div class="block-title">
                        <h3>Education</h3>
                      </div>
                      
                      <?php
                        $eduResult = $mysqli->query("SELECT * FROM system_user_edu WHERE edu_user_id = '".$rowUser['user_id']."' AND edu_trash = '0' ");
                        if(mysqli_num_rows($eduResult) > 0){
                          while($rowEdu = mysqli_fetch_assoc($eduResult)){
                            echo '
                            <div class="timeline timeline-second-style clearfix">
                          <div class="timeline-item clearfix">
                            <div class="left-part">
                              <h5 class="item-period">'.($rowEdu['edu_start_date'] == "0000-00-00" ? "0" : date('Y', strtotime($rowEdu['edu_start_date']))).' - '.($rowEdu['edu_present'] == "1" ? "Present" : ($rowEdu['edu_end_date'] == "0000-00-00" ? "0" : date('Y', strtotime($rowEdu['edu_end_date'])))  ).'</h5>
                              <span class="item-company">'.$rowEdu['edu_institute'].'</span>
                            </div>
                            <div class="divider"></div>
                            <div class="right-part">
                              <h4 class="item-title">'.$rowEdu['edu_title'].'</h4>
                              <p>'.$rowEdu['edu_description'].'</p>
                            </div>
                          </div>
                            </div>';
                          }
                        }
                      ?>
                      <!-- <div class="timeline timeline-second-style clearfix">
                        <div class="timeline-item clearfix">
                          <div class="left-part">
                            <h5 class="item-period">2008</h5>
                            <span class="item-company">University of Studies</span>
                          </div>
                          <div class="divider"></div>
                          <div class="right-part">
                            <h4 class="item-title">Frontend Development</h4>
                            <p>Maecenas finibus nec sem ut imperdiet. Ut tincidunt est ac dolor aliquam sodales. Phasellus sed mauris hendrerit, laoreet sem in, lobortis ante.</p>
                          </div>
                        </div>

                        <div class="timeline-item clearfix">
                          <div class="left-part">
                            <h5 class="item-period">2007</h5>
                            <span class="item-company">University of Studies</span>
                          </div>
                          <div class="divider"></div>
                          <div class="right-part">
                            <h4 class="item-title">Graphic Design</h4>
                            <p>Aliquam tincidunt malesuada tortor vitae iaculis. In eu turpis iaculis, feugiat risus quis, aliquet urna. Quisque fringilla mollis risus, eu pulvinar dolor.</p>
                          </div>
                        </div>
                      </div> -->

                      <div class="white-space-50"></div>

                      <div class="block-title">
                        <h3>Experience</h3>
                      </div>

                      <?php
                        $expResult = $mysqli->query("SELECT * FROM system_user_exp WHERE exp_user_id = '".$rowUser['user_id']."' AND exp_trash = '0' ");
                        if(mysqli_num_rows($expResult) > 0){
                          while($rowExp = mysqli_fetch_assoc($expResult)){
                            echo '
                            <div class="timeline timeline-second-style clearfix">
                            <div class="timeline-item clearfix">
                              <div class="left-part">
                                <h5 class="item-period">'.($rowExp['exp_start_date'] == "0000-00-00" ? "0" : date('Y', strtotime($rowExp['exp_start_date']))).' - '.($rowExp['exp_present'] == "1" ? "Present" : ($rowExp['exp_end_date'] == "0000-00-00" ? "0" : date('Y', strtotime($rowExp['exp_end_date'])))  ).'</h5>
                                <span class="item-company">'.$rowExp['exp_institute'].'</span>
                              </div>
                              <div class="divider"></div>
                              <div class="right-part">
                                <h4 class="item-title">'.$rowExp['exp_title'].'</h4>
                                <p>'.$rowExp['exp_description'].'</p>
                              </div>
                            </div>
                            </div>
                            ';
                          }
                        }
                      ?>

                      <!-- <div class="timeline timeline-second-style clearfix">
                        <div class="timeline-item clearfix">
                          <div class="left-part">
                            <h5 class="item-period">2016 - Current</h5>
                            <span class="item-company">Google</span>
                          </div>
                          <div class="divider"></div>
                          <div class="right-part">
                            <h4 class="item-title">Lead Ui/Ux Designer</h4>
                            <p>Praesent dignissim sollicitudin justo, sed elementum quam lacinia quis. Phasellus eleifend tristique posuere. Sed vitae dui nec magna.</p>
                          </div>
                        </div>

                        <div class="timeline-item clearfix">
                          <div class="left-part">
                            <h5 class="item-period">2013 - 2016</h5>
                            <span class="item-company">Adobe</span>
                          </div>
                          <div class="divider"></div>
                          <div class="right-part">
                            <h4 class="item-title">Senior Ui/Ux Designer</h4>
                            <p>Maecenas tempus faucibus rutrum. Duis eu aliquam urna. Proin vitae nulla tristique, ornare felis id, congue libero. Nam volutpat euismod quam.</p>
                          </div>
                        </div>
                        
                        <div class="timeline-item clearfix">
                          <div class="left-part">
                            <h5 class="item-period">2011 - 2013</h5>
                            <span class="item-company">Google</span>
                          </div>
                          <div class="divider"></div>
                          <div class="right-part">
                            <h4 class="item-title">Junior Ui/Ux Designer</h4>
                            <p>Duis mollis nunc quis quam viverra venenatis. Nulla nulla arcu, congue vitae nunc ac, sodales ultricies diam. Nullam justo leo, tincidunt sit amet.</p>
                          </div>
                        </div>
                      </div>-->

                    </div>

                    <!-- Skills & Certificates -->
                    <div class="col-xs-12 col-sm-5">
                      <!-- Design Skills -->
                     

                      <div class="skills-info skills-second-style customTop">
                        <?php
                          $abResult = $mysqli->query("SELECT * FROM system_user_abilities WHERE ab_user_id = '".$rowUser['user_id']."'AND ab_trash = '0' ");
                          if(mysqli_num_rows($abResult) > 0){
                            echo ' 
                            <div class="block-title">
                              <h3>Possessed <span>Abilities</span></h3>
                            </div>';
                            $counter = 1;
                            while($rowAB = mysqli_fetch_assoc($abResult)){
                            echo 
                            '
                           

                            <!-- Skill -->
                            <div class="skill clearfix">
                              <h4>'.$rowAB['ab_title'].'</h4>
                              <div class="skill-value">'.$rowAB['ab_index'].'%</div>
                            </div>
                            <div class="skill-container skill-'.$counter.'">
                              <div class="skill-percentage" style="width:'.$rowAB['ab_index'].'%"></div>
                            </div>
                            <!-- End of Skill -->
                            ';
                            $counter++;
                            }
                          }
                        ?>
                        
                        
                        

                      </div>
                      <!-- End of Design Skills -->

                      <div class="white-space-10"></div>
                      

                      <!-- Skills -->
                      <div class="block-title">
                        <h3>Skills</h3>
                      </div>
                      
                      <div class="skills-info skills-second-style">
                        <ul class="knowledges">
                          <?php
                            $skills = explode(",",$rowUser['user_skill']);
                            foreach($skills as $skill){
                              echo "<li>".$skill."</li>";
                            }
                          ?>
                        </ul>
                      </div>
                      <!-- End of Skills -->

                      <div class="white-space-10"></div>

                      <!-- Languages -->
                      <div class="block-title">
                        <h3>Languages</h3>
                      </div>

                      <ul class="knowledges">
                        <?php
                          $languages = explode(",",$rowUser['user_language']);
                          foreach($languages as $language){
                            echo "<li>".$language."</li>";
                          }
                        ?>
                      </ul>
                      <!-- End of Languages -->
                    </div>
                    <!-- End of Skills & Certificates -->
                  </div>
                </div>
              </section>
              <!-- End of Resume Subpage -->

              <!-- Contact Subpage -->
              <section data-id="contact" class="animated-section">
                <div class="page-title">
                  <h2>Contact</h2>
                </div>

                <div class="section-content">

                  <div class="row">
                    <!-- Contact Info -->
                    <div class="col-xs-12 col-sm-4">
                      <div class="lm-info-block gray-default">
                        <i class="lnr lnr-map-marker"></i>
                        <h4><?php echo ($rowUser['user_country'] != "" ? $rowUser['user_country'] : "N/A"); ?></h4>
                        <span class="lm-info-block-value"></span>
                        <span class="lm-info-block-text"></span>
                      </div>

                      <div class="lm-info-block gray-default">
                        <i class="lnr lnr-phone-handset"></i>
                        <h4><?=$rowUser['user_phone']?></h4>
                        <span class="lm-info-block-value"></span>
                        <span class="lm-info-block-text"></span>
                      </div>


                      <div class="lm-info-block gray-default">
                        <i class="lnr lnr-envelope"></i>
                        <h4>kahchuan1911@gmail.com</h4>
                        <span class="lm-info-block-value"></span>
                        <span class="lm-info-block-text"></span>
                      </div>


                    </div>
                    <!-- End of Contact Info -->

                    <!-- Contact Form -->
                    <div class="col-xs-12 col-sm-8">
                      
                      <div class="block-title">
                        <h3>How Can I <span>Help You?</span></h3>
                      </div>

                      <form id="contact_form" class="contact-form" method="post">

                        <div class="messages"></div>

                        <div class="controls two-columns">
                          <div class="fields clearfix">
                            <div class="left-column">
                              <div class="form-group form-group-with-icon">
                                <input id="form_name" type="text" name="name" class="form-control" placeholder="" required="required" data-error="Name is required.">
                                <label>Full Name</label>
                                <div class="form-control-border"></div>
                                <div class="help-block with-errors"></div>
                              </div>

                              <div class="form-group form-group-with-icon">
                                <input id="form_email" type="email" name="email" class="form-control" placeholder="" required="required" data-error="Valid email is required.">
                                <label>Email Address</label>
                                <div class="form-control-border"></div>
                                <div class="help-block with-errors"></div>
                              </div>

                              <div class="form-group form-group-with-icon">
                                <input id="form_subject" type="text" name="subject" class="form-control" placeholder="" required="required" data-error="Subject is required.">
                                <label>Subject</label>
                                <div class="form-control-border"></div>
                                <div class="help-block with-errors"></div>
                              </div>
                            </div>
                            <div class="right-column">
                              <div class="form-group form-group-with-icon">
                                <textarea id="form_message" name="message" class="form-control" placeholder="" rows="7" required="required" data-error="Please, leave me a message."></textarea>
                                <label>Message</label>
                                <div class="form-control-border"></div>
                                <div class="help-block with-errors"></div>
                              </div>
                            </div>
                          </div>

                          
      
                          <input type="submit" class="button btn-send" name="submit" value="Send message">
                        </div>
                      </form>
                    </div>
                    <!-- End of Contact Form -->
                  </div>

                </div>
              </section>
              <!-- End of Contact Subpage -->
            </div>
          </div>

      </div>
    </div>

    <script src="Scripts/modernizr.custom.js"></script>
    <script src="Scripts/animating.js"></script>

    <script src="Scripts/imagesloaded.pkgd.min.js"></script>

    <script src='Scripts/perfect-scrollbar.min.js'></script>
    <script src='Scripts/jquery.shuffle.min.js'></script>
    <script src='Scripts/masonry.pkgd.min.js'></script>
    <script src='Scripts/owl.carousel.min.js'></script>
    <script src="Scripts/jquery.magnific-popup.min.js"></script>

    <script src="Scripts/validator.js"></script>
    <script src="Scripts/main.js"></script>
 
</body>
</html>



        <?php
    }else{
        header("Location:../404-error.php");
    }
    
    
}
?>