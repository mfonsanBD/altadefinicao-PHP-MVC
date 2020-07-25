<?php
namespace Models;
use \Core\Model;

class Usuario extends Model{
    public function verificaEmail($email){
        $sql = $this->conexao->prepare("SELECT emailUsuario FROM usuario WHERE emailUsuario = ?");
		$sql->execute(array($email));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
    }
	public function verificaSenha($email, $senha){
		$sql = $this->conexao->prepare("SELECT senhaUsuario FROM usuario WHERE emailUsuario = ? AND senhaUsuario = ?");
		$sql->execute(array($email, $senha));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
    public function cadastro($nome, $sobrenome, $email, $senha, $hashConfirmacao){
        $sql = $this->conexao->prepare("INSERT INTO usuario SET nomeUsuario = ?, sobrenomeUsuario = ?, emailUsuario = ?, senhaUsuario = ?, hashUsuario = ?, permissaoUsuario = 0, fotoUsuario = 'usuario.jpg', tipoUsuario = 0");
        $sql->execute(array($nome, $sobrenome, $email, $senha, $hashConfirmacao));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function logar($email, $senha){
		$sql = $this->conexao->prepare("SELECT * FROM usuario WHERE emailUsuario = ? AND senhaUsuario = ?");
		$sql->execute(array($email, $senha));

		if($sql->rowCount() > 0){
			$dados = $sql->fetch();
			$_SESSION['logado'] 		= $dados['idUsuario'];
			$_SESSION['tipoUsuario'] 	= $dados['tipoUsuario'];
			return true;
		}else{
			return false;
		}
	}
	public function informacoesUsuario($id){
		$array = array();
		$sql = $this->conexao->prepare("SELECT * FROM usuario WHERE idUsuario = ?");
		$sql->execute(array($id));

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}

		return $array;
	}
	public function listaUsuarios(){
		$array = array();
		$sql = $this->conexao->prepare("SELECT * FROM usuario WHERE tipoUsuario = 0");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

		return $array;
	}
	public function quantidadeUsuarios(){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(*) AS quantidade FROM usuario WHERE tipoUsuario = 0");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		
		return $array['quantidade'];
	}
	public function cadastraCliente($nome, $sobrenome, $email, $senha){
        $sql = $this->conexao->prepare("INSERT INTO usuario SET nomeUsuario = ?, sobrenomeUsuario = ?, emailUsuario = ?, senhaUsuario = ?, permissaoUsuario = 1, fotoUsuario = 'usuario.jpg', tipoUsuario = 0");
        $sql->execute(array($nome, $sobrenome, $email, $senha));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function excluiCliente($id){
		$sql = $this->conexao->prepare("DELETE FROM usuario WHERE idUsuario = ?");
		$sql->execute(array($id));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function aprovar($id){
		$sql = $this->conexao->prepare("UPDATE usuario SET permissaoUsuario = 1 WHERE idUsuario = ?");
		$sql->execute(array($id));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function desativa($id){
		$sql = $this->conexao->prepare("UPDATE usuario SET permissaoUsuario = 2 WHERE idUsuario = ?");
		$sql->execute(array($id));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
}