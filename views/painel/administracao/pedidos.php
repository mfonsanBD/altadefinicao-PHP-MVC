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
              <a href="#" class="btn btn-neutral text-warning" data-toggle="modal" data-target="#cadastra-pedido"><i class="fas fa-plus"></i> Novo Pedido</a>
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
                  <h3 class="mb-0">Pedidos</h3>
                </div>
              </div>
            </div>
            <div id="dadosAtuais" class="card-body pt-0">
              <div id="dados">
                <div class="card-body">
                    <table class="table align-items-center table-flush" id="tabelaDeClientes">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">N° Pedido</th>
                            <th scope="col" class="sort" data-sort="name">Nome da Arte</th>
                            <th scope="col" class="sort" data-sort="name">Cliente</th>
                            <th scope="col" class="sort" data-sort="status">Status do Pedido</th>
                            <th scope="col" class="sort" data-sort="name">dia do Pedido</th>
                            <th scope="col" class="sort" data-sort="name">Valor do Pedido</th>
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
                                                echo "<span class='name'>".$pedidos['nomeUsuario']." ".$pedidos['sobrenomeUsuario']."</span>";
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
          </div>
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
        <div class="modal fade" id="cadastra-pedido" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-secondary border-0 mb-0">
                            <div class="card-header bg-warning text-white">
                                Cadastro de Novo Pedido
                            </div>
                            <div class="card-body px-lg-5 py-lg-5">
                                <ul class="nav nav-pills nav-fill flex-column flex-sm-row mb-4" id="tabs-text" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-2 disabled active" id="guia1-tab" data-toggle="tab" href="#guia1" role="tab" aria-controls="guia1" aria-selected="true">Produto</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-2 disabled" id="guia2-tab" data-toggle="tab" href="#guia2" role="tab" aria-controls="guia2" aria-selected="false">Cliente</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-2 disabled" id="guia3-tab" data-toggle="tab" href="#guia3" role="tab" aria-controls="guia3" aria-selected="false">Mídia</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-2 disabled" id="guia4-tab" data-toggle="tab" href="#guia4" role="tab" aria-controls="guia4" aria-selected="false">Acabamento</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-2 disabled" id="guia5-tab" data-toggle="tab" href="#guia5" role="tab" aria-controls="guia5" aria-selected="false">Medidas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-2 disabled" id="guia6-tab" data-toggle="tab" href="#guia6" role="tab" aria-controls="guia6" aria-selected="false">Quantidade</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-2 disabled" id="guia7-tab" data-toggle="tab" href="#guia7" role="tab" aria-controls="guia7" aria-selected="false">Arte</a>
                                    </li>
                                </ul>
                                <form id="cadastraPedido">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-box-2"></i>
                                            </div>
                                            <select class="form-control m-0" id="produtoPedido">
                                                <option disabled selected value="">Selecione o Produto</option>
                                                <?php
                                                    foreach($listaProduto as $produtos):
                                                ?>
                                                <option value="<?=$produtos['idProduto']?>"><?=$produtos['nomeProduto']?></option>
                                                <?php
                                                    endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-badge"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Identificação do Produto" type="text" id="identificacao">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                                            </div>
                                            <textarea class="form-control" placeholder="Observação" type="text" id="observacao"></textarea>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-warning my-4">Próximo</button>
                                    </div>
                                </form>
                                <form id="clientePedido" class="d-none">
                                    <h4>Tipo de Cliente</h4>
                                    <?php
                                        foreach($listaTipoCliente as $tipoCliente):
                                    ?>
                                        <div class="custom-control custom-radio mb-3">
                                            <input type="radio" id="tipocliente<?=$tipoCliente['idTipoCliente']?>" name="tipocliente" class="custom-control-input" value="<?=$tipoCliente['idTipoCliente']?>">
                                            <label class="custom-control-label" for="tipocliente<?=$tipoCliente['idTipoCliente']?>"><?=$tipoCliente['nomeTipoCliente']?></label>
                                        </div>
                                    <?php
                                        endforeach;
                                    ?>
                                    <div id="clienteFinal" class="form-group d-none">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Nome do Cliente" type="text" id="nomeClienteFinal">
                                        </div>
                                        <div class="text-center">
                                            <button type="button" id="enviaFinal" class="btn btn-warning my-4">Próximo</button>
                                        </div>
                                    </div>
                                    <div id="clienteRevendedor" class="form-group d-none">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-single-02"></i>
                                            </div>
                                            <select class="form-control m-0" id="clienteRevenda">
                                                <option disabled selected value="">Selecione o Cliente</option>
                                                <?php
                                                    foreach($listaUsuarios as $clientes):
                                                ?>
                                                <option value="<?=$clientes['idUsuario']?>">
                                                    <?=$clientes['nomeUsuario']." ".$clientes['sobrenomeUsuario']?>
                                                </option>
                                                <?php
                                                    endforeach;
                                                ?>
                                            </select>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" id="enviaRevenda" class="btn btn-warning my-4">Próximo</button>
                                        </div>
                                    </div>
                                </form>
                                <form id="midiaMaterial" class="d-none">
                                    <?php
                                        foreach($listaMidia as $midia):
                                    ?>
                                        <div class="custom-control custom-radio mb-3">
                                            <input type="radio" id="midia<?=$midia['idMidia']?>" name="midia" class="custom-control-input" value="<?=$midia['idMidia']?>">
                                            <label class="custom-control-label" for="midia<?=$midia['idMidia']?>"><?=$midia['nomeMidia']?></label>
                                        </div>
                                    <?php
                                        endforeach;
                                    ?>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-warning my-4">Próximo</button>
                                    </div>
                                </form>
                                <form id="acabamentoMaterial" class="d-none">
                                    <?php
                                        foreach($listaAcabamento as $acabamento):
                                    ?>
                                        <div class="custom-control custom-radio mb-3">
                                            <input type="radio" id="acabamento<?=$acabamento['idAcabamento']?>" name="acabamento" class="custom-control-input" value="<?=$acabamento['idAcabamento']?>">
                                            <label class="custom-control-label" for="acabamento<?=$acabamento['idAcabamento']?>"><?=$acabamento['nomeAcabamento']?></label>
                                        </div>
                                    <?php
                                        endforeach;
                                    ?>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-warning my-4">Próximo</button>
                                    </div>
                                </form>
                                <form id="medidasMaterial" class="d-none">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-arrows-alt-v"></i></span>
                                            </div>
                                            <input class="form-control medidas" placeholder="Altura (cm)" type="text" id="alturaProduto">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-arrows-alt-h"></i></span>
                                            </div>
                                            <input class="form-control medidas" placeholder="Largura (cm)" type="text" id="larguraProduto">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-warning my-4">Próximo</button>
                                    </div>
                                </form>
                                <form id="quantidadeMaterial" class="d-none">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-sort-numeric-up"></i></span>
                                            </div>
                                            <input class="form-control medidas" placeholder="Quantidade" type="number" id="quantidadeProduto">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-warning my-4">Próximo</button>
                                    </div>
                                </form>
                                <form id="artePedido" class="d-none">
                                        <h3>Como será o envio da arte?</h3>
                                    <div class="custom-control custom-radio mb-5">
                                        <input type="radio" id="tipoarte1" name="tipoarte" class="custom-control-input" value="0">
                                        <label class="custom-control-label" for="tipoarte1">
                                            Vou Enviar minha Arte<br><small>Envie o seu arquivo finalizado para impressão conforme sua configuração selecionada.</small>
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio mb-5">
                                        <input type="radio" id="tipoarte2" name="tipoarte" class="custom-control-input" value="1">
                                        <label class="custom-control-label" for="tipoarte2">
                                            Quero Criar minha Arte<br><small>Utilizando suas informações e imagens nossos designers vão criar uma arte personalizada para você. Custo adicional de R$ 30,00</small>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-warning my-4" data-toggle="modal" data-target="#confirmaPedido">Pré-Visualizar Pedido</button>
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
    <div class="col-md-6">
        <div class="modal fade" id="confirmaPedido" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-secondary border-0 mb-0">
                            <div class="card-header bg-warning text-white">
                                Pré-Visualizar Pedido
                            </div>
                            <div class="card-body px-lg-5 py-lg-5">
                                <div class="col-lg-12 mb-3">
                                    <smal>
                                        <b>Produto:</b>
                                        <produtopedido></produtopedido>
                                    </small>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <smal>
                                        <b>Identificação:</b>
                                        <identificacaopedido></identificacaopedido>
                                    </small>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <smal>
                                        <b>Cliente:</b>
                                        <clientepedido></clientepedido>
                                    </small>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <smal>
                                        <b>Mídia:</b>
                                        <midiapedido></midiapedido>
                                    </small>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <smal>
                                        <b>Acabamento</b>
                                        <acabamentopedido></acabamentopedido>
                                    </small>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <smal>
                                        <b>Medidas</b>
                                        <medidaspedido></medidaspedido>
                                    </small>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <smal>
                                        <b>Quantidade</b>
                                        <quantidadepedido></quantidadepedido>
                                    </small>
                                </div>
                                <div class="col-lg-12 mb-5">
                                    <smal>
                                        <b>Arte</b>
                                        <artepedido></artepedido>
                                    </small>
                                </div>
                                <div class="col-lg-12 mb-5">
                                    <smal>
                                        <b>Valor do Pedido</b>
                                        R$ <totaldopedido></totaldopedido>
                                    </small>
                                </div>
                                <div class="text-center">
                                    <button id="finalizarPedido" class="btn btn-success my-4">Finalizar Pedido</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="notificacaoPedidos" class="fixed-bottom mb-2" style="z-index:9999999;"></div>