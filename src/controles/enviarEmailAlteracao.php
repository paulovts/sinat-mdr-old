<?php

require_once"../../require/class/Tab_usuarios.class.php";
require_once"../../require/class/CriptografarSenha.class.php";
require_once('../../require/class/class.phpmailer.php');

header('Content-Type: text/html; charset=UTF-8');

$tabUsuario = new Tab_usuarios;
$cript = new CriptografarSenha;

$emailEsqueci = $_POST['emailEsqueci'];
$stmUsuario = $tabUsuario->buscar_usuario($emailEsqueci);
foreach ($stmUsuario as $dadosUsuario) {
	$codUrl = $cript->setCriptografarSenha($dadosUsuario['txt_cpf_usuario']);
	$nomeUsuario = $dadosUsuario['txt_nome'];
	$emailUsuario = $dadosUsuario['txt_email'];
}

/** Inicioi torina email**/

$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->SMTPDebug = 1;
$mailer->Port = 25; //Indica a porta de conexÃ£o para a saÃ­da de e-mails. Utilize obrigatoriamente a porta 587.
$mailer->Host = 'mail-apl.serpro.gov.br'; //Onde em 'servidor_de_saida' deve ser alterado por um dos hosts abaixo:
 

$mailer->Username = 'pbqp-h@cidades.gov.br'; //Informe o e-mai o completo
$mailer->SMTPAuth = false;

$mailer->FromName = 'Programa Brasileiro da Qualidade e Produtividade do Habitat'; //Nome que serÃ¡ exibido para o destinatÃ¡rio
$mailer->From = 'pbqp-h@cidades.gov.br';
$mailer->ReplayTo = 'pbqp-h@cidades.gov.br';// E-mail que receberÃ¡ a resposta quando se clicar no 'Responder' de seu leitor de e-mails
$mailer->AddAddress($emailEsqueci); //DestinatÃ¡rios
$mailer->Subject = 'Redefinir senha - PBQP-H';
$mailer->Body = 'REDEFINIR SENHA PARA O SISTEMA DESEMPENHO TÉCNICO PARA HIS

		Prezado(a) '.$nomeUsuario.'
                
                Clique no link abaixo para redefinir sua senha ou copie e cole o link no seu navegador
				http://app.cidades.gov.br/catalogo/src/paginas/cadNovaSenha.php?codigo='.$codUrl.'
                
                Você não solicitou a alteração de sua senha? Então ignore este e-mail.
                E se você tiver alguma dúvida, teremos prazer em ajudar. Entre em contato conosco pelo telefone 61-2108-1794 quando quiser.
                
                Atenciosamente,
                
                
                Programa Brasileiro da Qualidade e Produtividade do Habitat - PBQP-H';

if(!$mailer->Send())
{
    echo 'http://app.cidades.gov.br/catalogo/src/paginas/cadNovaSenha.php?codigo='.$codUrl.'<br>';
	echo "Mensagem nao enviada! Erro: " . $mailer->ErrorInfo; 
	exit; 
}


header("Location: ../../index.php");


/** Final torina email**/











	
?>
