<?php
namespace Controllers;
use \Core\Controller;
use \Models\Usuario;
use \Models\Produtos;
use \Models\Midia;
use \Models\Acabamento;
use \Models\ValorProdutoTipoCliente;

class OrcamentoController extends Controller{
	public function index(){
		$dados=array();

        $produto                    = new Produtos();
        $listaProduto               = $produto->listaProduto();
		
		$this->titulo = "Orçamento";
		
        $dados['listaProduto']      = $listaProduto;
		$this->loadTemplate('orcamento', $dados);
	}
}