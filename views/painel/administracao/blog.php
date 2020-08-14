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
              <a href="#" class="btn btn-neutral text-warning" data-toggle="modal" data-target="#cadastra-post"><i class="fas fa-plus"></i> Cadastrar Notícia</a>
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
                  <h3 class="mb-0">Notícias Cadastradas</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <table class="table align-items-center table-flush" id="tabelaDeClientes">
                  <thead class="thead-light">
                  <tr>
                      <th scope="col" class="sort" data-sort="name">Imagem da Notícia</th>
                      <th scope="col" class="sort" data-sort="name">Título</th>
                      <th scope="col" class="sort" data-sort="name">Data de Publicação</th>
                      <th scope="col" class="sort" data-sort="status">Status</th>
                      <th scope="col">Publicado Por</th>
                      <th scope="col"></th>
                  </tr>
                  </thead>
                  <tbody class="list">
                      <?php
                          foreach($listaPostagem as $postagens):
                      ?>
                      <tr>
                          <th scope="row">
                              <div class="media align-items-center">
                                  <span class="avatar avatar-lg rounded">
                                    <?php
                                        if($postagens['imagemPostagem'] == 'principal.png'){
                                            echo "<img alt='Foto de Notícia' height='100%' src='media/noticias/principal.png'>";
                                        }else{
                                            echo "<img alt='Foto de ".$postagens['tituloPostagem']."' height='100%' src='media/noticias/".$postagens['imagemPostagem']."'>";
                                        }
                                    ?>
                                  </span>
                              </div>
                          </th>
                          <th scope="row">
                              <div class="media align-items-center">
                                  <div class="media-body">
                                    <span class="name mb-0 text-sm ml-2"><?=$postagens['tituloPostagem'];?></span>
                                  </div>
                              </div>
                          </th>
                          <td>
                            <?=date('d/m/Y - H:i', strtotime($postagens['dataPostagem']))?>
                          </td>
                          <td>
                              <span class="badge badge-dot mr-4">
                                <?php
                                  switch($postagens['statusPostagem']){
                                    case 0:
                                      echo "<i class='bg-default'></i>
                                      <span class='status'>Rascunho</span>";
                                    break;
                                    case 1:
                                      echo "<i class='bg-success'></i>
                                      <span class='status'>Publicado</span>";
                                    break;
                                  }
                                ?>
                              </span>
                          </td>
                          <td>
                              <span class="badge badge-dot mr-4">
                                <?=$postagens['nomeUsuario']." ".$postagens['sobrenomeUsuario']?>
                              </span>
                          </td>
                          <td class="text-right">
                              <div class="dropdown">
                                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-ellipsis-v"></i>
                                  </a>
                                    <?php
                                      echo "
                                      <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow p-2'>
                                          <a href='noticia/".$postagens['slugPostagem']."' class='btn btn-success btn-sm'>Visualizar Notícia</a>
                                          <button class='btn btn-default btn-sm'>Editar Notícia</button>
                                          <button class='btn btn-danger btn-sm' data-id='".$postagens['idPostagem']."' data-titulo='".$postagens['tituloPostagem']."' data-foto='".$postagens['imagemPostagem']."' data-toggle='modal' data-target='#confirmaExclusaoDeNoticia'>Excluir Notícia</button>
                                          <button class='btn btn-info btn-sm'>Mudar Imagem da Notícia</button>
                                      </div>
                                      ";
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
        <div class="modal fade" id="cadastra-post" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-blog modal- modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-secondary border-0 mb-0">
                            <div class="card-header bg-warning text-white">
                                Cadastro de Nova Notícia
                            </div>
                            <div class="card-body px-lg-5 py-lg-5">
                              <form role="form" id="cadastraPostagem">
                                  <div class="form-group">
                                      <div class="input-group input-group-merge input-group-alternative">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                          </div>
                                          <input class="form-control" placeholder="Título" type="text" id="titulo">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <textarea type="text" class="form-control" id="texto_blog" name="texto_blog"></textarea>
                                  </div>
                                  <button type="submit" class="btn btn-warning btn-block mt-4" style="margin-top:2%">Imagem da Notícia</button>
                                  <div class="row d-none mt-4" id="cortaImagem">
                                      <div class="col-md-12" style="padding:5%;">
                                          <input type="file" id="imageNoticia" class="d-none">
                                          <label for="imageNoticia" class="p-3 border text-center w-100">Clique aqui e escolha uma imagem para essa notícia</label>
                                      </div>
                                      <div class="col-md-12 text-center">
                                          <div id="upload-demoNoticia"></div>
                                      </div>
                                      <button type="button" class="btn btn-warning btn-block btn-upload-imageNoticia mt-4" style="margin-top:2%">Cadastrar Notícia</button>
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
    <div class="modal fade" id="confirmaExclusaoDeNoticia" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                  <h4 class="heading mt-4">A notícia <noticia></noticia> está para ser excluida.</h4>
                  <p>Tem certeza que deseja excluir <noticia></noticia>?<br>Todas as informações dela serão excluidas permanentemente.</p>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-white" id="botaoExcluiNoticia">Sim, excluir</button>
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

<div id="notificacaoBlog" class="fixed-bottom mb-2" style="z-index:9999999;"></div>