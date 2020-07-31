<?php
require_once"ConDBSnhDhab.class.php"; //require_once"ConDBCorporativo.class.php"


class Opc_sistema extends ConDBSnhDhab{

public function listarSistema(){
	try{
		$conn = $this->getConn();
		$resultado = '';
		$txt_sql = 'SELECT cod_sistema, txt_sistema, txt_sigla_sistema
					  FROM catalogodesempenho.opc_sistema
					  ORDER BY txt_sistema;';
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

public function cadastrarSistema($dados){
	try{
		$conn = $this->getConn();
		$resultado = '';
		$txt_sql = 'INSERT INTO catalogodesempenho.opc_sistema(cod_sistema, txt_sistema, txt_descricao_sistema, txt_sigla_sistema)
					VALUES (DEFAULT, :nomeSistema, :descricaoSistema, :siglaSistema ) RETURNING cod_sistema;';
		$stm = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));
		$stm->bindValue('nomeSistema', empty($dados['nomeSistema'])? null : $dados['nomeSistema'],PDO::PARAM_STR);
		$stm->bindValue('descricaoSistema', empty($dados['siglaSistema'])? null : $dados['siglaSistema'],PDO::PARAM_STR);
		$stm->bindValue('siglaSistema', empty($dados['descricaoSistema'])? null : $dados['descricaoSistema'],PDO::PARAM_STR);
		$stm->execute();
		$result = array();
		$result = $stm->fetchAll(PDO::FETCH_ASSOC);			
		$ultimo_id = 0;
		foreach($result as $dadosSistema){
				$ultimo_id = $dadosSistema['cod_sistema'];	
				
				}
		return  $ultimo_id;
	} catch( PDOExecption $e ) { 
		return $e->getMessage();
	} catch( Exception $ex ) { 
		return $this->pack('dbError', $ex->getMessage()); 
	}
}




	

}
		



?>