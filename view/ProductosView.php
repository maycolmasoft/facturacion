<!DOCTYPE HTML>
<html lang="es">
      <head>
         
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Facturación</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
 
   <?php include("view/modulos/links_css.php"); ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">	        
   			        
    </head>
    
    
    <body class="hold-transition skin-blue fixed sidebar-mini"  >
    
     
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
        <li class="active">Productos</li>
      </ol>
    </section>   

    <section class="content">
     <div class="box box-primary">
     <div class="box-header">
          <h3 class="box-title">Registrar Productos</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        
                  
                  <div class="box-body">

						<form action="<?php echo $helper->url("Productos","InsertaProductos"); ?>" method="post" class="col-lg-12 col-md-12 col-xs-12">
                              <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
             					<div class="row">
                        		    
                        		    <div class="col-xs-12 col-md-2 col-md-2">
                            		<div class="form-group">
                            		   						 
                                                              <label for="codigo_productos" class="control-label">Codigo:</label>
                                                              <input type="text" class="form-control" id="codigo_productos" name="codigo_productos" value="<?php echo $resEdit->codigo_productos; ?>"  placeholder="Código"/>
                                                              <div id="mensaje_codigo_productos" class="errores"></div>
					                                                                       
                                    </div>
                            		</div>
                        		    
                        		    <div class="col-xs-12 col-md-3 col-md-3">
                            		<div class="form-group">
                            		   						 
                                                              <label for="nombre_productos" class="control-label">Nombre:</label>
                                                              <input type="text" class="form-control" id="nombre_productos" name="nombre_productos" value="<?php echo $resEdit->nombre_productos; ?>"  placeholder="Nombre"/>
                                                               <input type="hidden" name="id_productos" id="id_productos" value="<?php echo $resEdit->id_productos; ?>" class="form-control"/>
					                                          <div id="mensaje_nombre_productos" class="errores"></div>
					                       	                                          
                                    </div>
                            		</div>
                            		  
                            		  
                            		  
                            		 <div class="col-md-2 col-lg-2 col-xs-12">
						             <div class="form-group">
								     					   <label for="precio_productos" class="control-label">Precio:</label>
								        				   <input type="text" class="form-control cantidades1" id="precio_productos" name="precio_productos" value='<?php echo $resEdit->precio_productos; ?>' 
	                                                       data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false">
	                                 		        	   <div id="mensaje_precio_productos" class="errores"></div>
						             </div>
						             </div>
                            		  
                            		  
                            	   <div class="col-xs-12 col-md-2 col-md-2">
                        		   <div class="form-group">
                                                          <label for="id_estado" class="control-label">Estado:</label>
                                                          <select name="id_estado" id="id_estado"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultEst as $res) {?>
                        										<option value="<?php echo $res->id_estado; ?>" <?php if ($res->id_estado == $resEdit->id_estado )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_estado; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_estado" class="errores"></div>
                                    </div>
                                    </div>
                        		</div>	
                        		
            					<div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Actualizar</i></button>
                                					  <button type="button" id="Cancelar" name="Cancelar" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></button>
                                
                                </div>
                    		    </div>
                    		    </div>
            
							    
							     <?php } } else {?>
							    
							    
								    
								    <div class="row">
                        		    
                        		      <div class="col-xs-12 col-md-2 col-md-2">
                            		  <div class="form-group">
                            		   						 
                                                              <label for="codigo_productos" class="control-label">Código:</label>
                                                              <input type="text" class="form-control" id="codigo_productos" name="codigo_productos" value=""  placeholder="Código"/>
                                                              <div id="mensaje_codigo_productos" class="errores"></div>
					                                                                      
                                      </div>
                            		  </div>
                        		    
                        		      <div class="col-xs-12 col-md-3 col-md-3">
                            		  <div class="form-group">
                            		   						 
                                                              <label for="nombre_productos" class="control-label">Nombre:</label>
                                                              <input type="text" class="form-control" id="nombre_productos" name="nombre_productos" value=""  placeholder="Nombre"/>
                                                               <input type="hidden" name="id_productos" id="id_productos" value="0" class="form-control"/>
					                                          <div id="mensaje_nombre_productos" class="errores"></div>
					                  		                                          
                                      </div>
                            		  </div>
                            		  
                            	
                            		  
	                                 <div class="col-md-2 col-lg-2 col-xs-12">
						             <div class="form-group">
								     					   <label for="precio_productos" class="control-label">Precio:</label>
								        				   <input type="text" class="form-control cantidades1" id="precio_productos" name="precio_productos" value='0.00' 
	                                                       data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" >
	                                 		        	   <div id="mensaje_precio_productos" class="errores"></div>
						             </div>
						             </div>
	                            		  
                            		  
                            		  
	                            	   <div class="col-lg-2 col-xs-12 col-md-2">
	                        		   <div class="form-group">
	                                                          <label for="id_estado" class="control-label">Estado:</label>
	                                                          <select name="id_estado" id="id_estado"  class="form-control" >
	                                                          <option value="0" selected="selected">--Seleccione--</option>
	                        									<?php foreach($resultEst as $res) {?>
	                        										<option value="<?php echo $res->id_estado; ?>"><?php echo $res->nombre_estado; ?> </option>
	                        							        <?php } ?>
	                        								   </select> 
	                                                          <div id="mensaje_id_estado" class="errores"></div>
	                                    </div>
	                                    </div>
	                            		  
                            		</div>	
                        					    
							   
							   <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Guardar</i></button>
                                					  <button type="button" id="Cancelar" name="Cancelar" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></button>
                                
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
              <h3 class="box-title">Listado Productos</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
            
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li id="nav-activos" class="active"><a href="#activos" data-toggle="tab">Productos Activos</a></li>
              <li id="nav-inativos"><a href="#inactivos" data-toggle="tab" >Productos Inactivos</a></li>
            </ul>
            
            <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="tab-content">
            <br>
              <div class="tab-pane active" id="activos">
                
					<div class="pull-right" style="margin-right:11px;">
					<input type="text" value="" class="form-control" id="search_activos" name="search_activos" onkeyup="load_productos_activos(1)" placeholder="search.."/>
					</div>
					
					
					<div id="load_activos_registrados" ></div>	
					<div id="productos_activos_registrados"></div>
                
              </div>
              
              <div class="tab-pane" id="inactivos">
                
                    <div class="pull-right" style="margin-right:11px;">
					<input type="text" value="" class="form-control" id="search_inactivos" name="search_inactivos" onkeyup="load_productos_inactivos(1)" placeholder="search.."/>
					</div>
					
					<div id="load_inactivos_registrados" ></div>	
					<div id="productos_inactivos_registrados"></div>
                
                
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
    
    
	<script src="view/bootstrap/otros/inputmask_bundle/jquery.inputmask.bundle.js"></script>
       <script>
      $(document).ready(function(){
      $(".cantidades1").inputmask();
      });
	  </script>   
       
       <script type="text/javascript">
     
        	   $(document).ready( function (){
        		
        		   load_productos_activos(1);
        		   load_productos_inactivos(1);
	   			});

        	


        	   
        	   function load_productos_activos(pagina){

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
           	               url: 'index.php?controller=Productos&action=consulta_productos_activos&search='+search,
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#productos_activos_registrados").html(x);
           	               	 $("#tabla_productos_activos").tablesorter(); 
           	                 $("#load_activos_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#productos_activos_registrados").html("Ocurrio un error al cargar la información de Productos Activos..."+estado+"    "+error);
           	              }
           	            });

           		   }


        	   function load_productos_inactivos(pagina){

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
           	               url: 'index.php?controller=Productos&action=consulta_productos_inactivos&search='+search,
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#productos_inactivos_registrados").html(x);
           	               	 $("#tabla_productos_inactivos").tablesorter(); 
           	                 $("#load_inactivos_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#productos_inactivos_registrados").html("Ocurrio un error al cargar la información de Productos Inactivos..."+estado+"    "+error);
           	              }
           	            });

           		   }

       		   
        </script>
        
       
        <script >
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    $("#Cancelar").click(function() 
			{
		    	$('#nombre_productos').val("");
				$('#codigo_productos').val("");
				$('#precio_productos').val("0.00");
				$('#id_estado').val("0");
				
		    }); 
		    }); 
			</script>
        
       
        <script>
        

	       	$(document).ready(function(){

                        var id_productos = $("#id_productos").val();

                        if(id_productos>0){}else{
        	       		
						$( "#codigo_productos" ).autocomplete({
		      				source: "<?php echo $helper->url("Productos","AutocompleteCodigo"); ?>",
		      				minLength: 1
		    			});
		
						$("#codigo_productos").focusout(function(){
		    				$.ajax({
		    					url:'<?php echo $helper->url("Productos","AutocompleteDevuelveNombres"); ?>',
		    					type:'POST',
		    					dataType:'json',
		    					data:{codigo_productos:$('#codigo_productos').val()}
		    				}).done(function(respuesta){

		    					$('#nombre_productos').val(respuesta.nombre_productos);
		    					$('#codigo_productos').val(respuesta.codigo_productos);
		    					$('#precio_productos').val(respuesta.precio_productos);
		    					$('#id_estado').val(respuesta.id_estado);
		    					
		    							    				
		        			}).fail(function(respuesta) {

		        				$('#nombre_productos').val("");
		    					//$('#codigo_productos').val("");
		    					$('#precio_productos').val("0.00");
		    					$('#id_estado').val("0");
		    				
		        			    
		        			  });
		    				 
		    				
		    			});  
                        }
						
		    		});
		
	     
		     </script>
       
       
               <script>
        

	       	$(document).ready(function(){

                        var id_productos = $("#id_productos").val();

                        if(id_productos>0){}else{
        	       		
						$( "#nombre_productos" ).autocomplete({
		      				source: "<?php echo $helper->url("Productos","AutocompleteNombre"); ?>",
		      				minLength: 1
		    			});
		
						$("#nombre_productos").focusout(function(){
		    				$.ajax({
		    					url:'<?php echo $helper->url("Productos","AutocompleteDevuelveCodigo"); ?>',
		    					type:'POST',
		    					dataType:'json',
		    					data:{nombre_productos:$('#nombre_productos').val()}
		    				}).done(function(respuesta){

		    					$('#nombre_productos').val(respuesta.nombre_productos);
		    					$('#codigo_productos').val(respuesta.codigo_productos);
		    					$('#precio_productos').val(respuesta.precio_productos);
		    					$('#id_estado').val(respuesta.id_estado);
		    					
		    							    				
		        			}).fail(function(respuesta) {

		        				//$('#nombre_productos').val("");
		    					$('#codigo_productos').val("");
		    					$('#precio_productos').val("0.00");
		    					$('#id_estado').val("0");
		    				
		        			    
		        			  });
		    				 
		    				
		    			});  
                        }
						
		    		});
		
	     
		     </script>
       
       
       
       
         <script>
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Guardar").click(function() 
			{
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var codigo_productos = $("#codigo_productos").val();
		    	var nombre_productos = $("#nombre_productos").val();
		    	var precio_productos = $("#precio_productos").val();
		    	var id_estado 		 = $("#id_estado").val();

		    	var contador=0;
		    	var tiempo = tiempo || 1000;
		    	
		    	
		    	
		    	if (codigo_productos == "")
		    	{
			    	
		    		$("#mensaje_codigo_productos").text("Introduzca Código");
		    		$("#mensaje_codigo_productos").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_codigo_productos).offset().top-120 }, tiempo);
			        
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_codigo_productos").fadeOut("slow"); //Muestra mensaje de error
		            
				}   

		    	if (nombre_productos == "")
		    	{
			    	
		    		$("#mensaje_nombre_productos").text("Introduzca Nombre");
		    		$("#mensaje_nombre_productos").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_nombre_productos).offset().top-120 }, tiempo);
			        
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombre_productos").fadeOut("slow"); //Muestra mensaje de error
		            
				} 

		    	if (precio_productos == 0.00)
		    	{
			    	
		    		$("#mensaje_precio_productos").text("Introduzca Precio");
		    		$("#mensaje_precio_productos").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_precio_productos).offset().top-120 }, tiempo);
			        
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_precio_productos").fadeOut("slow"); //Muestra mensaje de error
		            
				} 


		    	if (id_estado == 0)
		    	{
			    	
		    		$("#mensaje_id_estado").text("Seleccione Estado");
		    		$("#mensaje_id_estado").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_estado).offset().top-120 }, tiempo);
			        return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_estado").fadeOut("slow"); //Muestra mensaje de error
		            
				} 
		    	
			}); 


		        $( "#codigo_productos" ).focus(function() {
				  $("#mensaje_codigo_productos").fadeOut("slow");
			    });
		        $( "#nombre_productos" ).focus(function() {
				  $("#mensaje_nombre_productos").fadeOut("slow");
				});
		        $( "#precio_productos" ).focus(function() {
				  $("#mensaje_precio_productos").fadeOut("slow");
				});
			    $( "#id_estado" ).focus(function() {
				  $("#mensaje_id_estado").fadeOut("slow");
	   		    });		      
				    
		}); 

	</script>

 	
	
	
  </body>
</html>   

