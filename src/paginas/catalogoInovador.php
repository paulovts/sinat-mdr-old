<?php
include("../seguranca/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
include("../../require/class/Tab_uf.class.php");
include("../../require/class/Opc_areaAtuacao.class.php");
include("../../require/class/Tab_catalogoDatec.class.php");
include("../../require/class/Tab_usuarios.class.php");

$tabUF = new Tab_uf;
$tabArea = new Opc_areaAtuacao;
$tabDatec = new Tab_catalogoDatec;
$tabUsuario = new Tab_usuarios;

$codUsuario = $_SESSION['cod_usuario'];

$resultadoAceite = $tabUsuario->consultar_aceite($codUsuario);
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

<body>

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
				<?php 
				if($resultadoAceite==1){
					echo '<li><a href="catalogoConvencional.php">Sistemas Convencionais</a></li>';
				}
				?>                
                <li><a href="../seguranca/sair.php">Sair</a></li>
				
			</ul>
		</div>
	</div>



	<div class="container">
		<div class="page-header">
			<H2 id="bemVindo">Sistemas Inovadores</small></H2>
		</div>
		<div id="comoPreencher" style="margin-top:5px">
		 <p>Consiste em sistema ou subsistema construtivo que não seja objeto de norma brasileira prescritiva e não tenha tradição de uso no território nacional. Estes processos constituem inovações em relação ao processo convencional da construção civil no Brasil.</p>
		</div>
	</div>	
	<br>
			<div class="corpo" style="position: relative"> <!--CORPO DA PÁGINA-->
			<div ng-controller="CatalogoInovador"> <!--Inicio Tabela Catálogo-->
				<div class="container"> 
					<div class="row">
						
							
							<div id ="filtrarCatalogo" class="well" style="padding-left: 0px; padding-top: 0px; padding-right: 0px; text-align:center">
							<h1 style="background-color: #E1E1E1; font-size: 17px; margin-top:0; padding-top: 5px; padding-bottom: 5px">Filtrar Diretrizes e Datecs</h1>
								<div class="form-inline">
									<label class="labelFiltro">Diretriz:</label>
										<select ng-model="diretriz.num_numero_diretriz" class="form-control" ng-change="mudarDiretriz()">
											<option value="">Todas</option>
											<option ng-repeat="item in catalogoInovador | orderBy: 'item.num_numero_diretriz'" value="{{item.num_numero_diretriz}}">Diretriz SiNAT nº {{item.num_numero_diretriz}}</option>
										</select>
								  

									<label class="labelFiltro">DATec:</label>
										<select ng-model="datec.num_ordem_ficha" class="form-control" ng-change="mudarDatec()">
											<option value="">Todos</option>
											<option ng-repeat="itemDatec in catalogoDatec" value="{{itemDatec.num_ordem_ficha}}">DATec nº {{itemDatec.num_ordem_ficha}}</option>
										</select>							
										
									<label class="labelFiltro">Buscar Palavra-Chave: </label>
									<input ng-model="buscar" placeholder="Ex: Bloco cerâmico" class="form-control" autofocus></input>
									
								</div>
								
								<div class="form-inline filtroOrdem">
									<label class="labelFiltroPequeno"> Ordenar por:
										<select ng-model="ordem" class="form-control input-sm">
											<option value="numero">Numero</option>
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
							</div>
							<hr>
							
							<table id="tabelaCatalogo" class="table table-bordered">
							  <h1>Diretrizes SiNAT:</h1>
							  <tr>
								<th class="col-xs-2">Diretriz SiNAT Nº</th>
								<th class="col-xs-1">Revisão nº</th>
								<th class="col-xs-2">Data de Publicação</th>
								<th class="col-xs-1">DATecs vinculadas</th>
								<th class="col-xs-5">Descrição</th>
								<th class="col-xs-1">Download</th>
							  </tr>
							  <tr ng-animate="'animate'" class="fileiraCatalogo" ng-repeat="item in catalogoInovador | filter: buscar | filter: diretriz:identical | filter: datec | orderBy: ordem:direcao" >
								<td>{{item.num_numero_diretriz}}</td>
								<td>{{item.num_ultima_revisao}}</td>
								<td>{{item.dte_data_pulicacao_diretriz | date:'dd/MM/yyyy'}}</td>
								<td>{{item.num_ordem_ficha}}</td>
								<td>{{item.txt_descricao_diretriz}}</td>
								<td class="text-center"><a ng-href="../../{{item.txt_caminho_arquivo}}" download ng-click="countDownloadDiretriz(item.cod_diretriz, <?php echo $codUsuario; ?>)"><i class="fa fa-file-pdf-o fa-4x"></i></a></td>
                                

							  </tr>
							</table>	
					</div>
				</div> <!--Fim Container-->
			
				<div class="container"> 
					<div class="row">
						
						
							<hr>
							
							<table id="tabelaCatalogo" class="table table-bordered">
							  <h1>DATecs:</h1>
							  <tr>
								<th class="col-xs-1">DATec nº</th>
								<th class="col-xs-1">Versão</th>
								<th class="col-xs-2">Validade</th>
								
								<th class="col-xs-1">Diretriz</th>
								<th class="col-xs-6">Descrição</th>
								<th class="col-xs-1">Download</th>
							  </tr>

							  <tr ng-animate="'animate'" class="fileiraCatalogo" ng-repeat="itemDatec in catalogoDatec | filter: buscar | filter: datec | filter: diretriz:identical | orderBy: ordem:direcao">
								<td>{{itemDatec.num_ordem_ficha}}</td>
								<td>{{itemDatec.txt_ultima_versao}}</td>
								<td>{{itemDatec.dte_data_validade | date:'dd/MM/yyyy'}}</td>
								<td>{{itemDatec.num_numero_diretriz}}</td>
								<td>{{itemDatec.txt_descricao_datec}}</td>
								<td class="text-center"><a ng-href="../../{{itemDatec.txt_caminho_arquivo}}" download ng-click="countDownloadDatec(itemDatec.cod_catalogo_datec, <?php echo $codUsuario; ?>)"><i class="fa fa-file-pdf-o fa-4x"></i></a></td>
							  </tr>
							</table>	
						
				
					</div>
				</div> <!--Fim Container-->
			</div> <!--Fim Controle Inovador-->
		</div> <!--FIM CORPO DA PÁGINA-->
	
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
    <script src="http://barra.brasil.gov.br/barra.js" type="text/javascript" defer async></script>





</body>


