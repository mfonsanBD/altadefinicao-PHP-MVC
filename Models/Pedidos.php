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

        $sql = $this->conexao->prepare("SELECT ped.*, us.*, tde.*, fdp.*, prod.*, midia.*, acab.* FROM pedido AS ped
        INNER JOIN usuario          AS us       ON (ped.idCliente = us.idUsuario)
        INNER JOIN tipoentrega      AS tde      ON (ped.idTipoEntrega = tde.idTipoEntrega)
        INNER JOIN forma_pagamento  AS fdp      ON (ped.idFormaPagamento = fdp.idFormaPagamento)
        INNER JOIN produto          AS prod     ON (ped.idProduto = prod.idProduto)
        INNER JOIN midia            AS midia    ON (ped.idMidia = midia.idMidia)
        INNER JOIN acabamento       AS acab     ON (ped.idAcabamento = acab.idAcabamento)
        WHERE slugPedido = ?");
        $sql->execute(array($slug));

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }

        return $array;
    }
    public function infoPedido($idPedido){
        $array = array();
        $sql = $this->conexao->prepare("SELECT pdd.*, user.* FROM pedido AS pdd
        INNER JOIN usuario AS user ON (pdd.idCliente = user.idUsuario)
        WHERE pdd.idPedido = ?");
        $sql->execute(array($idPedido));

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }

        return $array;
    }
    public function visualizou($slug){
        $sql = $this->conexao->prepare("UPDATE pedido SET visualizado = 1 WHERE slugPedido = ?");
        $sql->execute(array($slug));
    }
	public function quantidadePedidos(){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(*) AS quantidade FROM pedido WHERE statusPedido != 4");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['quantidade'];
    }
    public function alteraPedido($status, $problema, $idPedido){
        $sql = $this->conexao->prepare("UPDATE pedido SET statusPedido = ?, problemaPedido = ? WHERE idPedido = ?");
        $sql->execute(array($status, $problema, $idPedido));

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function alteraVisualizacaoPedido($visualizado, $idPedido){
        $sql = $this->conexao->prepare("UPDATE pedido SET visualizado = ? WHERE idPedido = ?");
        $sql->execute(array($visualizado, $idPedido));

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
	public function lucroDoDia($data){
		$array = array();
		$sql = $this->conexao->prepare("SELECT SUM(valorPedido) AS lucroDia FROM pedido WHERE dataPedido LIKE '".$data."%' AND statusPedido = 4");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['lucroDia'];
    }
	public function lucroDoMes($mes){
		$array = array();
		$sql = $this->conexao->prepare("SELECT SUM(valorPedido) AS lucroMes FROM pedido WHERE dataPedido LIKE '".$mes."%' AND statusPedido = 4");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['lucroMes'];
    }
}