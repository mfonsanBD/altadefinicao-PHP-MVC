<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Pedidos;

class PainelController extends Login{
	public function index(){
        if(empty($_SESSION['logado']) || !isset($_SESSION['logado'])){
            header("Location: ".URL_BASE."login");
            exit();
        }

        $id = $_SESSION['logado'];

        $usuario = new Usuario();
        $informacoesUsuario = $usuario->informacoesUsuario($id);

        $pedido = new Pedidos();

        $this->nomeUsuario = $informacoesUsuario['nomeUsuario']." ".$informacoesUsuario['sobrenomeUsuario'];
        $this->foto = $informacoesUsuario['fotoUsuario'];

        switch($_SESSION['tipoUsuario']){
            case 0:
                $this->titulo = "Painel de Controle";
                $this->loadTemplate('cliente/painel', $dados=array());
            break;
            case 1:
                $quantidadeUsuarios = $usuario->quantidadeUsuarios();
                $dados['quantidadeUsuarios'] = $quantidadeUsuarios;

                $dataHoje = date("Y-m-d");
                $quantidadePedidos = $pedido->quantidadePedidos($dataHoje);
                $dados['quantidadePedidos'] = $quantidadePedidos;

                $this->titulo = "Painel de Controle";
                $this->loadTemplate('administracao/painel', $dados);
            break;
            case 2:
                $this->titulo = "Painel de Controle";
                $this->loadTemplate('producao/painel', $dados=array());
            break;
            case 3:
                $this->titulo = "Painel de Controle";
                $this->loadTemplate('artefinal/painel', $dados=array());
            break;
            default:
                header("Location: ".URL_BASE."login");
                exit();
            break;
        }
	}
}