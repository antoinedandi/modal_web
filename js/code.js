/* global endTime */

$(document).ready(function () {
    //Actualisation Cagnotte 
    var auto_refresh = setInterval(
            function ()
            {
                $.post("./scripts/getMontant.php", {}, function (rep) {
                    $('#cagnotte').text(rep).fadeIn("slow");
                });
            }, 1000);
    //Utile pour le débuggage ! Actualise la cagnotte toutes les 0,1 secondes
    /*var auto_refresh2 = setInterval(
     function ()
     {
     $.post("scripts/setMontant.php", {}, function (rep) {
     
     });
     }, 100);*/

    ////////////Animation des pages

    $(window).bind('beforeunload', function () {
        $("#content .cadre_transparent").addClass("goOut");
        $(".jumbotron").addClass("goOut");
    });
    
    ////////Compte à rebours
    $(".digits").countdown({
        image: "img/digits.png",
        format: "dd:hh:mm:ss",
        endTime: endTime
    });
    
    //Tirage Automatique

    var tirageAuto = setInterval(
            function ()
            {                  
                var tirageNecessaire=new Date().getTime()>endTime.getTime();
                if (tirageNecessaire) {
                    $('#count').css('background-color', 'red');
                    $.post("scripts/tirageAuto.php", {'date':endTime.getTime()}, function (rep) {
                        endTime=new Date(endTime.getTime()+604800000);
                    });
                }
            }, 1000);
});