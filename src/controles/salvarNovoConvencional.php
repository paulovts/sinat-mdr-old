<?php
include("../../require/class/Opc_sistema.class.php");


$opcSistema = new Opc_sistema;

?>

<!DOCTYPE html>
<html ng-app="postApp"><!--postApp: Directiva que define o angularjs na aplicação-->

<head>
	<meta charset="utf-8">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300|Montserrat:700,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Handlee' rel='stylesheet' type='text/css'>
	<link href="../../_css/bootstrap.min.css" rel="stylesheet">
	<link href="../../_css/norma.css" rel="stylesheet">
    <!-- FormValidation CSS -->
	<link href="../../_css/formValidation.min.css" rel="stylesheet">
    
    <script src="../../_scripts/angular/angular.min.js"></script>
	<script src="../../_scripts/angular/controlCadNovoConv.js"></script>
    
	
	<!-- FontAwesome CSS -->
	<link rel="stylesheet" href="../../_css/font-awesome.min.css">
	<title>Minha Casa Minha Vida - Ministério das Cidades</title>
 </head>

<body class="ng-scope" ng-controller="controlCadNovoConv"><!--controlCadNovoConv: Directiva que define o controlador na aplicação-->

	<div id="barra-identidade">
		<div id="barra-brasil">
			<a href="http://brasil.gov.br" style="background:#7F7F7F; height: 20px; padding:4px 0 4px 80px; display: block; font-family:sans,sans-serif; text-decoration:none; color:white; ">Portal do Governo Brasileiro</a>
		</div>	
	</div>

	<div id='head' style="position:relative">
		<div class = "container">
			<div id="min"><p>Ministério das Cidades</p></div>
			<div id="saci"><H1>Normas de Desempenho</H1></div>
			<div id="sistema"><H6>Melhoria do Desempenho dos Empreendimentos de Habitação de Interesse Social</H6></div>
			<img src="../../_images/MCMV1.png" style="position:relative; left:829px; top:-105px; z-index:1; padding-bottom:-50px;">
		</div>
	</div>

	<div id='nav' style="position:relative">
		<div class = "container">
			<ul>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sistemas Convencionais <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="">Cadastrar Novo</a></li>
                    <li><a href="">Revisão</a></li>
                    <li><a href="">Downloads</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sistemas Inovadores <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="">Cadastrar Novo</a></li>
                    <li><a href="">Revisão</a></li>
                    <li><a href="">Downloads</a></li>
                  </ul>
                <li><a href="../seguranca/sair.php">Sair</a></li>
			</ul>
		</div>
	</div>



	<div class="container">
		<div class="page-header">
			<H2 id="bemVindo">Sistemas Convencionais</small></H2>
		</div>
	</div>

	
	<div class="container">
			<div class="nome">
				<H3>Novo Catálogo Convencional</H3>
			</div>
			<div class="well">
				<form id="formularioUsuario" method="post" action="salvarUsuario.php">
				<div class="form-group">
                    <div class="row">                        
                        <div class="col-md-4">
                            <label for="nomeSistema">Sistema:</label>
                            <select class="form-control" id="comboSistema" name="comboSistema">
                                <option value="">Escolha</option>
                                <?php
								$stmSistema = $opcSistema->listarSistema();
								foreach($stmSistema as $dadosSistema){
									echo '<option value="'.$dadosSistema['cod_sistema'].'">'.$dadosSistema['txt_sistema'].' - '.$dadosSistema['txt_sigla_sistema'].'</option>';
								}
								
								?>
                            </select>
						</div>
                        <div class="col-xs-1" id="addButton">
                            <br>
                            <button type="button" class="btn btn-default addButton" data-toggle="modal" data-target="#cadSistema"><i class="fa fa-plus"></i></button>                        </div>
                    </div>
               </div>
               <div class="form-group">
                    <div class="row">                        
                        <div class="col-md-4">
                            <label for="solucao">Solução:</label>
                            <select class="form-control" id="comboSolucao" name="comboSolucao">
                                <option value="">Escolha</option>
                            </select>
						</div>
                        <div class="col-xs-1" id="addButton">
                            <br>
                            <button type="button" class="btn btn-default addButton" data-toggle="modal" data-target="#cadSolucao"><i class="fa fa-plus"></i></button>                        </div>
                    </div>
               </div>
               <div class="form-group">
                    <div class="row">                        
                        <div class="col-md-4">
                            <label for="tipoSolucao">Tipo de Solução:</label>
                            <select class="form-control" id="comboTipoSolucao" name="comboTipoSolucao">
                                <option value="">Escolha</option>
                            </select>
						</div>
                        <div class="col-xs-1" id="addButton">
                            <br>
                            <button type="button" class="btn btn-default addButton" data-toggle="modal" data-target="#cadSistema"><i class="fa fa-plus"></i></button>                        </div>
                    </div>
               </div>
               <div id="dadosContato">
                	<div class="tituloForm">
                        <H4>Dados do Contato</H4>
                        <hr class="divider">
                   	</div>    
                    <div class="form-group">
						<div class="row">
							
                            <div class="col-md-4">
								<label class="control-label ">Nome</label>
								<input type="text" class="form-control" name="nome" placeholder="José" id="nomeContato"/>
							</div>

							<div class="col-md-4">
								<label class="control-label">Sobrenome</label>
								<input type="text" class="form-control" name="sobrenome" placeholder="Silva"id="sobrenomeContato"/>
							</div>
							
							<div class="col-md-4">
								<label class="control-label">Cargo</label>
								<input type="text" class="form-control" id="cargo" name="cargo" placeholder="Gerente" />
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

