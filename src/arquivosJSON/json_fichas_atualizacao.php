<?php
include("../seguranca/seguranca.php");
require_once"../../require/class/ConDBSnhDhab.class.php"; //require_once"ConDBCorporativo.class.php"
require_once"../../require/class/Tab_usuarios.class.php";
header('Content-Type: text/html; charset=UTF-8');

$tabUsuarios = new Tab_usuarios;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$codUsuario = (isset($_GET['codUsuario'])) ? $_GET['codUsuario'] : '';
}

	$resultado = $tabUsuarios->json_atualizacao_fichas($codUsuario);
	echo $resultado;	
?>