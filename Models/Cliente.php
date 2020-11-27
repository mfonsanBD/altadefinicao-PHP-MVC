<?php
namespace Models;
use \Core\Model;

class Cliente extends Model{
    public function cadastraContato($id, $fixo, $celular, $whatsapp){
        $sql = $this->conexao->prepare("INSERT INTO cliente SET telefoneCliente = ?, celularCliente = ?, whatsappCliente = ? WHERE idUsuario = ?");
        $sql->execute(array($id, $fixo, $celular, $whatsapp));

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function alteraContato($fixo, $celular, $whatsapp, $id){
        $sql = $this->conexao->prepare("UPDATE cliente SET telefoneCliente = ?, celularCliente = ?, whatsappCliente = ? WHERE idUsuario = ?");
        $sql->execute(array($fixo, $celular, $whatsapp, $id));

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}