<div class="container">   			
		<div class="panel panel-primary">
			<div class="panel-heading">
            	<h3 class="panel-title">Fazer upload </h3>
            </div>
			<div class="panel-body">
				<form id="arquivoPdf" class="form-horizontal" method="post" enctype="multipart/form-data" action="">					
						<div class="col-xs-5 selectContainer">
                        <!-- MAX_FILE_SIZE deve preceder o campo input -->
						    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
							<input type="file" class="form-control" name="userfile" />
						</div>
						<div class="col-xs-2">
							<button type="submit" class="btn btn-primary btnUploadArquivo" id="">Fazer Upload</button>
						</div>						
				</form>
			</div>
		</div>
	</div>

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

<!----------------------------------------------------------------  MODAL FORMULARIO  CADSISTEMA------------------------------------------------------------>

<div id="cadSistema" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
         
        <h4 class="modal-title tituloModal" id="myModalLabel">CADASTRO DE SISTEMA - Novo</h4>
      </div>
      <div class="modal-body">	  
          <div class="container">			
                  <form id="formularioModal" class="form-horizontal" ng-submit="cadastrarSistema()">
                    <div class="form-group">
                        <div class="row">                        
                            <div class="col-md-3">
                                <label class="control-label">Sistema</label>
                                <input ng-model="opcSistema.nomeSistema" type="text" class="form-control" name="nomeSistemaNovo" placeholder="Sistema de Ventilação" id="nomeSistemaNovo"/>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Sigla</label>
                                <input ng-model="opcSistema.siglaSistema" type="text" class="form-control" name="siglaSistema" placeholder="SVEN" id="siglaSistema"/>
                            </div>
                         </div><!-- row-->
                   </div><!--form-group-->
                   <div class="form-group">
                        <div class="row">                        
                            <div class="col-md-6">
                                <label class="control-label">Descrição do Sistema</label>
                                <textarea ng-model="opcSistema.descicaoSistema" class="form-control" rows="12" placeholder="Descrição do Sistema" name="mensagem"></textarea>
                            </div>
                         </div><!-- row-->
                   </div><!--form-group-->
                   <div class="form-group">
                         <div class="row">                           
                            <div class="col-md-6" id="addButton">
                                <br>
                                <button type="submit" class="btn btn-info btnSalvarSistema" id="btnSalvarSistema" name="btnSalvarSistema">Salvar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" target="_parent" id="fecharFormulario">Fechar</button>
                            </div>
                        </div><!-- row-->
                   </div><!--form-group-->
                  </form>
			</div> <!-- FECHA CONTAINER -->
      </div>    <!-- modal-body-->
   </div><!-- modal-content-->   
 </div><!-- modal-dialog-->     
</div><!-- modal fade-->    
 <!--------------- FIM DO MODAL FORMULÁRIO CADSISTEMA------------------->

<!----------------------------------------------------------------  MODAL FORMULARIO  CADSOLUCAO------------------------------------------------------------>

<div id="cadSolucao" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
         
        <h4 class="modal-title tituloModal" id="myModalLabel">CADASTRO DE SOLUÇÃO - Novo</h4>
      </div>
      <div class="modal-body">	  
          <div class="container">			
                  <form id="formularioModal" class="form-horizontal" ng-submit="cadastrarSistema()">
                    <div class="form-group">
                        <div class="row">                        
                            <div class="col-md-3">
                                <label class="control-label">Solução</label>
                                <input type="text" class="form-control" name="nomeSolucaoNovo" placeholder="Bloco de Concreto" id="nomeSolucaoNovo"/>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Sigla</label>
                                <input type="text" class="form-control" name="siglaSolucao" placeholder="BCO" id="siglaSolucao"/>
                            </div>
                         </div><!-- row-->
                   </div><!--form-group-->
                   <div class="form-group">
                        <div class="row">                        
                            <div class="col-md-6">
                                <label class="control-label">Descrição do Solução</label>
                                <textarea class="form-control" rows="12" placeholder="Descrição do Solução" name="descricaoSolucao"></textarea>
                            </div>
                         </div><!-- row-->
                   </div><!--form-group-->
                   <div class="form-group">
                         <div class="row">                           
                            <div class="col-md-6" id="addButton">
                                <br>
                                <button type="submit" class="btn btn-info btnSalvarSolucao" id="btnSalvarSolucao" name="btnSalvarSolucao">Salvar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" target="_parent" id="fecharFormulario">Fechar</button>
                            </div>
                        </div><!-- row-->
                   </div><!--form-group-->
                  </form>
			</div> <!-- FECHA CONTAINER -->
      </div>    <!-- modal-body-->
   </div><!-- modal-content-->   
 </div><!-- modal-dialog-->     
</div><!-- modal fade-->    
 <!--------------- FIM DO MODAL FORMULÁRIO CADSOLUCAO------------------->




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
<script src="../../_scripts/cadastrarCatalogo.js"></script>

    <script src="http://barra.brasil.gov.br/barra.js" type="text/javascript" defer async></script>

         
          



</body>


