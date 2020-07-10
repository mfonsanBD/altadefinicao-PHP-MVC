<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;

class CadastroController extends Login{
	public function index(){
		$this->titulo = "Cadastre-se";
		$this->loadTemplate('cadastro', $dados=array());
	}
	public function verificaEmail(){
		if(!empty($_POST) && isset($_POST)){
			$email = trim(addslashes($_POST['email']));
			$usuario = new Usuario();

			if($usuario->verificaEmail($email)){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
	public function cadastro(){
		if(!empty($_POST) && isset($_POST)){
			$nome 				= trim(addslashes($_POST['nome']));
			$sobrenome 			= trim(addslashes($_POST['sobrenome']));
			$email 				= trim(addslashes($_POST['email']));
			$senha 				= md5(trim(addslashes($_POST['senha'])));
			$hashConfirmacao 	= md5(date('d/m/Y H:i:s').rand(0,9999));
			$recaptcha 			= trim(addslashes($_POST['recaptcha']));
			
			$secretKey = "6LePCrAZAAAAAMwQjx-rODIABhdcQdCTf2fjcjk1";
			$ip = $_SERVER['REMOTE_ADDR'];
			
			// envia a requisição para o servidor
			$url = 'https://www.google.com/recaptcha/api/siteverify?secret='.urlencode($secretKey).'&response='.urlencode($recaptcha);
			$response = file_get_contents($url);
			$responseKeys = json_decode($response,true);

			// retorna um JSON de sucesso no envio
			if($responseKeys["success"]) {
					$usuario = new Usuario();
					if($usuario->cadastro($nome, $sobrenome, $email, $senha, $hashConfirmacao)){
						echo 1;
					}else{
						echo 0;
					}
			} else {
					echo 2;
			}
			
		}
	}
}