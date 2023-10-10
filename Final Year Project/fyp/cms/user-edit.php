<?php
include 'Connect/connect.php' ;
include 'Requires/header.php' ;
$id = $_GET['id'];

$user = $mysqli->query("SELECT * FROM system_user WHERE user_id = '".$id."' ");
if(mysqli_num_rows($user)>0){
    $rowUser = $user->fetch_assoc();
}
include 'Requires/page_top.php' ;
echo '
<script type="text/javascript">
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

echo '<div class="warper container-fluid">  

<!--Title-->
<div class="page-header"><h1>User<small>Edit</small></div>
<!--Title-->

<!--Content Area-->
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form">
                <div class="form-group">
                
                    <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div>
                    <input type="text" class="form-control" id="search" placeholder="Search">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            
            <a class="fancybox_iframe fancybox btn btn-purple"  data-fancybox-type="iframe" href="user-new.php">Add New</a>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <div id="basic-datatable_wrapper" class="dataTables_wrapper form-horizontal dt-bootstrap no-footer">
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table cellpadding="0" cellspacing="0" border="0" class="responsive table table-striped table-bordered dataTable no-footer" id="basic-datatable" role="grid">
                            <thead >
                                <tr role="row">
                                    <th rowspan="1" colspan="1">No.</th>
                                    <th rowspan="1" colspan="1">Image</th>
                                    <th rowspan="1" colspan="1">Full Name</th>
                                    <th rowspan="1" colspan="1">Userame</th>
                                    <th rowspan="1" colspan="1">Description</th>
                                    <th rowspan="1" colspan="1">Contact No.</th>
                                    <th rowspan="1" colspan="1">Email Address</th>
                                    <th rowspan="1" colspan="1">Facebook Link</th>
                                    <th rowspan="1" colspan="1">Twitter Link</th>
                                    <th rowspan="1" colspan="1">Date of Birth</th>
                                    <th rowspan="1" colspan="1">Language</th>
                                    <th rowspan="1" colspan="1">Skills</th>
                                    <th rowspan="1" colspan="1">Created Date</th>
                                    <th rowspan="1" colspan="1">Action</th>
                                </tr>
                            </thead>
                            <tbody id="appendResult">
                                <tr role="row">
                                    <td rowspan="1" colspan="14">No data available</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--Content Area-->

</div>';
include 'Requires/page_footer.php' ;
?>