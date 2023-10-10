<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
require 'vendor/autoload.php';
//$fileName = 'ExportUser-'.time().'.xlsx';
$fileName = 'ExportUser-'.date("dmy").'.xlsx';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$HeaderArray = array(

    'No', 

    'Image',

    "Username",

    "Full Name",

    "Gender",

    "Date of Birth",

    "Language",

    "Address",

    "Country",

    "Description",

    "Skills",

    "Business Nature",

    "CV",
    
    "Education",

    "Experience",

    "Abilities",

    "Facebook Link",

    "Twitter Link",

    "Contact No",

    "Email Address",

    "Business Card Link",

    "Created Date",

      );

$headerLetter = "A";

foreach($HeaderArray as $key => $header_name){				
    $sheet->setCellValue($headerLetter."1", $header_name);
    $headerLetter++;
}

// query for user
$mysqli_user = $mysqli->query("SELECT * FROM system_user WHERE user_trash = 0 ");
	
// check exist
if ($mysqli_user->num_rows > 0){

    $count = 2;

    // add to cell
    while ($row_user = $mysqli_user->fetch_array(MYSQLI_ASSOC)){

        $A='A';

        if($row_user['user_gender'] == "M"){
            $genderText = "Male";
        }else if($row_user['user_gender'] == "F"){
            $genderText = "Female";
        }else if($row_user['user_gender'] == "E"){
            $genderText = "Other";
        }else{
            $genderText = "N/A";
        }

        $userBusiness = $mysqli->query("SELECT * FROM system_user_business WHERE business_id = '".$row_user['user_business']."' AND business_trash = 0 ");
        if(mysqli_num_rows($userBusiness) > 0){
            $row_Business = mysqli_fetch_assoc($userBusiness);
        }

        $userEdu = $mysqli->query("SELECT * FROM system_user_edu WHERE edu_user_id = '".$row_user['user_id']."' AND edu_trash = 0 ");
        if(mysqli_num_rows($userEdu) > 0){
            $edu_content = "";
            $i = "0";
            while($row_Edu = mysqli_fetch_assoc($userEdu)){
                $edu_content .= "Title: ".$row_Edu['edu_title']."\n";
                $edu_content .= "Start Date: ".$row_Edu['edu_start_date'];
                if($row_Edu['edu_present'] == "1"){
                    $edu_content .= "    End Date: Present\n";
                }else{
                    $edu_content .= "    End Date: ".$row_Edu['edu_end_date']."\n";
                }
                $edu_content .= "Institute: ".$row_Edu['edu_institute']."\n";
                if($i < mysqli_num_rows($userEdu)-1){
                    $edu_content .= "Description: ".$row_Edu['edu_description']."\n\n";
                }else{
                    $edu_content .= "Description: ".$row_Edu['edu_description'];
                }
                
                $i++;
            }
            
        }else{
            $edu_content = "N/A";
        }

        $userExp = $mysqli->query("SELECT * FROM system_user_exp WHERE exp_user_id = '".$row_user['user_id']."' AND exp_trash = 0 ");
        if(mysqli_num_rows($userExp) > 0){
            $exp_content = "";
            $i = "0";
            while($row_Exp = mysqli_fetch_assoc($userExp)){
                $exp_content .= "Title: ".$row_Exp['exp_title']."\n";
                $exp_content .= "Start Date: ".$row_Exp['exp_start_date'];
                if($row_Exp['exp_present'] == "1"){
                    $exp_content .= "    End Date: Present\n";
                }else{
                    $exp_content .= "    End Date: ".$row_Exp['exp_end_date']."\n";
                }
                $exp_content .= "Institute: ".$row_Exp['exp_institute']."\n";
                if($i < mysqli_num_rows($userExp)-1){
                    $exp_content .= "Description: ".$row_Exp['exp_description']."\n\n";
                }else{
                    $exp_content .= "Description: ".$row_Exp['exp_description'];
                }
                
                $i++;
            }
            
        }else{
            $exp_content = "N/A";
        }

        $userAb = $mysqli->query("SELECT * FROM system_user_abilities WHERE ab_user_id = '".$row_user['user_id']."' AND ab_trash = 0 ");
        if(mysqli_num_rows($userAb) > 0){
            $ab_content = "";
            $i = "0";
            while($row_Ab = mysqli_fetch_assoc($userAb)){
                $ab_content .= "Title: ".$row_Ab['ab_title'];
                $ab_content .= "    Index: ".$row_Ab['ab_index'];
                if($i < mysqli_num_rows($userAb)-1){
                    $ab_content .= "\n\n";
                }
                $i++;
            }
            
        }else{
            $ab_content = "N/A";
        }

        if($row_user['user_cv'] != ""){
            $cv_name = $row_user['user_cv'];
        }else{
            $cv_name = "N/A";
        }


        $sheet->setCellValue($A++.$count, $count-1)

            ->setCellValue($A++.$count, $row_user['user_image'])

            ->setCellValue($A++.$count, $row_user['user_username'])

            ->setCellValue($A++.$count, $row_user['user_fname']." ".$row_user['user_lname'])

            ->setCellValue($A++.$count, $genderText)

            ->setCellValue($A++.$count, $row_user['user_dob'] )

            ->setCellValue($A++.$count, $row_user['user_language'] )

            ->setCellValue($A++.$count, $row_user['user_address'] )

            ->setCellValue($A++.$count, $row_user['user_country'] )

            ->setCellValue($A++.$count, $row_user['user_profile'] )

            ->setCellValue($A++.$count, $row_user['user_skill'] )

            ->setCellValue($A++.$count, $row_Business['business_name'] )

            ->setCellValue($A++.$count, $cv_name )

            ->setCellValue($A++.$count,  $edu_content )

            ->setCellValue($A++.$count,  $exp_content )
            
            ->setCellValue($A++.$count,  $ab_content )

            ->setCellValue($A++.$count, $row_user['user_facebook'] )

            ->setCellValue($A++.$count, $row_user['user_twitter'] )

            ->setCellValue($A++.$count, $row_user['user_phone'] )

            ->setCellValue($A++.$count, $row_user['user_email'] )

            ->setCellValue($A++.$count, $row_user['user_vlink'] )

            ->setCellValue($A++.$count, $row_user['user_createdDate'] );
                    
        $arrayCell[] = $count;
        $count++;		
    }

    //setting width
    $sheet->getColumnDimension('B')->setWidth("15");
    $sheet->getColumnDimension('C')->setWidth("15");
    $sheet->getColumnDimension('D')->setWidth("30");
    $sheet->getColumnDimension('E')->setWidth("15");
    $sheet->getColumnDimension('F')->setWidth("15");
    $sheet->getColumnDimension('G')->setWidth("30");
    $sheet->getColumnDimension('H')->setWidth("40");
    $sheet->getColumnDimension('I')->setWidth("20");
    $sheet->getColumnDimension('J')->setWidth("70");
    $sheet->getColumnDimension('K')->setWidth("40");
    $sheet->getColumnDimension('L')->setWidth("20");
    $sheet->getColumnDimension('M')->setWidth("30");
    $sheet->getColumnDimension('N')->setWidth("50");
    $sheet->getColumnDimension('O')->setWidth("50");
    $sheet->getColumnDimension('P')->setWidth("50");
    $sheet->getColumnDimension('Q')->setWidth("30");
    $sheet->getColumnDimension('R')->setWidth("30");
    $sheet->getColumnDimension('S')->setWidth("30");
    $sheet->getColumnDimension('T')->setWidth("30");
    $sheet->getColumnDimension('U')->setWidth("40");
    $sheet->getColumnDimension('V')->setWidth("15");

    //set text overflow for one column
    //$spreadsheet->getActiveSheet()->getStyle('E1:E'.$spreadsheet->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true); 
    
    //set text overflow for all column
    $spreadsheet->getDefaultStyle()->getAlignment()->setWrapText(true);

    //set text top align
    $spreadsheet->getDefaultStyle()->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

    //clear potential html data that should not be included in the file
    ob_clean(); 
    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');

    //save to pc
    $writer->save('php://output');
    //save to temp folder
    $writer->save('../Requires/temp/'.urlencode($fileName));

}else{
    echo  "No Data Available";
}


?>