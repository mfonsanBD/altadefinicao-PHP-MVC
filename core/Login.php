<?php
namespace Core;

class Login{
	public function loadView($viewNome, $dados = array()){
		extract($dados);
		require 'views/painel/'.$viewNome.'.php';
	}
	public function loadTemplate($viewNome, $dados = array()){
		require 'views/painel/template.php';
	}
	public function loadViewInTemplate($viewNome, $dados = array()){
		extract($dados);
		require 'views/painel/'.$viewNome.'.php';
	}
}