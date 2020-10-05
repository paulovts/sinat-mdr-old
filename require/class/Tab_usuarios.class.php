<?php
require_once "ConDBSnhDhab.class.php"; //require_once"ConDB.class.php"


class Tab_usuarios extends ConDBSnhDhab{
		
	public function consultar_usuario($cpf){
		try { 
			$conn = $this->getConn();
			$sql = 'SELECT txt_nome
					FROM catalogodesempenho.tab_usuario
					WHERE txt_cpf_usuario LIKE :cpf;';
			$statement = $conn->prepare($sql) OR die(implode('',$conn->errorInfo()));
			$statement->bindValue('cpf',$cpf,PDO::PARAM_STR);
			$statement->execute();
			return  $statement->rowCount();
		} catch( PDOExecption $e ) { 
			return $e->getMessage();
		} catch( Exception $ex ) { 
			return false;
		}
	}
	
	public function consultar_aceite($codUsuario){
		try { 
			$conn = $this->getConn();
			$sql = 'SELECT bln_aceite_termos
					FROM catalogodesempenho.tab_usuario
					WHERE cod_usuario = :codUsuario;';
			$statement = $conn->prepare($sql) OR die(implode('',$conn->errorInfo()));
			$statement->bindValue('codUsuario',$codUsuario,PDO::PARAM_INT);
			$statement->execute();
			$statement->setFetchMode(PDO::FETCH_OBJ);
			while( $row = $statement->fetch()){
				$resultado = $row->bln_aceite_termos;
				}
			
			return $resultado;
		} catch( PDOExecption $e ) { 
			return $e->getMessage();
		} catch( Exception $ex ) { 
			return $this->pack('dbError', $ex->getMessage()); 
		}
	}
	
	public function cadastrar_usuario($dados){
		try{ 
			$conn = $this->getConn();
			$txt_sql = 'INSERT INTO catalogodesempenho.tab_usuario(
								txt_email, txt_nome, txt_cargo, txt_telefone, cod_ibge, 
								dte_data_inclusao, txt_senha, cod_tipo_pessoa, txt_cnpj_empresa, 
								txt_razao_social, txt_cep_empresa, txt_endereco_empresa, cod_area_atuacao, txt_especifique_outra_area, cod_perfil_usuario, txt_cpf_usuario)
						VALUES (:txt_email, :txt_nome, :txt_cargo, :txt_telefone, :cod_ibge,
								:dte_atualizada_em, :txt_senha, :cod_tipopessoa, :txt_cnpjempresa,
								:txt_razaosocial, :txt_cepempresa, :txt_enderecoempresa, :cod_areaatuacao, :txt_especifiqueoutraarea, :cod_perfil_usuario, :cpfUsuario);';
			$statement = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));			
			$statement->bindValue('txt_email', $dados[1],PDO::PARAM_STR);
			$statement->bindValue('txt_nome', $dados[2],PDO::PARAM_STR);
			$statement->bindValue('txt_cargo', $dados[3],PDO::PARAM_STR);
			$statement->bindValue('txt_telefone', $dados[4],PDO::PARAM_STR);			
			$statement->bindValue('cod_ibge', $dados[5],PDO::PARAM_INT);
			
			$data_inclusao = date("Y-m-d");
			$statement->bindValue('dte_atualizada_em', $data_inclusao,PDO::PARAM_STR);
			
			$statement->bindValue('txt_senha', $dados[6],PDO::PARAM_STR);
			$statement->bindValue('cod_tipopessoa', $dados[7],PDO::PARAM_INT);
			$statement->bindValue('txt_cnpjempresa', empty($dados[8])? NULL : $dados[8],PDO::PARAM_STR);	
			$statement->bindValue('txt_razaosocial', empty($dados[9])? NULL : $dados[9],PDO::PARAM_STR);
			$statement->bindValue('txt_cepempresa', empty($dados[10])? NULL : $dados[10],PDO::PARAM_STR);
			$statement->bindValue('txt_enderecoempresa', empty($dados[11])? NULL : $dados[11],PDO::PARAM_STR);		
			$statement->bindValue('cod_areaatuacao', empty($dados[12])? NULL : $dados[12],PDO::PARAM_INT);
			$statement->bindValue('txt_especifiqueoutraarea', empty($dados[13])? NULL : $dados[13],PDO::PARAM_STR);
			$statement->bindValue('cod_perfil_usuario', $dados[14],PDO::PARAM_INT);
			$statement->bindValue('cpfUsuario', $dados[15],PDO::PARAM_STR);
			
			$statement->execute();
			
			return $statement->rowCount();
		}catch(PDOException $e){
			return $this->pack('dbError', $e->getMessage());
		}catch(SQLException $ex){
			return $this->pack('dbError', $ex->getMessage());
		} 
	}

	public function alterar_senha($dados){
		try{ 
			$conn = $this->getConn();
			$txt_sql = 'UPDATE catalogodesempenho.tab_usuario
		  			    SET txt_senha = :txt_senha
						WHERE txt_cpf_usuario LIKE :cpfUsuario';
			$statement = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));			
			$statement->bindValue('txt_senha', $dados[1],PDO::PARAM_STR);
			$statement->bindValue('cpfUsuario', $dados[2],PDO::PARAM_STR);
			
			$statement->execute();
			
			return $statement->rowCount();
		}catch(PDOException $e){
			return $this->pack('dbError', $e->getMessage());
		}catch(SQLException $ex){
			return $this->pack('dbError', $ex->getMessage());
		} 
	}
	
	public function salvar_aceite($codUsuario){
		try{ 
			$conn = $this->getConn();
			$txt_sql = 'UPDATE catalogodesempenho.tab_usuario
		  			    SET bln_aceite_termos=1
						WHERE cod_usuario = :codUsuario;';
			$statement = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));			
			$statement->bindValue('codUsuario', $codUsuario,PDO::PARAM_INT);
			$statement->execute();
			
			return $statement->rowCount();
		}catch(PDOException $e){
			return $this->pack('dbError', $e->getMessage());
		}catch(SQLException $ex){
			return $this->pack('dbError', $ex->getMessage());
		} 
	}
	
	public function consulta_usuarioSenha($email, $senha){
		try { 
			$conn = $this->getConn();
			$sql = 'SELECT txt_nome
					FROM catalogodesempenho.tab_usuario
					WHERE txt_email LIKE :email AND txt_senha LIKE :senha';
			$statement = $conn->prepare($sql) OR die(implode('',$conn->errorInfo()));
			$statement->bindValue('email',$email,PDO::PARAM_STR);
			$statement->bindValue('senha',$senha,PDO::PARAM_STR);
			$statement->execute();

			return $statement->fetchAll() ? true : false;

		} catch( PDOExecption $e ) { 
			return $e->getMessage();
		} catch( Exception $ex ) { 
			return $this->pack('dbError', $ex->getMessage()); 
		}
	}

	public function consulta_email($email){
		try { 
			$conn = $this->getConn();
			$sql = 'SELECT txt_nome
					FROM catalogodesempenho.tab_usuario
					WHERE txt_email LIKE :email';
			$statement = $conn->prepare($sql) OR die(implode('',$conn->errorInfo()));
			$statement->bindValue('email',$email,PDO::PARAM_STR);
			$statement->execute();
			
			return $statement->rowCount();
		} catch( PDOExecption $e ) { 
			return $e->getMessage();
		} catch( Exception $ex ) { 
			return $this->pack('dbError', $ex->getMessage()); 
		}
	}
	
	public function consultar_perfil($email){
		try { 
			$conn = $this->getConn();
			$sql = 'SELECT cod_perfil_usuario
					FROM catalogodesempenho.tab_usuario
					WHERE txt_email LIKE :email;';
			$statement = $conn->prepare($sql) OR die(implode('',$conn->errorInfo()));
			$statement->bindValue('email',$email,PDO::PARAM_STR);
			$statement->execute();
			$statement->setFetchMode(PDO::FETCH_OBJ);
			while( $row = $statement->fetch()){
				$resultado = $row->cod_perfil_usuario;
				}
			
			return $resultado;
		} catch( PDOExecption $e ) { 
			return $e->getMessage();
		} catch( Exception $ex ) { 
			return $this->pack('dbError', $ex->getMessage()); 
		}
	}	

	public function buscar_usuario($email){
		try { 
			$conn = $this->getConn();
			$sql = 'SELECT cod_usuario, txt_nome, txt_email, txt_cpf_usuario
					FROM catalogodesempenho.tab_usuario
					WHERE txt_email LIKE :email;';
			$statement = $conn->prepare($sql) OR die(implode('',$conn->errorInfo()));
			$statement->bindValue('email',$email,PDO::PARAM_STR);
			$statement->execute();
			$result = array();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
		} catch( PDOExecption $e ) { 
			return $e->getMessage();
		} catch( Exception $ex ) { 
			return $this->pack('dbError', $ex->getMessage()); 
		}
	}	

