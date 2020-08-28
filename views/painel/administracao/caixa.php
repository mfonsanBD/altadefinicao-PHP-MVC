<?php
  require 'navs.php';
?>
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
              <a href="#" class="btn btn-neutral text-warning" data-toggle="modal" data-target="#cadastra-cliente"><i class="fas fa-plus"></i> Cadastrar Saída</a>
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
                  <h3 class="mb-0">Controle de Caixa</h3>
                </div>
              </div>
            </div>
            <div class="card-body pt-0">
              <div id="dados">
                <div class="col-lg-3 offset-lg-4 text-center">
                    <h4>Caixa do dia:</h4>
                    <div class="input-group mb-3">
                        <input class="datedropper-init form-control text-center" type="text" id="dataCaixa" data-dd-theme="alta" data-dd-format="d/m/Y" data-dd-lang="pt">
                        <div class="input-group-append">
                            <button class="btn btn-warning" id="buscaCaixa">Ir</button>
                        </div>
                    </div>
                </div>
                <!-- Card stats -->
                <div class="row">
                  <div class="col-xl-4 col-md-4">
                    <div class="card card-stats">
                      <!-- Card body -->
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Entradas</h5>
                            <span class="h2 font-weight-bold mb-0" id="valorEntrada">R$ 20.000</span>
                          </div>
                          <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                              <i class="ni ni-money-coins"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-md-4">
                    <div class="card card-stats">
                      <!-- Card body -->
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Saidas</h5>
                            <span class="h2 font-weight-bold mb-0" id="valorSaida">350,897</span>
                          </div>
                          <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                              <i class="ni ni-money-coins"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-md-4">
                    <div class="card card-stats">
                      <!-- Card body -->
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total do Dia</h5>
                            <span class="h2 font-weight-bold mb-0" id="valorTotal">R$ 120.000</span>
                          </div>
                          <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                              <i class="ni ni-money-coins"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col" class="sort" data-sort="name">Descrição</th>
                        <th scope="col" class="sort" data-sort="status">Operação</th>
                        <th scope="col" class="sort" data-sort="completion">Total</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                      <tr>
                        <th class="budget">
                          Hortifuiti
                        </th>
                        <td>
                          <span class="badge badge-dot mr-4">
                            <i class="bg-danger"></i>
                            <span class="status">Saida</span>
                          </span>
                        </td>
                        <td class="budget">
                          R$ 2.500,00
                        </td>
                      </tr>
                      <tr>
                        <th class="budget">
                          Hortifuiti
                        </th>
                        <td>
                          <span class="badge badge-dot mr-4">
                            <i class="bg-success"></i>
                            <span class="status">Entrada</span>
                          </span>
                        </td>
                        <td class="budget">
                          R$ 2.500,00
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="text-center mt-5">
                  <button class="btn btn-warning btn-sm">Dar Baixa no Caixa</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-12">
        </div>
      </div>
      <?php
        require 'footer.php';
      ?>
    </div>
  </div>
  <!-- Argon Scripts -->

<div class="row">
    <div class="col-md-6">
        <div class="modal fade" id="cadastra-cliente" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-secondary border-0 mb-0">
                            <div class="card-header bg-warning text-white">
                                Cadastro de Novo Cliente
                            </div>
                            <div class="card-body px-lg-5 py-lg-5">
                                <form role="form" id="cadastraCliente">
                                  <div class="form-group">
                                      <div class="input-group input-group-merge input-group-alternative">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-user"></i>
                                          </div>
                                          <input class="form-control" placeholder="Nome" type="text" id="nomeCliente">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="input-group input-group-merge input-group-alternative">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-user"></i>
                                          </div>
                                          <input class="form-control" placeholder="Sobrenome" type="text" id="sobrenomeCliente">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="input-group input-group-merge input-group-alternative">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                          </div>
                                          <input class="form-control" placeholder="E-mail" type="email" id="emailCliente">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="input-group input-group-merge input-group-alternative">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                          </div>
                                          <input class="form-control" placeholder="Senha" type="password" id="senhaCliente">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="input-group input-group-merge input-group-alternative">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                          </div>
                                          <input class="form-control" placeholder="Confirma Senha" type="password" id="confirmaSenhaCliente">
                                      </div>
                                  </div>
                                  <div class="text-muted font-italic forcaSenha"></div>
                                  <div class="text-center">
                                      <button type="submit" class="btn btn-warning my-4">Cadastrar</button>
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
    <div class="modal fade" id="confirmaExclusaoDeCliente" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                  <h4 class="heading mt-4">O(A) cliente <cliente></cliente> está para ser excluido(a).</h4>
                  <p>Tem certeza que deseja excluir <cliente></cliente>?<br>Todas as informações dele(a) serão excluidas permanentemente.</p>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-white" id="botaoExcluiCliente">Sim, excluir</button>
              <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Não, cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="modal fade" id="desitavaCliente" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
      <div class="modal-dialog modal-warning modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-warning">
          <div class="modal-header">
              <h6 class="modal-title" id="modal-title-notification">Atenção!</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="py-3 text-center">
                  <i class="ni ni-bell-55 ni-3x"></i>
                  <h4 class="heading mt-4">O(A) cliente <cliente></cliente> está para ser desativado(a).</h4>
                  <p>Com isso, <cliente></cliente> não terá mais acesso ao sistema até que você o ative novamente.<br>Tem certeza que deseja desativar <cliente></cliente>?</p>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-white" id="botaoDesativaCliente">Sim, desativar</button>
              <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Não, cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="notificacaoCaixa" class="fixed-bottom mb-2" style="z-index:9999999;"></div>