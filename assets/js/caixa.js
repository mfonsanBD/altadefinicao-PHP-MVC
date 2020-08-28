urlSite = window.location.href;

$(document).ready(function(){
    var hoje = new Date();
    var dia = hoje.getUTCDate();
    var mes = hoje.getUTCMonth()+1;
    var ano = hoje.getFullYear();
    
    if(dia < 10){
        dia = "0"+dia;
    }
    if(mes < 10){
        mes = "0"+mes;
    }
    
    var dataAtual =  dia+"/"+mes+"/"+ano;
    $("#dataCaixa").attr("value", dataAtual);

    $("$dataCaixa").on("change", true);
    var dataDefinida = $("#dataCaixa").val();
});

function sucessoCaixa(texto){
    $("#notificacaoCaixa").html("<div class='col-lg-4 offset-lg-4 alert alert-success alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Sucesso! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function erroCaixa(texto){
    $("#notificacaoCaixa").html("<div class='col-lg-4 offset-lg-4 alert alert-danger alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-times'></i></span><span class='alert-text'><strong>Erro! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function atencaoCaixa(texto){
    $("#notificacaoCaixa").html("<div class='col-lg-4 offset-lg-4 alert alert-warning alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-exclamation-triangle'></i></span><span class='alert-text'><strong>Atenção! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}