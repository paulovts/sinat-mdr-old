<?php
include("../../require/class/Tab_municipio.class.php");
header('Content-Type: text/html; charset=UTF-8');
try{
$tabMunicipio = new Tab_municipio;

$UF = $_GET['UF'];	

$stmMunicipo = $tabMunicipio->listarMunicipioUF($UF);
//$comboTipo = array();
	
$linhas = 0;

	foreach($stmMunicipo as $dadosMunicipo){
		$comboMunicipio[$linhas][0] =  $dadosMunicipo['id_municipio'];
		$comboMunicipio[$linhas][1] =  $dadosMunicipo['ds_municipio']; 
		$linhas +=1;
	}		
			echo json_encode($comboMunicipio);
			
		} catch( PDOExecption $e ) { 
			echo $e->getMessage();
		} catch( Exception $ex ) { 
			echo $this->pack('dbError', $ex->getMessage()); 
		
	}



?>