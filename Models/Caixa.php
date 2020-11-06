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
    public function fluxoCaixa($hoje){
        $array = array();
        $sql = $this->conexao->prepare("SELECT COUNT(*) AS qtd FROM caixa WHERE dataCaixa LIKE '".$hoje."%'");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }
        return $array['qtd'];
    }
    public function entradasHoje($hoje){
        $array = array();
        $sql = $this->conexao->prepare("SELECT SUM(valorCaixa) AS totalEntradas FROM caixa WHERE operacaoCaixa = 1 AND dataCaixa LIKE '".$hoje."%' GROUP BY operacaoCaixa");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }else{
            $array['totalEntradas'] = 0;
        }

        return $array['totalEntradas'];
    }
    public function saidasHoje($hoje){
        $array = array();
        $sql = $this->conexao->prepare("SELECT SUM(valorCaixa) AS totalSaidas FROM caixa WHERE operacaoCaixa = 0 AND dataCaixa LIKE '".$hoje."%' GROUP BY operacaoCaixa");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }else{
            $array['totalSaidas'] = 0;
        }

        return $array['totalSaidas'];
    }
    public function cadastraSaida($ultimoId, $valor, $descricao){
        $sql = $this->conexao->prepare("INSERT INTO caixa SET idBaixa = ?, dataCaixa = NOW(), valorCaixa = ?, operacaoCaixa = 0, descricaoOperacaoCaixa = ?");
        $sql->execute(array($ultimoId, $valor, $descricao));

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function cadastraEntradaCaixa($idPedido, $ultimoId, $hoje, $valor, $cliente){
        $sql = $this->conexao->prepare("INSERT INTO caixa SET idPedido = ?, idBaixa = ?, dataCaixa = ?, valorCaixa = ?, operacaoCaixa = 1, descricaoOperacaoCaixa = ?");
        $sql->execute(array($idPedido, $ultimoId, $hoje, $valor, $cliente));

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}