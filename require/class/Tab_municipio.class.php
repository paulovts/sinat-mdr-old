<?php
require_once"ConDBCorporativo.class.php"; //require_once"ConDBCorporativo.class.php"


class Tab_municipio extends ConDBCorporativo{

public function listarMunicipioUF($UF){
	try{
		$conn = $this->getConn();
		$resultado = '';
		$txt_sql = 'SELECT id_municipio, ds_municipio 
					  FROM ibge.tab_municipios, ibge.tab_uf
					  WHERE tab_municipios.id_uf = tab_uf.id_uf AND
					  SG_uf = :UF
					  ORDER BY ds_municipio;';
		$stm = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));
		$stm->bindValue('UF',$UF,PDO::PARAM_STR);
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

public function buscarMunicipio($codIBGE){
	try{
		$conn = $this->getConn();
		$resultado = '';
		$txt_sql = 'SELECT ds_municipio 
					  FROM ibge.tab_municipios
					  WHERE id_municipio = :codIBGE
					  ORDER BY ds_municipio;';
		$stm = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));
		$stm->bindValue('codIBGE',$codIBGE,PDO::PARAM_INT);
		$stm->execute();
		$stm->setFetchMode(PDO::FETCH_OBJ);
		while( $row = $stm->fetch()){
			$resultado = $row->ds_municipio;
			}
		
		return $resultado;
	} catch( PDOExecption $e ) { 
		return $e->getMessage();
	} catch( Exception $ex ) { 
		return $this->pack('dbError', $ex->getMessage()); 
	}
}


	

}
		



?>