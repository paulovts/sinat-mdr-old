<?php
include("../seguranca/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página


$codUsuario = $_SESSION['cod_usuario'];

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
    <!-- FormValidation CSS -->
	<link href="../../_css/formValidation.min.css" rel="stylesheet">
	
	<!-- FontAwesome CSS -->
	<link rel="stylesheet" href="../../_css/font-awesome.min.css">
	<title>Desempenho Técnico para HIS</title>
 </head>


<!-- ANgularJS-->
<script src="../../_scripts/angular/angular.min.js"></script>
<script src="../../_scripts/angular/angular-animate.min.js"></script>
<script src="../../_scripts/angular/app.js"></script>
<script src="../../_scripts/angular/controllers.js"></script>
<script src="../../_scripts/angular/controllersAtualizacao.js"></script>
<title>Desempenho Técnico para HIS</title>
</head>


<body id="frmEscolhaSistem" data-nome="<?php echo $codUsuario;?>"  ng-controller="fichasAtualizacao">
	<div id="barra-identidade">
	  <div id="barra-brasil"> <a href="http://brasil.gov.br" style="background:#7F7F7F; height: 20px; padding:4px 0 4px 80px; display: block; font-family:sans,sans-serif; text-decoration:none; color:white; ">Portal do Governo Brasileiro</a> </div>
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
				<li><a href="../seguranca/sair.php">Sair</a></li>
			</ul>
		</div>
	</div><br>

<br>


	<div class="container">
    <br>
		<div class="well" style="padding-left: 0">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2" style="padding-left: 0; ">
                        <a href="../controles/consultarAceite.php?codUsuario=<?php echo $codUsuario;?>"><img class="img-responsive" src="../../_images/tijolos.jpg"/></a>
                    </div>
                    <div class="col-md-10">
	                     <H3><a href="../controles/consultarAceite.php?codUsuario=<?php echo $codUsuario;?>">Sistemas Convencionais</a></H3>
                        <p>Entende-se como sistemas convencionais os que têm tradição de uso no território nacional e cujos componentes possuem norma técnica brasileira.</p>
                    </div>
                </div>
			</div>                                
		</div>
	
        <div class="well" style="padding-left: 0">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2" style="padding-left: 0">
                        <a href="catalogoInovador.php"><img class="img-responsive" src="../../_images/steel-frame.jpg" /></a>
                    </div>
                    <div class="col-md-10">
                         <H3><a href="catalogoInovador.php">Sistemas Inovadores</a></H3>
                        <p>Entende-se como sistemas e produtos inovadores os que não possuem norma técnica brasileira para a análise de desempenho e não tenham tradição de uso no território nacional.</p>
                    </div>
                </div>
			</div>
        </div>
 
        
	</div> <!-- FECHA CONTAINER -->
	
<br><br><br>

<!-- Modal aviso atualização de fichas-->
<div ng-show="existeFicha">
    <div class="modal fade" id="modalAtualizacao">
      <div class="modal-dialog"  style="width:800px;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">ATENÇÃO: Fichas Desatualizadas</h4>
            <p>Relação de fichas que sofreram atualização.</p>
          </div>
          <div class="modal-body">
            <table class="table-bordered" ng-show="existeFicha">
              <thead>
              </thead>
              <tbody class="table">
                <tr>
                  <th style="width:10%; padding:2px;">Tipo</th>
                  <th style="width:20%; padding:2px;">Nº Ficha</th>
                  <th style="width:60%; padding:2px;">Descricao</th>
                  <th style="width:5%; padding:2px;">Download</th>
                </tr>
                <tr ng-repeat="item in fichasDesatualizadas">
                  <td style="padding:5px;">{{item.tipo_ficha}}</td>
                  <td class="text-center" style="padding:5px;">{{item.num_ficha}}</td>
                  <td  style="padding:5px;">{{item.descricao}}</td>
                  <td class="text-center" style="padding:5px;"><a ng-href="../../{{item.url}}" download ng-click="countDownloadFichas(item.tipo_ficha, item.cod_ficha_pk, <?php echo $codUsuario; ?>)"><i class="fa fa-file-pdf-o fa-4x"></i></a></td>
                </tr>
              </tbody>
            </table>
            <p ng-hide="existeFicha">Não existem fichas desatualizadas.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content --> 
      </div>
      <!-- /.modal-dialog --> 
    </div>
    <!-- /.modal -->
</div>
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
>>>>>>> .r102

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
<script src="http://barra.brasil.gov.br/barra.js" type="text/javascript" defer async></script><script type="text/javascript">
 $(window).load(function(){
                $('#modalAtualizacao').modal('show');
            });
</script>

</body>
</html>
