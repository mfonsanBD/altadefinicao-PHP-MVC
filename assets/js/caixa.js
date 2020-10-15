urlSite = window.location.href;

$(document).ready(function(){
    $('.valorSaida').mask("#.##0,00", {reverse: true});

    var hoje = new Date();
    var dia = hoje.getUTCDate();
    var mes = hoje.getUTCMonth()+1;
    var ano = hoje.getFullYear();
    
    if(dia < 10){
        dia = "0"+dia;
    }
    if(mes < 10){
        mes = "0"+mes;
    }
    
    var dataAtual =  dia+"/"+mes+"/"+ano;
    $("#dataCaixa").attr("value", dataAtual);

    $("#buscaCaixa").on("click", function(){
        var dataEscolhida = $("#dataCaixa").val();
        var data = $("#dataCaixa").val().split("/");
        var data = new Date(data[2], (data[1]-1), data[0]);

        if(data > hoje){
            atencaoCaixa("A data selecionada deve ser inferior a de hoje.");
        }else{
            $.ajax({
                url: urlSite+'/buscaInfos/',
                type: 'POST',
                data: {data:dataEscolhida},
                success: function(dados){
                    $("#dadosAtuais").addClass('d-none');
                    $("#dadosAntigo").removeClass('d-none');
                    $("#dadosAntigo").html(dados);
                }
            });
        }
    });

    $("#cadastraSaida").on("submit", function(e){
        e.preventDefault();
        
        var descricaoSaida   = $("#descricaoOperacaoCaixa").val();
        var valorSaida       = $("#precoSaida").val();

        if(descricaoSaida == ''){
            atencaoCaixa("O campo <strong>descrição</strong> é obrigatório.");
        }else if(valorSaida == ''){
            atencaoCaixa("O campo <strong>valor da saída</strong> é obrigatório.");
        }else{
            $.ajax({
                url: urlSite+'/cadastraSaida/',
                type: 'POST',
                data: {descricao:descricaoSaida, valor:valorSaida},
                success: function(dados){
                    if(dados == 1){
                        sucessoCaixa("Cadastro de saída realizado com sucesso!");
                        setTimeout(function(){
                            window.location.reload();
                        }, 3000);
                    }else{
                        erroCaixa("Não foi possível cadastrar a saída. Tente novamente mais tarde!");
                    }
                }
            });
        }
    });
    
    $("#baixaNoCaixa").on("click", function(){
        $.ajax({
            url: urlSite+'/darBaixa/',
            success: function(dados){
                if(dados == 1){
                    sucessoCaixa("Bom trabalho! Você deu baixa no Caixa de hoje!");
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000);
                }else{
                    erroCaixa("Não foi possível dar baixa no caixa de hoje. Tente novamente mais tarde!");
                }
            }
        });
    });
});

function sucessoCaixa(texto){
    $("#notificacaoCaixa").html("<div class='col-lg-4 offset-lg-4 alert alert-success alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Sucesso! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function erroCaixa(texto){
    $("#notificacaoCaixa").html("<div class='col-lg-4 offset-lg-4 alert alert-danger alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-times'></i></span><span class='alert-text'><strong>Erro! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function atencaoCaixa(texto){
    $("#notificacaoCaixa").html("<div class='col-lg-4 offset-lg-4 alert alert-warning alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-exclamation-triangle'></i></span><span class='alert-text'><strong>Atenção! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}