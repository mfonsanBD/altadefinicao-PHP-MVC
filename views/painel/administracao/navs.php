<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="assets/img/logo-alta-definicao.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link <?=($this->titulo == "Painel de Controle") ? 'active' : '';?>" href="painel">
                <i class="ni ni-chart-pie-35 text-default"></i>
                <span class="nav-link-text">Painel de Controle</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?=($this->titulo == "Pedidos") ? 'active' : '';?>" href="pedidos">
                <i class="ni ni-archive-2 text-default"></i>
                <span class="nav-link-text">Pedidos</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?=($this->titulo == "Produtos") ? 'active' : '';?>" href="produtos">
                <i class="ni ni-box-2 text-default"></i>
                <span class="nav-link-text">Produtos</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?=($this->titulo == "Clientes") ? 'active' : '';?>" href="clientes">
                <i class="ni ni-single-02 text-default"></i>
                <span class="nav-link-text">Clientes</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?=($this->titulo == "Colaboradores") ? 'active' : '';?>" href="colaboradores">
                <i class="ni ni-single-02 text-default"></i>
                <span class="nav-link-text">Colaboradores</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?=($this->titulo == "Caixa") ? 'active' : '';?>" href="caixa">
                <i class="ni ni-book-bookmark text-default"></i>
                <span class="nav-link-text">Caixa</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?=($this->titulo == "Blog") ? 'active' : '';?>" href="blog">
              <i class="fas fa-newspaper text-default"></i>
                <span class="nav-link-text">Blog</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
                <button type="button" class="btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span>Notificações</span>
                    <span class="badge badge-primary">24</span>
                </button>
                <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                    <!-- Dropdown header -->
                    <div class="px-3 py-3">
                    <h6 class="text-sm text-muted m-0">Você tem <strong class="text-primary">13</strong> notificações.</h6>
                    </div>
                    <!-- List group -->
                    <div class="list-group list-group-flush">
                    <a href="#!" class="list-group-item list-group-item-action">
                        <div class="row align-items-center">
                        <div class="col-auto">
                            <!-- Avatar -->
                            <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg" class="avatar rounded-circle">
                        </div>
                        <div class="col ml--2">
                            <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0 text-sm">John Snow</h4>
                            </div>
                            <div class="text-right text-muted">
                                <small>2 hrs ago</small>
                            </div>
                            </div>
                            <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
                        </div>
                        </div>
                    </a>
                    <a href="#!" class="list-group-item list-group-item-action">
                        <div class="row align-items-center">
                        <div class="col-auto">
                            <!-- Avatar -->
                            <img alt="Image placeholder" src="../assets/img/theme/team-2.jpg" class="avatar rounded-circle">
                        </div>
                        <div class="col ml--2">
                            <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0 text-sm">John Snow</h4>
                            </div>
                            <div class="text-right text-muted">
                                <small>3 hrs ago</small>
                            </div>
                            </div>
                            <p class="text-sm mb-0">A new issue has been reported for Argon.</p>
                        </div>
                        </div>
                    </a>
                    <a href="#!" class="list-group-item list-group-item-action">
                        <div class="row align-items-center">
                        <div class="col-auto">
                            <!-- Avatar -->
                            <img alt="Image placeholder" src="../assets/img/theme/team-3.jpg" class="avatar rounded-circle">
                        </div>
                        <div class="col ml--2">
                            <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0 text-sm">John Snow</h4>
                            </div>
                            <div class="text-right text-muted">
                                <small>5 hrs ago</small>
                            </div>
                            </div>
                            <p class="text-sm mb-0">Your posts have been liked a lot.</p>
                        </div>
                        </div>
                    </a>
                    <a href="#!" class="list-group-item list-group-item-action">
                        <div class="row align-items-center">
                        <div class="col-auto">
                            <!-- Avatar -->
                            <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg" class="avatar rounded-circle">
                        </div>
                        <div class="col ml--2">
                            <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0 text-sm">John Snow</h4>
                            </div>
                            <div class="text-right text-muted">
                                <small>2 hrs ago</small>
                            </div>
                            </div>
                            <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
                        </div>
                        </div>
                    </a>
                    <a href="#!" class="list-group-item list-group-item-action">
                        <div class="row align-items-center">
                        <div class="col-auto">
                            <!-- Avatar -->
                            <img alt="Image placeholder" src="../assets/img/theme/team-5.jpg" class="avatar rounded-circle">
                        </div>
                        <div class="col ml--2">
                            <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0 text-sm">John Snow</h4>
                            </div>
                            <div class="text-right text-muted">
                                <small>3 hrs ago</small>
                            </div>
                            </div>
                            <p class="text-sm mb-0">A new issue has been reported for Argon.</p>
                        </div>
                        </div>
                    </a>
                    </div>
                    <!-- View all -->
                    <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">Ver Todas</a>
                </div>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <?php
                        if($this->foto == 'usuario.jpg'){
                            echo "<img alt='Foto de Usuário' src='assets/img/usuario.jpg'>";
                        }else{
                            echo "<img alt='Foto de ".$this->nomeUsuario."' src='assets/img/usuario/".$_SESSION['logado']."/".$this->foto."'>";
                        }
                    ?>
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?=$this->nomeUsuario?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Bem-Vindo!</h6>
                </div>
                <a href="perfil" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>Perfil</span>
                </a>
                <a href="configuracoes" class="dropdown-item">
                  <i class="ni ni-settings-gear-65"></i>
                  <span>Configurações</span>
                </a>
                <a href="suporte" class="dropdown-item">
                  <i class="ni ni-support-16"></i>
                  <span>Suporte</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="sair" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Sair</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>