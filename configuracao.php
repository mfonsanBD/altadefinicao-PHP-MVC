<?php
require 'ambiente.php';

define("NOME_DO_SITE", 'Alta Definição Comunicação Visual');

if (AMBIENTE == 'desenvolvimento') {
	define("URL_BASE", 'http://localhost/sistema/');
}else{
	define("URL_BASE", 'https://altadefinicaocaxias.com.br/');
}