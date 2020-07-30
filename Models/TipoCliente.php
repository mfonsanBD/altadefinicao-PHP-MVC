<?php
namespace Models;
use \Core\Model;

class TipoCliente extends Model{
    public function listaTipoCliente(){
        $array = array();
        
        $sql = $this->conexao->prepare("SELECT * FROM tipocliente");
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }
}