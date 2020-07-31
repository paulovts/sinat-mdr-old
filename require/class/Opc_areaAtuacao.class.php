<?php
require_once"ConDBSnhDhab.class.php"; //require_once"ConDBCorporativo.class.php"


class Opc_areaAtuacao extends ConDBSnhDhab{

public function listarAreaAtuacao(){
	try{
		$conn = $this->getConn();
		$resultado = '';
		$txt_sql = 'SELECT cod_area_atuacao, txt_area_atuacao
					FROM catalogodesempenho.opc_area_atuacao
					ORDER BY txt_area_atuacao;';
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