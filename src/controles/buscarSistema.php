<?php
include("../../require/class/Opc_sistema.class.php");
try {
    $opcSistema = new Opc_sistema;

    $arrSistema = $opcSistema->listarSistema();
    $comboSistema = [];

    foreach ($arrSistema as $solucao) {
        $comboSistema[] = ['id' => $solucao['cod_sistema'], 'descricao' => $solucao['txt_sistema']];
    }

    echo json_encode($comboSistema);

} catch (PDOExecption $e) {
    echo $e->getMessage();
} catch (Exception $ex) {
    echo $this->pack('dbError', $ex->getMessage());

}


?>