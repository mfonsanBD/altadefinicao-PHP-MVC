urlSite = window.location.href;
$(document).ready(function(){
    $("#cadastraColaborador").on("submit", function(e){
        e.preventDefault();

        var nomeColaborador     = $("#nomeColaborador").val();
        var funcaoColaborador   = $("#funcaoColaborador").val();

        if(nomeColaborador == ''){
            atencaoColaboradores("O campo <strong>Nome do Colaborador</strong> é <strong>obrigatório</strong>.");
        }
        else if(funcaoColaborador == ''){
            atencaoColaboradores("O campo <strong>Função do Colaborador</strong> é <strong>obrigatório</strong>.");
        }else{
            $("#cortaImagem").removeClass('d-none');
        }

        var resize = $('#upload-demoColaborador').croppie({
            enableExif: true,
            enableOrientation: true,    
            viewport: { 
                width: 158,
                height: 158
            },
            boundary: {
                width: 158,
                height: 158
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
                $.ajax({
                    url: urlSite+'/cadastraColaborador/',
                    type: 'POST',
                    data: {nome:nomeColaborador, funcao:funcaoColaborador, imagem:img},
                    success: function(dados){
                        if(dados == 1){
                            sucessoColaboradores("Colaborador cadastrado com sucesso!");
                            setTimeout(function(){
                                window.location.reload();
                            }, 3000);
                        }else{
                            erroColaboradores("Não foi possível cadastrar o colaborador. Tente novamente mais tarde!");
                        }
                    }
                });
            });
        });
    });

    $("#confirmaExclusaoDeColaborador").on("show.bs.modal", function(event){
        var botao = $(event.relatedTarget);
        var id = botao.data("id");
        var nome = botao.data("nome");
        var foto = botao.data("foto");

        $("colaborador").html(nome);

        $("#botaoConfirmaExclusaoColaborador").on("click", function(){
            $.ajax({
                url: urlSite+'/excluiColaborador/',
                type: 'POST',
                data: {id:id, foto:foto},
                success: function(dados){
                    if(dados == 1){
                        sucessoColaboradores("Colaborador excluido com sucesso!");
                        setTimeout(function(){
                            window.location.reload();
                        }, 3000);
                    }else{
                        erroColaboradores("Não foi possível excluir o colaborador. Tente novamente mais tarde.");
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