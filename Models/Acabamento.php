<?php
namespace Models;
use \Core\Model;

class Acabamento extends Model{
    public function listaAcabamento(){
        $array = array();
        $sql = $this->conexao->prepare("SELECT * FROM acabamento");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }
	public function getNomeAcabamento($idAcabamento){
        $nome;
        $sql = $this->conexao->prepare("SELECT nomeAcabamento FROM acabamento WHERE idAcabamento = ?");
        $sql->execute(array($idAcabamento));
        
        if($sql->rowCount() > 0){
            $nome = $sql->fetch();
        }

        return $nome;
	}
}