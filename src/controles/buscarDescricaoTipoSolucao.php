<?php
include("../../require/class/Opc_tipoSolucao.class.php");
header('Content-Type: text/html; charset=UTF-8');
try{
$opcTipoSolucao= new Opc_tipoSolucao;

$codTipoSolucao = $_GET['codTipoSolucao'];	

$stmTipoSolucao = $opcTipoSolucao->buscarDescricaoTipoSol($codTipoSolucao);
//$comboTipo = array();
	
$linhas = 0;

	foreach($stmTipoSolucao as $dadosTipoSolucao){
		$descricaoTipoSolucao[$linhas][0] =  $dadosTipoSolucao['txt_descricao_tipo_solucao'];
		$linhas +=1;
	}		
			echo json_encode($descricaoTipoSolucao);
			
		} catch( PDOExecption $e ) { 
			echo $e->getMessage();
		} catch( Exception $ex ) { 
			echo $this->pack('dbError', $ex->getMessage()); 
		
	}



?>