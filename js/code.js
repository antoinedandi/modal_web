$(document).ready(function () {
        
        $(".digits").countdown({
            image: "img/digits.png",
            format: "dd:hh:mm:ss",
            endTime: new Date(2017, 5, 4)
        });
        
    });