<?php
require 'ambiente.php';

define("NOME_DO_SITE", 'Alta Definição Comunicação Visual');

if (AMBIENTE == 'desenvolvimento') {
	define("URL_BASE", 'http://localhost/sistema/');
	$config['banco'] 		= 'sistema';
	$config['host'] 		= 'localhost';
	$config['usuario'] 		= 'root';
	$config['senha'] 		= '';
}else{
	define("URL_BASE", 'https://altadefinicaocaxias.com.br/');
	$config['banco'] 		= 'gcc';
	$config['host'] 		= 'localhost';
	$config['usuario'] 		= 'root';
	$config['senha'] 		= 'root';
}

global $conexao;

try {
	$conexao = new PDO("mysql:dbname=".$config['banco']."; host=".$config['host']."; charset=utf8", $config['usuario'], $config['senha']);
} catch (PDOException $e) {
	echo "Falha na conexão: ".$e->getMessage();
}

//chave de site: 6LePCrAZAAAAAEnjkfbXuh04fM6HpsC0GyfRYbW6
//chave secreta: 6LePCrAZAAAAAMwQjx-rODIABhdcQdCTf2fjcjk1