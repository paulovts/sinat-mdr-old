<?php
include("../seguranca/seguranca.php");
//require_once"../../require/class/Arquivos_json.class.php";
require_once"../../require/class/ConDBSnhDhab.class.php"; //require_once"ConDBCorporativo.class.php"
require_once"../../require/class/Opc_solucao.class.php";

header('Content-Type: text/html; charset=UTF-8');

$opc_solucao = new Opc_solucao;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$txtSistema = (isset($_GET['nomeSistema'])) ? $_GET['nomeSistema'] : '';
}


	if(empty($txtSistema)){
		$resultado = $opc_solucao->json_listarSolucao();		
	}else{
		$resultado = $opc_solucao->json_listarSolucao_sistema($txtSistema);
	}
	
	echo $resultado;
	
	
?>