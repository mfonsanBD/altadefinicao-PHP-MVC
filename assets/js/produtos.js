urlSite = window.location.href;
$(document).ready(function(){
    let nomeProduto, categoriaProduto, midiasMarcadas, acabamentosMarcados, gramaturasMarcadas, imagemProduto, precoRevenda, precoFinal;
    let editaNomeProduto, editaCategoriaProduto, editaImagemProduto, editaPrecoRevenda, editaPrecoFinal;

    $("#botaoCadastraProduto").click(function(e){
        e.preventDefault();

        nomeProduto             = $("#nomeProduto").val();
        categoriaProduto        = $("#categoriaProduto").val();

        if(nomeProduto == ''){
            atencaoProdutos("O campo <strong>Nome do Produto</strong> é <strong>obrigatório</strong>.");
            setTimeout(function(){$(".alert").alert('close');}, 5000);
        }
        else if(categoriaProduto == null){
            atencaoProdutos("O campo <strong>Categoria</strong> é <strong>obrigatório</strong>.");
            setTimeout(function(){$(".alert").alert('close');}, 5000);
        }else{
            $("#cadastraProduto").addClass('d-none');
            $("#defineMidiasDoProduto").removeClass('d-none');
            $("#guia2-tab").addClass('active');
        }
    });

    $("#botaoDefineMidiasDoProduto").click(function(){
        midiasMarcadas = new Array();
        $("input[name='midiasproduto']:checked").each(function() {
            midiasMarcadas.push($(this).val());
        });

        let midiasescolhidas = $("input[name='midiasproduto']").is(":checked");

        if(midiasescolhidas == false){
            atencaoProdutos("Ao menos 1 mídia deve ser escolhida.");
            setTimeout(function(){$(".alert").alert('close');}, 5000);
        }else{
            $("#defineMidiasDoProduto").addClass('d-none');
            $("#defineAcabamentosDoProduto").removeClass('d-none');
            $("#guia3-tab").addClass('active');
        }
    });

    $("#botaoDefineAcabamentosDoProduto").click(function(){
        acabamentosMarcados = new Array();
        $("input[name='acabamentosproduto']:checked").each(function() {
            acabamentosMarcados.push($(this).val());
        });

        $("#defineAcabamentosDoProduto").addClass('d-none');
        $("#defineGramaturaDoProduto").removeClass('d-none');
        $("#guia4-tab").addClass('active');
    });

    $("#botaoDefineGramaturaDoProduto").click(function(){
        gramaturasMarcadas = new Array();
        $("input[name='gramaturaproduto']:checked").each(function() {
            gramaturasMarcadas.push($(this).val());
        });

        $("#defineGramaturaDoProduto").addClass('d-none');
        $("#defineImagemProduto").removeClass('d-none');
        $("#guia5-tab").addClass('active');
    });
    
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
            imagemProduto = img;
            $("#defineImagemProduto").addClass('d-none');
            $("#definePrecoRevenda").removeClass('d-none');
            $("#guia6-tab").addClass('active');
        });
    });
    
    $("#botaoDefinePrecoRevenda").click(function(e){
        e.preventDefault();

        precoRevenda = $("#precoRevenda").val();

        if(precoRevenda == ''){
            atencaoProdutos("O campo <strong>Valor do produto para revendedor</strong> é <strong>obrigatório</strong>.");
            setTimeout(function(){$(".alert").alert('close');}, 5000);
        }else{
            $("#definePrecoRevenda").addClass('d-none');
            $("#definePrecoFinal").removeClass('d-none');
            $("#guia7-tab").addClass('active');
        }
    });
    
    $("#botaoDefinePrecoFinal").click(function(e){
        e.preventDefault();

        precoFinal = $("#precoFinal").val();

        if(precoFinal == ''){
            atencaoProdutos("O campo <strong>Valor do produto para  cliente final</strong> é <strong>obrigatório</strong>.");
            setTimeout(function(){$(".alert").alert('close');}, 5000);
        }else{
            $.ajax({
                url: urlSite+'/cadastraProduto/',
                type: 'POST',
                data: {nomeProduto:nomeProduto, categoriaProduto:categoriaProduto, midiasMarcadas:midiasMarcadas, acabamentosMarcados:acabamentosMarcados, gramaturasMarcadas:gramaturasMarcadas, fotoProduto:imagemProduto, revenda:precoRevenda, final:precoFinal, slug:string_to_slug(nomeProduto)},
                success: function(dados){
                    if(dados == 0){
                        erroProdutos("Não foi possível cadastrar um novo produto. Tente novamente mais tarde!");
                    }
                    else if(dados == 2){
                        atencaoProdutos("Tipo de imagem inválida. Tente enviar uma nova imagem.")
                    }
                    else{
                        sucessoProdutos("Produto cadastrado com sucesso!");
                        setTimeout(function(){
                            window.location.reload();
                        }, 3000);
                    }
                }
            });
        }
    });

    $('.valorProduto').mask("#.##0,00", {reverse: true});

    $("#confirmaExclusaoDeProduto").on("show.bs.modal", function(event){
        var botao = $(event.relatedTarget);
        var id = botao.data("id");
        var nome = botao.data("nome");
        var foto = botao.data("foto");

        $("produto").html(nome);

        $("#botaoConfirmaExclusao").on("click", function(){
            $.ajax({
                url: urlSite+'/excluiProduto/',
                type: 'POST',
                data: {idProduto:id, foto:foto},
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
        var botao           = $(event.relatedTarget);
        var id              = botao.data("id");
        var nome            = botao.data("nome");

        $("#nomeEditaProduto").val(nome);

        $.ajax({
            url: urlSite+'/listaValoresDoProdutoRevenda/',
            type: 'POST',
            dataType: 'json',
            data:{idProduto:id},
            success: function(dados){
                $("#editaValorRevenda").val($.number(dados, 2, ',', '.' ));
            }
        });

        $.ajax({
            url: urlSite+'/listaValoresDoProdutoFinal/',
            type: 'POST',
            dataType: 'json',
            data:{idProduto:id},
            success: function(dados){
                $("#editaValorFinal").val($.number(dados, 2, ',', '.' ));
            }
        });

        $("#botaoEditaProduto").click(function(e){
            e.preventDefault();

            editaNomeProduto         = $("#nomeEditaProduto").val();
            editaCategoriaProduto    = $("#categoriaEditaProduto").val();

            if(editaNomeProduto == ""){
                atencaoProdutos("O <b>Nome do Produto</b> é obrigatório.");
                setTimeout(function(){$(".alert").alert('close');}, 3000);
            }else if(editaCategoriaProduto == null){
                atencaoProdutos("A <b>Categoria do Produto</b> é obrigatória.");
                setTimeout(function(){$(".alert").alert('close');}, 3000);
            }else{
                $("#editaProduto").addClass("d-none");
                $("#guiaedita2-tab").addClass("active");
                $("#editaImagemProduto").removeClass("d-none");
            }
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
                editaImagemProduto = img;
                $.ajax({
                    url: urlSite+'/alteraProduto/',
                    type: 'POST',
                    data: {editaNomeProduto:editaNomeProduto, editaCategoriaProduto:editaCategoriaProduto, editaImagemProduto:editaImagemProduto, slug:string_to_slug(editaNomeProduto), idProduto:id},
                    success: function(dados){
                        if(dados == 1){
                            sucessoProdutos("Informações do produto alteradas com sucesso!");
                            setTimeout(function(){
                                $(".alert").alert('close');
                                $("#editaImagemProduto").addClass("d-none");
                                $("#guiaedita3-tab").addClass("active");
                                $("#editaPrecoRevenda").removeClass("d-none");
                            }, 3000);
                        }else{
                            atencaoProdutos("A informação enviada é a atual.");
                            setTimeout(function(){
                                $(".alert").alert('close');
                                $("#editaImagemProduto").addClass("d-none");
                                $("#guiaedita3-tab").addClass("active");
                                $("#editaPrecoRevenda").removeClass("d-none");
                            }, 3000);
                        }
                    }
                });
            });
        });

        $("#botaoEditaPrecoRevenda").click(function(ev){
            ev.preventDefault();
            editaPrecoRevenda = $("#editaValorRevenda").val();
            
            if(editaPrecoRevenda == ''){
                atencaoProdutos("O campo <b>Valor para Revenda</b> não pode estar vazio.");
                setTimeout(function(){$(".alert").alert('close');}, 3000);
            }else{
                $.ajax({
                    url: urlSite+'/precoParaRevenda/',
                    type: 'POST',
                    data: {editaPrecoRevenda:editaPrecoRevenda, idProduto:id},
                    success: function(dados){
                        if(dados == 1){
                            sucessoProdutos("Preço para revendedor alterado com sucesso!");
                            setTimeout(function(){
                                $(".alert").alert('close');
                                $("#editaPrecoRevenda").addClass("d-none");
                                $("#guiaedita4-tab").addClass("active");
                                $("#editaPrecoFinal").removeClass("d-none");
                            }, 3000);
                        }else{
                            atencaoProdutos("O preço que você informou está sendo usado atualmente.");
                            setTimeout(function(){
                                $(".alert").alert('close');
                                $("#editaPrecoRevenda").addClass("d-none");
                                $("#guiaedita4-tab").addClass("active");
                                $("#editaPrecoFinal").removeClass("d-none");
                            }, 3000);
                        }
                    }
                });
            }
        });

        $("#botaoEditaPrecoFinal").click(function(evt){
            evt.preventDefault();
            editaPrecoFinal = $("#editaValorFinal").val();
            
            if(editaPrecoFinal == ''){
                atencaoProdutos("O campo <b>Valor para Cliente Final</b> não pode estar vazio.");
                setTimeout(function(){$(".alert").alert('close');}, 3000);
            }else{
                $.ajax({
                    url: urlSite+'/precoParaFinal/',
                    type: 'POST',
                    data: {editaPrecoFinal:editaPrecoFinal, idProduto:id},
                    success: function(dados){
                        if(dados == 1){
                            sucessoProdutos("Preço para cliente final alterado com sucesso!");
                            setTimeout(function(){
                                window.location.reload();
                            }, 3000);
                        }else{
                            atencaoProdutos("O preço que você informou está sendo usado atualmente.");
                            setTimeout(function(){
                                window.location.reload();
                            }, 3000);
                        }
                    }
                });
            }
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