<?php 
namespace Controllers;
use \Core\Login;
use \Models\Baixa;

class BaixaController extends Login{
	public function index(){
        $data = date("Y-m-d");
        $baixa = new Baixa();
        $baixa->addBaixa($data);
    }
}