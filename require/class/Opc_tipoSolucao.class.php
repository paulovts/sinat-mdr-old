<?php
require_once"ConDBSnhDhab.class.php"; //require_once"ConDBCorporativo.class.php"


class Opc_tipoSolucao extends ConDBSnhDhab{

public function listarTipoSolucao_sistema($codSolucao){
	try{
		$conn = $this->getConn();
		$resultado = '';
		$txt_sql = 'SELECT cod_tipo_solucao, txt_tipo_solucao, num_ordem_solucao
					FROM catalogodesempenho.opc_tipo_solucao
					WHERE cod_solucao = :codSolucao
					ORDER BY num_ordem_solucao;';
		$stm = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));
		$stm->bindValue('codSolucao',$codSolucao,PDO::PARAM_INT);
		$stm->execute();
		$result = array();
		$result = $stm->fetchAll(PDO::FETCH_ASSOC);			
		return $result;
	} catch( PDOExecption $e ) { 
		return $e->getMessage();
	} catch( Exception $ex ) { 
		return $this->pack('dbError', $ex->getMessage()); 
	}
}

public function buscarDescricaoTipoSol($codTipoSolucao){
	try{
		$conn = $this->getConn();
		$resultado = '';
		$txt_sql = 'SELECT txt_descricao_tipo_solucao
					FROM catalogodesempenho.opc_tipo_solucao
					WHERE cod_tipo_solucao = :codTipoSolucao';
		$stm = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));
		$stm->bindValue('codTipoSolucao',$codTipoSolucao,PDO::PARAM_INT);
		$stm->execute();
		$result = array();
		$result = $stm->fetchAll(PDO::FETCH_ASSOC);			
		return $result;
	} catch( PDOExecption $e ) { 
		return $e->getMessage();
	} catch( Exception $ex ) { 
		return $this->pack('dbError', $ex->getMessage()); 
	}
}	

}
?>