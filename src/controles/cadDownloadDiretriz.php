<?php
include("../../require/class/Tab_download_diretriz.class.php");
include("../../require/class/Tab_diretriz.class.php");


$tabDownload = new Tab_download_diretriz;
$tabDiretriz = new Tab_diretriz;

$numeroDiretriz = $_GET['numero'];
$idUsuario = $_GET['idUsuario'];
$numUltimaRevisao = $tabDiretriz->buscar_ultima_revisao($numeroDiretriz); 
$dados = array();
$dados[1] = $numeroDiretriz;
$dados[2] = $idUsuario;
$dados[3] = $numUltimaRevisao;
//echo 'NUme catalogo: '.$numeroCat.'<br>';
//echo 'Id Usuario: '.$idUsuario.'<br>';
//echo 'NUme revisao: '.$numUltimaRevisao.'<br><br>';
$consultaDownload = $tabDownload->consultar_downloadDiretriz($dados);
//echo 'Result consulta: '.$consultaDownload.'<br><br>';
if($consultaDownload==0){ 
	$resultado = $tabDownload->cadastrar_downloadDiretriz($dados);
	if($resultado==0){
		$resultado = 'Erro ao cadastrar';
	}else if($resultado==1){
		$resultado = 'Cadastrado com sucesso';
	}
}else if($consultaDownload==1){  
	$resultado = $tabDownload->atualizar_downloadDiretriz($dados);
	//echo 'Resultado class: '.$resultado.'<br><br>';
		if($resultado==0){
			$resultado = 'Erro ao atualizar';
		}else if($resultado==1){
			$resultado = 'Atualizado com sucesso';
		}
}
echo $resultado;

?>