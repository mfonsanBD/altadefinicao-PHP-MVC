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
              <a href="#" class="btn btn-neutral text-warning" data-toggle="modal" data-target="#cadastra-saida"><i class="fas fa-plus"></i> Cadastrar Saída</a>
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
            <div class="col-lg-3 offset-lg-4 text-center">
                <h4>Caixa do dia:</h4>
                <div class="input-group mb-3">
                    <input class="datedropper-init form-control text-center" type="text" id="dataCaixa" data-dd-theme="alta" data-dd-format="d/m/Y" data-dd-lang="pt">
                    <div class="input-group-append">
                        <button class="btn btn-warning" id="buscaCaixa">Ir</button>
                    </div>
                </div>
            </div>
            <div id="dadosAtuais" class="card-body pt-0">
              <div id="dados">
                <!-- Card stats -->
                <div class="row">
                  <div class="col-xl-4 col-md-4">
                    <div class="card card-stats">
                      <!-- Card body -->
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Entradas</h5>
                            <span class="h2 font-weight-bold mb-0" id="valorEntrada">
                              <?='R$ '.number_format($entradasHoje, 2, ",", ".");?>
                            </span>
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
                            <span class="h2 font-weight-bold mb-0" id="valorSaida">
                              <?='R$ '.number_format($saidasHoje, 2, ",", ".");?>
                            </span>
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
                            <span class="h2 font-weight-bold mb-0" id="valorTotal">
                              <?='R$ '.number_format($totalDoDia, 2, ",", ".");?>
                            </span>
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
                        <th scope="col" class="sort" data-sort="completion">Valor da Operação</th>
                        <th scope="col" class="sort" data-sort="status">Forma de Pagamento</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                      <?php
                        if($fluxoHoje != 0){
                          foreach($dadosHoje as $caixa):
                            ?>
                            <tr>
                              <th class="budget">
                                <?=$caixa['descricaoOperacaoCaixa'];?>
                              </th>
                              <td>
                                <span class="badge badge-dot mr-4">
                                  <?php
                                    if($caixa['operacaoCaixa'] == 0){
                                      echo "<i class='bg-danger'></i>
                                      <span class='status'>Saida</span>";
                                    }else{
                                      echo "<i class='bg-success'></i>
                                      <span class='status'>Entrada</span>";
                                    }
                                  ?>
                                </span>
                              </td>
                              <td class="budget">
                                <?='R$ '.number_format($caixa['valorCaixa'], 2, ",", ".");?>
                              </td>
                              <td class="budget">
                                Dinheiro
                              </td>
                            </tr>
                            <?php
                          endforeach;
                        }else{
                      ?>
                        <tr>
                          <td colspan="4" class="text-center">
                            Nenhum dado registrado no caixa de hoje até o momento.
                          </td>
                        </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                <?php
                  foreach($listaBaixa as $baixa):
                    if($baixa['situacaoBaixa'] == 0){
                ?>
                  <div class="text-center mt-5">
                    <button class="btn btn-warning btn-sm" id="baixaNoCaixa">Dar Baixa no Caixa</button>
                  </div>
                <?php
                    }else{
                ?>
                  <div class="col-lg-12 text-center mt-5 bg-gradient-green p-2">
                    <p class="p-0 m-0 text-white">Baixa no caixa dado por: <?=$this->nomeDeuBaixa;?></p>
                  </div>
                <?php
                    }
                  endforeach;
                ?>
              </div>
            </div>
            <div id="dadosAntigo" class="card-body pt-0 d-none"></div>
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
        <div class="modal fade" id="cadastra-saida" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-secondary border-0 mb-0">
                            <div class="card-header bg-warning text-white">
                                Cadastro de Nova Saída
                            </div>
                            <div class="card-body px-lg-5 py-lg-5">
                                <form role="form" id="cadastraSaida">
                                  <div class="form-group">
                                      <div class="input-group input-group-merge input-group-alternative">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-comment-alt"></i>
                                          </div>
                                          <input class="form-control" placeholder="Descrição" type="text" id="descricaoOperacaoCaixa">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="input-group input-group-merge input-group-alternative">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i>
                                          </div>
                                          <input class="form-control valorSaida" placeholder="Valor da Saída" type="text" id="precoSaida">
                                      </div>
                                  </div>
                                  <div class="text-center">
                                      <button type="submit" class="btn btn-warning my-4">Cadastrar Saída</button>
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

<div id="notificacaoCaixa" class="fixed-bottom mb-2" style="z-index:9999999;"></div>