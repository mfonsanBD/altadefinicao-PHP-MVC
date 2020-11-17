<?php
namespace Models;
use \Core\Model;

class Gramatura extends Model{
    public function listaGramatura(){
        $array = array();
        $sql = $this->conexao->prepare("SELECT * FROM gramatura");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }
}