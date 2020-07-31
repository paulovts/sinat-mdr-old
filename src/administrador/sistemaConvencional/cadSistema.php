<?php
include("../../require/class/Opc_sistema.class.php");

$opcSistema = new Opc_sistema;

$dadosSistema = array();
$data = array();

$_POST = json_decode(file_get_contents('php://input'), true);
$dadosSistema['nomeSistema'] = 'Sistema de teste';
//$dadosSistema['nomeSistema'] = isset($_POST['nomeSistemaNovo']) ? $_POST['nomeSistemaNovo']:'';
$dadosSistema['siglaSistema'] =  isset($_POST['siglaSistema']) ? $_POST['siglaSistema']:'';
$dadosSistema['descricaoSistema'] = isset($_POST['descricaoSistema']) ? $_POST['descricaoSistema']:'';


//$resultado = $opcSistema->cadastrarSistema($dadosJSON);
if (!empty($data)) {
	$data['dadosSistema'] = $dadosSistema;
} else {
  $data['message'] = 'Erro nos dados';
}

echo json_encode($data);

?>