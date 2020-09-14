<?php
namespace Controllers;
use \Core\Controller;

class ProdutosEServicosController extends Controller{
	public function index(){
		$this->titulo = "Produtos & Serviços";
		$this->loadTemplate('produtosEServicos', $dados=array());
	}
	public function letreiroEmLona(){
		$this->titulo = "Letreiro em Lona";
		$this->loadTemplate('pes/letreiro-em-lona', $dados=array());
	}
	public function letreiroEmAcm(){
		$this->titulo = "Letreiro em ACM";
		$this->loadTemplate('pes/letreiro-em-acm', $dados=array());
	}
	public function adesivo(){
		$this->titulo = "Adesivo";
		$this->loadTemplate('pes/adesivo', $dados=array());
	}
	public function banners(){
		$this->titulo = "Banners";
		$this->loadTemplate('pes/banners', $dados=array());
	}
	public function envelopamentoDeFrotas(){
		$this->titulo = "Envelopamento de Frotas";
		$this->loadTemplate('pes/envelopamento-de-frotas', $dados=array());
	}
	public function envelopamentoDeGeladeira(){
		$this->titulo = "Envelopamento de Geladeira";
		$this->loadTemplate('pes/envelopamento-de-geladeira', $dados=array());
	}
	public function totens(){
		$this->titulo = "Totens";
		$this->loadTemplate('pes/totens', $dados=array());
	}
	public function cartaoDeVisita(){
		$this->titulo = "Cartão de Visita";
		$this->loadTemplate('pes/cartao-de-visita', $dados=array());
	}
	public function panfleto(){
		$this->titulo = "Panfleto";
		$this->loadTemplate('pes/panfleto', $dados=array());
	}
	public function tabuaParaChurrasco(){
		$this->titulo = "Tabua para Churrasco Personalizada";
		$this->loadTemplate('pes/tabua-para-churrasco', $dados=array());
	}
}