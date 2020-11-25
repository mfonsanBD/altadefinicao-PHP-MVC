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
use \Models\TipoEntrega;
use \Models\FormaPagamento;

class PedidosController extends Login{
	public function index(){
        if(empty($_SESSION['logado']) || !isset($_SESSION['logado']) || $_SESSION['idTipoUsuario'] != 1){
            header("Location: ".URL_BASE."login");
            exit();
        }

        $id = $_SESSION['logado'];

        $usuario = new Usuario();
        $informacoesUsuario   = $usuario->informacoesUsuario($id);
        $listaUsuarios        = $usuario->listaUsuarios();

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

        $tipoEntrega                 = new TipoEntrega();
        $listaTipoEntrega            = $tipoEntrega->listaTipoEntrega();

        $formaPagamento              = new FormaPagamento();
        $listaFormaPagamento         = $formaPagamento->listaFormaPagamento();

        $dados['listaPedidos']      = $listaPedidos;
        $dados['listaProduto']      = $listaProduto;
        $dados['listaTipoCliente']  = $listaTipoCliente;
        $dados['listaUsuarios']     = $listaUsuarios;
        $dados['listaAcabamento']   = $listaAcabamento;
        $dados['listaMidia']        = $listaMidia;
        $dados['listaEntrega']      = $listaTipoEntrega;
        $dados['listaPagamento']    = $listaFormaPagamento;

        $this->loadTemplate('administracao/pedidos', $dados);
  }
  public function pedido($slug){
    if(empty($_SESSION['logado']) || !isset($_SESSION['logado']) || $_SESSION['idTipoUsuario'] != 1){
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
      $idProduto        = trim(addslashes($_POST['idProduto']));
      $idTipoCliente    = trim(addslashes($_POST['idTipoCliente']));
      $idCliente        = trim(addslashes($_POST['idCliente']));
      $idMidia          = trim(addslashes($_POST['idMidia']));
      $idAcabamento     = trim(addslashes($_POST['idAcabamento']));
      $final            = trim(addslashes($_POST['final']));
      $idEntrega        = trim(addslashes($_POST['entrega']));
      $idPagamento      = trim(addslashes($_POST['pagamento']));
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

      $tipoentrega                    = new TipoEntrega();
      $getNomeTipoEntrega             = $tipoentrega->getNomeTipoEntrega($idEntrega);

      $formaPagamento                 = new FormaPagamento();
      $getNomeFormaPagamento          = $formaPagamento->getNomeFormaPagamento($idPagamento);

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
        'nomeTipoEntrega'           => $getNomeTipoEntrega['nomeTipoEntrega'],
        'nomeFormaPagamento'        => $getNomeFormaPagamento['nomeFormaPagamento'],
        'valorDoPedido'             => number_format($totalPedido, 2, ",", ".")
      );

      echo json_encode($array);
    }
  }
  public function addPedido(){
    if(isset($_POST) && !empty($_POST)){
      $revendedor;
      $final;

      if(isset($_POST['clienteRevenda']) && !empty($_POST['clienteRevenda'])){
        $revendedor = trim(addslashes($_POST['clienteRevenda']));
        $final = "";
      }else{
        $revendedor = NULL;
        $final = trim(addslashes($_POST['nomeClienteFinal']));
      }

      $tipoCliente        = trim(addslashes($_POST['tipocliente']));
      $produtoPedido      = trim(addslashes($_POST['produtoPedido']));
      $midia              = trim(addslashes($_POST['midia']));
      $acabamento         = trim(addslashes($_POST['acabamento']));
      $pagamento          = trim(addslashes($_POST['pagamento']));
      $entrega            = trim(addslashes($_POST['entrega']));
      $identificacao      = trim(addslashes($_POST['identificacao']));
      $altura             = trim(addslashes($_POST['alturaProduto']));
      $largura            = trim(addslashes($_POST['larguraProduto']));

      $valorTipoCliente               = new ValorProdutoTipoCliente();
      $getValorProdutoTipoCliente     = $valorTipoCliente->getValorProdutoTipoCliente($produtoPedido, $tipoCliente);
      
      $alturaPedido       = str_replace(".", "", $altura);
      $alturaPedido       = str_replace(",", "", $alturaPedido);
      
      $larguraPedido      = str_replace(".", "", $largura);
      $larguraPedido      = str_replace(",", "", $larguraPedido);

      $quantidade         = trim(addslashes($_POST['quantidadeProduto']));

      $totalPedido        = ((($alturaPedido*$larguraPedido)*$getValorProdutoTipoCliente['valor_p_tc'])*$quantidade);
      $totalPedido        = $totalPedido/100;
      $totalPedido        = $totalPedido/100;

      $observacao         = trim(addslashes($_POST['observacao']));

      $arquivoArte        = $_FILES['arte']['name'];
      $caminhoArquivo     = $_FILES['arte']['tmp_name'];
      $tipoArquivo        = $_FILES['arte']['type'];
      $pastaAno           = date("Y");

      $permitidos         = array('application/octet-stream', 'image/jpeg', 'application/pdf');

      if(in_array($tipoArquivo, $permitidos)){
        if(is_dir('media/pedidos/'.$pastaAno)){
          if($tipoCliente == 2){
            verificaPastaRevendedor($pastaAno, $revendedor, $arquivoArte, $caminhoArquivo);
          }else{
            verificaPastaFinal($pastaAno, $final, $arquivoArte, $caminhoArquivo);
          }
        }else{
          mkdir('media/pedidos/'.$pastaAno);
          if($tipoCliente == 2){
            verificaPastaRevendedor($pastaAno, $revendedor, $arquivoArte, $caminhoArquivo);
          }else{
            verificaPastaFinal($pastaAno, $final, $arquivoArte, $caminhoArquivo);
          }
        }
      }else{
        echo 2;
      }

      $slug               = md5(date("Y-m-d H:i:s").rand(0, 99999));
      $infoArte           = trim(addslashes($_POST['infoArte']));
      
      $pedido = new Pedidos();
      $adicionaPedido     = $pedido->adicionaPedido($revendedor, $produtoPedido, $midia, $acabamento, $tipoCliente, $pagamento, $entrega, $final, $identificacao, $altura, $largura, $quantidade, $totalPedido, $observacao, $arquivoArte, $slug, $infoArte);

      if($adicionaPedido){
        echo 1;
      }else{
        echo 0;
      }
    }
  }
  public function getMidias(){
    if(isset($_POST) && !empty($_POST)){
      $idProduto        = trim(addslashes($_POST['idProduto']));

      $produto                    = new Produtos();
      $listaInfosProduto          = $produto->listaInfosProduto($idProduto);

      $midia                      = new Midia();
      $listaMidia                 = $midia->listaMidia();

      $midiasProduto        = explode(",", $listaInfosProduto['idsMidias']);

      foreach($listaMidia as $midias){
        if(in_array($midias['idMidia'], $midiasProduto)){
          echo "<div class='custom-control custom-radio mb-3 custom-control-inline'>
              <input type='radio' id='midia".$midias['idMidia']."' name='midia' class='custom-control-input' value='".$midias['idMidia']."'>
              <label class='custom-control-label' for='midia".$midias['idMidia']."'>".$midias['nomeMidia']."</label>
          </div>";
        }
      }
    }
  }
  public function getAcabamentos(){
    if(isset($_POST) && !empty($_POST)){
      $idProduto        = trim(addslashes($_POST['idProduto']));

      $produto                    = new Produtos();
      $listaInfosProduto          = $produto->listaInfosProduto($idProduto);

      $acabamento                 = new Acabamento();
      $listaAcabamento            = $acabamento->listaAcabamento();

      $acabamentosProduto        = explode(",", $listaInfosProduto['idsAcabamentos']);

      foreach($listaAcabamento as $acabamentos){
        if(in_array($acabamentos['idAcabamento'], $acabamentosProduto)){
          echo "<div class='custom-control custom-radio mb-3 custom-control-inline'>
              <input type='radio' id='acabamento".$acabamentos['idAcabamento']."' name='acabamento' class='custom-control-input' value='".$acabamentos['idAcabamento']."'>
              <label class='custom-control-label' for='acabamento".$acabamentos['idAcabamento']."'>".$acabamentos['nomeAcabamento']."</label>
          </div>";
        }
      }
    }
  }
}

function verificaPastaRevendedor($pastaAno, $revendedor, $arquivoArte, $caminhoArquivo){
  if(is_dir('media/pedidos/'.$pastaAno.'/'.$revendedor)){
    move_uploaded_file($caminhoArquivo, 'media/pedidos/'.$pastaAno.'/'.$revendedor.'/'.$arquivoArte);
  }else{
    mkdir('media/pedidos/'.$pastaAno.'/'.$revendedor);
    move_uploaded_file($caminhoArquivo, 'media/pedidos/'.$pastaAno.'/'.$revendedor.'/'.$arquivoArte);
  }
}

function verificaPastaFinal($pastaAno, $final, $arquivoArte, $caminhoArquivo){
  if(is_dir('media/pedidos/'.$pastaAno.'/'.$final)){
    move_uploaded_file($caminhoArquivo, 'media/pedidos/'.$pastaAno.'/'.$final.'/'.$arquivoArte);
  }else{
    mkdir('media/pedidos/'.$pastaAno.'/'.$final);
    move_uploaded_file($caminhoArquivo, 'media/pedidos/'.$pastaAno.'/'.$final.'/'.$arquivoArte);
  }
}