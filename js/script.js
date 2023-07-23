$(document).ready(function() {    
    $(".search").click(function() {
        $(".cancel").removeClass("rejtett");         
    });
    $(".cancel").click(function() {     
        $(this).addClass("rejtett");
    })
});