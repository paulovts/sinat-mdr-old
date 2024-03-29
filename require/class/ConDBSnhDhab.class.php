<?php


abstract class ConDBSnhDhab{//o abstract seginifica que nao pode estanciar e sim extender (extend)

    protected static $conexao;//atributo que receberar a conexao

    public function __construct()
    {
        $this->getConn();
    }

    private function setConn(){
        if(is_null(self::$conexao)){//se nao houver nada dentro da variavel $conexao instacia a conexao e conecta no banco
            self::$conexao = new PDO('pgsql:host=192.168.10.113;port=5432;dbname=sinat', 'postgres', 'pg01');
            return self::$conexao;
        }else{
            return self::$conexao;//se hover conecta
        }
    }

    public function getConn(){
        return $this->setConn();
    }

}

?>