<?php
include("../../require/class/Tab_download_catConvencional.class.php");
include("../../require/class/Tab_catalogoConvencional.class.php");


$tabDownload = new Tab_download_catConvencional;
$tabCatalogo = new Tab_catalogoConvencional;

$numeroCat = $_GET['numero'];
$idUsuario = $_GET['idUsuario'];
$numUltimaRevisao = $tabCatalogo->buscar_ultima_revisao($numeroCat); 
$dados = array();
$dados[1] = $numeroCat;
$dados[2] = $idUsuario;
$dados[3] = $numUltimaRevisao;
//echo 'NUme catalogo: '.$numeroCat.'<br>';
//echo 'Id Usuario: '.$idUsuario.'<br>';
//echo 'NUme revisao: '.$numUltimaRevisao.'<br><br>';
$consultaDownload = $tabDownload->consultar_downloadCatConvencional($dados);
//echo 'Result consulta: '.$consultaDownload.'<br><br>';
if($consultaDownload==0){ 
	$resultado = $tabDownload->cadastrar_downloadCatConvencional($dados);
	if($resultado==0){
		$resultado = 'Erro ao cadastrar';
	}else if($resultado==1){
		$resultado = 'Cadastrado com sucesso';
	}
}else if($consultaDownload==1){  
	$resultado = $tabDownload->atualizar_downloadCatConvencional($dados);
	//echo 'Resultado class: '.$resultado.'<br><br>';
		if($resultado==0){
			$resultado = 'Erro ao atualizar';
		}else if($resultado==1){
			$resultado = 'Atualizado com sucesso';
		}
}
echo $resultado;

?>