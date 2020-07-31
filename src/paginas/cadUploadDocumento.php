<?php
//include("../../require/class/Tab_uf.class.php");
//include("../../require/class/Opc_areaAtuacao.class.php");

//$tabUF = new Tab_uf;
//$tabArea = new Opc_areaAtuacao;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300|Montserrat:700,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Handlee' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300' rel='stylesheet' type='text/css'>
    <link href="../../_css/bootstrap.min.css" rel="stylesheet">
    <link href="../../_css/norma.css" rel="stylesheet">

    <title>Desempenho Técnico para HIS</title>
</head>

<body>

<div id="barra-identidade">
    <div id="barra-brasil">
        <a href="http://brasil.gov.br" style="background:#7F7F7F; height: 20px; padding:4px 0 4px 80px; display: block; font-family:sans,sans-serif; text-decoration:none; color:white; ">Portal do Governo Brasileiro</a>
    </div>
</div>

<div class="header" style="position: relative"> <!-- TOPO VERDE DA PÁGINA-->
    <div class="container">
        <h3>Minist&eacute;rio das Cidades</h3>
        <h1 id="title">Desempenho T&eacute;cnico para HIS </h1>
        <h3 style="margin-top: 2px">SiNAT - Sistemas Convencionais e Inovadores</h3>
    </div>
</div>

<div id='nav' style="position:relative">
    <div class = "container">
        <ul>
            <li><a href="../paginas/cadUploadDocumento.php">Upload de Documento</a></li>
            <li><a href="../seguranca/sair.php">Sair</a></li>
        </ul>
    </div>
</div>

<!--
<div class="container">
    <div class="page-header">
        <H2 id="bemVindo">Upload de documento</small></H2>
    </div>
    <div id="comoPreencher" style="margin-top:5px">
    </div>
</div>
-->
<br>

