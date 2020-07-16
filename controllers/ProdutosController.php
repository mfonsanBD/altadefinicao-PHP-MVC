<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Produtos;
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

                $produto                = new Produtos();
                $listaProduto           = $produto->listaProduto();
                $quantidadeDeProduto    = $produto->quantidadeDeProduto();

                $categoria          = new Categoria();
                $listaCategoria     = $categoria->listaCategoria();

                $tipoproduto        = new TipoProduto();
                $listaTipoProduto   = $tipoproduto->listaTipoProduto();

                $acamabento         = new Acabamento();
                $listaAcabamento    = $acamabento->listaAcabamento();
                
                $dados['listaProduto']             = $listaProduto;
                $dados['quantidadeDeProduto']      = $quantidadeDeProduto;
                $dados['listaCategoria']           = $listaCategoria;
                $dados['listaTipoProduto']         = $listaTipoProduto;
                $dados['listaAcabamento']          = $listaAcabamento;
                $this->loadTemplate('administracao/produtos', $dados);
            break;
            default:
                header("Location: ".URL_BASE."login");
                exit();
            break;
        }
    }
    public function cadastraProduto(){
        if(isset($_POST) && !empty($_POST)){
            $nomeProduto            = trim(addslashes($_POST['nomeProduto']));
            $categoriaProduto       = trim(addslashes($_POST['categoriaProduto']));
            $tipoProduto            = trim(addslashes($_POST['tipoProduto']));
            $acabamentoProduto      = trim(addslashes($_POST['acabamentoProduto']));
            $valorProduto           = trim(addslashes($_POST['valorProduto']));
            $fotoProduto            = trim(addslashes($_POST['fotoProduto']));

            $primeiroArrayFoto = explode(";", $fotoProduto);
            $segundoArrayFoto = explode(",", $primeiroArrayFoto[1]);

            $permitidos = array('data:image/jpeg', 'data:image/png', 'data:image/jpg');

            if(in_array($primeiroArrayFoto[0], $permitidos)){
                $informacoesDaFoto = base64_decode($segundoArrayFoto[1]);
                $nomeDaFotoDoProduto = md5(date("d/m/Y - H:i:s").rand(0, 99999)).'.jpg';

                $caminho = 'assets/img/servicos-produtos/';

                if(is_dir($caminho)){
                    file_put_contents($caminho.$nomeDaFotoDoProduto, $informacoesDaFoto);
                }
                else{
                    mkdir($caminho);
                    file_put_contents($caminho.$nomeDaFotoDoProduto, $informacoesDaFoto);
                }

                $produto = new Produtos();
                
                if($produto->adicionarProduto($nomeProduto, $nomeDaFotoDoProduto, $valorProduto, $categoriaProduto, $tipoProduto, $acabamentoProduto)){
                    echo 1;
                }else{
                    echo 0;
                }
            }else{
                echo 2;
            }
        }
    }
    public function excluiProduto(){
        if(isset($_POST) && !empty($_POST)){
            $id = trim(addslashes($_POST['idProduto']));

            $produto = new Produto();

            if($produto->excluiProduto($id)){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
}