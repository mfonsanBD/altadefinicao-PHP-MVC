<?php
namespace Core;

class Controller{
	public function loadView($viewNome, $dados = array()){
		extract($dados);
		require 'views/'.$viewNome.'.php';
	}
	public function loadTemplate($viewNome, $dados = array()){
		require 'views/template.php';
	}
	public function loadTemplateNaoEncontrada(){
		require 'views/404.php';
	}
	public function loadViewInTemplate($viewNome, $dados = array()){
		extract($dados);
		require 'views/'.$viewNome.'.php';
	}
}