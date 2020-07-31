<?php
require_once"ConDBSnhDhab.class.php"; //require_once"ConDBCorporativo.class.php"


class Arquivos_json extends ConDBSnhDhab{

public function dados_json_catalogo_convencional(){
	try{
		$conn = $this->getConn();
		$resultado = '';
		$txt_sql = 'SELECT json_agg(sub) AS array_of_edges
					FROM  (SELECT 
					  opc_sistema.txt_sistema AS sistema, 
					  opc_sistema.txt_sigla_sistema AS "siglaSistema", 
					  tab_catalogo_convencional.txt_cod_ficha AS numero, 
					  opc_tipo_solucao.txt_tipo_solucao AS tecnologia, 
					  tab_catalogo_convencional.dte_data_edicao AS "dataAtualizacao", 
					  opc_tipo_solucao.txt_descricao_tipo_solucao AS descricao, 
					  tab_catalogo_convencional.txt_caminho_arquivo AS url, 
					  opc_situacao_tipo_solucao.txt_situacao_tipo_solucao AS situacao
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
					  opc_situacao_tipo_solucao.cod_situacao_tipo_solucao = opc_tipo_solucao.cod_situacao_tipo_solucao) sub;';
		$stm = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));
		$stm->execute();
		$stm->setFetchMode(PDO::FETCH_OBJ);
		while( $row = $stm->fetch()){
			$resultado = $row->array_of_edges;
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