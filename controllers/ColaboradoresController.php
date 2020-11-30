<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Colaboradores;
use \Models\Notificacoes;

class ColaboradoresController extends Login{
	public function index(){
        if(empty($_SESSION['logado']) || !isset($_SESSION['logado']) || $_SESSION['idTipoUsuario'] != 1){
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
        $this->foto = $informacoesUsuario['fotoUsuario'];
        
        $this->titulo = "Colaboradores";

        $colaboradores = new Colaboradores();

        $listaColaboradores                 = $colaboradores->listaColaboradores();
        $quantidadeColaboradores            = $colaboradores->quantidadeColaboradores();
        
        $dados['listaColaboradores']        = $listaColaboradores;
        $dados['quantidadeColaboradores']   = $quantidadeColaboradores;

        $this->loadTemplate('administracao/colaboradores', $dados);
    }
	public function cadastraColaborador(){
		if(!empty($_POST) && isset($_POST)){
            $nomeColaborador    = trim(addslashes($_POST['nome']));
            $funcaoColaborador  = trim(addslashes($_POST['funcao']));
            $fotoColaborador    = trim(addslashes($_POST['imagem']));
            
            $primeiroArrayFoto = explode(";", $fotoColaborador);
            $segundoArrayFoto = explode(",", $primeiroArrayFoto[1]);

            $permitidos = array('data:image/jpeg', 'data:image/png', 'data:image/jpg');

            if(in_array($primeiroArrayFoto[0], $permitidos)){
                $informacoesDaFoto = base64_decode($segundoArrayFoto[1]);
                $nomeDaFotoDoProduto = md5(date("d/m/Y - H:i:s").rand(0, 99999)).'.jpg';

                $caminho = 'assets/img/equipe/';

                if(is_dir($caminho)){
                    file_put_contents($caminho.$nomeDaFotoDoProduto, $informacoesDaFoto);
                }
                else{
                    mkdir($caminho);
                    file_put_contents($caminho.$nomeDaFotoDoProduto, $informacoesDaFoto);
                }

                $colaboradores = new Colaboradores();
                
                if($colaboradores->cadastraColaboradores($nomeColaborador, $funcaoColaborador, $nomeDaFotoDoProduto)){
                    echo 1;
                }else{
                    echo 0;
                }
            }else{
                echo 2;
            }
		}
    }
    public function excluiColaborador(){
        if(isset($_POST) && !empty($_POST)){
            $id     = addslashes($_POST['id']);
            $foto   = trim(addslashes($_POST['foto']));
            
            if($foto != 'usuario.jpg'){
                $caminho = "assets/img/equipe/";
                unlink($caminho."/".$foto);
            }

            $colaboradores = new Colaboradores();
            
            if($colaboradores->excluiColaboradores($id)){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
}