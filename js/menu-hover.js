
// When hovering close to bottom of screen show the about menu
$(document).ready(function() {


    window.onmousemove= function(e){

        if(e.pageY >= $(document).height()-200){
           $("li.about-menu-item a").addClass("display-block");
       }else{
           $("li.about-menu-item a").removeClass("display-block");
       }
    };

});



