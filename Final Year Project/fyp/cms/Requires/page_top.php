<?php
include "Connect/connect.php";

if(isset($_COOKIE['admin_session'])){
    $idTmp = $_COOKIE['admin_id'];
}

$adminResult = $mysqli->query("SELECT * FROM system_admin WHERE admin_id = '".$idTmp."' AND admin_trash = 0");
if(mysqli_num_rows($adminResult)){
    $rowAdmin = mysqli_fetch_assoc($adminResult);
}


//get current file name without extension
$filename = basename($_SERVER['PHP_SELF']);
$without_extension = substr($filename, 0, strrpos($filename, "."));

$html_top = '


<aside class="left-panel">
    <div class="user text-center">
        <img src="Images/toucan(white).png" />
        <h4 class="user-name">Company ABC</h4>
        <div class="dropdown user-login">
        	<button class="btn btn-xs dropdown-toggle btn-rounded" type="button" data-toggle="dropdown" aria-expanded="true">
        		<i class="fa fa-circle status-icon available"></i> Active 
        	</button>
            
        </div>
    </div>
    <nav class="navigation">
        <ul class="list-unstyled">
        	<li class="has-submenu '.($without_extension == "index" ? "active" : "").'"><a href="index.php"><i class="fa fa-tachometer"></i> <span class="nav-label">Dashboard</span></a>
        	</li>
			<li class="has-submenu '.($without_extension == "feedback" ? "active" : "").'"><a href="feedback.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="nav-label">User Feedback</span></a>
			</li>
			<li class="has-submenu '.($without_extension == "user" ? "active" : "").'"><a href="user.php"><i class="fa fa-briefcase"></i> <span class="nav-label">Users</span></a>
			</li> 
            <li class="has-submenu '.($without_extension == "admin" ? "active" : "").'"><a href="admin.php"><i class="fa fa-user" aria-hidden="true"></i> <span class="nav-label">Admins</span></a>
			</li> 
            <li class="has-submenu '.($without_extension == "logout" ? "active" : "").'"><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> <span class="nav-label">Logout</span></a>
			</li> 
        </ul>
    </nav>
</aside>
';

$html_top .= '

<section class="content">
<header class="top-head container-fluid" style="position:sticky;top: 0;z-index: 999;background: linear-gradient(170deg, rgb(255, 255, 255) 0%, #d8e2fc 100%);">
    <button type="button" class="navbar-toggle pull-left" style="visibility:visible">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <div style="float:right;">
        
        <img src="../Images/user.png" style="border-radius:50%;width:50px;height:50px;"/>&nbsp;&nbsp;&nbsp;
        <div style="float:right; margin-top: 5px;font-family:Libre Franklin, sans-serif"><span style="color:#757fef;">Admin</span> <br/> <span style="font-weight:bold;font-size:14px">'.$rowAdmin['admin_username'].'</span></div>
    </div>
    <div class="dateColumn" style="float:right;width:200px;    border: 1px solid #757fef;border-radius: 4px;font-size: 15px;padding: 11px 15px 11px 38px;color:#757fef;font-weight:600;margin-right:15px;"><i class="fa fa-calendar" aria-hidden="true"></i>   '.date("d F Y").'</div>
</header>';

echo $html_top ;