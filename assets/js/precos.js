urlSite = window.location.href;
$(document).ready(function(){
    $("#definePrecoRevenda").on("submit", function(ev){
        ev.preventDefault();
        var valorRevenda = $("#precoRevenda").val();
        
        $.ajax({
            url: urlSite+'/precoParaRevenda/',
            type: 'POST',
            data: {valorRevenda:valorRevenda, idProduto:id},
            success: function(dados){
                if(dados == 1){
                    sucessoPrecos("Preço de revenda definido com sucesso!");
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000);
                }else{
                    erroPrecos("Não foi possível definir o preço para revenda. Tente novamente mais tarde!");
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
                    sucessoPrecos("Preço de cliente final definido com sucesso!");
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000);
                }else{
                    erroPrecos("Não foi possível definir o preço para cliente final. Tente novamente mais tarde!");
                }
            }
        });
    });

    $('.valorProduto').mask("#.##0,00", {reverse: true});
});

function sucessoPrecos(texto){
    $("#notificacaoProduto").html("<div class='col-lg-4 offset-lg-4 alert alert-success alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Sucesso! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function erroPrecos(texto){
    $("#notificacaoProduto").html("<div class='col-lg-4 offset-lg-4 alert alert-danger alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-times'></i></span><span class='alert-text'><strong>Erro! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function atencaoPrecos(texto){
    $("#notificacaoProduto").html("<div class='col-lg-4 offset-lg-4 alert alert-warning alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-exclamation-triangle'></i></span><span class='alert-text'><strong>Atenção! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}