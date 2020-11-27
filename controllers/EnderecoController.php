<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Produtos;
use \Models\TipoCliente;
use \Models\Pedidos;

class EnderecoController extends Login{
	public function index(){
        if(empty($_SESSION['logado']) || !isset($_SESSION['logado'])){
            header("Location: ".URL_BASE."login");
            exit();
        }

        $id = $_SESSION['logado'];

        $usuario = new Usuario();
        $informacoesUsuario = $usuario->informacoesUsuario($id);

        $this->nomeUsuario = $informacoesUsuario['nomeUsuario']." ".$informacoesUsuario['sobrenomeUsuario'];
        $this->tipoUsuario = $informacoesUsuario['nomeTipoUsuario'];
        $this->foto = $informacoesUsuario['fotoUsuario'];

        switch($_SESSION['idTipoUsuario']){
            case 1:
                $dados = array();
                $this->titulo = "Endereço";
                $dados['informacoesUsuario'] = $informacoesUsuario;
                $this->loadTemplate('administracao/endereco', $dados);
            break;
            case 2:
                $dados = array();
                $this->titulo = "Endereço";
                $this->loadTemplate('producao/endereco', $dados);
            break;
            case 3:
                $dados = array();
                $this->titulo = "Endereço";
                $this->loadTemplate('cliente/endereco', $dados);
            break;
            case 4:
                $dados = array();
                $this->titulo = "Endereço";
                $this->loadTemplate('artefinal/endereco', $dados);
            break;
            default:
                header("Location: ".URL_BASE."login");
                exit();
            break;
        }
    }
    public function alteraUsuario(){
		if(!empty($_POST) && isset($_POST)){
			$nome 				= trim(addslashes($_POST['nome']));
			$sobrenome 			= trim(addslashes($_POST['sobrenome']));
			$email 				= trim(addslashes($_POST['email']));
            $id                 = $_SESSION['logado'];
                    
            $usuario = new Usuario();
            $alteraUsuario = $usuario->alteraUsuario($nome, $sobrenome, $email, $id);
            
            if($alteraUsuario){
                echo 1;
            }else{
                echo 0;
            }
			
		}
    }
    public function alteraSenha(){
		if(!empty($_POST) && isset($_POST)){
			$senha 				= md5(trim(addslashes($_POST['senha'])));
            $id                 = $_SESSION['logado'];
                    
            $usuario = new Usuario();
            $alteraSenha = $usuario->alteraSenha($senha, $id);
            
            if($alteraSenha){
                echo 1;
            }else{
                echo 0;
            }
		}
    }
}