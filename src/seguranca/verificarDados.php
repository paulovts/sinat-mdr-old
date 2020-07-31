<?php
// Inclui o arquivo com o sistema de segurança
include("seguranca.php");
require_once"../../require/class/Tab_usuarios.class.php";
require_once"../../require/class/CriptografarSenha.class.php";
 
 $tabUsuarios = new Tab_usuarios;
 $cripto = new CriptografarSenha;
 $usuario = (isset($_GET['usuario'])) ? $_GET['usuario'] : '';
 $senha = (isset($_GET['senha'])) ? $_GET['senha'] : '';
// Verifica se um formulário foi enviado

	// Salva duas variáveis com o que foi digitado no formulário
	// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

	
	
	$senhaCripto = $cripto->setCriptografarSenha($senha);
	$resultado = $tabUsuarios->consulta_usuarioSenha($usuario, $senhaCripto);
	
	
	echo $resultado;

?>