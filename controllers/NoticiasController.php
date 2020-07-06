<?php
namespace Controllers;
use \Core\Controller;

class NoticiasController extends Controller{
	public function index(){
		$this->titulo = "Notícias";
		$this->loadTemplate('noticias', $dados=array());
	}
}