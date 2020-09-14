<!doctype html>
<html lang="pt-br">
  <head>
	<title><?=NOME_DO_SITE." :: ".$this->titulo?></title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<link rel="icon" href="assets/img/favicon.png" type="image/png">

	<!-- CSS -->
	<link rel="stylesheet" href="assets/css/estilo.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
	<script src="https://kit.fontawesome.com/8ab5313a10.js" crossorigin="anonymous"></script>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-transparent p-0">
			<a class="navbar-brand p-0" href="inicio"><img src="assets/img/logo-alta-definicao.png" alt="Logo Alta Definição"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav menu">
					<li class="nav-item <?=($this->titulo == "A maior gráfica de Duque de Caxias") ? 'ativo' : '';?>">
						<a class="nav-link" href="inicio">Inicio</a>
					</li>
					<li class="nav-item <?=($this->titulo == "Quem Somos") ? 'ativo' : '';?>">
						<a class="nav-link" href="quem-somos">Quem Somos</a>
					</li>
					<li class="nav-item <?=($this->titulo == "Produtos & Serviços") ? 'ativo' : '';?>">
						<a class="nav-link" href="produtos-e-servicos">Produtos & Serviços</a>
					</li>
					<!-- <li class="nav-item <?=($this->titulo == "Notícias") ? 'ativo' : '';?>">
						<a class="nav-link" href="noticias">Notícias</a>
					</li>
					<li class="nav-item <?=($this->titulo == "Orçamento") ? 'ativo' : '';?>">
						<a class="nav-link" href="orcamento">Orçamento</a>
					</li> -->
					<li class="nav-item <?=($this->titulo == "Contato") ? 'ativo' : '';?>">
						<a class="nav-link" href="contato">Contato</a>
					</li>
				</ul>
				<?php
					if(empty($_SESSION['logado']) || !isset($_SESSION['logado'])){
				?>
					<!-- <button id="botaoLogin" class="btn bg-padrao my-2 my-sm-0 btn-sm ml-3">Login</button> -->
				<?php
					}else{
				?>
					<!-- <button id="botaoPainel" class="btn bg-padrao my-2 my-sm-0 btn-sm ml-3">Painel de Controle</button> -->
				<?php
					} 
				?>
			</div>
		</nav>
	</div>
	
	<?php
		$this->loadViewInTemplate($viewNome, $dados);
	?>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<a class="navbar-brand" href="home"><img src="assets/img/logo-alta-definicao.png" alt="Logo Alta Definição"></a>
					<p>A Alta Definição teve seu inicio em 2000, Valdeir Foli, empresário visionário, começou sua empresa pensando no revendedor...</p>
				</div>
				<div class="col-lg-4">
					<h5>Menu do Site</h5>
					<ul class="navbar-nav pt-4">
						<li>
							<a class="nav-link text-white" href="inicio">Inicio</a>
						</li>
						<li>
							<a class="nav-link text-white" href="quem-somos">Quem Somos</a>
						</li>
						<li>
							<a class="nav-link text-white" href="produtos-e-servicos">Produtos & Serviços</a>
						</li>
						<!-- <li>
							<a class="nav-link text-white" href="noticias">Notícias</a>
						</li>
						<li>
							<a class="nav-link text-white" href="orcamento">Orçamento</a>
						</li> -->
						<li>
							<a class="nav-link text-white" href="contato">Contato</a>
						</li>
					</ul>
				</div>
				<div class="col-lg-4">
					<h5>Segue lá!</h5>
					<ul class="list-inline mt-4">
						<li class="list-inline-item">
							<a class="text-white" href="https://www.facebook.com/AltaDefinicaoComunicacaoVisual" target="_blank"><i class="fab fa-facebook-square fa-2x"></i></a>
						</li>
						<li class="list-inline-item">
							<a class="text-white" href="https://www.instagram.com/altadefinicaorj/" target="_blank"><i class="fab fa-instagram fa-2x"></i></a>
						</li>
						<li class="list-inline-item">
							<a class="text-white" href="https://api.whatsapp.com/send?phone=5521982372555" target="_blank"><i class="fab fa-whatsapp fa-2x"></i></a>
						</li>
					</ul>
				</div>
				<!-- <div class="col">
					<h5>Newsletter</h5>
					<form class="pt-4">
						<div class="form-group">
							<input type="text" class="form-control" id="newsNome" placeholder="Nome Completo">
						</div>
						<div class="form-group">
							<input type="email" class="form-control" id="newsEmail" placeholder="E-mail">
							<small id="emailHelp" class="form-text text-muted">Envie seu melhor e-mail.</small>
						</div>
						<div class="form-group form-check">
							<input type="checkbox" class="form-check-input" id="newsCheck">
							<label class="form-check-label" for="newsCheck">Concordo com os termos e condições de uso.</label>
						</div>
						<button type="submit" class="btn bg-padrao">Enviar</button>
					</form>
				</div> -->
			</div>
		</div>
	</footer>

	<section id="copyright" class="p-4">
		<p class="text-center text-white p-0 m-0">&copy; Copyright 
			<?php
				$anos = date('Y', strtotime('- 2000 years'));
				echo date('Y', strtotime('- '.$anos.' years'))." - ".date('Y').", <span class='nome-site'>".NOME_DO_SITE."</span>";
			?>. Todos os direitos reservados.</p>
	</section>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script src="assets/js/site.js"></script>
  </body>
</html>