<?php
require_once"ConDBSnhDhab.class.php"; //require_once"ConDB.class.php"


class Tab_diretriz extends ConDBSnhDhab{
		
		
	public function buscar_ultima_revisao($numCatalogo){
		try{ 
			$conn = $this->getConn();
			$txt_sql = 'SELECT num_ultima_revisao
						  FROM catalogodesempenho.tab_diretriz
						  WHERE cod_diretriz = :codDiretriz;';
			$statement = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));			
			$statement->bindValue('codDiretriz', $numCatalogo,PDO::PARAM_INT);
			$statement->execute();
			$statement->setFetchMode(PDO::FETCH_OBJ);
			while( $row = $statement->fetch()){
				$resultado = $row->num_ultima_revisao;
				}			
			return $resultado;
		}catch(PDOException $e){
			return $this->pack('dbError', $e->getMessage());
		}catch(SQLException $ex){
			return $this->pack('dbError', $ex->getMessage());
		} 
	}

	public function cadastrar_revisaoDiretriz($dados){
		try { 
			$conn = $this->getConn();
			$sql = 'INSERT INTO catalogodesempenho.tab_revisao_diretriz(num_revisao_diretriz, cod_diretriz, bln_enviar_email, 
								dte_data_revisao, txt_alteracao_realizada, cod_usuario_revisao)
    				VALUES (:numUltRevisao, :cod_diretriz, TRUE, :dataInclusao,  :alteracaoRealizada, :codUsuario)';	
			$statement = $conn->prepare($sql)  OR die(implode('',$conn->errorInfo())); 
			$statement->bindParam(":numUltRevisao", $dados[0], PDO::PARAM_INT); 
    		$statement->bindParam(":cod_diretriz", $dados[1], PDO::PARAM_INT); 
    		$data_inclusao = date("Y-m-d");
			$statement->bindParam(":dataInclusao", $data_inclusao, PDO::PARAM_STR);
    		$statement->bindParam(":alteracaoRealizada", $dados[2], PDO::PARAM_STR);
			$statement->bindParam(":codUsuario", $dados[3], PDO::PARAM_INT); 
			$statement->execute();
			 return $statement->rowCount();  
				
			
		} catch( PDOExecption $e ) { 
			return $e->getMessage();
		} catch( Exception $ex ) { 
			return $this->pack('dbError', $ex->getMessage()); 
		}
	}
		
	public function alterar_Diretriz($dados){
		try { 
			$conn = $this->getConn();
			$sql = 'UPDATE catalogodesempenho.tab_diretriz
				    SET txt_descricao_diretriz=:descricao, num_ultima_revisao=:numUltRevisao, 
				        txt_caminho_arquivo=:caminhoArquivo, dte_data_edicao=:dataEdicao
					WHERE cod_diretriz=:cod_diretriz';	
			$statement = $conn->prepare($sql)  OR die(implode('',$conn->errorInfo())); 
    		$statement->bindParam(":descricao", $dados[0], PDO::PARAM_INT); 
    		$data_edicao = date("Y-m-d");
			$statement->bindParam(":dataEdicao", $data_edicao, PDO::PARAM_STR);
    		$statement->bindParam(":caminhoArquivo", $dados[1], PDO::PARAM_STR);
			$statement->bindParam(":numUltRevisao", $dados[2], PDO::PARAM_INT); 
			$statement->bindParam(":cod_diretriz", $dados[3], PDO::PARAM_STR); 
			$statement->execute();
			 return $statement->rowCount();  
				
			
		} catch( PDOExecption $e ) { 
			return $e->getMessage();
		} catch( Exception $ex ) { 
			return $this->pack('dbError', $ex->getMessage()); 
		}
	}	
}

?>