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
       
	   <script>
$(document).ready(function() {
	
	
	$('#codCli').click(function(){
		
		$.ajax({
           type: "POST",
           url: "../ajax/buscarCodCli.php",
           data: {},
           dataType: "text",

                success:  function (response) {
                       $("#tabla").html(response);
					  
                }

           }); 
	    }); 
		
		
		$('#idpreo').click(function(){
		
		$.ajax({
           type: "POST",
           url: "../ajax/priorizarIdPreOrden.php",
		   data: {'idpreorden': $('#idpre').val()},
           dataType: "text",

                success:  function (response) {
                       $("#tabla2").html(response);
					  
                }

           }); 
	    }); 
		
    });
        
</script>  
	
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
	<link rel="stylesheet" type="text/css" media="all" href="font-awesome/css/font-awesome.min.css">
	<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
	
	<!-- [if IE 7]>
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome-ie7.min.css">
	<![endif]-->
    <link href="../css/footable-0.1.css" rel="stylesheet" type="text/css" />
	<link href="../css/footable.sortable-0.1.css" rel="stylesheet" type="text/css" />
	<link href="../css/footable.paginate.css" rel="stylesheet" type="text/css" />

</head>

   
<body class="appBg">

	<div id="header">
		<div class="container header-top-top hidden-phone">
			<img alt="" src="../images/header-top-top-left.png" class="pull-left">
			<img alt="" src="../images/header-top-top-right.png" class="pull-right">
		</div>
		<div class="header-top">
			<div class="container">
				<img alt="" src="../images/header-top-left.png" class="pull-left">
				<div class="pull-right">
					
				</div>
			</div>
			<div class="filter-area">
				<div class="container">
					
					<span lang="es">&nbsp;</span></div>
			</div>
		</div>
	</div>

	<div id="middle">
	
		<div class="container app-container">
			 
			 
			 <div>
			 	<ul class="nav nav-pills">
			 		<li class="pull-left">
			 			<div class="modal-header">
							<h3>Horizon<span>Line</span> - Farmacia</h3>
						</div>
					</li>
			 		
			 	</ul>
			 </div>
			 
	<!--Caso-->
			             
              <div class="tab-content">
                  <div class="span10">
                        <a href="moduloColasVisualizar.php"><button type="button" class="btn btn-success"><i class="icon-arrow-left"></i> Regresar</button></a>
                  </div>
                        
                  <div class="span10"> 
                  <br>
                         <form class="navbar-search pull-left">
                         Buscar PreOrden(es) 
                         <!-- <input type="text" class="search-query" placeholder="Cedula del cliente" autofocus maxlength="10" pattern="[V,E][-][0-9]{6,8}" required/> -->
                         <input  type="text" class="search-query" placeholder="Cedula del cliente" autofocus maxlength="10" pattern="[0-9]{1,8}" required/>
                        
                          <button id="codcli" name="codcli" type="submit" class="btn">Buscar</button>
                        </form>
                            
                  </div>
                  
                  <div id="tabla2" class="span6"> 
                  
                  </div>
                  
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
                                  <td align="center"> <?php echo $Cola->return[$j]->idcolapreorden?></td>
                                  <td align="center">  <?php echo $Cola->return[$j]->idpreorden->idpreorden ?></td>
                                 
                                  <td style="text-align:center"> <?php echo $Cola->return[$j]->fecha ?></td>
                                   
                                   
                                </tr>
                           
                           
                               <?php
									 $j++;
									 } 
									 }else{  ?>
								   <td align="center"> <?php echo $Cola->return->idcolapreorden?></td>
                                  <td align="center">  <?php echo $Cola->return->idpreorden ?></td>
                                 
                                  <td style="text-align:center"> <?php echo $Cola->return->fecha ?></td>
                                   
                                   
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
                  <div class="span10"> 
                 			 <br>
                         <form class="navbar-search pull-left">
                         Priorizar la PreOrden  
                          <input id="idpre" name="idpre" type="text" class="search-query" placeholder="Id de la PreOrden" maxlength="50" pattern="[0-9]{1,12}" required/>
                        
                          <button id="idpre"  type="submit" class="btn">Priorizar</button>
                        </form>
                            
                 		 </div> 
                  
              </div>
              
      			
		
		</div><!-- /container -->

	<div id="footer" class="container">
	</div>
    </div>
    
   
   

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
