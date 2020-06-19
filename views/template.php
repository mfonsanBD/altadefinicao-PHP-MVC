<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= NOME_DO_SITE ?> - <?=$this->titulo;?></title>
</head>
<body>

<?php
	$this->loadViewInTemplate($viewNome, $dados);
?>

</body>
</html>