<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cierre Nomina - Milenio</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      
   <?php include("view/modulos/links_css.php"); ?>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    
   
   
  </head>

  <body class="hold-transition skin-blue fixed sidebar-mini">

 <?php  $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
  ?>
    
    
    <div class="wrapper">

  <header class="main-header">
  
      <?php include("view/modulos/logo.php"); ?>
      <?php include("view/modulos/head.php"); ?>	
    
  </header>

   <aside class="main-sidebar">
    <section class="sidebar">
     <?php include("view/modulos/menu_profile.php"); ?>
      <br>
     <?php include("view/modulos/menu.php"); ?>
    </section>
  </aside>

  <div class="content-wrapper">
   		<section class="content-header">
            <h1>
            
            	<small><?php echo $fecha; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Cierre Nomina</li>
            </ol>
        </section>
        
        <!-- comienza diseño controles usuario -->
        
        
                
        
        <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cerrar Nomina</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">


            <form  action="<?php echo $helper->url("CierreNomina","InsertaCierreNomina"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
                               
                          
                    	   <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
       
                    	            
                    	    
                    	        <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="mes_afectacion" class="control-label">Mes afectación:</label>
                                                          <input type="hidden" class="form-control" id="mes_afectacion_verificacion" name="mes_afectacion_verificacion" value="" >
                                                          <input type="hidden" class="form-control" id="id_cierre_nomina" name="id_cierre_nomina" value="<?php echo $resEdit->id_cierre_nomina; ?>" >
                                                          
                                                          <select name="mes_afectacion" id="mes_afectacion"  class="form-control" readonly>
                                                          <option value="0" selected="selected">--Seleccione--</option>
                                                          <option value="1" <?php  if ( $resEdit->mes_cierre_nomina =='1')  echo ' selected="selected" ' ; ?>>Enero</option>
                                                          <option value="2" <?php  if ( $resEdit->mes_cierre_nomina =='2')  echo ' selected="selected" ' ; ?>>Febrero</option>
                                                          <option value="3" <?php  if ( $resEdit->mes_cierre_nomina =='3')  echo ' selected="selected" ' ; ?>>Marzo</option>
                                                          <option value="4" <?php  if ( $resEdit->mes_cierre_nomina =='4')  echo ' selected="selected" ' ; ?>>Abril</option>
                                                          <option value="5" <?php  if ( $resEdit->mes_cierre_nomina =='5')  echo ' selected="selected" ' ; ?>>Mayo</option>
                                                          <option value="6" <?php  if ( $resEdit->mes_cierre_nomina =='6')  echo ' selected="selected" ' ; ?>>Junio</option>
                                                          <option value="7" <?php  if ( $resEdit->mes_cierre_nomina =='7')  echo ' selected="selected" ' ; ?>>Julio</option>
                                                          <option value="8" <?php  if ( $resEdit->mes_cierre_nomina =='8')  echo ' selected="selected" ' ; ?>>Agosto</option>
                                                          <option value="9" <?php  if ( $resEdit->mes_cierre_nomina =='9')  echo ' selected="selected" ' ; ?>>Septiembre</option>
                                                          <option value="10" <?php  if ( $resEdit->mes_cierre_nomina =='10')  echo ' selected="selected" ' ; ?>>Octubre</option>
                                                          <option value="11" <?php  if ( $resEdit->mes_cierre_nomina =='11')  echo ' selected="selected" ' ; ?>>Noviembre</option>
                                                          <option value="12" <?php  if ( $resEdit->mes_cierre_nomina =='12')  echo ' selected="selected" ' ; ?>>Diciembre</option>
                        								  </select> 
                                                          <div id="mensaje_mes_afectacion" class="errores"></div>
                                 </div>
                    		     </div>
                    	
                    	
                    	        <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="anio_afectacion" class="control-label">Año afectación:</label>
                                                          <select name="anio_afectacion" id="anio_afectacion"  class="form-control" readonly>
                                                          <option value="0" selected="selected">--Seleccione--</option>
                                                          <option value="2019" <?php  if ( $resEdit->anio_cierre_nomina =='2019')  echo ' selected="selected" ' ; ?>>2019</option>
                                                          </select> 
                                                          <div id="mensaje_anio_afectacion" class="errores"></div>
                                 </div>
                    		     </div>
        
                    	
                    	
                    	
                    	        <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_estado" class="control-label">Estado:</label>
                                                          
                                                          <select name="id_estado" id="id_estado"  class="form-control">
                                                          <option value="0" selected="selected">--Seleccione--</option>
                                                          <option value="1" <?php  if ( $resEdit->id_estado =='1')  echo ' selected="selected" ' ; ?>>Cerrado</option>
                                                          <option value="2" <?php  if ( $resEdit->id_estado =='2')  echo ' selected="selected" ' ; ?>>Abierto</option>
                                                          </select> 
                                                          <div id="mensaje_id_estado" class="errores"></div>
                                 </div>
                    		     </div>
                    	
                    	
                    	           	
                    	        <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Actualizar</i></button>
                                					  <a href="index.php?controller=CierreNomina&action=index" class="btn btn-primary" ><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
				  		
                                </div>
                    		    </div>
                    		    </div>
                                   
                    	       
                    	       
                    	       
                    	        <?php }} else{ ?>	    
                    	            
                    	    
                    	        <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="mes_afectacion" class="control-label">Mes afectación:</label>
                                                          <input type="hidden" class="form-control" id="id_cierre_nomina" name="id_cierre_nomina" value="0" >
                                                         
                                                          <input type="hidden"  id="mes_afectacion_verificacion" name="mes_afectacion_verificacion" value="" >
                                                          <select name="mes_afectacion" id="mes_afectacion"  class="form-control">
                                                          <option value="0" selected="selected">--Seleccione--</option>
                                                          <option value="1">Enero</option>
                                                          <option value="2">Febrero</option>
                                                          <option value="3">Marzo</option>
                                                          <option value="4">Abril</option>
                                                          <option value="5">Mayo</option>
                                                          <option value="6">Junio</option>
                                                          <option value="7">Julio</option>
                                                          <option value="8">Agosto</option>
                                                          <option value="9">Septiembre</option>
                                                          <option value="10">Octubre</option>
                                                          <option value="11">Noviembre</option>
                                                          <option value="12">Diciembre</option>
                        								  </select> 
                                                          <div id="mensaje_mes_afectacion" class="errores"></div>
                                 </div>
                    		     </div>
                    	
                    	
                    	        <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="anio_afectacion" class="control-label">Año afectación:</label>
                                                          <select name="anio_afectacion" id="anio_afectacion"  class="form-control">
                                                          <option value="0" selected="selected">--Seleccione--</option>
                                                          <option value="2019">2019</option>
                                                         </select> 
                                                          <div id="mensaje_anio_afectacion" class="errores"></div>
                                 </div>
                    		     </div>
                    	
                    	
                    	
                             	<div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_estado" class="control-label">Estado:</label>
                                                          
                                                          <select name="id_estado" id="id_estado"  class="form-control">
                                                          <option value="0" selected="selected">--Seleccione--</option>
                                                          <option value="1" >Cerrar</option>
                                                          </select> 
                                                          <div id="mensaje_id_estado" class="errores"></div>
                                 </div>
                    		     </div>
                    	
                    	
                    	           	
                    	        <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Guardar</i></button>
                                					  <a href="index.php?controller=CierreNomina&action=index" class="btn btn-primary" ><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
				  		
                                </div>
                    		    </div>
                    		    </div>
                    	        
                    	        
                    	        
                    	        <?php } ?>		
                    
              </form>
  			</div>
      	</div>
   	</section>
    		
    	 
    		
       <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Listado Nominas Cerradas</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
                   
        
       <div class="ibox-content">  
      <div class="table-responsive">
        
		<table  class="table table-striped table-bordered table-hover dataTables-example">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Mes</th>
                          <th>Año</th>
                          <th>Estado</th>
                          <th></th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php $i=0;?>
    						<?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
    						<?php $i++;?>
    						
    						<?php $mes_numero=$res->mes_cierre_nomina;
    						$id_estado=$res->id_estado;
    						?>
    						
    						<?php 
    						$mes="";
    						$nombre_estado="";
    						if($mes_numero==1){
    							$mes="ENERO";
    						}elseif($mes_numero==2){
    							$mes="FEBRERO";
    						}elseif($mes_numero==3){
    							$mes="MARZO";
    						}elseif($mes_numero==4){
    							$mes="ABRIL";
    						}elseif($mes_numero==5){
    							$mes="MAYO";
    						}elseif($mes_numero==6){
    							$mes="JUNIO";
    						}elseif($mes_numero==7){
    							$mes="JULIO";
    						}elseif($mes_numero==8){
    							$mes="AGOSTO";
    						}elseif($mes_numero==9){
    							$mes="SEPTIEMBRE";
    						}elseif($mes_numero==10){
    							$mes="OCTUBRE";
    						}elseif($mes_numero==11){
    							$mes="NOVIEMBRE";
    						}elseif($mes_numero==12){
    							$mes="DICIEMBRE";
    						}
    						
    						
    						if($id_estado==1){
    							$nombre_estado="CERRADO";
    						}elseif($id_estado==2){
    							$nombre_estado="ABIERTO";
    						}
    						
    						
    						?>
    						
            	        		<tr>
            	                   <td > <?php echo $i; ?>  </td>
            		               <td > <?php echo $mes; ?>     </td> 
            		               <td > <?php echo $res->anio_cierre_nomina; ?>     </td> 
            		               <td > <?php echo $nombre_estado ?>     </td> 
            		               <td>
            			           		<div class="right">
            			                    <a href="<?php echo $helper->url("CierreNomina","index"); ?>&id_cierre_nomina=<?php echo $res->id_cierre_nomina; ?>" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class='glyphicon glyphicon-edit'></i></a>
            			                </div>
            			            
            			             </td>
            			            
            		    		</tr>
            		        <?php } } ?>
                    
                    </tbody>
                    </table>
       
        </div>
         </div>
            
            </div>
            </div>
            </section>
    
  	</div>
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    
   <?php include("view/modulos/links_js.php"); ?>
   
    
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
   <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
 
 
   
	<script src="view/bootstrap/otros/inputmask_bundle/jquery.inputmask.bundle.js"></script>
       <script>
      $(document).ready(function(){
      $(".cantidades1").inputmask();
      });
	  </script>
   
   <script type="text/javascript">

    	 $(document).ready( function (){
    		 consulta_mes_a_generar_rol();
  		   
 			});
    	
    	 function consulta_mes_a_generar_rol(){
		     
	    	   $.ajax({
	                    url: 'index.php?controller=Procesos&action=consulta_mes_a_generar_rol',
	                    type: 'POST',
	                    data: {action:'ajax'},
	                    success: function(x){
	                      $("#mes_afectacion_verificacion").val(x);
	                      
	                    }
	             });
	        }
		    

    	</script>
   
   
      
    <script >
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Guardar").click(function() 
			{

		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;


		    	var mes_afectacion  =  $('#mes_afectacion').val();
		    	var anio_afectacion  =  $('#anio_afectacion').val();
		    	var mes_afectacion_verificacion =  $('#mes_afectacion_verificacion').val();
		    	var id_estado =  $('#id_estado').val();
		    	var contador=0;
		    	var tiempo = tiempo || 1000;

                var id_cierre_nomina = $('#id_cierre_nomina').val();
		    	

		    	if (mes_afectacion == 0 )
		    	{
			    	
		    		$("#mensaje_mes_afectacion").text("Seleccione");
		    		$("#mensaje_mes_afectacion").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_mes_afectacion).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{

		    		if(id_cierre_nomina>0){}else{
			    	
		    		  if(mes_afectacion_verificacion.trim()==mes_afectacion){

	                    	 $("#mensaje_mes_afectacion").fadeOut("slow"); //Muestra mensaje de error
	     		            
	                     }else{

	                    	 $("#mensaje_mes_afectacion").text("El mes seleccionado no se puede cerrar o ya se encuentra cerrado.");
	     		    		$("#mensaje_mes_afectacion").fadeIn("slow"); //Muestra mensaje de error
	     		    		$("html, body").animate({ scrollTop: $(mensaje_mes_afectacion).offset().top-120 }, tiempo);
	     					
	     		            return false;
		                     }

		    		}   
				}



		    	if (anio_afectacion == 0 )
		    	{
			    	
		    		$("#mensaje_anio_afectacion").text("Seleccione");
		    		$("#mensaje_anio_afectacion").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_anio_afectacion).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_anio_afectacion").fadeOut("slow"); //Muestra mensaje de error
		            
				}

		    	if (id_estado == 0 )
		    	{
			    	
		    		$("#mensaje_id_estado").text("Seleccione");
		    		$("#mensaje_id_estado").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_estado).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_estado").fadeOut("slow"); //Muestra mensaje de error
		            
				}

		    	

			}); 

		      
		        $( "#mes_afectacion" ).focus(function() {
					  $("#mensaje_mes_afectacion").fadeOut("slow");
				    });

		        $( "#anio_afectacion" ).focus(function() {
					  $("#mensaje_anio_afectacion").fadeOut("slow");
				    });


		        $( "#id_estado" ).focus(function() {
					  $("#mensaje_id_estado").fadeOut("slow");
				    });
		}); 

	</script>
	
  </body>
</html>   