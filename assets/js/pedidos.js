urlSite = window.location.href;
$(document).ready(function(){
    var produtoPedido;
    var identificacao;
    var observacao;
    var tipoCliente;
    var final;
    var revendedor;

    $("#cadastraPedido").on("submit", function(e){
        e.preventDefault();

        produtoPedido   = $("#produtoPedido").val();
        identificacao   = $("#identificacao").val();
        observacao      = $("#observacao").val();

        if(produtoPedido == null){
            atencaoProdutos("O campo <b>produto</b> é obrigatório!");
        }else if(identificacao == ''){
            atencaoProdutos("O campo <b>Identificação do Produto</b> é obrigatório!");
        }else{
            $(this).addClass('d-none');
            $("#clientePedido").removeClass('d-none');
            $("#guia2-tab").addClass('active');
        }
    });

    $("input[type='radio']").on("click", function(){
        tipoCliente = $("input[name='cliente']:checked").val();

        if(tipoCliente == "Final"){
            $("#clienteFinal").removeClass('d-none');
            $("#clienteRevendedor").addClass('d-none');
        }else{
            $("#clienteRevendedor").removeClass('d-none');
            $("#clienteFinal").addClass('d-none');
        }
    });
    
    $("#enviaFinal").on("click", function(){
        final = $("#nomeClienteFinal").val();

        if(final == ''){
            atencaoProdutos("O campo <b>nome do cliente</b> é obrigatório.");
        }else{
            $("#clientePedido").addClass('d-none');
            $("#especificacaoMaterial").removeClass('d-none');
            $("#guia3-tab").addClass('active');
            revendedor = null;
        }
    });
    $("#enviaRevenda").on("click", function(){
        revendedor = $("#clienteRevenda").val();

        if(revendedor == null){
            atencaoProdutos("O campo <b>cliente</b> é obrigatório.");
        }else{
            $("#clientePedido").addClass('d-none');
            $("#especificacaoMaterial").removeClass('d-none');
            $("#guia3-tab").addClass('active');
            final = '';
        }
    });
});

function sucessoPedidos(texto){
    $("#notificacaoPedidos").html("<div class='col-lg-4 offset-lg-4 alert alert-success alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Sucesso! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function erroProdutos(texto){
    $("#notificacaoPedidos").html("<div class='col-lg-4 offset-lg-4 alert alert-danger alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-times'></i></span><span class='alert-text'><strong>Erro! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function atencaoProdutos(texto){
    $("#notificacaoPedidos").html("<div class='col-lg-4 offset-lg-4 alert alert-warning alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-exclamation-triangle'></i></span><span class='alert-text'><strong>Atenção! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function string_to_slug (nome) {
    nome = nome.replace('/^\s+|\s+$/g', ''); // tira os espaços do começo e do fim do texto
    nome = nome.toLowerCase();
  
    // remove caracteres especiais
    var from = "ãàáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to   = "aaaaaeeeeiiiioooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
        nome = nome.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    nome = nome.replace(/[^a-z0-9 -]/g, '') // remove caracteres invalidos
        .replace(/\s+/g, '-') // transforma espaço para -
        .replace(/-+/g, '-'); // transforma as traves

    return nome;
}