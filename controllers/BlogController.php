<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Postagem;
use \Models\Notificacoes;

class BlogController extends Login{
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
        
        $this->titulo = "Blog";

        $notificacoes = new Notificacoes();
        $quantidade = $notificacoes->quantidadeNotificacoes();
        $this->qtdNotify = $quantidade;

        $postagem = new Postagem();

        $listaPostagem                 = $postagem->listaPostagem();
        $quantidadePostagem            = $postagem->quantidadePostagem();
        
        $dados['listaPostagem']        = $listaPostagem;
        $dados['quantidadePostagem']   = $quantidadePostagem;

        $this->loadTemplate('administracao/blog', $dados);
    }
    public function cadastraPostagem(){
		if(!empty($_POST) && isset($_POST)){
            $titulo     = trim(addslashes($_POST['titulo']));
            $texto      = trim(addslashes($_POST['texto']));
            $imagem     = trim(addslashes($_POST['imagem']));
            $postadoPor = $_SESSION['logado'];
            $slug       = trim(addslashes($_POST['slug']));
            
            $primeiroArrayFoto = explode(";", $imagem);
            $segundoArrayFoto = explode(",", $primeiroArrayFoto[1]);

            $permitidos = array('data:image/jpeg', 'data:image/png', 'data:image/jpg');

            if(in_array($primeiroArrayFoto[0], $permitidos)){
                $informacoesDaFoto = base64_decode($segundoArrayFoto[1]);
                $nomeDaFotoDaNoticia = md5(date("d/m/Y - H:i:s").rand(0, 99999)).'.jpg';

                $caminho = 'media/noticias/';

                if(is_dir($caminho)){
                    file_put_contents($caminho.$nomeDaFotoDaNoticia, $informacoesDaFoto);
                }
                else{
                    mkdir($caminho);
                    file_put_contents($caminho.$nomeDaFotoDaNoticia, $informacoesDaFoto);
                }

                $postagem = new Postagem();
                
                if($postagem->cadastraPostagem($titulo, $texto, $nomeDaFotoDaNoticia, $postadoPor, $slug)){
                    echo 1;
                }else{
                    echo 0;
                }
            }else{
                echo 2;
            }
		}
    }
    public function alteraNoticia(){
		if(!empty($_POST) && isset($_POST)){
            $id         = $_POST['id'];
            $titulo     = trim(addslashes($_POST['titulo']));
            $texto      = trim(addslashes($_POST['texto']));
            $status     = trim(addslashes($_POST['status']));
            $slug       = trim(addslashes($_POST['slug']));
                
            $postagem = new Postagem();
                
            if($postagem->alteraNoticia($titulo, $texto, $status, $slug, $id)){
                echo 1;
            }else{
                echo 0;
            }
		}
    }
    public function excluiNoticia(){
        if(isset($_POST) && !empty($_POST)){
            $id     = addslashes($_POST['id']);
            $foto   = trim(addslashes($_POST['foto']));
            
            if($foto != 'principal.png'){
                $caminho = "media/noticias/";
                unlink($caminho."/".$foto);
            }

            $postagem = new Postagem();
            
            if($postagem->excluiNoticia($id)){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
    public function alteraFotoNoticia(){
        $id         = trim(addslashes($_POST['id']));
        $imagem     = trim(addslashes($_POST['imagem']));

        $primeiroArrayFoto = explode(";", $imagem);
        $segundoArrayFoto = explode(",", $primeiroArrayFoto[1]);

        $permitidos = array('data:image/jpeg', 'data:image/png', 'data:image/jpg');

        if(in_array($primeiroArrayFoto[0], $permitidos)){
            $informacoesDaFoto = base64_decode($segundoArrayFoto[1]);
            $nomeDaFotoDaNoticia = md5($id).'.jpg';

            $caminho = 'media/noticias/';

            if(is_dir($caminho)){
                file_put_contents($caminho.$nomeDaFotoDaNoticia, $informacoesDaFoto);
            }
            else{
                mkdir($caminho);
                file_put_contents($caminho.$nomeDaFotoDaNoticia, $informacoesDaFoto);
            }

            $postagem = new Postagem();
            
            if($postagem->alteraFotoNoticia($nomeDaFotoDaNoticia, $id)){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            echo 2;
        }
    }
}