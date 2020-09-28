<?php
namespace Models;
use \Core\Model;

class Pedidos extends Model{
    public function listaPedidos(){
        $array = array();
        $sql = $this->conexao->prepare("SELECT ped.*, us.* FROM pedido AS ped
        INNER JOIN usuario AS us ON (ped.idCliente = us.idUsuario)");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }
}