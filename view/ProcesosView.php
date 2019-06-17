<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Milenio</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    
    
   <?php include("view/modulos/links_css.php"); ?>
   
  </head>
   
  <body class="hold-transition skin-blue fixed sidebar-mini">   
  <?php
        
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
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
            <li class="active">Biométrico</li>
          </ol>
        </section>
        
        <section class="content">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Datos Biometrico</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
                <form action="<?php echo $helper->url("Procesos","inserta_datos"); ?>" method="post" enctype="multipart/form-data" class="col-lg-12 col-md-12 col-xs-12">
          		 	               		    
                  <div class="row">
                    <div class="col-xs-12 col-md-5 col-md-5 ">
                      <div class="form-group">
                              <label for="file_biometrico" class="control-label">Seleccione Archivo:</label>                              
                              <input type="file" class="form-control" id="file_biometrico" name="file_biometrico">
                              <div id="mensaje_file_biometrico" class="errores"></div>
                        </div>
                      </div>
                      
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
                    	
                      
                      
                      
                      
                    </div>	
                    		
                    
                  <div class="row">
                      <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                        <div class="form-group">
                          <button type="submit" id="Subir" name="Subir" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Subir Datos</i></button>
                          <a href="index.php?controller=Procesos&action=index" class="btn btn-primary" ><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
				  		
                          </div>
                        </div>
                    </div>
                    	           	
                    
          		 	</form>
          
        			</div>
      			</div>
    		</section>
    		
    <!-- seccion para el listado de roles -->
    	
              
                  <section class="content">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Bitacora de Importación</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
					<div class="pull-right" style="margin-right:11px;">
					<input type="text" value="" class="form-control" id="search_bitacora_validacion" name="search_bitacora_validacion" onkeyup="load_bitacora_validacion(1)" placeholder="search.."/>
					</div>
					
					<div id="load_bitacora_validacion" ></div>	
					<div id="bitacora_validacion"></div>	
				
              
        
        </div></div></section>
        
        
        
        
        </div>
  
  
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    
   <?php include("view/modulos/links_js.php"); ?>
    	
    	
    	
    	<script type="text/javascript">

    	 $(document).ready( function (){
    		 consulta_mes_a_generar_rol();
    		 load_bitacora_validacion(1);
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



    	 function load_bitacora_validacion(pagina){

  		   var search=$("#search_bitacora_validacion").val();
             var con_datos={
     					  action:'ajax',
     					  page:pagina
     					  };
           $("#load_bitacora_validacion").fadeIn('slow');
     	     $.ajax({
     	               beforeSend: function(objeto){
     	                 $("#load_bitacora_validacion").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>')
     	               },
     	               url: 'index.php?controller=Procesos&action=consulta_bitacora_validacion&search='+search,
     	               type: 'POST',
     	               data: con_datos,
     	               success: function(x){
     	                 $("#bitacora_validacion").html(x);
     	               	 $("#tabla_bitacora_validacion").tablesorter(); 
     	                 $("#load_bitacora_validacion").html("");
     	               },
     	              error: function(jqXHR,estado,error){
     	                $("#bitacora_validacion").html("Ocurrio un error al cargar la información bitacora de validación..."+estado+"    "+error);
     	              }
     	            });

     		   }

    	</script>
    	
    	
    	<script>
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Subir").click(function() 
			{
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var file_biometrico = $("#file_biometrico").val();
		    	var mes_afectacion  =  $('#mes_afectacion').val();
		    	var anio_afectacion  =  $('#anio_afectacion').val();
		    	var mes_afectacion_verificacion =  $('#mes_afectacion_verificacion').val();
		    
		    	 extensiones_permitidas = new Array(".txt"); 
		    	 mierror = ""; 
		    	
		    	if (file_biometrico == "")
		    	{
			    	
		    		$("#mensaje_file_biometrico").text("Seleccione Archivo");
		    		$("#mensaje_file_biometrico").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_file_biometrico").fadeOut("slow"); //Muestra mensaje de error


		    		if(file_biometrico != ""){ 
			  		      extension = (file_biometrico.substring(file_biometrico.lastIndexOf("."))).toLowerCase(); 
			  		      permitida = false; 
			  		      for (var i = 0; i < extensiones_permitidas.length; i++) { 
			  		         if (extensiones_permitidas[i] == extension) { 
			  		         permitida = true; 
			  		         break; 
			  		         } 
			  		      } 
			  		      if (!permitida) { 
			  		    	  $("#mensaje_file_biometrico").text("Sólo se pueden subir archivos con extensiones: "+ extensiones_permitidas.join());
			  		    	  $("#mensaje_file_biometrico").fadeIn("slow"); //Muestra mensaje de error

			  		    	   return false;

				  			}else{ 
			  			        $("#mensaje_file_biometrico").fadeOut("slow"); //Muestra mensaje de error
			  		      	} 
			  		   }

				}   


		    	if (mes_afectacion == 0 )
		    	{
			    	
		    		$("#mensaje_mes_afectacion").text("Seleccione");
		    		$("#mensaje_mes_afectacion").fadeIn("slow"); //Muestra mensaje de error
		    		
		            return false;
			    }
		    	else 
		    	{

		    		if(mes_afectacion_verificacion.trim()==mes_afectacion){

                   	 $("#mensaje_mes_afectacion").fadeOut("slow"); //Muestra mensaje de error
    		            
                    }else{

                   	 $("#mensaje_mes_afectacion").text("El mes seleccionado no se puede procesar o ya se encuentra cerrado.");
    		    		$("#mensaje_mes_afectacion").fadeIn("slow"); //Muestra mensaje de error
    		    			
    		            return false;
	                     }
                

			    	
		    		
				}



		    	if (anio_afectacion == 0 )
		    	{
			    	
		    		$("#mensaje_anio_afectacion").text("Seleccione");
		    		$("#mensaje_anio_afectacion").fadeIn("slow"); //Muestra mensaje de error
		    		
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_anio_afectacion").fadeOut("slow"); //Muestra mensaje de error
		            
				}

		    	
			}); 


		        $( "#file_biometrico" ).focus(function() {
				  $("#mensaje_file_biometrico").fadeOut("slow");
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


       
       
      
 




