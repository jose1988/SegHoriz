<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
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
			
			/*Ajax de la tabla de conectados*/
			$('#tablaColaYConectados').load('../ajax/tablaColaYConectados.php', 
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
       </br>
       </br>
       <h1>Datos de las Solicitudes</h1>
       <div class="span10">
       		<br>
       		<div id="tablaColaYConectados"></div>
                <br>
                <a href="moduloColasPriorizar.php"><button type="button" class="btn btn-success"><i class="icon-arrow-right"></i> Operaciones Cola</button></a>
                <br>
                <br>
                <a href="moduloColasDetalle.php"><button type="button" class="btn btn-success"><i class="icon-arrow-right"></i> Gráfico Conectados</button></a>
       		
        </div>
        
        <div class="span10">
        
        	<div class="span2"></div>
       
       		<div class="span6">
        		<br>
       			<br>            
            	<div id="grafico" style="min-width: 150px; height: 250px; margin: 0 auto">
        		</div>
       		</div>
       	
		</div>
	</div>
    
    <!-- /container -->
	<div id="footer" class="container">    	
	</div>
 </div>
  	
    <script> /*Funciones de los gráfico*/
	$(function () {
		
		/*Gráfico del total de las solicitudes contra las solicitudes asignadas y no asignadas*/
        $('#grafico').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total de Solicitudes'
            },
            xAxis: {
                categories: [
					'Asignadas',
					'No Asignadas'
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
                pointFormat: '<tr><td style="color:{series.color};padding:0"> </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.1,
                    borderWidth: 0
                }
            },
            series: [{
				name: 'Total',
                data: [
					<?php echo $totalColaHoy ?>,
					<?php echo $solPendXProc ?>
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
