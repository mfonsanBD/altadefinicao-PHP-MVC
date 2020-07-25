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
                <div class="row">
                        <?php
                            if($quantidadeDeProduto != 0){
                                foreach($listaProduto as $produtos):
                        ?>
                            <div class="card col-xl-3">
                                <div class="card-imagem pt-3">
                                    <img src="assets/img/servicos-produtos/<?=$produtos['fotoProduto']?>" class="card-img-top" alt="<?=$produtos['nomeProduto']?>" height="100%">
                                </div>
                                <div class="card-body pl-0 pr-0">
                                    <h3 class="card-title m-0 p-0"><?=$produtos['nomeProduto']." ".$produtos['nomeTipoProduto']?></h3>
                                    <?php
                                      if($produtos['nomeCategoria'] == "Comunicação Visual"){
                                        echo '<span class="badge badge-warning mb-2">'.$produtos['nomeCategoria'].'</span>';
                                      }else{
                                        echo '<span class="badge badge-success" mb-2>'.$produtos['nomeCategoria'].'</span>';
                                      }
                                    ?>
                                    <p class="m-0 p-0"><small>Acabamento: <?=$produtos['nomeAcabamento']?></small></p>
                                    <h1 class="card-title m-0 p-0" style="color: #202020; font-weight:bold;">R$ <?=$produtos['valorProduto']?></h1>
                                </div>
                                <div class="card-footer pl-0 pr-0">
                                    <button class="btn btn-default float-left btn-block btn-sm" data-toggle="modal" data-target="#edita-produto" data-id="<?=$produtos['idProduto']?>">Editar</button>
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
                                                                      <form role="form" id="formularioEditaProduto">
                                                                          <div class="form-group">
                                                                              <div class="input-group input-group-merge input-group-alternative">
                                                                                  <div class="input-group-prepend">
                                                                                      <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                                                                  </div>
                                                                                  <input class="form-control" placeholder="Nome do Produto" type="text" id="nomeEditaProduto" value="<?=$produtos['nomeProduto']?>">
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
                                                                                      <option value="<?=$tipoDeCategoria['idCategoria']?>"
                                                                                      <?=($produtos['idCategoria'] == $tipoDeCategoria['idCategoria']) ? 'selected' : ''?>
                                                                                      >
                                                                                        <?=$tipoDeCategoria['nomeCategoria']?>
                                                                                      </option>
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
                                                                                  <select class="form-control m-0" id="tipoEditaProduto">
                                                                                      <option disabled selected>Selecione o Tipo</option>
                                                                                      <?php
                                                                                          foreach($listaTipoProduto as $tipoDeProduto):
                                                                                      ?>
                                                                                      <option value="<?=$tipoDeProduto['idTipoProduto']?>" 
                                                                                      <?=($produtos['idTipoProduto'] == $tipoDeProduto['idTipoProduto']) ? 'selected' : ''?>
                                                                                      >
                                                                                        <?=$tipoDeProduto['nomeTipoProduto']?>
                                                                                      </option>
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
                                                                                  <select class="form-control m-0" id="acabamentoEditaProduto">
                                                                                      <option disabled selected>Selecione o Acabamento</option>
                                                                                      <?php
                                                                                          foreach($listaAcabamento as $tipoDeAcabamento):
                                                                                      ?>
                                                                                      <option value="<?=$tipoDeAcabamento['idAcabamento']?>" 
                                                                                      <?=($produtos['idAcabamento'] == $tipoDeAcabamento['idAcabamento']) ? 'selected' : ''?>
                                                                                      >
                                                                                        <?=$tipoDeAcabamento['nomeAcabamento']?></option>
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
                                                                                  <input class="form-control valorProduto" placeholder="Valor do Produto" type="text" id="valorEditaProduto" value="<?=$produtos['valorProduto']?>">
                                                                              </div>
                                                                          </div>
                                                                          <div class="text-center">
                                                                              <button type="submit" class="btn btn-warning my-4">Alterar Produto</button>
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
                                    <button class="btn btn-danger float-right btn-block btn-sm mt-1" data-id="<?=$produtos['idProduto']?>" data-nome="<?=$produtos['nomeProduto']?>" data-toggle="modal" data-target="#confirmaExclusaoDeProduto">Excluir</button>
                                </div>
                            </div>
                        <?php
                                endforeach;
                            }else{
                        ?>
                            <div class="alert alert-default col-xl-12 text-center" role="alert">
                                Nenhum Produto cadastrado!
                            </div>
                        <?php
                            }
                        ?>
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