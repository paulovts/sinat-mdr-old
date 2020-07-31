<?php
/* Sistema de segurança com acesso restrito
*
* Usado para restringir o acesso de certas páginas do seu site
*
* @author Thiago Belem <contato@thiagobelem.net>
* @link http://thiagobelem.net/
*
* @version 1.0
* @package SistemaSeguranca
*/
 
//  Configurações do Script
// ==============================
$_SG['conectaServidor'] = true;    // Abre uma conexão com o servidor MySQL?
$_SG['abreSessao'] = true;         // Inicia a sessão com um session_start()?
 
$_SG['caseSensitive'] = false;     // Usar case-sensitive? Onde 'thiago' é diferente de 'THIAGO'
 
$_SG['validaSempre'] = true;       // Deseja validar o usuário e a senha a cada carregamento de página?
// Evita que, ao mudar os dados do usuário no banco de dado o mesmo contiue logado.
 
$_SG['servidor'] = 'boavista:5432';    // Servidor MySQL
$_SG['usuario'] = 'sys.snh_dhab';          // Usuário MySQL
$_SG['senha'] = '#BDsyssnhdh@b#';                // Senha MySQL
$_SG['banco'] = 'snh_dhab';            // Banco de dados MySQL
 

 
$_SG['tabela'] = 'catalogodesempenho.tab_usuario';       // Nome da tabela onde os usuários são salvos
// ==============================

// ======================================
//   ~ Não edite a partir deste ponto ~
// ======================================

// Verifica se precisa fazer a conexão com o MySQL
if ($_SG['conectaServidor'] == true) {
	$_SG['link'] = @pg_connect("dbname=sinat host=192.168.10.113 port=5432 user=postgres password=pg01") or die("PostGreSQL: Não foi possível conectar-se ao servidor [".$_SG['servidor']."].");

}
 
// Verifica se precisa iniciar a sessão
if ($_SG['abreSessao'] == true) {
session_start();
}
 
/**
* Função que valida um usuário e senha
*
* @param string $usuario - O usuário a ser validado
* @param string $senha - A senha a ser validada
*
* @return bool - Se o usuário foi validado ou não (true/false)
*/
function validaUsuario($usuario, $senha) {
global $_SG;
 
$cS = ($_SG['caseSensitive']) ? 'BINARY' : '';


// Usa a função addslashes para escapar as aspas
$nusuario = addslashes($usuario);
$nsenha = md5(hash('whirlpool',hash('sha256',hash('whirlpool',(addslashes($senha))))));
//md5((addslashes($senha)));

 
// Monta uma consulta SQL (query) para procurar um usuário
$sql = "SELECT cod_usuario, 
       txt_email, 
       txt_nome, 
       txt_senha,
	   cod_perfil_usuario
  	FROM catalogodesempenho.tab_usuario
	WHERE txt_email LIKE '".$nusuario."' AND txt_senha LIKE '".$nsenha."' LIMIT 1";

$query = pg_query($sql);
$resultado = pg_fetch_assoc($query);

 
// Verifica se encontrou algum registro
if (empty($resultado)) {
// Nenhum registro foi encontrado => o usuário é inválido
return false;
 
} else {
// O registro foi encontrado => o usuário é valido
 
// Definimos dois valores na sessão com os dados do usuário
$_SESSION['txt_email'] = $resultado['txt_email'];
$_SESSION['txt_nome'] = $resultado['txt_nome'];
$_SESSION['cod_usuario'] = $resultado['cod_usuario'];
$_SESSION['cod_perfil_usuario'] = $resultado['cod_perfil_usuario'];
 
// Verifica a opção se sempre validar o login
if ($_SG['validaSempre'] == true) {
// Definimos dois valores na sessão com os dados do login
$_SESSION['usuarioLogin'] = $usuario;
$_SESSION['usuarioSenha'] = $senha;
}
 
return true;
} 

}
 
/**
* Função que protege uma página
*/
function protegePagina() {
	global $_SG;
 
	if (!isset($_SESSION['cod_usuario']) OR !isset($_SESSION['txt_nome'])) {
	// Não há usuário logado, manda pra página de login
	expulsaVisitante();
	} else if (!isset($_SESSION['cod_usuario']) OR !isset($_SESSION['txt_nome'])) {
	// Há usuário logado, verifica se precisa validar o login novamente
		if ($_SG['validaSempre'] == true) {
		// Verifica se os dados salvos na sessão batem com os dados do banco de dados		
			if (!validaUsuario($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha'])) {
			// Os dados não batem, manda pra tela de login
			expulsaVisitante();			
			}	
		}
		
	}
}
 
/**
* Função para expulsar um visitante
*/
function expulsaVisitante() {
global $_SG;
 
// Remove as variáveis da sessão (caso elas existam)
unset($_SESSION['usuarioID'], $_SESSION['usuarioNome'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);
echo 'Expulsa 3';
// Manda pra tela de login
header("Location: ../../index.php");
}
?>