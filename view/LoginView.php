<!DOCTYPE html>
<html lang="en">
  <head>
    
    <title>Facturación</title>

   
       <meta charset="UTF-8">
        
     <!--===============================================================================================-->	
    	<link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="view/bootstrap/otros/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="view/bootstrap/otros/login/css/main.css">
    <!--===============================================================================================-->
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">	  
  
    <?php include("view/modulos/links_css.php"); ?>
  
  </head>

  <body>
  
  
  
          
           
  
  
  
  <div class="limiter">
		<div class="container-login100">
			<div class="col-lg-7 col-md-7 col-xs-12">
			<div class="box-body">
			
			<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#cabeza" data-toggle="tab"><b>INICIAR SESIÓN</b></a></li>
              <li><a href="#detalle" data-toggle="tab"><b>REGISTRARSE</b></a></li> 
            </ul>
            
     <div class="tab-content">
               
               <div class="tab-pane active" id="cabeza">
          		 <section class="content">
          		 <div class="box-body">
		
          		<div class="col-lg-12 col-md-12 col-xs-12">
          		<div class="col-lg-6 col-md-6 col-xs-12">
          		<div class="login100-pic js-tilt" data-tilt>
					<a href="index.php?controller=Iniciar&action=index">
					<img src="view/images/logo_milenio.png" alt="IMG">
					</a>
				</div>
          		</div>
          		<div class="col-lg-6 col-md-6 col-xs-12">
          		<form class="login100-form validate-form" action="<?php echo $helper->url("Usuarios","Loguear"); ?>" method="post" >
					<span class="login100-form-title">
						Iniciar Sesión
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Usuario es requerido">
						<input class="input100" type="text" id="usuario" name="usuario" placeholder="Usuario..">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Clave es requerida">
						<input class="input100" type="password" id="clave" name="clave" placeholder="Clave..">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Olvidó su Usuario / Clave
						</span>
						<!-- <a class="txt2" href="<?php echo $helper->url("Usuarios","resetear_clave_inicio"); ?>">
							Usuario / Clave
						</a> -->
					</div>

					
						<br><br>
							
							  <?php if (isset($resultSet)) {?>
							<?php if ($resultSet != "") {?>
						
								 <?php if ($error == TRUE) {?>
								    <div class="row">
								    <div class="col-lg-12 col-md-12 col-xs-12">
								 	<div class="alert alert-danger" role="alert"><?php echo $resultSet; ?></div>
								 	</div>
								 	</div>
								 <?php } else {?>
								    <div class="row">		
								    <div class="col-lg-12 col-md-12 col-xs-12">	
								    <div class="alert alert-success" role="alert"><?php echo $resultSet; ?></div>
								    </div>
								    </div>
								    
								  
								    
								 <?php sleep(5); ?>
				     
				     			 <?php }?>
							
					        <?php } ?>
					        <?php } ?>  
						
					
					
					
				</form>
          		
          		</div>
          		</div>
          		</div>
          		</section>

				
								
          </div>
        		
     <div class="tab-pane" id="detalle">
        
          <div class="box-body">   
		 <form  action="<?php echo $helper->url("Clientes","AfiliaClientes"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">

             
        
       <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Personales</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
       					  
         					   <div class="col-lg-4 col-xs-12 col-md-4">
                    		   <div class="form-group">
                                                  <label for="id_tipo_identificacion" class="control-label">Tipo Identificación:</label>
                                                  <select name="id_tipo_identificacion" id="id_tipo_identificacion"  class="form-control" >
                                                  <option value="0" selected="selected">--Seleccione--</option>
                									<?php foreach($resultTipIdenti as $res) {?>
                										<option value="<?php echo $res->id_tipo_identificacion; ?>" ><?php echo $res->nombre_tipo_identificacion; ?> </option>
                							        <?php } ?>
                								   </select> 
                                                  <div id="mensaje_id_tipo_identificacion" class="errores"></div>
                                </div>
                                </div>
                                    
                                    
                               <div class="col-lg-4 col-xs-12 col-md-4">
                    		   <div class="form-group">
                                                  <label for="identificacion_clientes" class="control-label">Identificación:</label>
                                                  <input type="hidden" class="form-control" id="id_clientes" name="id_clientes" value="0" >
                                                  <input type="number" class="form-control" id="identificacion_clientes" name="identificacion_clientes" value="" placeholder="identificación..">
                                                  <div id="mensaje_identificacion_clientes" class="errores"></div>
                                </div>
                                </div>
                                
                               <div class="col-lg-4 col-xs-12 col-md-4">
                    		   <div class="form-group">
                                                  <label for="razon_social_clientes" class="control-label">Nombre y Apellido:</label>
                                                  <input type="text" class="form-control" id="razon_social_clientes" name="razon_social_clientes" value=""  placeholder="razón social..">
                                                  <div id="mensaje_razon_social_clientes" class="errores"></div>
                                </div>
                                </div>
                                    
                                    
                                <div class="col-lg-4 col-xs-12 col-md-4">
                    		    <div class="form-group">
                                                          <label for="id_provincias" class="control-label">Provincia:</label>
                                                          <select name="id_provincias" id="id_provincias"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultProvincias as $res) {?>
                        										<option value="<?php echo $res->id_provincias; ?>"><?php echo $res->nombre_provincias; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_provincias" class="errores"></div>
                                </div>
                    		    </div>       		    
                    		   
                    		    
                    		    <div class="col-lg-4 col-xs-12 col-md-4">
                    		    <div class="form-group">
                                                          <label for="id_cantones" class="control-label">Cantón:</label>
                                                          <select name="id_cantones" id="id_cantones"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                                                            <?php foreach($resultCantones as $res) {?>
                        										<option value="<?php echo $res->id_cantones; ?>"  ><?php echo $res->nombre_cantones; ?> </option>
                        							        <?php } ?>
                                                          </select> 
                                                          <div id="mensaje_id_cantones" class="errores"></div>
                                </div>
                    		    </div>
                    
                    		   
                    	      
                    		
                    		   	<div class="col-lg-4 col-xs-12 col-md-4">
                    		    <div class="form-group">
                                                      <label for="id_parroquias" class="control-label">Parroquia:</label>
                                                      <select name="id_parroquias" id="id_parroquias"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                    								  <?php foreach($resultParroquias as $res) {?>
                    										<option value="<?php echo $res->id_parroquias; ?>" ><?php echo $res->nombre_parroquias; ?> </option>
                    							      <?php } ?>
                    							      </select> 
                                                      <div id="mensaje_id_parroquias" class="errores"></div>
                                </div>
                    		    </div>
                                       
                    		    <div class="col-lg-4 col-xs-12 col-md-4">
                    		    <div class="form-group">
                                                      <label for="telefono_clientes" class="control-label">Teléfono:</label>
                                                      <input type="number" class="form-control" id="telefono_clientes" name="telefono_clientes" value=""  placeholder="teléfono..">
                                                      <div id="mensaje_telefono_clientes" class="errores"></div>
                                </div>
                            	</div>
                            	    
                        	    <div class="col-lg-4 col-xs-12 col-md-4">
                                <div class="form-group">
                                                      <label for="celular_clientes" class="control-label">Celular:</label>
                                                      <input type="number" class="form-control" id="celular_clientes" name="celular_clientes" value=""  placeholder="celular..">
                                                      <div id="mensaje_celular_clientes" class="errores"></div>
                                </div>
                                </div>
                    			
                    		    <div class="col-lg-4 col-xs-12 col-md-4">
                    		    <div class="form-group">
                                                      <label for="correo_clientes" class="control-label">Correo:</label>
                                                      <input type="email" class="form-control" id="correo_clientes" name="correo_clientes" value="" placeholder="email..">
                                                      <div id="mensaje_correo_clientes" class="errores"></div>
                                </div>
                    		    </div>
                                    
                                <div class="col-lg-8 col-xs-12 col-md-8">
                    		    <div class="form-group">
                                                      <label for="direccion_clientes" class="control-label">Barrio y/o sector, referencia:</label>
                                                      <input type="text" class="form-control" id="direccion_clientes" name="direccion_clientes" value="" placeholder="nombre barrio..">
                                                      <div id="mensaje_direccion_clientes" class="errores"></div>
                                </div>
                                </div>
                               
                    			            
             
             					
                              
                    		       <div class="col-lg-4 col-xs-12 col-md-4">
                        		    <div class="form-group">
                                                          <label for="fotografia_clientes" class="control-label">Fotografía:</label>
                                                          <input type="file" class="form-control" id="fotografia_clientes" name="fotografia_clientes" value="">
                                                          <div id="" class="errores"></div>
                                    </div>
                        		    </div>
               
            
            </div>
            </div>
            </section>
        
        
        
       <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos para Iniciar Sesión</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            <div class="alert alert-warning" role="alert">Recuerde que este sera su usuario y clave para iniciar sesión en el sistema.</div>
								    
								    <div class="col-lg-4 col-xs-12 col-md-4">
                        		    <div class="form-group">
                                                      <label for="cedula_usuarios" class="control-label">Usuario:</label>
                                                      <input type="number" class="form-control" id="cedula_usuarios" name="cedula_usuarios" value=""  placeholder="usuario.." readonly>
                                                      <div id="mensaje_cedula_usuarios" class="errores"></div>
                                    </div>
                                    </div>
								    
								    <div class="col-lg-4 col-xs-12 col-md-4">
                        		    <div class="form-group">
                                                          <label for="clave_usuarios" class="control-label">Clave:</label>
                                                          <input type="password" class="form-control" id="clave_usuarios" name="clave_usuarios" value="" placeholder="(clave..)" maxlength="15">
                                                          <div id="mensaje_clave_usuarios" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        		    <div class="col-lg-4 col-xs-12 col-md-4">
                        		    <div class="form-group">
                                                          <label for="clave_usuarios_r" class="control-label">Repita Clave:</label>
                                                          <input type="password" class="form-control" id="clave_usuarios_r" name="clave_usuarios_r" value="" placeholder="(clave..)" maxlength="15">
                                                          <div id="mensaje_clave_usuarios_r" class="errores"></div>
                                    </div>
                                    </div>
                               
            </div>
            </div>
            </section>
            
            
             <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Guardar</i></button>
                                					  <a href="index.php?controller=Usuarios&action=Loguear" class="btn btn-primary" ><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
	
                                </div>
                    		    </div>
                    		    </div>
            
            
          </form>
                </div>
        
     </div>		












</div>
			</div>
		</div>
	</div>
	</div>
</div>	
  
  
  
    
    
<!--===============================================================================================-->	
	<script src="view/bootstrap/otros/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="view/bootstrap/otros/login/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="view/bootstrap/otros/login/js/main.js"></script>
    <?php include("view/modulos/links_js.php"); ?>
	 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
    
    
    
    
        <script>
        

	       	$(document).ready(function(){

                        var id_clientes = $("#id_clientes").val();
                        
                        if(id_clientes>0){

                            }else{
        	       
						$( "#identificacion_clientes" ).autocomplete({
		      				source: "<?php echo $helper->url("Clientes","AutocompleteCedula"); ?>",
		      				minLength: 9
		    			});
        	       		
						$("#identificacion_clientes").focusout(function(){
		    				$.ajax({
		    					url:'<?php echo $helper->url("Clientes","AutocompleteDevuelveNombres"); ?>',
		    					type:'POST',
		    					dataType:'json',
		    					data:{identificacion_clientes:$('#identificacion_clientes').val()}
		    				}).done(function(respuesta){

		    					$('#razon_social_clientes').val(respuesta.razon_social_clientes);
		    					$('#id_tipo_identificacion').val(respuesta.id_tipo_identificacion);
		    					$('#identificacion_clientes').val(respuesta.identificacion_clientes);
		    					$('#id_provincias').val(respuesta.id_provincias);
		    					$('#id_cantones').val(respuesta.id_cantones);
		    					$('#id_parroquias').val(respuesta.id_parroquias);
		    					$('#direccion_clientes').val(respuesta.direccion_clientes);
		    					$('#telefono_clientes').val(respuesta.telefono_clientes);
		    					$('#celular_clientes').val(respuesta.celular_clientes);
		    					$('#correo_clientes').val(respuesta.correo_clientes);
		    					//$('#id_estado').val(respuesta.id_estado);
		    					
		    					

		    					
		    					
		    				
		        			}).fail(function(respuesta) {

		        				$('#razon_social_clientes').val("");
		    					$('#id_provincias').val("0");
		    					$('#id_cantones').val("0");
		    					$('#id_parroquias').val("0");
		    					$('#direccion_clientes').val("");
		    					$('#telefono_clientes').val("");
		    					$('#celular_clientes').val("");
		    					$('#correo_clientes').val("");
		    					//$('#id_estado').val("0");
		    				
		        			    
		        			  });
		    				 
		    				
		    			});  

                        }
						
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
                //var id_estado           = $("#id_estado").val();
            	var clave_usuarios = $("#clave_usuarios").val();
		    	var cclave_usuarios = $("#clave_usuarios_r").val();
		    
            
            
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

		    		$("html, body").animate({ scrollTop: $(mensaje_id_tipo_identificacion).offset().top-120 }, tiempo);
			        return false;
			    }else{
   	
			    	 	$("#mensaje_id_tipo_identificacion").fadeOut("slow"); //Muestra mensaje de error
				
				}


		    	
		    	if (identificacion_clientes == "")
		    	{
			    	
		    		$("#mensaje_identificacion_clientes").text("Ingrese Identificación");
		    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error

		    		$("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top-120 }, tiempo);
			        return false;
			    }
		    	else 
		    	{


					if(id_tipo_identificacion==1){


						 if (ok==0){
							 $("#mensaje_identificacion_clientes").text("Ingrese solo números");
					    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
					           
					            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top-120 }, tiempo);
					            return false;
					      }else{

								$("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
						
						  }
						
						
						if(identificacion_clientes.length==10){

							$("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
						}else{
							
							$("#mensaje_identificacion_clientes").text("Ingrese 10 Digitos");
				    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top-120 }, tiempo);
				            return false;
						}



						if (provincia < 1 || provincia > numeroProvincias){           
							$("#mensaje_identificacion_clientes").text("El código de la provincia (dos primeros dígitos) es inválido");
				    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top-120 }, tiempo);
				            return false;

					      }else{

					    		$("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
								
						  }



						if (d3==7 || d3==8){           

							$("#mensaje_identificacion_clientes").text("El tercer dígito ingresado es inválido");
				    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top-120 }, tiempo);
				            return false;
					      }
						else{

							$("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
							
							}



						if(nat == true){         
					         if (digitoVerificador != d10){    

					        	 $("#mensaje_identificacion_clientes").text("El número de cédula de la persona natural es incorrecto.");
						    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
						           
						            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top-120 }, tiempo);
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
					           
					            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top-120 }, tiempo);
					            return false;
					      }else{

								$("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
						
						  }

						

						if(identificacion_clientes.length >=13){

							$("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
						}else{
							
							$("#mensaje_identificacion_clientes").text("Ingrese 13 Digitos");
				    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top-120 }, tiempo);
				            return false;
						}



						if (provincia < 1 || provincia > numeroProvincias){           
							$("#mensaje_identificacion_clientes").text("El código de la provincia (dos primeros dígitos) es inválido");
				    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top-120 }, tiempo);
				            return false;

					      }else{

					    		$("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
								
						  }



						if (d3==7 || d3==8){           

							$("#mensaje_identificacion_clientes").text("El tercer dígito ingresado es inválido");
				    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top-120 }, tiempo);
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
						           
						            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top-120 }, tiempo);
						            return false;

						     }else{
						    	 $("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
							}
							       
						         if (digitoVerificador != d9){                          
										$("#mensaje_identificacion_clientes").text("El ruc de la empresa del sector público es incorrecto.");
							    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
							           
							            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top-120 }, tiempo);
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
						           
						            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top-120 }, tiempo);
						            return false;
						                             
						            
						         }else{
						        	 $("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
										
							         }
						              
						         if (digitoVerificador != d10){                          

						        	 $("#mensaje_identificacion_clientes").text("El ruc de la empresa del sector privado es incorrecto");
							    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
							           
							            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top-120 }, tiempo);
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
					           
					            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top-120 }, tiempo);
					            return false;
					            
					         }else{
					        	 if(identificacion_clientes.length >13){
					        		 $("#mensaje_identificacion_clientes").text("El ruc de la persona natural es incorrecto.");
							    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
							           
							            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top-120 }, tiempo);
							            return false;

						        	 }else{
						         
					        	 $("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
						        	 }	

						         }

							
					         if (digitoVerificador != d10){    

					        	 $("#mensaje_identificacion_clientes").text("El ruc de la persona natural es incorrecto.");
						    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
						           
						            $("html, body").animate({ scrollTop: $(mensaje_identificacion_clientes).offset().top-120 }, tiempo);
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
			    	
		    		$("#mensaje_razon_social_clientes").text("Introduzca Nombre y Apellido");
		    		$("#mensaje_razon_social_clientes").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_razon_social_clientes).offset().top-120 }, tiempo);
			        
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
						$("#mensaje_razon_social_clientes").text("Introduzca Nombres y Apellidos Completos");
			    		$("#mensaje_razon_social_clientes").fadeIn("slow"); //Muestra mensaje de error
			           
			            $("html, body").animate({ scrollTop: $(mensaje_razon_social_clientes).offset().top-120 }, tiempo);
			            return false;
					}
			    	
		    		
		            
				}


		    	if (id_provincias == 0 )
		    	{
			    	
		    		$("#mensaje_id_provincias").text("Seleccione");
		    		$("#mensaje_id_provincias").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_provincias).offset().top-120 }, tiempo);
					
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
		    		$("html, body").animate({ scrollTop: $(mensaje_id_cantones).offset().top-120 }, tiempo);
					
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
		    		$("html, body").animate({ scrollTop: $(mensaje_id_parroquias).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_parroquias").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
						    			    	
		    	if (celular_clientes == "" )
		    	{
			    	
		    		$("#mensaje_celular_clientes").text("Ingrese # Celular");
		    		$("#mensaje_celular_clientes").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_celular_clientes).offset().top-120 }, tiempo);
					
			            return false;
			    }
		    	else 
		    	{


		    		if(celular_clientes.length==10){

						$("#mensaje_celular_clientes").fadeOut("slow"); //Muestra mensaje de error
					}else{
						
						$("#mensaje_celular_clientes").text("Ingrese 10 dígitos");
			    		$("#mensaje_celular_clientes").fadeIn("slow"); //Muestra mensaje de error
			           
			            $("html, body").animate({ scrollTop: $(mensaje_celular_clientes).offset().top-120 }, tiempo);
			            return false;
					}

			    	
		    		
				}

				// correos
				
		    	if (correo_clientes == "")
		    	{
			    	
		    		$("#mensaje_correo_clientes").text("Introduzca un correo");
		    		$("#mensaje_correo_clientes").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_correo_clientes).offset().top-120 }, tiempo);
					
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
		    		$("html, body").animate({ scrollTop: $(mensaje_correo_clientes).offset().top-120 }, tiempo);
					
			            return false;	
			    }


		    	
		    	if (direccion_clientes == "" )
		    	{
			    	
		    		$("#mensaje_direccion_clientes").text("Ingrese Barrio");
		    		$("#mensaje_direccion_clientes").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_direccion_clientes).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_direccion_clientes").fadeOut("slow"); //Muestra mensaje de error
		            
				}



		    	if (clave_usuarios == "")
		    	{
		    		
		    		$("#mensaje_clave_usuarios").text("Introduzca una Clave");
		    		$("#mensaje_clave_usuarios").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_clave_usuarios).offset().top-120 }, tiempo);
				       
			            return false;
			    }else 
		    	{
		    		$("#mensaje_clave_usuarios").fadeOut("slow"); //Muestra mensaje de error
		            
				}


			     if (clave_usuarios.length<8){
			    	$("#mensaje_clave_usuarios").text("Introduzca mínimo 8 caracteres");
		    		$("#mensaje_clave_usuarios").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_clave_usuarios).offset().top-120 }, tiempo);
				    
		            return false;
				}else 
		    	{
		    		$("#mensaje_clave_usuarios").fadeOut("slow"); //Muestra mensaje de error
		            
				}

				 if (clave_usuarios.length>15){
			    	$("#mensaje_clave_usuarios").text("Introduzca máximo 15 caracteres");
		    		$("#mensaje_clave_usuarios").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_clave_usuarios).offset().top-120 }, tiempo);
					   
		            return false;
				}else 
		    	{
		    		$("#mensaje_clave_usuarios").fadeOut("slow"); //Muestra mensaje de error
		            
				}

				 

			
					
				

		    	if (cclave_usuarios == "")
		    	{
		    		
		    		$("#mensaje_clave_usuarios_r").text("Introduzca una Clave");
		    		$("#mensaje_clave_usuarios_r").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_clave_usuarios_r).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_clave_usuarios_r").fadeOut("slow"); 
		            
				}
		    	
		    	if (clave_usuarios != cclave_usuarios)
		    	{
			    	
		    		$("#mensaje_clave_usuarios_r").text("Claves no Coinciden");
		    		$("#mensaje_clave_usuarios_r").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_clave_usuarios_r).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else
		    	{
		    		$("#mensaje_clave_usuarios_r").fadeOut("slow"); 
			        
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



				$( "#clave_usuarios" ).focus(function() {
					$("#mensaje_clave_usuarios").fadeOut("slow");
    			});
				$( "#clave_usuarios_r" ).focus(function() {
					$("#mensaje_clave_usuarios_r").fadeOut("slow");
    			});
			});

	   

		   
		    
		    $(document).ready(function(){

		    	 $("#identificacion_clientes").keyup(function () {
			            var value = $(this).val();
			            $("#cedula_usuarios").val(value);
			        });

			 
	    });
		    
	</script>
        
    
    
    
    
    
    
   
  </body>
</html>
