<?php
include 'Connect/connect.php' ;
include 'Requires/header.php' ;
echo '
<script type="text/javascript">
$(document).on("click","#cancel_button",function(){
    javascript:parent.jQuery.fancybox.close();
});
$(function () {
          
    $("#userContact").keydown(function (e) {
      var key = e.charCode || e.keyCode || 0;
      $text = $(this);
      if (key !== 8 && key !== 9) {
          if ($text.val().length === 0) {
            $text.val($text.val() + "+6");
          }
          if ($text.val().length === 5) {
              $text.val($text.val() + " ");
          }
          if ($text.val().length === 9) {
              $text.val($text.val() + " ");
          }
      }
      return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        });

    });

</script>';

echo '
<form method="POST">
<div class="warper container-fluid">   	
    <div class="page-header"><h1>Admin<small>Add</small> <li class="mcus1_li2"> <i class="fa fa-times image_new_close" onClick="javascript:parent.location.reload(true);parent.jQuery.fancybox.close();"></i> </li></h1></div>
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">Username <span style="color:red">*</span></span>
                        <input type="text" name="userName" class="form-control" placeholder="Username" required>
                    </div><br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">Password <span style="color:red">*</span></span>
                        <input type="password" name="userPassword" class="form-control" placeholder="Password" required>
                    </div><br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">Full Name</span>
                        <input type="text" name="userFullName" class="form-control" placeholder="Full Name">
                    </div><br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">Contact No.</span>
                        <input type="text" maxlength="15" name="userContact" class="form-control" id="userContact" placeholder="Contact No.">
                    </div><br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">Email Address <span style="color:red">*</span></span>
                        <input type="email" name="userEmail" class="form-control" placeholder="Email Address" required>
                    </div><br>
                </div>
            </div>
        </div>
        <div class="form-group">

            <label class="col-sm-1 control-label"></label>

            <div class="col-sm-11" style="padding-right: 0">

                <button type="button" class="btn" id="cancel_button" style="background-color:rgb(59,130,246);border-color:rgb(59,130,246);color:#fff;float:right">Cancel</button>
                <span style="float:right">&nbsp;&nbsp;&nbsp;</span>
                <button type="submit" class="btn" style="background-color:rgb(59,130,246);border-color:rgb(59,130,246);color:#fff;float:right">Submit</button>

            </div>

        </div>
    </div>
</div>
</form> 
</body>
</html>';
if(isset($_POST) && !empty($_POST)){
    $userResult = $mysqli->query("SELECT * FROM system_admin WHERE admin_username = '".$_POST['userName']."'AND admin_trash = 0");
    if(mysqli_num_rows($userResult) > 0){
        echo "<script>toastr.error('Username existed')</script>";
    }else{
        $mysqli->query("INSERT INTO system_admin(admin_username,admin_fullname,admin_password,admin_contact,admin_email,admin_trash) VALUES('".$_POST['userName']."','".$_POST['userFullName']."','".md5($_POST['userPassword'])."','".$_POST['userContact']."','".$_POST['userEmail']."','0')");
        echo '<script>toastr.success("Thank you, your information has been inserted")</script>';
    }
}
   

?>