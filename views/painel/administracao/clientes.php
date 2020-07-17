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
              <a class="nav-link <?=($this->titulo == "Pedidos") ? 'active' : '';?>" href="pedidos">
                <i class="ni ni-archive-2 text-default"></i>
                <span class="nav-link-text">Pedidos</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?=($this->titulo == "Caixa") ? 'active' : '';?>" href="caixa">
                <i class="ni ni-book-bookmark text-default"></i>
                <span class="nav-link-text">Caixa</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?=($this->titulo == "Notificações") ? 'active' : '';?>" href="notificacoes">
                <i class="ni ni-bell-55 text-default"></i>
                <span class="nav-link-text">Notificações</span>
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
                            echo "<img alt='Foto de ".$this->nomeUsuario."' src='assets/img/usuairo/".$_SESSION['logado']."/".$this->foto."'>";
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
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="<?=URL_BASE?>"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?=$this->titulo;?></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-neutral text-warning" data-toggle="modal" data-target="#cadastra-produto"><i class="fas fa-plus"></i> Cadastrar Cliente</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Clientes Cadastrados</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="tabelaDeClientes">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Nome</th>
                            <th scope="col" class="sort" data-sort="status">Permissão</th>
                            <th scope="col" class="sort" data-sort="valor">Valor em Compras (até hoje)</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                                foreach($listaUsuarios as $clientes):
                            ?>
                            <tr>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <a href="#" class="avatar rounded-circle mr-3">
                                        <img alt="Image placeholder" src="../assets/img/theme/bootstrap.jpg">
                                        </a>
                                        <div class="media-body">
                                        <span class="name mb-0 text-sm"><?=$clientes['nomeUsuario']." ".$clientes['sobrenomeUsuario'];?></span>
                                        </div>
                                    </div>
                                </th>
                                <td>
                                    <span class="badge badge-dot mr-4">
                                        <i class="bg-warning"></i>
                                        <span class="status">pending</span>
                                    </span>
                                </td>
                                <td class="budget">
                                    $2500 USD
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
        <div class="col-xl-12">
        </div>
      </div>
      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-12">
            <div class="copyright text-center text-muted">&copy; Copyright 
              <?php
                $anos = date('Y', strtotime('- 2005 years'));
                echo date('Y', strtotime('- '.$anos.' years'))." - ".date('Y').", <span class='nome-site'>".NOME_DO_SITE."</span>";
              ?>. Todos os direitos reservados.
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->

<div class="row">
    <div class="col-md-6">
        <div class="modal fade" id="cadastra-produto" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-secondary border-0 mb-0">
                            <div class="card-header bg-warning text-white">
                                Cadastro de Novo Produto
                            </div>
                            <div class="card-body px-lg-5 py-lg-5">
                                <form role="form" id="cadastraProduto">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Nome do Produto" type="text" id="nomeProduto">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-sitemap"></i>
                                            </div>
                                            <select class="form-control m-0" id="categoriaProduto">
                                                <option disabled selected>Selecione a Categoria</option>
                                                <?php
                                                    foreach($listaCategoria as $tipoDeCategoria):
                                                ?>
                                                <option value="<?=$tipoDeCategoria['idCategoria']?>"><?=$tipoDeCategoria['nomeCategoria']?></option>
                                                <?php
                                                    endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-award"></i>
                                            </div>
                                            <select class="form-control m-0" id="tipoProduto">
                                                <option disabled selected>Selecione o Tipo</option>
                                                <?php
                                                    foreach($listaTipoProduto as $tipoDeProduto):
                                                ?>
                                                <option value="<?=$tipoDeProduto['idTipoProduto']?>"><?=$tipoDeProduto['nomeTipoProduto']?></option>
                                                <?php
                                                    endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-crop-alt"></i>
                                            </div>
                                            <select class="form-control m-0" id="acabamentoProduto">
                                                <option disabled selected>Selecione o Acabamento</option>
                                                <?php
                                                    foreach($listaAcabamento as $tipoDeAcabamento):
                                                ?>
                                                <option value="<?=$tipoDeAcabamento['idAcabamento']?>"><?=$tipoDeAcabamento['nomeAcabamento']?></option>
                                                <?php
                                                    endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i>
                                            </div>
                                            <input class="form-control valorProduto" placeholder="Valor do Produto" type="text" id="valorProduto">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-warning my-4">Adicionar Imagem do Produto</button>
                                    </div>
                                    <div class="row d-none" id="cortaImagem">
                                    <div class="col-md-12 text-center">
                                        <div id="upload-demo"></div>
                                    </div>
                                    <div class="col-md-12" style="padding:5%;">
                                        <input type="file" id="image" class="d-none">
                                        <label for="image" class="p-3 border text-center">Clique aqui e escolha uma imagem para seu produto</label>
                                        <button type="button" class="btn btn-default btn-block btn-upload-image mt-4" style="margin-top:2%">Cadastrar Produto</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="modal fade" id="confirmaExclusaoDeProduto" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
      <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">
          <div class="modal-header">
              <h6 class="modal-title" id="modal-title-notification">Atenção!</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="py-3 text-center">
                  <i class="ni ni-bell-55 ni-3x"></i>
                  <h4 class="heading mt-4">O produto <produto></produto> está para ser excluido.</h4>
                  <p>Tem certeza que deseja excluir <produto></produto>?<br>Todas as informações dele serão excluidas permanentemente.</p>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-white" id="botaoConfirmaExclusao">Sim, excluir</button>
              <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Não, cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="notificacaoProduto" class="fixed-bottom mb-2" style="z-index:9999999;"></div>