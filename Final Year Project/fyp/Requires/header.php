<head>
        
        
        <meta charset="utf-8" />
        <?php
        //get current file name without extension
        $filename = basename($_SERVER['PHP_SELF']);
        $without_extension = substr($filename, 0, strrpos($filename, "."));
        switch($without_extension){
            case "sign-up":
                $title = "Sign Up | Company ABC";
                break;
            case "sign-in":
                $title = "Sign In | Company ABC";
                break;
            case "sign-out":
                $title = "Sign Out | Company ABC";
                break;
            case "reset-password":
                $title = "Reset Password | Company ABC";
                break;
            case "profile":
                $title = "My Profile | Company ABC";
                break;
            case "404-error":
                $title = "Error 404 | Company ABC";
                break;
            case "privacy-policy":
                $title = "Privacy & Policy | Company ABC";
                break;
            case "sign-out":
                $title = "Sign Out | Company ABC";
                break;
            case "contact":
                $title = "Contact | Company ABC";
                break;
            case "services":
                $title = "Services | Company ABC";
                break;
            case "about":
                $title = "About Us | Company ABC";
                break;
            default:
                $title = "Company ABC";
        }
        ?>
        <title><?=$title?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content=" " />
        <meta name="keywords" content="" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="Images/logo.ico">

        <!-- Choise Css -->
        <link rel="stylesheet" href="Css/choices.min.css">

        <!--Font Awesome Js-->
        <script src="Scripts/font-awesome.js" crossorigin="anonymous"></script>

        <!-- Bootstrap Css -->
        <link href="Css/bootstrap-blue.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="Css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css -->
        <link href="Css/app-blue.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <!-- Custom Css -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates&display=swap" rel="stylesheet">

        <!-- jQuery library -->
        <script src="Scripts/jQuery-v3.6.1.js"></script>

        <!--Toastr Notification-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <!-- Custom Script -->
        <script type="text/javascript" src="Scripts/all.js"></script>

</head>