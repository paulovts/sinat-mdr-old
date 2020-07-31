<?php
require_once"ConDBSnhDhab.class.php"; //require_once"ConDB.class.php"


class Tab_download_catDatec extends ConDBSnhDhab{
		
		
	public function cadastrar_downloadCatDatec($dados){
		try{ 
			$conn = $this->getConn();
			$txt_sql = 'INSERT INTO catalogodesempenho.tab_download_catal_datec(
						            cod_catalogo_datec, cod_usuario, num_ultima_versao, dte_data_download)
						VALUES (:codCatalogo, :codUsuario, :numUltimaVersao, now());';
			$statement = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));			
			$statement->bindValue('codCatalogo', $dados[1],PDO::PARAM_INT);
			$statement->bindValue('codUsuario', $dados[2],PDO::PARAM_INT);	
			$statement->bindValue('numUltimaVersao', $dados[3],PDO::PARAM_STR);
			
			$statement->execute();
		
			return $statement->rowCount();
		}catch(PDOException $e){
			return $this->pack('dbError', $e->getMessage());
		}catch(SQLException $ex){
			return $this->pack('dbError', $ex->getMessage());
		} 
	}
	
	public function atualizar_downloadCatDatec($dados){
		try{ 
			$conn = $this->getConn();
			$txt_sql = 'UPDATE catalogodesempenho.tab_download_catal_datec
					   SET dte_data_download=now()
					 WHERE cod_catalogo_datec = :codCatalogo AND cod_usuario = :codUsuario AND num_ultima_versao = :numUltimaVersao';
			$statement = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));			
			$statement->bindValue('codCatalogo', $dados[1],PDO::PARAM_INT);
			$statement->bindValue('codUsuario', $dados[2],PDO::PARAM_INT);	
			$statement->bindValue('numUltimaVersao', $dados[3],PDO::PARAM_STR);				
			$statement->execute();
		
			return $statement->rowCount();
		}catch(PDOException $e){
			return $this->pack('dbError', $e->getMessage());
		}catch(SQLException $ex){
			return $this->pack('dbError', $ex->getMessage());
		} 
	}
	
	public function consultar_downloadCatDatec($dados){
		try{ 
			$conn = $this->getConn();
			$txt_sql = 'SELECT cod_catalogo_datec, cod_usuario
  						FROM catalogodesempenho.tab_download_catal_datec
						WHERE cod_catalogo_datec = :codCatalogo AND cod_usuario = :codUsuario AND num_ultima_versao = :numUltimaVersao;';
			$statement = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));			
			$statement->bindValue('codCatalogo', $dados[1],PDO::PARAM_INT);
			$statement->bindValue('codUsuario', $dados[2],PDO::PARAM_INT);	
			$statement->bindValue('numUltimaVersao', $dados[3],PDO::PARAM_STR);		
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