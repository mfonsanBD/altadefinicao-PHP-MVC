<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Produtos;
use \Models\Categoria;
use \Models\TipoCliente;
use \Models\ValorProdutoTipoCliente;
use \Models\Midia;
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

                $produto                                = new Produtos();
                $listaProduto                           = $produto->listaProduto();
                $quantidadeDeProduto                    = $produto->quantidadeDeProduto();

                $categoria                              = new Categoria();
                $listaCategoria                         = $categoria->listaCategoria();

                $tiporCliente                           = new TipoCliente();
                $listaTipoCliente                       = $tiporCliente->listaTipoCliente();

                $valorProdutoTipoCliente                = new ValorProdutoTipoCliente();
                $listaValorProdutoTipoCliente           = $valorProdutoTipoCliente->listaValorProdutoTipoCliente();

                $midia                                  = new Midia();
                $listaMidia                             = $midia->listaMidia();
        
                $acabamento                             = new Acabamento();
                $listaAcabamento                        = $acabamento->listaAcabamento();
                
                $dados['listaProduto']                  = $listaProduto;
                $dados['quantidadeDeProduto']           = $quantidadeDeProduto;
                $dados['listaCategoria']                = $listaCategoria;
                $dados['listaTipoCliente']              = $listaTipoCliente;
                $dados['listaValorProdutoTipoCliente']  = $listaValorProdutoTipoCliente;
                $dados['listaAcabamento']               = $listaAcabamento;
                $dados['listaMidia']                    = $listaMidia;
                
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
            $fotoProduto            = trim(addslashes($_POST['fotoProduto']));
            $valorRevenda           = trim(addslashes($_POST['revenda']));
            $valorFinal             = trim(addslashes($_POST['final']));
            $slug                   = trim(addslashes($_POST['slug']));
            $nomeDaFotoDoProduto;

            $fotoVazia = 'iVBORw0KGgoAAAANSUhEUgAAAXQAAAD6CAYAAACxrrxPAAABf0lEQVR4nO3BAQ0AAADCoPdPbQ8HFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADwarmUAAcsYOEEAAAAASUVORK5CYII=';

            $primeiroArrayFoto = explode(";", $fotoProduto);
            $segundoArrayFoto = explode(",", $primeiroArrayFoto[1]);

            if($segundoArrayFoto[1] != $fotoVazia){
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
                }else{
                    echo 2;
                }
            }else{
                $nomeDaFotoDoProduto = 'principal.png';
            }
    
            $produto      = new Produtos();
            $ultimoId     = $produto->adicionarProduto($nomeProduto, $nomeDaFotoDoProduto, $categoriaProduto, $slug);
            
            $valorProdutoTipoCliente = new ValorProdutoTipoCliente();
            $precoRevenda   = $valorProdutoTipoCliente->defineValorRevenda($ultimoId, $valorRevenda);
            $precoFinal     = $valorProdutoTipoCliente->defineValorFinal($ultimoId, $valorFinal);

            if($ultimoId && $precoRevenda && $precoFinal){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
    public function excluiProduto(){
        if(isset($_POST) && !empty($_POST)){
            $id     = trim(addslashes($_POST['idProduto']));
            $foto   = trim(addslashes($_POST['foto']));
            
            if($foto != 'principal.png'){
                $caminho = "assets/img/servicos-produtos/";
                unlink($caminho."/".$foto);
            }

            $produto                    = new Produtos();
            $excluiProduto              = $produto->excluiProduto($id);
            
            $valorProdutoTipoCliente    = new ValorProdutoTipoCliente();
            $excluiValorProduto         = $valorProdutoTipoCliente->excluiValorProduto($id);

            if($excluiProduto && $excluiValorProduto){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
    public function alteraProduto(){
        if(isset($_POST) && !empty($_POST)){
            $idProduto              = trim(addslashes($_POST['idProduto']));
            $nomeProduto            = trim(addslashes($_POST['nomeProduto']));
            $categoriaProduto       = trim(addslashes($_POST['categoriaProduto']));
            $slug                   = trim(addslashes($_POST['slug']));

            $produto = new Produtos();
            
            if($produto->alteraProduto($nomeProduto, $categoriaProduto, $slug, $idProduto)){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
    public function alteraFotoProduto(){
        if(isset($_POST) && !empty($_POST)){
            $idProduto          = trim(addslashes($_POST['idProduto']));
            $fotoProduto        = trim(addslashes($_POST['fotoProduto']));
            $nomeDaFotoDoProduto;

            $fotoVazia = 'iVBORw0KGgoAAAANSUhEUgAAAXQAAAD6CAYAAACxrrxPAAABf0lEQVR4nO3BAQ0AAADCoPdPbQ8HFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADwarmUAAcsYOEEAAAAASUVORK5CYII=';

            $primeiroArrayFoto = explode(";", $fotoProduto);
            $segundoArrayFoto = explode(",", $primeiroArrayFoto[1]);

            if($segundoArrayFoto[1] != $fotoVazia){
                $permitidos = array('data:image/jpeg', 'data:image/png', 'data:image/jpg');
    
                if(in_array($primeiroArrayFoto[0], $permitidos)){
                    $informacoesDaFoto = base64_decode($segundoArrayFoto[1]);
                    $nomeDaFotoDoProduto = md5($idProduto).'.jpg';
    
                    $caminho = 'assets/img/servicos-produtos/';
    
                    if(is_dir($caminho)){
                        file_put_contents($caminho.$nomeDaFotoDoProduto, $informacoesDaFoto);
                    }
                    else{
                        mkdir($caminho);
                        file_put_contents($caminho.$nomeDaFotoDoProduto, $informacoesDaFoto);
                    }
                }else{
                    echo 2;
                }
            }else{
                $nomeDaFotoDoProduto = 'principal.png';
            }

            $produto        = new Produtos();
            
            if($produto->alteraFotoProduto($nomeDaFotoDoProduto, $idProduto)){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
    public function listaValoresDoProdutoRevenda(){
        if(isset($_POST) && !empty($_POST)){
            $id = trim(addslashes($_POST['idProduto']));

            $valorProdutoTipoCliente = new ValorProdutoTipoCliente();
            $valores = $valorProdutoTipoCliente->listaValoresDoProdutoRevenda($id);

            echo $valores['valor'];
        }
    }
    public function listaValoresDoProdutoFinal(){
        if(isset($_POST) && !empty($_POST)){
            $id = trim(addslashes($_POST['idProduto']));

            $valorProdutoTipoCliente = new ValorProdutoTipoCliente();
            $valores = $valorProdutoTipoCliente->listaValoresDoProdutoFinal($id);

            echo $valores['valor'];
        }
    }
    public function precoParaRevenda(){
        if(isset($_POST) && !empty($_POST)){
            $idProduto = trim(addslashes($_POST['idProduto']));
            $valorRevenda = trim(addslashes($_POST['valorRevenda']));

            $valorProdutoTipoCliente = new ValorProdutoTipoCliente();
            
            if($valorProdutoTipoCliente->mudaValorParaRevenda($valorRevenda, $idProduto)){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
    public function precoParaFinal(){
        if(isset($_POST) && !empty($_POST)){
            $idProduto = trim(addslashes($_POST['idProduto']));
            $valorFinal = trim(addslashes($_POST['valorFinal']));

            $valorProdutoTipoCliente = new ValorProdutoTipoCliente();
            
            if($valorProdutoTipoCliente->mudaValorParaFinal($valorFinal, $idProduto)){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
}