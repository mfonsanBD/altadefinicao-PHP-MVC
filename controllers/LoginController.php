<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;

class LoginController extends Login{
	public function index(){
		$this->titulo = "Login";
		$this->loadTemplate('login', $dados=array());
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
	public function verificaSenha(){
		if(!empty($_POST) && isset($_POST)){
			$email = trim(addslashes($_POST['email']));
			$senha = md5(trim(addslashes($_POST['senha'])));
			$usuario = new Usuario();

			if($usuario->verificaSenha($email, $senha)){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
	public function logar(){
		$email 				= trim(addslashes($_POST['email']));
		$senha 				= md5(trim(addslashes($_POST['senha'])));
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
				if($usuario->logar($email, $senha)){
					echo 1;
				}else{
					echo 0;
				}
		} else {
				echo 2;
		}
	}
	public function sair(){
		unset($_SESSION['logado']);
		unset($_SESSION['tipoUsuario']);
		header("Location: login");
	}
}