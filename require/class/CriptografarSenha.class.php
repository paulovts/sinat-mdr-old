<?php
function __autoload($class){//Auto carregamento da classe
	require_once"{$class}.class.php"; //require_once"ConDB.class.php"
}

class CriptografarSenha
{
	public function setCriptografarSenha($senha){
		//hash('whirlpool',$senha); 128 caracteres
		//hash('sha512',$senha); 128 caracteres
		//hash('sha384',$senha); 96 caracteres
		//hash('sha256',$senha); 64 caracteres
		//sha1($senha); 40 caracteres
		//md5($senha); 32 caracteres
		
		$senhaCriptografada = md5(hash('whirlpool',hash('sha256',hash('whirlpool',$senha))));
		
		
		return $senhaCriptografada;
		
	}

}

?>