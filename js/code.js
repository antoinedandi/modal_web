$(document).ready(function () {
   
    
    //Animation des pages

    $(window).bind('beforeunload',function () {
        $("#content .cadre_transparent").addClass("goOut");
        $(".jumbotron").addClass("goOut");
    });
});