<?php
require_once"ConDBSnhDhab.class.php"; //require_once"ConDB.class.php"


class Tab_catalogoConvencional extends ConDBSnhDhab{
		
	public function json_catConvencional(){
		try{	
		$conn = $this->getConn();
		$resultado = '';
		$txt_sql = 'SELECT json_agg(catalogos) as txt_json
					from ( 
						 SELECT 
						  opc_sistema.txt_sistema AS sistema, 
						  opc_sistema.txt_sigla_sistema, 
						  opc_solucao.txt_solucao AS solucao,
						  opc_solucao.txt_sigla_solucao,
						  opc_tipo_solucao.txt_tipo_solucao AS tiposolucao,
						  opc_tipo_solucao.num_ordem_solucao,
						  opc_tipo_solucao.txt_descricao_tipo_solucao AS descricao,
						  tab_catalogo_convencional.cod_catalogo_convencional AS numero,    
						  tab_catalogo_convencional.txt_caminho_arquivo AS url, 
						  opc_situacao_tipo_solucao.txt_situacao_tipo_solucao AS situacao,
						  tab_catalogo_convencional.dte_data_edicao,
						  tab_catalogo_convencional.num_ultima_revisao,
						  tab_catalogo_convencional.txt_cod_ficha,
						  opc_situacao_tipo_solucao.cod_situacao_tipo_solucao as codsituacao
						FROM 
						  catalogodesempenho.opc_sistema, 
						  catalogodesempenho.opc_solucao, 
						  catalogodesempenho.opc_tipo_solucao, 
						  catalogodesempenho.tab_catalogo_convencional, 
						  catalogodesempenho.opc_situacao_tipo_solucao
						WHERE 
						  opc_sistema.cod_sistema = opc_solucao.cod_sistema AND
						  opc_solucao.cod_solucao = opc_tipo_solucao.cod_solucao AND
						  tab_catalogo_convencional.cod_tipo_solucao = opc_tipo_solucao.cod_tipo_solucao AND
						  opc_situacao_tipo_solucao.cod_situacao_tipo_solucao = opc_tipo_solucao.cod_situacao_tipo_solucao and
						   tab_catalogo_convencional.bln_ativo = TRUE
						ORDER BY opc_sistema.txt_sistema, opc_solucao.txt_solucao 
						) as catalogos';
		$stm = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));
		$stm->execute();
		$stm->setFetchMode(PDO::FETCH_OBJ);
			while( $row = $stm->fetch()){
				$resultado = $row->txt_json;
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
			$txt_sql = 'SELECT num_ultima_revisao
						  FROM catalogodesempenho.tab_catalogo_convencional
						  WHERE cod_catalogo_convencional = :numCatalogo;';
			$statement = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));			
			$statement->bindValue('numCatalogo', $numCatalogo,PDO::PARAM_INT);
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

	public function cadastrar_revisaoCatConv($dados){
		try { 
			$conn = $this->getConn();
			$sql = 'INSERT INTO catalogodesempenho.tab_revisao_catalogo(cod_revisao_catalogo, cod_catalogo_convencional, dte_data_revisao, 
            				bln_enviar_email_usuarios, txt_alteracao_realizada, cod_usuario_revisao)
    				VALUES (:numUltRevisao, :codCatalogo, :dataInclusao, TRUE, :alteracaoRealizada, :codUsuario)';	
			$statement = $conn->prepare($sql)  OR die(implode('',$conn->errorInfo())); 
			$statement->bindParam(":numUltRevisao", $dados[0], PDO::PARAM_INT); 
    		$statement->bindParam(":codCatalogo", $dados[1], PDO::PARAM_INT); 
    		$data_inclusao = date("Y-m-d");
			$statement->bindParam(":dataInclusao", $data_inclusao, PDO::PARAM_STR);
    		$statement->bindParam(":alteracaoRealizada", $dados[2], PDO::PARAM_STR);
			$statement->bindParam(":codUsuario", $dados[3], PDO::PARAM_STR); 
			$statement->execute();
			 return $statement->rowCount();  
				
			
		} catch( PDOExecption $e ) { 
			return $e->getMessage();
		} catch( Exception $ex ) { 
			return $this->pack('dbError', $ex->getMessage()); 
		}
	}

	public function alterar_CatConv($dados){
		try { 
			$conn = $this->getConn();
			$sql = 'UPDATE catalogodesempenho.tab_catalogo_convencional
					SET txt_cod_ficha=:codFichaNovo, dte_data_edicao=:dataEdicao, txt_caminho_arquivo=:caminhoArquivo, 
					       num_ultima_revisao=:numUltRevisao
					WHERE cod_catalogo_convencional=:codCatalogo';	
			$statement = $conn->prepare($sql)  OR die(implode('',$conn->errorInfo())); 
    		$statement->bindParam(":codFichaNovo", $dados[0], PDO::PARAM_INT); 
    		$data_edicao = date("Y-m-d");
			$statement->bindParam(":dataEdicao", $data_edicao, PDO::PARAM_STR);
    		$statement->bindParam(":caminhoArquivo", $dados[1], PDO::PARAM_STR);
			$statement->bindParam(":numUltRevisao", $dados[2], PDO::PARAM_INT); 
			$statement->bindParam(":codCatalogo", $dados[3], PDO::PARAM_STR); 
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