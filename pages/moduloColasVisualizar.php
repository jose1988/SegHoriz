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
	
	//Operadores Conectados con las Solicitudes que han Procesados (Al cual le asigne '1' si esta procesada)
	$estadoAnaSolPro= array('estado' =>'1');
    $resultSolicitudesProcesadasXAnalista = $client->listaSolicitudesProcesadasXFecha($estadoAnaSolPro);
	
	//Operadores Conectados tengan o no Solicitudes procesadas el día de hoy
	$estadoAnaCone= array('estado' =>'1');
	$resultConectados=$client->analistasConectados($estadoAnaCone);
	
	//Total de Solicitudes Pendientes por Procesar
	$solPendXProc=$totalCola-$totalColaHoy;
	
	include("../views/moduloColasVisualizar.php");
?>
