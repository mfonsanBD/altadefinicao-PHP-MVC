<?php
namespace Models;
use \Core\Model;

class ValorProdutoTipoCliente extends Model{
    public function listaValorProdutoTipoCliente(){
        $array = array();

        $sql = $this->conexao->prepare("SELECT vptc.*, tc.* 
            FROM valor_produto_tipocliente AS vptc
            INNER JOIN tipocliente AS tc ON (vptc.idTipoCliente = tc.idTipoCliente)
        ");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }
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
    public function excluiValorProduto($id){
        $sql = $this->conexao->prepare("DELETE FROM valor_produto_tipocliente WHERE idProduto = ?");
        $sql->execute(array($id));

        if($sql->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    public function listaValoresDoProdutoRevenda($id){
        $sql = $this->conexao->prepare("SELECT * FROM valor_produto_tipocliente WHERE idProduto = ? AND idTipoCliente = 2");
        $sql->execute(array($id));

        if($sql->rowCount() > 0){
            return $sql->fetch();
        }
    }
    public function listaValoresDoProdutoFinal($id){
        $sql = $this->conexao->prepare("SELECT * FROM valor_produto_tipocliente WHERE idProduto = ? AND idTipoCliente = 1");
        $sql->execute(array($id));

        if($sql->rowCount() > 0){
            return $sql->fetch();
        }
    }
    public function mudaValorParaRevenda($valorRevenda, $idProduto){
        $sql = $this->conexao->prepare("UPDATE valor_produto_tipocliente SET valor = ? WHERE idProduto = ? AND idTipoCliente = 2");
        $sql->execute(array($valorRevenda, $idProduto));

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function mudaValorParaFinal($valorFinal, $idProduto){
        $sql = $this->conexao->prepare("UPDATE valor_produto_tipocliente SET valor = ? WHERE idProduto = ? AND idTipoCliente = 1");
        $sql->execute(array($valorFinal, $idProduto));

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}