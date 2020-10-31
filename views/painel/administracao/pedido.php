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

                        <small class="p-0 m-0">Valor do Pedido: <b><?="R$ ".number_format($pedido['valorPedido'], 2, ",", ".")?></b></small>
                    </div>
                    <div class="col-lg-9 d-flex justify-content-center align-items-center">
                      <span class="badge badge-dot mr-4">
                        <i class='bg-warning p-2 mb-2'></i><br>
                        <span class='status'>Aguardando</span>
                      </span>
                      <span class="badge badge-dot mr-4">
                        <i class='p-2 mb-2' style="background-color:#adb5bd;"></i><br>
                        <span class='status'>Processando</span>
                      </span>
                      <span class="badge badge-dot mr-4">
                        <i class='p-2 mb-2' style="background-color:#adb5bd;"></i><br>
                        <span class='status'>Em Produção</span>
                      </span>
                      <span class="badge badge-dot mr-4">
                        <i class='p-2 mb-2' style="background-color:#adb5bd;"></i><br>
                        <span class='status'>Pronto para Retirada</span>
                      </span>
                      <span class="badge badge-dot mr-4">
                        <i class='p-2 mb-2' style="background-color:#adb5bd;"></i><br>
                        <span class='status'>Finalizado</span>
                      </span>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header bg-gradient-warning">
              <div class="row align-items-center">
                <div class="col text-center">
                  <h2 class="mb-0 text-uppercase text-white">Método de Entrega</h2>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-6"><b>•</b> <small>Tipo:</small> <small><b><?=$pedido['nomeTipoEntrega']?></b></small></div>
                      <div class="col-lg-6"><b>•</b> <small>Valor:</small> <small><b><?="R$ ".number_format($pedido['valorTipoEntrega'], 2, ",", ".")?></b></small></div>
                    </div>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header bg-gradient-warning">
              <div class="row align-items-center">
                <div class="col text-center">
                  <h2 class="mb-0 text-uppercase text-white">Pagamento</h2>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-6"><b>•</b> <small>Status:</small> <small><b>Aguardando Pagamento</b></small></div>
                      <div class="col-lg-6"><b>•</b> <small>Método:</small> <small><b>Pagar na <?=$pedido['nomeTipoEntrega']?></b></small></div>
                      <div class="col-lg-6"><b>•</b> <small>Forma de Pagamento:</small> <small><b><?=$pedido['nomeFormaPagamento']?></b></small></div>
                      <div class="col-lg-6"><b>•</b> <small>Total a ser Pago:</small> <small><b><?="R$ ".number_format($pedido['valorPedido']+$pedido['valorTipoEntrega'], 2, ",", ".")?></b></small></div>
                    </div>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-gradient-warning border border-white">
              <div class="row align-items-center">
                <div class="col text-center">
                  <h2 class="mb-0 text-uppercase text-white">Detalhe do Pedido</h2>
                </div>
              </div>
            </div>
            <div class="card-body">
              <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                  <tr>
                      <th scope="col" class="sort" data-sort="name">N° Pedido</th>
                      <th scope="col" class="sort" data-sort="name">Nome da Arte</th>
                      <th scope="col" class="sort" data-sort="name">Cliente</th>
                      <th scope="col" class="sort" data-sort="status">Status do Pedido</th>
                      <th scope="col" class="sort" data-sort="name">dia do Pedido</th>
                      <th scope="col" class="sort" data-sort="name">Total do Pedido</th>
                  </tr>
                  </thead>
                  <tbody class="list">
                      <tr>
                        <th scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                <span class="name mb-0 text-sm ml-2">
                                <?='#'.str_pad($pedido['idPedido'], 6, 0, STR_PAD_LEFT);?>
                                </span>
                                </div>
                            </div>
                        </th>
                        <td>
                            <span class='name'><?=$pedido['nomeArte']?></span>
                        </td>
                        <td>
                                <?php
                                    if($pedido['idCliente'] == null){
                                        echo "<span class='name'>".$pedido['nomeCliente']."</span>";
                                    }else{
                                        echo "<span class='name'>".$pedido['nomeUsuario']." ".$pedido['sobrenomeUsuario']."</span>";
                                    }
                                ?>
                        </td>
                        <td>
                            <span class="badge badge-dot mr-4">
                                <?php
                                    switch($pedido['statusPedido']){
                                        case 1:
                                            echo "<i class='bg-warning'></i>
                                            <span class='status'>Processando</span>";
                                        break;
                                        case 2:
                                            echo "<i class='bg-default'></i>
                                            <span class='status'>Em produção</span>";
                                        break;
                                        case 3:
                                            if($pedido['idTipoEntrega'] == 1){
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
                            <span class='name'><?=date("d/m/Y - H:i", strtotime($pedido['dataPedido']));?></span>
                        </td>
                        <td>
                            <span class='name'><?="R$ ".number_format($pedido['valorPedido']+$pedido['valorTipoEntrega'], 2, ",", ".")?></span>
                        </td>
                      </tr>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-xl-12 text-center mb-5">
          <h2 class="text-uppercase">Alterar status do pedido:</h2>
          <?php
            switch($pedido['statusPedido']){
                case 1:
                  if($pedido['idTipoEntrega'] == 1){
                    $textoEntrega = "Pronto para Retirada";
                  }else{
                    $textoEntrega = "Saiu para Entrega";
                  }
                  echo "
                    <button class='btn btn-default btn-sm'>Em Produção</button>
                    <button class='btn btn-info btn-sm'>".$textoEntrega."</button>
                    <button class='btn btn-success btn-sm'>Finalizado</button>
                    <button class='btn btn-danger btn-sm'>Com Problema</button>
                  ";
                break;
                case 2:
                    echo "<i class='bg-default'></i>
                    <span class='status'>Em produção</span>";
                break;
                case 3:
                    if($pedido['idTipoEntrega'] == 1){
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
                  if($pedido['idTipoEntrega'] == 1){
                    $textoEntrega = "Pronto para Retirada";
                  }else{
                    $textoEntrega = "Saiu para Entrega";
                  }
                  echo "
                    <button class='btn btn-warning btn-sm'>Processando</button>
                    <button class='btn btn-defaul btn-sm'>Em Produção</button>
                    <button class='btn btn-info btn-sm'>".$textoEntrega."</button>
                    <button class='btn btn-success btn-sm'>Finalizado</button>
                    <button class='btn btn-danger btn-sm'>Com Problema</button>
                  ";
                break;
            }
          ?>
        </div>
      </div>
      <?php
        require 'footer.php';
      ?>
    </div>
  </div>
  <!-- Argon Scripts -->

<div id="notificacaoPedido" class="fixed-bottom mb-2" style="z-index:9999999;"></div>