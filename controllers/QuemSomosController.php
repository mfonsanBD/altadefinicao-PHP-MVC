<?php
namespace Controllers;
use \Core\Controller;

class QuemSomosController extends Controller{
	public function index(){
		$this->titulo = "Quem Somos";

		$this->descricao = "Veja quem somos. A Alta Definição teve seu inicio em 2000. Valdeir Foli, empresário visionário, começou sua empresa pensando no revendedor, tendo como principal produto a impressão digital em Lona e Adesivo.";
		
		$this->loadTemplate('quemSomos', $dados=array());
	}
}