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
    public function visualizou($slug){
        $sql = $this->conexao->prepare("UPDATE pedido SET visualizado = 1 WHERE slugPedido = ?");
        $sql->execute(array($slug));
    }
	public function quantidadePedidos($data){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(*) AS quantidade FROM pedido WHERE dataPedido LIKE '".$data."%'");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['quantidade'];
	}
}