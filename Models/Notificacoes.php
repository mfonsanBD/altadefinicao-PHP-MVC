<?php
namespace Models;
use \Core\Model;

class Notificacoes extends Model{
	public function quantidadeNotificacoes(){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(*) AS quantidade FROM notificacao");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['quantidade'];
	}
}