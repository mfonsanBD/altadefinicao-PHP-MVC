urlSite = window.location.href;
$(document).ready(function(){
    $("#form-login").on("submit", function(e){
        e.preventDefault();
        var email           = $("#emailLogin").val();
        var senha           = $("#senhaLogin").val();
        
        if(email == ''){
            atencaoLogin("O campo <strong class='text-uppercase'>e-mail</strong> é <strong>obrigatório</strong>.");
        }
        else if(!validaEmailLogin(email)){
            console.log("E-mail inválido!");
            atencaoLogin("Digite um <strong class='text-uppercase'>e-mail</strong> <strong>válido</strong>.");
        }
        else if(senha == ''){
            atencaoLogin("O campo <strong class='text-uppercase'>senha</strong> é <strong>obrigatório</strong>.");
        }else{
            $.ajax({
                url: urlSite+'/verificaEmail/',
                type: 'POST',
                data: {email:email},
                success: function(dados){
                    if(dados == 1){
                        $.ajax({
                            url: urlSite+'/verificaSenha/',
                            type: 'POST',
                            data: {email:email, senha: senha},
                            success: function(dados){
                                if(dados == 1){
                                    $.ajax({
                                        url: urlSite+'/logar/',
                                        type: 'POST',
                                        data: {email:email, senha:senha, recaptcha:grecaptcha.getResponse()},
                                        success: function(dados){
                                            if(dados == 1){
                                                document.location.href = 'painel';
                                            }else if(dados == 2){
                                                erroLogin("Não é permitido a entrada de robô no sistema.")
                                            }else{
                                                erroLogin("Algo deu errado e infelizmente não foi possível fazer login! Tente novamente mais tarde.")
                                            }
                                        }
                                    });
                                }else{
                                    erroLogin("Senha incorreta!");
                                }
                            }
                        });
                    }else{
                        atencaoLogin("Este e-mail não consta em nosso sistema.");
                    }
                }
            });
        }
    });
});

function validaEmailLogin(email){
    var expressao = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return expressao.test(email);
}
function sucessoLogin(texto){
    $("#notificacaoLogin").html("<div class='col-lg-4 offset-lg-4 alert alert-success alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Sucesso! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function erroLogin(texto){
    $("#notificacaoLogin").html("<div class='col-lg-4 offset-lg-4 alert alert-danger alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-times'></i></span><span class='alert-text'><strong>Erro! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function atencaoLogin(texto){
    $("#notificacaoLogin").html("<div class='col-lg-4 offset-lg-4 alert alert-warning alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-exclamation-triangle'></i></span><span class='alert-text'><strong>Atenção! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}