$(document).ready(function () {
    //Animation du compte à rebours
    $(".digits").countdown({
        image: "img/digits.png",
        format: "dd:hh:mm:ss",
        endTime: new Date(2017, 06, 3)
    });
    //Animation des pages

    $(window).bind('beforeunload',function () {
        $("#content .row").addClass("goOut");
    });
});