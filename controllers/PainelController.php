<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Produtos;
use \Models\TipoCliente;
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

                $dataHoje   = date("Y-m-d");
                $Mes        = date("Y-m");

                $quantidadePedidos = $pedido->quantidadePedidos();
                $dados['quantidadePedidos'] = $quantidadePedidos;

                $listaPedidos               = $pedido->listaPedidos();
        
                $produto                    = new Produtos();
                $listaProduto               = $produto->listaProduto();

                $lucroDoDia                 = $pedido->lucroDoDia($dataHoje);
                $lucroDoMes                 = $pedido->lucroDoMes($Mes);
                $dados['lucroDoDia']        = $lucroDoDia;
                $dados['lucroDoMes']        = $lucroDoMes;
                
        
                $tiporCliente               = new TipoCliente();
                $listaTipoCliente           = $tiporCliente->listaTipoCliente();
        
                $listaUsuarios              = $usuario->listaUsuarios();
        
                $dados['listaPedidos']      = $listaPedidos;
                $dados['listaProduto']      = $listaProduto;
                $dados['listaTipoCliente']  = $listaTipoCliente;
                $dados['listaUsuarios']     = $listaUsuarios;

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