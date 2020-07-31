<?php
require_once"ConDBSnhDhab.class.php"; //require_once"ConDBCorporativo.class.php"


class Opc_situacao_tipo_solucao extends ConDBSnhDhab{

public function listarSituacao(){
	try{
		$conn = $this->getConn();
		$resultado = '';
		$txt_sql = 'SELECT cod_situacao_tipo_solucao, txt_situacao_tipo_solucao
				    FROM catalogodesempenho.opc_situacao_tipo_solucao
					ORDER BY cod_situacao_tipo_solucao;';		
		$stm = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));
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