 <?php
            
		   $idPreOrden = array('idPreorden' => $_POST['idpreorden']);
           $Resultad2 = $client->priorizarDeLaColaXidPreOrden($idPreOrden);
		   
				  if(!isset($Resultad2->return)){
						 echo "No ENVIA EL SERVICIO";
				  }else{
					   echo "si lo envia";
				  }
		   
		   $Resultado = $client->imprimirCola();			
	   
				  if(!isset($Resultado->return)){
						  $regCola=0;
				  }else{
						  $regCola=count($Resultado->return);
	   					  $Cola=$Resultado;
				  }
	
								if($regCola!=0){
									
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
                                  echo "<td >". $Cola->return[$j]->idcolapreorden. "</td>";
                                  echo "<td >". $Cola->return[$j]->idpreorden->idpreorden . "</td>";
                                 
                                  echo "<td >". $Cola->return[$j]->fecha . "</td>";
                                   
                                   
                               echo "</tr>";
                           
                           
                               
									 $j++;
									 } 
									 }else{  
								   echo "<td >". $Cola->return->idcolapreorden. "</td>";
                                   echo "<td >".    $Cola->return->idpreorden . "</td>";
                                 
                                   echo "<td >".  $Cola->return->fecha . "</td>";
                                   
                                   
                               echo "</tr>";
									 
									 }
								   }   else { 
										  echo"<div class='alert alert-block' align='center'>
   										 <h2 style='color:rgb(255,255,255)' align='center'>Atención</h2>
    									<h4 align='center'>No hay Solicitudes en Cola </h4>
   			    					     </div> ";
									 
									 }
							     
                                 
                              echo " </tbody>
                                     </table>";
                          
                  ?>
 
	   
