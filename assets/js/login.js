$(document).ready(function(){
    $("#aceito").click(function(){
        var aceita = $(this).is(':checked');
        if(aceita == true){
            $('#cadastro').removeAttr('disabled');
        }else{
            $('#cadastro').attr('disabled', true);
        }
    });

    $("#form-cadastro").on("submit", function(e){
        e.preventDefault();
        // sucesso("Funcinou");
        // erro("Não funcinou");
        atencao("Deu problema.");
    });
});

function sucesso(texto){
    $("#notificacao").html("<div class='col-lg-6 offset-lg-3 alert alert-success alert-dismissible fade show animate__animated animate__slideInDown' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Sucesso! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function erro(texto){
    $("#notificacao").html("<div class='col-lg-6 offset-lg-3 alert alert-danger alert-dismissible fade show animate__animated animate__slideInDown' role='alert'><span class='alert-icon'><i class='fas fa-times'></i></span><span class='alert-text'><strong>Erro! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function atencao(texto){
    $("#notificacao").html("<div class='col-lg-6 offset-lg-3 alert alert-warning alert-dismissible fade show animate__animated animate__slideInDown' role='alert'><span class='alert-icon'><i class='fas fa-exclamation-triangle'></i></span><span class='alert-text'><strong>Atenção! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}