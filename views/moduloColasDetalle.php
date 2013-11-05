<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Seguros Horizonte | HorizonLine</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<!-- javascript -->
	<script type='text/javascript' src="../js/jquery-1.9.1.js"></script>
	<script type='text/javascript' src="../js/bootstrap.js"></script>
	<script type='text/javascript' src="../js/bootstrap-transition.js"></script>
	<script type='text/javascript' src="../js/bootstrap-tooltip.js"></script>
	<script type='text/javascript' src="../js/modernizr.min.js"></script>
<!--<script type='text/javascript' src="js/togglesidebar.js"></script>-->	
	<script type='text/javascript' src="../js/custom.js"></script>
	<script type='text/javascript' src="../js/jquery.fancybox.pack.js"></script>
    
    
    <script type="text/javascript" src="../js/jquery-2.0.2.min.js"></script>
    
    <script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="http://code.highcharts.com/modules/exporting.js"></script>
	
	<!-- styles -->
	<link href="../css/bootstrap.css" rel="stylesheet">
	<link href="../css/bootstrap-combined.min.css" rel="stylesheet">
	<link href="../css/bootstrap-responsive.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">
	<link href="../css/jquery.fancybox.css" rel="stylesheet">
	<!-- [if IE 7]>
	  <link rel="stylesheet" href="font-awesome/css/font-awesome-ie7.min.css">
	<![endif]--> 
	
	<!--Load fontAwesome css-->
	<link rel="stylesheet" type="text/css" media="all" href="../font-awesome/css/font-awesome.min.css">
	<link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
    
	<!-- [if IE 7]>
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome-ie7.min.css">
	<![endif]-->
    
    <!-- styles de paginacion -->
   	<link href="../css/footable-0.1.css" rel="stylesheet" type="text/css" />
	<link href="../css/footable.sortable-0.1.css" rel="stylesheet" type="text/css" />
	<link href="../css/footable.paginate.css" rel="stylesheet" type="text/css" />
    
    
    <!-- AJAX DE RECARGO DE TABLA-->
    <script type="text/javascript"> 
		$(document).ready(function(){ 
			refreshTable();
		});
		
		function refreshTable(){ 
			$('#tablaAnalistas').load('../ajax/tablaTotalPenPro.php', 
				function(){ setTimeout(refreshTable, 5000); 
			}); 
		} 
    </script>
    
</head>

   
<body class="appBg">

	<div id="header">
		<div class="container header-top-top hidden-phone">
			<img alt="" src="../images/header-top-top-left.png" class="pull-left">
			<img alt="" src="../images/header-top-top-right.png" class="pull-right">
		</div>
		<div class="header-top">
			<div class="container">
				<img alt="" src="../images/header-top-left.png" class="pull-left">
				<div class="pull-right">					
				</div>
			</div>
			<div class="filter-area">
				<div class="container">
					<span lang="es">&nbsp;</span>
                </div>
			</div>
		</div>
	</div>

<div id="middle">

		<div class="container app-container">	 
	    	<div>
			 	<ul class="nav nav-pills">
			 		<li class="pull-left">
			 			<div class="modal-header">
							<h3>Horizon<span>Line</span> - Farmacia</h3>
						</div>
					</li> 		
			 	</ul>
		   </div>
           
	<!--Caso pantalla uno-->
   	<div class="tab-content">
       
       <div class="span10">
       		<a href="moduloColasVisualizar.php"><button type="button" class="btn btn-success"><i class="icon-arrow-left"></i> Regresar</button></a>
       </div>
       
       <div class="span10">
 
       		<div class="span4">
       			<br>
       			<br>
				 	<div id="tablaAnalistas"></div>
       		</div>
       
       		<?php 
			//Verificando que no este vacio o no sea null
			if(isset($resultSolicitudesProcesadasXAnalista->return)){ 
			?>   
            <div class="span5">
            	<br>
       			<br>
       			<div id="grafico" style="min-width: 150px; max-width: 650px; height: 350px; margin: 0 auto">   	
        		</div>
       		</div>
           <?php }?>
       </div>
      </div>
	</div>
    
    <!-- /container -->
	<div id="footer" class="container">    	
	</div>
 </div>
  	
    <script> /*Funciones de los gráfico*/
	$(function () {
		
		/*Gráfico del total de las solicitudes contra las solicitudes procesadas por cada analista*/
        $('#grafico').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total de Solicitudes'
            },
			subtitle: {
                text: 'Procesadas por Analista'
            },
            xAxis: {
                categories: [
					<?php 
						if(count($resultSolicitudesProcesadasXAnalista->return)>1){
				
							for($i=0;$i<count($resultSolicitudesProcesadasXAnalista->return);$i++){
								if($i==0){?>
								
								'<?php echo $resultSolicitudesProcesadasXAnalista->return[$i]->nombre; ?>'
								
							<?php }
								else{ ?>
									,'<?php echo $resultSolicitudesProcesadasXAnalista->return[$i]->nombre; ?>'
								<?php }
							}
						}
						else{?>
								'<?php echo $resultSolicitudesProcesadasXAnalista->return->nombre; ?>'
							<?php }
						
					?>
                ]
            },
            yAxis: {
                min: 0,
				max: <?php echo $totalCola ?>,
                title: {
                    text: 'Cantidad Total'
                }
            },
             tooltip: {
                headerFormat: '<span style="font-size:8px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.01,
                    borderWidth: 0
                }
            },
            series: [{				
                name: 'Procesadas por Analista',
                data: [
					<?php 
						if(count($resultSolicitudesProcesadasXAnalista->return)>1){
				
							for($i=0;$i<count($resultSolicitudesProcesadasXAnalista->return);$i++){
								
								//Obtengo el id del analista
								$id=$resultSolicitudesProcesadasXAnalista->return[$i]->idanalista;
								//Lo convierto en array
								$idAnalista=array('idAnalista' => $id);
								//Llamo al servicio que cuenta cuantas solicitudes fueron procesadas por cada analista 
								$resultSolicitudesProcesadasConteo = $client->contarSHXidAnalista($idAnalista);
								if(!isset($resultSolicitudesProcesadasConteo->return)){
									$procesadasAnalista=0;
								}else{
									$procesadasAnalista=$resultSolicitudesProcesadasConteo->return;
								}
								
								if($i==0){
									echo $procesadasAnalista; 
								
								}
								else{ ?>
									,<?php echo $procesadasAnalista;
									}
							}
						}
						else{
							//Obtengo el id del analista
							$id=$resultSolicitudesProcesadasXAnalista->return->idanalista;
							//Lo convierto en array
							$idAnalista=array('idAnalista' => $id);
							//Llamo al servicio que cuenta cuantas solicitudes fueron procesadas por cada analista 
							$resultSolicitudesProcesadasConteo = $client->contarSHXidAnalista($idAnalista);
							if(!isset($resultSolicitudesProcesadasConteo->return)){
								$procesadasAnalista=0;
							}else{
								$procesadasAnalista=$resultSolicitudesProcesadasConteo->return;
							}
							?>
								<?php echo $procesadasAnalista ?>
							<?php }
						
					?>
				]
    
            }]
        });
		
		
    });
	</script>
    
    <!-- script de paginacion -->
<script src="../js/footable.js" type="text/javascript"></script>
<script src="../js/footable.paginate.js" type="text/javascript"></script>
<script src="../js/footable.sortable.js" type="text/javascript"></script>
 
  	<script type="text/javascript">
    	$(function() {
      		$('table').footable();
    	});
  	</script>
    </body>
</html>
