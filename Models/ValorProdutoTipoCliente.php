<?php
namespace Models;
use \Core\Model;

class ValorProdutoTipoCliente extends Model{
    public function defineValorRevenda($idProduto, $precoRevenda){
        $sql = $this->conexao->prepare("INSERT INTO valor_produto_tipocliente SET idProduto = ?, idTipoCliente = 2, valor = ?");
        $sql->execute(array($idProduto, $precoRevenda));

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function defineValorFinal($idProduto, $precoFinal){
        $sql = $this->conexao->prepare("INSERT INTO valor_produto_tipocliente SET idProduto = ?, idTipoCliente = 1, valor = ?");
        $sql->execute(array($idProduto, $precoFinal));

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}