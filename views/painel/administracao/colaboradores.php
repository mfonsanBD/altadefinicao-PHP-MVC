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
              <a href="#" class="btn btn-neutral text-warning" data-toggle="modal" data-target="#cadastra-colaborador"><i class="fas fa-plus"></i> Cadastrar Colaborador</a>
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
                  <h3 class="mb-0">Colaboradores Cadastrados</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <table class="table align-items-center table-flush" id="tabelaDeClientes">
                  <thead class="thead-light">
                  <tr>
                      <th scope="col" class="sort" data-sort="nome">Colaborador</th>
                      <th scope="col" class="sort" data-sort="cargo">Função</th>
                      <th scope="col"></th>
                  </tr>
                  </thead>
                  <tbody class="list">
                      <?php
                          foreach($listaColaboradores as $colaboradores):
                      ?>
                      <tr>
                          <th scope="row">
                              <div class="media align-items-center">
                                  <span class="avatar avatar-lg rounded-circle">
                                    <?php
                                        if($colaboradores['fotoColaborador'] == 'usuario.jpg'){
                                            echo "<img alt='Foto do Colaborador' src='assets/img/usuario.jpg'>";
                                        }else{
                                            echo "<img alt='Foto de ".$colaboradores['nomeColaborador']."' src='assets/img/equipe/".$colaboradores['fotoColaborador']."'>";
                                        }
                                    ?>
                                  </span>
                                  <div class="media-body">
                                  <span class="name mb-0 text-sm ml-2"><?=$colaboradores['nomeColaborador'];?></span>
                                  </div>
                              </div>
                          </th>
                          <td>
                              <span class="badge badge-dot mr-4"><?=$colaboradores['cargoColaborador'];?></span>
                          </td>
                          <td class="text-right">
                            <?php
                              echo "<button class='btn btn-danger btn-sm' data-id='".$colaboradores['idColaborador']."' data-nome='".$colaboradores['nomeColaborador']."' data-foto='".$colaboradores['fotoColaborador']."' data-toggle='modal' data-target='#confirmaExclusaoDeColaborador'><i class='fas fa-trash-alt'></i> Excluir Colaborador</button>";
                            ?>
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
        <div class="modal fade" id="cadastra-colaborador" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-secondary border-0 mb-0">
                            <div class="card-header bg-warning text-white">
                                Cadastro de Novo Colaborador
                            </div>
                            <div class="card-body px-lg-5 py-lg-5">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-dados" role="tabpanel" aria-labelledby="pills-dados-tab">
                                        <form role="form" id="cadastraColaborador">
                                            <div class="form-group">
                                                <div class="input-group input-group-merge input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                                    </div>
                                                    <input class="form-control" placeholder="Nome do Colaborador" type="text" id="nomeColaborador">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-merge input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                                    </div>
                                                    <input class="form-control" placeholder="Função do Colaborador" type="text" id="funcaoColaborador">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-warning btn-block mt-4" style="margin-top:2%">Imagem do Colaborador</button>
                                            <div class="row d-none mt-4" id="cortaImagem">
                                                <div class="col-md-6" style="padding:5%;">
                                                    <input type="file" id="imageColaborador" class="d-none">
                                                    <label for="imageColaborador" class="p-3 border text-center">Clique aqui e escolha uma imagem para esse colaborador</label>
                                                </div>
                                                <div class="col-md-6 text-center">
                                                    <div id="upload-demoColaborador"></div>
                                                </div>
                                                <button type="button" class="btn btn-warning btn-block btn-upload-imageColaborador mt-4" style="margin-top:2%">Cadastrar Colaborador</button>
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
</div>

<div class="row">
  <div class="col-md-4">
    <div class="modal fade" id="confirmaExclusaoDeColaborador" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                  <h4 class="heading mt-4"><colaborador></colaborador> está para ser excluido.</h4>
                  <p>Tem certeza que deseja excluir <colaborador></colaborador>?<br>Todas as informações dele serão excluidas permanentemente.</p>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-white" id="botaoConfirmaExclusaoColaborador">Sim, excluir</button>
              <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Não, cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="notificacaoColaboradores" class="fixed-bottom mb-2" style="z-index:9999999;"></div>