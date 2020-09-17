<?php
namespace Controllers;
use \Core\Controller;

class ProdutosEServicosController extends Controller{
	public function index(){
		$this->titulo = "Produtos & Serviços";

		$this->descricao = "Fique à vontade para conferir nossos produtos & serviços. Trabalhamos com materiais da melhor qualidade para garantir o melhor para seu negócio.";

		$this->loadTemplate('produtosEServicos', $dados=array());
	}
	public function letreiroEmLona(){
		$this->titulo = "Letreiro em Lona";

		$this->descricao = "Letreiro em Lonas com a gramatura de 440 para resistir aos ventos fortes e não danificar o material.";

		$this->loadTemplate('pes/letreiro-em-lona', $dados=array());
	}
	public function letreiroEmAcm(){
		$this->titulo = "Letreiro em ACM";

		$this->descricao = "Letreiro em ACM com recorte de letras em 3D dando um visual incrível para a fachada da sua empresa.";

		$this->loadTemplate('pes/letreiro-em-acm', $dados=array());
	}
	public function adesivo(){
		$this->titulo = "Adesivo";

		$this->descricao = "Trabalhamos com o melhore adesivo do mercado, seja ele leitoso, transparente ou perfurado.";

		$this->loadTemplate('pes/adesivo', $dados=array());
	}
	public function banners(){
		$this->titulo = "Banners";

		$this->descricao = "Banners para anúncios de promoção da sua loja/empresa.";

		$this->loadTemplate('pes/banners', $dados=array());
	}
	public function envelopamentoDeFrotas(){
		$this->titulo = "Envelopamento de Frotas";

		$this->descricao = "Envelopamento de Frotas ou Carro para fazer sua empresa reconhecida no transito.";

		$this->loadTemplate('pes/envelopamento-de-frotas', $dados=array());
	}
	public function envelopamentoDeGeladeira(){
		$this->titulo = "Envelopamento de Geladeira";

		$this->descricao = "Envelopamento de Geladeira com o tema que você quiser.";

		$this->loadTemplate('pes/envelopamento-de-geladeira', $dados=array());
	}
	public function totens(){
		$this->titulo = "Totens";

		$this->descricao = "Aumente a visualização da sua marca e mostre o território do seu negócio com os Totens.";

		$this->loadTemplate('pes/totens', $dados=array());
	}
	public function cartaoDeVisita(){
		$this->titulo = "Cartão de Visita";

		$this->descricao = "Vai fazer uma visita a um cliente ou não tem um portifólio em mãos ao encontrar um futuro cliente? Tenha sempre em mãos um Cartão de Visita.";

		$this->loadTemplate('pes/cartao-de-visita', $dados=array());
	}
	public function panfleto(){
		$this->titulo = "Panfleto";

		$this->descricao = "Distribua em massa o panfleto com a sua marca, promoção e o contato da sua empresa e alcance seus cliente.";

		$this->loadTemplate('pes/panfleto', $dados=array());
	}
	public function tabuaParaChurrasco(){
		$this->titulo = "Tabua para Churrasco Personalizada";

		$this->descricao = "O que acha de ter uma tábua personalizada para cortar seu churrasco no almoço de fim de semana?";

		$this->loadTemplate('pes/tabua-para-churrasco', $dados=array());
	}
}