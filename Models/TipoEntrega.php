<?php
namespace Models;
use \Core\Model;

class TipoEntrega extends Model{
    public function listaTipoEntrega(){
        $array = array();
        $sql = $this->conexao->prepare("SELECT * FROM tipoentrega WHERE ativoTipoEntrega = 1");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }
}