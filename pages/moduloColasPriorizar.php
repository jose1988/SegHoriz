<?php
 
  require_once('../lib/nusoap.php'); 
  $wsdl_url = 'http://localhost:15362/HoriFarmacia/ColasWS?WSDL';
  $client = new SOAPClient($wsdl_url);
  $client->decode_utf8 = false; 
  $Resultado = $client->imprimirCola();
				  if(!isset($Resultado->return)){
						  $regCola=0;
				  }else{
						 $Cola=$Resultado;
						 $regCola=count($Resultado->return);
				  }
   
	
	include("../views/moduloColasPriorizar.php"); 
?>