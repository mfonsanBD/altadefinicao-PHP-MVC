<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;
use \Models\Caixa;

class CaixaController extends Login{
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
        
        $this->titulo = "Caixa";
        $dados = array();

        $data = date("Y-m-d");

        $caixa = new Caixa();
        $dadosHoje      = $caixa->listaCaixaHoje($data);
        $fluxoHoje      = $caixa->fluxoCaixa($data);
        $entradasHoje   = $caixa->entradasHoje($data);
        $saidasHoje     = $caixa->saidasHoje($data);
        
        $dados['dadosHoje']     = $dadosHoje;
        $dados['fluxoHoje']     = $fluxoHoje;
        $dados['entradasHoje']  = $entradasHoje;
        $dados['saidasHoje']    = $saidasHoje;
        $dados['totalDoDia']    = $entradasHoje - $saidasHoje;

        $this->loadTemplate('administracao/caixa', $dados);
  }
  public function buscaInfos(){
      if(isset($_POST) && !empty($_POST)){
          $data = explode("/", $_POST['data']);
          $data = $data[2]."-".$data[1]."-".$data[0];

          $caixa = new Caixa();
          $dadosData      = $caixa->listaCaixaHoje($data);
          $fluxoData      = $caixa->fluxoCaixa($data);
          $entradasData   = $caixa->entradasHoje($data);
          $saidasData     = $caixa->saidasHoje($data);
          $totalDaData    = $entradasData - $saidasData;
          
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
            </div>
            <div class='text-center mt-5'>
              <button class='btn btn-warning btn-sm'>Dar Baixa no Caixa</button>
            </div>
          </div>";
      }
  }
  public function cadastraSaida(){
    if(isset($_POST) && !empty($_POST)){
      $descricao  = trim(addslashes($_POST['descricao']));
      $valor      = trim(addslashes($_POST['valor']));

      $caixa = new Caixa();
      if($caixa->cadastraSaida($valor, $descricao)){
        echo 1;
      }
      else{
        echo 0;
      }
    }
  }
}