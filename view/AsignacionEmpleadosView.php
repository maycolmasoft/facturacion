<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Asignación Empleados - Milenio</title>
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
                <li class="active">Asignación Empleados</li>
            </ol>
        </section>
        
        <!-- comienza diseño controles usuario -->
        
        
         <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
                 
        
        <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Asignar Rubros Empleados</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">


            <form  action="<?php echo $helper->url("AsignacionEmpleados","InsertaAsignacionEmpleados"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
                               
                          
                    	
                    	
                    	           <div class="col-lg-2 col-xs-12 col-md-2">
                        		   <div class="form-group">
                                                      <label for="identificacion_empleados" class="control-label">Identificación:</label>
                                                      <input type="hidden" class="form-control" id="id_empleados" name="id_empleados" value="<?php echo $resEdit->id_empleados; ?>" readonly>
                                                      <input type="number" class="form-control" id="identificacion_empleados" name="identificacion_empleados" value="<?php echo $resEdit->identificacion_empleados; ?>"  placeholder="identificación.." readonly>
                                                      <div id="mensaje_identificacion_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                   <div class="col-lg-2 col-xs-12 col-md-2">
                        		   <div class="form-group">
                                                      <label for="apellidos_empleados" class="control-label">Apellidos:</label>
                                                      <input type="text" class="form-control" id="apellidos_empleados" name="apellidos_empleados" value="<?php echo $resEdit->apellidos_empleados; ?>"  placeholder="apellidos.." readonly>
                                                      <div id="mensaje_apellidos_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                   <div class="col-lg-2 col-xs-12 col-md-2">
                        		   <div class="form-group">
                                                      <label for="nombres_empleados" class="control-label">Nombres:</label>
                                                      <input type="text" class="form-control" id="nombres_empleados" name="nombres_empleados" value="<?php echo $resEdit->nombres_empleados; ?>"  placeholder="nombres.." readonly>
                                                      <div id="mensaje_nombres_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                
                                   
                    	        <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_departamentos" class="control-label">Departamentos:</label>
                                                          <select name="id_departamentos" id="id_departamentos"  class="form-control" disabled>
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultDepa as $res) {?>
                        										<option value="<?php echo $res->id_departamentos; ?>" <?php if ($res->id_departamentos == $resEdit->id_departamentos )  echo  ' selected="selected" '  ; ?>><?php echo $res->nombre_departamentos; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_departamentos" class="errores"></div>
                                </div>
                    		    </div>
                    		    
                    		    
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_cargos_departamentos" class="control-label">Cargo:</label>
                                                          <select name="id_cargos_departamentos" id="id_cargos_departamentos"  class="form-control">
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultCar as $res) {?>
                        										<option value="<?php echo $res->id_cargos_departamentos; ?>" ><?php echo $res->nombre_cargo_departamentos; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_cargos_departamentos" class="errores"></div>
                                </div>
                    		    </div>
                    		    
	                    	 <div id="div_datos" style="display: none;">
				             <div class="col-md-2 col-lg-2 col-xs-12">
						     					   <label for="valor_sueldo_cargo_departamentos" class="control-label">Salario:</label>
						        				   <input type="text" class="form-control" id="valor_sueldo_cargo_departamentos" name="valor_sueldo_cargo_departamentos" value=""  readonly>
				             </div>
					         </div>
                    	
                    	           	
                    	        <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Asignar" name="Asignar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Asignar</i></button>
                                					  <a href="index.php?controller=AsignacionEmpleados&action=index" class="btn btn-primary" ><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
				  		
                                </div>
                    		    </div>
                    		    </div>
                    	           	
                    
              </form>
  			</div>
      	</div>
   	</section>
    		
    	  <?php } } else if ($resultEdit1 !="" ) { foreach($resultEdit1 as $resEdit1) {?>	
    	  
    	  
    	  <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Actualizar Asignación de  Rubros Empleados</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">

            <form  action="<?php echo $helper->url("AsignacionEmpleados","ActualizaAsignacionEmpleados"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
                               
                     	         
                     	         
                     	         
                     	          <div class="col-lg-2 col-xs-12 col-md-2">
                        		   <div class="form-group">
                                                      <label for="identificacion_empleados" class="control-label">Identificación:</label>
                                                      <input type="hidden" class="form-control" id="id_empleados" name="id_empleados" value="<?php echo $resEdit1->id_empleados; ?>" readonly>
                                                      <input type="number" class="form-control" id="identificacion_empleados" name="identificacion_empleados" value="<?php echo $resEdit1->identificacion_empleados; ?>"  placeholder="identificación.." readonly>
                                                      <div id="mensaje_identificacion_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                   <div class="col-lg-2 col-xs-12 col-md-2">
                        		   <div class="form-group">
                                                      <label for="apellidos_empleados" class="control-label">Apellidos:</label>
                                                      <input type="text" class="form-control" id="apellidos_empleados" name="apellidos_empleados" value="<?php echo $resEdit1->apellidos_empleados; ?>"  placeholder="apellidos.." readonly>
                                                      <div id="mensaje_apellidos_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                   <div class="col-lg-2 col-xs-12 col-md-2">
                        		   <div class="form-group">
                                                      <label for="nombres_empleados" class="control-label">Nombres:</label>
                                                      <input type="text" class="form-control" id="nombres_empleados" name="nombres_empleados" value="<?php echo $resEdit1->nombres_empleados; ?>"  placeholder="nombres.." readonly>
                                                      <div id="mensaje_nombres_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                
                                   
                    	        <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_departamentos" class="control-label">Departamentos:</label>
                                                          <select name="id_departamentos" id="id_departamentos"  class="form-control" disabled>
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultDepa as $res) {?>
                        										<option value="<?php echo $res->id_departamentos; ?>" <?php if ($res->id_departamentos == $resEdit1->id_departamentos )  echo  ' selected="selected" '  ; ?>><?php echo $res->nombre_departamentos; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_departamentos" class="errores"></div>
                                </div>
                    		    </div>
                    		    
                    		    
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_cargos_departamentos" class="control-label">Cargo:</label>
                                                          <select name="id_cargos_departamentos" id="id_cargos_departamentos"  class="form-control">
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultCar as $res) {?>
                        										<option value="<?php echo $res->id_cargos_departamentos; ?>" <?php if ($res->id_cargos_departamentos == $resEdit1->id_cargos_departamentos )  echo  ' selected="selected" '  ;  ?>><?php echo $res->nombre_cargo_departamentos; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_cargos_departamentos" class="errores"></div>
                                </div>
                    		    </div>
                    		    
	                    	 <div id="div_datos" style="display: none;">
				             <div class="col-md-2 col-lg-2 col-xs-12">
						     					   <label for="valor_sueldo_cargo_departamentos" class="control-label">Salario:</label>
						        				   <input type="text" class="form-control" id="valor_sueldo_cargo_departamentos" name="valor_sueldo_cargo_departamentos" value=""  readonly>
				             </div>
					         </div>
                     	         
                     	         
                     	           	
                    	        <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Actualizar</i></button>
                                					  <a href="index.php?controller=AsignacionEmpleados&action=index" class="btn btn-primary" ><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
				  		
                                </div>
                    		    </div>
                    		    </div>
                    	           	
                    
	              </form>
	  			</div>
	      	</div>
	   	</section>
    	  
    	  
    	  
    	  <?php } }?>	
    		
    		
    		
       <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Listado Empleados Activos</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
            
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activos" data-toggle="tab">Empleados Sin Asignar Rubros</a></li>
              <li><a href="#inactivos" data-toggle="tab">Empleados Con Rubros Asignados</a></li>
            </ul>
            
            <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="tab-content">
            <br>
              <div class="tab-pane active" id="activos">
                
					<div class="pull-right" style="margin-right:15px;">
						<input type="text" value="" class="form-control" id="search_activos" name="search_activos" onkeyup="load_empleados_activos(1)" placeholder="search.."/>
					</div>
					<div id="load_activos_registrados" ></div>	
					<div id="empleados_activos_registrados"></div>	
                
              </div>
              
              <div class="tab-pane" id="inactivos">
                
                    <div class="pull-right" style="margin-right:15px;">
					<input type="text" value="" class="form-control" id="search_inactivos" name="search_inactivos" onkeyup="load_empleados_inactivos(1)" placeholder="search.."/>
					</div>
					
					
					<div id="load_inactivos_registrados" ></div>	
					<div id="empleados_inactivos_registrados"></div>
                
              </div>
             
            </div>
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
  
 
   
   <script>
   $("#id_cargos_departamentos").click(function() {
		
 	  var id_cargos_departamentos = $(this).val();
			
       if(id_cargos_departamentos > 0 )
       {
    	   load_salario(id_cargos_departamentos);
    	   $("#div_datos").fadeIn("slow");
    	   
       }
    	  else
       {
    	   $("#div_datos").fadeOut("slow");
       }
      
	    });
	    
	    $("#id_cargos_departamentos").change(function() {
			  
           var id_cargos_departamentos = $(this).val();
				
           if(id_cargos_departamentos > 0)
           {
        	   load_salario(id_cargos_departamentos);
	       	   $("#div_datos").fadeIn("slow");
           }
           else
           {
        	   $("#div_datos").fadeOut("slow");
           }
           
     });


	       function load_salario(id_cargos_departamentos){
		     
	    	   $.ajax({
	                    url: 'index.php?controller=AsignacionEmpleados&action=consulta_salarios',
	                    type: 'POST',
	                    data: {action:'ajax', id_cargos_departamentos:id_cargos_departamentos},
	                    success: function(x){
	                      $("#valor_sueldo_cargo_departamentos").val(x);
	                      
	                    }
	             });
	        }
		    

		
   </script>
   
   
   
    <script type="text/javascript">
     
        	   $(document).ready( function (){
        		   load_empleados_activos(1);
        		   load_empleados_inactivos(1);
	   			});

        	          	   
        	   function load_empleados_activos(pagina){

        		   var search=$("#search_activos").val();
                   var con_datos={
           					  action:'ajax',
           					  page:pagina
           					  };
                 $("#load_activos_registrados").fadeIn('slow');
           	     $.ajax({
           	               beforeSend: function(objeto){
           	                 $("#load_activos_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>')
           	               },
           	               url: 'index.php?controller=AsignacionEmpleados&action=index10&search='+search,
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#empleados_activos_registrados").html(x);
           	               	 $("#tabla_empleados").tablesorter(); 
           	                 $("#load_activos_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#empleados_activos_registrados").html("Ocurrio un error al cargar la información de Empleados Para Asignar Rubros..."+estado+"    "+error);
           	              }
           	            });

           		   }


        	   function load_empleados_inactivos(pagina){

        		   var search=$("#search_inactivos").val();
                   var con_datos={
           					  action:'ajax',
           					  page:pagina
           					  };
                 $("#load_inactivos_registrados").fadeIn('slow');
           	     $.ajax({
           	               beforeSend: function(objeto){
           	                 $("#load_inactivos_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>')
           	               },
           	               url: 'index.php?controller=AsignacionEmpleados&action=index11&search='+search,
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#empleados_inactivos_registrados").html(x);
           	               	 $("#tabla_empleados").tablesorter(); 
           	                 $("#load_inactivos_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#empleados_inactivos_registrados").html("Ocurrio un error al cargar la información de Empleados Con Rubros Asignados..."+estado+"    "+error);
           	              }
           	            });

           		   }

       		   
        </script>
        
        
        
        
        
         
        <script >
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Asignar").click(function() 
			{

		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;


		    	var id_empleados = $("#id_empleados").val();
		    	var id_cargos_departamentos  =  $('#id_cargos_departamentos').val();
		    	var contador=0;
		    	var tiempo = tiempo || 1000;




		    	
		    	if (id_empleados == "" || id_empleados == 0 )
		    	{
			    	
		    		$("#mensaje_identificacion_empleados").text("Empleado no existe");
		    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
		            
				}


				
		    	if (id_cargos_departamentos == 0 )
		    	{
			    	
		    		$("#mensaje_id_cargos_departamentos").text("Seleccione Cargo");
		    		$("#mensaje_id_cargos_departamentos").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_cargos_departamentos).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_cargos_departamentos").fadeOut("slow"); //Muestra mensaje de error
		            
				}

			}); 

		    

		      
		        $( "#identificacion_empleados" ).focus(function() {
					  $("#mensaje_identificacion_empleados").fadeOut("slow");
				});
		        $( "#id_cargos_departamentos" ).focus(function() {
					  $("#mensaje_id_cargos_departamentos").fadeOut("slow");
				    });
		}); 

	</script>
        
      
    <script >
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Guardar").click(function() 
			{

		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;


		    	var id_empleados = $("#id_empleados").val();
		    	var id_cargos_departamentos  =  $('#id_cargos_departamentos').val();
		    	var contador=0;
		    	var tiempo = tiempo || 1000;


		    	
		    	if (id_empleados == "" || id_empleados == 0 )
		    	{
			    	
		    		$("#mensaje_identificacion_empleados").text("Empleado no existe");
		    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
		            
				}


				
		    	if (id_cargos_departamentos == 0 )
		    	{
			    	
		    		$("#mensaje_id_cargos_departamentos").text("Seleccione Cargo");
		    		$("#mensaje_id_cargos_departamentos").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_cargos_departamentos).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_cargos_departamentos").fadeOut("slow"); //Muestra mensaje de error
		            
				}

			}); 

		    

		      
		        $( "#identificacion_empleados" ).focus(function() {
					  $("#mensaje_identificacion_empleados").fadeOut("slow");
				});
		        $( "#id_cargos_departamentos" ).focus(function() {
					  $("#mensaje_id_cargos_departamentos").fadeOut("slow");
				    });
		}); 

	</script>
	
  </body>
</html>   