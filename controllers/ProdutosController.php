<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Categoria;
use \Models\TipoProduto;
use \Models\Acabamento;

class ProdutosController extends Login{
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
                $this->titulo = "Produtos";
                $this->loadTemplate('cliente/produtos', $dados);
            break;
            case 1:
                $this->titulo = "Produtos";

                $categoria         = new Categoria();
                $listaCategoria   = $categoria->listaCategoria();

                $tipoproduto        = new TipoProduto();
                $listaTipoProduto   = $tipoproduto->listaTipoProduto();

                $acamabento         = new Acabamento();
                $listaAcabamento   = $acamabento->listaAcabamento();
                
                $dados['listaCategoria']   = $listaCategoria;
                $dados['listaTipoProduto']  = $listaTipoProduto;
                $dados['listaAcabamento']   = $listaAcabamento;
                $this->loadTemplate('administracao/produtos', $dados);
            break;
            default:
                header("Location: ".URL_BASE."login");
                exit();
            break;
        }
	}
}