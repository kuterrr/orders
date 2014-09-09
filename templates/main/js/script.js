$(function(){    
    //открываем всплывающее окно. Предполагается, что будет открыто только одно окно, чтобы не пугать пользователя
    $("body").on("click","[data-toggle=modal]",function(e){
        e.preventDefault();
        e.stopPropagation();
        if ($($(this).data("target")).hasClass("modal"))
        {
            $($(this).data("target")).show();
            if (!$("body").hasClass("modal-open"))
                $("body").addClass("modal-open");
            if ($(".overflow").hasClass("hidden"))
                $(".overflow").removeClass("hidden");        
        }
    });
    $("body").on("click",".close",function(e) {
        e.preventDefault();
        e.stopPropagation();        
        close_modal();
    });    
    $("body").keyup(function(e){
        if (event.keyCode == 27) {
            close_modal();
        }  
    })    

});

function close_modal() {
    $("body").removeClass("modal-open");        
    $(".overflow").addClass("hidden");
    $(".modal").hide();
}