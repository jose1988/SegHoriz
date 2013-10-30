<?php
 
  require_once('../lib/nusoap.php'); 
  $wsdl_url = 'http://localhost:15362/HoriFarmacia/ColasWS?WSDL';
  $client = new SOAPClient($wsdl_url);
  $client->decode_utf8 = false; 
  $id=$_GET["id"];
  $Analista = array('idAnalista' => $id);
  $Resultado = $client->listaPreordenAnalistaXidAnalista($Analista);
				  if(!isset($Resultado->return)){
						 $reg=0;
				  }else{
						 $reg=count($Resultado->return);
				  }
   $Resultad2 = $client->promedioSolicitudesXidAnalista($Analista);
				  if(!isset($Resultad2->return)){
						 $promedio=0;
				  }else{
						 $promedio =$Resultad2->return;
				  }
  
  $estadoCon= array('estado' =>'1');
  $Resultad3 = $client->obtenerTotalOperadoresConectadosXEstado($estadoCon);
  				  if(!isset($Resultad3->return)){
						 $conectados=0;
				  }else{
						 $conectados = $Resultad3->return;
				  }
  
  $Resultad4 = $client->buscarAnalista($Analista);
  				  if(!isset($Resultad4->return)){
						 $Nanalista="Analista No encontrado";
				  }else{
						 $Nanalista = $Resultad4->return->nombre;
				  }
	
	include("../views/moduloColasOperador.php"); 
?>