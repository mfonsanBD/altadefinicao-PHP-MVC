<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Produtos;
use \Models\TipoCliente;
use \Models\ValorProdutoTipoCliente;
use \Models\Caixa;

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

        $produto                    = new Produtos();
        $listaProduto               = $produto->listaProduto();

        $tiporCliente               = new TipoCliente();
        $listaTipoCliente           = $tiporCliente->listaTipoCliente();

        $listaUsuarios              = $usuario->listaUsuarios();

        $dados['listaProduto']      = $listaProduto;
        $dados['listaTipoCliente']  = $listaTipoCliente;
        $dados['listaUsuarios']     = $listaUsuarios;

        $this->loadTemplate('administracao/pedidos', $dados);
  }
}