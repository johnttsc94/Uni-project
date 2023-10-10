<?php
include 'Requires/session.php' ;
include 'Requires/header.php' ;
?>
<script type="text/javascript">
$(document).ready(function(){ 
    $(".fancybox").fancybox({
        "width"  : 900,           // set the width
        "height" : 500,           // set the height
        "type"   : "iframe"       // tell the script to create an iframe
    });
    $(".fancybox").fancybox({
            afterClose: function () { 
                parent.location.reload(true);
            }
        });
    var html = '';
    $.ajax({
        url: 'Requires/ajax_admin.php', 
        type: 'POST',
        data:{'type':'all'},
        dataType: 'JSON',
        success: function(result){
            $.each(result,function(c,v){
                        var index = c+1;
                        if(v['admin_id'] != ''){
                            html += '<tr class="gradeX" role="row">';
                            html += '<td class="align_center">'+index+'</td>';
                            html += '<td class="align_center">'+v['admin_username']+'</td>';
                            html += '<td class="align_center">'+v['admin_fullname']+'</td>';
                            html += '<td class="align_center">'+v['admin_contact']+'</td>';
                            html += '<td class="align_center">'+v['admin_email']+'</td>';
                            // html += '<td class="align_center"" data-id = "'+v['admin_id']+'"><a class="fancybox_iframe fancybox"  data-fancybox-type="iframe" href="admin-edit.php?id='+v['admin_id']+'"><i class="fa fa-edit"></i></a><span class="order_print_span">|</span><a class="trash" href="#"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
                            html += '<td class="align_center"" data-id = "'+v['admin_id']+'"><a class="fancybox_iframe fancybox"  data-fancybox-type="iframe" href="admin-edit.php?id='+v['admin_id']+'"><button class="btn btn-success" type="button">Edit</button></a><span class="order_print_span" style="margin:0 4px"></span><a class="trash" href="#"><button class="btn btn-purple" type="button">Delete</button></a></td>';
                            html += '</tr>';
                        }else{
                            html += '<tr class="gradeX" role="row">';
                            html += '<td colspan="6">No data available</td>';
                            html += '</tr>';
                        }
                    
                    });
            $('#appendResult').html(html);
        }
    });
});
$(document).on('keyup','#search',function(){
            event.preventDefault();
            var html = '';
            var keyword = $(this).val();
            $.ajax({
                url: "Requires/ajax_admin.php", 
                type: "POST",
                data: {'keyword' : keyword , 'type':'search'},
                dataType: 'JSON',
                success: function(result){
                    $.each(result,function(c,v){
                        var index = c+1;
                        if(v['admin_id'] != ''){
                            html += '<tr class="gradeX" role="row" >';
                            html += '<td class="align_center">'+index+'</td>';
                            html += '<td class="align_center">'+v['admin_username']+'</td>';
                            html += '<td class="align_center">'+v['admin_fullname']+'</td>';
                            html += '<td class="align_center">'+v['admin_contact']+'</td>';
                            html += '<td class="align_center">'+v['admin_email']+'</td>';
                            // html += '<td class="align_center"" data-id = "'+v['admin_id']+'"><a class="fancybox_iframe fancybox"  data-fancybox-type="iframe" href="admin-edit.php?id='+v['admin_id']+'"><i class="fa fa-edit"></i></a><span class="order_print_span">|</span><a class="trash" href="#"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
                            html += '<td class="align_center"" data-id = "'+v['admin_id']+'"><a class="fancybox_iframe fancybox"  data-fancybox-type="iframe" href="admin-edit.php?id='+v['admin_id']+'"><button class="btn btn-success" type="button">Edit</button></a><span class="order_print_span" style="margin:0 4px"></span><a class="trash" href="#"><button class="btn btn-purple" type="button">Delete</button></a></td>';
                            html += '</tr>';
                        }else{
                            html += '<tr class="gradeX" role="row">';
                            html += '<td colspan="6">No data available</td>';
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
                    url: "Requires/ajax_admin.php", 
                    data: {'id':id , 'type':'delete'},
                    type: "POST",
                    success: function(result){
                        toastr.success('Thank you, your information has been deleted successful')
                        setTimeout(function () {
                            location.href = 'admin.php';
                        }, 500);
                    }
                });
            });
           
</script>
<?php
include 'Requires/page_top.php' ;
echo ' 
<div class="warper container-fluid">  

    <!--Title-->
    <div class="page-header"><h1>Admin<small>List</small></div>
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
                
                <a class="fancybox_iframe fancybox btn" style="background-color:rgb(59,130,246);border-color:rgb(59,130,246);color:#fff"  data-fancybox-type="iframe" href="admin-new.php">Add New</a>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <div id="basic-datatable_wrapper" class="dataTables_wrapper form-horizontal dt-bootstrap no-footer" style="max-height:600px;overflow-y:auto">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table cellpadding="0" cellspacing="0" border="0" class="responsive table table-striped table-bordered dataTable no-footer" id="basic-datatable" role="grid">
                                <thead >
                                    <tr role="row">
                                        <th rowspan="1" colspan="1">No.</th>
                                        <th rowspan="1" colspan="1">Username</th>
                                        <th rowspan="1" colspan="1">Full Name</th>
                                        <th rowspan="1" colspan="1">Contact No.</th>
                                        <th rowspan="1" colspan="1">Email Address</th>
                                        <th rowspan="1" colspan="1">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="appendResult">
                                    <tr role="row">
                                        <td rowspan="1" colspan="6">No data available</td>
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