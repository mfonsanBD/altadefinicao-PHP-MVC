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
                  <a href="#">
                    <?php
                        if($this->foto == 'usuario.jpg'){
                            echo "<img alt='Foto de Usuário' src='".URL_BASE."assets/img/usuario.jpg' class='rounded-circle'>";
                        }else{
                            echo "<img alt='Foto de ".$this->nomeUsuario."' src='".URL_BASE."assets/img/usuario/".$_SESSION['logado']."/".$this->foto."' class='rounded-circle'>";
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
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" placeholder="Digite seu melhor e-mail" value="<?=$informacoesUsuario['emailUsuario']?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="senha">Senha</label>
                        <input type="text" id="senha" class="form-control" placeholder="Digite sua nova senha">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="confirmaSenha">Confirme sua senha</label>
                        <input type="text" id="confirmaSenha" class="form-control" placeholder="Confirme sua nova senha">
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                      <button class="btn btn-success btn-sm mt-3">Salvar Alterações de Usuário</button>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Informações do Endereço</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="logradouro">Logradouro</label>
                        <input id="logradouro" class="form-control" placeholder="Ex: Av. Governador Leonel de Moura Brizola" type="text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2">
                      <div class="form-group">
                        <label class="form-control-label" for="numero">Número</label>
                        <input type="text" id="numero" class="form-control" placeholder="01">
                      </div>
                    </div>
                    <div class="col-lg-5">
                      <div class="form-group">
                        <label class="form-control-label" for="complemento">Complemento</label>
                        <input type="text" id="complemento" class="form-control" placeholder="Ex: Lote: 00 Quadra: 00">
                      </div>
                    </div>
                    <div class="col-lg-5">
                      <div class="form-group">
                        <label class="form-control-label" for="bairro">Bairro</label>
                        <input type="text" id="bairro" class="form-control" placeholder="Ex: São Bento">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="cidade">Cidade</label>
                        <input type="text" id="cidade" class="form-control" placeholder="Ex: Duque de Caxias">
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                        <label class="form-control-label" for="estado">Estado</label>
                        <input type="text" id="estado" class="form-control" placeholder="Ex: RJ">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="cep">CEP</label>
                        <input type="text" id="cep" class="form-control" placeholder="Ex: 00.000-000">
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                      <button class="btn btn-success btn-sm mt-3">Salvar Alterações de Endereço</button>
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
                        <input type="text" id="telefoneFixo" class="form-control" placeholder="Ex: 0000-0000">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="celular">Celular</label>
                        <input type="text" id="celular" class="form-control" placeholder="Ex: (21) 90000-0000">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="whatsapp">WhatsaApp</label>
                        <input type="text" id="whatsapp" class="form-control" placeholder="Ex: (21) 90000-0000">
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                      <button class="btn btn-success btn-sm mt-3">Salvar Alterações de Contato</button>
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

<div id="notificacaoPerfil" class="fixed-bottom mb-2" style="z-index:9999999;"></div>