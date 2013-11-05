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
	
	//Cantidad de Solicitudes Procesadas por Estado (Al cual le asigne '1' si esta procesada)
	$estadoSolPro= array('estado' =>'1');
    $resultSolicitudesProcesadas = $client->obtenerSolicitudesProcesadasXFecha($estadoSolPro);
	
	if(!isset($resultSolicitudesProcesadas->return)){
		$procesadas=0;
	}else{
		$procesadas=$resultSolicitudesProcesadas->return;
	}
	
	//Procesadas (Al cual le asigne '1' si esta procesada)
	$estadoAnaSolPro= array('estado' =>'1');
    $resultSolicitudesProcesadasXAnalista = $client->listaSolicitudesProcesadasXFecha($estadoAnaSolPro);
	
	//Total Analistas
	$resultTotalAnalistas = $client->listaTotalAnalistas();
	
	//Operadores Conectados tengan o no Solicitudes procesadas el día de hoy
	$estadoAnaCone= array('estado' =>'1');
	$resultConectados=$client->analistasConectados($estadoAnaCone);
	
	include("../views/moduloColasDetalle.php");
?>
