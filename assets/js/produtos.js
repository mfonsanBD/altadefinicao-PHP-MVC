urlSite = window.location.href;
$(document).ready(function(){
    $("#cadastraProduto").on("submit", function(e){
        e.preventDefault();

        var nomeProduto             = $("#nomeProduto").val();
        var categoriaProduto        = $("#categoriaProduto").val();
        var tipoProduto             = $("#tipoProduto").val();
        var acabamentoProduto       = $("#acabamentoProduto").val();
        var valorProduto            = $("#valorProduto").val();

        if(nomeProduto == ''){
            atencaoProdutos("O campo <strong>Nome do Produto</strong> é <strong>obrigatório</strong>.");
        }
        else if(categoriaProduto == null){
            atencaoProdutos("O campo <strong>Categoria</strong> é <strong>obrigatório</strong>.");
        }
        else if(tipoProduto == null){
            atencaoProdutos("O campo <strong>Tipo</strong> é <strong>obrigatório</strong>.");
        }
        else if(acabamentoProduto == null){
            atencaoProdutos("O campo <strong>Acabamento</strong> é <strong>obrigatório</strong>.");
        }
        else if(valorProduto == ''){
            atencaoProdutos("O campo <strong>Valor do Produto</strong> é <strong>obrigatório</strong>.");
        }else{
            $("#cortaImagem").removeClass('d-none');
        }
        var resize = $('#upload-demo').croppie({
            enableExif: true,
            enableOrientation: true,    
            viewport: { 
                width: 372,
                height: 250
            },
            boundary: {
                width: 372,
                height: 250
            }
        });
        $('#image').on('change', function () { 
            var reader = new FileReader();
            reader.onload = function (e) {
                resize.croppie('bind',{
                url: e.target.result
                }).then(function(){
                console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });
        $('.btn-upload-image').on('click', function (ev) {
            resize.croppie('result', {
            type: 'canvas',
            size: 'viewport'
            }).then(function (img) {
                $.ajax({
                    url: urlSite+'/cadastraProduto/',
                    type: 'POST',
                    data: {nomeProduto:nomeProduto, categoriaProduto:categoriaProduto, tipoProduto:tipoProduto, acabamentoProduto:acabamentoProduto,valorProduto:valorProduto, fotoProduto:img},
                    success: function(dados){
                        if(dados == 1){
                            sucessoProdutos("Produto cadastrado com sucesso!");
                            setTimeout(function(){
                                window.location.reload();
                            }, 3000);
                        }
                        else if(dados == 2){
                            atencaoProdutos("Tipo de imagem inválida. Tente ennviar uma nova imagem.")
                        }
                        else{
                            erroProdutos("Não foi possível cadastrar um novo produto. Tente novamente mais tarde!");
                        }
                    }
                });
            });
        });
    });
        
    $('.valorProduto').mask("#.##0,00", {reverse: true});

    $("#confirmaExclusaoDeProduto").on("show.bs.modal", function(event){
        var botao = $(event.relatedTarget);
        var id = botao.data("id");
        var nome = botao.data("nome");

        $("produto").html(nome);

        $("#botaoConfirmaExclusao").on("click", function(){
            $.ajax({
                url: urlSite+'/excluiProduto/',
                type: 'POST',
                data: {idProduto:id},
                success: function(dados){
                    if(dados == 1){
                        sucessoProdutos("Produto excluido com sucesso!");
                        setTimeout(function(){
                            window.location.reload();
                        }, 3000);
                    }else{
                        erroProdutos("Não foi possível excluir o produto. Tente novamente mais tarde.");
                    }
                }
            });
        });
    });

    $("#edita-produto").on("show.bs.modal", function(event){
        var botao = $(event.relatedTarget);
        var id = botao.data("id");
        
        $("#formularioEditaProduto").on("submit", function(e){
            e.preventDefault();

            var nomeProduto             = $("#nomeEditaProduto").val();
            var categoriaProduto        = $("#categoriaEditaProduto").val();
            var tipoProduto             = $("#tipoEditaProduto").val();
            var acabamentoProduto       = $("#acabamentoEditaProduto").val();
            var valorProduto            = $("#valorEditaProduto").val();

            $.ajax({
                url: urlSite+'/alteraProduto/',
                type: 'POST',
                data: {idProduto:id, nomeProduto:nomeProduto, categoriaProduto:categoriaProduto, tipoProduto:tipoProduto, acabamentoProduto:acabamentoProduto,valorProduto:valorProduto},
                success: function(dados){
                    if(dados == 1){
                        sucessoProdutos("Produto alterado com sucesso!");
                        setTimeout(function(){
                            window.location.reload();
                        }, 3000);
                    }
                    else{
                        atencaoProdutos("As informações que você enviou são as informações atuais do produto!");
                    }
                }
            });
        });
    });
});

function sucessoProdutos(texto){
    $("#notificacaoProduto").html("<div class='col-lg-4 offset-lg-4 alert alert-success alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Sucesso! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function erroProdutos(texto){
    $("#notificacaoProduto").html("<div class='col-lg-4 offset-lg-4 alert alert-danger alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-times'></i></span><span class='alert-text'><strong>Erro! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function atencaoProdutos(texto){
    $("#notificacaoProduto").html("<div class='col-lg-4 offset-lg-4 alert alert-warning alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-exclamation-triangle'></i></span><span class='alert-text'><strong>Atenção! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}