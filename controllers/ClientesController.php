<?php 
namespace Controllers;
use \Core\Login;
use \Models\Usuario;

class ClientesController extends Login{
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
        
        $this->titulo = "Clientes";

        $listaUsuarios = $usuario->listaUsuarios();
        $quantidadeUsuarios = $usuario->quantidadeUsuarios();
        
        $dados['listaUsuarios'] = $listaUsuarios;
        $dados['quantidadeUsuarios'] = $quantidadeUsuarios;

        $this->loadTemplate('administracao/clientes', $dados);
    }
}