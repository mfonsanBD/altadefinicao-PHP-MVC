<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title><?=NOME_DO_SITE." :: ".$this->titulo?></title>
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
</head>
<body>
  <?php
		$this->loadViewInTemplate($viewNome, $dados);
	?>
  <!-- Argon Scripts -->
  <!-- Footer -->
  <footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-12">
          <div class="copyright text-center text-muted">
          &copy; Copyright 
          <?php
            $anos = date('Y', strtotime('- 2005 years'));
            echo date('Y', strtotime('- '.$anos.' years'))." - ".date('Y').", <span class='nome-site'>".NOME_DO_SITE."</span>";
          ?>. Todos os direitos reservados.</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
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
</body>

</html>