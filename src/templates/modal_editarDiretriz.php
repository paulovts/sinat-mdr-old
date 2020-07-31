<?php
include"../seguranca/seguranca.php"; // Inclui o arquivo com o sistema de segurança
protegePagina();
?>
<!-- Modal Editar fichas-->
<div id="modalEditarDiretriz" class="modal fade">
  <div class="modal-dialog modal-lg">
	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">EDITAR DIRETRIZ</h4>
	  </div>
	  <div class="modal-body">		
		<form id="formularioEditaDiretriz" enctype="multipart/form-data" method="post" action="../../controles/editarDiretriz.php">								
			<div class="well">
			  <div class="form-group">
				 <div class="row">
					<div class="col-xs-12 col-md-3 hide" >
						<input ng-model="itemDadosDiretriz.cod_diretriz" type="text" class="form-control" name="codDiretriz">					
					</div>								        
				 </div>
			 </div>
			 <div class="form-group">
				 <div class="row">
					<div class="col-xs-12 col-md-3">
						<label for="numDiretriz">Número Riretriz:</label>
						<input ng-model="itemDadosDiretriz.num_numero_diretriz" type="text" class="form-control" name="numDiretriz" disabled>						
					</div>
					<div class="col-xs-12 col-md-3">
						<label for="dataPublicacao">Data Publicação:</label>
						<input ng-model="itemDadosDiretriz.dte_data_pulicacao_diretriz | date:'dd/MM/yyyy'" type="text" class="form-control" name="dataPublicacao" disabled>					
					</div>
					<div class="col-xs-12 col-md-3">     
						<label for="numUltimaRevisao">No. Revisão Atual:</label>
						<input ng-model="itemDadosDiretriz.num_ultima_revisao" class="form-control" name="numUltimaRevisao" disabled>
					</div>
					<div class="col-xs-12 col-md-3">     
						<label for="dataEdicao">Data Última Edição:</label>
						<input ng-model="itemDadosDiretriz.dte_data_edicao | date:'dd/MM/yyyy'" class="form-control" name="dataEdicao" disabled>
					</div>				        
				 </div>
			 </div>
			 <div class="form-group">
				 <div class="row">
					<div class="col-xs-12 col-md-12">
						<label for="descricao">Descrição Atual:</label>
						<textarea ng-model="itemDadosDiretriz.txt_descricao_diretriz" type="text" heigth class="form-control" rows="4" name="descricao" ng-disabled="habilitarDesc"></textarea>					
					</div>
					
				 </div>
			 </div>
			 
		</div><!-- primeiro well-->	
		
		<div class="well" ng-show="abrirRevisao" >
			<div class="form-group">
				 <div class="row">
					<div class="col-xs-12 col-md-4">
						<label for="numUltRevisao">No. Última Revisão:</label>
						<input ng-model="numUltRevisao" type="text" class="form-control" ng-change="mudarRevisao(numUltRevisao)" name="numUltRevisao">					
					</div>
					<div class="col-xs-12 col-md-5">     
						<label for="usuarioRevisao">Nome do Revisor:</label>
						<input class="form-control" name="usuarioRevisao" value="<?php echo strtoupper($_SESSION['txt_nome']);?>" disabled>
					</div>				        
				 </div>
	 		</div>
 		<div class="form-group">
			 <div class="row">
				<div class="col-xs-12 col-md-12">
					<label for="alteracaoRealizada">Alteração Realizada:</label>
					<textarea type="text" heigth class="form-control" rows="4" name="alteracaoRealizada"></textarea>					
				</div>			
		 	</div>
	 	</div>
	 
		<div class="form-group">
 			<div class="row">
				<div class="col-xs-12 col-md-12">
                	<label for="alteracaoRealizada">Fazer Upload</label>
                	<!-- MAX_FILE_SIZE deve preceder o campo input -->
				    <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
					<input type="file" class="form-control btn btn-default" name="userfile" />

				</div>						
			</div>	
		</div>
				
		 	<button type="submit" id="submit" class="btn btn-primary">Salvar</button>
		 </div><!-- segundo well-->	
		
	</div> 

	  <div class="modal-footer">
		<button type="button" class="btn btn-info" ng-click="revisarDiretriz(itemDadosDiretriz)">Revisar Ficha</button>
		<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
	  </div>
	  </form>	
	</div>

  </div>
</div>