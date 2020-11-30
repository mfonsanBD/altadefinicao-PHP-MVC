<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Notificacoes;

class NotificacoesController extends Login{
	public function index(){
        $dados = array();
        if(empty($_SESSION['logado']) || !isset($_SESSION['logado'])){
            header("Location: ".URL_BASE."login");
            exit();
        }

        $id = $_SESSION['logado'];

        $usuario = new Usuario();
        $informacoesUsuario = $usuario->informacoesUsuario($id);

        $this->nomeUsuario = $informacoesUsuario['nomeUsuario']." ".$informacoesUsuario['sobrenomeUsuario'];
        $this->foto = $informacoesUsuario['fotoUsuario'];

        $notificacoes = new Notificacoes();
        $quantidade = $notificacoes->quantidadeNotificacoes();
        $this->qtdNotify = $quantidade;

        $this->titulo = "Notificações";
        $this->loadTemplate('administracao/notificacoes', $dados);
    }
    public function quantidadeNotificacoes(){
        $notificacoes = new Notificacoes();
        $quantidade = $notificacoes->quantidadeNotificacoes();
        echo json_encode($quantidade);
    }
}