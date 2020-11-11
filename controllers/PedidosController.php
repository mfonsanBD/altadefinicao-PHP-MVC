<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Produtos;
use \Models\TipoCliente;
use \Models\ValorProdutoTipoCliente;
use \Models\Pedidos;
use \Models\Midia;
use \Models\Acabamento;

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

        $midia                      = new Midia();
        $listaMidia                 = $midia->listaMidia();

        $acabamento                 = new Acabamento();
        $listaAcabamento            = $acabamento->listaAcabamento();

        $listaUsuarios              = $usuario->listaUsuarios();

        $dados['listaPedidos']      = $listaPedidos;
        $dados['listaProduto']      = $listaProduto;
        $dados['listaTipoCliente']  = $listaTipoCliente;
        $dados['listaUsuarios']     = $listaUsuarios;
        $dados['listaAcabamento']   = $listaAcabamento;
        $dados['listaMidia']        = $listaMidia;

        $this->loadTemplate('administracao/pedidos', $dados);
  }
  public function pedido($slug){
    if(empty($_SESSION['logado']) || !isset($_SESSION['logado']) || $_SESSION['tipoUsuario'] != 1){
        header("Location: ".URL_BASE."login");
        exit();
    }
    
    $id = $_SESSION['logado'];

    $usuario = new Usuario();
    $informacoesUsuario = $usuario->informacoesUsuario($id);

    $this->nomeUsuario = $informacoesUsuario['nomeUsuario']." ".$informacoesUsuario['sobrenomeUsuario'];
    $this->foto = $informacoesUsuario['fotoUsuario'];

    $dados = array();

    $pedido = new Pedidos();
    $infoPedido = $pedido->infoPedidos($slug);
    
    if($infoPedido['visualizado'] == 0){
      $visualizado = $pedido->visualizou($slug);
    }

    $this->titulo = "Pedido: ".str_pad($infoPedido['idPedido'], 6, 0, STR_PAD_LEFT);

    $dados['pedido'] = $infoPedido;
    $this->loadTemplate('administracao/pedido', $dados);
  }
  public function alteraPedido(){
    if(isset($_POST) && !empty($_POST)){
      $status     = trim(addslashes($_POST['status']));
      $problema   = trim(addslashes($_POST['problema']));
      $idPedido   = trim(addslashes($_POST['idPedido']));

      $pedido = new Pedidos();
      $alteraPedido = $pedido->alteraPedido($status, $problema, $idPedido);

      if($alteraPedido){
        echo 1;
      }else{
        echo 0;
      }
    }
  }
  public function alteraVisualizacaoPedido(){
    if(isset($_POST) && !empty($_POST)){
      $visualizado     = trim(addslashes($_POST['visualizado']));
      $idPedido        = trim(addslashes($_POST['idPedido']));

      $pedido = new Pedidos();
      $alteraVisualizacaoPedido = $pedido->alteraVisualizacaoPedido($visualizado, $idPedido);

      if($alteraVisualizacaoPedido){
        echo 1;
      }else{
        echo 0;
      }
    }
  }
  public function getInformacoes(){
    if(isset($_POST) && !empty($_POST)){
      $idProduto      = trim(addslashes($_POST['idProduto']));
      $idTipoCliente  = trim(addslashes($_POST['idTipoCliente']));
      $idCliente      = trim(addslashes($_POST['idCliente']));
      $idMidia        = trim(addslashes($_POST['idMidia']));
      $idAcabamento   = trim(addslashes($_POST['idAcabamento']));
      $final          = trim(addslashes($_POST['final']));
      $nomeDoCliente;
      
      $altura         = trim(addslashes($_POST['altura']));
      $altura         = str_replace(".", "", $altura);
      $altura         = str_replace(",", "", $altura);

      $largura        = trim(addslashes($_POST['largura']));
      $largura         = str_replace(".", "", $largura);
      $largura         = str_replace(",", "", $largura);

      $quantidade     = trim(addslashes($_POST['quantidade']));

      $produto                        = new Produtos();
      $getNomeProduto                 = $produto->getNomeProduto($idProduto);

      $tipodecliente                  = new TipoCliente();
      $getNomeTipoCliente             = $tipodecliente->getNomeTipoCliente($idTipoCliente);

      $valorTipoCliente               = new ValorProdutoTipoCliente();
      $getValorProdutoTipoCliente     = $valorTipoCliente->getValorProdutoTipoCliente($idProduto, $idTipoCliente);
                             
      $midia                          = new Midia();
      $getNomeMidia                   = $midia->getNomeMidia($idMidia);

      $acabamento                     = new Acabamento();
      $getNomeAcabamento              = $acabamento->getNomeAcabamento($idAcabamento);

      $totalPedido                    = ((($altura*$largura)*$getValorProdutoTipoCliente['valor_p_tc'])*$quantidade);
      $totalPedido                    = $totalPedido/100;
      $totalPedido                    = $totalPedido/100;

      if($idTipoCliente == 2){
        $usuario            = new Usuario();
        $getNomeUsuario     = $usuario->getNomeUsuario($idCliente);
        $nomeDoCliente      = $getNomeUsuario['nomeUsuario']." ".$getNomeUsuario['sobrenomeUsuario'];
      }else{
        $nomeDoCliente = $final;
      }

      $array = array(
        'nomeProduto'               => $getNomeProduto['nomeProduto'],
        'nomeTipoCliente'           => $getNomeTipoCliente['nomeTipoCliente'],
        'nomeCliente'               => $nomeDoCliente,
        'nomeMidia'                 => $getNomeMidia['nomeMidia'],
        'nomeAcabamento'            => $getNomeAcabamento['nomeAcabamento'],
        'valorDoPedido'             => number_format($totalPedido, 2, ",", ".")
      );

      echo json_encode($array);
    }
  }
}