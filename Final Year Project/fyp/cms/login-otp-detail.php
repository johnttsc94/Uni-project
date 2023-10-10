<?php
// Start the session
session_start();

include "Requires/function.php";
include "Plug-ins/PhpMailer/class.phpmailer.php";
include "Plug-ins/PhpMailer/class.smtp.php";
include "Connect/connect.php";

$action = $_POST['action'];

switch($action){
    case 'send':
            $otp = generateNumericOTP('6');
            $timeAfter2 = date('Y-m-d H:i:s',strtotime('+2 minutes'));
            $mysqli->query("UPDATE system_admin_otp SET otp_trash = 1 WHERE otp_admin_id = '".$_SESSION['admin_id']."'");
            $mysqli->query("INSERT INTO system_admin_otp(otp_number,otp_expired_time,otp_admin_id,otp_trash) VALUES('".$otp."','".$timeAfter2."','".$_SESSION['admin_id']."','0')");


            $email_title   = 'Company ABC - One Time Password' ;
            $email_body    = "Company ABC:Confidential! Never share your OTP. TAC is ".$otp.". Expires in ".$timeAfter2."<br/><br/>Thank you.<br/><br/>Regards,<br/>Company ABC<br/><br/><br/><br/><br/>Please note: This is an automatically generated email, please do not reply. ";
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
            $email->addAddress($_SESSION['admin_email']);
            $result = $email->Send() ;
            $array['status'] = "true";
            //$array['password'] = $email->ErrorInfo;
            // if(!$result){
            //     echo '<script>toastr.error("Mailer Error")</script>';
            //     //echo "Mailer Error:".$email->ErrorInfo;
            // }
            
        break;

    case 'resend':
            
            $timeNow = date('Y-m-d H:i:s');
            
            $otpResult = $mysqli->query("SELECT * FROM system_admin_otp WHERE otp_admin_id = '".$_SESSION['admin_id']."' AND otp_trash = 0 ORDER BY otp_id DESC LIMIT 1");
            $rowOTP = $otpResult->fetch_assoc();
            if($timeNow > $rowOTP['otp_expired_time']){
                //echo "Expired";
                $array['status'] = "false";

            }else{
                $otp = $rowOTP['otp_number'];
                $email_title   = 'Company ABC - One Time Password' ;
                $email_body    = "Company ABC:Confidential! Never share your OTP. TAC is ".$otp.". Expires in ".$rowOTP['otp_expired_time']."<br/><br/>Thank you.<br/><br/>Regards,<br/>Company ABC<br/><br/><br/><br/><br/>Please note: This is an automatically generated email, please do not reply. ";
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
                $email->addAddress($_SESSION['admin_email']);
                $result = $email->Send() ;
                $array['status'] = "true";
            }

            // if(!$result){
            //     echo '<script>toastr.error("Mailer Error")</script>';
            //     //echo "Mailer Error:".$email->ErrorInfo;
            // }
        break;
}
echo json_encode($array);
?>