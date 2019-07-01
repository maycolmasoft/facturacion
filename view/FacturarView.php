<!DOCTYPE HTML>
<html lang="es">
      <head>
         
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Facturación - Facturar</title>
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
        <li class="active">Facturar</li>
      </ol>
   </section>   

    <section class="content">
     <div class="box box-primary">
     <div class="box-header">
          <h3 class="box-title">DATOS PARA LA FACTURA</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        
                  
   <div class="box-body">
     <form  action="<?php echo $helper->url("Facturar","InsertaFactura"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
                               
                      		    
                    		   
                    		   
            <div class="row">
             				        
                               <div class="col-lg-2 col-xs-12 col-md-2">
                    		   <div class="form-group">
                                                  <label for="identificacion_clientes" class="control-label">Identificación:</label>
                                                  <input type="hidden" class="form-control" id="id_clientes" name="id_clientes" value="0" >
                                                  <input type="number" class="form-control" id="identificacion_clientes" name="identificacion_clientes" value=""  placeholder="identificación..">
                                                  <div id="mensaje_identificacion_clientes" class="errores"></div>
                                </div>
                                </div>
                                
                               <div class="col-lg-3 col-xs-12 col-md-3">
                    		   <div class="form-group">
                                                  <label for="razon_social_clientes" class="control-label">Razón Social:</label>
                                                  <input type="text" class="form-control" id="razon_social_clientes" name="razon_social_clientes" value=""  placeholder="razón social..">
                                                  <div id="mensaje_razon_social_clientes" class="errores"></div>
                                </div>
                                </div>
                                    
                                    
                                       	    
                        	    <div class="col-lg-2 col-xs-12 col-md-2">
                                <div class="form-group">
                                                      <label for="celular_clientes" class="control-label">Celular:</label>
                                                      <input type="number" class="form-control" id="celular_clientes" name="celular_clientes" value=""  placeholder="celular.." readonly>
                                                      <div id="mensaje_celular_clientes" class="errores"></div>
                                </div>
                                </div>
                    			
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                      <label for="correo_clientes" class="control-label">Correo:</label>
                                                      <input type="email" class="form-control" id="correo_clientes" name="correo_clientes" value="" placeholder="email.." readonly>
                                                      <div id="mensaje_correo_clientes" class="errores"></div>
                                </div>
                    		    </div>
                                  
                                </div>
                                
                                
                                <div class="row">  
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                      <label for="fecha_factura_cabeza" class="control-label">Fecha:</label>
                                                      <input type="date" class="form-control" id="fecha_factura_cabeza" name="fecha_factura_cabeza" value="<?php echo date('Y-m-d');?>">
                                                      <div id="mensaje_fecha_factura_cabeza" class="errores"></div>
                                </div>
                    		    </div>
                                  
                                  
                                  
                                <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                          <label for="id_usuarios" class="control-label">Vendedor:</label>
                                                          <select name="id_usuarios" id="id_usuarios"  class="form-control" >
                                                          <option value="<?php echo $_SESSION["id_usuarios"]; ?>" ><?php echo $_SESSION["nombre_usuarios"]; ?> </option>
                        							      </select> 
                                                          <div id="mensaje_id_usuarios" class="errores"></div>
                                </div>
                    		    </div>    
                              
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_tipo_pago" class="control-label">Pago:</label>
                                                          <select name="id_tipo_pago" id="id_tipo_pago"  class="form-control" >
                                                          <?php foreach($resultTipPago as $res) {?>
                        										<option value="<?php echo $res->id_tipo_pago; ?>" ><?php echo $res->nombre_tipo_pago; ?> </option>
                        							        <?php } ?>
                        							      
                        								  </select> 
                                                          <div id="mensaje_id_tipo_pago" class="errores"></div>
                                </div>
                    		    </div>
                              
                              
                              
                    			            
              </div>
                    	  
                    	  
                    	  <div  class = "row" >
                         	<div  class = "col-md-12 col-lg-12 col-xs-12" >
                                <div  class = "pull-right" >
                                	<button  type = "button"  class = "btn btn-default"  data-toggle = "modal"  data-target = "#mod_agregar_productos" >
                            			<span  class = "fa fa-pencil-square" > </span> Agregar Productos
                          			</button>
                          			
                          			<button  type = "submit"  id="Guardar" name="Guardar" class = "btn btn-default" >
                            			<span  class = "glyphicon glyphicon-floppy-saved" > </span> Guardar Factura
                          			</button>
                          			
                          			<button  type = "submit"  id="Cancelar" name="Cancelar" class = "btn btn-default" >
                            			<span  class = "glyphicon glyphicon-floppy-remove" > </span> Cancelar
                          			</button>
                          			
                          			
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
              <h3 class="box-title">DETALLE DE LA FACTURA</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
        		
          	
			<div id="load_detalle_registrados" ></div>	
			<div id="detalle_registrados"></div>
        	</div>
          	</div>
	    </section>
    	       
     </div>
    
    
    
    
    <div class="modal fade" id="mod_agregar_productos">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">PRODUCTOS</h4>
          </div>
          <div class="modal-body">
          	<div class="row">
          	<div class="pull-right" style="margin-right:15px;">
				<input type="text" value="" class="form-control" id="search_productos" name="search_productos" onkeyup="load_productos(1)" placeholder="search.."/>
			</div>
          	
			<div id="load_productos_registrados" ></div>	
			<div id="productos_registrados"></div>
			</div>
          </div>
          <div class="modal-footer">
              <button  type = "button"  class = "btn btn-default"  data-dismiss = "modal" > Cerrar </button>
	
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
</div>
 
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    <?php include("view/modulos/links_js.php"); ?>
	
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      
        <script type="text/javascript">
     
        	   $(document).ready( function (){
        		   loadDetalleFactura();
        		  
	   			});


        	   $('#mod_agregar_productos').on('show.bs.modal', function (event) {
        			load_productos(1);
        			  var modal = $(this)
        			  modal.find('.modal-title').text('Listado Productos')

        	   });



        	   function load_productos(pagina){

        			var search=$("#search_productos").val();
        		   
        		    $("#load_productos_registrados").fadeIn('slow');
        		    
        		    $.ajax({
        		            beforeSend: function(objeto){
        		              $("#load_productos_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');
        		            },
        		            url: 'index.php?controller=Facturar&action=consulta_productos&search='+search,
        		            type: 'POST',
        		            data: {action:'ajax', page:pagina},
        		            success: function(x){
        		              $("#productos_registrados").html(x);
        		              $("#load_productos_registrados").html("");
        		              $("#tabla_productos").tablesorter(); 
        		              
        		            },
        		           error: function(jqXHR,estado,error){
        		             $("#users_registrados").html("Ocurrio un error al cargar la información de Productos..."+estado+"    "+error);
        		           }
        		     });
        		}


        	   function loadDetalleFactura(pagina){

       			
       		    $("#load_detalle_registrados").fadeIn('slow');
       		    
       		    $.ajax({
       		            beforeSend: function(objeto){
       		              $("#load_detalle_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');
       		            },
       		            url: 'index.php?controller=Facturar&action=trae_temporal',
       		            type: 'POST',
       		            data: {action:'ajax', page:pagina},
       		            success: function(x){
       		              $("#detalle_registrados").html(x);
       		              $("#load_detalle_registrados").html("");
       		              $("#tabla_temporal").tablesorter(); 
       		              
       		            },
       		           error: function(jqXHR,estado,error){
       		             $("#detalle_registrados").html("Ocurrio un error al cargar la información de Productos Agregados..."+estado+"    "+error);
       		           }
       		     });
       		}


        	   function agregar_producto(id)
        	   {


            	   
        	   	var cantidad=document.getElementById('cantidad_'+id).value;
        	   	//Inicia validacion
        	   	if (isNaN(cantidad)){
        	   		alert('Esto no es un numero');
        	   		document.getElementById('cantidad_'+id).focus();
        	   		return false;
        	   	}
        	   	
        	   	var precio = document.getElementById('pecio_producto_'+id).value;
        	   	
        	   	if (isNaN(precio)){
        	   		document.getElementById('pecio_producto_'+id).focus();
        	   		swal('Esto no es un numero');
        	   	return false;
        	   	}
        	   	
        	   	
        	   	
        	   	$.ajax({
        	           type: "POST",
        	           url: 'index.php?controller=Facturar&action=insertaDetalleFactura',
        	           data: "id_productos="+id+"&cantidad="+cantidad+"&precio_u="+precio,
        	       	beforeSend: function(objeto){
        	       		/*$("#resultados").html("Mensaje: Cargando...");*/
        	       	},
        	       	dataType:'json'
        	       	}).done(function(data){
        	       		
        	       		loadDetalleFactura();
        	       		
        	       		
        	       	}).fail(function(xhr,status,error){
        	       		var err = xhr.responseText;
        	       		console.log(err);
        	       		loadDetalleFactura();
        	       	});
        	       	  
        	   }


        	   function eliminar_temporal(id)
        	   {
        	   	
        	   	$.ajax({
        	           type: "POST",
        	   	    url: 'index.php?controller=Facturar&action=eliminaTempFactura',
        	   	    data: "id_temp_factura="+id,
        	   		dataType:'json'
        	   	}).done(function(data){
        	   		
        	   		loadDetalleFactura();
        	   		
        	   	}).fail(function(xhr,status,error){
        	   		var err = xhr.responseText
        	   		
        	   		console.log(err)
        	   		
        	   		loadDetalleFactura();
        	   		
        	   	})
        	       
        	   }       	   
       		
        </script>
        
        
        
        
        
        
        
        
         <script >
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    $("#Cancelar").click(function() 
			{
		    	$('#razon_social_clientes').val("");
				$('#id_tipo_identificacion').val("0");
				$('#identificacion_clientes').val("");
				$('#id_provincias').val("0");
				$('#id_cantones').val("0");
				$('#id_parroquias').val("0");
				$('#direccion_clientes').val("");
				$('#telefono_clientes').val("");
				$('#celular_clientes').val("");
				$('#correo_clientes').val("");
		        $("#id_clientes").val("0");
		        $("#id_estado").val("0");

		        
		     
		    }); 
		    }); 
			</script>
        
        
          
        <script>
        

	       	$(document).ready(function(){
        	       		
						$( "#identificacion_clientes" ).autocomplete({
		      				source: "<?php echo $helper->url("Facturar","AutocompleteCedula"); ?>",
		      				minLength: 1
		    			});
		
						$("#identificacion_clientes").focusout(function(){
		    				$.ajax({
		    					url:'<?php echo $helper->url("Facturar","AutocompleteDevuelveNombres"); ?>',
		    					type:'POST',
		    					dataType:'json',
		    					data:{identificacion_clientes:$('#identificacion_clientes').val()}
		    				}).done(function(respuesta){

		    					$('#id_clientes').val(respuesta.id_clientes);
		    					$('#razon_social_clientes').val(respuesta.razon_social_clientes);
		    					$('#identificacion_clientes').val(respuesta.identificacion_clientes);
		    					$('#celular_clientes').val(respuesta.celular_clientes);
		    					$('#correo_clientes').val(respuesta.correo_clientes);
		    							    					
		    				
		        			}).fail(function(respuesta) {

		        				$('#id_clientes').val("0");
		    					$('#razon_social_clientes').val("");
		    					$('#identificacion_clientes').val("");
		    					$('#celular_clientes').val("");
		    					$('#correo_clientes').val("");
		    					
		        			    
		        			  });
		    				 
		    				
		    			});  
                        
						
		    		});
		
	     
		     </script>
        
        
        
                  
        <script>
        

	       	$(document).ready(function(){
        	       		
						$( "#razon_social_clientes" ).autocomplete({
		      				source: "<?php echo $helper->url("Facturar","AutocompleteNombre"); ?>",
		      				minLength: 1
		    			});
		
						$("#razon_social_clientes").focusout(function(){
		    				$.ajax({
		    					url:'<?php echo $helper->url("Facturar","AutocompleteDevuelveCedula"); ?>',
		    					type:'POST',
		    					dataType:'json',
		    					data:{razon_social_clientes:$('#razon_social_clientes').val()}
		    				}).done(function(respuesta){

		    					$('#id_clientes').val(respuesta.id_clientes);
		    					$('#razon_social_clientes').val(respuesta.razon_social_clientes);
		    					$('#identificacion_clientes').val(respuesta.identificacion_clientes);
		    					$('#celular_clientes').val(respuesta.celular_clientes);
		    					$('#correo_clientes').val(respuesta.correo_clientes);
		    							    					
		    				
		        			}).fail(function(respuesta) {

		        				$('#id_clientes').val("0");
		    					$('#razon_social_clientes').val("");
		    					$('#identificacion_clientes').val("");
		    					$('#celular_clientes').val("");
		    					$('#correo_clientes').val("");
		    					
		        			    
		        			  });
		    				 
		    				
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

		    	var id_tipo_identificacion  = $("#id_tipo_identificacion").val();
		    	var identificacion_clientes = $("#identificacion_clientes").val();
		    	var razon_social_clientes   = $("#razon_social_clientes").val();
		    	var telefono_clientes   = $("#telefono_clientes").val();
		    	var celular_clientes    = $("#celular_clientes").val();
		    	var correo_clientes     = $("#correo_clientes").val();
		    	var id_provincias       = $("#id_provincias").val();
		    	var id_cantones         = $("#id_cantones").val();
		    	var id_parroquias       = $("#id_parroquias").val();
		    	var direccion_clientes  = $("#direccion_clientes").val();
                var id_estado           = $("#id_estado").val();
              
		    	var contador=0;
		    	var tiempo = tiempo || 1000;

		    	var suma = 0;      
		        var residuo = 0;      
		        var pri = false;      
		        var pub = false;            
		        var nat = false;      
		        var numeroProvincias = 22;                  
		        var modulo = 11;
		                    
		        /* Verifico que el campo no contenga letras */                  
		        var ok=1;


		        for (i=0; i<identificacion_clientes.length && ok==1 ; i++){
		            var n = parseInt(identificacion_clientes.charAt(i));
		            if (isNaN(n)) ok=0;
		         }


		        /* Los primeros dos digitos corresponden al codigo de la provincia */
		        provincia = identificacion_clientes.substr(0,2);


		        /* Aqui almacenamos los digitos de la cedula en variables. */
		        d1  = identificacion_clientes.substr(0,1);         
		        d2  = identificacion_clientes.substr(1,1);         
		        d3  = identificacion_clientes.substr(2,1);         
		        d4  = identificacion_clientes.substr(3,1);         
		        d5  = identificacion_clientes.substr(4,1);         
		        d6  = identificacion_clientes.substr(5,1);         
		        d7  = identificacion_clientes.substr(6,1);         
		        d8  = identificacion_clientes.substr(7,1);         
		        d9  = identificacion_clientes.substr(8,1);         
		        d10 = identificacion_clientes.substr(9,1);                
		           
		        /* El tercer digito es: */                           
		        /* 9 para sociedades privadas y extranjeros   */         
		        /* 6 para sociedades publicas */         
		        /* menor que 6 (0,1,2,3,4,5) para personas naturales */ 


		        /* Solo para personas naturales (modulo 10) */         
		        if (d3 < 6){           
		           nat = true;            
		           p1 = d1 * 2;  if (p1 >= 10) p1 -= 9;
		           p2 = d2 * 1;  if (p2 >= 10) p2 -= 9;
		           p3 = d3 * 2;  if (p3 >= 10) p3 -= 9;
		           p4 = d4 * 1;  if (p4 >= 10) p4 -= 9;
		           p5 = d5 * 2;  if (p5 >= 10) p5 -= 9;
		           p6 = d6 * 1;  if (p6 >= 10) p6 -= 9; 
		           p7 = d7 * 2;  if (p7 >= 10) p7 -= 9;
		           p8 = d8 * 1;  if (p8 >= 10) p8 -= 9;
		           p9 = d9 * 2;  if (p9 >= 10) p9 -= 9;             
		           modulo = 10;
		        }         
		        /* Solo para sociedades publicas (modulo 11) */                  
		        /* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */
		        else if(d3 == 6){           
		           pub = true;             
		           p1 = d1 * 3;
		           p2 = d2 * 2;
		           p3 = d3 * 7;
		           p4 = d4 * 6;
		           p5 = d5 * 5;
		           p6 = d6 * 4;
		           p7 = d7 * 3;
		           p8 = d8 * 2;            
		           p9 = 0;            
		        }         
		           
		        /* Solo para entidades privadas (modulo 11) */         
		        else if(d3 == 9) {           
		           pri = true;                                   
		           p1 = d1 * 4;
		           p2 = d2 * 3;
		           p3 = d3 * 2;
		           p4 = d4 * 7;
		           p5 = d5 * 6;
		           p6 = d6 * 5;
		           p7 = d7 * 4;
		           p8 = d8 * 3;
		           p9 = d9 * 2;            
		        }
		                  
		        suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;                
		        residuo = suma % modulo;                                         
		        /* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
		        digitoVerificador = residuo==0 ? 0: modulo - residuo; 



		    	if (id_tipo_identificacion == 0)
		    	{
			    	
		    		$("#mensaje_id_tipo_identificacion").text("Seleccione Tipo");
		    		$("#mensaje_id_tipo_identificacion").fadeIn("slow"); //Muestra mensaje de error

		    		$("html, body").animate({ scrollTop: $(mensaje_id_tipo_identificacion).offset().top }, tiempo);
			        return false;
			    }else{
   	
			    	 	$("#mensaje_id_tipo_identificacion").fadeOut("slow"); //Muestra mensaje de error
				
				}


		    	
		    	if (identificacion_clientes == "")
		    	{
			    	
		    		$("#mensaje_identificacion_clientes").text("Ingrese Identificación");
		    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error

		    		$("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top }, tiempo);
			        return false;
			    }
		    	else 
		    	{


					if(id_tipo_identificacion==1){


						 if (ok==0){
							 $("#mensaje_identificacion_clientes").text("Ingrese solo números");
					    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
					           
					            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top }, tiempo);
					            return false;
					      }else{

								$("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
						
						  }
						
						
						if(identificacion_clientes.length==10){

							$("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
						}else{
							
							$("#mensaje_identificacion_clientes").text("Ingrese 10 Digitos");
				    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top }, tiempo);
				            return false;
						}



						if (provincia < 1 || provincia > numeroProvincias){           
							$("#mensaje_identificacion_clientes").text("El código de la provincia (dos primeros dígitos) es inválido");
				    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top }, tiempo);
				            return false;

					      }else{

					    		$("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
								
						  }



						if (d3==7 || d3==8){           

							$("#mensaje_identificacion_clientes").text("El tercer dígito ingresado es inválido");
				    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top }, tiempo);
				            return false;
					      }
						else{

							$("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
							
							}



						if(nat == true){         
					         if (digitoVerificador != d10){    

					        	 $("#mensaje_identificacion_clientes").text("El número de cédula de la persona natural es incorrecto.");
						    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
						           
						            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top }, tiempo);
						            return false;
						       
					         }else{

						        	 $("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
						     }  

					     }else{

					    	 $("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
							   
						 }





						
					}else{

						


						 if (ok==0){
							 $("#mensaje_identificacion_clientes").text("Ingrese solo números");
					    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
					           
					            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top }, tiempo);
					            return false;
					      }else{

								$("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
						
						  }

						

						if(identificacion_clientes.length >=13){

							$("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
						}else{
							
							$("#mensaje_identificacion_clientes").text("Ingrese 13 Digitos");
				    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top }, tiempo);
				            return false;
						}



						if (provincia < 1 || provincia > numeroProvincias){           
							$("#mensaje_identificacion_clientes").text("El código de la provincia (dos primeros dígitos) es inválido");
				    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top }, tiempo);
				            return false;

					      }else{

					    		$("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
								
						  }



						if (d3==7 || d3==8){           

							$("#mensaje_identificacion_clientes").text("El tercer dígito ingresado es inválido");
				    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top }, tiempo);
				            return false;
					      }
						else{

							$("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
							
							}


						  if (pub==true){      


						         /* El ruc de las empresas del sector publico terminan con 0001*/         
					         if ( identificacion_clientes.substr(9,4) != '0001' ){                    

					        	 $("#mensaje_identificacion_clientes").text("El ruc de la empresa del sector público debe terminar con 0001");
						    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
						           
						            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top }, tiempo);
						            return false;

						     }else{
						    	 $("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
							}
							       
						         if (digitoVerificador != d9){                          
										$("#mensaje_identificacion_clientes").text("El ruc de la empresa del sector público es incorrecto.");
							    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
							           
							            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top }, tiempo);
							            return false;
							           
						         } else{
						        	 $("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
										
							     }                 

						 }else{
				        	 $("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
								
					     }  

					               

					       if(pri == true){    
					    	   if ( identificacion_clientes.substr(10,3) != '001' ){   

					    		   $("#mensaje_identificacion_clientes").text("El ruc de la empresa del sector privado debe terminar con 001");
						    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
						           
						            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top }, tiempo);
						            return false;
						                             
						            
						         }else{
						        	 $("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
										
							         }
						              
						         if (digitoVerificador != d10){                          

						        	 $("#mensaje_identificacion_clientes").text("El ruc de la empresa del sector privado es incorrecto");
							    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
							           
							            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top }, tiempo);
							            return false;

							     } else{
						        	 $("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
										
						         }        
						         
						      } else{
						        	 $("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
										
							     }  


						if(nat == true){         

							if (identificacion_clientes.length >10 && identificacion_clientes.substr(10,3) != '001' ){                    
					         
					            $("#mensaje_identificacion_clientes").text("El ruc de la persona natural debe terminar con 001.");
					    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
					           
					            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top }, tiempo);
					            return false;
					            
					         }else{
					        	 if(identificacion_clientes.length >13){
					        		 $("#mensaje_identificacion_clientes").text("El ruc de la persona natural es incorrecto.");
							    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
							           
							            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top }, tiempo);
							            return false;

						        	 }else{
						         
					        	 $("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
						        	 }	

						         }

							
					         if (digitoVerificador != d10){    

					        	 $("#mensaje_identificacion_clientes").text("El ruc de la persona natural es incorrecto.");
						    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
						           
						            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top }, tiempo);
						            return false;
						       
					         }else{

						        	 $("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
						     }  


					     }else{

					    	 $("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
							   
						 }


						}


				}    


		    	


		    	if (razon_social_clientes == "")
		    	{
			    	
		    		$("#mensaje_razon_social_clientes").text("Introduzca Razón Social");
		    		$("#mensaje_razon_social_clientes").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_razon_social_clientes).offset().top }, tiempo);
			        
			            return false;
			    }
		    	else 
		    	{

		    		contador=0;
		    		numeroPalabras=0;
		    		contador = razon_social_clientes.split(" ");
		    		numeroPalabras = contador.length;
		    		
					if(numeroPalabras>=2){

						$("#mensaje_razon_social_clientes").fadeOut("slow"); //Muestra mensaje de error
				                     
			             
					}else{
						$("#mensaje_razon_social_clientes").text("Introduzca Razón Social Completa");
			    		$("#mensaje_razon_social_clientes").fadeIn("slow"); //Muestra mensaje de error
			           
			            $("html, body").animate({ scrollTop: $(mensaje_razon_social_clientes).offset().top }, tiempo);
			            return false;
					}
			    	
		    		
		            
				}

						    			    	
		    	if (celular_clientes == "" )
		    	{
			    	
		    		$("#mensaje_celular_clientes").text("Ingrese # Celular");
		    		$("#mensaje_celular_clientes").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_celular_clientes).offset().top }, tiempo);
					
			            return false;
			    }
		    	else 
		    	{


		    		if(celular_clientes.length==10){

						$("#mensaje_celular_clientes").fadeOut("slow"); //Muestra mensaje de error
					}else{
						
						$("#mensaje_celular_clientes").text("Ingrese 10 dígitos");
			    		$("#mensaje_celular_clientes").fadeIn("slow"); //Muestra mensaje de error
			           
			            $("html, body").animate({ scrollTop: $(mensaje_celular_clientes).offset().top }, tiempo);
			            return false;
					}

			    	
		    		
				}

				// correos
				
		    	if (correo_clientes == "")
		    	{
			    	
		    		$("#mensaje_correo_clientes").text("Introduzca un correo");
		    		$("#mensaje_correo_clientes").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_correo_clientes).offset().top }, tiempo);
					
		            return false;
			    }
		    	else if (regex.test($('#correo_clientes').val().trim()))
		    	{
		    		$("#mensaje_correo_clientes").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	else 
		    	{
		    		$("#mensaje_correo_clientes").text("Introduzca un correo Valido");
		    		$("#mensaje_correo_clientes").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_correo_clientes).offset().top }, tiempo);
					
			            return false;	
			    }


		    	if (id_provincias == 0 )
		    	{
			    	
		    		$("#mensaje_id_provincias").text("Seleccione");
		    		$("#mensaje_id_provincias").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_provincias).offset().top }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_provincias").fadeOut("slow"); //Muestra mensaje de error
		            
				}




		    	if (id_cantones == 0 )
		    	{
			    	
		    		$("#mensaje_id_cantones").text("Seleccione");
		    		$("#mensaje_id_cantones").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_cantones).offset().top }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_cantones").fadeOut("slow"); //Muestra mensaje de error
		            
				}



		    	if (id_parroquias == 0 )
		    	{
			    	
		    		$("#mensaje_id_parroquias").text("Seleccione");
		    		$("#mensaje_id_parroquias").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_parroquias).offset().top }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_parroquias").fadeOut("slow"); //Muestra mensaje de error
		            
				}

		    	if (direccion_clientes == "" )
		    	{
			    	
		    		$("#mensaje_direccion_clientes").text("Ingrese Barrio");
		    		$("#mensaje_direccion_clientes").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_direccion_clientes).offset().top }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_direccion_clientes").fadeOut("slow"); //Muestra mensaje de error
		            
				}

		    	
		    	if (id_estado == 0 )
		    	{
			    	
		    		$("#mensaje_id_estado").text("Seleccione");
		    		$("#mensaje_id_estado").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_estado).offset().top }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_estado").fadeOut("slow"); //Muestra mensaje de error
		            
				}

		    				    

			}); 

		    
		        $( "#id_tipo_identificacion" ).focus(function() {
				  $("#mensaje_id_tipo_identificacion").fadeOut("slow");
			    });
		        $( "#identificacion_clientes" ).focus(function() {
					  $("#mensaje_identificacion_clientes").fadeOut("slow");
				 });
		        $( "#razon_social_clientes" ).focus(function() {
					  $("#mensaje_razon_social_clientes").fadeOut("slow");
				 });
		       
		        $( "#celular_clientes" ).focus(function() {
					  $("#mensaje_celular_clientes").fadeOut("slow");
				 });  

		        $( "#correo_clientes" ).focus(function() {
					  $("#mensaje_correo_clientes").fadeOut("slow");
				 });  

		        $( "#id_provincias" ).focus(function() {
					  $("#mensaje_id_provincias").fadeOut("slow");
				 });

		        $( "#id_cantones" ).focus(function() {
					  $("#mensaje_id_cantones").fadeOut("slow");
				 });

		        $( "#id_parroquias" ).focus(function() {
					  $("#mensaje_id_parroquias").fadeOut("slow");
				 });

		        $( "#direccion_clientes" ).focus(function() {
					  $("#mensaje_direccion_clientes").fadeOut("slow");
				 });

		        $( "#id_estado" ).focus(function() {
					  $("#mensaje_id_estado").fadeOut("slow");
				 });
		}); 

	</script>
        
      
   	
  </body>
</html>   

