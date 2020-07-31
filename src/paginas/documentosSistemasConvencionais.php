<?php
include("../seguranca/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

$codUsuario = $_SESSION['cod_usuario'];

require_once"../../require/class/Tab_usuarios.class.php";

$tabUsuario = new Tab_usuarios;

$resultadoAceite = $tabUsuario->consultar_aceite($codUsuario);

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
    <!-- FormValidation CSS -->
	<link href="../../_css/formValidation.min.css" rel="stylesheet">
	
	<!-- FontAwesome CSS -->
	<link rel="stylesheet" href="../../_css/font-awesome.min.css">
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
            	<?php 
				if($resultadoAceite==1){
					echo '<li><a href="catalogoConvencional.php">Sistema Convencional</a></li>';
					echo '<li><a href="catalogoInovador.php">Sistema Inovador</a></li>';
				}
				?>
                <li><a href="escolhaSistemas.php">Sistemas</a></li>	
                <li><a href="../seguranca/sair.php">Sair</a></li>
			</ul>
		</div>
	</div>
	<div class="container">
    	<div class="form-group">
        	<div class="row">
            	<div class="nome">
	                <H3>Sistemas Convencionais</H3>                    
            	</div>
            </div>
        </div>    
    </div>
	<div class="container">
    
    <p class="text-justify">De modo a orientar os diversos agentes responsáveis pela produção habitacional no âmbito do Governo Federal, nesse novo cenário de avaliação por desempenho, a SNH elaborou, em parceria com os diversos agentes que integram o setor da construção civil, os seguintes documentos:
                    </p>
        <div class="well">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-1">
                    <a href="../../_catalogos/documentos/Desempenho_Documento_1.pdf" download ><i class="fa fa-file-pdf-o fa-5x"></i></a>
                    </div>
                    <div class="col-md-11">
                    	<p class="text-justify"><strong>Especificações de Desempenho nos Empreendimentos de HIS Baseadas na ABNT NBR 15575 - Edificações Habitacionais - Desempenho</strong> - são estabelecidas orientações para especificações em função dos dados e informações conhecidos sobre o desempenho dos sistemas construtivos;</p>
                        <em>Revisada em: 14/11/2018</em>
                    </div>
                </div>
			</div>
        </div>
        <div class="well">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-1">
                    <a href="../../_catalogos/documentos/Desempenho_Documento_2.pdf" download ><i class="fa fa-file-pdf-o fa-5x"></i></a>
                    </div>
                    <div class="col-md-11">
                         <p class="text-justify">
                            <strong>Orientações ao Proponente para Aplicação das Especificações de Desempenho em Empreendimentos de HIS</strong> - são apresentadas orientações para quem desenvolve empreendimentos, seja o empreendedor, sejam os projetistas, seja a empresa construtora, para o cumprimento das especificações do Programa;
                            <br/>
                            <a href="../../_catalogos/documentos/Desempenho_Documento_2_Anexo_3.xlsx" download><i class="fa fa-file-excel-o"> Planilha de cálculo do isolamento de acordo com o Anexo 3</i></a>
                        </p>
                    </div>
                </div>
			</div>
        </div>
        <div class="well">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-1">
                    <a href="../../_catalogos/documentos/Desempenho_Documento_3.pdf" download ><i class="fa fa-file-pdf-o fa-5x"></i></a>
                    </div>
                    <div class="col-md-11">
                         <p class="text-justify"><strong>Orientações ao Agente Financeiro para Recebimento e Análise dos Projetos</strong> - tem por objetivo apoiar o Agente Financeiro na Etapa de Proposta de Solicitação de Financiamento, no processo de análise da conformidade ao documento “Especificações de desempenho nos empreendimentos de HIS baseadas na ABNT NBR 15575 – Edificações Habitacionais – Desempenho;</p>
                    </div>
                </div>
			</div>
        </div>
        <div class="well">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-1">
                    <a href="../../_catalogos/documentos/Desempenho_Documento_4.pdf" download ><i class="fa fa-file-pdf-o fa-5x"></i></a>
                    </div>
                    <div class="col-md-11">
                         <p class="text-justify"><strong>Catálogo de Desempenho de Subsistemas</strong> - apresenta e orienta a utilização de fichas para escolha de sistemas, subsistemas e elementos construtivos que atendam aos requisitos de desempenho estabelecidos na ABNT NBR 15575.</p>
                    </div>
                </div>
			</div>
        </div>

 		<div class="col-md-1" id="addButton">
            <br>
<?php 
				if($resultadoAceite==0){
					echo '<button type="button" class="btn btn-success btn-lg addButton" data-toggle="modal" data-target="#frmAceite">Acessar Fichas</button>';
				}
				?>
                                    				
        </div>
        
	</div> <!-- FECHA CONTAINER -->
	
<br><br><br>
<!----------------------------------------------------------------  MODAL FORMULARIO  Aceite------------------------------------------------------------>

<div id="frmAceite" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
         
        <h4 class="modal-title tituloModal" id="myModalLabel">TERMO DE RESPONSABILIDADE E COMPROMISSO</h4>
      </div>
      <div class="modal-body">	  
          <div class="container">			
                <form id="formularioModal" class="form-horizontal" method="post" action="../controles/salvarAceite.php">
				<div class="container">                        
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-7">
                                <p>Pelo presente termo, declaro ter ciência dos documentos que compõem o conjunto de “Especificações de Desempenho nos Empreendimentos de HIS baseadas na ABNT NBR 15575”, bem como me responsabilizo por seguir as recomendações contidas nesses documentos. Também estou ciente de que as fichas com desempenho em avaliação deverão ser utilizadas com acompanhamento de uma Instituição Técnica Avaliadora (ITA) que atue no âmbito do SiNAT do PBQP-H.</p>
                                <br>
                                
                            </div>
                        </div>
                    </div>    
                    <div class="form-group">
                         <div class="row">                           
                            <div class="col-md-6">
                                <div class="checkbox">
                                  <input type="hidden" class="form-control" name="codUsuario" id="codUsuario" value="<?php echo $codUsuario;?>"/>
                                  <label><input type="checkbox" value="" id="aceiteTermo" name="aceiteTermo"><p>Eu li e aceito o Termo de Responsabilidade e Compromisso</p></label>
                                </div>
                                
                            </div>
                        </div><!-- row-->
                   </div><!--form-group-->
                   <div class="form-group">
                         <div class="row">                           
                            <div class="col-md-6" id="addButton">
                                <br>
                                <button type="submit" class="btn btn-info" id="btnSalvarAceite" name="btnSalvarAceite">Salvar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" target="_parent" id="fecharFormulario">Fechar</button>
                            </div>
                        </div><!-- row-->
                   </div><!--form-group-->
              </div>     
              </form>
			</div> <!-- FECHA CONTAINER -->
      </div>    <!-- modal-body-->
   </div><!-- modal-content-->   
 </div><!-- modal-dialog-->     
</div><!-- modal fade-->    
 <!--------------- FIM DO MODAL FORMULÁRIO CADSOLUCAO------------------->
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
<script src="../../_scripts/documentosSistemas.js"></script>

    <script src="http://barra.brasil.gov.br/barra.js" type="text/javascript" defer async></script>





</body>


