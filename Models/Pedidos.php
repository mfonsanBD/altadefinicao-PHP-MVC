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
    public function infoPedidos($slug){
        $array = array();

        $sql = $this->conexao->prepare("SELECT * FROM pedido WHERE slugPedido = ?");
        $sql->execute(array($slug));

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }

        return $array;
    }
}