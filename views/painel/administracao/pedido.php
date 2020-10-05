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
                  <li class="breadcrumb-item"><a href="<?=URL_BASE?>pedidos">Pedidos</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?=$this->titulo;?></li>
                </ol>
              </nav>
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
            <div class="card-header bg-gradient-warning border border-white">
              <div class="row align-items-center">
                <div class="col text-center">
                  <h2 class="mb-0 text-uppercase text-white"><?=$this->titulo?></h2>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <small class="p-0 m-0">Dia do Pedido: <b><?=date("d/m/Y", strtotime($pedido['dataPedido']))?></b></small><br>

                        <small class="p-0 m-0">Horário do Pedido: <b><?=date("H:i", strtotime($pedido['dataPedido']))?></b></small><br>

                        <small class="p-0 m-0">Previsão de Entrega: <b>
                            <?php
                                $data = date('N', strtotime($pedido['dataPedido']));
                                switch($data){
                                    case 5:
                                    case 6:
                                        echo date("d/m/Y", strtotime("+3 day", strtotime($pedido['dataPedido'])));
                                    break;
                                    case 7:
                                        echo date("d/m/Y", strtotime("+2 day", strtotime($pedido['dataPedido'])));
                                    break;
                                    default:
                                        echo date("d/m/Y", strtotime("+1 day", strtotime($pedido['dataPedido'])));
                                    break;
                                }
                            ?>
                        </b>
                        </small><br>

                        <small class="p-0 m-0">Total do Pedido: <b><?="R$ ".number_format($pedido['valorPedido'], 2, ",", ".")?></b></small>
                    </div>
                    <div class="col-lg-9">
                      <span class="badge badge-dot mr-4">
                        <i class='bg-warning p-2'></i><br>
                        <span class='status'>Processando</span>
                      </span>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php
        require 'footer.php';
      ?>
    </div>
  </div>
  <!-- Argon Scripts -->

<div id="notificacaoPedido" class="fixed-bottom mb-2" style="z-index:9999999;"></div>