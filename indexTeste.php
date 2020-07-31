
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300|Montserrat:700,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Handlee' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300' rel='stylesheet' type='text/css'>
	<link href="_css/bootstrap.min.css" rel="stylesheet">
	<link href="_css/norma.css" rel="stylesheet">

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
				<li><a href=""></a></li>

			</ul>
		</div>
	</div>



	<div class="corpo" style="position: relative">
		<div class="container">
			<div class="row">
				<div class="col-md-8"> <!--COLUNA ESQUERDA-->
					<div class="nome">
							<h3>SISTEMA NACIONAL DE AVALIAÇÃO TÉCNICA DE SISTEMAS INOVADORES E CONVENCIONAIS - SiNAT</h3>
					</div>        
					<br>
					<p class="text-justify">Sistema Nacional de Avaliação Técnica de Sistemas Inovadores e Convencionais empregados em empreendimentos habitacionais, baseado no conceito de desempenho.  O SiNAT tem como objetivo a harmonização de procedimentos para a avaliação técnica de Sistemas Inovadores e Convencionais da Construção Civil no Brasil.</p><br>
                    <img src="_images/imgSINAT.png" class="img-responsive"/>
				</div>
					
				<div class="col-md-4"> <!--COLUNA DIREITA-->
					<div class="login">
						<h4>ÁREA DE ACESSO</H4>
						<form class="form-signin" method="post" action="	">
							<label for="usuario" class="sr-only">Usu&aacute;rio</label>
							<input type="text" id="usuario" name="usuario"class="form-control" placeholder="Email" required autofocus><p class="erro hide" id="erroUsuario" >Informe o usu&aacute;rio</p>
							<br id="quebralinha1">
							<br class="hide" id="quebralinha2">
							<label for="senha" class="sr-only">Senha</label>
							<input type="password" id="senha" class="form-control" placeholder="Senha" required>
						
                        	<div class="checkbox">
							<!--
                            	<label>
									<input type="checkbox" value="lembrar"> Lembrar usu&aacute;rio
								</label>
                             -->   
							</div>
                            
							<button id="login" class="btn btn-lg btn-primary btn-block" type="button">Entrar</button>
						</form>
						<br>
						<a href="" data-toggle="modal" data-target="#formularioModal">Esqueci a senha</a><br>
						<a href="src/paginas/cadUsuario.php">Clique aqui para cadastrar</a><br>									
					</div> <!--fecha login-->            
				</div> <!--fecha col-md-4-->
				
			</div> <!--fecha row-->
		</div> <!--fecha container-->
	</div> <!--fecha corpo-->
	
<br><br><br>
<!----------------------------------------------------------------  MODAL FORMULARIO  Aceite------------------------------------------------------------>

<div id="formularioModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
         
        <h4 class="modal-title tituloModal" id="myModalLabel">SOLICITAÇÃO DE ALTERAÇÃO DE SENHA</h4>
      </div>
      <div class="modal-body">	  
          <div class="container">			
                <form id="frmEsqueciSenha" class="form-horizontal" method="post" action="src/controles/enviarEmailAlteracao.php">
				<div class="container">                        
                    <div class="form-group">
                        <div class="row">
                        	<div class="col-xs-7">
	                           <input type="text" id="emailEsqueci" name="emailEsqueci"class="form-control" placeholder="Informe o email cadastrado." required autofocus>
							</div>	
                        </div>
                    </div>    
                   
                   <div class="form-group">
                         <div class="row">                           
                            <div class="col-md-6" id="addButton">
                                <br>
                                <button type="submit" class="btn btn-info" id="btnEsqueciSenha" name="btnEsqueciSenha">Enviar</button>
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
				<img src="_images/MCMV_C.png" style="position:relative; left:800px; top:-65px; z-index:1; padding-bottom:-50px; width: 120px;">
			</div>
		</div>
		<div id="footer-brasil"></div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="_scripts/jquery-1.11.2.min.js"></script>

<!--Bootstrap JS-->
	<script src="_scripts/bootstrap.min.js"></script>
    <script src="_scripts/bootbox.min.js"></script>
    
    
    <!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script src="_scripts/formValidation/formValidation.min.js"></script>
<script src="_scripts/formValidation/bootstrap.min.js"></script> <!-- Arquivo necessario para acessar o Bootstrap com o Form Validation -->
<script type="text/javascript" src="_scripts/formValidation/pt_BR.js"></script> <!-- Tradução da validação para Português -->

    <script src="_scripts/principal.js"></script>
    <script src="http://barra.brasil.gov.br/barra.js" type="text/javascript" defer async></script>





</body>


