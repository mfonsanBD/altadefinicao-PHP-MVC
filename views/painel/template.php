<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title><?=NOME_DO_SITE." :: ".$this->titulo?></title>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets/dashboard/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/dashboard/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/dashboard/css/argon.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  
</head>
<body>
  <?php
		$this->loadViewInTemplate($viewNome, $dados);
	?>
  <!-- Core -->
  <script src="assets/dashboard/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/dashboard/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/dashboard/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/dashboard/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/dashboard/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="assets/dashboard/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/dashboard/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="assets/dashboard/js/argon.js?v=1.2.0"></script>
  <script src="assets/dashboard/js/jquery.mask.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/js/login.js"></script>
  <script src="assets/js/cadastro.js"></script>
  <script src="assets/js/produtos.js"></script>
  <script src="assets/js/clientes.js"></script>
</body>
</html>