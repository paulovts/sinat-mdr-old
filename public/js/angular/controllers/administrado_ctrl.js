angular.module('myApp')
	.controller('CatalogoConvencionalAdm', ['$scope', '$http', function ($scope, $http) {
	
	$http.get('../../arquivosJSON/json_dados_catalogo_convencional.php').success(function(data) {
		$scope.catalogo = data;
		$scope.ordem = 'sistema';
		
		//Inicializar a solucao com todas as soluções quando abrir a pagina
		$scope.novaSolucao = [];
		$http.get('../../arquivosJSON/json_dados_sistemas_solucao.php?nomeSistema=').success(function(result){
				var resultado = result;
				
				
				for (var i = 0; i < resultado[0].solucoes.length; i++){
					if (resultado[0].solucoes[i] != null){
						$scope.novaSolucao.push(resultado[0].solucoes[i]);
					}
				}
				
		});
		
		
		
		$scope.mudarSolucao = function() {
			$scope.novaSolucao = [];
			$scope.solucao = "";
			
			$http.get('../../arquivosJSON/json_dados_sistemas_solucao.php?nomeSistema='+$scope.sistema).success(function(result){
				var resultado = result;
				
				for (var i = 0; i < resultado[0].solucoes.length; i++){
					if (resultado[0].solucoes[i] != null){
						$scope.novaSolucao.push(resultado[0].solucoes[i]);
					}
				}
				$scope.numeroSolucoes = $scope.novaSolucao.length;
			});
			
		}; //funcao mudarSolucao
		
		
		// Cria uma array com objetos com todas as situa??es poss?veis do BD. 
		$scope.situacaoFicha = [];
		for (var i = 0; i < $scope.catalogo.length; i++){		
                    var existe = 0;
	        	for (var j = i + 1; j < $scope.catalogo.length; j++) {
		            if ($scope.catalogo[j].situacao == $scope.catalogo[i].situacao) {
		            		existe = 1;	  
                            }
	        	}       	
	        
		   var count;
		   if($scope.situacaoFicha.length == 0){
			var situacao = "";
			count = 0;
		   }
		   
                    var situacaoCatalogo = $scope.catalogo[i].situacao;
		   if ( existe == 0) {
				
                        $scope. situacaoFicha[count]= {
                                key: situacaoCatalogo,
                                tipo: situacaoCatalogo
                        };
				
			situacao = situacaoCatalogo;
			count++;
		   }
		}
		

		//Seleciona a primeira situa??o "Desempenho avaliado".
		$scope.situacao = $scope.situacaoFicha[1].tipo;

		//Muda o t?tulo das fichas dependendo da situa??o das fichas escolhidas.

		$scope.titulo = "Soluções com desempenho avaliado";
		$scope.emAvaliacao = false;
		$scope.mudarNome = function() {
			if ($scope.situacao == "Desempenho avaliado"){
				$scope.titulo = "Soluções com desempenho avaliado";
				$scope.emAvaliacao = false;
			} else {
				$scope.titulo = "Soluções com desempenho em avaliação";
				$scope.emAvaliacao = true;
			}
		}

	}); //primeiro $http
	
	//Criar scope do modal para download de fichas "em desenvolvimento"
	$scope.modal = {};
	$scope.abrirModal = function(item, url) {
		$scope.modal.itemnumero = item;
		$scope.modal.url = url;
	};


//fucoes para modal editar ficha	
	$scope.revisao = {};
	$scope.desempenhoAvaliado = '';
	
	$scope.editarFicha = function(dadosItem, idUsuario) {
			$scope.itemDados = dadosItem;
			//editar dados do ficha no banco
			$scope.modalEditarFicha = true;
			console.dir($scope.itemDados);
			$scope.codFichaNovo = 	'';
			$scope.numUltRevisao = '';			
			$scope.codSituacao = '';	
			$scope.abrirRevisao = false;
			$scope.habilitarDesc = true;
						
		};//funcao editarFicha		
	
	
		$scope.excluirFicha = function(numero, idUsuario) {
			console.log('Excluir Ficha');
			//excluir dados do ficha no banco
			var numeroFicha = numero; 
			var usuario = idUsuario; 
			console.log('Ficha: ' + numeroFicha);
			console.log('Usuario: ' + usuario);		
		};//funcao editarFicha
	
	
	$scope.revisarFicha = function(itemRevisado) {
			$scope.abrirRevisao = true;
			$scope.habilitarDesc = false;
			$scope.revisao = itemRevisado;
			
			//criar novo numero de ordem do tipo de solução
			var numCaracteres = $scope.revisao.num_ordem_solucao.toString().length;
			var numOrdemNovo = '';
			$scope.codSituacao = $scope.revisao.codsituacao;
			console.log($scope.codSituacao);
			
			if($scope.itemDados.codsituacao==1){
				$scope.desempenhoAvaliado = false;	
				$scope.situacaoNova = '1';
			}else{
				$scope.desempenhoAvaliado = true;
				$scope.situacaoNova = '2';
			}

			if($scope.codSituacao==1){
				if(numCaracteres==1){
					numOrdemNovo = '00'+ $scope.revisao.num_ordem_solucao;
				}else if(numCaracteres==2){
					numOrdemNovo = '0'+$scope.revisao.num_ordem_solucao;
				}

				//criar novo numero de revisão
				numCaracteres = $scope.revisao.num_ultima_revisao.toString().length;
				$scope.numUltRevisao = $scope.revisao.num_ultima_revisao+1;
				var numUltRevisaoNovo = '';
				if(numCaracteres==1){
					if($scope.revisao.num_ultima_revisao<9){
						numUltRevisaoNovo = 'R0'+ $scope.numUltRevisao;	
					}else{
						numUltRevisaoNovo = 'R'+ $scope.numUltRevisao;
					}				

				}else if(numCaracteres==2){
					numUltRevisaoNovo = 'R'+$scope.revisao.num_ultima_revisao;
				}
				$scope.codFichaNovo = $scope.revisao.txt_sigla_sistema+'-'+$scope.revisao.txt_sigla_solucao+'-'+ numOrdemNovo+'-'+numUltRevisaoNovo;
			}else{
				
				$scope.numUltRevisao = $scope.revisao.num_ultima_revisao+1;
				$scope.codFichaNovo = $scope.revisao.txt_cod_ficha;
			}	
			//console.dir($scope.revisao);
};

	$scope.mudarSituacao = function(situacaoNova, itemRevisado) {
			$scope.revisado = itemRevisado;
			$scope.numOrdemFicha = '';
			var numOrdemNovo = '';
			var numOrdemSolucao = '';
			var numUltimaRevisao = '';
			
			
			if(situacaoNova==1){
				$scope.numUltRevisao = 0;
				var count = 0;
				for (var i = 0; i < $scope.catalogo.length; i++) {					
					if(($scope.revisado.solucao == $scope.catalogo[i].solucao) && ($scope.catalogo[i].codsituacao==1)){
						
						count++;
					}
				};

				numOrdemNovo = count + 1;
				var numCaracteres = numOrdemNovo.toString().length;

				if(numCaracteres==1){
					numOrdemNovo = '00'+ numOrdemNovo;
				}else if(numCaracteres==2){
					numOrdemNovo = '0'+numOrdemNovo;
				}

				$scope.numOrdemFicha = numOrdemNovo;


				//criar novo numero de revisão
				numCaracteres = $scope.revisado.num_ultima_revisao.toString().length;
				$scope.numUltRevisao = 0;
				numUltRevisaoNovo = 'R00';			
				
				$scope.codFichaNovo = $scope.revisado.txt_sigla_sistema+'-'+$scope.revisado.txt_sigla_solucao+'-'+ $scope.numOrdemFicha +'-'+numUltRevisaoNovo;
			}else{
				
				$scope.numUltRevisao = $scope.revisado.num_ultima_revisao+1;
				$scope.codFichaNovo = $scope.revisado.txt_cod_ficha;
			}
			
	};	

	$scope.mudarRevisao = function(revisao) {
		if (revisao.length >= 2){
			$scope.codFichaNovo = $scope.revisado.txt_sigla_sistema+'-'+$scope.revisado.txt_sigla_solucao+'-'+ $scope.numOrdemFicha +'-R'+ revisao;
		} else if (revisao.length == 0){
			$scope.codFichaNovo = $scope.revisado.txt_sigla_sistema+'-'+$scope.revisado.txt_sigla_solucao+'-'+ $scope.numOrdemFicha +'-R00';
		} else {
			$scope.codFichaNovo = $scope.revisado.txt_sigla_sistema+'-'+$scope.revisado.txt_sigla_solucao+'-'+ $scope.numOrdemFicha +'-R0'+ revisao;
		}

	}


}]); // o "]" protege as vari?veis de serem minificadas, que pode gerar um erro no programa (lynda.com).
	
