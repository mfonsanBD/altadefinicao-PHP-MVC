<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Produtos;
use \Models\TipoCliente;
use \Models\ValorProdutoTipoCliente;
use \Models\Caixa;
use \Models\Pedidos;

class PedidosController extends Login{
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
        
        $this->titulo = "Pedidos";
        $dados = array();

        $pedidos                    = new Pedidos();
        $listaPedidos               = $pedidos->listaPedidos();

        $produto                    = new Produtos();
        $listaProduto               = $produto->listaProduto();

        $tiporCliente               = new TipoCliente();
        $listaTipoCliente           = $tiporCliente->listaTipoCliente();

        $listaUsuarios              = $usuario->listaUsuarios();

        $dados['listaPedidos']      = $listaPedidos;
        $dados['listaProduto']      = $listaProduto;
        $dados['listaTipoCliente']  = $listaTipoCliente;
        $dados['listaUsuarios']     = $listaUsuarios;

        $this->loadTemplate('administracao/pedidos', $dados);
  }
  public function pedido($slug){
    $id = $_SESSION['logado'];

    $usuario = new Usuario();
    $informacoesUsuario = $usuario->informacoesUsuario($id);

    $this->nomeUsuario = $informacoesUsuario['nomeUsuario']." ".$informacoesUsuario['sobrenomeUsuario'];
    $this->foto = $informacoesUsuario['fotoUsuario'];

    $dados = array();

    $pedido = new Pedidos();
    $infoPedido = $pedido->infoPedidos($slug);

    $this->titulo = "Pedido: ".str_pad($infoPedido['idPedido'], 6, 0, STR_PAD_LEFT);

    $dados['pedido'] = $infoPedido;
    $this->loadTemplate('administracao/pedido', $dados);
  }
}