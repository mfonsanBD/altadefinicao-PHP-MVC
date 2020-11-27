<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Cliente;
use \Models\Produtos;
use \Models\TipoCliente;
use \Models\Pedidos;

class PerfilController extends Login{
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
                $this->titulo = "Perfil";
                $dados['informacoesUsuario'] = $informacoesUsuario;
                $this->loadTemplate('administracao/perfil', $dados);
            break;
            case 2:
                $dados = array();
                $this->titulo = "Perfil";
                $this->loadTemplate('producao/perfil', $dados);
            break;
            case 3:
                $dados = array();
                $this->titulo = "Perfil";
                $this->loadTemplate('cliente/perfil', $dados);
            break;
            case 4:
                $dados = array();
                $this->titulo = "Perfil";
                $this->loadTemplate('artefinal/perfil', $dados);
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
    public function alteraFotoUsuario(){
		if(!empty($_POST) && isset($_POST)){
            $img        = trim(addslashes($_POST['img']));
            $id         = $_SESSION['logado'];
            $nomeDaFotoDoProduto;

            $fotoVazia = 'iVBORw0KGgoAAAANSUhEUgAAAXQAAAD6CAYAAACxrrxPAAABf0lEQVR4nO3BAQ0AAADCoPdPbQ8HFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADwarmUAAcsYOEEAAAAASUVORK5CYII=';

            $primeiroArrayFoto = explode(";", $img);
            $segundoArrayFoto = explode(",", $primeiroArrayFoto[1]);

            if($segundoArrayFoto[1] != $fotoVazia){
                $permitidos = array('data:image/jpeg', 'data:image/png', 'data:image/jpg');
    
                if(in_array($primeiroArrayFoto[0], $permitidos)){
                    $informacoesDaFoto = base64_decode($segundoArrayFoto[1]);
                    $nomeDaFotoDoProduto = md5($id).'.jpg';
    
                    $caminho = 'media/usuarios/'.$id.'/';
    
                    if(is_dir($caminho)){
                        file_put_contents($caminho.$nomeDaFotoDoProduto, $informacoesDaFoto);
                    }
                    else{
                        mkdir($caminho);
                        file_put_contents($caminho.$nomeDaFotoDoProduto, $informacoesDaFoto);
                    }
                }else{
                    echo 2;
                }
            }else{
                $nomeDaFotoDoProduto = 'principal.png';
            }

            $usuario = new Usuario();
            $alteraFoto = $usuario->alteraFoto($nomeDaFotoDoProduto, $id);
            echo 1;
		}
    }
    public function alteraContato(){
		if(!empty($_POST) && isset($_POST)){
			$fixo 				= trim(addslashes($_POST['fixo']));
			$celular 			= trim(addslashes($_POST['celular']));
			$whatsapp 		    = trim(addslashes($_POST['whatsapp']));
            $id                 = $_SESSION['logado'];
                    
            $cliente = new Cliente();
            $alteraContato = $cliente->alteraContato($fixo, $celular, $whatsapp, $id);
            
            if($alteraContato){
                echo 1;
            }else{
                echo 0;
            }
			
		}
    }
}