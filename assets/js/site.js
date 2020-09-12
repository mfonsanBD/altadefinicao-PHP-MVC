urlSite = window.location.href;
$(document).ready(function(){
    $("#mais-noticias").click(function(){
        window.location.href = 'noticias';
    });
    
    $("#botaoLogin").click(function(){
        window.location.href = 'login';
    });
    
    $("#botaoPainel").click(function(){
        window.location.href = 'painel';
    });

    $("#politica").click(function(){
        var marcado = $(this).is(':checked');
        if(marcado == true){
            $('#botao-cadastrar').removeAttr('disabled');
        }else{
            $('#botao-cadastrar').attr('disabled', true);
        }
    });
    
    $("#formContato").on("click", function(e){
        e.preventDefault();
        var nome        = $("#nomeContato").val();
        var sobrenome   = $("#sobrenomeContato").val();
        var email       = $("#emailContato").val();
        var assunto     = $("#assuntoContato").val();
        var mensagem    = $("#mensagemContato").val();

        var soTexto         = new RegExp("^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$");

        if(nome == ''){
            atencaoFormContato("O campo <strong>Nome*</strong> é obrigatório!");
        }else if(nome.length < 3){
            atencaoFormContato("O campo <strong>Nome*</strong> deve conter no mínimo 3 caracteres!");
        }else if(!nome.match(soTexto)){
            atencaoFormContato("O campo <strong>Nome*</strong> só pode conter letras!");
        }else if(sobrenome == ''){
            atencaoFormContato("O campo <strong>Sobrenome*</strong> é obrigatório!");
        }else if(sobrenome.length < 3){
            atencaoFormContato("O campo <strong>Sobrenome*</strong> deve conter no mínimo 3 caracteres!");
        }else if(!sobrenome.match(soTexto)){
            atencaoFormContato("O campo <strong>Sobrenome*</strong> só pode conter letras!");
        }else if(email == ''){
            atencaoFormContato("O campo <strong>E-mail*</strong> é obrigatório!");
        }else if(!validaEmail(email)){
            atencaoFormContato("O campo <strong>Sobrenome*</strong> só pode conter letras!");
        }else if(assunto == ''){
            atencaoFormContato("O campo <strong>Assunto*</strong> é obrigatório!");
        }else if(mensagem == ''){
            atencaoFormContato("O campo <strong>Mensagem*</strong> é obrigatório!");
        }else{
            $.ajax({
                url: urlSite+'/enviaContato/',
                type: 'POST',
                data: {nome:nome, sobrenome:sobrenome, email:email, assunto:assunto, mensagem:mensagem, recaptcha:grecaptcha.getResponse()},
                success: function(dados){
                    if(dados == 1){
                        sucessoFormContato("Enviou!");
                    }else{
                        erroFormContato("Não pôde ser enviado!");
                    }
                }
            });
        }
    });
});

function sucessoFormContato(texto){
    $("#notificacaoFormContato").html("<div class='col-lg-4 offset-lg-4 alert alert-success alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-thumbs-up'></i></span><span class='alert-text'><strong> Sucesso! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function erroFormContato(texto){
    $("#notificacaoFormContato").html("<div class='col-lg-4 offset-lg-4 alert alert-danger alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-times'></i></span><span class='alert-text'><strong> Erro! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function atencaoFormContato(texto){
    $("#notificacaoFormContato").html("<div class='col-lg-4 offset-lg-4 alert alert-warning alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-exclamation-triangle'></i></span><span class='alert-text'><strong> Atenção! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function validaEmail(email){
    var expressao = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return expressao.test(email);
}