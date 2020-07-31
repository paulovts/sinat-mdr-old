<?php
include("../seguranca/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página



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
	<script src="../../_scripts/angular/controllersAdm.js"></script>
	
	<title>Administrador  - SiNAT</title>
 </head>

<body>

	<div id="barra-identidade">
		<div id="barra-brasil">
			<a href="http://brasil.gov.br" style="background:#7F7F7F; height: 20px; padding:4px 0 4px 80px; display: block; font-family:sans,sans-serif; text-decoration:none; color:white; ">Portal do Governo Brasileiro</a>
		</div>	
	</div>

	<div id='head' style="position:relative">
		<div class = "container">
			<div id="min"><p>Ministério das Cidades</p></div>
			<div id="saci"><H1>Desempenho Técnico para HIS</H1></div>
			<div id="sistema"><H6>SiNAT - Sistemas Convencionais e Inovadores</H6></div>	
		</div>
	</div>

	<div id='nav' style="position:relative">
		<div class = "container">
			<ul>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sistemas Convencionais <span class="caret"></span></a>
                  <ul class="dropdown-menu submenu" role="menu">                   
                    <li><a href="sistemaConvencional/formCadNovoConvencional.php">Nova Catálogo</a></li>                    
                    <li><a href="">Revisão</a></li>
                    <li><a href="">Downloads</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sistemas Inovadores <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="">Nova DATEC</a></li>
                    <li><a href="">Nova Diretriz</a></li>
                    <li><a href="">Revisão</a></li>
                    <li><a href="">Downloads</a></li>
                  </ul>
                <li><a href="../seguranca/sair.php">Sair</a></li>
			</ul>
		</div>
	</div>



	<div class="container">
		<div class="page-header">
			<H2 id="bemVindo">Bem vindo</small></H2>
		</div>
		<div id="comoPreencher" style="margin-top:5px">
		 <p>A documentação técnica contida neste sistema foi desenvolvida, por iniciativa do Ministério das Cidades, em parceria com a Caixa, entidades públicas e privadas, para apoiar incorporadores, construtores, projetistas, fabricantes de componentes, empreendedores em geral, na obtenção de edificações que atendam aos requisitos, critérios e parâmetros de Desempenho estabelecidos na ABNT NBR 15575.</p>				
		</div>
	</div>	
	<br>
			<div class="corpo" style="position: relative"> <!--CORPO DA PÁGINA-->
			<div class="container"> 
				<div class="row">
					<div ng-controller="CatalogoConvencional"> <!--Inicio Tabela Catálogo-->
					
						<h1>Filtrar Catálogos</h1>
						<div id ="filtrarCatalogo" class="well">
							<div class="form-inline">
								<label class="labelFiltro"> Sistema: </label>
									<select ng-model="sistema" class="form-control">
										<option value="">Todos</option>
										<option value="cobertura">Cobertura</option>
										<option value="vedação vertical">Vedação Vertical</option>
										<option value="estruturais">Estruturais</option>
									</select>
								
								
								
								<label class="labelFiltro"> Tecnologia: </label>
									<select ng-model="tecnologia" class="form-control">
										<option value="">Todas</option>
										<option value="bloco cerâmico">Bloco Cerâmico</option>
										<option value="bloco concreto">Bloco de Concreto</option>
										<option value="pré-moldado">Pré-Moldado</option>
										<option value="telha cerâmica">Telha Cerâmica</option>
									</select>	
									
								<label class="labelFiltro">Buscar Palavra-Chave: </label>
								<input ng-model="buscar" placeholder="Ex: Bloco cerâmico" class="form-control" autofocus></input>
							</div>
							
							<div class="form-inline filtroOrdem">
								<label class="labelFiltroPequeno"> Ordenar por:
									<select ng-model="ordem" class="form-control input-sm">
										<option value="sistema">Sistema</option>
										<option value="nome">Nome</option>
										<option value="tecnologia">Tecnologia</option>
										<option value="dataAtualizacao">Data de Atualização</option>
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
						  <h1>Catálagos Disponíveis:</h1>
						  <tr>
							<th class="col-xs-1">Sistema</th>
							<th class="col-xs-2">Nome</th>
							<th class="col-xs-2">Tecnologia</th>
							<th class="col-xs-2">Data de Atualização</th>
							<th class="col-xs-4">Descrição</th>
							<th class="col-xs-1">Download</th>
						  </tr>
						  <tr ng-animate="'animate'" class="fileiraCatalogo" ng-repeat="item in catalogo | filter: buscar | filter: sistema | filter: tecnologia | orderBy: ordem:direcao">
							<td>{{item.sistema}}</td>
							<td>{{item.nome}}</td>
							<td>{{item.tecnologia}}</td>
							<td>{{item.dataAtualizacao}}</td>
							<td>{{item.descricao}}</td>
							<td><a href="{{item.url}}" download><i class="fa fa-file-pdf-o fa-4x"></i></a></td>

						  </tr>
						</table>	
					</div> <!--Fim Tabela Catálogo-->
			
				</div>
			</div>
		</div>
	
<br><br><br>

	 <div id="footer">
			<div class="container">
				<a href="http://www.cidades.gov.br/"><H4>Ministério das Cidades</h4></a>
				<a href="http://www.cidades.gov.br/index.php/habitacao"><p>Secretaria Nacional de Habitação</p></a>
				<a href="http://www.cidades.gov.br/index.php/habitacao/programa-minha-casa-minha-vida-pmcmv"><p>Programa Minha Casa Minha Vida</p></a>
				<a href="http://www.cidades.gov.br/index.php/habitacao/departamentos/dict"><p>Desenvolvido e gerenciado pela Gerência de Informação Departamento de Desenvolvimento Institucional e Cooperação Técnica</p></a>
			</div>
		</div>
		<div id="footer-brasil"></div>
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
	<script type="../../text/javascript" src="../paginas/_scripts/formValidation/pt_BR.js"></script> <!-- Tradução da validação para Português -->

	<!--JS Personalizado-->
	
    <script src="http://barra.brasil.gov.br/barra.js" type="text/javascript" defer async></script>





</body>


