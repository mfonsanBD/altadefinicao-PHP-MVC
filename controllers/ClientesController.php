<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;

class ClientesController extends Login{
	public function index(){
        if(empty($_SESSION['logado']) || !isset($_SESSION['logado']) || $_SESSION['idTipoUsuario'] != 1){
            header("Location: ".URL_BASE."login");
            exit();
        }

        $id = $_SESSION['logado'];

        $usuario = new Usuario();
        $informacoesUsuario = $usuario->informacoesUsuario($id);

        $this->nomeUsuario = $informacoesUsuario['nomeUsuario']." ".$informacoesUsuario['sobrenomeUsuario'];
        $this->foto = $informacoesUsuario['fotoUsuario'];
        
        $this->titulo = "Clientes";

        $listaUsuarios = $usuario->listaUsuarios();
        $quantidadeUsuarios = $usuario->quantidadeUsuarios();
        
        $dados['listaUsuarios'] = $listaUsuarios;
        $dados['quantidadeUsuarios'] = $quantidadeUsuarios;

        $this->loadTemplate('administracao/clientes', $dados);
    }
	public function verificaEmail(){
		if(!empty($_POST) && isset($_POST)){
			$email = trim(addslashes($_POST['email']));
			$usuario = new Usuario();

			if($usuario->verificaEmail($email)){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
	public function cadastraCliente(){
		if(!empty($_POST) && isset($_POST)){
			$nome 				= trim(addslashes($_POST['nome']));
			$sobrenome 			= trim(addslashes($_POST['sobrenome']));
			$email 				= trim(addslashes($_POST['email']));
			$senha 				= md5(trim(addslashes($_POST['senha'])));
            
            $usuario = new Usuario();
            if($usuario->cadastraCliente($nome, $sobrenome, $email, $senha)){
                echo 1;
            }else{
                echo 0;
            }
			
		}
    }
    public function excluiCliente(){
        if(isset($_POST) && !empty($_POST)){
            $id     = addslashes($_POST['id']);
            $foto   = trim(addslashes($_POST['foto']));
            
            if($foto != 'usuario.jpg'){
                $caminho = "assets/img/usuarios/".$id;
                $foto = md5($id).".jpg";

                unlink($caminho."/".$foto);
                rmdir($caminho);
            }

            $usuario = new Usuario();
            
            if($usuario->excluiCliente($id)){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
    public function aprovar(){
        if(isset($_POST) && !empty($_POST)){
            $id = addslashes($_POST['id']);

            $usuario = new Usuario();

            if($usuario->aprovar($id)){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
    public function desativaCliente(){
        if(isset($_POST) && !empty($_POST)){
            $id = addslashes($_POST['id']);

            $usuario = new Usuario();

            if($usuario->desativa($id)){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
}