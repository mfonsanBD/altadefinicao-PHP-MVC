<?php
namespace Controllers;
use \Core\Controller;

class ContatoController extends Controller{
	public function index(){
		$this->titulo = "Contato";
		$this->loadTemplate('contato', $dados=array());
	}
}