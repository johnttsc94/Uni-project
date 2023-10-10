<?php
include 'Requires/session.php' ;
include "Plug-ins/PhpMailer/class.phpmailer.php";
include "Plug-ins/PhpMailer/class.smtp.php";
include 'Requires/header.php' ;
include "Connect/connect.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
}
?>
<script type="text/javascript">
$(document).ready(function(){ 
    
    var html = '';
    $.ajax({
        url: 'Requires/ajax_feedback.php', 
        type: 'POST',
        data:{'type':'all'},
        dataType: 'JSON',
        success: function(result){
            $.each(result,function(c,v){
                        var index = c+1;
                        if(v['feedback_id'] != ''){
                            if(v['feedback_status'] == '1'){
                                // var status = "<span style='color:green;'>Replied</span>";
                                var status = "<span class='badge' style='background-color: rgba(10,192,116,.18);color: #0ac074;'>Replied</button>";
                            }else{
                                // var status = "<span style='color:red;'>Not Replied</span>";
                                var status = "<span class='badge' style='background-color: rgba(255,61,96,.18);color: #ff3d60;'>Not Replied</button>";
                            }
                            html += '<tr class="gradeX" role="row">';
                            html += '<td class="align_center">'+index+'</td>';
                            html += '<td class="align_center">'+v['feedback_name']+'</td>';
                            html += '<td class="align_center">'+v['feedback_email']+'</td>';
                            html += '<td class="align_center">'+v['feedback_subject']+'</td>';
                            html += '<td class="align_center">'+v['feedback_message']+'</td>';
                            html += '<td class="align_center">'+status+'</td>';
                            // html += '<td class="align_center"" data-id = "'+v['feedback_id']+'"><a href="feedback.php?mode=edit&id='+v['feedback_id']+'"><i class="fa fa-edit"></i></a><span class="order_print_span">|</span><a class="trash" href="#"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
                            // html += '</tr>';
                            html += '<td class="align_center"" data-id = "'+v['feedback_id']+'"><a href="feedback.php?mode=edit&id='+v['feedback_id']+'"><button class="btn btn-success" type="button">Edit</button></a><span class="order_print_span" style="margin:0 4px"></span><a class="trash" href="#"><button class="btn btn-purple" type="button">Delete</button></a></td>';
                            // html += '</tr>';
                        }else{
                            html += '<tr class="gradeX" role="row">';
                            html += '<td colspan="7">No data available</td>';
                            html += '</tr>';
                        }
                    
                    });
            $('#appendResult').html(html);
        }
    });
    $("#add-button").click(function(){
        $("#reply-button").removeClass("hidden");
        $("#reply-text").removeClass("hidden");
        $("#seperator").removeClass("hidden");
        $("#add-button").addClass("hidden");
    });
    $("#cancel-reply").click(function(){
        $("#reply-button").addClass("hidden");
        $("#reply-text").addClass("hidden");
        $("#seperator").addClass("hidden");
        $("#add-button").removeClass("hidden");
        $("#reply-text-message").val("");
    });
});
$(document).on('keyup','#search',function(){
            event.preventDefault();
            var html = '';
            var keyword = $(this).val();
            $.ajax({
                url: "Requires/ajax_feedback.php", 
                type: "POST",
                data: {'keyword' : keyword , 'type':'search'},
                dataType: 'JSON',
                success: function(result){
                    $.each(result,function(c,v){
                        var index = c+1;
                        if(v['feedback_id'] != ''){
                            if(v['feedback_status'] == '1'){
                                // var status = "<span style='color:green;'>Replied</span>";
                                var status = "<span class='badge' style='background-color: rgba(10,192,116,.18);color: #0ac074;'>Replied</button>";
                            }else{
                                // var status = "<span style='color:red;'>Not Replied</span>";
                                var status = "<span class='badge' style='background-color: rgba(255,61,96,.18);color: #ff3d60;'>Not Replied</button>";
                            }
                            html += '<tr class="gradeX" role="row">';
                            html += '<td class="align_center">'+index+'</td>';
                            html += '<td class="align_center">'+v['feedback_name']+'</td>';
                            html += '<td class="align_center">'+v['feedback_email']+'</td>';
                            html += '<td class="align_center">'+v['feedback_subject']+'</td>';
                            html += '<td class="align_center">'+v['feedback_message']+'</td>';
                            html += '<td class="align_center">'+status+'</td>';
                            // html += '<td class="align_center"" data-id = "'+v['feedback_id']+'"><a href="feedback.php?mode=edit&id='+v['feedback_id']+'"><i class="fa fa-edit"></i></a><span class="order_print_span">|</span><a class="trash" href="#"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
                            // html += '</tr>';
                            html += '<td class="align_center"" data-id = "'+v['feedback_id']+'"><a href="feedback.php?mode=edit&id='+v['feedback_id']+'"><button class="btn btn-success" type="button">Edit</button></a><span class="order_print_span" style="margin:0 4px"></span><a class="trash" href="#"><button class="btn btn-purple" type="button">Delete</button></a></td>';
                        }else{
                            html += '<tr class="gradeX" role="row">';
                            html += '<td colspan="7">No data available</td>';
                            html += '</tr>';
                        }
                    
                    });
                
                    $('#appendResult').html(html);
            }
            
            });
        });
        $(document).on('click','.trash',function(e){
                e.preventDefault();
                var parent = $(this).parent('td');
                var id = parent.data('id');
                $.ajax({
                    url: "Requires/ajax_feedback.php", 
                    data: {'id':id , 'type':'delete'},
                    type: "POST",
                    success: function(result){
                        alert('Succes');
                    }
                });
                location.reload();
            });
           
