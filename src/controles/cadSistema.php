<?php
include("../../require/class/Opc_sistema.class.php");
echo('passou aqui php 1');
$opcSistema = new Opc_sistema;

$dadosJSON = json_decode($_POST['enviado'],true);

$resultado = $opcSistema->cadastrarSistema($dadosJSON);

echo $resultado;

?>