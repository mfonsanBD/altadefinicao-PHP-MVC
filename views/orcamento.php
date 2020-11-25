<nav aria-label="breadcrumb" class="fundobdc">
    <ol class="breadcrumb justify-content-center ondeestou">
        <li class="breadcrumb-item"><a href="inicio">Página Inicial</a></li>
        <li class="breadcrumb-item breadcrumb-titulo active" aria-current="page"><?=$this->titulo?></li>
    </ol>
</nav>

<section class="mt-3">
    <div class="container">
        <div class="pt-3 pb-5">
            <h3 class="text-center text-uppercase mb-4">Pedido de Orçamento</h3>
            <div class="row justify-content-center">
                <div class="col-lg-6 bg-light border p-3 text-center">
                    <div id="cadastraPedido">
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-box"></i>
                                </div>
                                <select class="form-control m-0" id="produtoPedido" name="produtoPedido">
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
                        <div class="text-center">
                            <button id="botaoCadastraPedido" class="btn btn-secondary my-4">Próximo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>