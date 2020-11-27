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
        <div class="col-xl-5 order-xl-2">
          <div class="card card-profile">
            <div class="card-body">
              <h6 class="heading-small text-muted mb-4">Endereços Cadastrados</h6>
              <div class="row border pt-2 pb-2">
                <div class="col-xl-12">
                  <small><b>Destinatário:</b> <?=$this->nomeUsuario?></small>
                </div>
                <div class="col-xl-12">
                  <small><b>Endereço:</b> Av. Governador Leonel de Moura Brizola, 3 - complemento</small>
                </div>
                <div class="col-xl-6">
                  <small><b>Bairro:</b> bairro</small>
                </div>
                <div class="col-xl-6">
                  <small><b>Cidade/UF:</b> cidade/RJ</small>
                </div>
                <div class="col-xl-12">
                  <small><b>CEP:</b> cep</small>
                </div>
                <div class="col-xl-12">
                  <small><b>Ponto de Referência:</b> referência</small>
                </div>
                <div class="col-xl-6 mt-2">
                  <button class="btn btn-default btn-block"><i class="fas fa-edit"></i> Editar</button>
                </div>
                <div class="col-xl-6 mt-2">
                  <button class="btn btn-danger btn-block"><i class="fas fa-trash-alt"></i> Excluir</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-7 order-xl-1">
          <div class="card">
            <div class="card-body">
              <form>
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Cadastrar Endereço</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="destinatario">Destinatário</label>
                        <input id="destinatario" class="form-control" placeholder="Ex: João dos Santos Silva" type="text">
                      </div>
                    </div>
                  </div>
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
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="pontoDeReferencia">Ponto de Refrência</label>
                        <textarea class="form-control" id="pontoDeReferencia" rows="4" placeholder="Ex: Loja de esquina com a rua tal..."></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                      <button class="btn btn-warning mt-3" id="botaoCadastraEndereco">Cadastrar Endereço</button>
                  </div>
                </div>
                <hr class="my-4" />
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

<div id="notificacaoEndereco" class="fixed-bottom mb-2" style="z-index:9999999;"></div>