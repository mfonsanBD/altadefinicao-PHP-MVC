<?php
namespace Core;

class Login{
	public function loadView($viewNome, $dados = array()){
		extract($dados);
		require 'Views/painel/'.$viewNome.'.php';
	}
	public function loadTemplate($viewNome, $dados = array()){
		require 'Views/painel/template.php';
	}
	public function loadViewInTemplate($viewNome, $dados = array()){
		extract($dados);
		require 'Views/painel/'.$viewNome.'.php';
	}
}