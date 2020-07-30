<?php
namespace Models;
use \Core\Model;

class Produtos extends Model{
    public function listaProduto(){
        $array = array();
        $sql = $this->conexao->prepare("SELECT pro.*, cat.* FROM produto AS pro
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
    public function adicionarProduto($nomeProduto, $nomeDaFotoDoProduto, $categoriaProduto){
        $sql = $this->conexao->prepare("INSERT INTO produto SET nomeProduto = ?, fotoProduto = ?, idCategoria = ?");
        $sql->execute(array($nomeProduto, $nomeDaFotoDoProduto, $categoriaProduto));

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
    public function alteraProduto($nomeProduto, $categoriaProduto, $idProduto){
        $sql = $this->conexao->prepare("UPDATE produto SET nomeProduto = ?, idCategoria = ? WHERE idProduto = ?");
        $sql->execute(array($nomeProduto, $categoriaProduto, $idProduto));

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function alteraFotoProduto($nomeDaFotoDoProduto, $idProduto){
        $sql = $this->conexao->prepare("UPDATE produto SET fotoProduto = ? WHERE idProduto = ?");
        $sql->execute(array($nomeDaFotoDoProduto, $idProduto));

        if($sql->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}