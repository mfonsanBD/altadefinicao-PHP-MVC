<?php
namespace Models;
use \Core\Model;

class Baixa extends Model{
    public function addBaixa($data){
        $sql = $this->conexao->prepare("INSERT INTO baixa SET situacaoBaixa = 0, dataBaixa = ?");
        $sql->execute(array($data));
    }
    public function ultimoId(){
        $sql = $this->conexao->prepare("SELECT idBaixa FROM baixa WHERE idBaixa = LAST_INSERT_ID()");
        $sql->execute();

        if($sql->rowCount() > 0){
            return $sql->fetch();
        }
    }
}