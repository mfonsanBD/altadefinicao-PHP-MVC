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
              <a href="#" class="btn btn-neutral text-warning" data-toggle="modal" data-target="#cadastra-produto"><i class="fas fa-plus"></i> Cadastrar Produto</a>
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
                  <h3 class="mb-0">Produtos Cadastrados</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="tabelaDeClientes">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Imagem</th>
                                <th scope="col" class="sort" data-sort="name">Nome</th>
                                <th scope="col" class="sort" data-sort="name">Categoria</th>
                                <th scope="col" class="sort" data-sort="name">Valores</th>
                                <th scope="col" class="sort" data-sort="name">Mídias</th>
                                <th scope="col" class="sort" data-sort="name">Acabamentos</th>
                                <th scope="col" class="sort" data-sort="name">Gramatura</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                                foreach($listaProduto as $produtos):
                            ?>
                            <tr>
                                <th scope="row">
                                    <img src="assets/img/servicos-produtos/<?=$produtos['fotoProduto']?>" class="card-img-top" alt="<?=$produtos['nomeProduto']?>" height="100%">
                                </th>
                                <td>
                                    <h4 class="card-title m-0 p-0 text-center w-100"><?=$produtos['nomeProduto'];?></h4>
                                </td>
                                <td>
                                    <?php
                                        if($produtos['nomeCategoria'] == "Comunicação Visual"){
                                        echo '<span class="badge badge-warning mb-2 w-100">'.$produtos['nomeCategoria'].'</span>';
                                        }else{
                                        echo '<span class="badge badge-success mb-2 w-100">'.$produtos['nomeCategoria'].'</span>';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <span class="badge badge-dot mr-4">
                                        <?php
                                            foreach($listaValorProdutoTipoCliente as $lvptc){
                                                if($produtos['idProduto'] == $lvptc['idProduto']){
                                                    if($lvptc['idTipoCliente'] == 1){
                                                        echo '<small class="w-100">'.$lvptc['nomeTipoCliente'].': <b>R$'.number_format($lvptc['valor_p_tc'], 2, ",", ".").'</b></small><br>';
                                                    }else{
                                                        echo '<small class="w-100">'.$lvptc['nomeTipoCliente'].': <b>R$'.number_format($lvptc['valor_p_tc'], 2, ",", ".").'</b></small><br>';
                                                    }
                                                }
                                            }
                                        ?>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                        $midias_produto = explode(",", $produtos['idsMidias']);
                                        foreach($listaMidia as $midias){
                                            if(in_array($midias['idMidia'], $midias_produto)){
                                                echo "* <b>".$midias['nomeMidia']."</b><br>";
                                            }
                                        }
                                        if($produtos['idsMidias'] == ""){
                                            echo "<b>--</b>";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        $acabamentos_produto = explode(",", $produtos['idsAcabamentos']);
                                        foreach($listaAcabamento as $acabamentos){
                                            if(in_array($acabamentos['idAcabamento'], $acabamentos_produto)){
                                                echo "* <b>".$acabamentos['nomeAcabamento']."</b><br>";
                                            }
                                        }
                                        if($produtos['idsAcabamentos'] == ""){
                                            echo "<b>--</b>";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        $gramaturas_produto = explode(",", $produtos['idsGramaturas']);
                                        foreach($listaGramatura as $gramatura){
                                            if(in_array($gramatura['idGramatura'], $gramaturas_produto)){
                                                echo "* <b>".$gramatura['nomeGramatura']."g</b><br>";
                                            }
                                        }
                                        if($produtos['idsGramaturas'] == ""){
                                            echo "<b>--</b>";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <button class="btn btn-default float-left btn-block btn-sm" data-toggle="modal" 
                                    data-target="#edita-produto" 
                                    data-id="<?=$produtos['idProduto']?>" 
                                    data-nome="<?=$produtos['nomeProduto']?>" 
                                    data-categoria="<?=$produtos['idCategoria']?>"
                                    data-valorrevenda="<?php foreach($listaValorProdutoTipoCliente as $lvptc){if($produtos['idProduto'] == $lvptc['idProduto']){if($lvptc['idTipoCliente'] == 2){echo number_format($lvptc['valor_p_tc'], 2, ",", ".");}}}?>"
                                    data-valorfinal="<?php foreach($listaValorProdutoTipoCliente as $lvptc){if($produtos['idProduto'] == $lvptc['idProduto']){if($lvptc['idTipoCliente'] == 1){echo number_format($lvptc['valor_p_tc'], 2, ",", ".");}}}?>"
                                    >Editar</button>
<div class="row">
    <div class="col-md-6">
        <div class="modal fade" id="edita-produto" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-secondary border-0 mb-0">
                            <div class="card-header bg-warning text-white">
                                Editar Produto
                            </div>
                            <div class="card-body px-lg-5 py-lg-5">
                                <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active mb-3" id="pills-editadados-tab" data-toggle="pill" href="#pills-editadados" role="tab" aria-controls="pills-editadados" aria-selected="true">Dados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-3" id="pills-editaprecorevenda-tab" data-toggle="pill" href="#pills-editaprecorevenda" role="tab" aria-controls="pills-editaprecorevenda" aria-selected="false">Preço Revenda</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-3" id="pills-editaprecofinal-tab" data-toggle="pill" href="#pills-editaprecofinal" role="tab" aria-controls="pills-editaprecofinal" aria-selected="false">Preço Final</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-3" id="pills-editafoto-tab" data-toggle="pill" href="#pills-editafoto" role="tab" aria-controls="pills-editafoto" aria-selected="false">Nova Foto</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-editadados" role="tabpanel" aria-labelledby="pills-editadados-tab">
                                        <form role="form" id="formularioEditaProduto">
                                            <div class="form-group">
                                                <div class="input-group input-group-merge input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                                    </div>
                                                    <input class="form-control" type="text" id="nomeEditaProduto">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-merge input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-sitemap"></i>
                                                    </div>
                                                    <select class="form-control m-0" id="categoriaEditaProduto">
                                                        <option disabled selected>Selecione a Categoria</option>
                                                        <?php
                                                            foreach($listaCategoria as $tipoDeCategoria):
                                                        ?>
                                                            <option value="<?=$tipoDeCategoria['idCategoria']?>">
                                                                <?=$tipoDeCategoria['nomeCategoria']?>
                                                            </option>
                                                        <?php
                                                            endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-warning my-4">Alterar Produto</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="pills-editaprecorevenda" role="tabpanel" aria-labelledby="pills-editaprecorevenda-tab">
                                        <form role="form" id="editaPrecoRevenda">
                                            <div class="form-group">
                                                <div class="input-group input-group-merge input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i>
                                                    </div>
                                                    <input class="form-control valorProduto" placeholder="Valor do produto para revendedor" type="text" id="editaValorRevenda">
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-warning my-4">Definir Preço de Revenda</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="pills-editaprecofinal" role="tabpanel" aria-labelledby="pills-editaprecofinal-tab">
                                        <form role="form" id="editaPrecoFinal">
                                            <div class="form-group">
                                                <div class="input-group input-group-merge input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i>
                                                    </div>
                                                    <input class="form-control valorProduto" placeholder="Valor do produto para cliente final" type="text" id="editaValorFinal">
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-warning my-4">Definir Preço para Cliente Final</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="pills-editafoto" role="tabpanel" aria-labelledby="pills-editafoto-tab">
                                        <form role="form">
                                            <div class="row" id="cortaImagemEdicao">
                                                <div class="col-md-12 text-center">
                                                    <div id="upload-demo-edicao"></div>
                                                </div>
                                                <div class="col-md-12" style="padding:5%;">
                                                    <input type="file" id="image-edicao" class="d-none">
                                                    <label for="image-edicao" class="p-3 border text-center w-100" id="escolherFoto"><strong class="text-warning">Clique aqui</strong> para trocar a imagem</label>
                                                    <button type="button" class="btn btn-warning btn-block btn-upload-image-edicao mt-4" style="margin-top:2%">Mudar Foto do(a) <?=$produtos['nomeProduto']?></button>
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
    </div>
</div>
                                    <button class="btn btn-danger float-right btn-block btn-sm mt-1" data-id="<?=$produtos['idProduto']?>" data-foto="<?=$produtos['fotoProduto']?>" data-nome="<?=$produtos['nomeProduto']?>" data-toggle="modal" data-target="#confirmaExclusaoDeProduto">Excluir</button>
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
      <?php
        require 'footer.php';
      ?>
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
                                <ul class="nav nav-pills nav-fill flex-column flex-sm-row mb-4" id="tabs-text" role="tablist">
                                    <li class="nav-item mb-2">
                                        <a class="nav-link mb-sm-3 mb-md-0 disabled active" id="guia1-tab" data-toggle="tab" href="#guia1" role="tab" aria-controls="guia1" aria-selected="true">Informações</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0 disabled" id="guia2-tab" data-toggle="tab" href="#guia2" role="tab" aria-controls="guia2" aria-selected="false">Mídias</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0 disabled" id="guia3-tab" data-toggle="tab" href="#guia3" role="tab" aria-controls="guia3" aria-selected="false">Acabamentos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0 disabled" id="guia4-tab" data-toggle="tab" href="#guia4" role="tab" aria-controls="guia4" aria-selected="false">Gramatura</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0 disabled" id="guia5-tab" data-toggle="tab" href="#guia5" role="tab" aria-controls="guia5" aria-selected="false">Foto</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0 disabled" id="guia6-tab" data-toggle="tab" href="#guia6" role="tab" aria-controls="guia6" aria-selected="false">Revenda</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0 disabled" id="guia7-tab" data-toggle="tab" href="#guia7" role="tab" aria-controls="guia7" aria-selected="false">Final</a>
                                    </li>
                                </ul>
                                <div id="cadastraProduto">
                                    <h4>Informações do Produto</h4>
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
                                    <div class="text-center">
                                        <button id="botaoCadastraProduto" class="btn btn-warning my-4">Próximo</button>
                                    </div>
                                </div>
                                <div id="defineMidiasDoProduto" class="d-none">
                                    <h4>Qual(is) a(s) mídia(s) desse produto?</h4>
                                    <?php
                                        foreach($listaMidia as $midias):
                                    ?>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="midiasproduto" class="custom-control-input" id="midia<?=$midias['idMidia']?>" value="<?=$midias['idMidia']?>">
                                        <label class="custom-control-label" for="midia<?=$midias['idMidia']?>"><?=$midias['nomeMidia']?></label>
                                    </div>
                                    <?php
                                        endforeach;
                                    ?>
                                    <div class="text-center">
                                        <button id="botaoDefineMidiasDoProduto" class="btn btn-warning my-4">Próximo</button>
                                    </div>
                                </div>
                                <div id="defineAcabamentosDoProduto" class="d-none">
                                    <h4>Qual(is) o(s) acabamento(s)?</h4>
                                    <?php
                                        foreach($listaAcabamento as $acabamentos):
                                    ?>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="acabamentosproduto" class="custom-control-input" id="acabamento<?=$acabamentos['idAcabamento']?>" value="<?=$acabamentos['idAcabamento']?>">
                                        <label class="custom-control-label" for="acabamento<?=$acabamentos['idAcabamento']?>"><?=$acabamentos['nomeAcabamento']?></label>
                                    </div>
                                    <?php
                                        endforeach;
                                    ?>
                                    <div class="text-center">
                                        <button id="botaoDefineAcabamentosDoProduto" class="btn btn-warning my-4">Próximo</button>
                                    </div>
                                </div>
                                <div id="defineGramaturaDoProduto" class="d-none">
                                    <h4>Qual(is) a(s) gramatura(s)?</h4>
                                    <?php
                                        foreach($listaGramatura as $gramatura):
                                    ?>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="gramaturaproduto" class="custom-control-input" id="gramatura<?=$gramatura['idGramatura']?>" value="<?=$gramatura['idGramatura']?>">
                                        <label class="custom-control-label" for="gramatura<?=$gramatura['idGramatura']?>"><?=$gramatura['nomeGramatura']?></label>
                                    </div>
                                    <?php
                                        endforeach;
                                    ?>
                                    <div class="text-center">
                                        <button id="botaoDefineGramaturaDoProduto" class="btn btn-warning my-4">Próximo</button>
                                    </div>
                                </div>
                                <div id="defineImagemProduto" class="d-none">
                                    <h4>Definir a imagem do produto.</h4>
                                    <div class="row" id="cortaImagem">
                                        <div class="col-md-12 text-center">
                                            <div id="upload-demo"></div>
                                        </div>
                                        <div class="col-md-12" style="padding:5%;">
                                            <input type="file" id="image" class="d-none">
                                            <label for="image" class="p-3 border text-center">Clique aqui e escolha uma imagem para seu produto</label>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-warning btn-upload-image mt-4" style="margin-top:2%">Próximo</button>
                                    </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="definePrecoRevenda" class="d-none">
                                    <h4>Quanto esse produto custará para revenda?</h4>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i>
                                            </div>
                                            <input class="form-control valorProduto" placeholder="Valor do produto para revendedor" type="text" id="precoRevenda">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button id="botaoDefinePrecoRevenda" class="btn btn-warning my-4">Próximo</button>
                                    </div>
                                </div>
                                <div id="definePrecoFinal" class="d-none">
                                    <h4>Quanto esse produto custará para cliente final?</h4>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i>
                                            </div>
                                            <input class="form-control valorProduto" placeholder="Valor do produto para cliente final" type="text" id="precoFinal">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button id="botaoDefinePrecoFinal" class="btn btn-warning my-4">Finalizar Cadastro</button>
                                    </div>
                                </div>
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