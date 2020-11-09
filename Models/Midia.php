<?php
namespace Models;
use \Core\Model;

class Midia extends Model{
    public function listaMidia(){
        $array = array();
        $sql = $this->conexao->prepare("SELECT * FROM midia");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }
	public function getNomeMidia($idMidia){
        $nome;
        $sql = $this->conexao->prepare("SELECT nomeMidia FROM midia WHERE idMidia = ?");
        $sql->execute(array($idMidia));
        
        if($sql->rowCount() > 0){
            $nome = $sql->fetch();
        }

        return $nome;
	}
}