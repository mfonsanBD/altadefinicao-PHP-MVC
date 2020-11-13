<?php
namespace Models;
use \Core\Model;

class FormaPagamento extends Model{
    public function listaFormaPagamento(){
        $array = array();
        $sql = $this->conexao->prepare("SELECT * FROM forma_pagamento");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }
    public function getNomeFormaPagamento($idPagamento){
        $nome;
        $sql = $this->conexao->prepare("SELECT nomeFormaPagamento FROM forma_pagamento WHERE idFormaPagamento = ?");
        $sql->execute(array($idPagamento));
        
        if($sql->rowCount() > 0){
            $nome = $sql->fetch();
        }

        return $nome;
    }
}