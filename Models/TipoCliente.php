<?php
namespace Models;
use \Core\Model;

class TipoCliente extends Model{
    public function listaTipoCliente(){
        $array = array();
        
        $sql = $this->conexao->prepare("SELECT * FROM tipocliente");
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }
    public function getNomeTipoCliente($idTipoCliente){
        $nome;
        $sql = $this->conexao->prepare("SELECT nomeTipoCliente FROM tipocliente WHERE idTipoCliente = ?");
        $sql->execute(array($idTipoCliente));
        
        if($sql->rowCount() > 0){
            $nome = $sql->fetch();
        }

        return $nome;
    }
}