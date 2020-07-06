<?php
namespace Controllers;
use \Core\Controller;

class ProdutosEServicosController extends Controller{
	public function index(){
		$this->titulo = "Produtos & Serviços";
		$this->loadTemplate('produtosEServicos', $dados=array());
	}
}