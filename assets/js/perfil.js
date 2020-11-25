urlSite = window.location.href;
$(document).ready(function(){
    $("#botaoAlteracaoUsuario").click(function(e){
        e.preventDefault();
        let nome, sobrenome, email;

        nome            = $("#primeiro_nome").val();
        sobrenome       = $("#sobrenome").val();
        email           = $("#email").val();

        if(nome == ''){
            atencaoPerfil("O campo <strong class='text-uppercase'>nome</strong> é <strong>obrigatório</strong>.");
        }
        else if(nome.length < 3){
            atencaoPerfil("O campo <strong class='text-uppercase'>nome</strong> deve conter no mínimo <strong>3 caracteres</strong>.");
        }
        else if(!isNaN(nome)){
            atencaoPerfil("O campo <strong class='text-uppercase'>nome</strong> não deve conter <strong>caracteres numéricos</strong>.");
        }
        else if(sobrenome == ''){
            atencaoPerfil("O campo <strong class='text-uppercase'>sobrenome</strong> é <strong>obrigatório</strong>.");
        }
        else if(sobrenome.length < 3){
            atencaoPerfil("O campo <strong class='text-uppercase'>sobrenome</strong> deve conter no mínimo <strong>3 caracteres</strong>.");
        }
        else if(!isNaN(sobrenome)){
            atencaoPerfil("O campo <strong class='text-uppercase'>sobrenome</strong> não deve conter <strong>caracteres numéricos</strong>.");
        }
        else if(email == ''){
            atencaoPerfil("O campo <strong class='text-uppercase'>e-mail</strong> é <strong>obrigatório</strong>.");
        }
        else if(!validaEmail(email)){
            atencaoPerfil("Digite um <strong class='text-uppercase'>e-mail</strong> <strong>válido</strong>.");
        }else{
            $.ajax({
                url: urlSite+'/alteraUsuario/',
                type: 'POST',
                data: {nome:nome, sobrenome:sobrenome, email:email},
                success: function(dados){
                    if(dados == 1){
                        sucessoPerfil("Alteração das informações de usuário realizada com sucesso.");
                        setTimeout(function(){window.location.reload();}, 5000);
                    }else{
                        atencaoPerfil("As informações enviadas já estão em uso.");
                        setTimeout(function(){$(".alert").alert('close');}, 3000);
                    }
                }
            });      
        }
    });
    
    $("#botaoAlteracaoSenha").click(function(e){
        e.preventDefault();
        let senha, confirmasenha;

        senha           = $("#senha").val();
        confirmasenha   = $("#confirmaSenha").val();

        if(senha == ''){
            atencaoPerfil("O campo <strong class='text-uppercase'>senha</strong> é <strong>obrigatório</strong>.");
        }
        else if(forcaDaSenha(senha) < 70){
            atencaoPerfil("Para segurança das suas informações sua <strong class='text-uppercase'>senha</strong> precisa ser <strong>mais forte</strong>.");
        }
        else if(confirmasenha == ''){
            atencaoPerfil("O campo <strong class='text-uppercase'>confirma senha</strong> é <strong>obrigatório</strong>.");
        }
        else if(confirmasenha != senha){
            atencaoPerfil("Os campos de senha não coincidem.");
        }else{
            $.ajax({
                url: urlSite+'/alteraSenha/',
                type: 'POST',
                data: {senha:senha},
                success: function(dados){
                    if(dados == 1){
                        sucessoPerfil("Senha alterada com sucesso.");
                        setTimeout(function(){window.location.reload();}, 5000);
                    }
                    else{
                        atencaoPerfil("A senha que você enviou já está em uso.");
                        setTimeout(function(){$(".alert").alert('close');}, 3000);
                    }
                }
            });      
        }
    });
    
    $("#botaoAlteracaoEndereco").click(function(e){
        e.preventDefault();
        sucessoPerfil("Endereço");
        setTimeout(function(){$(".alert").alert('close');}, 3000);
    });
    
    $("#botaoAlteracaoContato").click(function(e){
        e.preventDefault();
        sucessoPerfil("Contato");
        setTimeout(function(){$(".alert").alert('close');}, 3000);
    });
});

function sucessoPerfil(texto){
    $("#notificacaoPerfil").html("<div class='col-lg-4 offset-lg-4 alert alert-success alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Sucesso! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function erroPerfil(texto){
    $("#notificacaoPerfil").html("<div class='col-lg-4 offset-lg-4 alert alert-danger alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-times'></i></span><span class='alert-text'><strong>Erro! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function atencaoPerfil(texto){
    $("#notificacaoPerfil").html("<div class='col-lg-4 offset-lg-4 alert alert-warning alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-exclamation-triangle'></i></span><span class='alert-text'><strong>Atenção! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}

$("#senha").keyup(function(){
    var senha = $(this).val();
    var forca = forcaDaSenha(senha);

    if((forca >= 0) && (forca < 20)){                  
        $(".forcaSenha").html("<small>Força da senha: <span class='text-danger text-center font-weight-700'>muito fraca</span></small>");
    }
    else if((forca >= 20) && (forca < 40)){
        $(".forcaSenha").html("<small>Força da senha: <span class='text-warning font-weight-700'>fraca</span></small>");
    }
    else if((forca >= 40) && (forca < 60)){
        $(".forcaSenha").html("<small>Força da senha: <span class='text-info font-weight-700'>legal</span></small>");
    }
    else if((forca >= 60) && (forca < 80)){
        $(".forcaSenha").html("<small>Força da senha: <span class='text-default font-weight-700'>boa</span></small>");
    }
    else{
        $(".forcaSenha").html("<small>Força da senha: <span class='text-success font-weight-700'>perfeita</span></small>");
    }
});

function validaEmail(email){
    var expressao = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return expressao.test(email);
}

function forcaDaSenha(senha){
    var forca = 0;

    if(senha.length > 4 && senha.length < 8){
        forca += 10;
    }
    else if(senha.length >= 8){
        forca += 40;
    }

    if((senha.length > 0) && (senha.match(/[a-z]+/))){
        forca += 15;
    }
    if((senha.length > 0) && (senha.match(/[A-Z]+/))){
        forca += 15;
    }
    if((senha.length > 0) && (senha.match(/[0-9]+/))){
        forca += 10;
    }
    if((senha.length > 0) && (senha.match(/[^a-z0-9]/i))){
        forca += 20;
    }

    return forca;
}