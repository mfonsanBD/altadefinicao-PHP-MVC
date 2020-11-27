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
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a class="btn" data-toggle="modal" data-target="#alteraFotoUsuario">
                    <?php
                      if($this->foto == 'usuario.jpg'){
                          echo "<img alt='Foto de Usuário' src='".URL_BASE."assets/img/usuario.jpg' class='rounded-circle'>";
                      }else{
                          echo "<img alt='Foto de ".$this->nomeUsuario."' src='".URL_BASE."media/usuarios/".$_SESSION['logado']."/".$this->foto."' class='rounded-circle'>";
                      }
                    ?>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body pt-0">
              <div class="text-center mt-7">
                <h5 class="h3 m-0 p-0">
                  <?=$this->nomeUsuario;?>
                </h5>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?=$this->tipoUsuario?>
                </div>
              </div>
            </div>
          </div>
          <div class="card card-profile mt-3">
            <div class="card-body">
              <h6 class="heading-small text-muted mb-4">Senha de Acesso</h6>
              <div class="text-left">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label" for="senha">Nova Senha</label>
                    <input type="password" id="senha" class="form-control" placeholder="Digite sua nova senha">
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label" for="confirmaSenha">Confirme sua nova senha</label>
                    <input type="password" id="confirmaSenha" class="form-control" placeholder="Confirme sua nova senha">
                  </div>
                </div>
                <div class="col-lg-12 text-center mb-2 text-muted font-italic forcaSenha"></div>
                <div class="text-center">
                    <button class="btn btn-warning btn-sm mt-3" id="botaoAlteracaoSenha">Salvar Alterações de Senha</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Editar Perfil </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">Informação de Usuário</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="primeiro_nome">Nome</label>
                        <input type="text" id="primeiro_nome" class="form-control" placeholder="Digite seu primeiro nome" value="<?=$informacoesUsuario['nomeUsuario']?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="sobrenome">Sobrenome</label>
                        <input type="text" id="sobrenome" class="form-control" placeholder="Digite seu sobrenome" value="<?=$informacoesUsuario['sobrenomeUsuario']?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" placeholder="Digite seu melhor e-mail" value="<?=$informacoesUsuario['emailUsuario']?>">
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                      <button class="btn btn-warning btn-sm mt-3" id="botaoAlteracaoUsuario">Salvar Alterações de Usuário</button>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">Informações de Contato</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="telefoneFixo">Telefone (Fixo)</label>
                        <input type="text" id="fixo" class="form-control fixo" placeholder="Ex: (00) 0000-0000" value="<?=$informacoesUsuario['telefoneCliente']?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="celular">Celular</label>
                        <input type="text" id="celular" class="form-control celular" placeholder="Ex: (00) 90000-0000" value="<?=$informacoesUsuario['celularCliente']?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="whatsapp">WhatsaApp</label>
                        <input type="text" id="whatsapp" class="form-control whatsapp" placeholder="Ex: +55 (00) 90000-0000" value="<?=$informacoesUsuario['whatsappCliente']?>">
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                      <button class="btn btn-warning btn-sm mt-3" id="botaoAlteracaoContato">Salvar Alterações de Contato</button>
                  </div>
                </div>
              </form>
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
    <div class="modal fade" id="alteraFotoUsuario" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered modal" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-secondary border-0 mb-0">
              <div class="card-header bg-warning text-white">
                  Alterar Foto
              </div>
              <div class="card-body px-lg-5 py-lg-5">
                <div>
                  <h4>Definir a imagem do usuário.</h4>
                  <div class="row" id="cortaImagemUsuario">
                    <div class="col-md-12 text-center">
                      <div id="upload-demo-usuario"></div>
                    </div>
                    <div class="col-md-12" style="padding:5%;">
                      <input type="file" id="imageUsuario" class="d-none" accept=".jpeg, .jpg">
                      <label for="imageUsuario" class="p-3 border text-center"><span class="text-warning">Clique aqui</span> e escolha uma imagem para seu perfil</label>
                      <div class="text-center">
                        <button type="button" class="btn btn-warning btn-upload-image-usuario mt-4" style="margin-top:2%">Definir Imagem</button>
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
</div>

<div id="notificacaoPerfil" class="fixed-bottom mb-2" style="z-index:9999999;"></div>