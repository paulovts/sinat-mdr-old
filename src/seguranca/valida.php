<?php
// Inclui o arquivo com o sistema de segurança
include("seguranca.php");
require_once "../../require/class/Tab_usuarios.class.php";

class Login
{
    public function __construct()
    {
        $this->tabUsuario = new Tab_usuarios;
    }

    public function verificaPerfil($usuario)
    {
       return $this->tabUsuarios->consultar_perfil($usuario);
    }
}


$tabUsuarios = new Tab_usuarios;
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
    $usuario = (isset($_GET['usuario'])) ? $_GET['usuario'] : '';
    $senha = (isset($_GET['senha'])) ? $_GET['senha'] : '';

    $codPerfil = $tabUsuarios->consultar_perfil($usuario);
// Utiliza uma função criada no seguranca.php pra validar os dados digitados
    if (validaUsuario($usuario, $senha) == true) {
// O usuário e a senha digitados foram validados, manda pra página interna	
        if ($codPerfil == 2) {
            header("Location: ../paginas/escolhaSistemas.php");
        } else {
            header("Location: ../paginas/cadUploadDocumento.php");
        }

    } else {
// O usuário e/ou a senha são inválidos, manda de volta pro form de login
// Para alterar o endereço da página de login, verifique o arquivo seguranca.php
        session_start();
        $_SESSION['msgErro'] = 'Usuário ou senha inválidos!';
        header("Location: ../../index.php");

        expulsaVisitante();

    }
}
?>