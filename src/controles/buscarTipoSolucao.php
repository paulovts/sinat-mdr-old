<?php
include("../../require/class/Opc_tipoSolucao.class.php");
try{
$opcTipoSolucao= new Opc_tipoSolucao;

$codSolucao = $_GET['codSolucao'];	

$stmTipoSolucao = $opcTipoSolucao->listarTipoSolucao_sistema($codSolucao);
//$comboTipo = array();
	
$linhas = 0;

	foreach($stmTipoSolucao as $dadosTipoSolucao){
		$comboTipoSolucao[$linhas][0] =  $dadosTipoSolucao['cod_tipo_solucao'];
		$comboTipoSolucao[$linhas][1] =  $dadosTipoSolucao['txt_tipo_solucao']; 
		$comboTipoSolucao[$linhas][2] =  $dadosTipoSolucao['num_ordem_solucao']; 
		$linhas +=1;
	}		
			echo json_encode($comboTipoSolucao);
			
		} catch( PDOExecption $e ) { 
			echo $e->getMessage();
		} catch( Exception $ex ) { 
			echo $this->pack('dbError', $ex->getMessage()); 
		
	}



?>