<html lang="pt-br">

<head>
	<meta charset="utf-8">
    
</head> 
 
<?php

require_once"../../require/class/CriptografarSenha.class.php";
require_once"../../require/class/Tab_usuarios.class.php";


$criptografar = new CriptografarSenha;
$tabUsuarios = new Tab_usuarios;

		
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
// Salva duas vari�veis com o que foi digitado no formul�rio
// Detalhe: faz uma verifica��o com isset() pra saber se o campo foi preenchido
	$senha = isset($_POST['senha']) ? $_POST['senha'] :'';	
	$cpfUsuario = isset($_POST['cpf']) ? $_POST['cpf'] :'';
	
	
}
	$senhaCriptografada = $criptografar->setCriptografarSenha($senha);
	
	
	//cadastra responsável
	$dados = array();
	
	$dados[1] = $senhaCriptografada;
	$dados[2] = $cpfUsuario;

echo 'senha: '.$senhaCriptografada.'<br>';
echo 'cpf: '.$cpfUsuario.'<br>';

$stmUsuario = $tabUsuarios->buscar_email_cpf($cpfUsuario);
foreach ($stmUsuario as $dadosUsuario) {
	$emailUsuario = $dadosUsuario['txt_email'];
}
echo 'email: '.$emailUsuario.'<br>';
	
$resultadoUsuario = $tabUsuarios->alterar_senha($dados);
	
echo 'REsultado gravacao: '.$resultadoUsuario.'<br>';



	if($resultadoResp=1){
		header("Location: ../seguranca/valida.php?usuario=".$emailUsuario."&senha=".$senha."");	

	}else{
		echo 'erro ao gravar';
		header("Location: ../../index.php");
	}	




?>
</html>