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
          </div>
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Pedidos</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$quantidadePedidos?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                  <!-- <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p> -->
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Clientes</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$quantidadeUsuarios?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-single-02"></i>
                      </div>
                    </div>
                  </div>
                  <!-- <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p> -->
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Lucro de Hoje</h5>
                      <span class="h2 font-weight-bold mb-0">R$ <?=number_format($lucroDoDia, 2, ",", ".")?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                  <!-- <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p> -->
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Lucro do Mês</h5>
                      <span class="h2 font-weight-bold mb-0">R$ <?=number_format($lucroDoMes, 2, ",", ".")?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                  <!-- <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p> -->
                </div>
              </div>
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
                  <h3 class="mb-0">Últimos Pedidos</h3>
                </div>
                <div class="col text-right">
                  <a href="pedidos" class="btn btn-sm btn-primary">Ver Todos</a>
                </div>
              </div>
            </div>
            <table class="table align-items-center table-flush" id="tabelaDePedidos">
                <thead class="thead-light">
                <tr>
                    <th scope="col" class="sort">N° Pedido</th>
                    <th scope="col" class="sort">Nome da Arte</th>
                    <th scope="col" class="sort">Cliente</th>
                    <th scope="col" class="sort">Status do Pedido</th>
                    <th scope="col" class="sort">dia do Pedido</th>
                    <th scope="col" class="sort">Valor do Pedido</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody class="list">
                    <?php
                        foreach($listaPedidos as $pedidos):
                            if($pedidos['visualizado'] == 0){
                                $bold = " style='background-color: #adb5bd; color:#FFFFFF;'";
                            }else{
                                $bold = '';
                            }
                    ?>
                    <tr<?=$bold;?>>
                        <th scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                <span class="name mb-0 text-sm ml-2">
                                <?='#'.str_pad($pedidos['idPedido'], 6, 0, STR_PAD_LEFT);?>
                                </span>
                                </div>
                            </div>
                        </th>
                        <td>
                            <span class='name'><?=$pedidos['nomeArte']?></span>
                        </td>
                        <td>
                          <?php
                            if($pedidos['idCliente'] == null){
                                echo "<span class='name'>".$pedidos['nomeCliente']."</span>";
                            }else{
                                foreach($listaUsuarios as $usuario){
                                    if($usuario['idUsuario'] == $pedidos['idCliente']){
                                        echo "<span class='name'>".$usuario['nomeUsuario']." ".$usuario['sobrenomeUsuario']."</span>";
                                    }
                                }
                            }
                          ?>
                        </td>
                        <td>
                            <span class="badge badge-dot mr-4">
                                <?php
                                    switch($pedidos['statusPedido']){
                                        case 1:
                                            echo "<i class='bg-warning'></i>
                                            <span class='status'>Processando</span>";
                                        break;
                                        case 2:
                                            echo "<i class='bg-default'></i>
                                            <span class='status'>Em produção</span>";
                                        break;
                                        case 3:
                                            if($pedidos['idTipoEntrega'] == 1){
                                                echo "<i class='bg-info'></i>
                                                <span class='status'>Pronto para Retirada</span>";
                                            }else{
                                                echo "<i class='bg-info'></i>
                                                <span class='status'>Saiu para Entrega</span>";
                                            }
                                        break;
                                        case 4:
                                            echo "<i class='bg-success'></i>
                                            <span class='status'>Finalizado</span>";
                                        break;
                                        case 5:
                                            echo "<i class='bg-danger'></i>
                                            <span class='status'>Com Problema</span>";
                                        break;
                                        default:
                                            echo "<i style='background-color:#8898aa;'></i>
                                            <span class='status'>Aguardando</span>";
                                        break;
                                    }
                                ?>
                            </span>
                        </td>
                        <td>
                            <span class='name'><?=date("d/m/Y - H:i", strtotime($pedidos['dataPedido']));?></span>
                        </td>
                        <td>
                            <span class='name'><?= "R$ ".number_format($pedidos['valorPedido'], 2, ",", ".")?></span>
                        </td>
                        <td class="text-right">
                            <a href="<?=URL_BASE."pedido/".$pedidos['slugPedido']?>" class="btn btn-default btn-sm">Abrir</a>
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
      <div class="row">
        <div class="col-xl-6">
          <div class="card bg-warning">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <!-- <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6> -->
                  <h5 class="h3 text-white mb-0">Lucro Mensal - <?=date("Y")?></h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="lucroMensal" height="230"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <!-- <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6> -->
                  <h5 class="h3 mb-0">Pedido Mensal - <?=date("Y")?></h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart">
                <canvas id="pedidosMensal" height="230"></canvas>
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