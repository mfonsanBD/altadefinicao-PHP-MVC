<?php 
namespace Controllers;
use \Core\Controller;

class NotFoundController extends controller{
	public function index(){
		$this->titulo = "Página não encontrada!";
		$this->loadTemplate('404', $dados=array());
	}
}