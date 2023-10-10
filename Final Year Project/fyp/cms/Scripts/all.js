$(document).ready(function(){
    $(".pull-left").on("click",function(e){
        var target = $(".left-panel");
        if(target.hasClass("collapsed")){
            $(".left-panel").removeClass("collapsed");
        }else{
            $(".left-panel").addClass("collapsed");
        }
        return false;
    });
});