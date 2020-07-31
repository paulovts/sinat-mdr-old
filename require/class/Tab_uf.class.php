<?php
require_once"ConDBSnhDhab.class.php"; //require_once"ConDBCorporativo.class.php"


class Tab_uf extends ConDBSnhDhab{

public function listarUF(){
	try{
		$conn = $this->getConn();
		$resultado = '';
		$txt_sql = 'SELECT id_uf, sg_uf, ds_uf
					FROM ibge.tab_uf
					ORDER BY ds_uf;';
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

public function buscarUF($codUF){
	try{
		$conn = $this->getConn();
		$resultado = '';
		$txt_sql = 'SELECT sg_uf
					FROM ibge.tab_uf
					WHERE id_uf = :codUF;';
		$stm = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));
		$stm->bindValue('codUF', $codUF,PDO::PARAM_INT);
		$stm->execute();
		$stm->setFetchMode(PDO::FETCH_OBJ);
		while( $row = $stm->fetch()){
			$resultado = $row->sg_uf;
			}
		
		return $resultado;
	} catch( PDOExecption $e ) { 
		return $e->getMessage();
	} catch( Exception $ex ) { 
		return $this->pack('dbError', $ex->getMessage()); 
	}
}

public function buscarRegiao($UF){
	try{
		$conn = $this->getConn();
		$resultado = '';
		$txt_sql = 'SELECT 
					  DISTINCT tab_regiao.ds_regiao
					FROM 
					  ibge.tab_uf, 
					  ibge.tab_regiao
					WHERE 
					  tab_regiao.id_regiao = tab_uf.id_regiao AND
					  tab_uf.sg_uf like :uf;';
		$stm = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));
		$stm->bindValue('uf', $UF,PDO::PARAM_STR);
		$stm->execute();
		$stm->setFetchMode(PDO::FETCH_OBJ);
		while( $row = $stm->fetch()){
			$resultado = $row->ds_regiao;
			}
		
		return $resultado;
	} catch( PDOExecption $e ) { 
		return $e->getMessage();
	} catch( Exception $ex ) { 
		return $this->pack('dbError', $ex->getMessage()); 
	}
}

	public function buscarUF_Nome($UF){
	try{
		$conn = $this->getConn();
		$resultado = '';
		$txt_sql = 'SELECT ds_uf
					FROM ibge.tab_uf
					WHERE sg_uf LIKE :UF;';
		$stm = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));
		$stm->bindValue('UF', $UF,PDO::PARAM_STR);
		$stm->execute();
		$stm->setFetchMode(PDO::FETCH_OBJ);
		while( $row = $stm->fetch()){
			$resultado = $row->ds_uf;
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