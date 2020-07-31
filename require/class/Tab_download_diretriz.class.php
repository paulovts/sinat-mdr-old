<?php
require_once"ConDBSnhDhab.class.php"; //require_once"ConDB.class.php"


class Tab_download_diretriz extends ConDBSnhDhab{
		
		
	public function cadastrar_downloadDiretriz($dados){
		try{ 
			$conn = $this->getConn();
			$txt_sql = 'INSERT INTO catalogodesempenho.tab_download_diretriz(
						            cod_diretriz, cod_usuario, num_ultima_revisao, dte_data_download)
						VALUES (:codDiretriz, :codUsuario, :numUltimaRevisao, now());';
			$statement = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));			
			$statement->bindValue('codDiretriz', $dados[1],PDO::PARAM_INT);
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
	
	public function atualizar_downloadDiretriz($dados){
		try{ 
			$conn = $this->getConn();
			$txt_sql = 'UPDATE catalogodesempenho.tab_download_diretriz
					   SET dte_data_download=now()
					 WHERE cod_diretriz = :codDiretriz AND cod_usuario = :codUsuario AND num_ultima_revisao = :numUltimaRevisao';
			$statement = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));			
			$statement->bindValue('codDiretriz', $dados[1],PDO::PARAM_INT);
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
	
	public function consultar_downloadDiretriz($dados){
		try{ 
			$conn = $this->getConn();
			$txt_sql = 'SELECT cod_diretriz, cod_usuario
  						FROM catalogodesempenho.tab_download_diretriz
						WHERE cod_diretriz = :codDiretriz AND cod_usuario = :codUsuario AND num_ultima_revisao = :numUltimaRevisao;';
			$statement = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));			
			$statement->bindValue('codDiretriz', $dados[1],PDO::PARAM_INT);
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