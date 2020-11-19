urlSite = window.location.href;
$(document).ready(function(){
    let produtoPedido, identificacao, observacao, tipoCliente, final,
    revendedor, midia, acabamento, altura, largura, quantidade, tipoarte, infoCriacaoDeArte, arquivoArte, entrega, pagamento, totalDoPedido;

    $("#botaoCadastraPedido").click(function(e){
        e.preventDefault();

        produtoPedido   = $("#produtoPedido").val();
        identificacao   = $("#identificacao").val();
        observacao      = $("#observacao").val();

        if(produtoPedido == null){
            atencaoPedidos("O campo <b>produto</b> é obrigatório!");
            setTimeout(function(){$(".alert").alert('close');}, 5000);
        }else if(identificacao == ''){
            atencaoPedidos("O campo <b>Identificação do Produto</b> é obrigatório!");
            setTimeout(function(){$(".alert").alert('close');}, 5000);
        }else{
            $.ajax({
                url: urlSite+'/getMidias',
                type: 'POST',
                dataType: 'html',
                data: {idProduto:produtoPedido},
                success: function(resposta){
                    $("#midiasproduto").html(resposta);
                }
            });
            $.ajax({
                url: urlSite+'/getAcabamentos',
                type: 'POST',
                dataType: 'html',
                data: {idProduto:produtoPedido},
                success: function(resposta){
                    $("#acabamentosproduto").html(resposta);
                }
            });
            $("#cadastraPedido").addClass('d-none');
            $("#clientePedido").removeClass('d-none');
            $("#guia2-tab").addClass('active');
        }
    });

    $("input[type='radio']").on("click", function(){
        tipoCliente = $("input[name='tipocliente']:checked").val();

        if(tipoCliente == 1){
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
            atencaoPedidos("O campo <b>nome do cliente</b> é obrigatório.");
            setTimeout(function(){$(".alert").alert('close');}, 5000);
        }else{
            $("#clientePedido").addClass('d-none');
            $("#midiaMaterial").removeClass('d-none');
            $("#guia3-tab").addClass('active');
            revendedor = null;
        }
    });
   
    $("#enviaRevenda").on("click", function(){
        revendedor = $("#clienteRevenda").val();

        if(revendedor == null){
            atencaoPedidos("O campo <b>cliente</b> é obrigatório.");
            setTimeout(function(){$(".alert").alert('close');}, 5000);
        }else{
            $("#clientePedido").addClass('d-none');
            $("#midiaMaterial").removeClass('d-none');
            $("#guia3-tab").addClass('active');
            final = '';
        }
    });

    $("#botaoMidiaMaterial").click(function(e){
        e.preventDefault();
        midia               = $("input[name='midia']:checked").val();
        var midiaMarcada    = $("input[name='midia']").is(":checked");

        if(midiaMarcada == false){
            atencaoPedidos("O campo <b>Mídia</b> é obrigatório.");
            setTimeout(function(){$(".alert").alert('close');}, 5000);
        }else{
            $("#midiaMaterial").addClass('d-none');
            $("#acabamentoMaterial").removeClass('d-none');
            $("#guia4-tab").addClass('active');
        }
    });

    $("#botaoAcabamentoMaterial").click(function(e){
        e.preventDefault();
        acabamento                  = $("input[name='acabamento']:checked").val();
        let acabamentoMarcado       = $("input[name='acabamento']").is(":checked");

        if(acabamentoMarcado == false){
            atencaoPedidos("O campo <b>Acabamento</b> é obrigatório.");
            setTimeout(function(){$(".alert").alert('close');}, 5000);
        }else{
            $("#acabamentoMaterial").addClass('d-none');
            $("#medidasMaterial").removeClass('d-none');
            $("#guia5-tab").addClass('active');
        }
    });

    $("#botaoMedidasMaterial").click(function(e){
        e.preventDefault();
        altura = $("#alturaProduto").val();
        largura = $("#larguraProduto").val();

        if(altura == "" || largura == ""){
            atencaoPedidos("Os campos <b>Altura</b> e <b>Largura</b> são obrigatórios.");
            setTimeout(function(){$(".alert").alert('close');}, 5000);
        }else{
            $("#medidasMaterial").addClass('d-none');
            $("#quantidadeMaterial").removeClass('d-none');
            $("#guia6-tab").addClass('active');
        }
    });
    
    $("#botaoQuantidadeMaterial").click(function(e){
        e.preventDefault();
        quantidade = $("#quantidadeProduto").val();

        if(quantidade == ""){
            atencaoPedidos("O campo <b>Quantidade</b> é obrigatório.");
            setTimeout(function(){$(".alert").alert('close');}, 5000);
        }else if(isNaN(quantidade)){
            atencaoPedidos("O campo <b>Quantidade</b> só pode conter número.");
            setTimeout(function(){$(".alert").alert('close');}, 5000);
        }else{
            $("#quantidadeMaterial").addClass('d-none');
            $("#artePedido").removeClass('d-none');
            $("#guia7-tab").addClass('active');
        }
    });

    $("#botaoArtePedido").click(function(e){
        e.preventDefault();
        tipoarte                = $("input[name='tipoarte']:checked").val();
        let tipoarteMarcada     = $("input[name='tipoarte']").is(":checked");

        if(tipoarteMarcada == false){
            atencaoPedidos("O campo <b>Envio de Arte</b> é obrigatório.");
            setTimeout(function(){$(".alert").alert('close');}, 5000);
        }else{
            if(tipoarte == 0){
                $('#enviaarte').removeClass('d-none');
                $("#artePedido").addClass('d-none');

                $("#proximoEnviaArte").click(function(e){
                    e.preventDefault();
                    $("#enviaarte").addClass('d-none');
                    $("#entregaMaterial").removeClass('d-none');
                    $("#guia8-tab").addClass('active');
                });
            }else{
                $('#criaarte').removeClass('d-none');
                $("#artePedido").addClass('d-none');

                $("#proximoCriaArte").click(function(e){
                    e.preventDefault();
                    infoCriacaoDeArte = $("#infoArte").val();
                    
                    if(infoCriacaoDeArte == ""){
                        atencaoPedidos("As <b>informações para criação da arte</b> são obrigatórias");
                        setTimeout(function(){$(".alert").alert('close');}, 5000);
                    }else{
                        $("#criaarte").addClass('d-none');
                        $("#entregaMaterial").removeClass('d-none');
                        $("#guia8-tab").addClass('active');
                    }
                });
            }
        }
    });

    $("#botaoEntregaMaterial").click(function(e){
        e.preventDefault();
        entrega                  = $("input[name='entrega']:checked").val();
        let entregaMarcado       = $("input[name='entrega']").is(":checked");

        if(entregaMarcado == false){
            atencaoPedidos("O campo <b>Entrega</b> é obrigatório.");
            setTimeout(function(){$(".alert").alert('close');}, 5000);
        }else{
            $("#entregaMaterial").addClass('d-none');
            $("#pagamentoMaterial").removeClass('d-none');
            $("#guia9-tab").addClass('active');
        }
    });

    $("#botaoPagamentoMaterial").click(function(e){
        e.preventDefault();
        pagamento                  = $("input[name='pagamento']:checked").val();
        let pagamentoMarcado       = $("input[name='pagamento']").is(":checked");
        
        $.ajax({
            url: urlSite+'/getInformacoes',
            type: 'POST',
            data: {idProduto:produtoPedido, idTipoCliente:tipoCliente, idCliente:revendedor, idMidia:midia, idAcabamento:acabamento, altura:altura, largura:largura, quantidade:quantidade, final:final, entrega:entrega, pagamento:pagamento},
            dataType: 'json',
            success: function(response){
                $("produtopedido").html(response.nomeProduto);
                $("clientepedido").html(response.nomeCliente);
                $("midiapedido").html(response.nomeMidia);
                $("acabamentopedido").html(response.nomeAcabamento);
                $("entregapedido").html(response.nomeTipoEntrega);
                $("pagamentopedido").html(response.nomeFormaPagamento);
                $("totaldopedido").html(response.valorDoPedido);
                totalDoPedido = response.valorDoPedido;
            }
        });
        $("identificacaopedido").html(identificacao);
        $("medidaspedido").html(altura+" x "+largura);
        $("quantidadepedido").html(quantidade);

        if(pagamentoMarcado == false){
            atencaoPedidos("O campo <b>Método de Pagamento</b> é obrigatório.");
            setTimeout(function(){$(".alert").alert('close');}, 5000);
        }else{
            $("#pagamentoMaterial").addClass('d-none');
            $("#tabs-text").addClass('d-none');
            $("#confirmaInfoPedido").removeClass('d-none');
        }
    });

    $("#formNovoPedido").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: urlSite+'/addPedido',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(resposta){
                if(resposta == 1){
                    sucessoPedidos("Pedido adicionado com sucesso!");
                    setTimeout(function(){window.location.reload()}, 3000);
                }else if(resposta == 2){
                    atencaoPedidos("Esse tipo de arquivo não é permitido no sistema.");
                }else{
                    erroPedidos("Não foi possível adicionar este pedido no momento. Tente novamente mais tarde!");
                }
            }
        });
    });

    $("#processando").on("click", function(){
        var status = 1;
        var problema = "";
        var idPedido = $(this).attr("data-idPedido");
        alteraPedido(status, problema, idPedido);
        setTimeout(function(){
            window.location.reload();
        }, 3000);
    });
    
    $("#producao").on("click", function(){
        var status = 2;
        var problema = "";
        var idPedido = $(this).attr("data-idPedido");
        alteraPedido(status, problema, idPedido);
        setTimeout(function(){
            window.location.reload();
        }, 3000);
    });
    
    $("#entrega").on("click", function(){
        var status = 3;
        var problema = "";
        var idPedido = $(this).attr("data-idPedido");
        alteraPedido(status, problema, idPedido);
        setTimeout(function(){
            window.location.reload();
        }, 3000);
    });
    
    $("#finalizado").on("click", function(){
        var status = 4;
        var problema = "";
        var idPedido = $(this).attr("data-idPedido");
        alteraPedido(status, problema, idPedido);

        $.ajax({
            url: 'cadastraEntradaCaixa',
            type: 'POST',
            data: {idPedido:idPedido},
            success: function(resposta){
                if(resposta == 1){
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000);
                }
            }
        });
    });

    $("#problema").on("show.bs.modal", function(event){
        var botao = $(event.relatedTarget);
        var status = 5;
        var problema;
        var idPedido = botao.data("idpedido");

        $("#pedidoComProblema").on("submit", function(e){
            e.preventDefault();
            problema = $("#problemaDoPedido").val();

            if(problema == ""){
                atencaoPedido("O campo <b>problema do pedido</b> é obrigatório.");
            }else{
                alteraPedido(status, problema, idPedido);
            }
        });
    });

    $("#naoLido").on("click", function(){
        var visualizado = 0;
        var idPedido = $(this).attr("data-idpedido");
        alteraVisualizacaoPedido(visualizado, idPedido);
    });
    
    $(".medidas").mask("##0,00", {reverse: true});
});

