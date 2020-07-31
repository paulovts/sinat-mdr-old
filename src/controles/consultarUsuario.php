
 
<?php

require_once"../../require/class/Tab_usuarios.class.php";

$tabUsuario = new Tab_usuarios;

$cpfUsuario = $_GET['cpfUsuario'];	
		
$resultadoUsurario = $tabUsuario->consultar_usuario($cpfUsuario);
echo $resultadoUsurario;	
?>
