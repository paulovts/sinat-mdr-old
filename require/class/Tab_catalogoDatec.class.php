<?php
require_once"ConDBSnhDhab.class.php"; //require_once"ConDB.class.php"


class Tab_catalogoDatec extends ConDBSnhDhab{

	public function json_catDatec(){
	try{
		$conn = $this->getConn();
		$resultado = '';
		$txt_sql = 'select json_agg(catalogos)
					from ( 
						SELECT tab_diretriz.cod_diretriz,
						    tab_diretriz.num_numero_diretriz,
							tab_diretriz.txt_descricao_diretriz, 
							tab_diretriz.num_ultima_revisao, 
							tab_diretriz.txt_caminho_arquivo,
							tab_diretriz.dte_data_pulicacao_diretriz,
							tab_diretriz.dte_data_edicao,
							json_agg(catalogodesempenho.tab_catalogo_datec.*) as jsonDatec	
						  FROM catalogodesempenho.tab_diretriz
						  LEFT JOIN catalogodesempenho.tab_catalogo_datec
						  ON tab_catalogo_datec.cod_diretriz = tab_diretriz.cod_diretriz 
						  GROUP BY tab_diretriz.cod_diretriz, tab_diretriz.txt_descricao_diretriz, tab_diretriz.num_ultima_revisao, 		tab_diretriz.txt_caminho_arquivo
						) as catalogos';
		$stm = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));
		$stm->execute();
		$stm->setFetchMode(PDO::FETCH_OBJ);
			while( $row = $stm->fetch()){
				$resultado = $row->json_agg;
				}		
			
		return $resultado;
	} catch( PDOExecption $e ) { 
		return $e->getMessage();
	} catch( Exception $ex ) { 
		return $this->pack('dbError', $ex->getMessage()); 
	}

	}
		
	public function buscar_ultima_revisao($numCatalogo){
		try{ 
			$conn = $this->getConn();
			$txt_sql = 'SELECT txt_ultima_versao
						  FROM catalogodesempenho.tab_catalogo_datec
						  WHERE cod_catalogo_datec = :numCatalogo;';
			$statement = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));			
			$statement->bindValue('numCatalogo', $numCatalogo,PDO::PARAM_INT);
			$statement->execute();
			$statement->setFetchMode(PDO::FETCH_OBJ);
			while( $row = $statement->fetch()){
				$resultado = $row->txt_ultima_versao;
				}			
			return $resultado;
		}catch(PDOException $e){
			return $this->pack('dbError', $e->getMessage());
		}catch(SQLException $ex){
			return $this->pack('dbError', $ex->getMessage());
		} 
	}
		
	public function buscar_DatecVinculadas($codDiretriz){
		try{ 
			$conn = $this->getConn();
			$txt_sql = 'SELECT num_cod_ficha
						FROM catalogodesempenho.tab_catalogo_datec
						WHERE cod_diretriz = :codDiretriz;';
			$statement = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));			
			$statement->bindValue('codDiretriz', $codDiretriz,PDO::PARAM_INT);
			$statement->execute();
			$statement->setFetchMode(PDO::FETCH_OBJ);
			while( $row = $statement->fetch()){
				$resultado += substr($row->num_cod_ficha, 0,-3);
				}			
			return $resultado;
		}catch(PDOException $e){
			return $this->pack('dbError', $e->getMessage());
		}catch(SQLException $ex){
			return $this->pack('dbError', $ex->getMessage());
		} 
	}
		
}

?>