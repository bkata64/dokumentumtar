$(document).ready(function() {     
    $(".document-row").click(function() {       
        let id = $(this).attr('document');
        $.ajax({
            method: "POST",
            url: "?archives/detail",
            data: { "document": id }
        })
        .done(function( msg ) {
            $("#reszletek").html(msg);
        });
    }); 
});



