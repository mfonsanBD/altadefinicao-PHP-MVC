<?php
namespace Models;
use \Core\Model;

class Produtos extends Model{
    public function listaProduto(){
        $array = array();
        $sql = $this->conexao->prepare("
        SELECT pro.*, tip.*, aca.*, cat.* FROM produto AS pro
        INNER JOIN tipoproduto AS tip ON (pro.idTipoProduto = tip.idTipoProduto)
        INNER JOIN acabamento AS aca ON (pro.idAcabamento = aca.idAcabamento)
        INNER JOIN categoria AS cat ON (pro.idCategoria = cat.idCategoria)
        ORDER BY idProduto DESC
        ");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }
    public function quantidadeDeProduto(){
        $array = array();
        $sql = $this->conexao->prepare("SELECT COUNT(*) AS quantidade FROM produto");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }

        return $array['quantidade'];
    }
    public function adicionarProduto($nomeProduto, $nomeDaFotoDoProduto, $valorProduto, $categoriaProduto, $tipoProduto, $acabamentoProduto){
        $sql = $this->conexao->prepare("INSERT INTO produto SET nomeProduto = ?, fotoProduto = ?, valorProduto = ?, idCategoria = ?, idTipoProduto = ?, idAcabamento = ?");
        $sql->execute(array($nomeProduto, $nomeDaFotoDoProduto, $valorProduto, $categoriaProduto, $tipoProduto, $acabamentoProduto));

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function excluiProduto($id){
        $sql = $this->conexao->prepare("DELETE FROM produto WHERE idProduto = ?");
        $sql->execute(array($id));

        if($sql->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    public function alteraProduto($nomeProduto, $valorProduto, $categoriaProduto, $tipoProduto, $acabamentoProduto, $idProduto){
        $sql = $this->conexao->prepare("UPDATE produto SET nomeProduto = ?, valorProduto = ?, idCategoria = ?, idTipoProduto = ?, idAcabamento = ? WHERE idProduto = ?");
        $sql->execute(array($nomeProduto, $valorProduto, $categoriaProduto, $tipoProduto, $acabamentoProduto, $idProduto));

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}