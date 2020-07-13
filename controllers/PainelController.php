<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;

class PainelController extends Login{
	public function index(){
        if(empty($_SESSION['logado']) || !isset($_SESSION['logado'])){
            header("Location: ".URL_BASE."login");
            exit();
        }

        $id = $_SESSION['logado'];

        $usuario = new Usuario();
        $informacoesUsuario = $usuario->informacoesUsuario($id);

        $this->nomeUsuario = $informacoesUsuario['nomeUsuario']." ".$informacoesUsuario['sobrenomeUsuario'];
        $this->foto = $informacoesUsuario['fotoUsuario'];

        switch($_SESSION['tipoUsuario']){
            case 0:
                $this->titulo = "Painel de Controle";
                $this->loadTemplate('cliente/painel', $dados=array());
            break;
            case 1:
                $this->titulo = "Painel de Controle";
                $this->loadTemplate('administracao/painel', $dados=array());
            break;
            default:
                header("Location: ".URL_BASE."login");
                exit();
            break;
        }
	}
}