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
    <link href="../css/footable-0.1.css" rel="stylesheet" type="text/css" />
	<link href="../css/footable.sortable-0.1.css" rel="stylesheet" type="text/css" />
	<link href="../css/footable.paginate.css" rel="stylesheet" type="text/css" />
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
	
	
?>

</head>

	   
               <?php  echo '<div class="span5"> 
                  <br>
                         <table border="0">
                           
                              <tbody>
                                <tr>
                                  <th align="left"> Nombre de Operador:</th>
                                  <td align="right">'.$Nanalista.'</td>
                                </tr>
                             
                                <tr>
                                  <th align="left">Solicitudes procesadas hoy:</th>
                                  <td align="right">'.$reg.'</td>
                                </tr>
                             
                                <tr>
                                  <th align="left">Promedio de Solicitudes atendidas:</th>
                                  <td align="right">'.$promedio.'</td>
                                </tr>
                             
                                <tr>
                                  <th align="left">Operadores Conectados</th>
                                  <td align="right">'.$conectados.'</td>
                                </tr>
                              </tbody>
                            </table>
                            
                  </div>
                  
                 <div class="span5"> 
                  <br>';
								if($reg!=0){
									
								echo	 '<table class="footable table table-striped table-bordered" align="center" data-page-size="2">
                              <thead bgcolor="#B9B9B9">
								 <tr>
								   <th style="width:35%" data-sort-ignore="true">Nro de Preorden</th>
                                   <th style="width:35%" data-sort-ignore="true">Fecha Hora</th>
                                   <th style="width:20%" data-sort-ignore="true">Aprobacion</th>
                                   <th style="width:20%" data-sort-ignore="true">Auditar</th>
								 </tr>
							  </thead>
                              <tbody>
                                <tr>';
								
								if($reg>1){
								  $j=0;
								     while($j<$reg){
                               echo   '<td align="center"> '.$Resultado->return[$j]->preorden->idpreorden .'</td>
                                  <td align="center">'.substr($Resultado->return[$j]->fecha,0,10).' '.substr($Resultado->return[$j]->fecha,20,25) .'</td>
                                  <td align="center">'; 
								  if($Resultado->return[$j]->preorden->aprobado=="A"){
									  echo "Aprobada";
								  }
								  if($Resultado->return[$j]->preorden->aprobado=="D"){
									  echo "Denegada";
								  }
								  if($Resultado->return[$j]->preorden->aprobado=="P"){
									  echo "Aprobada Parcial";
								  }
								  echo '</td>
                                 
								  <td style="text-align:center"> <a href="moduloColasAuditoria.html?id='. $Resultado->return[$j]->preorden->idpreorden.'"> <i class="icon-check"></i> </a></td>
                                   
                                   
                                </tr>';
                           
                           
									 $j++;
									 } 
									 }else{  
								  echo '<td align="center"> '.$Resultado->return->preorden->idpreorden.'</td>
                                  <td align="center">'.substr($Resultado->return->fecha,0,10).' '.substr($Resultado->return->fecha,20,25) .'</td>
                                  <td align="center">';
								  if($Resultado->return->preorden->aprobado=="A"){
									  echo "Aprobada";
								  }
								  if($Resultado->return->preorden->aprobado=="D"){
									  echo "Denegada";
								  }
								  if($Resultado->return->preorden->aprobado=="P"){
									  echo "Aprobada Parcial";
								  }
								  echo '							
                                  </td>
								  <td style="text-align:center"><a href="moduloColasAuditoria.php?id='. $Resultado->return->preorden->idpreorden.'"><i class="icon-check"></i></a></td>
                                   
                                   
                                </tr>
								 </table>
                           <ul id="pagination" class="footable-nav"><span>Pag:</span></ul>';	 
									 }
								   }   else { 
										 echo  '<div class="alert alert-block" align="center">
   										  <h2 style="color:rgb(255,255,255)" align="center">Atención</h2>
    									  <h4 align="center">El Analista '. $Nanalista .' hoy no ha procesado solicitudes</h4>
   			    					 </div> ';
									 }
							    
                                 
                             echo '</tbody>
                           
                            
                  </div>
                  
              </div>
     
	

    </div>';
    
    
    
  
    
   
        
</script>  

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