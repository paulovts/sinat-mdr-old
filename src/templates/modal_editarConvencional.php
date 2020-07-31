<?php
include"../seguranca/seguranca.php"; // Inclui o arquivo com o sistema de segurança
protegePagina();
?>
<!-- Modal Editar fichas-->
<div id="modalEditarFicha" class="modal fade">
  <div class="modal-dialog modal-lg">
	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">EDITAR FICHAS - SISTEMA CONVENCIONAL</h4>
	  </div>
	  <div class="modal-body">		
		<form id="formularioEditaCatConv" enctype="multipart/form-data" method="post" action="../../controles/editarCatalogoConv.php">								
			<div class="well">
			  <div class="form-group">
				 <div class="row">
					<div class="col-xs-12 col-md-3 hide" >
						<input ng-model="itemDados.numero" type="text" class="form-control" name="codCatalogo">					
					</div>								        
				 </div>
			 </div>
			 <div class="form-group">
				 <div class="row">
					<div class="col-xs-12 col-md-3">
						<label for="codFicha">Código Ficha Atual:</label>
						<input ng-model="itemDados.txt_cod_ficha" type="text" class="form-control" name="codFicha" disabled>						
					</div>
					<div class="col-xs-12 col-md-4">
						<label for="sistema">Sistema:</label>
						<input ng-model="itemDados.sistema" type="text" class="form-control" name="sistema" disabled>					
					</div>
					<div class="col-xs-12 col-md-5">     
						<label for="solucao">Solução:</label>
						<input ng-model="itemDados.solucao" class="form-control" name="solucao" disabled>
					</div>				        
				 </div>
			 </div>
			 <div class="form-group">
				 <div class="row">
					<div class="col-xs-12 col-md-12">
						<label for="descricao">Descrição Atual:</label>
						<textarea ng-model="itemDados.descricao" type="text" heigth class="form-control" rows="4" name="descricao" ng-disabled="habilitarDesc"></textarea>					
					</div>
					
				 </div>
			 </div>

			<div class="form-group">
			   <div class="row">
					<div class="col-xs-12 col-md-3">
						<label for="numRevisao">No. Revisão Atual:</label>
						<input ng-model="itemDados.num_ultima_revisao" class="form-control" name="numRevisao" disabled>	
					</div>
					<div class="col-xs-12 col-md-4">
						<label for="dataRevisao">Data Última Revisão:</label>
						<input ng-model="itemDados.dte_data_edicao | date:'dd/MM/yyyy'" class="form-control" name="dataRevisao" disabled>	
					</div>
					<div class="col-xs-12 col-md-5">						
						<label for="situacao">Situação Atual:</label>
						<input ng-model="itemDados.situacao" class="form-control" name="situacao" disabled>	
					</div>
			   </div>	
			</div> 
		</div><!-- primeiro well-->	
		
		<div class="well" ng-show="abrirRevisao" >
			<div class="form-group" ng-show="desempenhoAvaliado">
				 <div class="row">
					<div class="col-xs-12 col-md-5">
						<label for="situacaoNova">Situação Nova:</label>
						<select ng-model="situacaoNova" class="form-control" id="estado" ng-change="mudarSituacao(situacaoNova, itemDados)" ng-disabled="ride" name="situacaoNova">
							<option value="1">Desempenho Avaliado</option>	
							<option value="2">Desempenho em Avaliação</option>	
						</select>					
					</div>			
			 	</div>
		 	</div>

			<div class="form-group">
				 <div class="row">
					<div class="col-xs-12 col-md-3">
						<label for="codFichaNovo">Código Ficha:</label>
						<input ng-model="codFichaNovo" type="text" class="form-control" name="codFichaNovo">						
					</div>
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
				    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
					<input type="file" class="form-control btn btn-default" name="userfile" />

				</div>						
			</div>	
		</div>
				
		 	<button type="submit" id="submit" class="btn btn-primary">Salvar</button>
		 </div><!-- segundo well-->	
		
	</div> 

	  <div class="modal-footer">
		<button type="button" class="btn btn-info" ng-click="revisarFicha(itemDados)">Revisar Ficha</button>
		<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
	  </div>
	  </form>	
	</div>

  </div>
</div>