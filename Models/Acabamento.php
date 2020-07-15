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
}