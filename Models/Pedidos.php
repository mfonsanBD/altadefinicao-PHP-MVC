<?php
namespace Models;
use \Core\Model;

class Pedidos extends Model{
    public function listaPedidos(){
        $array = array();
        $sql = $this->conexao->prepare("SELECT * FROM pedido");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }
    public function maisPedidos(){
        $array = array();
        $sql = $this->conexao->prepare("SELECT COUNT(pdd.idProduto) AS conta, pdt.nomeProduto AS nome
		FROM pedido AS pdd
		INNER JOIN produto AS pdt ON (pdd.idProduto = pdt.idProduto)
		GROUP BY pdd.idProduto 
		ORDER BY conta DESC");
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
    public function adicionaPedido($revendedor, $produtoPedido, $midia, $acabamento, $tipoCliente, $pagamento, $entrega, $final, $identificacao, $altura, $largura, $quantidade, $totalPedido, $observacao, $arquivoArte, $slug, $infoArte){
        $sql = $this->conexao->prepare("INSERT INTO pedido SET idCliente = ?, idProduto = ?, idMidia = ?, idAcabamento = ?, idTipoCliente = ?, idFormaPagamento = ?, idTipoEntrega = ?, nomeCliente = ?, nomeArte = ?, altura = ?, largura = ?, quantidadeProduto = ?, valorPedido = ?, dataPedido = NOW(), observacaoPedido = ?, arquivo = ?, slugPedido = ?, criarArte = ?");
        $sql->execute(array($revendedor, $produtoPedido, $midia, $acabamento, $tipoCliente, $pagamento, $entrega, $final, $identificacao, $altura, $largura, $quantidade, $totalPedido, $observacao, $arquivoArte, $slug, $infoArte));

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function lucroJaneiro($janeiro){
		$array = array();
		$sql = $this->conexao->prepare("SELECT SUM(valorPedido) AS lucroJaneiro FROM pedido WHERE dataPedido LIKE '".$janeiro."%' AND statusPedido = 4");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['lucroJaneiro'];
    }
    public function lucroFevereiro($fevereiro){
		$array = array();
		$sql = $this->conexao->prepare("SELECT SUM(valorPedido) AS lucroFevereiro FROM pedido WHERE dataPedido LIKE '".$fevereiro."%' AND statusPedido = 4");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['lucroFevereiro'];
    }
    public function lucroMarco($marco){
		$array = array();
		$sql = $this->conexao->prepare("SELECT SUM(valorPedido) AS lucroMarco FROM pedido WHERE dataPedido LIKE '".$marco."%' AND statusPedido = 4");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['lucroMarco'];
    }
    public function lucroAbril($abril){
		$array = array();
		$sql = $this->conexao->prepare("SELECT SUM(valorPedido) AS lucroAbril FROM pedido WHERE dataPedido LIKE '".$abril."%' AND statusPedido = 4");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['lucroAbril'];
    }
    public function lucroMaio($maio){
		$array = array();
		$sql = $this->conexao->prepare("SELECT SUM(valorPedido) AS lucroMaio FROM pedido WHERE dataPedido LIKE '".$maio."%' AND statusPedido = 4");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['lucroMaio'];
    }
    public function lucroJunho($junho){
		$array = array();
		$sql = $this->conexao->prepare("SELECT SUM(valorPedido) AS lucroJunho FROM pedido WHERE dataPedido LIKE '".$junho."%' AND statusPedido = 4");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['lucroJunho'];
    }
    public function lucroJulho($julho){
		$array = array();
		$sql = $this->conexao->prepare("SELECT SUM(valorPedido) AS lucroJulho FROM pedido WHERE dataPedido LIKE '".$julho."%' AND statusPedido = 4");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['lucroJulho'];
    }
    public function lucroAgosto($agosto){
		$array = array();
		$sql = $this->conexao->prepare("SELECT SUM(valorPedido) AS lucroAgosto FROM pedido WHERE dataPedido LIKE '".$agosto."%' AND statusPedido = 4");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['lucroAgosto'];
    }
    public function lucroSetembro($setembro){
		$array = array();
		$sql = $this->conexao->prepare("SELECT SUM(valorPedido) AS lucroSetembro FROM pedido WHERE dataPedido LIKE '".$setembro."%' AND statusPedido = 4");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['lucroSetembro'];
    }
    public function lucroOutubro($outubro){
		$array = array();
		$sql = $this->conexao->prepare("SELECT SUM(valorPedido) AS lucroOutubro FROM pedido WHERE dataPedido LIKE '".$outubro."%' AND statusPedido = 4");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['lucroOutubro'];
    }
    public function lucroNovembro($novembro){
		$array = array();
		$sql = $this->conexao->prepare("SELECT SUM(valorPedido) AS lucroNovembro FROM pedido WHERE dataPedido LIKE '".$novembro."%' AND statusPedido = 4");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['lucroNovembro'];
    }
    public function lucroDezembro($dezembro){
		$array = array();
		$sql = $this->conexao->prepare("SELECT SUM(valorPedido) AS lucroDezembro FROM pedido WHERE dataPedido LIKE '".$dezembro."%' AND statusPedido = 4");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['lucroDezembro'];
    }

    public function pedidosJaneiro($janeiro){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(idPedido) AS pedidosJaneiro FROM pedido WHERE dataPedido LIKE '".$janeiro."%'");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['pedidosJaneiro'];
    }
    public function pedidosFevereiro($fevereiro){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(idPedido) AS pedidosFevereiro FROM pedido WHERE dataPedido LIKE '".$fevereiro."%'");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['pedidosFevereiro'];
    }
    public function pedidosMarco($marco){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(idPedido) AS pedidosMarco FROM pedido WHERE dataPedido LIKE '".$marco."%'");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['pedidosMarco'];
    }
    public function pedidosAbril($abril){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(idPedido) AS pedidosAbril FROM pedido WHERE dataPedido LIKE '".$abril."%'");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['pedidosAbril'];
    }
    public function pedidosMaio($maio){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(idPedido) AS pedidosMaio FROM pedido WHERE dataPedido LIKE '".$maio."%'");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['pedidosMaio'];
    }
    public function pedidosJunho($junho){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(idPedido) AS pedidosJunho FROM pedido WHERE dataPedido LIKE '".$junho."%'");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['pedidosJunho'];
    }
    public function pedidosJulho($julho){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(idPedido) AS pedidosJulho FROM pedido WHERE dataPedido LIKE '".$julho."%'");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['pedidosJulho'];
    }
    public function pedidosAgosto($agosto){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(idPedido) AS pedidosAgosto FROM pedido WHERE dataPedido LIKE '".$agosto."%'");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['pedidosAgosto'];
    }
    public function pedidosSetembro($setembro){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(idPedido) AS pedidosSetembro FROM pedido WHERE dataPedido LIKE '".$setembro."%'");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['pedidosSetembro'];
    }
    public function pedidosOutubro($outubro){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(idPedido) AS pedidosOutubro FROM pedido WHERE dataPedido LIKE '".$outubro."%'");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['pedidosOutubro'];
    }
    public function pedidosNovembro($novembro){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(idPedido) AS pedidosNovembro FROM pedido WHERE dataPedido LIKE '".$novembro."%'");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['pedidosNovembro'];
    }
    public function pedidosDezembro($dezembro){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(idPedido) AS pedidosDezembro FROM pedido WHERE dataPedido LIKE '".$dezembro."%'");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['pedidosDezembro'];
    }
}