<?php 
namespace Controllers;
use \Core\Login;

class CadastroController extends Login{
	public function index(){
		$this->titulo = "Cadastre-se";
		$this->loadTemplate('cadastro', $dados=array());
	}
}