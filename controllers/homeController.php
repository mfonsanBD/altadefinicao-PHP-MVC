<?php
namespace Controllers;
use \Core\Controller;

class HomeController extends Controller{
	public function index(){
		$this->titulo = "Página Principal";
		$this->loadTemplate('home', $dados=array());
	}
}