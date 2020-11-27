urlSite = window.location.href;
$(document).ready(function(){
    $("#aceito").click(function(){
        var aceita = $(this).is(':checked');
        if(aceita){
            $('#cadastro').removeAttr('disabled');
        }else{
            $('#cadastro').attr('disabled', true);
        }
    });

    $("#form-cadastro").on("submit", function(e){
        e.preventDefault();
        var nome            = $("#nome").val();
        var sobrenome       = $("#sobrenome").val();
        var email           = $("#email").val();
        var senha           = $("#senha").val();
        var confirmaSenha   = $("#confirmaSenha").val();

        if(nome == ''){
            atencao("O campo <strong class='text-uppercase'>nome</strong> é <strong>obrigatório</strong>.");
        }
        else if(nome.length < 3){
            atencao("O campo <strong class='text-uppercase'>nome</strong> deve conter no mínimo <strong>3 caracteres</strong>.");
        }
        else if(!isNaN(nome)){
            atencao("O campo <strong class='text-uppercase'>nome</strong> não deve conter <strong>caracteres numéricos</strong>.");
        }
        else if(sobrenome == ''){
            atencao("O campo <strong class='text-uppercase'>sobrenome</strong> é <strong>obrigatório</strong>.");
        }
        else if(sobrenome.length < 3){
            atencao("O campo <strong class='text-uppercase'>sobrenome</strong> deve conter no mínimo <strong>3 caracteres</strong>.");
        }
        else if(!isNaN(sobrenome)){
            atencao("O campo <strong class='text-uppercase'>sobrenome</strong> não deve conter <strong>caracteres numéricos</strong>.");
        }
        else if(email == ''){
            atencao("O campo <strong class='text-uppercase'>e-mail</strong> é <strong>obrigatório</strong>.");
        }
        else if(!validaEmail(email)){
            atencao("Digite um <strong class='text-uppercase'>e-mail</strong> <strong>válido</strong>.");
        }
        else if(senha == ''){
            atencao("O campo <strong class='text-uppercase'>senha</strong> é <strong>obrigatório</strong>.");
        }
        else if(forcaDaSenha(senha) < 70){
            atencao("Para segurança das suas informações sua <strong class='text-uppercase'>senha</strong> precisa ser <strong>mais forte</strong>.");
        }
        else if(confirmaSenha == ''){
            atencao("O campo <strong class='text-uppercase'>confirma senha</strong> é <strong>obrigatório</strong>.");
        }
        else if(confirmaSenha != senha){
            atencao("Os campos de senha não coincidem.");
        }else{
            $.ajax({
                url: urlSite+'/verificaEmail/',
                type: 'POST',
                data:{email:email},
                success: function(dados){
                    if(dados == 1){
                        atencao("O <strong class='text-uppercase'>e-mail</strong> que você digitou <strong>já consta em nosso sistema</strong>.");
                    }else{
                        $.ajax({
                            url: urlSite+'/cadastro/',
                            type: 'POST',
                            data: {nome:nome, sobrenome:sobrenome, email:email, senha:senha, recaptcha:grecaptcha.getResponse()},
                            success: function(dados){
                                if(dados == 1){
                                    sucesso("Seu cadastro foi realizado com sucesso. Enviamos um link de confirmação de cadastro para o e-mail informado.<br>Você será redirecionado(a) para a página inicial em 6 segundos.");
                                    setTimeout(function(){
                                        window.location.href = 'inicio';
                                    }, 6000);
                                }else if(dados == 2){
                                    atencao("Não é possível fazer cadastro de um robô!");
                                }
                                else{
                                    erro("Infelizmente não foi possível realizar seu cadastro. Tente novamente mais tarde!");
                                }
                            }
                        });
                    }
                }
            });
        }
    });

    $("#senha").keyup(function(){
        var senha = $(this).val();
        var forca = forcaDaSenha(senha);

        if((forca >= 0) && (forca < 20)){                  
            $(".forcaSenha").html("<small>Força da senha: <span class='text-danger font-weight-700'>muito fraca</span></small>");
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
    function sucesso(texto){
        $("#notificacao").html("<div class='col-lg-4 offset-lg-4 alert alert-success alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Sucesso! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
    }
    function erro(texto){
        $("#notificacao").html("<div class='col-lg-4 offset-lg-4 alert alert-danger alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-times'></i></span><span class='alert-text'><strong>Erro! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
    }
    function atencao(texto){
        $("#notificacao").html("<div class='col-lg-4 offset-lg-4 alert alert-warning alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-exclamation-triangle'></i></span><span class='alert-text'><strong>Atenção! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
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
});