function sucessoPedidos(texto){
    $("#notificacaoPedidos").html("<div class='col-lg-4 offset-lg-4 alert alert-success alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Sucesso! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function erroPedidos(texto){
    $("#notificacaoPedidos").html("<div class='col-lg-4 offset-lg-4 alert alert-danger alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-times'></i></span><span class='alert-text'><strong>Erro! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function atencaoPedidos(texto){
    $("#notificacaoPedidos").html("<div class='col-lg-4 offset-lg-4 alert alert-warning alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-exclamation-triangle'></i></span><span class='alert-text'><strong>Atenção! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}

function sucessoPedido(texto){
    $("#notificacaoPedido").html("<div class='col-lg-4 offset-lg-4 alert alert-success alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Sucesso! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function erroPedido(texto){
    $("#notificacaoPedido").html("<div class='col-lg-4 offset-lg-4 alert alert-danger alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-times'></i></span><span class='alert-text'><strong>Erro! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function atencaoPedido(texto){
    $("#notificacaoPedido").html("<div class='col-lg-4 offset-lg-4 alert alert-warning alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-exclamation-triangle'></i></span><span class='alert-text'><strong>Atenção! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}

function alteraPedido(status, problema, idPedido){
    $.ajax({
        url: 'alteraPedido',
        type: 'POST',
        data: {status:status, problema:problema, idPedido:idPedido},
        success: function(resposta){
            if(resposta == 1){
                sucessoPedido("O <b>Status do Pedido</b> foi alterado com sucesso.");
            }else{
                erroPedido("O <b>Status do Pedido</b> não pode ser alterado. Por favor, tente novamente mais tarde!");
            }
        }
    });
}
function alteraVisualizacaoPedido(visualizado, idPedido){
    $.ajax({
        url: 'alteraVisualizacaoPedido',
        type: 'POST',
        data: {visualizado:visualizado, idPedido:idPedido},
        success: function(resposta){
            if(resposta == 1){
                sucessoPedido('Pedido marcado como "não lido".');
                setTimeout(function(){
                    window.location.href = '../pedidos';
                }, 3000);
            }else{
                erroPedido('Erro ao marcar pedido como "não lido". Por favor, tente novamente mais tarde!');
            }
        }
    });
}