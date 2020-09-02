<?php
namespace Models;
use \Core\Model;

class Caixa extends Model{
    public function listaCaixaHoje($hoje){
        $array = array();
        $sql = $this->conexao->prepare("SELECT * FROM caixa WHERE dataCaixa LIKE '".$hoje."%'");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        return $array;
    }
    public function entradasHoje($hoje){
        $array = array();
        $sql = $this->conexao->prepare("SELECT SUM(valorCaixa) AS totalEntradas FROM caixa WHERE operacaoCaixa = 1 AND dataCaixa LIKE '".$hoje."%' GROUP BY operacaoCaixa");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }

        return $array['totalEntradas'];
    }
    public function saidasHoje($hoje){
        $array = array();
        $sql = $this->conexao->prepare("SELECT SUM(valorCaixa) AS totalSaidas FROM caixa WHERE operacaoCaixa = 0 AND dataCaixa LIKE '".$hoje."%' GROUP BY operacaoCaixa");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }

        return $array['totalSaidas'];
    }
}