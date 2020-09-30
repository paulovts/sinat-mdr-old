<?php
include("../seguranca/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
include("../../require/class/Tab_uf.class.php");
include("../../require/class/Opc_areaAtuacao.class.php");
include("../../require/class/Opc_sistema.class.php");
include("../../require/class/Opc_solucao.class.php");
include("../../require/class/Opc_situacao_tipo_solucao.class.php");
require_once "../../require/class/Tab_usuarios.class.php";


$tabUF = new Tab_uf;
$tabArea = new Opc_areaAtuacao;
$opcSistema = new Opc_sistema;
$opcSolucao = new Opc_solucao;
$opcSituacaoTipoSolucao = new Opc_situacao_tipo_solucao;
$tabUsuario = new Tab_usuarios;


$codUsuario = $_SESSION['cod_usuario'];

$resultadoAceite = $tabUsuario->consultar_aceite($codUsuario);

if ($resultadoAceite == 0) {
    header("Location: documentosSistemasConvencionais.php");
}


?>


<!DOCTYPE html>
<html lang="pt-br" ng-app="cadastroApp">

<head>
    <meta charset="utf-8">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300|Montserrat:700,400' rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Handlee' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300' rel='stylesheet' type='text/css'>
    <link href="../../_css/bootstrap.min.css" rel="stylesheet">
    <link href="../../_css/norma.css" rel="stylesheet">

    <title>Desempenho Técnico para HIS</title>
</head>

<body>

<div id="barra-identidade">
    <div id="barra-brasil">
        <a href="http://brasil.gov.br"
           style="background:#7F7F7F; height: 20px; padding:4px 0 4px 80px; display: block; font-family:sans,sans-serif; text-decoration:none; color:white; ">Portal
            do Governo Brasileiro</a>
    </div>
</div>

<div class="header" style="position: relative"> <!-- TOPO VERDE DA PÁGINA-->
    <div class="container">
        <h3>Minist&eacute;rio do Desenvolvimento Regional</h3>
        <h1 id="title">Desempenho T&eacute;cnico para HIS </h1>
        <h3 style="margin-top: 2px">SiNAT - Sistemas Convencionais e Inovadores</h3>
    </div>
</div>

<div id='nav' style="position:relative">
    <div class="container">
        <ul>
            <li><a href="../paginas/cadUploadDocumento.php">Upload de Documento</a></li>
            <li><a href="../seguranca/sair.php">Sair</a></li>
        </ul>
    </div>
</div>

<br>
<div ng-controller="CadastroController">
    <div class="container">
        <div class="nome">
            <H3>Upload de Documento</H3>
        </div>
        <form id="formulario" method="post" action="">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label ">Tipo de Sistema: *</label>
                        <select class="form-control selectContainer" name='tiposistema'
                                ng-change="changeTipoSistema(data.model)"
                                ng-model="data.model">
                            <option ng-repeat="option in data.options" value="{{option.id}}">{{option.label}}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div ng-show="IsVisibleConvencionais">
                <cadastro-convencional></cadastro-convencional>
            </div>
            <div ng-show="IsVisibleInovadores">
                <cadastro-inovadores></cadastro-inovadores>
            </div>
        </form>
    </div> <!-- FECHA CONTAINER -->
</div>
<br><br><br>

<div id="footer">
    <div class="container">
        <a href="http://www.cidades.gov.br/" target="_blank"><H4>Ministério das Cidades</h4></a>
        <a href="http://www.cidades.gov.br/index.php/habitacao" target="_blank"><p>Secretaria Nacional de Habitação</p>
        </a>
        <a href="http://pbqp-h.cidades.gov.br" target="_blank"><p>Programa Brasileiro da Qualidade e Produtividade do
                Habitat</p></a>
        <a href="http://www.cidades.gov.br/index.php/habitacao/departamentos/dict" target="_blank"><p>Desenvolvido e
                gerenciado pela Gerência de Informação Departamento de Desenvolvimento Institucional e Cooperação
                Técnica</p></a>
        <img src="../../_images/MCMV_C.png"
             style="position:relative; left:800px; top:-65px; z-index:1; padding-bottom:-50px; width: 120px;">
    </div>
</div>
<div id="footer-brasil"></div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../../_scripts/jquery-1.11.2.min.js"></script>
<script src="../../_scripts/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<!--<script src="../../_script/ie10-viewport-bug-workaround.js"></script>-->
<!--<script src="../../_scripts/bootbox.min.js"></script>-->


<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script src="../../_scripts/formValidation/formValidation.min.js"></script>
<script src="../../_scripts/formValidation/bootstrap.min.js"></script>
<!-- Arquivo necessario para acessar o Bootstrap com o Form Validation -->
<script type="../../text/javascript" src="_scripts/formValidation/pt_BR.js"></script>
<!-- Tradução da validação para Português -->

<!--JS Personalizado-->
<script src="../../_scripts/cadastrarUsuario.js"></script>
<script src="../../_scripts/validateFormIndex.js"></script>
<script src="../../_scripts/angular/app.js"></script>
<script src="../../_scripts/angular/controllers/cadastro.js"></script>

<script src="http://barra.brasil.gov.br/barra.js" type="text/javascript" defer async></script>


</body>
