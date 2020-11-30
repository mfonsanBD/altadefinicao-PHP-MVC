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
            fechaAlerta();
        }
        else if(nome.length < 3){
            atencaoPerfil("O campo <strong class='text-uppercase'>nome</strong> deve conter no mínimo <strong>3 caracteres</strong>.");
            fechaAlerta();
        }
        else if(!isNaN(nome)){
            atencaoPerfil("O campo <strong class='text-uppercase'>nome</strong> não deve conter <strong>caracteres numéricos</strong>.");
            fechaAlerta();
        }
        else if(sobrenome == ''){
            atencaoPerfil("O campo <strong class='text-uppercase'>sobrenome</strong> é <strong>obrigatório</strong>.");
            fechaAlerta();
        }
        else if(sobrenome.length < 3){
            atencaoPerfil("O campo <strong class='text-uppercase'>sobrenome</strong> deve conter no mínimo <strong>3 caracteres</strong>.");
            fechaAlerta();
        }
        else if(!isNaN(sobrenome)){
            atencaoPerfil("O campo <strong class='text-uppercase'>sobrenome</strong> não deve conter <strong>caracteres numéricos</strong>.");
            fechaAlerta();
        }
        else if(email == ''){
            atencaoPerfil("O campo <strong class='text-uppercase'>e-mail</strong> é <strong>obrigatório</strong>.");
            fechaAlerta();
        }
        else if(!validaEmail(email)){
            atencaoPerfil("Digite um <strong class='text-uppercase'>e-mail</strong> <strong>válido</strong>.");
            fechaAlerta();
        }else{
            $.ajax({
                url: urlSite+'/alteraUsuario/',
                type: 'POST',
                data: {nome:nome, sobrenome:sobrenome, email:email},
                success: function(dados){
                    if(dados == 1){
                        sucessoPerfil("Alteração das informações de usuário realizada com sucesso.");
                        atualizaPagina();
                    }else{
                        atencaoPerfil("As informações enviadas já estão em uso.");
                        fechaAlerta();
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
            fechaAlerta();
        }
        else if(confirmasenha == ''){
            atencaoPerfil("O campo <strong class='text-uppercase'>confirma senha</strong> é <strong>obrigatório</strong>.");
            fechaAlerta();
        }
        else if(forcaDaSenha(senha) < 70){
            atencaoPerfil("Para segurança das suas informações sua <strong class='text-uppercase'>senha</strong> precisa ser <strong>mais forte</strong>.");
            fechaAlerta();
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
                        atualizaPagina();
                    }
                    else{
                        atencaoPerfil("A senha que você enviou já está em uso.");
                        fechaAlerta();
                    }
                }
            });      
        }
    });
    
    var resize = $('#upload-demo-usuario').croppie({
        enableExif: true,
        enableOrientation: true,    
        viewport: { 
            width: 140,
            height: 140, 
            type: 'circle'
        },
        boundary: {
            width: 140,
            height: 140
        }
    });
    $('#imageUsuario').on('change', function () { 
        var reader = new FileReader();
        reader.onload = function (e) {
            resize.croppie('bind',{
            url: e.target.result
            });
        }
        reader.readAsDataURL(this.files[0]);
    });
    $('.btn-upload-image-usuario').on('click', function (ev) {
        resize.croppie('result', {
        type: 'canvas',
        size: 'viewport',
        format: 'jpeg'
        }).then(function (img) {
            $.ajax({
                url: urlSite+'/alteraFotoUsuario/',
                type: 'POST',
                data: {img:img},
                success: function(dados){
                    if(dados == 1){
                        sucessoPerfil("Foto de perfil alterada com sucesso!");
                        atualizaPagina();
                    }else{
                        atencaoPerfil("A extenção da imagem que você enviou não é permitida em nosso sistema.");
                        fechaAlerta();
                    }
                }
            });
        });
    });
    
    $("#botaoCadastraEndereco").click(function(e){
        e.preventDefault();
        sucessoEndereco("Endereço");
        setTimeout(function(){$(".alert").alert('close');}, 3000);
    });
    
    $("#botaoAlteracaoContato").click(function(e){
        e.preventDefault();
        let fixo        = $("#fixo").val();
        let celular     = $("#celular").val();
        let whatsapp    = $("#whatsapp").val();

        if(fixo == "" || celular == "" || whatsapp == ""){
            atencaoPerfil("Nenhum campo de contato deve estar vazio.");
            fechaAlerta();
        }else{
            $.ajax({
                url: urlSite+'/alteraContato/',
                type: 'POST',
                data: {fixo:fixo, celular:celular, whatsapp:whatsapp},
                success: function(dados){
                    if(dados == 1){
                        sucessoPerfil("Alteração das informações de contato realizada com sucesso.");
                        atualizaPagina();
                    }else{
                        atencaoPerfil("As informações enviadas já estão em uso.");
                        fechaAlerta();
                    }
                }
            });
        }
    });

    $('.fixo').mask('(00) 0000-0000');
    $('.celular').mask('(00) 00000-0000');
    $('.whatsapp').mask('+00 (00) 00000-0000');
    $('.cep').mask('00000-000');
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

function sucessoEndereco(texto){
    $("#notificacaoEndereco").html("<div class='col-lg-4 offset-lg-4 alert alert-success alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Sucesso! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function erroEndereco(texto){
    $("#notificacaoEndereco").html("<div class='col-lg-4 offset-lg-4 alert alert-danger alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-times'></i></span><span class='alert-text'><strong>Erro! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function atencaoEndereco(texto){
    $("#notificacaoEndereco").html("<div class='col-lg-4 offset-lg-4 alert alert-warning alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-exclamation-triangle'></i></span><span class='alert-text'><strong>Atenção! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
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

function fechaAlerta(){
    setTimeout(function(){
        $(".alert").alert('close');
    }, 3000);
}

function atualizaPagina(){
    setTimeout(function(){
        window.location.reload();
    }, 3000);
}