public function buscar_email_cpf($cpf){
		try { 
			$conn = $this->getConn();
			$sql = 'SELECT cod_usuario, txt_nome, txt_email
					FROM catalogodesempenho.tab_usuario
					WHERE txt_cpf_usuario LIKE :cpf;';
			$statement = $conn->prepare($sql) OR die(implode('',$conn->errorInfo()));
			$statement->bindValue('cpf',$cpf,PDO::PARAM_STR);
			$statement->execute();
			$result = array();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
		} catch( PDOExecption $e ) { 
			return $e->getMessage();
		} catch( Exception $ex ) { 
			return $this->pack('dbError', $ex->getMessage()); 
		}
	}

public function listar_usuarios(){
		try { 
			$conn = $this->getConn();
			$sql = 'SELECT cod_usuario, txt_cpf_usuario
                                FROM catalogodesempenho.tab_usuario';
			$statement = $conn->prepare($sql) OR die(implode('',$conn->errorInfo()));
			$statement->execute();
			$result = array();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
		} catch( PDOExecption $e ) { 
			return $e->getMessage();
		} catch( Exception $ex ) { 
			return $this->pack('dbError', $ex->getMessage()); 
		}
	}
        
public function json_atualizacao_fichas($cod_usuario){
	try{
		$conn = $this->getConn();
		$resultado = '';
		$txt_sql = 'SELECT json_agg(fichasAtualizacao)
					FROM (SELECT * FROM catalogodesempenho.view_union_tab_downloads
						  WHERE cod_usuario=:codUsuario) AS fichasAtualizacao';
		$stm = $conn->prepare($txt_sql) OR die(implode('',$conn->errorInfo()));
		$stm->bindValue('codUsuario',$cod_usuario,PDO::PARAM_INT);
		$stm->execute();
		$stm->setFetchMode(PDO::FETCH_OBJ);
			while( $row = $stm->fetch()){
				$resultado = $row->json_agg;
				}
		echo $resultado;
	} catch( PDOExecption $e ) { 
		return $e->getMessage();
	} catch( Exception $ex ) { 
		return $this->pack('dbError', $ex->getMessage()); 
	}
}

}

?>