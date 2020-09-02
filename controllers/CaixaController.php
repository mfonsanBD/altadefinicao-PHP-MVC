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
        $entradasHoje   = $caixa->entradasHoje($data);
        $saidasHoje     = $caixa->saidasHoje($data);
        
        $dados['dadosHoje'] = $dadosHoje;
        $dados['entradasHoje'] = $entradasHoje;
        $dados['saidasHoje'] = $saidasHoje;
        $dados['totalDoDia'] = $entradasHoje - $saidasHoje;
        $this->loadTemplate('administracao/caixa', $dados);
    }
}