</script>
<?php
include 'Requires/page_top.php' ;
if(isset($_GET['mode']) && $mode == "edit"){
    if(isset($_POST['submit']) && !empty($_POST['reply'])){

        $stmt = $mysqli->prepare("UPDATE system_user_feedback SET feedback_replied_message = ? WHERE feedback_id = '".$id."'");
        $stmt->bind_param('s',$_POST['reply']);
        $status1 = $stmt->execute();

        $feedResult = $mysqli->query("SELECT * FROM system_user_feedback WHERE feedback_id = '".$id."' AND feedback_trash = 0");
        if(mysqli_num_rows($feedResult) > 0){
            $rowFeedback = $feedResult->fetch_assoc();
        }
        //send email
        $email_title   = 'RE: '.$rowFeedback['feedback_subject'] ;
        $email_body    = $_POST['reply'] ;
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
        $email->addAddress($rowFeedback['feedback_email']);
        $status2 = $result = $email->Send() ;

        if($status1 == true && $status1 == true){
           $mysqli->query("UPDATE system_user_feedback SET feedback_status = '1' WHERE feedback_id = '".$id."'");
           echo '<script>toastr.success("Thank you, your email has been sent")</script>';
        }
    }
    $feedResult = $mysqli->query("SELECT * FROM system_user_feedback WHERE feedback_id = '".$id."' AND feedback_trash = 0");
    if(mysqli_num_rows($feedResult) > 0){
        $rowFeedback = $feedResult->fetch_assoc();
    
    echo ' 
    <div class="warper container-fluid">  
    
        <!--Title-->
        <div class="page-header"><h1>Feedback<small>Management</small></div>
        <!--Title-->

        <form method="post" class="form-horizontal" id="productForm" enctype="multipart/form-data" action="feedback.php?mode=edit&id='.$id.'" novalidate="novalidate">

            <div class="row">
                <div class="col-md-12">
                    <!--Content Area-->
                
                    <div class="panel panel-default">
                        <div class="panel-heading"></div>
                        <div class="panel-body">
                            <a href="feedback.php" class="btn float_left" style="background-color: rgb(59,130,246);border-color: rgb(59,130,246);color: #fff;">Back</a>							
                        </div>
                    </div>
                
                        <div class="panel panel-default">
                            <div class="panel-heading"></div>
                                <div class="panel-body">
                                    <div class="main_input">
                                        <div class="tab-content disable_relative" style="display:block;">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Sender Name : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control ui-search-input" value="'.$rowFeedback['feedback_name'].'" placeholder="Sender Name" readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Sender Email : </label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control ui-search-input" value="'.$rowFeedback['feedback_email'].'" placeholder="Sender Email" readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Email Subject : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control ui-search-input" value="'.$rowFeedback['feedback_subject'].'" placeholder="Email Subject" required="" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Sender Message : </label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" rows="5" readonly>'.$rowFeedback['feedback_message'].'</textarea>
                                                </div>
                                            </div>
                                            ';
                                            if($rowFeedback['feedback_status'] == "0"){
                                                echo '<div class="form-group" id="add-button">
                                                <label class="col-sm-2 control-label"></label>
                                                <div class="col-sm-9">
                                                <button class="btn" style="float:right;background-color: rgb(59,130,246);border-color: rgb(59,130,246);color: #fff;" type="button" value="add-reply">Add Reply</button>
                                                </div>
                                            </div>
                                            <hr id="seperator" class="hidden"/>

                                            <div class="form-group hidden" id="reply-text">
                                                <label class="col-sm-2 control-label">Reply : </label>
                                                <div class="col-sm-9">
                                                        <textarea class="form-control" id="reply-text-message" rows="5" name="reply"></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group hidden" id="reply-button">
                                                <label class="col-sm-2 control-label"></label>
                                                <div class="col-sm-9">
                                                <button class="btn" id="cancel-reply" type="button" value="cancel-reply" style="float:right;background-color: rgb(59,130,246);border-color: rgb(59,130,246);color: #fff;">Cancel</button><span style="float:right">&nbsp;&nbsp;&nbsp;</span>
                                                <button class="btn" style="background-color: rgb(59,130,246);border-color: rgb(59,130,246);color: #fff;" type="submit" name="submit" value="send-reply" style="float:right">Send Reply</button>
                                                </div>
                                            </div>';
                                            }else{
                                                echo '<hr/>

                                                <div class="form-group" id="reply-text">
                                                    <label class="col-sm-2 control-label">Replied Message : </label>
                                                    <div class="col-sm-9">
                                                            <textarea class="form-control" id="reply-text-message" rows="5" readonly>'.$rowFeedback['feedback_replied_message'].'</textarea>
                                                    </div>
                                                </div>
                                                ';
                                            }
                                            
                                            echo'
                                            
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    <!--Content Area-->
                </div>
            </div>
        </form>
    </div>';
    }
}else{
        echo ' 
    <div class="warper container-fluid">  

        <!--Title-->
        <div class="page-header"><h1>User Feedback<small>List</small></div>
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
<!--
            <div class="panel panel-default">
                <div class="panel-body">
                    
                    <a class="fancybox_iframe fancybox btn" style="background-color: rgb(59,130,246);border-color: rgb(59,130,246);color: #fff;"  data-fancybox-type="iframe" href="admin-new.php">Reply</a>
                </div>
            </div>
-->
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="basic-datatable_wrapper" class="dataTables_wrapper form-horizontal dt-bootstrap no-footer" style="max-height:600px;overflow-y:auto">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table cellpadding="0" cellspacing="0" border="0" class="responsive table table-striped table-bordered dataTable no-footer" id="basic-datatable" role="grid">
                                    <thead >
                                        <tr role="row">
                                            <th rowspan="1" colspan="1">No.</th>
                                            <th rowspan="1" colspan="1">Sender Name</th>
                                            <th rowspan="1" colspan="1">Sender Email Address</th>
                                            <th rowspan="1" colspan="1">Email Subject</th>
                                            <th rowspan="1" colspan="1">Email Message</th>
                                            <th rowspan="1" colspan="1">Feedback Status</th>
                                            <th rowspan="1" colspan="1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="appendResult">
                                        <tr role="row">
                                            <td rowspan="1" colspan="7">No data available</td>
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
}
include 'Requires/page_footer.php' ;
?>