<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Colaboradores;

class ColaboradoresController extends Login{
	public function index(){
        if(empty($_SESSION['logado']) || !isset($_SESSION['logado']) || $_SESSION['tipoUsuario'] != 1){
            header("Location: ".URL_BASE."login");
            exit();
        }

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
            
            $usuario = new Colaboradores();
            if($usuario->cadastraColaborador()){
                echo 1;
            }else{
                echo 0;
            }
			
		}
    }
    public function excluiColaborador(){
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
}