<div class="container">
    <div class="nome">
        <H3>Upload de Documento</H3>
    </div>
    <div class="well">
        <form id="formularioUsuario" method="post" action="../controles/salvarUsuario.php">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="pessoa">Tipo de Sistema:</label>
                        <select class="form-control selectContainer" id="tipoUsuario" name="tipoUsuario">
                            <option value="">Escolha:</option>
                            <option value="1"> Sistemas Convencionais</option>
                            <option value="2"> Sistemas Inovadores</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="hidden" class="form-control" name="codPerfilUsuario" id="codPerfilUsuario" value="2"/>
                    </div>
                </div>
            </div>
            <div id="dadosContato"  class="hide">
                <div class="tituloForm">
                    <H4>Dados do Contato</H4>
                    <hr class="divider">
                </div>
                <div class="form-group">
                    <div class="row">

                        <div class="col-md-3">
                            <label class="control-label ">Nome</label>
                            <input type="text" class="form-control" name="nome" placeholder="José" id="nomeContato"/>
                        </div>

                        <div class="col-md-3">
                            <label class="control-label">Sobrenome</label>
                            <input type="text" class="form-control" name="sobrenome" placeholder="Silva"id="sobrenomeContato"/>
                        </div>

                        <div class="col-md-3">
                            <label class="control-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Somente números" maxlength="11"/>
                        </div>

                        <div class="col-md-3">
                            <label id="cargoProfissao" class="control-label">Cargo</label>
                            <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Arquiteto" />
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="jose_silva@gmail.com" />
                        </div>

                        <div class="col-md-4">
                            <label for="estado">UF:</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value=""></option>
                                <?php
                                $stmUF = $tabUF->listarUF();
                                foreach($stmUF as $dadosUF){
                                    echo '<option value="'.$dadosUF['sg_uf'].'">'.$dadosUF['ds_uf'].' ('.$dadosUF['sg_uf'].')</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="cidade">Cidade:</label>
                            <select class="form-control" id="municipio" name="municipio">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">

                        <div class="col-md-2">
                            <label class="control-label">DDD</label>
                            <input type="text" class="form-control" maxlength="3" name="ddd" placeholder="061"/>
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Telefone</label>
                            <input type="text" class="form-control" maxlength="9" name="telefone" placeholder="99999999"/>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="De 6 a 20 caracteres"/>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Confirmar Senha</label>
                            <input type="password" class="form-control" id="confirmaSenha" name="confirmaSenha" placeholder="Confirme a Senha"/>
                        </div>

                    </div>
                </div>
            </div>
            <div id="dadosEmpresa"  class="hide">
                <div class="tituloForm">
                    <H4>Dados da Empresa/Instituição</H4>
                    <hr class="divider">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="areaAtuacao">Área de atuação:</label>
                            <select class="form-control" id="areaAtuacao" name="areaAtuacao">
                                <option value="">Escolha:</option>
                                <?php
                                $stmArea = $tabArea->listarAreaAtuacao();
                                foreach($stmArea as $dadosArea){
                                    echo '<option value="'.$dadosArea['cod_area_atuacao'].'">'.$dadosArea['txt_area_atuacao'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div id="divEspecifique" class="col-md-9 hide">
                            <label class="control-label">Especifique</label>
                            <input type="text" class="form-control" id="especifique" name="especifique"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">CNPJ</label>
                            <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="00000000000111" maxlength="14"/>
                        </div>

                        <div class="col-md-9">
                            <label class="control-label ">Razão Social</label>
                            <input type="text" class="form-control" name="razaoSocial" placeholder="Empresa do José" id="razaoSocial"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">CEP</label>
                            <input type="text" class="form-control" id="cep" name="cep" placeholder="70000000" maxlength="8"
                            />
                        </div>

                        <div class="col-md-9">
                            <label class="control-label ">Endereço</label>
                            <input type="text" class="form-control" name="endereco" placeholder="Av. Paulista, Rua 10" id="endereco"/>
                        </div>

                    </div>
                </div>
            </div>
            <div id="btnCadUsuario" class="hide">
                <div class="row">
                    <div class="col-md-2">
                        <div class="btn">
                            <button id="salvarUsuario" type="submit" class="btn-lg btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div> <!-- FECHA WELL -->
</div> <!-- FECHA CONTAINER -->

<br><br><br>

<div id="footer">
    <div class="container">
        <a href="http://www.cidades.gov.br/" target="_blank"><H4>Ministério das Cidades</h4></a>
        <a href="http://www.cidades.gov.br/index.php/habitacao" target="_blank"><p>Secretaria Nacional de Habitação</p></a>
        <a href="http://pbqp-h.cidades.gov.br" target="_blank"><p>Programa Brasileiro da Qualidade e Produtividade do Habitat</p></a>
        <a href="http://www.cidades.gov.br/index.php/habitacao/departamentos/dict" target="_blank"><p>Desenvolvido e gerenciado pela Gerência de Informação Departamento de Desenvolvimento Institucional e Cooperação Técnica</p></a>
        <img src="../../_images/MCMV_C.png" style="position:relative; left:800px; top:-65px; z-index:1; padding-bottom:-50px; width: 120px;">
    </div>
</div>
<div id="footer-brasil"></div>



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../../_scripts/jquery-1.11.2.min.js"></script>
<script src="../../_scripts/bootstrap.min.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../_script/ie10-viewport-bug-workaround.js"></script>
<script src="../../_scripts/bootbox.min.js"></script>


<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script src="../../_scripts/formValidation/formValidation.min.js"></script>
<script src="../../_scripts/formValidation/bootstrap.min.js"></script> <!-- Arquivo necessario para acessar o Bootstrap com o Form Validation -->
<script type="../../text/javascript" src="_scripts/formValidation/pt_BR.js"></script> <!-- Tradução da validação para Português -->

<!--JS Personalizado-->
<script src="../../_scripts/cadastrarUsuario.js"></script>

<script src="http://barra.brasil.gov.br/barra.js" type="text/javascript" defer async></script>





</body>
