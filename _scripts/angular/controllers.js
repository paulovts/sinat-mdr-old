angular.module('myApp')
  .controller('CatalogoConvencional', ['$scope', '$http', function ($scope, $http) {
	
	$http.get('../arquivosJSON/json_dados_catalogo_convencional.php').success(function(data) {
		$scope.catalogo = data;
		$scope.ordem = 'sistema';
		
		
		$scope.countDownload = function(numero, idUsuario) {
			//salvar dados do download no banco
			$http.get('../controles/cadDownloadCatConvencional.php?numero='+numero+'&idUsuario='+idUsuario+'').success(function(result){
				
			});//segundo $http
		};//funcao countDownload
		
		//Inicializar a solucao com todas as soluções quando abrir a pagina
		$scope.novaSolucao = [];
		$http.get('../arquivosJSON/json_dados_sistemas_solucao.php?nomeSistema=').success(function(result){
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
			
			$http.get('../arquivosJSON/json_dados_sistemas_solucao.php?nomeSistema='+$scope.sistema).success(function(result){
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
	
	
	
	
}]); // o "]" protege as vari?veis de serem minificadas, que pode gerar um erro no programa (lynda.com).

angular.module('myApp')
.controller('CatalogoInovador', ['$scope', '$http', function ($scope, $http) {
	$http.get('../arquivosJSON/json_dados_catalogo_inovador.php').success(function(data) {
		$scope.catalogoInovador = data;
		
		console.dir(data);
		
		$scope.countDownloadDiretriz = function(numero, idUsuario) {
			//salvar dados do download no banco
			$http.get('../controles/cadDownloadDiretriz.php?numero='+numero+'&idUsuario='+idUsuario+'').success(function(result){
				
			});//segundo $http
		};//funcao countDownload
		
		$scope.countDownloadDatec = function(numero, idUsuario) {
			//salvar dados do download no banco
			$http.get('../controles/cadDownloadCatDatec.php?numero='+numero+'&idUsuario='+idUsuario+'').success(function(result){
				
			});//segundo $http
		};//funcao countDownload
		
		//Criar o catalogo Datec e colocar o jasonDatec l? dentro
		$scope.catalogoDatec =[];
		var countDatec = 0;
		for(var ind = 0; ind < data.length; ind++) {	
			for(var n = 0; n < data[ind].jsondatec.length; n++) {
				if (data[ind].jsondatec[n] != null) {
				$scope.catalogoDatec.push(data[ind].jsondatec[n]);
				$scope.catalogoDatec[countDatec].num_numero_diretriz = data[ind].num_numero_diretriz;
				countDatec++;
				}
				
			}
			//Deletar o jsonDatec do catalogo Inovador, previnindo o filtro buscar de encontrar numeros desnecess?os do cpnj do proponente
			delete $scope.catalogoInovador[ind].jsondatec;
		}
		
		
		
		//colocar o catalogoDatec em ordem alfabetica	
		$scope.catalogoDatec.sort(function(a, b) {
			return parseFloat(Number(a.num_ordem_ficha)) - parseFloat(Number(b.num_ordem_ficha));
		});
		
		$scope.ordem = 'numero';

		//colocar o catalogoDatec em ordem alfabetica	
		$scope.catalogoInovador.sort(function(a, b) {
			return parseFloat(Number(a.num_numero_diretriz)) - parseFloat(Number(b.num_numero_diretriz));
		});
		
		$scope.ordem = 'numero';

		//Crias a datec Vinculadas de acordo com as diretrizes
		$scope.datecVinculadas = [];
		for(var ind = 0 ; ind < $scope.catalogoDatec.length; ind++){
			 var codDiretriz = ind + 1;
			 $scope.datecVinculadas[codDiretriz] = [];
			for(var n = 0; n < $scope.catalogoDatec.length; n++){
				if(codDiretriz == $scope.catalogoDatec[n].cod_diretriz){
					$scope.datecVinculadas[codDiretriz] += $scope.catalogoDatec[n].num_ordem_ficha + ';';					
				}	
			}
		}
		
		//Colocar as Datec vinculadas dentro do Catalogo Inovador;
		for(var i = 0; i < $scope.catalogoInovador.length; i++){
			$scope.catalogoInovador[i].num_ordem_ficha = "";
			if ($scope.datecVinculadas[i+1].length != 0){
				$scope.catalogoInovador[i].num_ordem_ficha = $scope.datecVinculadas[i+1]; //num_ordem_fica serve para manter o mesmo nome que existe no $scope da diretriz, para filtrar ambas as tabelas ao mesmo tempo
			}
		}
		console.dir($scope.catalogoInovador);
		
		//Ao mudar a Diretriz, escolher todas as Datecs
		$scope.mudarDiretriz = function (){
			$scope.datec = "";
		
		};
		
		//Ao mudar a Diretriz, escolher todas as Datecs
		$scope.mudarDatec = function (){
			$scope.diretriz = "";
		
		};
		
		
		//Retornar o valor identical.
		$scope.identical = function(actual, expected){
			if ( expected == "") {
				return identical = actual;
			} else {
				return actual === parseInt(expected);
			}
		}
		

	}); 
	
	
}]); // o "]" protege as vari?is de serem minificadas, que pode gerar um erro no programa (lynda.com).