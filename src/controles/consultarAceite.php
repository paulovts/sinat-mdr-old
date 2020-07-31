
 
<?php

require_once"../../require/class/Tab_usuarios.class.php";

$tabUsuario = new Tab_usuarios;

$codUsuario = $_GET['codUsuario'];	
	

$resultadoAceite = $tabUsuario->consultar_aceite($codUsuario);

	if($resultadoAceite == 0){
		header("Location: ../paginas/documentosSistemasConvencionais.php");
	}else if($resultadoAceite == 1){
		header("Location: ../paginas/catalogoConvencional.php");
		}
	
?>
