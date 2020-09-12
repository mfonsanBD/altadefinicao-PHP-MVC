<?php
namespace Controllers;
use \Core\Controller;

class ContatoController extends Controller{
	public function index(){
		$this->titulo = "Contato";
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
				require_once("phpmailer/PHPMailerAutoload.php");
				$mail = new PHPMailer();
		
				$mail->IsSMTP();
				$mail->Host = "smtp.grupohrbrasil.com.br";
				$mail->SMTPAuth = true;
				$mail->Port = 587;
				$mail->SMTPSecure = false;
				$mail->SMTPAutoTLS = false;
				$mail->Username = 'orcamento@grupohrbrasil.com.br';
				$mail->Password = 'GrupoHR2020';
		
				
		
				// DADOS DO REMETENTE
				$mail->Sender = "orcamento@grupohrbrasil.com.br"; // Conta de email existente e ativa em seu domínio
				$mail->From = $email; // Sua conta de email que será remetente da mensagem
				$mail->FromName = $nome; // Nome da conta de email
		
				// DADOS DO DESTINATÁRIO
				$mail->AddAddress('orcamento@grupohrbrasil.com.br', 'Grupo HR');
		
				// Definição de HTML/codificação
				$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
				$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
		
				// DEFINIÇÃO DA MENSAGEM
				$mail->Subject  = "Pedido de Orçamento para Condomínio"; // Assunto da mensagem
		
				$mail->Body = "
				<div style='width: 600px; background-color: #000000; padding: 10px 0; text-align: center;'>
					<a href=https://grupohrbrasil.com.br><img src=https://grupohrbrasil.com.br/wp-content/uploads/2019/09/Logo-Horizontal-Branca-Sem-Fundo.png width=180 alt=Logo Grupo HR></a>
				</div>
				<div style='width: 600px; padding: 30px 20px; font-size:14px; background-color: #ededed; font-family: helvetica;'>
					<h2 style='text-align: center; text-transform: uppercase; letter-spacing: -0.3px; margin-bottom: 30px;'>".$mail->Subject."</h2>
					
					<p style='color: #666; margin-bottom: 5px;'>Houve algum caso de roubo/arrastão em Condomínios do bairro ou regiões próximas ao seu, nos últimos 3 anos? <b style='color: #000 !important;'>".$p1."</b></p>
					<p style='color: #666; margin-bottom: 5px;'>Houve algum caso de roubo/arrastão no Condomínio nos últimos 5 anos? <b style='color: #000 !important;'>".$p2."</b></p>
					<p style='color: #666; margin-bottom: 5px;'>Ocorreram casos de furtos ou vandalismo no Condomínio nos últimos 3 anos? <b style='color: #000 !important;'>".$p3."</b></p>
					<p style='color: #666; margin-bottom: 5px;'>Existem moradores com comportamento ostensivo de riqueza ou que notoriamente guardam valores numerários ou ítens de luxo no interior do condomínio? <b style='color: #000 !important;'>".$p4."</b></p>
					<p style='color: #666; margin-bottom: 5px;'>Existe uma Política de Segurança definida no Regulamento Interno do Condomínio? <b style='color: #000 !important;'>".$p5."</b></p>
					<p style='color: #666; margin-bottom: 5px;'>As barreiras físicas perimetrais (muros, cercas e grades) têm altura mínima de 3 metros? <b style='color: #000 !important;'>".$p6."</b></p>
					<p style='color: #666; margin-bottom: 5px;'>As barreiras perimetrais estão estruturadas de forma a não permitir que sejam facilmente escaladas (exemplo: muretas ou telhados próximos ou apoios para os pés nas grades)? <b style='color: #000 !important;'>".$p7."</b></p>
					<p style='color: #666; margin-bottom: 5px;'>Existe sistema de sensores monitorados em todo o perímetro (sensores infravermelho, cerca elétrica monitorada, etc.)? <br><b style='color: #000 !important;'>".$p8."</b></p>
					<p style='color: #666; margin-bottom: 5px;'>Existem complementos de segurança cortante ou de choque, instalados acima da barreira física (concertina, espetos, cerca elétrica, etc.)? <b style='color: #000 !important;'>".$p9."</b></p>
					<p style='color: #666;'>Existe sistema periódico de ronda perimetral, realizado por vigilantes especializados? <b style='color: #000 !important;'>".$p10."</b></p><br><br>
					<nome style='color: #666;'>
						Nome do Cliente: 
							<b style='color: #000 !important;'>".$nome."</b>
					</nome>
					<br>
					<email style='color: #666;'>
						E-mail: 
							<b style='color: #000 !important;'>".$email."</b>
					</email>
					<br>
					<telefone style='color: #666;'>
						Telefone: 
							<b style='color: #000 !important;'>".$telefone."</b>
					</telefone>
					<br>
					<cep style='color: #666;'>
						CEP: 
							<b style='color: #000 !important;'>".$cep."</b>
					</cep>
				</div>
				<img style='margin: 0; padding: 0;' src=https://grupohrbrasil.com.br/wp-content/uploads/2018/10/base.png alt=Fundo width=600>
				<div style='margin-top: -70px; width: 600px; background-color: #000000; font-family: helvetica; padding: 10px 0; text-align: center;'>
					<p style='color: #FFFFFF; font-size: 14px;'>Pedido feito através do site: <a style='color: #f2e62e; text-decoration: none;' href=https://grupohrbrasil.com.br>www.grupohrbrasil.com.br</a></p>
				</div>
				";
		
				// ENVIO DO EMAIL
				$enviado = $mail->Send();
				// Limpa os destinatários e os anexos
				$mail->ClearAllRecipients();
				// Exibe uma mensagem de resultado do envio (sucesso/erro)
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