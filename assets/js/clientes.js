urlSite = window.location.href;
$(document).ready(function(){
    $("#cadastraCliente").on("submit", function(e){
        e.preventDefault();

        var nomeCliente             = $("#nomeCliente").val();
        var sobrenomeCliente        = $("#sobrenomeCliente").val();
        var emailCliente            = $("#emailCliente").val();
        var senhaCliente            = $("#senhaCliente").val();
        var confirmaSenhaCliente    = $("#confirmaSenhaCliente").val();

        if(nomeCliente == ''){
            atencaoClientes("O campo <strong class='text-uppercase'>nome</strong> é <strong>obrigatório</strong>.");
        }
        else if(nomeCliente.length < 3){
            atencaoClientes("O campo <strong class='text-uppercase'>nome</strong> deve conter no mínimo <strong>3 caracteres</strong>.");
        }
        else if(!isNaN(nomeCliente)){
            atencaoClientes("O campo <strong class='text-uppercase'>nome</strong> não deve conter <strong>caracteres numéricos</strong>.");
        }
        else if(sobrenomeCliente == ''){
            atencaoClientes("O campo <strong class='text-uppercase'>sobrenome</strong> é <strong>obrigatório</strong>.");
        }
        else if(sobrenomeCliente.length < 3){
            atencaoClientes("O campo <strong class='text-uppercase'>sobrenome</strong> deve conter no mínimo <strong>3 caracteres</strong>.");
        }
        else if(!isNaN(sobrenomeCliente)){
            atencaoClientes("O campo <strong class='text-uppercase'>sobrenome</strong> não deve conter <strong>caracteres numéricos</strong>.");
        }
        else if(emailCliente == ''){
            atencaoClientes("O campo <strong class='text-uppercase'>e-mail</strong> é <strong>obrigatório</strong>.");
        }
        else if(!validaEmailCliente(emailCliente)){
            atencaoClientes("Digite um <strong class='text-uppercase'>e-mail</strong> <strong>válido</strong>.");
        }
        else if(senhaCliente == ''){
            atencaoClientes("O campo <strong class='text-uppercase'>senha</strong> é <strong>obrigatório</strong>.");
        }
        else if(forcaDaSenhaCliente(senhaCliente) < 70){
            atencaoClientes("Para segurança das suas informações sua <strong class='text-uppercase'>senha</strong> precisa ser <strong>mais forte</strong>.");
        }
        else if(confirmaSenhaCliente == ''){
            atencaoClientes("O campo <strong class='text-uppercase'>confirma senha</strong> é <strong>obrigatório</strong>.");
        }
        else if(confirmaSenhaCliente != senhaCliente){
            atencaoClientes("Os campos de senha não coincidem.");
        }else{
            $.ajax({
                url: urlSite+'/verificaEmail/',
                type: 'POST',
                data:{email:emailCliente},
                success: function(dados){
                    if(dados == 1){
                        atencaoClientes("O <strong class='text-uppercase'>e-mail</strong> que você digitou <strong>já consta em nosso sistema</strong>.");
                    }else{
                        $.ajax({
                            url: urlSite+'/cadastraCliente/',
                            type: 'POST',
                            data: {nome:nomeCliente, sobrenome:sobrenomeCliente, email:emailCliente, senha:senhaCliente},
                            success: function(dados){
                                if(dados == 1){
                                    sucessoClientes("Cliente cadastrado com sucesso!");
                                    setTimeout(function(){
                                        window.location.reload();
                                    }, 3000);
                                }
                                else{
                                    erroClientes("Não foi possível cadastrar um novo cliente. Tente novamente mais tarde!");
                                }
                            }
                        });
                    }
                }
            });
        }
    });

    // $("#confirmaExclusaoDeCliente").on("show.bs.modal", function(event){
    //     var botao = $(event.relatedTarget);
    //     var id = botao.data("id");
    //     var nome = botao.data("nome");

    //     $("produto").html(nome);

    //     $("#botaoConfirmaExclusao").on("click", function(){
    //         $.ajax({
    //             url: urlSite+'/excluiCliente/',
    //             type: 'POST',
    //             data: {idProduto:id},
    //             success: function(dados){
    //                 if(dados == 1){
    //                     sucessoProdutos(nome+" excluido com sucesso!");
    //                     setTimeout(function(){
    //                         window.location.reload();
    //                     }, 3000);
    //                 }else{
    //                     erroProdutos("Não foi possível excluir o produto. Tente novamente mais tarde.");
    //                 }
    //             }
    //         });
    //     });
    // });
    
    $('#tabelaDeClientes').DataTable({
        "language": {
            "url": "assets/js/Portuguese-Brasil.json"
        }
    });
});

$("#senhaCliente").keyup(function(){
    var senha = $(this).val();
    var forcaSenha = forcaDaSenhaCliente(senha);

    if((forcaSenha >= 0) && (forcaSenha < 20)){                  
        $(".forcaSenha").html("<small>Força da senha: <span class='text-danger font-weight-700'>muito fraca</span></small>");
    }
    else if((forcaSenha >= 20) && (forcaSenha < 40)){
        $(".forcaSenha").html("<small>Força da senha: <span class='text-warning font-weight-700'>fraca</span></small>");
    }
    else if((forcaSenha >= 40) && (forcaSenha < 60)){
        $(".forcaSenha").html("<small>Força da senha: <span class='text-info font-weight-700'>legal</span></small>");
    }
    else if((forcaSenha >= 60) && (forcaSenha < 80)){
        $(".forcaSenha").html("<small>Força da senha: <span class='text-default font-weight-700'>boa</span></small>");
    }
    else{
        $(".forcaSenha").html("<small>Força da senha: <span class='text-success font-weight-700'>perfeita</span></small>");
    }
});
function validaEmailCliente(email){
    var expressao = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return expressao.test(email);
}
function sucessoClientes(texto){
    $("#notificacaoProduto").html("<div class='col-lg-4 offset-lg-4 alert alert-success alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Sucesso! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function erroClientes(texto){
    $("#notificacaoProduto").html("<div class='col-lg-4 offset-lg-4 alert alert-danger alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-times'></i></span><span class='alert-text'><strong>Erro! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function atencaoClientes(texto){
    $("#notificacaoProduto").html("<div class='col-lg-4 offset-lg-4 alert alert-warning alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-exclamation-triangle'></i></span><span class='alert-text'><strong>Atenção! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function forcaDaSenhaCliente(senha){
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