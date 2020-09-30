<?php
include("../../require/class/Opc_solucao.class.php");
//try {
//    $opcSolucao = new Opc_solucao;
//
//    $txt_sistema = $_GET['txt_sistema'];
//
//    $stmSolucao = $opcSolucao->listarSolucao_sistema($txt_sistema);
////$comboTipo = array();
//
//    $linhas = 0;
//
//    foreach ($stmSolucao as $dadosSolucao) {
//        $comboSolucao[$linhas][0] = $dadosSolucao['cod_solucao'];
//        $comboSolucao[$linhas][1] = $dadosSolucao['txt_solucao'];
//        $comboSolucao[$linhas][2] = $dadosSolucao['txt_sigla_solucao'];
//        $linhas += 1;
//    }
//    echo json_encode($comboSolucao);
//
//} catch (PDOExecption $e) {
//    echo $e->getMessage();
//} catch (Exception $ex) {
//    echo $this->pack('dbError', $ex->getMessage());
//
//}

try {
    $opcSolucao = new Opc_solucao;

    $id = $_GET['id'];

    $arrSolucao = $opcSolucao->listaSolucaoByIdSistema($id);
    $comoSolucao = [];

    foreach ($arrSolucao as $solucao) {
        $comoSolucao[] = ['id' => $solucao['cod_solucao'], 'descricao' => $solucao['txt_solucao']];
    }

    echo json_encode($comoSolucao);

} catch (PDOExecption $e) {
    echo $e->getMessage();
} catch (Exception $ex) {
    echo $this->pack('dbError', $ex->getMessage());

}


?>