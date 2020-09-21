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
              <p class="text-lead text-white">Faça seu cadastro e seja um revendedor.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <form role="form" id="form-cadastro">
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                    </div>
                    <input class="form-control" placeholder="Nome" type="text" id="nome">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                    </div>
                    <input class="form-control" placeholder="Sobrenome" type="text" id="sobrenome">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="E-mail" type="email" id="email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Senha" type="password" id="senha">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Confirma Senha" type="password" id="confirmaSenha">
                  </div>
                </div>
                <div class="text-muted font-italic forcaSenha"></div>
                <div class="row my-4">
                  <div class="col-12">
                    <div class="custom-control custom-control-alternative custom-checkbox">
                      <input class="custom-control-input" id="aceito" type="checkbox">
                      <label class="custom-control-label" for="aceito">
                        <span class="text-muted">Li e aceito a <a href="#!">Política de Privacidade</a></span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="g-recaptcha" data-sitekey="6LePCrAZAAAAAEnjkfbXuh04fM6HpsC0GyfRYbW6"></div>
                <div class="text-center">
                  <button type="submit" id="cadastro" class="btn btn-primary mt-4" disabled>Criar Conta</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-12 text-center">
              <a href="login" class="text-light"><small>Acesse sua conta!</small></a>
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
            $anos = date('Y', strtotime('- 2000 years'));
            echo date('Y', strtotime('- '.$anos.' years'))." - ".date('Y').", <span class='nome-site'>".NOME_DO_SITE."</span>";
          ?>. Todos os direitos reservados.</p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <div id="notificacao" class="fixed-bottom mb-2"></div>