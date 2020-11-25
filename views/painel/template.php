<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title><?=NOME_DO_SITE." :: ".$this->titulo?></title>
  <!-- Favicon -->
  <link rel="icon" href="<?=URL_BASE?>assets/img/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="<?=URL_BASE?>assets/dashboard/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="<?=URL_BASE?>assets/dashboard/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="<?=URL_BASE?>assets/dashboard/css/argon.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" href="<?=URL_BASE?>assets/dashboard/css/alta.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  
</head>
<body>
  <?php
		$this->loadViewInTemplate($viewNome, $dados);
	?>
  <!-- Core -->
  <script src="<?=URL_BASE?>assets/dashboard/vendor/jquery/dist/jquery.min.js"></script>
  <script src="<?=URL_BASE?>assets/dashboard/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?=URL_BASE?>assets/dashboard/vendor/js-cookie/js.cookie.js"></script>
  <script src="<?=URL_BASE?>assets/dashboard/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="<?=URL_BASE?>assets/dashboard/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="<?=URL_BASE?>assets/dashboard/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="<?=URL_BASE?>assets/dashboard/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="<?=URL_BASE?>assets/dashboard/js/argon.js?v=1.2.0"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="<?=URL_BASE?>assets/dashboard/js/jquery.mask.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="//cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
  <script src="<?=URL_BASE?>assets/js/jquery.number.min.js"></script>
  <script src="https://cdn.datedropper.com/get/c1azyzs3ynuod5s60qrhyd5vqkbf2eb6"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
  <script src="<?=URL_BASE?>assets/js/login.js"></script>
  <script src="<?=URL_BASE?>assets/js/cadastro.js"></script>
  <script src="<?=URL_BASE?>assets/js/produtos.js"></script>
  <script src="<?=URL_BASE?>assets/js/clientes.js"></script>
  <script src="<?=URL_BASE?>assets/js/colaboradores.js"></script>
  <script src="<?=URL_BASE?>assets/js/blog.js"></script>
  <script src="<?=URL_BASE?>assets/js/caixa.js"></script>
  <script src="<?=URL_BASE?>assets/js/pedidos.js"></script>
  <script src="<?=URL_BASE?>assets/js/perfil.js"></script>
  
<script>
  var lm = document.getElementById('lucroMensal');
  var dadoslm = {
      labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
      datasets: [{
              label: "Lucro por Mês (R$)",
              backgroundColor: "rgba(255,255,255,0.2)",
              borderColor: "rgba(255,255,255,1)",
              borderWidth: 2,
              hoverBackgroundColor: "rgba(255,255,255,0.4)",
              hoverBorderColor: "rgba(255,255,255,1)",
              data: [
                <?=$this->lucroJaneiro;?>,
                <?=$this->lucroFevereiro;?>,
                <?=$this->lucroMarco;?>,
                <?=$this->lucroAbril;?>,
                <?=$this->lucroMaio;?>,
                <?=$this->lucroJunho;?>,
                <?=$this->lucroJulho;?>,
                <?=$this->lucroAgosto;?>,
                <?=$this->lucroSetembro;?>,
                <?=$this->lucroOutubro;?>,
                <?=$this->lucroNovembro;?>,
                <?=$this->lucroDezembro;?>
              ],
          }]
  };
  var opcoeslm = {
    animation: {
            duration:1000
    },
    scales: {
        yAxes: [{
            ticks: {beginAtZero: true, fontColor: "#FFFFFF"},
            gridLines: { color: "#ff6f4e" }
        }],
        xAxes: [{
            ticks: {beginAtZero: true, fontColor: "#FFFFFF"},
            gridLines: { color: "#ff6f4e" }
        }]
    }
  };
  var lucroMensal = Chart.Bar(lm,{
    data:dadoslm,
    options:opcoeslm
  });

  var pm = document.getElementById('pedidosMensal');
  var dadospm = {
      labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
      datasets: [{
              label: "Pedidos por Mês",
              backgroundColor: "rgba(245,96,54,0.2)",
              borderColor: "rgba(245,96,54,1)",
              borderWidth: 2,
              hoverBackgroundColor: "rgba(245,96,54,0.4)",
              hoverBorderColor: "rgba(245,96,54,1)",
              data: [
                <?=$this->pedidosJaneiro;?>,
                <?=$this->pedidosFevereiro;?>,
                <?=$this->pedidosMarco;?>,
                <?=$this->pedidosAbril;?>,
                <?=$this->pedidosMaio;?>,
                <?=$this->pedidosJunho;?>,
                <?=$this->pedidosJulho;?>,
                <?=$this->pedidosAgosto;?>,
                <?=$this->pedidosSetembro;?>,
                <?=$this->pedidosOutubro;?>,
                <?=$this->pedidosNovembro;?>,
                <?=$this->pedidosDezembro;?>
              ],
          }]
  };
  var opcoespm = {
    animation: {
            duration:1000
    },
    scales: {
        yAxes: [{
            ticks: {beginAtZero: true, fontColor: "#BBBBBB"},
            gridLines: { color: "#F9F9F9" }
        }],
        xAxes: [{
            ticks: {beginAtZero: true, fontColor: "#BBBBBB"},
            gridLines: { color: "#F9F9F9" }
        }]
    }
  };
  var pedidosMensal = Chart.Bar(pm,{
    data:dadospm,
    options:opcoespm
  });
</script>
</body>
</html>