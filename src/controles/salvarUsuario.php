<html lang="pt-br">

<head>
	<meta charset="utf-8">
    
</head> 
 
<?php
include("../seguranca/seguranca.php");
require_once"../../require/class/CriptografarSenha.class.php";
require_once"../../require/class/Tab_usuarios.class.php";


$criptografar = new CriptografarSenha;
$tabUsuarios = new Tab_usuarios;

		
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
// Salva duas vari�veis com o que foi digitado no formul�rio
// Detalhe: faz uma verifica��o com isset() pra saber se o campo foi preenchido
	$tipoUsuario = isset($_POST['tipoUsuario']) ? $_POST['tipoUsuario'] :'';	
	$nomeUsuario = isset($_POST['nome']) ? $_POST['nome'] :'';	
	$sobrenomeUsuario = isset($_POST['sobrenome']) ? $_POST['sobrenome'] :'';		
	$cargo = isset($_POST['cargo']) ? $_POST['cargo'] :'';	
	$emailUsuario = isset($_POST['email']) ? $_POST['email'] :'';	
	$estado = isset($_POST['estado']) ? $_POST['estado'] :'';
	$municipio = isset($_POST['municipio']) ? $_POST['municipio'] :'';	
	$dddUsuario = isset($_POST['ddd']) ? $_POST['ddd'] :'';
	$telefoneUsuario = isset($_POST['telefone']) ? $_POST['telefone'] :'';	
	$senha = isset($_POST['senha']) ? $_POST['senha'] :'';	
	$confirmaSenha = isset($_POST['confirmaSenha']) ? $_POST['confirmaSenha'] :'';	
	$cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] :'';	
	$razaoSocial = isset($_POST['razaoSocial']) ? $_POST['razaoSocial'] :'';	
	$areaUsuario= isset($_POST['areaAtuacao']) ? $_POST['areaAtuacao'] :'';		
	$especifique= isset($_POST['especifique']) ? $_POST['especifique'] :'';		
	$cep = isset($_POST['cep']) ? $_POST['cep'] :'';	
	$endereco = isset($_POST['endereco']) ? $_POST['endereco'] :'';
	$codPerfilUsuario = isset($_POST['codPerfilUsuario']) ? $_POST['codPerfilUsuario'] :'';
	$cpfUsuario = isset($_POST['cpf']) ? $_POST['cpf'] :'';
	
	
}
	$senhaCriptografada = $criptografar->setCriptografarSenha($senha);
	
	
	//cadastra responsável
	$dadosUsuario = array();
	
	$dadosUsuario[1] = $emailUsuario; 
	$dadosUsuario[2] = $nomeUsuario.' '.$sobrenomeUsuario;
	$dadosUsuario[3] = $cargo;
	$dadosUsuario[4] = $dddUsuario.'-'.$telefoneUsuario;
	$dadosUsuario[5] = $municipio;
	$dadosUsuario[6] = $senhaCriptografada;
	$dadosUsuario[7] = $tipoUsuario;
	$dadosUsuario[8] = $cnpj; 
	$dadosUsuario[9] = $razaoSocial;
	$dadosUsuario[10] = $cep;
	$dadosUsuario[11] = $endereco;
	$dadosUsuario[12] = $areaUsuario;
	$dadosUsuario[13] = $especifique;
	$dadosUsuario[14] = $codPerfilUsuario;
	$dadosUsuario[15] = $cpfUsuario;
	
/**	
	$cont = 1;
	while($cont<14){
		echo $cont.'. '.$dadosUsuario[$cont].'<br>';
		$cont = $cont + 1;
		} 
	**/
	
$resultadoUsuario = $tabUsuarios->cadastrar_usuario($dadosUsuario);
	
echo 'REsultado gravacao: '.$resultadoUsuario.'<br>';


	if($resultadoResp=1){
		header("Location: ../seguranca/valida.php?usuario=".$emailUsuario."&senha=".$senha."");	

	}else{
		echo 'erro ao gravar';
		header("Location: ../../index.php");
	}	




?>
</html>