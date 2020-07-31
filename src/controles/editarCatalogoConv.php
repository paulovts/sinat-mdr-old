<html lang="pt-br">

<head>
	<meta charset="utf-8">
    
</head> 
 
<?php


require_once"../seguranca/seguranca.php";
require_once"../../require/class/Tab_catalogoConvencional.class.php";

$tabCatalogo = new Tab_catalogoConvencional;
$dadosRevisao = array();
$dadosAtualizaCatalogo = array();


		
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
// Salva duas vari�veis com o que foi digitado no formul�rio
// Detalhe: faz uma verifica��o com isset() pra saber se o campo foi preenchido
	$codCatalogo = isset($_POST['codCatalogo']) ? $_POST['codCatalogo'] :'';	
	$situacaoNova = isset($_POST['situacaoNova']) ? $_POST['situacaoNova'] :'';	
	$codFichaAtual = isset($_POST['codFichaAtual']) ? $_POST['codFichaAtual'] :'';
	$codFichaNovo = isset($_POST['codFichaNovo']) ? $_POST['codFichaNovo'] :'';
	$numUltRevisao = isset($_POST['numUltRevisao']) ? $_POST['numUltRevisao'] :'';
	$usuarioRevisao = isset($_SESSION['cod_usuario']) ? $_SESSION['cod_usuario'] :'';
	$alteracaoRealizada = isset($_POST['alteracaoRealizada']) ? $_POST['alteracaoRealizada'] :'';
	$descricao = isset($_POST['descricao']) ? $_POST['descricao'] :'';
}
	$codUsuario = $_SESSION['cod_usuario'];



$dadosRevisao[0] = $numUltRevisao; 
$dadosRevisao[1] = $codCatalogo;
$dadosRevisao[2] = $alteracaoRealizada;
$dadosRevisao[3] = $codUsuario; 

$resultadoRevisao = $tabCatalogo->cadastrar_revisaoCatConv($dadosRevisao);

$dadosAtualizaCatalogo[0] = $codFichaNovo; 
$caminhoArquivo = '_catalogos/convencional/'.$codFichaNovo.'.pdf';
$dadosAtualizaCatalogo[1] = $caminhoArquivo;
$dadosAtualizaCatalogo[2] = $numUltRevisao;
$dadosAtualizaCatalogo[3] = $codCatalogo; 

$resultadoAtaulizacaoCat = $tabCatalogo->alterar_CatConv($dadosAtualizaCatalogo);

//echo 'resultadoRevisao: '.$resultadoRevisao.'<br/>';
//echo 'resultadoAtaulizacaoCat: '.$resultadoAtaulizacaoCat.'<br/>';
//echo $codCatalogo.'<br/>';


try {
 //define os tipos permitidos
 $tipos[0]=".pdf";  
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES['userfile']['error']) ||
        is_array($_FILES['userfile']['error'])
    ) {
        throw new RuntimeException('Invalid parameters.');
    }

    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['userfile']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }

    // You should also check filesize here.
    if ($_FILES['userfile']['size'] > 1000000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }

	
	$nomeNovo = $codFichaNovo.'.pdf';
   $filename = '../../_catalogos/convencional/'.$nomeNovo;


    // You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    if (!move_uploaded_file(
        $_FILES['userfile']['tmp_name'],
        sprintf('../../_catalogos/convencional/'.$nomeNovo.'',
            sha1_file($_FILES['userfile']['tmp_name']),
            'pdf'
        )
    )) {
        throw new RuntimeException('Falha ao mover arquivo enviado.');
    }else{
        $resultadoArq = 1;
    }
} catch (RuntimeException $e) {

    echo $e->getMessage();
}

    $resultado = $resultadoRevisao+$resultadoAtaulizacaoCat+$resultadoArq;
    header('Location: ../administrador/sistemaConvencional/formAdmCatalogoConvencional.php?resultado='.$resultado);
?>
</html>