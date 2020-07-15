<?php
namespace Models;
use \Core\Model;

class TipoProduto extends Model{
    public function listaTipoProduto(){
        $array = array();
        $sql = $this->conexao->prepare("SELECT * FROM tipoproduto");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }
}