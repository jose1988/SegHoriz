<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Seguros Horizonte | HorizonLine</title>

<!-- styles de paginacion -->
<link href="../css/footable-0.1.css" rel="stylesheet" type="text/css" />
<link href="../css/footable.sortable-0.1.css" rel="stylesheet" type="text/css" />
<link href="../css/footable.paginate.css" rel="stylesheet" type="text/css" />

</head>

<body>

<?php 
	require_once("../lib/nusoap.php");
  	$wsdl_url = 'http://localhost:15362/HoriFarmacia/ColasWS?WSDL';	
	$client = new SOAPClient($wsdl_url);	
    $client->decode_utf8 = false;
	
	//Procesadas (Al cual le asigne '1' si esta procesada)
	$estadoAnaSolPro= array('estado' =>'1');
    $resultSolicitudesProcesadasXAnalista = $client->listaSolicitudesProcesadasXFecha($estadoAnaSolPro);	
	
	//Total Analistas
	$resultTotalAnalistas = $client->listaTotalAnalistas();
	
	
	//Verificando que este vacio o sea null
	if(!isset($resultTotalAnalistas->return)){
		echo '<div class="alert alert-block" align="center">';
   			echo '<h2 style="color:rgb(255,255,255)" align="center">Atención</h2>';
   			echo '<h4 align="center">No Existen Registros de Analistas</h4>';
		echo '</div>';
	}
	
	//Si existen registros muestro la tabla
	else{
		echo '<table class="footable table table-striped table-bordered" align="center" data-page-size="10">
        		<thead bgcolor="#B9B9B9">
        			<tr>
						<th style="text-align:center" data-sort-ignore="true">Id</th>
            			<th style="text-align:center" data-sort-ignore="true">Operador</th>
                		<th style="text-align:center" data-sort-ignore="true">Procesadas</th>
                		<th style="text-align:center" data-sort-ignore="true">Pendientes</th>
           		 	</tr>
        		</thead>                
        		<tbody>';
				
				//Verificando si el resultado es una lista de objetos o un solo un objeto para la lectura de los datos 
				if(count($resultTotalAnalistas->return)>1){
						
						//Si es mayor el for de las tablas es con el count de las procesadas
						for($i=0;$i<count($resultTotalAnalistas->return);$i++){
			
        				echo '<tr>
							<td style="text-align:center">'.$resultTotalAnalistas->return[$i]->idanalista.'</td>
            				<td style="text-align:center">'.$resultTotalAnalistas->return[$i]->nombre.'</td>';
							//Obtengo el id del analista
							$id=$resultTotalAnalistas->return[$i]->idanalista;
							//Lo convierto en array
							$idAnalista=array('idAnalista' => $id);
							//Llamo al servicio que cuenta cuantas solicitudes fueron procesadas por cada analista 
							$resultSolicitudesProcesadasConteo = $client->contarAnalistaStatusYFecha($idAnalista);
							
							if(!isset($resultSolicitudesProcesadasConteo->return)){
								$procesadasAnalista=0;
							}else{
								$procesadasAnalista=$resultSolicitudesProcesadasConteo->return;
							}
							
                        	echo '<td style="text-align:center">'.$procesadasAnalista.'</td>';
                            
							//Obtengo el id del analista
							$id=$resultTotalAnalistas->return[$i]->idanalista;
							//Lo convierto en array
							$idAnalista=array('idAnalista' => $id);
							//Llamo al servicio que cuenta cuantas solicitudes estan pendientes por cada analista 
							$resultSolicitudesPendientesConteo = $client->contarAnalistaPendientes($idAnalista);
							
							if(!isset($resultSolicitudesPendientesConteo->return)){
								$pendientesAnalista=0;
							}else{
								$pendientesAnalista=$resultSolicitudesPendientesConteo->return;
							}
                            
                			echo '<td style="text-align:center">'.$pendientesAnalista.'</td>
            			</tr>';
  						}
				}
				else{
                	
                    echo '<tr>
							<td style="text-align:center">'.$resultTotalAnalistas->return->idanalista.'</td>
            				<td style="text-align:center">'.$resultTotalAnalistas->return->nombre.'</td>';
						
							//Obtengo el id del analista
							$id=$resultTotalAnalistas->return->idanalista;
							//Lo convierto en array
							$idAnalista=array('idAnalista' => $id);
							//Llamo al servicio que cuenta cuantas solicitudes fueron procesadas por cada analista 
							$resultSolicitudesProcesadasConteo = $client->contarAnalistaStatusYFecha($idAnalista);
							
							if(!isset($resultSolicitudesProcesadasConteo->return)){
								$procesadasAnalista=0;
							}else{
								$procesadasAnalista=$resultSolicitudesProcesadasConteo->return;
							}
                        
                        	echo '<td style="text-align:center">'.$procesadasAnalista.'</td>';
                            
							//Obtengo el id del analista
							$id=$resultTotalAnalistas->return->idanalista;
							//Lo convierto en array
							$idAnalista=array('idAnalista' => $id);
							//Llamo al servicio que cuenta cuantas solicitudes estan pendientes por cada analista 
							$resultSolicitudesPendientesConteo = $client->contarAnalistaPendientes($idAnalista);
							
							if(!isset($resultSolicitudesPendientesConteo->return)){
								$pendientesAnalista=0;
							}else{
								$pendientesAnalista=$resultSolicitudesPendientesConteo->return;
							}

                			echo '<td style="text-align:center">'.$pendientesAnalista.'</td>
            			</tr>';
                
					}
	
         		echo '</tbody>
        		</table>
         <ul id="pagination" class="footable-nav"><span>Pag:</span></ul>';
	}
?>


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