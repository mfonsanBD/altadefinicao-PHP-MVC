<?php 
namespace Controllers;
use \Core\Login;

class LoginController extends Login{
	public function index(){
		$this->titulo = "Login";
		$this->loadTemplate('login', $dados=array());
	}
}