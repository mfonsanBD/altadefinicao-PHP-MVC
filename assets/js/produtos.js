urlSite = window.location.href;
$(document).ready(function(){
    $("#cadastraProduto").on("submit", function(e){
        e.preventDefault();

        var nomeProduto             = $("#nomeProduto").val();
        var categoriaProduto        = $("#categoriaProduto").val();

        if(nomeProduto == ''){
            atencaoProdutos("O campo <strong>Nome do Produto</strong> é <strong>obrigatório</strong>.");
        }
        else if(categoriaProduto == null){
            atencaoProdutos("O campo <strong>Categoria</strong> é <strong>obrigatório</strong>.");
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
                    data: {nomeProduto:nomeProduto, categoriaProduto:categoriaProduto, fotoProduto:img},
                    success: function(dados){
                        if(dados == 0){
                            erroProdutos("Não foi possível cadastrar um novo produto. Tente novamente mais tarde!");
                        }
                        else if(dados == 2){
                            atencaoProdutos("Tipo de imagem inválida. Tente ennviar uma nova imagem.")
                        }
                        else{
                            sucessoProdutos("Produto cadastrado com sucesso!");
                            setTimeout(function(){
                                window.location.reload();
                            }, 3000);
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
        var id      = botao.data("id");
        var nome    = botao.data("nome");

        $("#nomeEditaProduto").attr("value", nome);
        
        $("#formularioEditaProduto").on("submit", function(e){
            e.preventDefault();

            var nomeProduto         = $("#nomeEditaProduto").val();
            var categoriaProduto    = $("#categoriaEditaProduto").val();

            $.ajax({
                url: urlSite+'/alteraProduto/',
                type: 'POST',
                data: {idProduto:id, nomeProduto:nomeProduto, categoriaProduto:categoriaProduto},
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

        $("#definePrecoRevenda").on("submit", function(ev){
            ev.preventDefault();
            var valorRevenda = $("#precoRevenda").val();
            
            $.ajax({
                url: urlSite+'/precoParaRevenda/',
                type: 'POST',
                data: {valorRevenda:valorRevenda, idProduto:id},
                success: function(dados){
                    if(dados == 1){
                        sucessoProdutos("Preço de revenda definido com sucesso!");
                        setTimeout(function(){
                            window.location.reload();
                        }, 3000);
                    }else{
                        erroProdutos("Não foi possível definir o preço para revenda. Tente novamente mais tarde!");
                    }
                }
            });
        });

        $("#definePrecoFinal").on("submit", function(evt){
            evt.preventDefault();
            var valorFinal = $("#precoFinal").val();
            
            $.ajax({
                url: urlSite+'/precoParaFinal/',
                type: 'POST',
                data: {valorFinal:valorFinal, idProduto:id},
                success: function(dados){
                    if(dados == 1){
                        sucessoProdutos("Preço de cliente final definido com sucesso!");
                        setTimeout(function(){
                            window.location.reload();
                        }, 3000);
                    }else{
                        erroProdutos("Não foi possível definir o preço para cliente final. Tente novamente mais tarde!");
                    }
                }
            });
        });
        
        var resize = $('#upload-demo-edicao').croppie({
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
        $('#image-edicao').on('change', function () { 
            var reader = new FileReader();
            reader.onload = function (e) {
                resize.croppie('bind',{
                url: e.target.result
                });
            }
            reader.readAsDataURL(this.files[0]);
        });
        $('.btn-upload-image-edicao').on('click', function (ev) {
            resize.croppie('result', {
            type: 'canvas',
            size: 'viewport'
            }).then(function (img) {
                $.ajax({
                    url: urlSite+'/alteraFotoProduto/',
                    type: 'POST',
                    data: {idProduto:id, fotoProduto:img},
                    success: function(dados){
                        if(dados == 1){
                            sucessoProdutos("Foto do produto alterada com sucesso!");
                            setTimeout(function(){
                                window.location.reload();
                            }, 3000);
                        }
                        else if(dados == 2){
                            atencaoProdutos("Tipo de imagem inválida. Tente ennviar uma nova imagem.");
                        }
                        else{
                            erroProdutos("Não foi possível alterar a foto do produto. Tente novamente mais tarde!");
                        }
                    }
                });
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