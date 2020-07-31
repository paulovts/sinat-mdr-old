
 
<?php

require_once"../../require/class/Tab_usuarios.class.php";

$tabUsuario = new Tab_usuarios;

$email = $_GET['email'];	
		
$resultadoEmail = $tabUsuario->consulta_email($email);
echo $resultadoEmail;	

?>
