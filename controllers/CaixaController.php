<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Caixa;
use \Models\Baixa;
use \Models\Pedidos;

class CaixaController extends Login{
	public function index(){
        if(empty($_SESSION['logado']) || !isset($_SESSION['logado']) || $_SESSION['idTipoUsuario'] != 1){
            header("Location: ".URL_BASE."login");
            exit();
        }

        $id = $_SESSION['logado'];

        $usuario = new Usuario();
        $informacoesUsuario = $usuario->informacoesUsuario($id);

        $this->nomeUsuario = $informacoesUsuario['nomeUsuario']." ".$informacoesUsuario['sobrenomeUsuario'];
        $this->foto = $informacoesUsuario['fotoUsuario'];
        
        $this->titulo = "Caixa";
        $dados = array();

        $data = date("Y-m-d");

        $caixa = new Caixa();
        $dadosHoje      = $caixa->listaCaixaHoje($data);
        $fluxoHoje      = $caixa->fluxoCaixa($data);
        $entradasHoje   = $caixa->entradasHoje($data);
        $saidasHoje     = $caixa->saidasHoje($data);

        $baixa = new Baixa();

        $listaBaixa     = $baixa->listaBaixa($data);

        foreach($listaBaixa as $lista){
          if($lista['situacaoBaixa'] != 0){
            $usuarioDeuBaixa = $usuario->usuarioDeuBaixa($lista['idUsuario']);
            $this->nomeDeuBaixa = $usuarioDeuBaixa['nomeUsuario']." ".$usuarioDeuBaixa['sobrenomeUsuario'];
          }
        }
        
        $dados['dadosHoje']     = $dadosHoje;
        $dados['fluxoHoje']     = $fluxoHoje;
        $dados['entradasHoje']  = $entradasHoje;
        $dados['saidasHoje']    = $saidasHoje;
        $dados['totalDoDia']    = $entradasHoje - $saidasHoje;
        $dados['listaBaixa']    = $listaBaixa;

        $this->loadTemplate('administracao/caixa', $dados);
  }
  public function buscaInfos(){
      if(isset($_POST) && !empty($_POST)){
          $data = explode("/", $_POST['data']);
          $data = $data[2]."-".$data[1]."-".$data[0];

          $baixa          = new Baixa();
          $listaBaixa     = $baixa->listaBaixa($data);

          $caixa          = new Caixa();
          $dadosData      = $caixa->listaCaixaHoje($data);
          $fluxoData      = $caixa->fluxoCaixa($data);
          $entradasData   = $caixa->entradasHoje($data);
          $saidasData     = $caixa->saidasHoje($data);
          $totalDaData    = $entradasData - $saidasData;
  
          foreach($listaBaixa as $lista){
            if($lista['situacaoBaixa'] != 0){
              $usuario = new Usuario();
              $usuarioDeuBaixa = $usuario->usuarioDeuBaixa($lista['idUsuario']);
              $this->nomeDeuBaixa = $usuarioDeuBaixa['nomeUsuario']." ".$usuarioDeuBaixa['sobrenomeUsuario'];
            }
          }
          
          echo "<div id=dados>
            <!-- Card stats -->
            <div class='row'>
              <div class='col-xl-4 col-md-4'>
                <div class='card card-stats'>
                  <!-- Card body -->
                  <div class='card-body'>
                    <div class='row'>
                      <div class='col'>
                        <h5 class='card-title text-uppercase text-muted mb-0'>Entradas</h5>
                        <span class='h2 font-weight-bold mb-0' id='valorEntrada'>
                          R$ ".number_format($entradasData, 2, ",", ".")."
                        </span>
                      </div>
                      <div class='col-auto'>
                        <div class='icon icon-shape bg-gradient-green text-white rounded-circle shadow'>
                          <i class='ni ni-money-coins'></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class='col-xl-4 col-md-4'>
                <div class='card card-stats'>
                  <!-- Card body -->
                  <div class='card-body'>
                    <div class='row'>
                      <div class='col'>
                        <h5 class='card-title text-uppercase text-muted mb-0'>Saidas</h5>
                        <span class='h2 font-weight-bold mb-0' id='valorSaida'>
                          R$ ".number_format($saidasData, 2, ",", ".")."
                        </span>
                      </div>
                      <div class='col-auto'>
                        <div class='icon icon-shape bg-gradient-red text-white rounded-circle shadow'>
                          <i class='ni ni-money-coins'></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class='col-xl-4 col-md-4'>
                <div class='card card-stats'>
                  <!-- Card body -->
                  <div class='card-body'>
                    <div class='row'>
                      <div class='col'>
                        <h5 class='card-title text-uppercase text-muted mb-0'>Total do Dia</h5>
                        <span class='h2 font-weight-bold mb-0' id='valorTotal'>
                          R$ ".number_format($totalDaData, 2, ",", ".")."
                        </span>
                      </div>
                      <div class='col-auto'>
                        <div class='icon icon-shape bg-gradient-info text-white rounded-circle shadow'>
                          <i class='ni ni-money-coins'></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Light table -->
            <div class='table-responsive'>
              <table class='table align-items-center table-flush'>
                <thead class='thead-light'>
                  <tr>
                    <th scope='col' class='sort' data-sort='name'>Descrição</th>
                    <th scope='col' class='sort' data-sort='status'>Operação</th>
                    <th scope='col' class='sort' data-sort='completion'>Valor da Operação</th>
                    <th scope='col' class='sort' data-sort='status'>Forma de Pagamento</th>
                  </tr>
                </thead>
                <tbody class='list'>";
                    if($fluxoData != 0){
                      foreach($dadosData as $caixa):
                        echo "<tr>
                          <th class='budget'>".$caixa['descricaoOperacaoCaixa']."</th>
                          <td>
                            <span class='badge badge-dot mr-4'>";
                                if($caixa['operacaoCaixa'] == 0){
                                  echo "<i class='bg-danger'></i>
                                  <span class='status'>Saida</span>";
                                }else{
                                  echo "<i class='bg-success'></i>
                                  <span class='status'>Entrada</span>";
                                }
                            echo "</span>
                          </td>
                          <td class='budget'>
                            R$ ".number_format($caixa['valorCaixa'], 2, ",", ".")."
                          </td>
                          <td class='budget'>
                            Dinheiro
                          </td>
                        </tr>";
                      endforeach;
                    }else{
                    echo "<tr>
                      <td colspan=4 class='text-center'>
                        Nenhum dado registrado no caixa deste dia.
                      </td>
                    </tr>";
                    }
                echo "</tbody>
              </table>
            </div>";
                  foreach($listaBaixa as $baixa):
                    if($baixa['situacaoBaixa'] == 0){
                      echo "<div class='text-center mt-5'>
                        <button class='btn btn-warning btn-sm' id='baixaNoCaixa'>Dar Baixa no Caixa</button>
                      </div>";
                    }else{
                      echo "<div class='col-lg-12 text-center mt-5 bg-gradient-green p-2'>
                        <p class='p-0 m-0 text-white'>Baixa no caixa dado por: ".$this->nomeDeuBaixa."</p>
                      </div>";
                    }
                  endforeach;
          echo "</div>";
      }
  }
  public function cadastraSaida(){
    if(isset($_POST) && !empty($_POST)){
      $descricao  = trim(addslashes($_POST['descricao']));
      $valor      = trim(addslashes($_POST['valor']));
      $hoje       = date("Y-m-d");

      $baixa = new Baixa();
      $ultimoId = $baixa->ultimoId($hoje);

      $caixa = new Caixa();
      $cadastraSaida = $caixa->cadastraSaida($ultimoId, $valor, $descricao);

      if($cadastraSaida){
        echo 1;
      }
      else{
        echo 0;
      }
    }
  }
  public function darBaixa(){
    $usuario  = $_SESSION['logado'];
    $data     = date("Y-m-d");

    $baixa = new Baixa();

    if($baixa->deuBaixa($usuario, $data)){
      echo 1;
    }else{
      echo 0;
    }
  }
  public function cadastraEntradaCaixa(){
    if(isset($_POST) && !empty($_POST)){
      $idPedido           = trim(addslashes($_POST['idPedido']));
      $hoje               = date("Y-m-d");

      $pedido = new Pedidos();
      $informacoesPedido  = $pedido->infoPedido($idPedido);
      $valor              = $informacoesPedido['valorPedido'];
      $formaPagamento;
      $cliente;

      switch($informacoesPedido['idFormaPagamento']){
        case 1:
          $formaPagamento = "Dinheiro";
        break;
        case 2:
          $formaPagamento = "Transferência";
        break;
        case 3:
          $formaPagamento = "Cartão de Débito";
        break;
        case 3:
          $formaPagamento = "Cartão de Crédito";
        break;
      }
      
      if($informacoesPedido['idCliente'] == null){
        $cliente          = $informacoesPedido['nomeCliente'];
      }else{
        $cliente          = $informacoesPedido['nomeUsuario']." ".$informacoesPedido['sobrenomeUsuario'];
      }

      $baixa = new Baixa();
      $ultimoId = $baixa->ultimoId($hoje);

      $caixa = new Caixa();
      $cadastraEntradaCaixa = $caixa->cadastraEntradaCaixa($idPedido, $ultimoId, $hoje, $valor, $cliente, $formaPagamento);

      if($cadastraEntradaCaixa){
        echo 1;
      }else{
        echo 0;
      }
    }
  }
}