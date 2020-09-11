$(document).ready(function(){
    $("#mais-noticias").click(function(){
        window.location.href = 'noticias';
    });
    
    $("#botaoLogin").click(function(){
        window.location.href = 'login';
    });
    
    $("#botaoPainel").click(function(){
        window.location.href = 'painel';
    });

    $("#politica").click(function(){
        var marcado = $(this).is(':checked');
        if(marcado == true){
            $('#botao-cadastrar').removeAttr('disabled');
        }else{
            $('#botao-cadastrar').attr('disabled', true);
        }
    });
    
    $("#formContato").on("click", function(e){
        e.preventDefault();
    });
});