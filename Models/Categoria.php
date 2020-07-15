<?php
namespace Models;
use \Core\Model;

class Categoria extends Model{
    public function listaCategoria(){
        $array = array();
        $sql = $this->conexao->prepare("SELECT * FROM categoria");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }
}