<!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-3 py-lg-7 pt-lg-3">
      <div class="container">
        <div class="header-body text-center mb-5">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <a href="inicio"><img src="assets/img/logo-alta-definicao.png" alt="Logo Alta Definição"></a>
              <h1 class="text-white"><?=$this->titulo?>!</h1>
              <p class="text-lead text-white">Entre com a sua conta e vamos ao trabalho.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
              <form role="form" id="form-login">
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="E-mail" type="email" id="emailLogin">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Senha" type="password" id="senhaLogin">
                  </div>
                </div>
                <div class="g-recaptcha" data-sitekey="6LePCrAZAAAAAEnjkfbXuh04fM6HpsC0GyfRYbW6"></div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Entrar</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="#" class="text-light"><small>Esqueceu sua senha?</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="cadastro" class="text-light"><small>Crie sua conta!</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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

  <div id="notificacaoLogin" class="fixed-bottom mb-2"></div>