<?php
namespace Models;
use \Core\Model;

class Colaboradores extends Model{
	public function listaColaboradores(){
		$array = array();
		$sql = $this->conexao->prepare("SELECT * FROM colaboradores");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

		return $array;
	}
	public function quantidadeColaboradores(){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(*) AS quantidade FROM colaboradores");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['quantidade'];
	}
}