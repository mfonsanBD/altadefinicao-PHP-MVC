<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Cliente;
use \Models\Produtos;
use \Models\TipoCliente;
use \Models\Pedidos;
use \Models\Notificacoes;

class PerfilController extends Login{
	public function index(){
        if(empty($_SESSION['logado']) || !isset($_SESSION['logado'])){
            header("Location: ".URL_BASE."login");
            exit();
        }

        $notificacoes = new Notificacoes();
        $quantidade = $notificacoes->quantidadeNotificacoes();
        $this->qtdNotify = $quantidade;

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

            $naoPermitido = '/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCACMAIwDAREAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD/AD/6ACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoA//9k=';

            $primeiroArrayFoto = explode(";", $img);
            $segundoArrayFoto = explode(",", $primeiroArrayFoto[1]);

            if($segundoArrayFoto[1] != $fotoVazia){    
                if($segundoArrayFoto[1] != $naoPermitido){
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