<?php
include("../seguranca/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
include("../../require/class/Tab_uf.class.php");
include("../../require/class/Opc_areaAtuacao.class.php");
include("../../require/class/Opc_sistema.class.php");
include("../../require/class/Opc_solucao.class.php");
include("../../require/class/Opc_situacao_tipo_solucao.class.php");
require_once"../../require/class/Tab_usuarios.class.php";



$tabUF = new Tab_uf;
$tabArea = new Opc_areaAtuacao;
$opcSistema = new Opc_sistema;
$opcSolucao = new Opc_solucao;
$opcSituacaoTipoSolucao = new Opc_situacao_tipo_solucao;
$tabUsuario = new Tab_usuarios;


$codUsuario = $_SESSION['cod_usuario'];

$resultadoAceite = $tabUsuario->consultar_aceite($codUsuario);

	if($resultadoAceite==0){
		header("Location: documentosSistemasConvencionais.php");
	}


?>

<!DOCTYPE html>
<html lang="pt-br" ng-app="myApp">

<head>
	<meta charset="utf-8">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300|Montserrat:700,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Handlee' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300' rel='stylesheet' type='text/css'>
	<link href="../../_css/bootstrap.min.css" rel="stylesheet">
	
	<link href="../../_css/norma.css" rel="stylesheet">
	
	<!-- FontAwesome CSS -->
	<link rel="stylesheet" href="../../_css/font-awesome.min.css">
			
	<script src="../../_scripts/angular/angular.min.js"></script>
	<script src="../../_scripts/angular/angular-animate.min.js"></script>
	<script src="../../_scripts/angular/app.js"></script>
	<script src="../../_scripts/angular/controllers.js"></script>
	
	<title>Desempenho Técnico para HIS</title>
 </head>

<body id="<?php echo $codUsuario;?>">

	<div id="barra-identidade">
		<div id="barra-brasil">
			<a href="http://brasil.gov.br" style="background:#7F7F7F; height: 20px; padding:4px 0 4px 80px; display: block; font-family:sans,sans-serif; text-decoration:none; color:white; ">Portal do Governo Brasileiro</a>
		</div>	
	</div>


	<div class="header" style="position: relative"> <!-- TOPO VERDE DA PÁGINA-->
		<div class="container">
			<h3>Ministério das Cidades</h3>
			<h1 id="title">Desempenho Técnico para HIS </h1>
			<h3 style="margin-top: 2px">SiNAT - Sistemas Convencionais e Inovadores</h3>

		</div>
	</div>

	<div id='nav' style="position:relative">
		<div class = "container">
			<ul>
				<li><a href="escolhaSistemas.php">Sistemas</a></li>
				<li><a href="catalogoInovador.php">Sistemas Inovadores</a></li>                
                <li><a href="documentosSistemasConvencionais.php">Documentos</a></li>
                <li><a href="../seguranca/sair.php">Sair</a></li>
			</ul>
		</div>
	</div>



	<div class="container">
		<div class="page-header">
			<H2 id="bemVindo">Sistemas Convencionais</H2>
		</div>
		<div id="comoPreencher" style="margin-top:0">
		 <p>A documentação técnica contida neste sistema foi desenvolvida, por iniciativa do Ministério das Cidades, em parceria com a Caixa, entidades públicas e privadas, para apoiar incorporadores, construtores, projetistas, fabricantes de componentes, empreendedores em geral, na obtenção de edificações que atendam aos requisitos, critérios e parâmetros de Desempenho estabelecidos na ABNT NBR 15575.</p>				
		</div>
	</div>	
	<br>
		<div class="corpo" style="position: relative"> <!--CORPO DA PÁGINA-->
			<div class="container"> 
				<div ng-controller="CatalogoConvencional"> <!--Inicio Tabela Catálogo-->
					
						
						<div id ="filtrarCatalogo" class="well" style="padding-left: 0px; padding-top: 0px; padding-right: 0px; text-align:center" >
						<h1 style="background-color: #E1E1E1; font-size: 17px; margin-top:0; padding-top: 5px; padding-bottom: 5px">Filtrar Fichas</h1>
						 <div class="row" style="padding-left:10px; padding-top: 20px;">
							<div class="form-inline" >
								<div class="col-sm-6 col-xs-12">
									<label class="labelFiltro"> Sistema: </label>
										<select ng-change="mudarSolucao()" ng-model="sistema" class="form-control" ng-class="{alerta: emAvaliacao}" id="comboSistema" name="comboSistema">
											<option value="">Todos</option>
											<?php
												$stmSistema = $opcSistema->listarSistema();
												foreach($stmSistema as $dadosSistema){
													echo '<option value="'.$dadosSistema['txt_sistema'].'">'.$dadosSistema['txt_sistema'].'</option>';
												}											
											?>
										</select>
								</div>
								 
								<div class="col-sm-6 col-xs-12">
									<label class="labelFiltro"> Solução: </label>
										<select ng-model="solucao" class="form-control" ng-class="{alerta: emAvaliacao}" id="comboSolucao" name="comboSolucao">
											<option value="">Todas</option>
											<option ng-repeat="solucao in novaSolucao">{{solucao}}</option>
										</select>	
								 </div>
							</div>  <!-- Fim Form-Inline -->
						</div> <!-- Fim Row -->
						
						<br>
						
						<div class="row"  style="padding-left:10px;">
                            <div class="form-inline">
								<div class="col-sm-6 col-xs-12">
									<label class="labelFiltro">Situação da Ficha: </label>
										<select ng-change="mudarNome()" ng-model="situacao" ng-options="item.key as item.tipo for item in situacaoFicha | orderBy: item.tipo" class="form-control" ng-class="{alerta: emAvaliacao}" id="comboSituacao" name="comboSituacao">
										</select>
								</div>
								<div class="col-sm-6 col-xs-12">
									<label class="labelFiltro">Buscar Palavra-Chave: </label>
									<input ng-model="buscar" placeholder="Ex: Bloco cerâmico" class="form-control" ng-class="{alerta: emAvaliacao}" autofocus></input>
								</div>
								
							</div> <!-- Fim Form-Inline -->
						</div> <!-- Fim Row -->
							
						<br>
						
						<div class="form-inline filtroOrdem">
							<label class="labelFiltroPequeno"> Ordenar:
								<select ng-model="ordem" class="form-control input-sm" ng-class="{alerta: emAvaliacao}">
									<option value="sistema">Sistema</option>
									<option value="solucao">Solução</option> 
								</select>
							</label>
							
							<label class="labelFiltroPequeno"> 
								<input type="radio" ng-model="direcao" name="direcao" checked></input>
								crescente
							</label>
							<label class="labelFiltroPequeno"> 
								<input type="radio" ng-model="direcao" name="direcao" value="reverse"></input>
								decrescente
							</label>
						</div>
					</div> <!-- Fim Filtro / Well -->
					
						<hr>
						
						<h1 id="titulo_result">{{titulo}}</h1>
						<div ng-show="emAvaliacao">
							<div class="panel panel-danger">
							  <div class="panel-heading">
								<h3 class="panel-title" ng-class="{naoAvaliadoPulse: emAvaliacao}" style="text-align:center; font-weight: bold">ATENÇÃO</h3>
							  </div>
							  <div class="panel-body">
								As soluções das fichas disponibilizadas abaixo não têm resultados de ensaios suficientes para comprovação de desempenho. A utilização destas soluções requer o acompanhamento de uma <strong>Instituição Técnica Avaliadora (ITA)</strong>.
							  </div>
							</div>
						</div>
						<table id="tabelaCatalogo" class="table table-bordered">
						  
						  <tr>
							<th class="col-xs-2" ng-class="{naoAvaliadoTabela: emAvaliacao}">Sistema</th>
							<th class="col-xs-2" ng-class="{naoAvaliadoTabela: emAvaliacao}">Solução</th>
							<th class="col-xs-7" ng-class="{naoAvaliadoTabela: emAvaliacao}">Descrição</th>
							<th class="col-xs-1" ng-class="{naoAvaliadoTabela: emAvaliacao}">Download</th>
						  </tr>
						  <tr ng-animate="'animate'" class="fileiraCatalogo" ng-repeat="item in catalogo | filter: buscar | filter: situacao | filter: sistema | filter: solucao | orderBy: ordem:direcao">
							<td>{{item.sistema}}</td>
							<td>{{item.solucao}}</td>
							<td class="text-justify">{{item.descricao}}</td>
							<td ng-if ="!emAvaliacao" class="text-center"><a ng-href="../../{{item.url}}" download ng-click="countDownload(item.numero, <?php echo $codUsuario; ?>)"><i class="fa fa-file-pdf-o fa-4x"></i></a></td>
							<td ng-if ="emAvaliacao" class="text-center"><a data-toggle="modal" data-target="#myModal" ng-click="abrirModal(item.numero, item.url)"><i class="fa fa-file-pdf-o fa-4x emAvalicao naoAvaliadoDoc"></i></a></td>
						  </tr>
						</table>

						<!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog">
						  <div class="modal-dialog atencao">

							<!-- Modal content-->
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">ATENÇÃO</h4>
							  </div>
							  <div class="modal-body">
								<p>A solução da ficha que você vai acessar não tem resultados de ensaio suficientes para comprovação de desempenho. A utilização desta solução requer o acompanhamento de uma <strong>Instituição Técnica Avaliadora (ITA)</strong>.</p>
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
								<a ng-href="../../{{modal.url}}" class="btn btn-default" download ng-click="countDownload(modal.itemnumero, <?php echo $codUsuario; ?>)" >Download</a>
								
							  </div>
							</div>

						  </div>
						</div>
				</div> <!--Fim Tabela Catálogo-->
			</div>
		</div>
	
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
    <script src="../../_scripts/bootbox.min.js"></script>
    
    
    <!-- FormValidation plugin and the class supports validating Bootstrap form -->
	<script src="../../_scripts/formValidation/formValidation.min.js"></script>
	<script src="../../_scripts/formValidation/bootstrap.min.js"></script> <!-- Arquivo necessario para acessar o Bootstrap com o Form Validation -->
	

	<!--JS Personalizado-->
	<script src="../../_scripts/catalogoConvencional.js"></script>
    <script src="http://barra.brasil.gov.br/barra.js" type="text/javascript" defer async></script>
	



</body>
</html>