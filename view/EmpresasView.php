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
        <li class="active">Empresas</li>
      </ol>
    </section>   
   <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
            
            
            
    <section class="content">
     <div class="box box-primary">
     <div class="box-header">
          <h3 class="box-title">Registrar Empresas</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        
                  
                  <div class="box-body">

						<form action="<?php echo $helper->url("Empresas","InsertaEmpresas"); ?>" method="post" class="col-lg-12 col-md-12 col-xs-12">
                           
             					<div class="row">
                        		    
                        		    <div class="col-xs-12 col-md-3 col-md-3">
                            		<div class="form-group">
                            		   						 
                                                              <label for="nombre_empresa" class="control-label">Nombre:</label>
                                                              <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" value="<?php echo $resEdit->nombre_empresa; ?>"  placeholder="Nombre"/>
                                                                <input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $resEdit->id_empresa; ?>" class="form-control"/>
					                                          <div id="mensaje_nombre_empresa" class="errores"></div>
					                                                                       
                                    </div>
                            		</div>
                        		    
                        		    <div class="col-xs-12 col-md-3 col-md-3">
                            		<div class="form-group">
                            		   						 
                                                              <label for="ruc_empresa" class="control-label">Ruc:</label>
                                                              <input type="text" class="form-control" id="ruc_empresa" name="ruc_empresa" value="<?php echo $resEdit->ruc_empresa; ?>"  placeholder="Ruc"/>
                                                              <div id="mensaje_ruc_empresa" class="errores"></div>
					                       	                                          
                                    </div>
                            		</div>
                            		
                            		<div class="col-xs-12 col-md-3 col-md-3">
                            		<div class="form-group">
                            		   						 
                                                              <label for="direccion_empresa" class="control-label">Dirección:</label>
                                                              <input type="text" class="form-control" id="direccion_empresa" name="direccion_empresa" value="<?php echo $resEdit->direccion_empresa; ?>"  placeholder="Dirección"/>
                                                              <div id="mensaje_direccion_empresa" class="errores"></div>
					                                                                       
                                    </div>
                            		</div>
                        		    
                        		    <div class="col-xs-12 col-md-3 col-md-3">
                            		<div class="form-group">
                            		   						 
                                                              <label for="sucursal_empresa" class="control-label">Sucursal:</label>
                                                              <input type="text" class="form-control" id="sucursal_empresa" name="sucursal_empresa" value="<?php echo $resEdit->sucursal_empresa; ?>"  placeholder="Sucursal"/>
                                                              <div id="mensaje_sucursal_empresa" class="errores"></div>
					                       	                                          
                                    </div>
                            		</div>
                            		 <div class="col-xs-12 col-md-3 col-md-3">
                            		<div class="form-group">
                            		   						 
                                                              <label for="telefono_empresa" class="control-label">Teléfono:</label>
                                                              <input type="text" class="form-control" id="telefono_empresa" name="telefono_empresa" value="<?php echo $resEdit->telefono_empresa; ?>"  placeholder="Nombre"/>
                                                              <div id="mensaje_telefono_empresa" class="errores"></div>
					                       	                                          
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
            
            
                       	
 
                       </form>
                      
                  </div>
            </div>
        </section>
							    
							     <?php } } else {?>
							    
							    
								    					               	
							     <?php } ?>
					                		        
                           		
                    	
              
  
  
       <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Listado Empresas</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
           <div class="nav-tabs-custom">

           				<div class="pull-right" style="margin-right:15px;">
						<input type="text" value="" class="form-control" id="search_Empresas" name="search_Empresas" onkeyup="load_Empresas(1)" placeholder="search.."/>
					</div>
					<div id="load_Empresas" ></div>	
					<div id="Empresas_registrados_detalle"></div>	
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
        		   
        		   load_Empresas(1);
        		   
        		   
	   			});

        	


	   function load_Empresas(pagina){

		   var search=$("#search_Empresas").val();
	       var con_datos={
					  action:'ajax',
					  page:pagina
					  };
			  
	     $("#load_Empresas").fadeIn('slow');
	     
	     $.ajax({
	               beforeSend: function(objeto){
	                 $("#load_Empresas").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');
	               },
	               url: 'index.php?controller=Empresas&action=Consulta_Empresas&search='+search,
	               type: 'POST',
	               data: con_datos,
	               success: function(x){
	                 $("#Empresas_registrados_detalle").html(x);
	                 $("#load_Empresas").html("");
	                 $("#tabla_Empresas").tablesorter(); 
	                 
	               },
	              error: function(jqXHR,estado,error){
	                $("#Empresas_registrados_detalle").html("Ocurrio un error al cargar la informacion de Detalle Empresas..."+estado+"    "+error);
	              }
	            });


		   }

 </script>      

 <script>
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Guardar").click(function() 
			{
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var nombre_empresa = $("#nombre_empresa").val();
		    	var ruc_empresa = $("#ruc_empresa").val();
		    	var direccion_empresa = $("#direccion_empresa").val();
		    	var sucursal_empresa = $("#sucursal_empresa").val();
		    	var telefono_empresa = $("#telefono_empresa").val();

		    	var contador=0;
		    	var tiempo = tiempo || 1000;
		    	
		    	
		    	
		    	if (nombre_empresa == "")
		    	{
			    	
		    		$("#mensaje_nombre_empresa").text("Introduzca Nombre");
		    		$("#mensaje_nombre_empresa").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_nombre_empresa).offset().top-120 }, tiempo);
			        
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombre_empresa").fadeOut("slow"); //Muestra mensaje de error
		            
				}   

		    	if (ruc_empresa == "")
		    	{
			    	
		    		$("#mensaje_ruc_empresa").text("Introduzca Ruc");
		    		$("#mensaje_ruc_empresa").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_ruc_empresa).offset().top-120 }, tiempo);
			        
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_ruc_empresa").fadeOut("slow"); //Muestra mensaje de error
		            
				} 

		    	if (direccion_empresa == 0.00)
		    	{
			    	
		    		$("#mensaje_direccion_empresa").text("Introduzca Dirección");
		    		$("#mensaje_direccion_empresa").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_direccion_empresa).offset().top-120 }, tiempo);
			        
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_direccion_empresa").fadeOut("slow"); //Muestra mensaje de error
		            
				} 


		    	if (sucursal_empresa == "")
		    	{
			    	
		    		$("#mensaje_sucursal_empresa").text("Introduzca Teléfono");
		    		$("#mensaje_sucursal_empresa").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_sucursal_empresa).offset().top-120 }, tiempo);
			        return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_sucursal_empresa").fadeOut("slow"); //Muestra mensaje de error
		            
				} 
		    	if (telefono_empresa == "")
		    	{
			    	
		    		$("#mensaje_telefono_empresa").text("Introduzca Teléfono");
		    		$("#mensaje_telefono_empresa").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_telefono_empresa).offset().top-120 }, tiempo);
			        return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_telefono_empresa").fadeOut("slow"); //Muestra mensaje de error
		            
				} 
		    	
			}); 


		        $( "#nombre_empresa" ).focus(function() {
				  $("#mensaje_nombre_empresa").fadeOut("slow");
			    });
		        $( "#ruc_empresa" ).focus(function() {
				  $("#mensaje_ruc_empresa").fadeOut("slow");
				});
		        $( "#direccion_empresa" ).focus(function() {
				  $("#mensaje_direccion_empresa").fadeOut("slow");
				});
			    $( "#sucursal_empresa" ).focus(function() {
				  $("#mensaje_sucursal_empresa").fadeOut("slow");
	   		    });
			    $( "#telefono_empresa" ).focus(function() {
					  $("#mensaje_telefono_empresa").fadeOut("slow");
		   		});		      
					    		      
				    
		}); 

	</script>
        



 	
	
	
  </body>
</html>   

