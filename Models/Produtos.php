<?php
namespace Models;
use \Core\Model;

class Produtos extends Model{
    public $idUltimoProduto;

    public function listaProduto(){
        $array = array();
        $sql = $this->conexao->prepare("SELECT pro.*, cat.* FROM produto AS pro
        INNER JOIN categoria AS cat ON (pro.idCategoria = cat.idCategoria)
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
    public function adicionarProduto($categoriaProduto, $midiasMarcadas, $acabamentosMarcados, $gramaturasMarcadas, $nomeProduto, $nomeDaFotoDoProduto, $slug){
        $sql = $this->conexao->prepare("INSERT INTO produto SET idCategoria = ?, idsMidias = ?, idsAcabamentos = ?, idsGramaturas = ?, nomeProduto = ?, fotoProduto = ?, slugProduto = ?");
        $sql->execute(array($categoriaProduto, $midiasMarcadas, $acabamentosMarcados, $gramaturasMarcadas, $nomeProduto, $nomeDaFotoDoProduto, $slug));
        
        if($sql->rowCount() > 0){
            return $this->conexao->lastInsertId();
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
    public function alteraProduto($nomeProduto, $categoriaProduto, $slug, $idProduto){
        $sql = $this->conexao->prepare("UPDATE produto SET nomeProduto = ?, idCategoria = ?, slugProduto = ? WHERE idProduto = ?");
        $sql->execute(array($nomeProduto, $categoriaProduto, $slug, $idProduto));

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
    public function getNomeProduto($idProduto){
        $nome;
        $sql = $this->conexao->prepare("SELECT nomeProduto FROM produto WHERE idProduto = ?");
        $sql->execute(array($idProduto));
        
        if($sql->rowCount() > 0){
            $nome = $sql->fetch();
        }

        return $nome;
    }
}