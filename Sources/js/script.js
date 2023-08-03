$(document).ready(function() {    
    $(".search").click(function() {
        $(".cancel").removeClass("rejtett");         
    });

    $(".cancel").click(function() {     
        $(this).addClass("rejtett");
    });

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

  

    $('main').prepend("<img id='loading' src='Sources/img/loading-gif.gif' >");
    let loading = $('#loading');
    loading.hide();
    $(document).ajaxStart(function() {
        loading.show();
    })
    .ajaxStop(function() {        
        loading.hide();             
    });

    $("#search").click(function() {
        let str = $('input[name="search-title"]').val();
        let cat = $('input[name="search-category"]').val();
        $.ajax({
            method: "POST",
            url: "?archives/searchDocuments",
            data: { 
                "title": str,
                "cat": cat
             }
        })
        .done(function( msg ) {
            $("#table-content").html(msg);
            let id = $("#table-content table tr:nth-child(2) td:nth-child(1)").attr('document');
            $.ajax({
                method: "POST",
                url: "?archives/detail",
                data: { "document": id }
            })
            .done(function( msg2 ) {
                $("#reszletek").html(msg2);
            });
        });
    });

    $("#admin_search").click(function() {
        let str = $('input[name="search-title"]').val();
        let cat = $('input[name="search-category"]').val();
        $.ajax({
            method: "POST",
            url: "?archives/adminSearchDocuments",
            data: { 
                "title": str,
                "cat": cat
             }
        })
        .done(function( msg ) {
            $("#admin-table-content").html(msg);           
        });
    });

    $("#cancel").click(function() {
        $('input[name="search-title"]').val('');
        $.ajax({
            method: "POST",
            url: "?archives/allDocuments",
            data: null
        })
        .done(function( msg ) {
            $("#table-content").html(msg);
            let id = $("#table-content table tr:nth-child(2) td:nth-child(1)").attr('document');
            $.ajax({
                method: "POST",
                url: "?archives/detail",
                data: { "document": id }
            })
            .done(function( msg2 ) {
                $("#reszletek").html(msg2);
            });
        });
    });

    $("#admin_cancel").click(function() {
        $('input[name="search-title"]').val('');
        $.ajax({
            method: "POST",
            url: "?archives/adminAllDocuments",
            data: null
        })
        .done(function( msg ) {
            $("#admin-table-content").html(msg);            
        });
    });

    $("#menu").click(function() {        
        if($("#menu_panel").css("display") == "none") {
            $("#menu_panel").slideDown("slow");
            $("#menu").html('Admin menü &#8613;');
        } else {
            $("#menu_panel").slideUp("slow");
            $("#menu").html('Admin menü &#8615;');
        }
    });

    $('#vissza').click(function() {
        location.href='?archives/index';
    });

});



