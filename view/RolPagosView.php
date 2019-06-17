<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rol Pagos - Milenio</title>
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
                <li class="active">Rol Pagos</li>
            </ol>
        </section>
        
        <!-- comienza diseño controles usuario -->
        
        
                
        
        <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Generar Roles de Pago</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">


            <form  action="<?php echo $helper->url("RolPagos","InsertaRolPagos"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
                               

                    	        <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="mes_afectacion" class="control-label">Mes afectación:</label>
                                                             <input type="hidden" class="form-control" id="mes_afectacion_verificacion" name="mes_afectacion_verificacion" value="" >
                                                    
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
                    	
                    	
                    	           	
                    	        <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Generar</i></button>
                                					  <a href="index.php?controller=RolPagos&action=index" class="btn btn-primary" ><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
				  		
                                </div>
                    		    </div>
                    		    </div>
                    	        
                    	       	       
                    
              </form>
  			</div>
      	</div>
   	</section>
    		
    	 
    		
       <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Listado Rol Pagos Empleados</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
                    <div class="pull-right" style="margin-right:15px;">
						<input type="text" value="" class="form-control" id="search_rol_pagos" name="search_rol_pagos" onkeyup="load_rol_pagos(1)" placeholder="search.."/>
					</div>
					<div id="load_rol_pagos_registrados" ></div>	
					<div id="rol_pagos_registrados"></div>	
            
               
            
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
   
  
 
   
   
    <script type="text/javascript">
     
        	   $(document).ready( function (){
        		   load_rol_pagos(1);
        		});

        	          	   
        	   function load_rol_pagos(pagina){

        		   var search=$("#search_rol_pagos").val();
                   var con_datos={
           					  action:'ajax',
           					  page:pagina
           					  };
                 $("#load_rol_pagos_registrados").fadeIn('slow');
           	     $.ajax({
           	               beforeSend: function(objeto){
           	                 $("#load_rol_pagos_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>')
           	               },
           	               url: 'index.php?controller=RolPagos&action=index10&search='+search,
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#rol_pagos_registrados").html(x);
           	               	 $("#tabla_rol_pagos").tablesorter(); 
           	                 $("#load_rol_pagos_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#rol_pagos_registrados").html("Ocurrio un error al cargar la información de Rol Pagos..."+estado+"    "+error);
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
			    
		    	var contador=0;
		    	var tiempo = tiempo || 1000;




		    	if (mes_afectacion == 0 )
		    	{
			    	
		    		$("#mensaje_mes_afectacion").text("Seleccione");
		    		$("#mensaje_mes_afectacion").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_mes_afectacion).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		if(mes_afectacion_verificacion.trim()==mes_afectacion){

	                   	 $("#mensaje_mes_afectacion").fadeOut("slow"); //Muestra mensaje de error
	    		            
	                    }else{

	                   	 $("#mensaje_mes_afectacion").text("El mes seleccionado no se puede procesar o ya se encuentra cerrado.");
	    		    		$("#mensaje_mes_afectacion").fadeIn("slow"); //Muestra mensaje de error
	    		    		$("html, body").animate({ scrollTop: $(mensaje_mes_afectacion).offset().top-120 }, tiempo);
	    					
	    		            return false;
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

			}); 

		      
		        $( "#mes_afectacion" ).focus(function() {
					  $("#mensaje_mes_afectacion").fadeOut("slow");
				    });

		        $( "#anio_afectacion" ).focus(function() {
					  $("#mensaje_anio_afectacion").fadeOut("slow");
				    });
		}); 

	</script>
	
  </body>
</html>   