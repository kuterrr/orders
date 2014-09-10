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
            
            if ($(this).attr("href"))
            {
                var modal = $(this).data("target");
                $.ajax({
                    url:$(this).attr("href"),
                    dataType:'html',     
                    type : 'post',
                }).done(function(data){    
                    $(modal+" .modal-content").html(data);                   
                })
            }
        }
    });
    //исполнитель нажал выполнить
    $("body").on("click",".execute",function(e){
        e.preventDefault();
        e.stopPropagation();         
        var id = $(this).data("id");
        $.ajax({
            url: "/ajax/actions.php",
            data: 'id='+id+"&action=execute",
            dataType:'html',     
            type : 'post',
        }).done(function(data){    
            $("#executor_account").html(data);
            $("#order"+id).remove();
        })
    });
    
    $(document).on("submit","form",function(){
        console.log();
        var params = $(this).serialize();
        if($(this).find("[name=action]").val())
            eval($(this).find("[name=action]").val()+"('"+params+"')");
        return false;
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

function add_order(params)
{
    $.ajax({
        url: "ajax/actions.php",
        data : params,  
        type : 'post',
        beforeSend: function () {
            // @todo: check fields
        },
        success : function (data) {                            
            $("#modal .modal-content").html(data);
            if (!data)
            {
                close_modal();
                getUserOrders();
            }
        }
    });
    return false;
}
function getUserOrders()
{
    $.ajax({
        url:"/ajax/get_user_orders.php",
        dataType:'html',     
        type : 'post',
    }).done(function(data){    
        $("#user_orders").html(data);                   
    });
}