
 
<?php

require_once"../../require/class/Tab_usuarios.class.php";

$tabUsuario = new Tab_usuarios;

$codUsuario = $_POST['codUsuario'];

$resultado = $tabUsuario->salvar_aceite($codUsuario);

	if($resultado == 0){
		header("Location: ../paginas/documentosSistemasConvencionais.php");
	}else if($resultado == 1){
		header("Location: ../paginas/catalogoConvencional.php");
		}
	
?>
