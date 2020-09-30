<?php
require_once "ConDBSnhDhab.class.php"; //require_once"ConDBCorporativo.class.php"


class Opc_solucao extends ConDBSnhDhab
{

    public function listarSolucao()
    {
        try {
            $conn = $this->getConn();
            $resultado = '';
            $txt_sql = 'SELECT DISTINCT(txt_solucao)
					FROM catalogodesempenho.opc_solucao
					ORDER BY txt_solucao;';
            $stm = $conn->prepare($txt_sql) OR die(implode('', $conn->errorInfo()));
            $stm->execute();
            $result = array();
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOExecption $e) {
            return $e->getMessage();
        } catch (Exception $ex) {
            return $this->pack('dbError', $ex->getMessage());
        }
    }

    public function listarSolucao_sistema($txt_sistema)
    {
        try {
            $conn = $this->getConn();
            $resultado = '';
            $txt_sql = 'SELECT 
					  opc_solucao.cod_solucao, 
					  opc_solucao.txt_solucao, 
					  opc_solucao.txt_sigla_solucao
					FROM 
					  catalogodesempenho.opc_sistema, 
					  catalogodesempenho.opc_solucao
					WHERE 
					  opc_sistema.cod_sistema = opc_solucao.cod_sistema AND
					  opc_sistema.txt_sistema like :txt_sistema
					ORDER BY txt_solucao;';
            $stm = $conn->prepare($txt_sql) OR die(implode('', $conn->errorInfo()));
            $stm->bindValue('txt_sistema', $txt_sistema, PDO::PARAM_STR);
            $stm->execute();
            $result = array();
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOExecption $e) {
            return $e->getMessage();
        } catch (Exception $ex) {
            return $this->pack('dbError', $ex->getMessage());
        }
    }

    public function listaSolucaoByIdSistema($id)
    {
        try {
            $conn = $this->getConn();
            $resultado = '';
            $txt_sql = 'SELECT 
					  opc_solucao.cod_solucao, 
					  opc_solucao.txt_solucao
					FROM 
					  catalogodesempenho.opc_solucao
					WHERE 
					  opc_solucao.cod_sistema = :cod_sistema
					ORDER BY txt_solucao;';
            $stm = $conn->prepare($txt_sql) OR die(implode('', $conn->errorInfo()));

            $stm->bindValue('cod_sistema', $id, PDO::PARAM_INT);
            $stm->execute();
            $result = array();
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);


            return $result;
        } catch (PDOExecption $e) {
            return $e->getMessage();
        } catch (Exception $ex) {
            return $this->pack('dbError', $ex->getMessage());
        }
    }


    public function json_listarSolucao_sistema($txt_sistema)
    {
        try {
            $conn = $this->getConn();
            $resultado = '';
            $txt_sql = 'SELECT json_agg(sistemas)
					FROM (SELECT 
						  opc_sistema.txt_sistema,
						  json_agg(catalogodesempenho.opc_solucao.txt_solucao) as solucoes
						FROM 
						  catalogodesempenho.opc_sistema 
						  LEFT JOIN catalogodesempenho.opc_solucao
						  ON opc_sistema.cod_sistema = opc_solucao.cod_sistema
						GROUP BY  
						  opc_sistema.txt_sistema
						HAVING opc_sistema.txt_sistema LIKE :txtSistema) AS sistemas';
            $stm = $conn->prepare($txt_sql) OR die(implode('', $conn->errorInfo()));
            $stm->bindValue('txtSistema', $txt_sistema, PDO::PARAM_STR);
            $stm->execute();
            $stm->setFetchMode(PDO::FETCH_OBJ);
            while ($row = $stm->fetch()) {
                $resultado = $row->json_agg;
            }
            echo $resultado;
        } catch (PDOExecption $e) {
            return $e->getMessage();
        } catch (Exception $ex) {
            return $this->pack('dbError', $ex->getMessage());
        }
    }

    public function json_listarSolucao()
    {
        try {
            $conn = $this->getConn();
            $resultado = '';
            $txt_sql = 'SELECT json_agg(sistemas)
FROM (SELECT 
	  json_agg(DISTINCT catalogodesempenho.opc_solucao.txt_solucao) as solucoes
	FROM 
	   catalogodesempenho.opc_solucao
	  ) AS sistemas';
            $stm = $conn->prepare($txt_sql) OR die(implode('', $conn->errorInfo()));
            $stm->execute();
            $stm->setFetchMode(PDO::FETCH_OBJ);
            while ($row = $stm->fetch()) {
                $resultado = $row->json_agg;
            }
            echo $resultado;
        } catch (PDOExecption $e) {
            return $e->getMessage();
        } catch (Exception $ex) {
            return $this->pack('dbError', $ex->getMessage());
        }
    }

}

?>