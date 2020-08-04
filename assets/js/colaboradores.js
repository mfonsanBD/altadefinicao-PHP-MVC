urlSite = window.location.href;
$(document).ready(function(){
    $("#cadastraColaborador").on("submit", function(e){
        e.preventDefault();

        var nomenomeColaborador      = $("#nomeColaborador").val();
        var funcaoColaborador        = $("#funcaoColaborador").val();
        var fotoColaborador          = pegaImagem();

        if(nomeProduto == ''){
            atencaoColaboradores("O campo <strong>Nome do Produto</strong> é <strong>obrigatório</strong>.");
        }
        else if(categoriaProduto == null){
            atencaoColaboradores("O campo <strong>Categoria</strong> é <strong>obrigatório</strong>.");
        }else{
            $("#cortaImagem").removeClass('d-none');
        }
    });

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
});

function sucessoColaboradores(texto){
    $("#notificacaoColaboradores").html("<div class='col-lg-4 offset-lg-4 alert alert-success alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Sucesso! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function erroColaboradores(texto){
    $("#notificacaoColaboradores").html("<div class='col-lg-4 offset-lg-4 alert alert-danger alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-times'></i></span><span class='alert-text'><strong>Erro! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function atencaoColaboradores(texto){
    $("#notificacaoColaboradores").html("<div class='col-lg-4 offset-lg-4 alert alert-warning alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-exclamation-triangle'></i></span><span class='alert-text'><strong>Atenção! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function pegaImagem(){
    var resize = $('#upload-demoColaborador').croppie({
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
    $('#imageColaborador').on('change', function () { 
        var reader = new FileReader();
        reader.onload = function (e) {
            resize.croppie('bind',{
            url: e.target.result
            });
        }
        reader.readAsDataURL(this.files[0]);
    });
    $('.btn-upload-imageColaborador').on('click', function (ev) {
        resize.croppie('result', {
        type: 'canvas',
        size: 'viewport'
        }).then(function (img) {
            return img;
        });
    });
}