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
	public function cadastraColaboradores($nomeColaborador, $funcaoColaborador, $nomeDaFotoDoProduto){
		$sql = $this->conexao->prepare("INSERT INTO colaboradores SET nomeColaborador = ?, cargoColaborador = ?, fotoColaborador = ?");
		$sql->execute(array($nomeColaborador, $funcaoColaborador, $nomeDaFotoDoProduto));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function excluiColaboradores($id){
		$sql = $this->conexao->prepare("DELETE FROM colaboradores WHERE idColaborador = ?");
		$sql->execute(array($id));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
}