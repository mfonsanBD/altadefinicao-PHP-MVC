urlSite = window.location.href;
$(document).ready(function(){
    $("#cadastraPostagem").on("submit", function(e){
        e.preventDefault();

        var titulo 		= $("#titulo").val();
        var texto 		= CKEDITOR.instances.texto_blog.getData();
        var slug        = string_to_slug(titulo);

        if(titulo == ''){
            atencaoBlog("O campo <strong>Título</strong> é <strong>obrigatório</strong>.");
        }
        else if(texto == ''){
            atencaoBlog("O campo <strong>Texto</strong> é <strong>obrigatório</strong>.");
        }else{
            $("#cortaImagem").removeClass('d-none');
        }

        var resize = $('#upload-demoNoticia').croppie({
            enableExif: true,
            enableOrientation: true,    
            viewport: { 
                width: 850,
                height: 500
            },
            boundary: {
                width: 850,
                height: 500
            }
        });
        $('#imageNoticia').on('change', function () { 
            var reader = new FileReader();
            reader.onload = function (e) {
                resize.croppie('bind',{
                url: e.target.result
                });
            }
            reader.readAsDataURL(this.files[0]);
        });
        $('.btn-upload-imageNoticia').on('click', function (ev) {
            resize.croppie('result', {
            type: 'canvas',
            size: 'viewport'
            }).then(function (img) {
                $.ajax({
                    url: urlSite+'/cadastraPostagem/',
                    type: 'POST',
                    data: {titulo:titulo, texto:texto, imagem:img, slug:slug},
                    success: function(dados){
                        if(dados == 1){
                            sucessoBlog("Notícia cadastrada com sucesso!");
                            setTimeout(function(){
                                window.location.reload();
                            }, 3000);
                        }else{
                            erroBlog("Não foi possível cadastrar a notícia. Tente novamente mais tarde!");
                        }
                    }
                });
            });
        });
    });

    $("#confirmaExclusaoDeNoticia").on("show.bs.modal", function(event){
        var botao   = $(event.relatedTarget);
        var id      = botao.data("id");
        var titulo  = botao.data("titulo");
        var foto    = botao.data("foto");

        $("noticia").html(titulo);

        $("#botaoExcluiNoticia").on("click", function(){
            $.ajax({
                url: urlSite+'/excluiNoticia/',
                type: 'POST',
                data: {id:id, foto:foto},
                success: function(dados){
                    if(dados == 1){
                        sucessoBlog("Notícia excluida com sucesso!");
                        setTimeout(function(){
                            window.location.reload();
                        }, 3000);
                    }else{
                        erroBlog("Não foi possível excluir a notícia. Tente novamente mais tarde.");
                    }
                }
            });
        });
    });
});

function sucessoBlog(texto){
    $("#notificacaoBlog").html("<div class='col-lg-4 offset-lg-4 alert alert-success alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Sucesso! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function erroBlog(texto){
    $("#notificacaoBlog").html("<div class='col-lg-4 offset-lg-4 alert alert-danger alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-times'></i></span><span class='alert-text'><strong>Erro! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function atencaoBlog(texto){
    $("#notificacaoBlog").html("<div class='col-lg-4 offset-lg-4 alert alert-warning alert-dismissible fade show animate__animated animate__slideInLeft' role='alert'><span class='alert-icon'><i class='fas fa-exclamation-triangle'></i></span><span class='alert-text'><strong>Atenção! </strong>"+texto+"</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
function string_to_slug (nome) {
    nome = nome.replace('/^\s+|\s+$/g', ''); // trim
    nome = nome.toLowerCase();
  
    // remove accents, swap ñ for n, etc
    var from = "ãàáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to   = "aaaaaeeeeiiiioooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
        nome = nome.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    nome = nome.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return nome;
}