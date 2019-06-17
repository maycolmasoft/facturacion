<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cargos Departamentos - Milenio</title>
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
                <li class="active">Cargos Departamentos</li>
            </ol>
        </section>
        
        <!-- comienza diseño controles usuario -->
        
        
                
        
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


            <form  action="<?php echo $helper->url("CargosDepartamentos","InsertaCargos"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
                               
                          
                    	   <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
       
                    	           
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_departamentos" class="control-label">Departamentos:</label>
                                                          <select name="id_departamentos" id="id_departamentos"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultDepa as $res) {?>
                        										<option value="<?php echo $res->id_departamentos; ?>" <?php if ($res->id_departamentos == $resEdit->id_departamentos )  echo  ' selected="selected" '  ;  ?>><?php echo $res->nombre_departamentos; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_departamentos" class="errores"></div>
                                </div>
                    		    </div>
                    		    
                    		    
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="nombre_cargo_departamentos" class="control-label">Nombre Cargo:</label>
                                                           <input type="hidden" class="form-control" id="id_cargos_departamentos" name="id_cargos_departamentos" value="<?php echo $resEdit->id_cargos_departamentos; ?>" >
                                                          <input type="text" class="form-control" id="nombre_cargo_departamentos" name="nombre_cargo_departamentos" value="<?php echo $resEdit->nombre_cargo_departamentos; ?>"  placeholder="nombre cargo..">
                                                          <div id="mensaje_nombre_cargo_departamentos" class="errores"></div>
                                </div>
                    		    </div>
                    		    
	                    	
					             <div class="col-md-2 col-lg-2 col-xs-12">
							     					   <label for="valor_sueldo_cargo_departamentos" class="control-label">Rubro:</label>
							        				  <input type="text" class="form-control cantidades1" id="valor_sueldo_cargo_departamentos" name="valor_sueldo_cargo_departamentos" value='<?php echo $resEdit->valor_sueldo_cargo_departamentos; ?>' 
                                                       data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" >
                                 		        	   <div id="mensaje_valor_sueldo_cargo_departamentos" class="errores"></div>
					             </div>
					        
                    	
                    	           	
                    	        <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Actualizar</i></button>
                                					  <a href="index.php?controller=CargosDepartamentos&action=index" class="btn btn-primary" ><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
				  		
                                </div>
                    		    </div>
                    		    </div>
                                   
                    	       
                    	       
                    	       
                    	        <?php }} else{ ?>	    
                    	        
                    	        
                    	           
                    	        <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_departamentos" class="control-label">Departamentos:</label>
                                                          <select name="id_departamentos" id="id_departamentos"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultDepa as $res) {?>
                        										<option value="<?php echo $res->id_departamentos; ?>"><?php echo $res->nombre_departamentos; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_departamentos" class="errores"></div>
                                </div>
                    		    </div>
                    		    
                    		    
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="nombre_cargo_departamentos" class="control-label">Nombre Cargo:</label>
                                                           <input type="hidden" class="form-control" id="id_cargos_departamentos" name="id_cargos_departamentos" value="0" >
                                                          <input type="text" class="form-control" id="nombre_cargo_departamentos" name="nombre_cargo_departamentos" value=""  placeholder="nombre cargo..">
                                                          <div id="mensaje_nombre_cargo_departamentos" class="errores"></div>
                                </div>
                    		    </div>
                    		    
	                    	
					             <div class="col-md-2 col-lg-2 col-xs-12">
							     					   <label for="valor_sueldo_cargo_departamentos" class="control-label">Rubro:</label>
							        				   <input type="text" class="form-control cantidades1" id="valor_sueldo_cargo_departamentos" name="valor_sueldo_cargo_departamentos" value='0.00' 
                                                       data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" >
                                 		        	   <div id="mensaje_valor_sueldo_cargo_departamentos" class="errores"></div>
					             </div>
					        
                    	
                    	
                    	    
                    	
                    	
                    	           	
                    	        <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Guardar</i></button>
                                					  <a href="index.php?controller=CargosDepartamentos&action=index" class="btn btn-primary" ><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
				  		
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
              <h3 class="box-title">Listado Cargos por Departamentos</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
                    <div class="pull-right" style="margin-right:15px;">
						<input type="text" value="" class="form-control" id="search_activos" name="search_activos" onkeyup="load_empleados_activos(1)" placeholder="search.."/>
					</div>
					<div id="load_activos_registrados" ></div>	
					<div id="empleados_activos_registrados"></div>	
            
         
            
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
        		   load_empleados_activos(1);
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
           	               url: 'index.php?controller=CargosDepartamentos&action=index10&search='+search,
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#empleados_activos_registrados").html(x);
           	               	 $("#tabla_empleados").tablesorter(); 
           	                 $("#load_activos_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#empleados_activos_registrados").html("Ocurrio un error al cargar la información de Cargos por Departamentos..."+estado+"    "+error);
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


		    	var id_departamentos = $("#id_departamentos").val();
		    	var nombre_cargo_departamentos  =  $('#nombre_cargo_departamentos').val();
		    	var valor_sueldo_cargo_departamentos  =  $('#valor_sueldo_cargo_departamentos').val();
		    	
		    	var contador=0;
		    	var tiempo = tiempo || 1000;


		    	
		    	if (id_departamentos==0 )
		    	{
			    	
		    		$("#mensaje_id_departamentos").text("Seleccione");
		    		$("#mensaje_id_departamentos").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_departamentos).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_departamentos").fadeOut("slow"); //Muestra mensaje de error
		            
				}


				
		    	if (nombre_cargo_departamentos == "" )
		    	{
			    	
		    		$("#mensaje_nombre_cargo_departamentos").text("Ingrese Nombre Cargo");
		    		$("#mensaje_nombre_cargo_departamentos").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_nombre_cargo_departamentos).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombre_cargo_departamentos").fadeOut("slow"); //Muestra mensaje de error
		            
				}


		    	if (valor_sueldo_cargo_departamentos == 0.00 )
		    	{
			    	
		    		$("#mensaje_valor_sueldo_cargo_departamentos").text("Ingrese Rubro");
		    		$("#mensaje_valor_sueldo_cargo_departamentos").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_valor_sueldo_cargo_departamentos).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_valor_sueldo_cargo_departamentos").fadeOut("slow"); //Muestra mensaje de error
		            
				}

			}); 

		    

		      
		        $( "#id_departamentos" ).focus(function() {
					  $("#mensaje_id_departamentos").fadeOut("slow");
				});
		        $( "#nombre_cargo_departamentos" ).focus(function() {
					  $("#mensaje_nombre_cargo_departamentos").fadeOut("slow");
				    });
		        $( "#valor_sueldo_cargo_departamentos" ).focus(function() {
					  $("#mensaje_valor_sueldo_cargo_departamentos").fadeOut("slow");
				    });
		}); 

	</script>
	
  </body>
</html>   