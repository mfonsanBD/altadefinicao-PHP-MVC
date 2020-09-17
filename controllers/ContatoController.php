<?php
namespace Controllers;
use \Core\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContatoController extends Controller{
	public function index(){
		$this->titulo = "Contato";

		$this->descricao = "Entre em contato. Estamos a disposição para tirar suas dúvidas. Ligue para: (21) 4128-6328, ou mande uma mensagem no WhatsApp em:  (21) 98237-2555.";

		$this->loadTemplate('contato', $dados=array());
	}
	public function enviaContato(){
		if(isset($_POST['recaptcha']) && !empty($_POST['recaptcha'])){
			$chaveSecreta 		= "6LePCrAZAAAAAMwQjx-rODIABhdcQdCTf2fjcjk1";
			$chaveDaResposta 	= $_POST['recaptcha'];
			$ipDoUsuario 		= $_SERVER['REMOTE_ADDR'];
		
			$url = "https://www.google.com/recaptcha/api/siteverify?secret=$chaveSecreta&response=$chaveDaResposta&remoteip=$ipDoUsuario";
			$resposta = file_get_contents($url);
			$resposta = json_decode($resposta);
		
			if ($resposta->success) {
				$mail = new PHPMailer(true);
		
				$mail->IsSMTP();
				$mail->Host = "smtp.altadefinicaocaxias.com.br";
				$mail->SMTPAuth = true;
				$mail->Port = 587;
				$mail->SMTPSecure = false;
				$mail->SMTPAutoTLS = false;
				$mail->Username = 'contato@altadefinicaocaxias.com.br';
				$mail->Password = 'Alta16534229';

				$nome 		= trim(addslashes($_POST['nome']));
				$sobrenome 	= trim(addslashes($_POST['sobrenome']));
				$email 		= trim(addslashes($_POST['email']));
				$assunto 	= trim(addslashes($_POST['assunto']));
				$mensagem 	= trim(addslashes($_POST['mensagem']));
		
				$mail->Sender = "contato@altadefinicaocaxias.com.br";
				$mail->From = $email;
				$mail->FromName = $nome." ".$sobrenome;
		
				$mail->AddAddress('contato@altadefinicaocaxias.com.br', 'Alta Definição Caxias');
		
				$mail->IsHTML(true);
				$mail->CharSet = 'utf-8';
		
				$mail->Subject  = $assunto;
				$mail->Body = "".$mensagem."";
		
				$enviado = $mail->Send();
				$mail->ClearAllRecipients();
				if ($enviado) {
					echo 1;
				} else {
					echo 0;
				}
			}else{
				echo 2;
			}
		}
	}
}