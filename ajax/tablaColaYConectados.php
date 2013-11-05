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
    
	//Total de Solicitudes por Procesar
	$resultTotalSolicitudes = $client->obtenerColaPreOrden();
	
	if(!isset($resultTotalSolicitudes->return)){
		$totalCola=0;
	}else{
		$totalCola=$resultTotalSolicitudes->return;
	}
	
	//Total de Solicitudes Ingresadas en Cola Hoy
	$resultColaHoy = $client->obtenerTotalXFechaHoy();
	
	if(!isset($resultColaHoy->return)){
		$totalColaHoy=0;
	}else{
		$totalColaHoy=$resultColaHoy->return;
	}
    
	//Operadores Conectados por Estado (Al cual le asigne '1' si esta conectado)
	$estadoOpeCon= array('estado' =>'1');
    $resultOperadoresConectados = $client->obtenerTotalOperadoresConectadosXEstado($estadoOpeCon);
	
	if(!isset($resultOperadoresConectados->return)){
		$conectados=0;
	}else{
		$conectados=$resultOperadoresConectados->return;
	}
	
	//Cantidad de Solicitudes Procesadas por Estado (Al cual le asigne '1' si esta procesada)
	$estadoSolPro= array('estado' =>'1');
    $resultSolicitudesProcesadas = $client->obtenerSolicitudesProcesadasXFecha($estadoSolPro);
	
	if(!isset($resultSolicitudesProcesadas->return)){
		$procesadas=0;
	}else{
		$procesadas=$resultSolicitudesProcesadas->return;
	}

	//Operadores Conectados tengan o no Solicitudes procesadas el día de hoy
	$estadoAnaCone= array('estado' =>'1');
	$resultConectados=$client->analistasConectados($estadoOpeCon);
	
	//Total de Solicitudes Pendientes por Procesar
	$solPendXProc=$totalCola-$totalColaHoy;


echo '<div class="span5">';
	echo '<table border="0">';
  		echo'<tbody>';
   			echo'<tr>';
  	 			echo '<th align="left">Solicitudes Pendientes por Procesar: </th>';
				echo '<td>&nbsp;</td>';
    			echo '<td align="right">'.$solPendXProc.'</td>';
    		echo '</tr>';
    		echo '<tr>';
    			echo '<th align="left">Solicitudes Ingresadas en Cola Hoy: </th>';
				echo '<td>&nbsp;</td>';
        		echo '<td align="right">'.$totalColaHoy.'</td>';
			echo '</tr>';
    		echo '<tr>';
    			echo '<th align="left">Total de Solicitudes por Procesar: </th>';
				echo '<td>&nbsp;</td>';
        		echo '<td align="right">'.$totalCola.'</td>';
    		echo '</tr>';
    		echo '<tr>';
    			echo '<th align="left">Operadores Conectados: </th>';
				echo '<td>&nbsp;</td>';
        		echo '<td align="right">'.$conectados.'</td>';
   			echo '</tr>';
    		echo '<tr>';
    			echo '<th align="left">Solicitudes Procesadas: </th>';
				echo '<td>&nbsp;</td>';
        		echo '<td align="right">'.$procesadas.'</td>';
    		echo '</tr>';
  		echo '</tbody>';
	echo '</table>';
echo '</div>';

echo '<div class="span5">';
echo '<br>';
echo '<br>';

//Verificando que este vacio o sea null
	if(!isset($resultConectados->return)){
		echo '<div class="alert alert-block" align="center">';
   			echo '<h2 style="color:rgb(255,255,255)" align="center">Atención</h2>';
   			echo '<h4 align="center">No Existen Registros de Analistas</h4>';
		echo '</div>';
	}

//Si existen registros muestro la tabla
	else{
		echo '<table class="footable table table-striped table-bordered" align="center" data-page-size="4">
        		<thead bgcolor="#B9B9B9">
        			<tr>
						<th style="text-align:center" data-sort-ignore="true">Id</th>
            			<th style="text-align:center" data-sort-ignore="true">Operador</th>
                		<th style="text-align:center" data-sort-ignore="true">Solicitudes Procesadas</th>
                		<th style="text-align:center" data-sort-ignore="true">Visualizar</th>
           		 	</tr>
        		</thead>                
        		<tbody>';
				
				//Verificando si el resultado es una lista de objetos o un solo un objeto para la lectura de los datos 
				if(count($resultConectados->return)>1){
				
					for($i=0;$i<count($resultConectados->return);$i++){
						
						echo '<tr>
						<td style="text-align:center">'.$resultConectados->return[$i]->idanalista.'</td>
            			<td style="text-align:center">'.$resultConectados->return[$i]->nombre.'</td>';
						
							//Obtengo el id del analista
							$id=$resultConectados->return[$i]->idanalista;
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
                		echo '<td style="text-align:center">
                        	<a href="moduloColasOperador.php?id='.$id.'">
                            	<i class="icon-eye-open"></i>
                            </a>
                        </td>
            		</tr>';
  					}
				}else{
        			echo '<tr>
						<td style="text-align:center">'.$resultConectados->return->idanalista.'</td>
            			<td style="text-align:center">'.$resultConectados->return->nombre.'</td>';
							//Obtengo el id del analista
							$id=$resultConectados->return->idanalista;
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
                        echo '<td style="text-align:center">
                        	<a href="moduloColasOperador.php?id='.$id.'">
                            	<i class="icon-eye-open"></i>
                            </a>
                        </td>
            		</tr>';
					}
       		echo '</tbody>';
      	echo'</table>';
      echo '<ul id="pagination" class="footable-nav"><span>Pag:</span></ul>';
	}
echo '</div>';
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