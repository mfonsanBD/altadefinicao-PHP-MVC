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

        $this->loadTemplate('administracao/caixa', $dados);
    }
    public function buscaInfos(){
        if(isset($_POST) && !empty($_POST)){
            $data = trim(addslashes($_POST['data']));
            // $data = date_format($data, "Y-m-d");
            
            echo $data;
            
            // $caixa = new Caixa();
            // $dadosCaixa = $caixa->dadosCaixa($data);
        }
    }
}