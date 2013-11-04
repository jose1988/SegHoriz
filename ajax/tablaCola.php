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
	
$solPendXProc=$totalCola-$totalColaHoy;

echo '<table border="0">';
  echo'<tbody>';
   	echo'<tr>';
  	 	echo '<th align="left">Solicitudes Pendientes por Procesar: </th>';
    	echo '<td align="right">'.$solPendXProc.'</td>';
    echo '</tr>';
    echo '<tr>';
    	echo '<th align="left">Solicitudes Ingresadas en Cola Hoy: </th>';
        echo '<td align="right">'.$totalColaHoy.'</td>';
	echo '</tr>';
    echo '<tr>';
    	echo '<th align="left">Total de Solicitudes por Procesar: </th>';
        echo '<td align="right">'.$totalCola.'</td>';
    echo '</tr>';
    echo '<tr>';
    	echo '<th align="left">Operadores Conectados: </th>';
        echo '<td align="right">'.$conectados.'</td>';
   	echo '</tr>';
    echo '<tr>';
    	echo '<th align="left">Solicitudes Procesadas: </th>';
        echo '<td align="right">'.$procesadas.'</td>';
    echo '</tr>';
  echo '</tbody>';
echo '</table>';

?>