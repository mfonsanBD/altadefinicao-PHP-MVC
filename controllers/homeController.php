<?php
namespace Controllers;
use \Core\Controller;

class HomeController extends Controller{
	public function index(){
		$this->titulo = "A maior gráfica de Duque de Caxias";

		$this->descricao = "Alta Definição Caxias Comunicação Visual, a maior gráfica de Duque de Caxias.";

		$this->loadTemplate('home', $dados=array());
	}
}