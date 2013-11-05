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
require_once('../lib/nusoap.php'); 
$wsdl_url = 'http://localhost:15362/HoriFarmacia/ColasWS?WSDL';
$client = new SOAPClient($wsdl_url);
$client->decode_utf8 = false; 
$idPreOrden = array('idPreOrden' => $_POST['idpreorden']);
$Resultad2 = $client->priorizarDeLaColaXidPreOrden($idPreOrden);
$Resultado = $client->imprimirCola();			
	   
if(!isset($Resultado->return)){
	$regCola=0;
}else{
	$regCola=count($Resultado->return);
	$Cola=$Resultado;
}
	
if($regCola!=0){
	
	echo "<br>";
	echo "<table class='footable table table-striped table-bordered' align='center' data-page-size='10'>
    	<thead bgcolor'#B9B9B9'>
			<tr>
				<th style='width:9%'>Id de Cola </th>
            	<th style='width:7%'>Nro de Preorden</th>
                <th style='width:7%'>Fecha Hora</th>
            </tr>
		</thead>
        <tbody>
        	<tr>";
			if($regCola>1){
				$j=0;
				while($j<$regCola){ 
                	echo "<td >".$Cola->return[$j]->idcolapreorden."</td>";
                    echo "<td >".$Cola->return[$j]->idpreorden->idpreorden."</td>";
                    echo "<td >".$Cola->return[$j]->fecha."</td>";                                   
            echo "</tr>";
					$j++;
				} 
			}else{  
				echo "<td >".$Cola->return->idcolapreorden."</td>";
                echo "<td >".$Cola->return->idpreorden->idpreorden."</td>";
                echo "<td >".$Cola->return->fecha."</td>";
                echo "</tr>";
			}
	echo " </tbody>
  	</table>";
	echo '<ul id="pagination" class="footable-nav"><span>Pag:</span></ul>';
	
}else {
	echo "<br>";
	echo"<div class='alert alert-block' align='center'>
   		<h2 style='color:rgb(255,255,255)' align='center'>Atención</h2>
		<h4 align='center'>No hay Solicitudes en Cola </h4>
	</div> ";
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
