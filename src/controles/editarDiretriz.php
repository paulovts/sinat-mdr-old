<html lang="pt-br">

<head>
	<meta charset="utf-8">
    
</head> 
 
<?php


require_once"../seguranca/seguranca.php";
require_once"../../require/class/Tab_diretriz.class.php";

$tabDiretriz = new Tab_diretriz;
$dadosRevisao = array();
$dadosAtualizaCatalogo = array();


		
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
// Salva duas vari�veis com o que foi digitado no formul�rio
// Detalhe: faz uma verifica��o com isset() pra saber se o campo foi preenchido
	$codDiretriz = isset($_POST['codDiretriz']) ? $_POST['codDiretriz'] :'';	
	$numDiretriz = isset($_POST['numDiretriz']) ? $_POST['numDiretriz'] :'';	
	$descricao = isset($_POST['descricao']) ? $_POST['descricao'] :'';
    $numUltRevisao = isset($_POST['numUltRevisao']) ? $_POST['numUltRevisao'] :'';
	$usuarioRevisao = isset($_SESSION['cod_usuario']) ? $_SESSION['cod_usuario'] :'';
	$alteracaoRealizada = isset($_POST['alteracaoRealizada']) ? $_POST['alteracaoRealizada'] :'';
	
}
	$codUsuario = $_SESSION['cod_usuario'];



$dadosRevisao[0] = $numUltRevisao; 
$dadosRevisao[1] = $codDiretriz;
$dadosRevisao[2] = $alteracaoRealizada;
$dadosRevisao[3] = $codUsuario; 

//configura o numero da diretriz e da revisao para o caminho do arquivo
if(strlen($codDiretriz)==1){
    $numDiretrizArq = '00'.$codDiretriz;
}else if(strlen($codDiretriz)==2){
    $numDiretrizArq = '0'.$codDiretriz;
 }   

if(strlen($numUltRevisao)==1){
    $numRevisaoArq = 'R00'.$numUltRevisao;
}else if(strlen($numUltRevisao)==2){
    $numRevisaoArq = 'R0'.$numUltRevisao;
}elseif(strlen($numUltRevisao)==3){
    $numRevisaoArq = 'R'.$numUltRevisao;
};

$nomeNovo = 'Diretriz_SINAT_'.$numDiretrizArq.'_'.$numRevisaoArq.'.pdf';
$caminhoArquivo = '_catalogos/inovador/diretriz/'.$nomeNovo;
echo 'caminho: '.$caminhoArquivo;


$resultadoRevisao = $tabDiretriz->cadastrar_revisaoDiretriz($dadosRevisao);

$dadosAtualizaDiretriz[0] = $descricao; 

$dadosAtualizaDiretriz[1] = $caminhoArquivo;
$dadosAtualizaDiretriz[2] = $numUltRevisao;
$dadosAtualizaDiretriz[3] = $codDiretriz; 

$resultadoAtaulizacaoDir = $tabDiretriz->alterar_Diretriz($dadosAtualizaDiretriz);
$resultadoArq = 0;
echo 'resultadoRevisao: '.$resultadoRevisao.'<br/>';
echo 'resultadoAtaulizacaoDir: '.$resultadoAtaulizacaoDir.'<br/>';
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
    if ($_FILES['userfile']['size'] > 10000000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }

	
	
   $filename = '../../_catalogos/inovador/diretriz/'.$nomeNovo;


    // You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    if (!move_uploaded_file(
        $_FILES['userfile']['tmp_name'],
        sprintf('../../_catalogos/inovador/diretriz/'.$nomeNovo.'',
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

    $resultado = $resultadoRevisao+$resultadoAtaulizacaoDir+$resultadoArq;
    header('Location: ../administrador/sistemaInovador/formAdmCatalogoInovador.php?resultadoDiretriz='.$resultado);
?>
</html>