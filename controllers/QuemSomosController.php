<?php
namespace Controllers;
use \Core\Controller;

class QuemSomosController extends Controller{
	public function index(){
		$this->titulo = "Quem Somos";
		$this->loadTemplate('quemSomos', $dados=array());
	}
}