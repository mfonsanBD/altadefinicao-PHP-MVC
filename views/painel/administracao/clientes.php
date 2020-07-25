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
              <a href="#" class="btn btn-neutral text-warning" data-toggle="modal" data-target="#cadastra-cliente"><i class="fas fa-plus"></i> Cadastrar Cliente</a>
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
              <table class="table align-items-center table-flush" id="tabelaDeClientes">
                  <thead class="thead-light">
                  <tr>
                      <th scope="col" class="sort" data-sort="name">Nome do(a) Cliente</th>
                      <th scope="col" class="sort" data-sort="status">Status</th>
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
                                  <span class="avatar avatar-sm rounded-circle">
                                    <?php
                                        if($clientes['fotoUsuario'] == 'usuario.jpg'){
                                            echo "<img alt='Foto de Usuário' src='assets/img/usuario.jpg'>";
                                        }else{
                                            echo "<img alt='Foto de ".$clientes['nomeUsuario']." ".$clientes['sobrenomeUsuario']."' src='assets/img/usuario/".$clientes['idUsuario']."/".$clientes['fotoUsuario']."'>";
                                        }
                                    ?>
                                  </span>
                                  <div class="media-body">
                                  <span class="name mb-0 text-sm ml-2"><?=$clientes['nomeUsuario']." ".$clientes['sobrenomeUsuario'];?></span>
                                  </div>
                              </div>
                          </th>
                          <td>
                              <span class="badge badge-dot mr-4">
                                <?php
                                  switch($clientes['permissaoUsuario']){
                                    case 0:
                                      echo "<i class='bg-warning'></i>
                                      <span class='status'>Aguardando Aprovação</span>";
                                    break;
                                    case 1:
                                      echo "<i class='bg-success'></i>
                                      <span class='status'>Ativo</span>";
                                    break;
                                    case 2:
                                      echo "<i class='bg-danger'></i>
                                      <span class='status'>Inativo</span>";
                                    break;
                                  }
                                ?>
                              </span>
                          </td>
                          <td class="text-right">
                              <div class="dropdown">
                                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-ellipsis-v"></i>
                                  </a>
                                    <?php
                                      switch($clientes['permissaoUsuario']){
                                        case 0:
                                          echo "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow p-2'>
                                          <button class='btn btn-success' onclick='aprovar(".$clientes['idUsuario'].")' id='aprovaCliente'>Aprovar Revendedor</button>";
                                        break;
                                        case 1:
                                          echo "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow p-2'>
                                          <button class='btn btn-warning' data-id='".$clientes['idUsuario']."' data-nome='".$clientes['nomeUsuario']."' data-sobrenome='".$clientes['sobrenomeUsuario']."' data-toggle='modal' data-target='#desitavaCliente'>Desativar Revendedor</button>

                                          <button class='btn btn-danger' data-id='".$clientes['idUsuario']."' data-nome='".$clientes['nomeUsuario']."' data-sobrenome='".$clientes['sobrenomeUsuario']."' data-foto='".$clientes['fotoUsuario']."' data-toggle='modal' data-target='#confirmaExclusaoDeCliente'>Excluir Revendedor</button>";
                                        break;
                                        case 2:
                                          echo "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow p-2'>
                                          <button class='btn btn-success' onclick='reativar(".$clientes['idUsuario'].")' id='aprovaCliente'>Reativar Revendedor</button>

                                          <button class='btn btn-danger' data-id='".$clientes['idUsuario']."' data-nome='".$clientes['nomeUsuario']."' data-sobrenome='".$clientes['sobrenomeUsuario']."' data-foto='".$clientes['fotoUsuario']."' data-toggle='modal' data-target='#confirmaExclusaoDeCliente'>Excluir Revendedor</button>";
                                        break;
                                      }
                                    ?>
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

<div id="notificacaoProduto" class="fixed-bottom mb-2" style="z-index:9999999;"></div>