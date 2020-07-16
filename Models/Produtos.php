<?php
namespace Models;
use \Core\Model;

class Produtos extends Model{
    public function listaProduto(){
        $array = array();
        $sql = $this->conexao->prepare("SELECT * FROM produto");
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
}