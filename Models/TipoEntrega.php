<?php
namespace Models;
use \Core\Model;

class TipoEntrega extends Model{
    public function listaTipoEntrega(){
        $array = array();
        $sql = $this->conexao->prepare("SELECT * FROM tipoentrega WHERE ativoTipoEntrega = 1");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }
    public function getNomeTipoEntrega($idEntrega){
        $nome;
        $sql = $this->conexao->prepare("SELECT nomeTipoEntrega FROM tipoentrega WHERE idTipoEntrega = ?");
        $sql->execute(array($idEntrega));
        
        if($sql->rowCount() > 0){
            $nome = $sql->fetch();
        }

        return $nome;
    }
}