<?php
namespace Models;
use \Core\Model;

class Baixa extends Model{
    public function addBaixa($data){
        $sql = $this->conexao->prepare("INSERT INTO baixa SET situacaoBaixa = 0, dataBaixa = ?");
        $sql->execute(array($data));
    }
    public function ultimoId($hoje){
        $array = array();
        
        $sql = $this->conexao->prepare("SELECT idBaixa AS id FROM baixa WHERE dataBaixa = ?");
        $sql->execute(array($hoje));

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }

        return $array['id'];
    }
    public function deuBaixa($usuario, $data){
        $sql = $this->conexao->prepare("UPDATE baixa SET idUsuario = ?, situacaoBaixa = 1 WHERE dataBaixa = ?");
        $sql->execute(array($usuario, $data));

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function listaBaixa($data){
        $array = array();

        $sql = $this->conexao->prepare("SELECT * FROM baixa WHERE dataBaixa = ?");
        $sql->execute(array($data));

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }
}