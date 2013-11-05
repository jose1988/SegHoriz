 <?php
        require_once('../lib/nusoap.php'); 
  			$wsdl_url = 'http://localhost:15362/HoriFarmacia/ColasWS?WSDL';
 			 $client = new SOAPClient($wsdl_url);
		    $client->decode_utf8 = false; 
	   $codCli = array('codCli' => $_POST['codcli']);
       $Resultado = $client->priorizarDeLaColaXcodCli($codCli);
	   
				  if(!isset($Resultado->return)){
						  $regCola=0;
				  }else{
						  $regCola=count($Resultado->return);
	   					  $Cola=$Resultado;
						
				  }
				  //echo '<pre>';
				//  print_r($Cola);
	  
	   ?>
	   <div id="tabla" class="span6"> 
                  <br>
                
                        
                                
                                <?php
								if($regCola!=0){
									?>
									 <table class="footable table table-striped table-bordered" align="center" data-page-size="10">
                              <thead bgcolor="#B9B9B9">
								 <tr>
								   <th style="width:9%">Id de Cola</th>
                                   <th style="width:7%">Nro de Preorden</th>
                                   <th style="width:7%">Fecha Hora</th>
                                   
								 </tr>
							  </thead>
                              <tbody>
                                <tr>
									<?php
								if($regCola>1){
								  $j=0;
								     while($j<$regCola){ ?>
                                  <td align="center"> <?php echo $Cola->return[$j]->idcolapreorden; ?></td>
                                  <td align="center">  <?php echo $Cola->return[$j]->idpreorden->idpreorden; ?></td>
                                 
                                  <td style="text-align:center"> <?php echo $Cola->return[$j]->fecha; ?></td>
                                   
                                   
                                </tr>
                           
                           
                               <?php
									 $j++;
									 } 
									 }else{  ?>
								   <td align="center"> <?php echo $Cola->return->idcolapreorden; ?></td>
                                  <td align="center">  <?php echo $Cola->return->idpreorden->idpreorden; ?></td>
                                 
                                  <td style="text-align:center"> <?php echo $Cola->return->fecha; ?></td>
                                   
                                   
                                </tr>
								<?php		 
									 }
								   }   else { ?>
										  <div class="alert alert-block" align="center">
   										  <h2 style="color:rgb(255,255,255)" align="center">Atención</h2>
    									  <h4 align="center"> No hay Solicitudes en Cola</h4>
   			    					 </div> 
									 <?php
									 }
							     ?>
                                 
                              </tbody>
                            </table>
                           <ul id="pagination" class="footable-nav"><span>Pag:</span></ul>
                           
                  </div>
                  
 
	   
