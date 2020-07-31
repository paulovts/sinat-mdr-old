<?php
require_once"ConDBSnhDhab.class.php"; //require_once"ConDB.class.php"


class Tab_download_catConvencional extends ConDBSnhDhab{
		
		
	public function cadastrar_downloadCatConvencional($dados){
		try{ 
			$conn = $this->getConn();
			$txt_sql = 'INSERT INTO catalogodesempenho.tab_download_catal_convencional(
								cod_catalogo_convencional, cod_usuario, num_ultima_revisao, dte_data_download)
						VALUES (:codCatalogo, :codUsuario, :numUltimaRevisao, now());';
			$statement = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));			
			$statement->bindValue('codCatalogo', $dados[1],PDO::PARAM_INT);
			$statement->bindValue('codUsuario', $dados[2],PDO::PARAM_INT);	
			$statement->bindValue('numUltimaRevisao', $dados[3],PDO::PARAM_INT);
			
			$statement->execute();
		
			return $statement->rowCount();
		}catch(PDOException $e){
			return $this->pack('dbError', $e->getMessage());
		}catch(SQLException $ex){
			return $this->pack('dbError', $ex->getMessage());
		} 
	}
	
	public function atualizar_downloadCatConvencional($dados){
		try{ 
			$conn = $this->getConn();
			$txt_sql = 'UPDATE catalogodesempenho.tab_download_catal_convencional
					   SET dte_data_download=now()
					 WHERE cod_catalogo_convencional = :codCatalogo AND cod_usuario = :codUsuario AND num_ultima_revisao = :numUltimaRevisao';
			$statement = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));			
			$statement->bindValue('codCatalogo', $dados[1],PDO::PARAM_INT);
			$statement->bindValue('codUsuario', $dados[2],PDO::PARAM_INT);	
			$statement->bindValue('numUltimaRevisao', $dados[3],PDO::PARAM_INT);				
			$statement->execute();
		
			return $statement->rowCount();
		}catch(PDOException $e){
			return $this->pack('dbError', $e->getMessage());
		}catch(SQLException $ex){
			return $this->pack('dbError', $ex->getMessage());
		} 
	}
	
	public function consultar_downloadCatConvencional($dados){
		try{ 
			$conn = $this->getConn();
			$txt_sql = 'SELECT cod_catalogo_convencional, cod_usuario
  						FROM catalogodesempenho.tab_download_catal_convencional
						WHERE cod_catalogo_convencional = :codCatalogo AND cod_usuario = :codUsuario AND num_ultima_revisao = :numUltimaRevisao;';
			$statement = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));			
			$statement->bindValue('codCatalogo', $dados[1],PDO::PARAM_INT);
			$statement->bindValue('codUsuario', $dados[2],PDO::PARAM_INT);	
			$statement->bindValue('numUltimaRevisao', $dados[3],PDO::PARAM_INT);		
			$statement->execute();		
			return $statement->rowCount();
		}catch(PDOException $e){
			return $this->pack('dbError', $e->getMessage());
		}catch(SQLException $ex){
			return $this->pack('dbError', $ex->getMessage());
		} 
	}
		
}

?>