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
}