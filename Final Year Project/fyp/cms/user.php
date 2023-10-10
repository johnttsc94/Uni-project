<?php
include 'Requires/session.php' ;
include 'Requires/header.php' ;
include "Connect/connect.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
}
if(isset($_GET['mode']) && $mode == "export"){
    include "Includes/export-user.php";
    exit();
}
?>
<script type="text/javascript">
$(document).ready(function(){ 
    $(".fancybox").fancybox({
        "width"  : 900,           // set the width
        "height" : 500,           // set the height
        "type"   : "iframe"       // tell the script to create an iframe
    });
    var html = '';
    $.ajax({
        url: 'Requires/ajax_user.php', 
        type: 'POST',
        data:{'type':'all'},
        dataType: 'JSON',
        success: function(result){
            $.each(result,function(c,v){
                        var index = c+1;
                        if(v['user_id'] != ''){

                            //Get user education info
                            var edu_content = "";
                            if(v['user_edu_title'] != ""){
                                var edu_title = v['user_edu_title'].split("//@@//");
                                var edu_start = v['user_edu_start'].split("//@@//");
                                var edu_end = v['user_edu_end'].split("//@@//");
                                var edu_present = v['user_edu_present'].split("//@@//");
                                var edu_institute = v['user_edu_institute'].split("//@@//");
                                var edu_description = v['user_edu_description'].split("//@@//");
                                let i = 0;
                                while (i < edu_title.length) {
                                    if(edu_title[i] != ""){
                                        edu_content += "Title: "+edu_title[i];
                                        edu_content += "<br/>Start Date: "+edu_start[i];
                                        if(edu_present[i] == "1"){
                                            edu_content += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End Date: Present";
                                        }else{
                                            edu_content += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End Date: "+edu_end[i];
                                        }
                                        edu_content += "<br/>Institute: "+edu_institute[i];
                                        edu_content += "<br/>Description: "+edu_description[i];
                                        if(i < edu_title.length-2){
                                            edu_content += "<hr style='height:1px;border:none;color:#333;background-color:#333;'/>";
                                        }
                                        
                                    }else{
                                        // edu_content = "--N/A--";
                                    }
                                    i++;
                                }
                            }else{
                                edu_content = "--N/A--";
                            }

                            //Get user experience info
                            var exp_content = "";
                            if(v['user_exp_title'] != ""){
                                var exp_title = v['user_exp_title'].split("//@@//");
                                var exp_start = v['user_exp_start'].split("//@@//");
                                var exp_end = v['user_exp_end'].split("//@@//");
                                var exp_present = v['user_exp_present'].split("//@@//");
                                var exp_institute = v['user_exp_institute'].split("//@@//");
                                var exp_description = v['user_exp_description'].split("//@@//");

                                let j = 0;
                                while (j < exp_title.length) {
                                    if(exp_title[j] != ""){
                                        exp_content += "Title: "+exp_title[j];
                                        exp_content += "<br/>Start Date: "+exp_start[j];
                                        if(exp_present[j] == "1"){
                                            exp_content += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End Date: Present";
                                        }else{
                                            exp_content += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End Date: "+exp_end[j];
                                        }
                                        exp_content += "<br/>Institute: "+exp_institute[j];
                                        exp_content += "<br/>Description: "+exp_description[j];
                                        if(j < exp_title.length-2){
                                            exp_content += "<hr style='height:1px;border:none;color:#333;background-color:#333;'/>";
                                        }
                                        
                                    }else{
                                        //exp_content = "--N/A--";
                                    }
                                    j++;
                                }
                            }else{
                                exp_content = "--N/A--";
                            }

                            //Get user abilities info
                            var ab_content = "";
                            if(v['user_ab_title'] != ""){
                                var ab_title = v['user_ab_title'].split("//@@//");
                                var ab_index = v['user_ab_index'].split("//@@//");
                                
                                let k = 0;
                                while (k < ab_title.length) {
                                    if(ab_title[k] != ""){
                                        ab_content += "Title: "+ab_title[k]+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Index: "+ab_index[k]; 
                                        if(k < ab_title.length-2){
                                                ab_content += "<hr style='height:1px;border:none;color:#333;background-color:#333;'/>";
                                        }
                                    }else{
                                        //ab_content = "--N/A--";
                                    }
                                    k++;
                                }

                            }else{
                                ab_content = "--N/A--";
                            }

                            var genderText = "";
                            if(v['user_gender'] == "M"){
                                genderText = "Male"
                            }else if(v['user_gender'] == "F"){
                                genderText = "Female"
                            }else if(v['user_gender'] == "E"){
                                genderText = "Other"
                            }else{
                                genderText = "N/A"
                            }

                            var cv_name = "";
                            if(v['user_cv'] == null){
                                cv_name = ""
                            }else{
                                cv_name = v['user_cv'];
                            }
                            
                            if(v['user_image'] == ""){
                                img_name = "user.png"
                            }else{
                                img_name = v['user_image']
                            }
                            
                            html += '<tr class="gradeX" role="row" >';
                            html += '<td class="align_center">'+index+'</td>';
                            html += '<td class="align_center"><image width="150px" height="150px" src ="../Images/'+img_name+'"</image></td>';
                            html += '<td class="align_center">'+v['user_username']+'</td>';
                            html += '<td class="align_center">'+v['user_fname']+' '+v['user_lname']+'</td>';
                            html += '<td class="align_center">'+genderText+'</td>';
                            html += '<td class="align_center">'+v['user_dob']+'</td>';
                            html += '<td class="align_center">'+v['user_language']+'</td>';
                            html += '<td class="align_center"><div style=" width: 300px;word-break: break-word;white-space: normal;text-align:justify">'+v['user_address']+'</div></td>';
                            html += '<td class="align_center">'+v['user_country']+'</td>';
                            html += '<td class="align_center"><div style=" width: 300px;word-break: break-word;white-space: normal;text-align:justify">'+v['user_profile']+'</div></td>';
                            html += '<td class="align_center">'+v['user_skill']+'</td>';
                            html += '<td class="align_center">'+v['user_business']+'</td>';
                            html += '<td class="align_center">'+cv_name+'</td>';
                            html += '<td ><div style=" width: 300px;word-break: break-word;white-space: normal;text-align:justify">'+edu_content+'</div></td>';
                            html += '<td ><div style=" width: 300px;word-break: break-word;white-space: normal;text-align:justify">'+exp_content+'</div></td>';
                            html += '<td ><div style=" width: 300px;word-break: break-word;white-space: normal;text-align:justify">'+ab_content+'</div></td>';
                            html += '<td class="align_center"><a href="'+v['user_facebook']+'" target="_blank">'+v['user_facebook']+'</a></td>';
                            html += '<td class="align_center"><a href="'+v['user_twitter']+'" target="_blank">'+v['user_twitter']+'</a></td>';
                            html += '<td class="align_center">'+v['user_phone']+'</td>';
                            html += '<td class="align_center">'+v['user_email']+'</td>';
                            html += '<td class="align_center"><a href="'+v['user_vlink']+'" target="_blank">'+v['user_vlink']+'</a></td>';
                            html += '<td class="align_center">'+v['user_createdDate']+'</td>';
                            html += '<td class="align_center"" data-id = "'+v['user_id']+'"><a href="user.php?mode=edit&id='+v['user_id']+'"><button class="btn btn-success" type="button">Edit</button></a><span class="order_print_span" style="margin:0 4px"></span><a class="trash" href="#"><button class="btn btn-purple" type="button">Delete</button></a></td>';
                            html += '</tr>';
                        }else{
                            html += '<tr class="gradeX" role="row">';
                            html += '<td colspan=23">No data available</td>';
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
                url: "Requires/ajax_user.php", 
                type: "POST",
                data: {'keyword' : keyword , 'type':'search'},
                dataType: 'JSON',
                success: function(result){
                    $.each(result,function(c,v){
                        var index = c+1;
                        if(v['user_id'] != ''){

                            //Get user education info
                            var edu_content = "";
                            if(v['user_edu_title'] != ""){
                                var edu_title = v['user_edu_title'].split("//@@//");
                                var edu_start = v['user_edu_start'].split("//@@//");
                                var edu_end = v['user_edu_end'].split("//@@//");
                                var edu_present = v['user_edu_present'].split("//@@//");
                                var edu_institute = v['user_edu_institute'].split("//@@//");
                                var edu_description = v['user_edu_description'].split("//@@//");
                                let i = 0;
                                while (i < edu_title.length) {
                                    if(edu_title[i] != ""){
                                        edu_content += "Title: "+edu_title[i];
                                        edu_content += "<br/>Start Date: "+edu_start[i];
                                        if(edu_present[i] == "1"){
                                            edu_content += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End Date: Present";
                                        }else{
                                            edu_content += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End Date: "+edu_end[i];
                                        }
                                        edu_content += "<br/>Institute: "+edu_institute[i];
                                        edu_content += "<br/>Description: "+edu_description[i];
                                        if(i < edu_title.length-2){
                                            edu_content += "<hr style='height:1px;border:none;color:#333;background-color:#333;'/>";
                                        }
                                        
                                    }else{
                                        // edu_content = "--N/A--";
                                    }
                                    i++;
                                }
                            }else{
                                edu_content = "--N/A--";
                            }
                            
                            

                           //Get user experience info
                           var exp_content = "";
                            if(v['user_exp_title'] != ""){
                                var exp_title = v['user_exp_title'].split("//@@//");
                                var exp_start = v['user_exp_start'].split("//@@//");
                                var exp_end = v['user_exp_end'].split("//@@//");
                                var exp_present = v['user_exp_present'].split("//@@//");
                                var exp_institute = v['user_exp_institute'].split("//@@//");
                                var exp_description = v['user_exp_description'].split("//@@//");

                                let j = 0;
                                while (j < exp_title.length) {
                                    if(exp_title[j] != ""){
                                        exp_content += "Title: "+exp_title[j];
                                        exp_content += "<br/>Start Date: "+exp_start[j];
                                        if(exp_present[j] == "1"){
                                            exp_content += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End Date: Present";
                                        }else{
                                            exp_content += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End Date: "+exp_end[j];
                                        }
                                        exp_content += "<br/>Institute: "+exp_institute[j];
                                        exp_content += "<br/>Description: "+exp_description[j];
                                        if(j < exp_title.length-2){
                                            exp_content += "<hr style='height:1px;border:none;color:#333;background-color:#333;'/>";
                                        }
                                        
                                    }else{
                                        //exp_content = "--N/A--";
                                    }
                                    j++;
                                }
                            }else{
                                exp_content = "--N/A--";
                            }

                            //Get user abilities info
                            var ab_content = "";
                            if(v['user_ab_title'] != ""){
                                var ab_title = v['user_ab_title'].split("//@@//");
                                var ab_index = v['user_ab_index'].split("//@@//");
                                
                                let k = 0;
                                while (k < ab_title.length) {
                                    if(ab_title[k] != ""){
                                    ab_content += "Title: "+ab_title[k]+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Index: "+ab_index[k]; 
                                    }else{
                                        //ab_content = "--N/A--";
                                    }
                                    k++;
                                }

                            }else{
                                ab_content = "--N/A--";
                            }

                            var genderText = "";
                            if(v['user_gender'] == "M"){
                                genderText = "Male"
                            }else if(v['user_gender'] == "F"){
                                genderText = "Female"
                            }else if(v['user_gender'] == "E"){
                                genderText = "Other"
                            }else{
                                genderText = "N/A"
                            }

                            var cv_name = "";
                            if(v['user_cv'] == null){
                                cv_name = ""
                            }else{
                                cv_name = v['user_cv'];
                            }

                            if(v['user_image'] == ""){
                                img_name = "user.png"
                            }else{
                                img_name = v['user_image']
                            }

                            html += '<tr class="gradeX" role="row" >';
                            html += '<td class="align_center">'+index+'</td>';
                            html += '<td class="align_center"><image width="150px" height="150px" src ="../Images/'+img_name+'"</image></td>';
                            html += '<td class="align_center">'+v['user_username']+'</td>';
                            html += '<td class="align_center">'+v['user_fname']+' '+v['user_lname']+'</td>';
                            html += '<td class="align_center">'+genderText+'</td>';
                            html += '<td class="align_center">'+v['user_dob']+'</td>';
                            html += '<td class="align_center">'+v['user_language']+'</td>';
                            html += '<td class="align_center"><div style=" width: 300px;word-break: break-word;white-space: normal;text-align:justify">'+v['user_address']+'</div></td>';
                            html += '<td class="align_center">'+v['user_country']+'</td>';
                            html += '<td class="align_center"><div style=" width: 300px;word-break: break-word;white-space: normal;text-align:justify">'+v['user_profile']+'</div></td>';
                            html += '<td class="align_center">'+v['user_skill']+'</td>';
                            html += '<td class="align_center">'+v['user_business']+'</td>';
                            html += '<td class="align_center">'+cv_name+'</td>';
                            html += '<td ><div style=" width: 300px;word-break: break-word;white-space: normal;text-align:justify">'+edu_content+'</div></td>';
                            html += '<td ><div style=" width: 300px;word-break: break-word;white-space: normal;text-align:justify">'+exp_content+'</div></td>';
                            html += '<td ><div style=" width: 300px;word-break: break-word;white-space: normal;text-align:justify">'+ab_content+'</div></td>';
                            html += '<td class="align_center"><a href="'+v['user_facebook']+'" target="_blank">'+v['user_facebook']+'</a></td>';
                            html += '<td class="align_center"><a href="'+v['user_twitter']+'" target="_blank">'+v['user_twitter']+'</a></td>';
                            html += '<td class="align_center">'+v['user_phone']+'</td>';
                            html += '<td class="align_center">'+v['user_email']+'</td>';
                            html += '<td class="align_center"><a href="'+v['user_vlink']+'" target="_blank">'+v['user_vlink']+'</a></td>';
                            html += '<td class="align_center">'+v['user_createdDate']+'</td>';
                            html += '<td class="align_center"" data-id = "'+v['user_id']+'"><a href="user.php?mode=edit&id='+v['user_id']+'"><button class="btn btn-success" type="button">Edit</button></a><span class="order_print_span" style="margin:0 4px"></span><a class="trash" href="#"><button class="btn btn-purple" type="button">Delete</button></a></td>';
                            html += '</tr>';
                        }else{
                            html += '<tr class="gradeX" role="row">';
                            html += '<td colspan="23">No data available</td>';
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
                    url: "Requires/ajax_user.php", 
                    data: {'id':id , 'type':'delete'},
                    type: "POST",
                    success: function(result){
                        toastr.success('Thank you, your information has been deleted successful')
                        setTimeout(function () {
                            location.href = 'user.php';
                        }, 500);
                        
                    }
                });
            });
         
        $(document).on("click","#add_edu",function(){
            var len = $(".edu_row").length
            var parent = $(this).parent().parent(".form-group");
            if(len == 0){
                len++
                var replaceOri = '<div class="form-group">'
                replaceOri += '<label class="col-sm-2 control-label"></label>'
                replaceOri += '<div class="col-sm-9">'
                replaceOri += '<button type="button" id = "add_edu" class="btn btn-primary btn-block"><i class="fa fa-plus" aria-hidden="true"></i></button>'
                replaceOri += '</div>'
                replaceOri += '</div>'
                $(this).parent().parent(".form-group").html(replaceOri);
                var container = '<div class="form-group edu_row" data-sequence="'+len+'">'
                container += '<label class="col-sm-2 control-label">Education : </label>'
                container += '<div class="col-sm-9">'
                container += '<div class="panel panel-default">'
                container += '<div class="panel-heading">'
                container += '<div class="form-group">'
                container += '<div class="col-md-11" style="font-size:16px;">Education '+len+'</div>'
                container += '<div class="col-md-1" style="font-size:16px;text-align:right">'
                container += '<a href="#" class="edu-trash">'
                container += '<input type="hidden" name="edu-trash[]" value="0">'
                container += '<input type="hidden" name="edu-id[]" value="0">'
                container += '<i style="color:red" class="fa fa-trash" aria-hidden="true"></i>'
                container += '</div>'
                container += '</a>'
                container += '</div>'
                container += '</div>'
                container += '<div class="panel-body">'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Title<span style="color:red">*</span></div>'
                container += '<div class="col-sm-11">'
                container += '<input type="text" name="edu_title[]" class="form-control ui-search-input" value="" placeholder="Education Title '+len+'" required="">'
                container += '</div>'
                container += '</div>'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Start Date</div>'
                container += '<div class="col-sm-9">'
                container += '<input type="date" name="edu_start_date[]" class="form-control ui-search-input" value="" required="">'
                container += '</div>'
                container += '<div class="col-sm-2">'
                container += '<label class="form-check-label">Present&nbsp;</label>'
                container += '<input type="hidden" name="edu_present[]" id="edu_present_'+len+'_hidden" value="0">'
                container += '<input type="checkbox" class="form-check-input edu-present" id="edu_present_'+len+'" name="edu_present[]" value="1">'
                container += '</div>'
                container += '</div>'
                container += '<div class="form-group edu_end_date_row_'+len+'">'
                container += '<div class="col-sm-1">End Date</div>'
                container += '<div class="col-sm-9">'
                container += '<input type="hidden" name="edu_end_date[]" id="edu_end_date_'+len+'_hidden" value="" disabled>'
                container += '<input type="date" name="edu_end_date[]" class="form-control ui-search-input" id="edu_end_date_'+len+'" value="" required="">'
                container += '</div>'
                container += '<div class="col-sm-2"></div>'
                container += ' </div>'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Institute</div>'
                container += '<div class="col-sm-11">'
                container += '<input type="text" name="edu_institute[]" class="form-control ui-search-input" value="" placeholder="Education Institute '+len+'" required="">'
                container += '</div>'
                container += '</div>'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Description</div>'
                container += ' <div class="col-sm-11">'
                container += '<input type="text" name="edu_description[]" class="form-control ui-search-input" value="" placeholder="Education Description '+len+'" required="">'
                container += ' </div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                
            }else{
                var seq = $(".edu_row").last().data("sequence")
                seq++
                var container = '<div class="form-group edu_row" data-sequence="'+seq+'">'
                container += '<label class="col-sm-2 control-label"></label>'
                container += '<div class="col-sm-9">'
                container += '<div class="panel panel-default">'
                container += '<div class="panel-heading">'
                container += '<div class="form-group">'
                container += '<div class="col-md-11" style="font-size:16px;">Education '+seq+'</div>'
                container += '<div class="col-md-1" style="font-size:16px;text-align:right">'
                container += '<a href="#" class="edu-trash">'
                container += '<input type="hidden" name="edu-trash[]" value="0">'
                container += '<input type="hidden" name="edu-id[]" value="0">'
                container += '<i style="color:red" class="fa fa-trash" aria-hidden="true"></i>'
                container += '</div>'
                container += '</a>'
                container += '</div>'
                container += '</div>'
                container += '<div class="panel-body">'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Title<span style="color:red">*</span></div>'
                container += '<div class="col-sm-11">'
                container += '<input type="text" name="edu_title[]" class="form-control ui-search-input" value="" placeholder="Education Title '+seq+'" required="">'
                container += '</div>'
                container += '</div>'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Start Date</div>'
                container += '<div class="col-sm-9">'
                container += '<input type="date" name="edu_start_date[]" class="form-control ui-search-input" value="" required="">'
                container += '</div>'
                container += '<div class="col-sm-2">'
                container += '<label class="form-check-label">Present&nbsp;</label>'
                container += '<input type="hidden" name="edu_present[]" id="edu_present_'+seq+'_hidden" value="0">';
                container += '<input type="checkbox" class="form-check-input edu-present" id="edu_present_'+seq+'" name="edu_present[]" value="1">'
                container += '</div>'
                container += '</div>'
                container += '<div class="form-group edu_end_date_row_'+seq+'">'
                container += '<div class="col-sm-1">End Date</div>'
                container += '<div class="col-sm-9">'
                container += '<input type="hidden" name="edu_end_date[]" id="edu_end_date_'+seq+'_hidden" value="" disabled>'
                container += '<input type="date" name="edu_end_date[]" class="form-control ui-search-input" id="edu_end_date_'+seq+'" value="" required="">'
                container += '</div>'
                container += '<div class="col-sm-2"></div>'
                container += ' </div>'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Institute</div>'
                container += '<div class="col-sm-11">'
                container += '<input type="text" name="edu_institute[]" class="form-control ui-search-input" value="" placeholder="Education Institute '+seq+'" required="">'
                container += '</div>'
                container += '</div>'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Description</div>'
                container += ' <div class="col-sm-11">'
                container += '<input type="text" name="edu_description[]" class="form-control ui-search-input" value="" placeholder="Education Description '+seq+'" required="">'
                container += ' </div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                
            }
            $(container).insertBefore(parent);
        });

        $(document).on("click",".edu-trash",function() {
            event.preventDefault()
            var parent = $(this).parents(".edu_row");
            var seq = parent.data("sequence");

            if(seq == "1"){
                parent.nextUntil(".eduButtonRow").andSelf().hide().removeClass("edu_row").find("input[name='edu-trash[]']").val("1")
                var container = '<div class="form-group eduButtonRow">';
                container += '<label class="col-sm-2 control-label">Education  : </label>';
                container += '<div class="col-sm-9">';
                container += '<button type="button" id = "add_edu" class="btn btn-primary btn-block"><i class="fa fa-plus" aria-hidden="true"></i></button>';
                container += '</div>';
                container += '</div>';
                // parent.next().replaceWith(container);
                $(document).find(".eduButtonRow").replaceWith(container);
            }else{
                parent.hide();
                parent.removeClass("edu_row");
                parent.find("input[name='edu-trash[]']").val("1");
            }
             
        });

        $(document).on("click",".edu-present",function() {
            var length = $(this).parents(".edu_row").data("sequence");
            var name = $("#edu_end_date_"+length).attr("name");
            var display = $(".edu_end_date_row_"+length).css("display");
            // console.log(".edu_end_date_row_"+length)
            // console.log(display)
            if(display == "none"){
                $("#edu_end_date_"+length).attr("name","edu_end_date[]");
                $("#edu_end_date_"+length+"_hidden").prop("disabled",true);
                $("#edu_present_"+length+"_hidden").prop("disabled",false);
                $(".edu_end_date_row_"+length).show();
            }else{
                $("#edu_end_date_"+length).attr("name","");
                $("#edu_end_date_"+length+"_hidden").prop("disabled",false);
                $("#edu_present_"+length+"_hidden").prop("disabled",true);
                $(".edu_end_date_row_"+length).hide();
                $("#edu_end_date_"+length).val("0000-00-00");
                $("#edu_end_date_"+length+"_hidden").val("0000-00-00");
            }
        });

        $(document).on("click","#add_exp",function(){
            var len = $(".exp_row").length
            var parent = $(this).parent().parent(".form-group");
            if(len == 0){
                len++
                var replaceOri = '<div class="form-group">'
                replaceOri += '<label class="col-sm-2 control-label"></label>'
                replaceOri += '<div class="col-sm-9">'
                replaceOri += '<button type="button" id = "add_exp" class="btn btn-primary btn-block"><i class="fa fa-plus" aria-hidden="true"></i></button>'
                replaceOri += '</div>'
                replaceOri += '</div>'
                $(this).parent().parent(".form-group").html(replaceOri);
                var container = '<div class="form-group exp_row" data-sequence="'+len+'">'
                container += '<label class="col-sm-2 control-label">Experience : </label>'
                container += '<div class="col-sm-9">'
                container += '<div class="panel panel-default">'
                container += '<div class="panel-heading">'
                container += '<div class="form-group">'
                container += '<div class="col-md-11" style="font-size:16px;">Experience '+len+'</div>'
                container += '<div class="col-md-1" style="font-size:16px;text-align:right">'
                container += '<a href="#" class="exp-trash">'
                container += '<input type="hidden" name="exp-trash[]" value="0">'
                container += '<input type="hidden" name="exp-id[]" value="0">'
                container += '<i style="color:red" class="fa fa-trash" aria-hidden="true"></i>'
                container += '</div>'
                container += '</a>'
                container += '</div>'
                container += '</div>'
                container += '<div class="panel-body">'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Title<span style="color:red">*</span></div>'
                container += '<div class="col-sm-11">'
                container += '<input type="text" name="exp_title[]" class="form-control ui-search-input" value="" placeholder="Experience Title '+len+'" required="">'
                container += '</div>'
                container += '</div>'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Start Date</div>'
                container += '<div class="col-sm-9">'
                container += '<input type="date" name="exp_start_date[]" class="form-control ui-search-input" value="" required="">'
                container += '</div>'
                container += '<div class="col-sm-2">'
                container += '<label class="form-check-label">Present&nbsp;</label>'
                container += '<input type="hidden" name="exp_present[]" id="exp_present_'+len+'_hidden" value="0">'
                container += '<input type="checkbox" class="form-check-input exp-present" id="exp_present_'+len+'" name="exp_present[]" value="1">'
                container += '</div>'
                container += '</div>'
                container += '<div class="form-group exp_end_date_row_'+len+'">'
                container += '<div class="col-sm-1">End Date</div>'
                container += '<div class="col-sm-9">'
                container += '<input type="hidden" name="exp_end_date[]" id="exp_end_date_'+len+'_hidden" value="" disabled>'
                container += '<input type="date" name="exp_end_date[]" class="form-control ui-search-input" id="exp_end_date_'+len+'" value="" required="">'
                container += '</div>'
                container += '<div class="col-sm-2"></div>'
                container += ' </div>'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Institute</div>'
                container += '<div class="col-sm-11">'
                container += '<input type="text" name="exp_institute[]" class="form-control ui-search-input" value="" placeholder="Experience Institute '+len+'" required="">'
                container += '</div>'
                container += '</div>'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Description</div>'
                container += ' <div class="col-sm-11">'
                container += '<input type="text" name="exp_description[]" class="form-control ui-search-input" value="" placeholder="Experience Description '+len+'" required="">'
                container += ' </div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                
            }else{
                var seq = $(".exp_row").last().data("sequence")
                seq++
                var container = '<div class="form-group exp_row" data-sequence="'+seq+'">'
                container += '<label class="col-sm-2 control-label"></label>'
                container += '<div class="col-sm-9">'
                container += '<div class="panel panel-default">'
                container += '<div class="panel-heading">'
                container += '<div class="form-group">'
                container += '<div class="col-md-11" style="font-size:16px;">Experience '+seq+'</div>'
                container += '<div class="col-md-1" style="font-size:16px;text-align:right">'
                container += '<a href="#" class="exp-trash">'
                container += '<input type="hidden" name="exp-trash[]" value="0">'
                container += '<input type="hidden" name="exp-id[]" value="0">'
                container += '<i style="color:red" class="fa fa-trash" aria-hidden="true"></i>'
                container += '</div>'
                container += '</a>'
                container += '</div>'
                container += '</div>'
                container += '<div class="panel-body">'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Title<span style="color:red">*</span></div>'
                container += '<div class="col-sm-11">'
                container += '<input type="text" name="exp_title[]" class="form-control ui-search-input" value="" placeholder="Experience Title '+seq+'" required="">'
                container += '</div>'
                container += '</div>'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Start Date</div>'
                container += '<div class="col-sm-9">'
                container += '<input type="date" name="exp_start_date[]" class="form-control ui-search-input" value="" required="">'
                container += '</div>'
                container += '<div class="col-sm-2">'
                container += '<label class="form-check-label">Present&nbsp;</label>'
                container += '<input type="hidden" name="exp_present[]" id="exp_present_'+seq+'_hidden" value="0">';
                container += '<input type="checkbox" class="form-check-input exp-present" id="exp_present_'+seq+'" name="exp_present[]" value="1">'
                container += '</div>'
                container += '</div>'
                container += '<div class="form-group exp_end_date_row_'+seq+'">'
                container += '<div class="col-sm-1">End Date</div>'
                container += '<div class="col-sm-9">'
                container += '<input type="hidden" name="exp_end_date[]" id="exp_end_date_'+seq+'_hidden" value="" disabled>'
                container += '<input type="date" name="exp_end_date[]" class="form-control ui-search-input" id="exp_end_date_'+seq+'" value="" required="">'
                container += '</div>'
                container += '<div class="col-sm-2"></div>'
                container += ' </div>'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Institute</div>'
                container += '<div class="col-sm-11">'
                container += '<input type="text" name="exp_institute[]" class="form-control ui-search-input" value="" placeholder="Experience Institute '+seq+'" required="">'
                container += '</div>'
                container += '</div>'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Description</div>'
                container += ' <div class="col-sm-11">'
                container += '<input type="text" name="exp_description[]" class="form-control ui-search-input" value="" placeholder="Experience Description '+seq+'" required="">'
                container += ' </div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                
            }
            $(container).insertBefore(parent);
        });

        $(document).on("click",".exp-trash",function() {
            event.preventDefault()
            var parent = $(this).parents(".exp_row");
            var seq = parent.data("sequence");

            if(seq == "1"){
                parent.nextUntil(".expButtonRow").andSelf().hide().removeClass("exp_row").find("input[name='exp-trash[]']").val("1")
                var container = '<div class="form-group expButtonRow">';
                container += '<label class="col-sm-2 control-label">Experience  : </label>';
                container += '<div class="col-sm-9">';
                container += '<button type="button" id = "add_exp" class="btn btn-primary btn-block"><i class="fa fa-plus" aria-hidden="true"></i></button>';
                container += '</div>';
                container += '</div>';
                // parent.next().replaceWith(container);
                $(document).find(".expButtonRow").replaceWith(container);
            }else{
                parent.hide();
                parent.removeClass("exp_row");
                parent.find("input[name='exp-trash[]']").val("1");
            }
             
        });

        $(document).on("click",".exp-present",function() {
            var length = $(this).parents(".exp_row").data("sequence");
            var name = $("#exp_end_date_"+length).attr("name");
            var display = $(".exp_end_date_row_"+length).css("display");
            // console.log(".exp_end_date_row_"+length)
            // console.log(display)
            if(display == "none"){
                $("#exp_end_date_"+length).attr("name","exp_end_date[]");
                $("#exp_end_date_"+length+"_hidden").prop("disabled",true);
                $("#exp_present_"+length+"_hidden").prop("disabled",false);
                $(".exp_end_date_row_"+length).show();
            }else{
                $("#exp_end_date_"+length).attr("name","");
                $("#exp_end_date_"+length+"_hidden").prop("disabled",false);
                $("#exp_present_"+length+"_hidden").prop("disabled",true);
                $(".exp_end_date_row_"+length).hide();
                $("#exp_end_date_"+length).val("0000-00-00");
            }
        });


        $(document).on("click","#add_ab",function(){
            var len = $(".ab_row").length
            var parent = $(this).parent().parent(".form-group");
            if(len == 0){
                len++
                var replaceOri = '<div class="form-group">'
                replaceOri += '<label class="col-sm-2 control-label"></label>'
                replaceOri += '<div class="col-sm-9">'
                replaceOri += '<button type="button" id = "add_ab" class="btn btn-primary btn-block"><i class="fa fa-plus" aria-hidden="true"></i></button>'
                replaceOri += '</div>'
                replaceOri += '</div>'
                $(this).parent().parent(".form-group").html(replaceOri);
                var container = '<div class="form-group ab_row" data-sequence="'+len+'">'
                container += '<label class="col-sm-2 control-label">Abilities : </label>'
                container += '<div class="col-sm-9">'
                container += '<div class="panel panel-default">'
                container += '<div class="panel-heading">'
                container += '<div class="form-group">'
                container += '<div class="col-md-11" style="font-size:16px;">Abilities '+len+'</div>'
                container += '<div class="col-md-1" style="font-size:16px;text-align:right">'
                container += '<a href="#" class="ab-trash">'
                container += '<input type="hidden" name="ab-trash[]" value="0">'
                container += '<input type="hidden" name="ab-id[]" value="0">'
                container += '<i style="color:red" class="fa fa-trash" aria-hidden="true"></i>'
                container += '</div>'
                container += '</a>'
                container += '</div>'
                container += '</div>'
                container += '<div class="panel-body">'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Title<span style="color:red">*</span></div>'
                container += '<div class="col-sm-11">'
                container += '<input type="text" name="ab_title[]" class="form-control ui-search-input" value="" placeholder="Abilities Title '+len+'" required="">'
                container += '</div>'
                container += '</div>'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Index</div>'
                container += '<div class="col-sm-11">'
                container += '<input type="text" name="ab_index[]"  onkeypress="if(this.value.length==3) return false;" step="10" min="0" max="100" class="percentage form-control ui-search-input" value="" placeholder="Abilities Index '+len+'" required="">'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                
            }else{
                var seq = $(".ab_row").last().data("sequence")
                seq++
                var container = '<div class="form-group ab_row" data-sequence="'+seq+'">'
                container += '<label class="col-sm-2 control-label"></label>'
                container += '<div class="col-sm-9">'
                container += '<div class="panel panel-default">'
                container += '<div class="panel-heading">'
                container += '<div class="form-group">'
                container += '<div class="col-md-11" style="font-size:16px;">Abilities '+seq+'</div>'
                container += '<div class="col-md-1" style="font-size:16px;text-align:right">'
                container += '<a href="#" class="ab-trash">'
                container += '<input type="hidden" name="ab-trash[]" value="0">'
                container += '<input type="hidden" name="ab-id[]" value="0">'
                container += '<i style="color:red" class="fa fa-trash" aria-hidden="true"></i>'
                container += '</div>'
                container += '</a>'
                container += '</div>'
                container += '</div>'
                container += '<div class="panel-body">'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Title<span style="color:red">*</span></div>'
                container += '<div class="col-sm-11">'
                container += '<input type="text" name="ab_title[]" class="form-control ui-search-input" value="" placeholder="Abilities Title '+seq+'" required="">'
                container += '</div>'
                container += '</div>'
                container += '<div class="form-group">'
                container += '<div class="col-sm-1">Index</div>'
                container += '<div class="col-sm-11">'
                container += '<input type="number" name="ab_index[]" onkeypress="if(this.value.length==3) return false;" step="10" min="0" max="100" class="percentage form-control ui-search-input" value="" placeholder="Abilites Index '+seq+'" required="">'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                container += '</div>'
                
            }
            $(container).insertBefore(parent);
        });


        $(document).on("click",".ab-trash",function() {
            event.preventDefault()
            var parent = $(this).parents(".ab_row");
            var seq = parent.data("sequence");

            if(seq == "1"){
                parent.nextUntil(".abButtonRow").andSelf().hide().removeClass("ab_row").find("input[name='ab-trash[]']").val("1")
                var container = '<div class="form-group abButtonRow">';
                container += '<label class="col-sm-2 control-label">Abilities  : </label>';
                container += '<div class="col-sm-9">';
                container += '<button type="button" id = "add_ab" class="btn btn-primary btn-block"><i class="fa fa-plus" aria-hidden="true"></i></button>';
                container += '</div>';
                container += '</div>';
                // parent.next().replaceWith(container);
                $(document).find(".abButtonRow").replaceWith(container);
            }else{
                parent.hide();
                parent.removeClass("ab_row");
                parent.find("input[name='ab-trash[]']").val("1");
            }  
        });

        $(document).on("click","#cv_remove",function(){
           $("#cv_name").text("N/A");
           $("#cv_remove_value").val("1");
           $("input[name='attachmentscv']").val("");
        });

        $(document).on("click","input[name='attachmentscv']",function(){
           $("#cv_remove_value").val("0");

        });

        $(document).on("click","#unlock",function(){
            var status = $("#passbox").prop("disabled");
            if(status){
                $("#passbox").prop("disabled",false)
                $("#passbox").prop("name","password")
                $("#unlock").text("Lock")
                $("#unlock").removeClass("btn-primary")
                $("#unlock").addClass("btn-purple")
            }else{
                $("#passbox").prop("disabled",true)
                $("#passbox").prop("name","")
                $("#unlock").text("Unlock")
                $("#passbox").val("")
                $("#unlock").addClass("btn-primary")
                $("#unlock").removeClass("btn-purple")
            }
        });

        $(document).on('keyup',".percentage", function() {
            var val = $(this).val();
            if(val > 100){
                $(this).val("100");
            }
        });

        $(document).on("focusout","input[name='ab_index[]']",function(){
            var num = Math.round($(this).val() / 10) * 10
            $(this).val(num)
        });
           
</script>
<?php
include 'Requires/page_top.php' ;
if(isset($_GET['mode']) && $mode == "edit"){
    if(isset($_POST['submit']) && !empty($_POST['submit'])){

        if(isset($_POST['business']) && $_POST['business']!="0"){
            $stmt = $mysqli->prepare("UPDATE system_user SET user_fname = ?, user_lname = ?, user_username = ?, user_profile = ?, user_phone = ?, user_email = ?, user_facebook = ?, user_twitter = ?, user_dob = ?, user_language = ?, user_skill = ?, user_gender = ?, user_address = ?, user_business = ?,user_country = ? WHERE user_id = ?");
            $stmt->bind_param('sssssssssssssisi',$_POST['firstname'],$_POST['lastname'],$_POST['username'],$_POST['description'],$_POST['phone'],$_POST['email'],$_POST['facebook'],$_POST['twitter'],$_POST['dob'],$_POST['language'],$_POST['skills'],$_POST['gender'],$_POST['address'],$_POST['business'],$_POST['country'],$id);
        }else{
            $stmt = $mysqli->prepare("UPDATE system_user SET user_fname = ?, user_lname = ?, user_username = ?, user_profile = ?, user_phone = ?, user_email = ?, user_facebook = ?, user_twitter = ?, user_dob = ?, user_language = ?, user_skill = ?, user_gender = ?, user_address = ?, user_business = NULL, user_country = ? WHERE user_id = ?");
            $stmt->bind_param('ssssssssssssssi',$_POST['firstname'],$_POST['lastname'],$_POST['username'],$_POST['description'],$_POST['phone'],$_POST['email'],$_POST['facebook'],$_POST['twitter'],$_POST['dob'],$_POST['language'],$_POST['skills'],$_POST['gender'],$_POST['address'],$_POST['country'],$id);
        }
       
        $stmt->execute();

        //update user password
        if(isset($_POST['password']) && $_POST['password'] != ""){
            //$mysqli->query("UPDATE system_user SET user_password = '".md5($_POST['password'])."' WHERE user_id = '".$id."'");
            $stmt = $mysqli->prepare("UPDATE system_user SET user_password = ? WHERE user_id = ?");
            $encodedPass = md5($_POST['password']);
            $stmt->bind_param('si',$encodedPass,$id);
            $stmt->execute();
        }
        

        //upload user education
    if(isset($_POST['edu_title'])){
    foreach($_POST['edu_title'] as $key => $value){
        if(isset($_POST['edu-id'][$key]) && $_POST['edu-id'][$key] != "0"){
                //modify the previous record found in database
                $mysqli->query("UPDATE system_user_edu SET edu_title = '".$value."', edu_start_date = '".$_POST['edu_start_date'][$key]."', edu_end_date = '".$_POST['edu_end_date'][$key]."',edu_present = '".$_POST['edu_present'][$key]."', edu_institute = '".$_POST['edu_institute'][$key]."',edu_trash = '".$_POST['edu-trash'][$key]."' WHERE edu_id = '".$_POST['edu-id'][$key]."'");

                $stmt = $mysqli->prepare("UPDATE system_user_edu SET edu_description = ? WHERE edu_id = ?");
                $stmt->bind_param('si',$_POST['edu_description'][$key],$_POST['edu-id'][$key]);
                $stmt->execute();
            
        }else{
                //insert into database if no previous record found

                // $mysqli->query("INSERT INTO system_user_edu(edu_title,edu_user_id,edu_start_date,edu_end_date,edu_present,edu_institute,edu_trash) VALUES('".$value."','".$userID."','".$_POST['edu_start_date'][$key]."','".$_POST['edu_end_date'][$key]."','".$_POST['edu_present'][$key]."','".$_POST['edu_institute'][$key]."','0')");
                if($value != ""){
                    
                    $stmt = $mysqli->prepare("INSERT INTO system_user_edu(edu_title,edu_user_id,edu_start_date,edu_end_date,edu_present,edu_institute,edu_description,edu_trash) VALUES(?,?,?,?,?,?,?,'0')");
                    $stmt->bind_param('sisssss',$value,$id,$_POST['edu_start_date'][$key],$_POST['edu_end_date'][$key],$_POST['edu_present'][$key],$_POST['edu_institute'][$key],$_POST['edu_description'][$key]);
                    $stmt->execute();
                }
            
            }
        }
    }

    //upload user experience
    if(isset($_POST['exp_title'])){
        foreach($_POST['exp_title'] as $key => $value){
            if(isset($_POST['exp-id'][$key]) && $_POST['exp-id'][$key] != "0"){
                //modify the previous record found in database
                $mysqli->query("UPDATE system_user_exp SET exp_title = '".$value."', exp_start_date = '".$_POST['exp_start_date'][$key]."', exp_end_date = '".$_POST['exp_end_date'][$key]."',exp_present = '".$_POST['exp_present'][$key]."', exp_institute = '".$_POST['exp_institute'][$key]."',exp_trash = '".$_POST['exp-trash'][$key]."' WHERE exp_id = '".$_POST['exp-id'][$key]."'");

                $stmt = $mysqli->prepare("UPDATE system_user_exp SET exp_description = ? WHERE exp_id = ?");
                $stmt->bind_param('si',$_POST['exp_description'][$key],$_POST['exp-id'][$key]);
                $stmt->execute();
                
            }else{
                
                //insert into database if no previous record found

                // $mysqli->query("INSERT INTO system_user_exp(exp_title,exp_user_id,exp_start_date,exp_end_date,exp_present,exp_institute,exp_trash) VALUES('".$value."','".$userID."','".$_POST['exp_start_date'][$key]."','".$_POST['exp_end_date'][$key]."','".$_POST['exp_present'][$key]."','".$_POST['exp_institute'][$key]."','0')");
                if($value != ""){
                    
                    $stmt = $mysqli->prepare("INSERT INTO system_user_exp(exp_title,exp_user_id,exp_start_date,exp_end_date,exp_present,exp_institute,exp_description,exp_trash) VALUES(?,?,?,?,?,?,?,'0')");
                    $stmt->bind_param('sisssss',$value,$id,$_POST['exp_start_date'][$key],$_POST['exp_end_date'][$key],$_POST['exp_present'][$key],$_POST['exp_institute'][$key],$_POST['exp_description'][$key]);
                    $stmt->execute();
                }
                

            }
        }
    }


    //upload user abilities
    if(isset($_POST['ab_title'])){
        foreach($_POST['ab_title'] as $key => $value){
            if(isset($_POST['ab-id'][$key]) && $_POST['ab-id'][$key] != "0"){
                //modify the previous record found in database
                $stmt = $mysqli->prepare("UPDATE system_user_abilities SET ab_title = ?, ab_index = ?, ab_trash = ? WHERE ab_id = ?");
                $stmt->bind_param('sisi',$value,$_POST['ab_index'][$key],$_POST['ab-trash'][$key],$_POST['ab-id'][$key]);
                $stmt->execute();
            }else{
                //insert into database if no previous record found
                if($value != ""){
                    $stmt = $mysqli->prepare("INSERT INTO system_user_abilities(ab_title,ab_index,ab_id,ab_user_id,ab_trash) VALUES(?,?,?,?,'0')");
                    $stmt->bind_param('siii',$value,$_POST['ab_index'][$key],$_POST['ab-id'][$key],$id);
                    $stmt->execute();
                   
                }
                

            }
        }
    }

    //file size constant
    define('KB', 1024);
    define('MB', 1048576);
    define('GB', 1073741824);
    define('TB', 1099511627776);

    //cv info
    $fileName = $_FILES["attachmentscv"]["name"];
    $fileSize = round(($_FILES["attachmentscv"]["size"]/MB),2);
    $tempFileName = $_FILES["attachmentscv"]["tmp_name"];
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
    $fileFolder = "../CV/" . $fileName;

    //upload cv
    if($fileName != ""){
        $mysqli->query("UPDATE system_user SET user_cv = '".$fileName."', user_cv_size = '".$fileSize."' WHERE user_id = '".$id."' AND user_trash = 0");
        //move cv into the right folder
        if (!move_uploaded_file($tempFileName, $fileFolder)) {
           $status = "cv-upload-fail";
        } 
    }

    if($_POST['cv_remove_value'] == "1"){
        $mysqli->query("UPDATE system_user SET user_cv = NULL AND user_cv_size = NULL WHERE user_id = '".$id."'");
    }

    //image info
    $imgName = $_FILES["image"]["name"];
    $tempImgName = $_FILES["image"]["tmp_name"];
    $imgType = pathinfo($imgName, PATHINFO_EXTENSION); 
    $allowTypes = array('jpg','png','jpeg','gif'); 
    $imgFolder = "../Images/" . $imgName;

    //upload image
    if($imgName != ""){
        if(in_array($imgType, $allowTypes)){ 
            $mysqli->query("UPDATE system_user SET user_image = '".$imgName."' WHERE user_id = '".$id."' AND user_trash = 0");
            //move image into the right folder
            if (!move_uploaded_file($tempImgName, $imgFolder)) {
               $status = "image-upload-fail";
            } 
        }else{
            $status = "image-upload-format";
        }
    }

    echo "<script>
    toastr.success('Thank you, your information has been updated successful');
    setTimeout(function () {
        location.href = 'user.php';
    }, 500);</script>
    ";
    }
    $userResult = $mysqli->query("SELECT * FROM system_user WHERE user_id = '".$id."' AND user_trash = 0");
    // $userResult = $mysqli->query("SELECT * FROM system_user a LEFT JOIN system_user_abilities b ON a.user_id = b.ab_user_id LEFT JOIN system_user_edu c ON a.user_id = c.edu_user_id LEFT JOIN system_user_exp d ON a.user_id = d.exp_user_id WHERE a.user_id = '".$id."' AND user_trash = 0 LIMIT 1;");
    
    if(mysqli_num_rows($userResult) > 0){
        $rowUser = $userResult->fetch_assoc();
        echo ' 
    <div class="warper container-fluid">  
    
        <!--Title-->
        <div class="page-header"><h1>User<small>Edit</small></div>
        <!--Title-->

        <form method="post" class="form-horizontal" id="productForm" enctype="multipart/form-data" action="user.php?mode=edit&id='.$id.'" novalidate="novalidate">

            <div class="row">
                <div class="col-md-12">
                    <!--Content Area-->
                
                    <div class="panel panel-default">
                        <div class="panel-heading"></div>
                        <div class="panel-body">
                            <a href="user.php" class="btn float_left" style="background-color: rgb(59,130,246);border-color: rgb(59,130,246);color: #fff;">Back</a>					
                        </div>
                    </div>
                
                        <div class="panel panel-default">
                            <div class="panel-heading"></div>
                                <div class="panel-body">
                                    <div class="main_input">
                                        <div class="tab-content disable_relative" style="display:block;">
                                            <div class="form-group form-horizontal">
                                                <label class="col-sm-2 control-label">Image :</label>
                                                <div class="col-sm-9">
                                                    <img src="../Images/'.($rowUser['user_image'] == "" ? "user.png" : $rowUser['user_image']).'" style="width:150px;">
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="col-sm-2 control-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="image" class="form-control" value="" placeholder="Image" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Username : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="username" class="form-control ui-search-input" value="'.$rowUser['user_username'].'" placeholder="Username" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Password : </label>
                                                <div class="col-sm-7" style="padding-right:10px">
                                                    <input type="password" id="passbox" name="" class="form-control ui-search-input" value="" placeholder="Password" disabled>
                                                    
                                                </div>
                                                <div class="col-sm-2" style="padding-left:0px">
                                                    <button type="button" id="unlock" class="btn btn-primary mb-2">Unlock</button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">First Name : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="firstname" class="form-control ui-search-input" value="'.$rowUser['user_fname'].'" placeholder="First Name" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Last Name : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="lastname" class="form-control ui-search-input" value="'.$rowUser['user_lname'].'" placeholder="Last Name" required="">
                                                </div>
                                            </div>';
                                            
                                            echo'
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Gender : </label>
                                                <div class="col-sm-9">
                                                    
                                                    <select class="form-control" name="gender">
                                                    <option value="">--Select--</option>
                                                    <option value="M" '.($rowUser['user_gender'] == "M" ? "selected" : "").'>Male</option>
                                                    <option value="F" '.($rowUser['user_gender'] == "F" ? "selected" : "").'>Female</option>
                                                    <option value="E" '.($rowUser['user_gender'] == "E" ? "selected" : "").'>Prefer not to say</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Date of birth : </label>
                                                <div class="col-sm-9">
                                                    <input type="date" name="dob" class="form-control ui-search-input" value="'.$rowUser['user_dob'].'" placeholder="Date of birth" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Language : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="language" class="form-control ui-search-input" value="'.$rowUser['user_language'].'" placeholder="Language" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Address : </label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" rows="3" name="address">'.$rowUser['user_address'].'</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Country : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="country" class="form-control ui-search-input" placeholder="Country" required="" value="'.($rowUser['user_country'] != "" ? $rowUser['user_country'] : "N/A").'">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Description : </label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" rows="5" name="description">'.$rowUser['user_profile'].'</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Skills : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="skills" class="form-control ui-search-input" value="'.$rowUser['user_skill'].'" placeholder="Skills" required="">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label">Business Nature : </label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="business">
                                                    <option value="0">-- Select --</option>';
                                                        //retrieve business nature info
                                                        $businessResult = $mysqli->query("SELECT * FROM system_user_business WHERE business_trash = 0");
                                                        if(mysqli_num_rows($businessResult) > 0){
                                                            while($rowBusiness = mysqli_fetch_assoc($businessResult)){
                                                                echo '<option value="'.$rowBusiness['business_id'].'" '.($rowBusiness['business_id'] == $rowUser['user_business'] ? "selected" : "").'>'.$rowBusiness['business_name'].'</option>';
                                                            } 
                                                        }
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">CV : </label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="attachmentscv" class="form-control" value="" placeholder="CV" required="">
                                                </div>
                                            </div><div class="form-group">
                                            <label class="col-sm-2 control-label"></label>
                                            <div class="col-sm-9" style="font-size:13px;font-weight:bold">
                                            <input type="hidden" value="0" id="cv_remove_value" name="cv_remove_value">
                                               Current applied file: <span id="cv_name" >';
                                                if($rowUser['user_cv'] != ""){
                                                    echo $rowUser['user_cv'];
                                                }else{
                                                    echo "N/A";
                                                }
                                                
                                            echo'</span> &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn" style="color:red" id="cv_remove">Remove</a>
                                            </div>
                                            </div>';
                                            

                                                $eduResult = $mysqli->query("SELECT * FROM system_user_edu WHERE edu_user_id = '".$id."' AND edu_trash = 0");
                                                if(mysqli_num_rows($eduResult) > 0){
                                                    $edu_length = "1";
                                                    
                                                    while($rowEdu = mysqli_fetch_assoc($eduResult)){
                                                        if($edu_length == "1"){
                                                            echo'
                                                            <div class="form-group edu_row" data-sequence="'.$edu_length.'">
                                                                <label class="col-sm-2 control-label">Education : </label>
                                                                <div class="col-sm-9">
                                                                    <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <div class="form-group">
                                                                        <div class="col-md-11" style="font-size:16px;">Education '.$edu_length.'</div>
                                                                        <div class="col-md-1" style="font-size:16px;text-align:right">
                                                                            <a href="#" class="edu-trash">
                                                                            <input type="hidden" name="edu-trash[]" value="0">
                                                                            <input type="hidden" name="edu-id[]" value="'.$rowEdu['edu_id'].'">
                                                                            <i style="color:red" class="fa fa-trash" aria-hidden="true"></i>
                                                                        </div>
                                                                        </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Title<span style="color:red">*</span></div>
                                                                        <div class="col-sm-11">
                                                                            <input type="text" name="edu_title[]" class="form-control ui-search-input" value="'.$rowEdu['edu_title'].'" placeholder="Education Title '.$edu_length.'" required="">
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Start Date</div>
                                                                        <div class="col-sm-9">
                                                                            <input type="date" name="edu_start_date[]" class="form-control ui-search-input" value="'.$rowEdu['edu_start_date'].'" required="">
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <label class="form-check-label">Present</label>
                                                                            <input type="hidden" name="edu_present[]" id="edu_present_'.$edu_length.'_hidden" value="0" '.($rowEdu['edu_present'] == "1" ? "disabled" : "").'>
                                                                            <input class="form-check-input edu-present" type="checkbox" role="switch" id="edu_present_'.$edu_length.'" name="edu_present[]" value="1" '.($rowEdu['edu_present'] == "1" ? "checked" : "").'>

                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group edu_end_date_row_'.$edu_length.'" '.($rowEdu['edu_present'] == "1" ? "style='display:none'" : "").'>
                                                                        <div class="col-sm-1">End Date</div>
                                                                        <div class="col-sm-9">
                                                                            <input type="hidden" name="edu_end_date[]" id="edu_end_date_'.$edu_length.'_hidden" value="" '.($rowEdu['edu_present'] == "1" ? "" : "disabled").'>
                                                                            <input type="date" name="'.($rowEdu['edu_present'] == "1" ? "" : "edu_end_date[]").'" id="edu_end_date_'.$edu_length.'" class="form-control ui-search-input" value="'.($rowEdu['edu_end_date'] == "" ? "" : $rowEdu['edu_end_date']).'" required="">
                                                                        </div>
                                                                        <div class="col-sm-2"></div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Institute</div>
                                                                        <div class="col-sm-11">
                                                                            <input type="text" name="edu_institute[]" class="form-control ui-search-input" value="'.$rowEdu['edu_institute'].'" placeholder="Education Institute '.$edu_length.'" required="">
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Description</div>
                                                                        <div class="col-sm-11">
                                                                            <input type="text" name="edu_description[]" class="form-control ui-search-input" value="'.$rowEdu['edu_description'].'" placeholder="Education Description '.$edu_length.'" required="">
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </div>';
                                                        }else{
                                                            echo'
                                                            <div class="form-group edu_row" data-sequence="'.$edu_length.'">
                                                                <label class="col-sm-2 control-label"></label>
                                                                <div class="col-sm-9">
                                                                    <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <div class="form-group">
                                                                        <div class="col-md-11" style="font-size:16px;">Education '.$edu_length.'</div>
                                                                        <div class="col-md-1" style="font-size:16px;text-align:right">
                                                                            <a href="#" class="edu-trash">
                                                                            <input type="hidden" name="edu-trash[]" value="0">
                                                                            <input type="hidden" name="edu-id[]" value="'.$rowEdu['edu_id'].'">
                                                                            <i style="color:red" class="fa fa-trash" aria-hidden="true"></i>
                                                                        </div>
                                                                        </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Title<span style="color:red">*</span></div>
                                                                        <div class="col-sm-11">
                                                                            <input type="text" name="edu_title[]" class="form-control ui-search-input" value="'.$rowEdu['edu_title'].'" placeholder="Education Title '.$edu_length.'" required="">
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Start Date</div>
                                                                        <div class="col-sm-9">
                                                                            <input type="date" name="edu_start_date[]" class="form-control ui-search-input" value="'.$rowEdu['edu_start_date'].'" required="">
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <label class="form-check-label">Present</label>
                                                                            <input type="hidden" name="edu_present[]" id="edu_present_'.$edu_length.'_hidden" value="0" '.($rowEdu['edu_present'] == "1" ? "disabled" : "").'>
                                                                            <input class="form-check-input edu-present" type="checkbox" role="switch" id="edu_present_'.$edu_length.'" name="edu_present[]" value="1" '.($rowEdu['edu_present'] == "1" ? "checked" : "").'>
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group edu_end_date_row_'.$edu_length.'" '.($rowEdu['edu_present'] == "1" ? "style='display:none'" : "").'>
                                                                        <div class="col-sm-1">End Date</div>
                                                                        <div class="col-sm-9">
                                                                            <input type="hidden" name="edu_end_date[]" id="edu_end_date_'.$edu_length.'_hidden" value="" '.($rowEdu['edu_present'] == "1" ? "" : "disabled").'>
                                                                            <input type="date" name="'.($rowEdu['edu_present'] == "1" ? "" : "edu_end_date[]").'" id="edu_end_date_'.$edu_length.'" class="form-control ui-search-input" value="'.($rowEdu['edu_end_date'] == "" ? "" : $rowEdu['edu_end_date']).'" required="">
                                                                        </div>
                                                                        <div class="col-sm-2"></div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Institute</div>
                                                                        <div class="col-sm-11">
                                                                            <input type="text" name="edu_institute[]" class="form-control ui-search-input" value="'.$rowEdu['edu_institute'].'" placeholder="Education Institute '.$edu_length.'" required="">
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Description</div>
                                                                        <div class="col-sm-11">
                                                                            <input type="text" name="edu_description[]" class="form-control ui-search-input" value="'.$rowEdu['edu_description'].'" placeholder="Education Description '.$edu_length.'" required="">
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </div>';
                                                        }
                                                        $edu_length++;
                                                    }
                                                    echo '<div class="form-group eduButtonRow">
                                                        <label class="col-sm-2 control-label"></label>
                                                        <div class="col-sm-9">
                                                            <button type="button" id = "add_edu" class="btn btn-primary btn-block"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                        </div>
                                                    </div>';
                                                    
                                                }else{
                                                    echo '<div class="form-group eduButtonRow">
                                                                <label class="col-sm-2 control-label">Education  : </label>
                                                                <div class="col-sm-9">
                                                                    <button type="button" id = "add_edu" class="btn btn-primary btn-block"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                                </div>
                                                            </div>';
                                                }


                                                $expResult = $mysqli->query("SELECT * FROM system_user_exp WHERE exp_user_id = '".$id."' AND exp_trash = 0");
                                                if(mysqli_num_rows($expResult) > 0){
                                                    $exp_length = "1";
                                                    
                                                    while($rowExp = mysqli_fetch_assoc($expResult)){
                                                        if($exp_length == "1"){
                                                            echo'
                                                            <div class="form-group exp_row" data-sequence="'.$exp_length.'">
                                                                <label class="col-sm-2 control-label">Experience : </label>
                                                                <div class="col-sm-9">
                                                                    <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <div class="form-group">
                                                                        <div class="col-md-11" style="font-size:16px;">Experience '.$exp_length.'</div>
                                                                        <div class="col-md-1" style="font-size:16px;text-align:right">
                                                                            <a href="#" class="exp-trash">
                                                                            <input type="hidden" name="exp-trash[]" value="0">
                                                                            <input type="hidden" name="exp-id[]" value="'.$rowExp['exp_id'].'">
                                                                            <i style="color:red" class="fa fa-trash" aria-hidden="true"></i>
                                                                        </div>
                                                                        </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Title<span style="color:red">*</span></div>
                                                                        <div class="col-sm-11">
                                                                            <input type="text" name="exp_title[]" class="form-control ui-search-input" value="'.$rowExp['exp_title'].'" placeholder="Experience Title '.$exp_length.'" required="">
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Start Date</div>
                                                                        <div class="col-sm-9">
                                                                            <input type="date" name="exp_start_date[]" class="form-control ui-search-input" value="'.$rowExp['exp_start_date'].'" required="">
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <label class="form-check-label">Present</label>
                                                                            <input type="hidden" name="exp_present[]" id="exp_present_'.$exp_length.'_hidden" value="0" '.($rowExp['exp_present'] == "1" ? "disabled" : "").'>
                                                                            <input class="form-check-input exp-present" type="checkbox" role="switch" id="exp_present_'.$exp_length.'" name="exp_present[]" value="1" '.($rowExp['exp_present'] == "1" ? "checked" : "").'>

                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group exp_end_date_row_'.$exp_length.'" '.($rowExp['exp_present'] == "1" ? "style='display:none'" : "").'>
                                                                        <div class="col-sm-1">End Date</div>
                                                                        <div class="col-sm-9">
                                                                            <input type="hidden" name="exp_end_date[]" id="exp_end_date_'.$exp_length.'_hidden" value="" '.($rowExp['exp_present'] == "1" ? "" : "disabled").'>
                                                                            <input type="date" name="'.($rowExp['exp_present'] == "1" ? "" : "exp_end_date[]").'" id="exp_end_date_'.$exp_length.'" class="form-control ui-search-input" value="'.($rowExp['exp_end_date'] == "" ? "" : $rowExp['exp_end_date']).'" required="">
                                                                        </div>
                                                                        <div class="col-sm-2"></div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Institute</div>
                                                                        <div class="col-sm-11">
                                                                            <input type="text" name="exp_institute[]" class="form-control ui-search-input" value="'.$rowExp['exp_institute'].'" placeholder="Experience '.$exp_length.'" required="">
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Description</div>
                                                                        <div class="col-sm-11">
                                                                            <input type="text" name="exp_description[]" class="form-control ui-search-input" value="'.$rowExp['exp_description'].'" placeholder="Experience Description '.$exp_length.'" required="">
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </div>';
                                                        }else{
                                                            echo'
                                                            <div class="form-group exp_row" data-sequence="'.$exp_length.'">
                                                                <label class="col-sm-2 control-label"></label>
                                                                <div class="col-sm-9">
                                                                    <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <div class="form-group">
                                                                        <div class="col-md-11" style="font-size:16px;">Experience '.$exp_length.'</div>
                                                                        <div class="col-md-1" style="font-size:16px;text-align:right">
                                                                            <a href="#" class="exp-trash">
                                                                            <input type="hidden" name="exp-trash[]" value="0">
                                                                            <input type="hidden" name="exp-id[]" value="'.$rowExp['exp_id'].'">
                                                                            <i style="color:red" class="fa fa-trash" aria-hidden="true"></i>
                                                                        </div>
                                                                        </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Title<span style="color:red">*</span></div>
                                                                        <div class="col-sm-11">
                                                                            <input type="text" name="exp_title[]" class="form-control ui-search-input" value="'.$rowExp['exp_title'].'" placeholder="Experience Title '.$exp_length.'" required="">
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Start Date</div>
                                                                        <div class="col-sm-9">
                                                                            <input type="date" name="exp_start_date[]" class="form-control ui-search-input" value="'.$rowExp['exp_start_date'].'" required="">
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <label class="form-check-label">Present</label>
                                                                            <input type="hidden" name="exp_present[]" id="exp_present_'.$exp_length.'_hidden" value="0" '.($rowExp['exp_present'] == "1" ? "disabled" : "").'>
                                                                            <input class="form-check-input exp-present" type="checkbox" role="switch" id="edxp_present_'.$exp_length.'" name="exp_present[]" value="1" '.($rowExp['exp_present'] == "1" ? "checked" : "").'>
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group exp_end_date_row_'.$exp_length.'" '.($rowExp['exp_present'] == "1" ? "style='display:none'" : "").'>
                                                                        <div class="col-sm-1">End Date</div>
                                                                        <div class="col-sm-9">
                                                                            <input type="hidden" name="exp_end_date[]" id="exp_end_date_'.$exp_length.'_hidden" value="" '.($rowExp['exp_present'] == "1" ? "" : "disabled").'>
                                                                            <input type="date" name="'.($rowExp['exp_present'] == "1" ? "" : "exp_end_date[]").'" id="exp_end_date_'.$exp_length.'" class="form-control ui-search-input" value="'.($rowExp['exp_end_date'] == "" ? "" : $rowExp['exp_end_date']).'" required="">
                                                                        </div>
                                                                        <div class="col-sm-2"></div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Institute</div>
                                                                        <div class="col-sm-11">
                                                                            <input type="text" name="exp_institute[]" class="form-control ui-search-input" value="'.$rowExp['exp_institute'].'" placeholder="Experience Institute '.$exp_length.'" required="">
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Description</div>
                                                                        <div class="col-sm-11">
                                                                            <input type="text" name="exp_description[]" class="form-control ui-search-input" value="'.$rowExp['exp_description'].'" placeholder="Experience Description '.$exp_length.'" required="">
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </div>';
                                                        }
                                                        $exp_length++;
                                                    }
                                                    echo '<div class="form-group expButtonRow">
                                                        <label class="col-sm-2 control-label"></label>
                                                        <div class="col-sm-9">
                                                            <button type="button" id = "add_exp" class="btn btn-primary btn-block"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                        </div>
                                                    </div>';
                                                    
                                                }else{
                                                    echo '<div class="form-group expButtonRow">
                                                                <label class="col-sm-2 control-label">Experience  : </label>
                                                                <div class="col-sm-9">
                                                                    <button type="button" id = "add_exp" class="btn btn-primary btn-block"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                                </div>
                                                            </div>';
                                                }


                                                $abResult = $mysqli->query("SELECT * FROM system_user_abilities WHERE ab_user_id = '".$id."' AND ab_trash = 0");
                                                if(mysqli_num_rows($abResult) > 0){
                                                    $ab_length = "1";
                                                    while($rowAb = mysqli_fetch_assoc($abResult)){
                                                        if($ab_length == "1"){
                                                            echo'
                                                            <div class="form-group ab_row" data-sequence="'.$ab_length.'">
                                                                <label class="col-sm-2 control-label">Abilities : </label>
                                                                <div class="col-sm-9">
                                                                    <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <div class="form-group">
                                                                        <div class="col-md-11" style="font-size:16px;">Abilities '.$ab_length.'</div>
                                                                        <div class="col-md-1" style="font-size:16px;text-align:right">
                                                                            <a href="#" class="ab-trash">
                                                                            <input type="hidden" name="ab-trash[]" value="0">
                                                                            <input type="hidden" name="ab-id[]" value="'.$rowAb['ab_id'].'">
                                                                            <i style="color:red" class="fa fa-trash" aria-hidden="true"></i>
                                                                        </div>
                                                                        </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Title<span style="color:red">*</span></div>
                                                                        <div class="col-sm-11">
                                                                            <input type="text" name="ab_title[]" class="form-control ui-search-input" value="'.$rowAb['ab_title'].'" placeholder="Abilities Title '.$ab_length.'" required="">
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Index</div>
                                                                        <div class="col-sm-11">
                                                                            <input type="number" name="ab_index[]" onkeypress="if(this.value.length==3) return false;" step="10" min="0" max="100" class="percentage form-control ui-search-input" value="'.$rowAb['ab_index'].'" placeholder="Abilities Index '.$ab_length.'" required="">
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </div>';

                                                        }else{

                                                            echo'
                                                            <div class="form-group ab_row" data-sequence="'.$ab_length.'">
                                                                <label class="col-sm-2 control-label"></label>
                                                                <div class="col-sm-9">
                                                                    <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <div class="form-group">
                                                                        <div class="col-md-11" style="font-size:16px;">Abilities '.$ab_length.'</div>
                                                                        <div class="col-md-1" style="font-size:16px;text-align:right">
                                                                            <a href="#" class="ab-trash">
                                                                            <input type="hidden" name="ab-trash[]" value="0">
                                                                            <input type="hidden" name="ab-id[]" value="'.$rowAb['ab_id'].'">
                                                                            <i style="color:red" class="fa fa-trash" aria-hidden="true"></i>
                                                                        </div>
                                                                        </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Title<span style="color:red">*</span></div>
                                                                        <div class="col-sm-11">
                                                                            <input type="text" name="ab_title[]" class="form-control ui-search-input" value="'.$rowAb['ab_title'].'" placeholder="Abilities Title '.$ab_length.'" required="">
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <div class="col-sm-1">Index</div>
                                                                        <div class="col-sm-11">
                                                                            <input type="number" name="ab_index[]" onkeypress="if(this.value.length==3) return false;" step="10" min="0" max="100" class="percentage form-control ui-search-input" value="'.$rowAb['ab_index'].'" placeholder="Abilities Index '.$ab_length.'" required="">
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </div>';

                                                        }
                                                        $ab_length++;
                                                    }
                                                    echo '<div class="form-group abButtonRow">
                                                            <label class="col-sm-2 control-label"></label>
                                                            <div class="col-sm-9">
                                                                <button type="button" id = "add_ab" class="btn btn-primary btn-block"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                            </div>
                                                        </div>';
                                                    
                                                }else{
                                                    echo '<div class="form-group abButtonRow">
                                                                <label class="col-sm-2 control-label">Abilities  : </label>
                                                                <div class="col-sm-9">
                                                                    <button type="button" id = "add_ab" class="btn btn-primary btn-block"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                                </div>
                                                            </div>';
                                                }

                                                    
                                                echo'
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Facebook Link : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="facebook" class="form-control ui-search-input" value="'.$rowUser['user_facebook'].'" placeholder="Facebook Link" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Twitter Link : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="twitter" class="form-control ui-search-input" value="'.$rowUser['user_twitter'].'" placeholder="Twitter Link" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Contact No : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="phone" class="form-control ui-search-input" value="'.$rowUser['user_phone'].'" placeholder="Contact No" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Email Address : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="email" class="form-control ui-search-input" value="'.$rowUser['user_email'].'" placeholder="Email Address" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Created Date : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control ui-search-input" value="'.$rowUser['user_createdDate'].'" placeholder="Created Date" readonly required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"></label>
                                                <div class="col-sm-9">
                                                <button class="btn" style="background-color: rgb(59,130,246);border-color: rgb(59,130,246);color: #fff;float:right;" type="submit" name="submit" value="submit" >Submit</button>
                                                </div>
                                            </div>
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
    
}else if(isset($_GET['mode']) && $mode == "new"){
    
        echo ' 
    <div class="warper container-fluid">  
    
        <!--Title-->
        <div class="page-header"><h1>User<small>New</small></div>
        <!--Title-->

        <form method="post" class="form-horizontal" id="productForm" enctype="multipart/form-data" action="user.php?mode=new">

            <div class="row">
                <div class="col-md-12">
                    <!--Content Area-->
                
                    <div class="panel panel-default">
                        <div class="panel-heading"></div>
                        <div class="panel-body">
                            <a href="user.php" class="btn float_left" style="background-color: rgb(59,130,246);border-color: rgb(59,130,246);color: #fff;">Back</a>							
                        </div>
                    </div>
                
                        <div class="panel panel-default">
                            <div class="panel-heading"></div>
                                <div class="panel-body">
                                    <div class="main_input">
                                        <div class="tab-content disable_relative" style="display:block;">
                                            <div class="form-group form-horizontal">
                                                <label class="col-sm-2 control-label">Image :</label>
                                                <div class="col-sm-9">
                                                    <input type="file" id="files" name="image" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Username<span style="color:red">*</span> : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="username" class="form-control ui-search-input" placeholder="Username" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Password<span style="color:red">*</span> : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="password" class="form-control ui-search-input" placeholder="Password" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">First Name : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="firstname" class="form-control ui-search-input"  placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Last Name : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="lastname" class="form-control ui-search-input" placeholder="Last Name" >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Gender : </label>
                                                <div class="col-sm-9">
                                                    
                                                    <select class="form-control" name="gender">
                                                    <option value="">--Select--</option>
                                                    <option value="M" >Male</option>
                                                    <option value="F" >Female</option>
                                                    <option value="E" >Prefer not to say</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                            <label class="col-sm-2 control-label">Date of birth : </label>
                                            <div class="col-sm-9">
                                                <input type="date" name="dob" class="form-control ui-search-input" placeholder="Date of birth">
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <label class="col-sm-2 control-label">Language : </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="language" class="form-control ui-search-input" placeholder="Language">
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <label class="col-sm-2 control-label">Address : </label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="3" name="address"></textarea>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <label class="col-sm-2 control-label">Country : </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="country" class="form-control ui-search-input" placeholder="Country">
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Description : </label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" rows="5" name="description"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Skills : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="skills" class="form-control ui-search-input" placeholder="Skills">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Business Nature : </label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="business">
                                                    <option value="0">-- Select --</option>';
                                                        //retrieve business nature info
                                                        $businessResult = $mysqli->query("SELECT * FROM system_user_business WHERE business_trash = 0");
                                                        if(mysqli_num_rows($businessResult) > 0){
                                                            while($rowBusiness = mysqli_fetch_assoc($businessResult)){
                                                                echo '<option value="'.$rowBusiness['business_id'].'">'.$rowBusiness['business_name'].'</option>';
                                                            } 
                                                        }
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">CV : </label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="attachmentscv" class="form-control" value="" placeholder="CV" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Facebook Link : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="facebook" class="form-control ui-search-input"  placeholder="Facebook Link">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Twitter Link : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="twitter" class="form-control ui-search-input"  placeholder="Twitter Link">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Contact No : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="phone" class="form-control ui-search-input" placeholder="Contact No">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Email Address<span style="color:red">*</span> : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="email" class="form-control ui-search-input"  placeholder="Email Address" required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"></label>
                                                <div class="col-sm-9">
                                                <button class="btn" style="background-color: rgb(59,130,246);border-color: rgb(59,130,246);color: #fff;float:right" type="submit" name="submit" value="submit" >Submit</button>
                                                </div>
                                            </div>
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
    if(isset($_POST['submit']) && !empty($_POST['submit'])){

    //file size constant
    define('KB', 1024);
    define('MB', 1048576);
    define('GB', 1073741824);
    define('TB', 1099511627776);

    //cv info
    $fileName = $_FILES["attachmentscv"]["name"];
    $fileSize = round(($_FILES["attachmentscv"]["size"]/MB),2);
    $tempFileName = $_FILES["attachmentscv"]["tmp_name"];
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
    $fileFolder = "../CV/" . $fileName;

    //image info
    $imgName = $_FILES["image"]["name"];
    $tempImgName = $_FILES["image"]["tmp_name"];
    $imgType = pathinfo($imgName, PATHINFO_EXTENSION); 
    $allowTypes = array('jpg','png','jpeg','gif'); 
    $imgFolder = "../Images/" . $imgName;

    //move image into the right folder
    move_uploaded_file($tempImgName, $imgFolder);

    //if no image is set, then define a default profile picture
    if($imgName == ""){
        $imgName = "user.png";
    }

    $usernameCheck = $mysqli->query("SELECT * FROM system_user WHERE user_username = '".$_POST['username']."' AND user_trash = 0");
    if(mysqli_num_rows($usernameCheck) > 0){
        echo "<script>
                toastr.error('Username has existed');
                </script>
                ";
    }else{

    
        if(isset($_POST['business']) && $_POST['business']!="0"){
            $stmt = $mysqli->prepare("INSERT INTO system_user(user_fname, user_lname, user_username, user_profile, user_phone, user_email, user_facebook, user_twitter, user_dob, user_language, user_skill,user_password,user_address,user_gender,user_business,user_image,user_country) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param('ssssssssssssssiss',$_POST['firstname'],$_POST['lastname'],$_POST['username'],$_POST['description'],$_POST['phone'],$_POST['email'],$_POST['facebook'],$_POST['twitter'],$_POST['dob'],$_POST['language'],$_POST['skills'],md5($_POST['password']),$_POST['address'],$_POST['gender'],$_POST['business'],$imgName,$_POST['country']);
        }else{
            $stmt = $mysqli->prepare("INSERT INTO system_user(user_fname, user_lname, user_username, user_profile, user_phone, user_email, user_facebook, user_twitter, user_dob, user_language, user_skill,user_password,user_address,user_gender,user_image,user_country,user_business) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NULL)");
            $stmt->bind_param('ssssssssssssssss',$_POST['firstname'],$_POST['lastname'],$_POST['username'],$_POST['description'],$_POST['phone'],$_POST['email'],$_POST['facebook'],$_POST['twitter'],$_POST['dob'],$_POST['language'],$_POST['skills'],md5($_POST['password']),$_POST['address'],$_POST['gender'],$imgName,$_POST['country']);
        }    
        
        $result = $stmt->execute();

        $tempResult = $mysqli->query("SELECT * FROM system_user WHERE user_username = '".$_POST['username']."' AND user_trash = 0");
        $rowTemp = mysqli_fetch_assoc($tempResult);

        //upload cv
        if($fileName != ""){
            $mysqli->query("UPDATE system_user SET user_cv = '".$fileName."', user_cv_size = '".$fileSize."' WHERE user_id = '".$rowTemp['user_id']."' AND user_trash = 0");
            
            //move cv into the right folder
            move_uploaded_file($tempFileName, $fileFolder);
        }

        
        $vlink = "http://localhost/fyp/vcard/index.php?id=".$rowTemp['user_id'];
        $stmt2 = $mysqli->prepare("UPDATE system_user SET user_vlink = ? WHERE user_trash = 0 AND user_id = ?");
        $stmt2->bind_param('si',$vlink,$rowTemp['user_id']);
        $stmt2->execute();

        if($result){
            echo "<script>
                toastr.success('Thank you, your information has been added successful');
                setTimeout(function () {
                    location.href = 'user.php';
                }, 500);</script>
                ";
            exit;
        }
    }
}
    
    
}else{
    echo ' 
    <div class="warper container-fluid">  
    
        <!--Title-->
        <div class="page-header"><h1>User<small>List</small></div>
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
                    
                    <a class="btn" style="background-color:rgb(59,130,246);border-color:rgb(59,130,246);color:#fff" href="user.php?mode=new">Add New</a>
                    <a class="btn btn-green" target="_blank" href="user.php?mode=export">Export Excel</a>
                </div>
            </div>
    
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="basic-datatable_wrapper" class="dataTables_wrapper form-horizontal dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive" style="max-height:600px;overflow-y:auto">
                                <table cellpadding="0" cellspacing="0" border="0" class="responsive table table-striped table-bordered dataTable no-footer" id="basic-datatable" role="grid">
                                    <thead >
                                        <tr role="row">
                                            <th rowspan="1" colspan="1">No.</th>
                                            <th rowspan="1" colspan="1">Image</th>
                                            <th rowspan="1" colspan="1">Username</th>
                                            <th rowspan="1" colspan="1">Full Name</th>
                                            <th rowspan="1" colspan="1">Gender</th>
                                            <th rowspan="1" colspan="1">Date of Birth</th>
                                            <th rowspan="1" colspan="1">Language</th>
                                            <th rowspan="1" colspan="1">Address</th>
                                            <th rowspan="1" colspan="1">Country</th>
                                            <th rowspan="1" colspan="1">Description</th>
                                            <th rowspan="1" colspan="1">Skills</th>
                                            <th rowspan="1" colspan="1">Business Nature</th>
                                            <th rowspan="1" colspan="1">CV</th>
                                            <th rowspan="1" colspan="1">Education</th>
                                            <th rowspan="1" colspan="1">Experience</th>
                                            <th rowspan="1" colspan="1">Abilities</th>
                                            <th rowspan="1" colspan="1">Facebook Link</th>
                                            <th rowspan="1" colspan="1">Twitter Link</th>
                                            <th rowspan="1" colspan="1">Contact No.</th>
                                            <th rowspan="1" colspan="1">Email Address</th>
                                            <th rowspan="1" colspan="1">Business Card Link</th>
                                            <th rowspan="1" colspan="1">Created Date</th>
                                            <th rowspan="1" colspan="1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="appendResult">
                                        <tr role="row">
                                            <td rowspan="1" colspan="23">No data available</td>
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