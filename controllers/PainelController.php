<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Produtos;
use \Models\TipoCliente;
use \Models\Pedidos;
use \Models\Notificacoes;

class PainelController extends Login{
	public function index(){
        if(empty($_SESSION['logado']) || !isset($_SESSION['logado'])){
            header("Location: ".URL_BASE."login");
            exit();
        }

        $notificacoes = new Notificacoes();
        $quantidade = $notificacoes->quantidadeNotificacoes();
        $this->qtdNotify = $quantidade;

        $id = $_SESSION['logado'];

        $usuario = new Usuario();
        $informacoesUsuario = $usuario->informacoesUsuario($id);

        $pedido = new Pedidos();

        $this->nomeUsuario = $informacoesUsuario['nomeUsuario']." ".$informacoesUsuario['sobrenomeUsuario'];
        $this->foto = $informacoesUsuario['fotoUsuario'];

        switch($_SESSION['idTipoUsuario']){
            case 1:
                $dados = array();
                $quantidadeUsuarios = $usuario->quantidadeUsuarios();
                $dados['quantidadeUsuarios'] = $quantidadeUsuarios;

                $dataHoje   = date("Y-m-d");
                $Mes        = date("Y-m");

                $janeiro        = date("Y-01");
                $fevereiro      = date("Y-02");
                $marco          = date("Y-03");
                $abril          = date("Y-04");
                $maio           = date("Y-05");
                $junho          = date("Y-06");
                $julho          = date("Y-07");
                $agosto         = date("Y-08");
                $setembro       = date("Y-09");
                $outubro        = date("Y-10");
                $novembro       = date("Y-11");
                $dezembro       = date("Y-12");

                $maisPedidos                = $pedido->maisPedidos();
                $dados['maispedidos']       = $maisPedidos;

                $quantidadePedidos = $pedido->quantidadePedidos();
                $dados['quantidadePedidos'] = $quantidadePedidos;

                $listaPedidos               = $pedido->listaPedidos();

                $lucroJaneiro               = $pedido->lucroJaneiro($janeiro);
                if($lucroJaneiro == ""){$lucroJaneiro = 0;}
                $lucroFevereiro             = $pedido->lucroFevereiro($fevereiro);
                if($lucroFevereiro == ""){$lucroFevereiro = 0;}
                $lucroMarco                 = $pedido->lucroMarco($marco);
                if($lucroMarco == ""){$lucroMarco = 0;}
                $lucroAbril                 = $pedido->lucroAbril($abril);
                if($lucroAbril == ""){$lucroAbril = 0;}
                $lucroMaio                  = $pedido->lucroMaio($maio);
                if($lucroMaio == ""){$lucroMaio = 0;}
                $lucroJunho                 = $pedido->lucroJunho($junho);
                if($lucroJunho == ""){$lucroJunho = 0;}
                $lucroJulho                 = $pedido->lucroJulho($julho);
                if($lucroJulho == ""){$lucroJulho = 0;}
                $lucroAgosto                = $pedido->lucroAgosto($agosto);
                if($lucroAgosto == ""){$lucroAgosto = 0;}
                $lucroSetembro              = $pedido->lucroSetembro($setembro);
                if($lucroSetembro == ""){$lucroSetembro = 0;}
                $lucroOutubro               = $pedido->lucroOutubro($outubro);
                if($lucroOutubro == ""){$lucroOutubro = 0;}
                $lucroNovembro              = $pedido->lucroNovembro($novembro);
                if($lucroNovembro == ""){$lucroNovembro = 0;}
                $lucroDezembro              = $pedido->lucroDezembro($dezembro);
                if($lucroDezembro == ""){$lucroDezembro = 0;}

                $pedidosJaneiro               = $pedido->pedidosJaneiro($janeiro);
                if($pedidosJaneiro == ""){$pedidosJaneiro = 0;}
                $pedidosFevereiro             = $pedido->pedidosFevereiro($fevereiro);
                if($pedidosFevereiro == ""){$pedidosFevereiro = 0;}
                $pedidosMarco                 = $pedido->pedidosMarco($marco);
                if($pedidosMarco == ""){$pedidosMarco = 0;}
                $pedidosAbril                 = $pedido->pedidosAbril($abril);
                if($pedidosAbril == ""){$pedidosAbril = 0;}
                $pedidosMaio                  = $pedido->pedidosMaio($maio);
                if($pedidosMaio == ""){$pedidosMaio = 0;}
                $pedidosJunho                 = $pedido->pedidosJunho($junho);
                if($pedidosJunho == ""){$pedidosJunho = 0;}
                $pedidosJulho                 = $pedido->pedidosJulho($julho);
                if($pedidosJulho == ""){$pedidosJulho = 0;}
                $pedidosAgosto                = $pedido->pedidosAgosto($agosto);
                if($pedidosAgosto == ""){$pedidosAgosto = 0;}
                $pedidosSetembro              = $pedido->pedidosSetembro($setembro);
                if($pedidosSetembro == ""){$pedidosSetembro = 0;}
                $pedidosOutubro               = $pedido->pedidosOutubro($outubro);
                if($pedidosOutubro == ""){$pedidosOutubro = 0;}
                $pedidosNovembro              = $pedido->pedidosNovembro($novembro);
                if($pedidosNovembro == ""){$pedidosNovembro = 0;}
                $pedidosDezembro              = $pedido->pedidosDezembro($dezembro);
                if($pedidosDezembro == ""){$pedidosDezembro = 0;}
        
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
                
                $this->lucroJaneiro         = $lucroJaneiro;
                $this->lucroFevereiro       = $lucroFevereiro;
                $this->lucroMarco           = $lucroMarco;
                $this->lucroAbril           = $lucroAbril;
                $this->lucroMaio            = $lucroMaio;
                $this->lucroJunho           = $lucroJunho;
                $this->lucroJulho           = $lucroJulho;
                $this->lucroAgosto          = $lucroAgosto;
                $this->lucroSetembro        = $lucroSetembro;
                $this->lucroOutubro         = $lucroOutubro;
                $this->lucroNovembro        = $lucroNovembro;
                $this->lucroDezembro        = $lucroDezembro;
                
                $this->pedidosJaneiro       = $pedidosJaneiro;
                $this->pedidosFevereiro     = $pedidosFevereiro;
                $this->pedidosMarco         = $pedidosMarco;
                $this->pedidosAbril         = $pedidosAbril;
                $this->pedidosMaio          = $pedidosMaio;
                $this->pedidosJunho         = $pedidosJunho;
                $this->pedidosJulho         = $pedidosJulho;
                $this->pedidosAgosto        = $pedidosAgosto;
                $this->pedidosSetembro      = $pedidosSetembro;
                $this->pedidosOutubro       = $pedidosOutubro;
                $this->pedidosNovembro      = $pedidosNovembro;
                $this->pedidosDezembro      = $pedidosDezembro;

                $this->titulo = "Painel de Controle";
                $this->loadTemplate('administracao/painel', $dados);
            break;
            case 2:
                $dados = array();
                $this->titulo = "Painel de Controle";
                $this->loadTemplate('producao/painel', $dados);
            break;
            case 3:
                $dados = array();
                $this->titulo = "Painel de Controle";
                $this->loadTemplate('cliente/painel', $dados);
            break;
            case 4:
                $dados = array();
                $this->titulo = "Painel de Controle";
                $this->loadTemplate('artefinal/painel', $dados);
            break;
            default:
                header("Location: ".URL_BASE."login");
                exit();
            break;
        }
	}
}