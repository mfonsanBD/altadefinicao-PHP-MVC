$(document).ready(function(){
    getData();
});

function getData() {
    $.ajax({
        url: "/sistema/Notificacoes/quantidadeNotificacoes/",
        dataType: 'json',
        success: function(resposta){
            $("#quantidadeNotificacao").html(resposta);
            $("#quantidadeNotificacaobtn").html(resposta);
        },
        complete: function(){
           setTimeout(getData, 10000);
        }
    });
}