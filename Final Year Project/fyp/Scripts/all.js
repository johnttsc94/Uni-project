function copyToClipboard(element) {
    if($(element).val() != ""){
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).val()).select();
        document.execCommand("copy");
        $temp.remove();
        toastr.success('Link has been copied');
    }else{
        toastr.warning('Nothing to be copied');
    }
    
}

function previewImg(input){
var file = $("#profile-img-file-input").get(0).files[0];

if(file){
var reader = new FileReader();

reader.onload = function(){
    $("#profile-img").attr("src", reader.result);
}

reader.readAsDataURL(file);
}
}