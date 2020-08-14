<?php
namespace Models;
use \Core\Model;

class Postagem extends Model{
	public function listaPostagem(){
		$array = array();
		$sql = $this->conexao->prepare("
			SELECT p.*, u.* FROM postagem AS p
			INNER JOIN usuario AS u ON (p.idUsuario = u.idUsuario)
		");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

		return $array;
	}
	public function listaPostagemHome(){
		$array = array();
		$sql = $this->conexao->prepare("
			SELECT p.*, u.* FROM postagem AS p
			INNER JOIN usuario AS u ON (p.idUsuario = u.idUsuario)
			LIMIT 3
		");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

		return $array;
	}
	public function quantidadePostagem(){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(*) AS quantidade FROM postagem");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['quantidade'];
	}
	public function cadastraPostagem($titulo, $texto, $nomeDaFotoDaNoticia, $postadoPor, $slug){
		$sql = $this->conexao->prepare("INSERT INTO postagem SET tituloPostagem = ?, textoPostagem = ?, imagemPostagem = ?,statusPostagem = 1, dataPostagem = NOW(), idUsuario = ?, slugPostagem = ?");
		$sql->execute(array($titulo, $texto, $nomeDaFotoDaNoticia, $postadoPor, $slug));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function excluiNoticia($id){
		$sql = $this->conexao->prepare("DELETE FROM postagem WHERE idPostagem = ?");
		$sql->execute(array($id));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
}