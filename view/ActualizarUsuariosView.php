<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Actualizar - Milenio</title>
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
                <li class="active">Actualizar Usuarios</li>
            </ol>
        </section>
        
        <!-- comienza diseño controles usuario -->
        
        <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Actualizar Usuario</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
                    
                     <form  action="<?php echo $helper->url("Usuarios","Actualiza"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
                               
                          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
                                
                             
                    		 <div class="row">
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                      <label for="cedula_usuarios" class="control-label">Cedula:</label>
                                                      <input type="number" class="form-control" id="cedula_usuarios" name="cedula_usuarios" value="<?php echo $resEdit->cedula_usuarios; ?>"  placeholder="ci-ruc.." readonly>
                                                      <div id="mensaje_cedula_usuarios" class="errores"></div>
                                </div>
                                </div>
                    		    
                    		    
                    		    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group">
                                                      <label for="nombre_usuarios" class="control-label">Nombres:</label>
                                                      <input type="text" class="form-control" id="nombre_usuarios" name="nombre_usuarios" value="<?php echo $resEdit->nombre_usuarios; ?>" placeholder="nombres..">
                                                      <div id="mensaje_nombre_usuarios" class="errores"></div>
                                </div>
                                
                                
                    		    </div>
                    		    
                    		    <!-- 
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                      <label for="usuario_usuario" class="control-label">Usuario</label>
                                                      <input type="text" class="form-control" id="usuario_usuario" name="usuario_usuario" value="" placeholder="usuario..">
                                                      <div id="mensaje_usuario_usuario" class="errores"></div>
                                </div>
                                </div>
                    			 -->
                    			
                    				<div class="col-lg-2 col-xs-12 col-md-2">
                        		    <div class="form-group">
                                                          <label for="clave_usuarios" class="control-label">Password:</label>
                                                          <input type="password" class="form-control" id="clave_usuarios" name="clave_usuarios" value="<?php echo $resEdit->pass_sistemas_usuarios; ?>" placeholder="(solo números..)" maxlength="15" >
                                                          <div id="mensaje_clave_usuarios" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        		    <div class="col-lg-2 col-xs-12 col-md-2">
                        		    <div class="form-group">
                                                          <label for="clave_usuarios_r" class="control-label">Repita Password:</label>
                                                          <input type="password" class="form-control" id="clave_usuarios_r" name="clave_usuarios_r" value="<?php echo $resEdit->pass_sistemas_usuarios; ?>" placeholder="(solo números..)" maxlength="15" >
                                                          <div id="mensaje_clave_usuarios_r" class="errores"></div>
                                    </div>
                                    </div>
                    	       </div>
                    			
                               
                    			
                    			<div class="row">
                    		       <div class="col-lg-2 col-xs-12 col-md-2">
                            		    <div class="form-group">
                                                              <label for="telefono_usuarios" class="control-label">Teléfono:</label>
                                                              <input type="text" class="form-control" id="telefono_usuarios" name="telefono_usuarios" value="<?php echo $resEdit->telefono_usuarios; ?>"  placeholder="teléfono..">
                                                              <div id="mensaje_telefono_usuarios" class="errores"></div>
                                        </div>
                            	    </div>
                            		    
                            		    
                    			
                        			<div class="col-lg-2 col-xs-12 col-md-2">
                                		    <div class="form-group">
                                                                  <label for="celular_usuarios" class="control-label">Celular:</label>
                                                                  <input type="text" class="form-control" id="celular_usuarios" name="celular_usuarios" value="<?php echo $resEdit->celular_usuarios; ?>"  placeholder="celular..">
                                                                  <div id="mensaje_celular_usuarios" class="errores"></div>
                                            </div>
                                    </div>
                        		    <div class="col-lg-4 col-xs-12 col-md-4">
                        		    <div class="form-group">
                                                          <label for="correo_usuarios" class="control-label">Correo:</label>
                                                          <input type="email" class="form-control" id="correo_usuarios" name="correo_usuarios" value="<?php echo $resEdit->correo_usuarios; ?>" placeholder="email..">
                                                          <div id="mensaje_correo_usuarios" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        		    
                        		    
                        		    <div class="col-lg-4 col-xs-12 col-md-4">
                        		    <div class="form-group">
                                                          <label for="fotografia_usuarios" class="control-label">Fotografía:</label>
                                                          <input type="file" class="form-control" id="fotografia_usuarios" name="fotografia_usuarios" value="">
                                                          <div id="mensaje_usuario" class="errores"></div>
                                    </div>
                        		    </div>
                        		
								     
                        		    
                        		    
                        		     <div class="col-xs-12 col-md-3 col-md-3">
                        		   <div class="form-group">
                                                          <label for="id_rol" class="control-label">Rol:</label>
                                                          <select name="id_rol" id="id_rol"  class="form-control" disabled>
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultRol as $res) {?>
                        										<option value="<?php echo $res->id_rol; ?>" <?php if ($res->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_rol; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_rol" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-md-3 col-md-3">
                        		   <div class="form-group">
                                                          <label for="id_estado" class="control-label">Estado:</label>
                                                          <select name="id_estado" id="id_estado"  class="form-control" disabled>
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultEst as $res) {?>
                        										<option value="<?php echo $res->id_estado; ?>" <?php if ($res->id_estado == $resEdit->id_estado )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_estado; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_estado" class="errores"></div>
                                    </div>
                                    </div>
                                
                                </div>
                             
                             
                             
                             
                             
                                
                                
                    		     <?php } } else {?>
                    		    
                    		   
                    	           	
                    		     <?php } ?>
                    		      
                    		    <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Actualizar</i></button>
                                </div>
                    		    </div>
                    		    </div>
  
              </form>
                    
                       
        	  </div>
      		</div>
      			
      			
    		</section>
    		
    		
    	
    	
    
  </div>
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    
   <?php include("view/modulos/links_js.php"); ?>
   
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.extensions.js"></script>
   
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
        
        
        
        <script >
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Guardar").click(function() 
			{


				
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var cedula_usuarios = $("#cedula_usuarios").val();
		    	var nombre_usuarios = $("#nombre_usuarios").val();
		    	//var usuario_usuario = $("#usuario_usuario").val();
		    	var clave_usuarios = $("#clave_usuarios").val();
		    	var cclave_usuarios = $("#clave_usuarios_r").val();
		    	var celular_usuarios = $("#celular_usuarios").val();
		    	var correo_usuarios  = $("#correo_usuarios").val();
		    	var id_rol  = $("#id_rol").val();
		    	var id_estado  = $("#id_estado").val();



		    	  var numeros="0123456789";
		    	  var mayusculas="QWERTYUIOPASDFGHJKLZXCVBNM�"
			      var minusculas = "abcdefghijklmnopqrstuvwxyz";
		    	  var num=false;
		    	  var may=false;
		    	  var min=false;

		    	  
		    	 


		    	
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


		        for (i=0; i<cedula_usuarios.length && ok==1 ; i++){
		            var n = parseInt(cedula_usuarios.charAt(i));
		            if (isNaN(n)) ok=0;
		         }


		        /* Los primeros dos digitos corresponden al codigo de la provincia */
		        provincia = cedula_usuarios.substr(0,2);


		        /* Aqui almacenamos los digitos de la cedula en variables. */
		        d1  = cedula_usuarios.substr(0,1);         
		        d2  = cedula_usuarios.substr(1,1);         
		        d3  = cedula_usuarios.substr(2,1);         
		        d4  = cedula_usuarios.substr(3,1);         
		        d5  = cedula_usuarios.substr(4,1);         
		        d6  = cedula_usuarios.substr(5,1);         
		        d7  = cedula_usuarios.substr(6,1);         
		        d8  = cedula_usuarios.substr(7,1);         
		        d9  = cedula_usuarios.substr(8,1);         
		        d10 = cedula_usuarios.substr(9,1);                
		           
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




		       

		    	
		    	if (cedula_usuarios == "")
		    	{
			    	
		    		$("#mensaje_cedula_usuarios").text("Introduzca Identificación");
		    		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error

		    		$("html, body").animate({ scrollTop: $(mensaje_cedula_usuarios).offset().top-120 }, tiempo);
			        return false;
			    }
		    	else 
		    	{


		    		 if (ok==0){
						 $("#mensaje_cedula_usuarios").text("Ingrese solo números");
				    		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_cedula_usuarios).offset().top-120 }, tiempo);
				            return false;
				      }else{

							$("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
					
					  }
					

			    	
		    		if(cedula_usuarios.length<10){

						
						$("#mensaje_cedula_usuarios").text("Ingrese al menos 10 dígitos");
			    		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error
			           
			            $("html, body").animate({ scrollTop: $(mensaje_cedula_usuarios).offset().top-120 }, tiempo);
			            return false;
						}else{
						
							$("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
							
					}


		    		if (provincia < 1 || provincia > numeroProvincias){           
						$("#mensaje_cedula_usuarios").text("El c�digo de la provincia (dos primeros dígitos) es inválido");
			    		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error
			           
			            $("html, body").animate({ scrollTop: $(mensaje_cedula_usuarios).offset().top-120 }, tiempo);
			            return false;

				      }else{

				    		$("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
							
					  }


		    		if (d3==7 || d3==8){           

						$("#mensaje_cedula_usuarios").text("El tercer dígito ingresado es inválido");
			    		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error
			           
			            $("html, body").animate({ scrollTop: $(mensaje_cedula_usuarios).offset().top-120 }, tiempo);
			            return false;
				      }
					else{

						$("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
						
						}




		    		if (pub==true){      


				         /* El ruc de las empresas del sector publico terminan con 0001*/         
			         if ( cedula_usuarios.substr(9,4) != '0001' ){                    

			        	 $("#mensaje_cedula_usuarios").text("El ruc de la empresa del sector público debe terminar con 0001");
				    		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_cedula_usuarios).offset().top-120 }, tiempo);
				            return false;

				     }else{
				    	 $("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
					}
					       
				         if (digitoVerificador != d9){                          
								$("#mensaje_cedula_usuarios").text("El ruc de la empresa del sector público es incorrecto.");
					    		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error
					           
					            $("html, body").animate({ scrollTop: $(mensaje_cedula_usuarios).offset().top-120 }, tiempo);
					            return false;
					           
				         } else{
				        	 $("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
								
					     }                 

				 }else{

		        	 $("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
		     }

			               

			       if(pri == true){    
			    	   if ( cedula_usuarios.substr(10,3) != '001' ){   

			    		   $("#mensaje_cedula_usuarios").text("El ruc de la empresa del sector privado debe terminar con 001");
				    		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_cedula_usuarios).offset().top-120 }, tiempo);
				            return false;
				                             
				            
				         }else{
				        	 $("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
								
					         }
				              
				         if (digitoVerificador != d10){                          

				        	 $("#mensaje_cedula_usuarios").text("El ruc de la empresa del sector privado es incorrecto");
					    		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error
					           
					            $("html, body").animate({ scrollTop: $(mensaje_cedula_usuarios).offset().top-120 }, tiempo);
					            return false;

					     } else{
				        	 $("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
								
				         }        
				         
				      } else{

				        	 $("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
				     }


				if(nat == true){         

					if (cedula_usuarios.length >10 && cedula_usuarios.substr(10,3) != '001' ){                    
			         
			            $("#mensaje_cedula_usuarios").text("El ruc de la persona natural debe terminar con 001.");
			    		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error
			           
			            $("html, body").animate({ scrollTop: $(mensaje_cedula_usuarios).offset().top-120 }, tiempo);
			            return false;
			            
			         }else{

			        	 if(cedula_usuarios.length >13){
			        		 $("#mensaje_cedula_usuarios").text("El ruc de la persona natural es incorrecto.");
					    		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error
					           
					            $("html, body").animate({ scrollTop: $(mensaje_cedula_usuarios).offset().top-120 }, tiempo);
					            return false;

				        	 }else{
				         
			        	 $("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
				        	 }

				         }

					
			         if (digitoVerificador != d10){    

			        	 if(cedula_usuarios.length >10){
			        		 $("#mensaje_cedula_usuarios").text("El ruc de la persona natural es incorrecto.");
					    		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error
					           
					            $("html, body").animate({ scrollTop: $(mensaje_cedula_usuarios).offset().top-120 }, tiempo);
					            return false;

				        	 }else{
				         
			        	 $("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
				        	 }


			        	 if(cedula_usuarios.length <11){
			        		 $("#mensaje_cedula_usuarios").text("El número de cedula de la persona natural es incorrecto.");
					    		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error
					           
					            $("html, body").animate({ scrollTop: $(mensaje_cedula_usuarios).offset().top-120 }, tiempo);
					            return false;

				        	 }else{
				         
			        	 $("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
				        	 }


				       
			         }else{

				        	 $("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
				     }  


				}else{

		        	 $("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
		     }
			
					
		            
				}    
			
		    	if (nombre_usuarios == "")
		    	{
			    	
		    		$("#mensaje_nombre_usuarios").text("Introduzca un Nombre");
		    		$("#mensaje_nombre_usuarios").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_nombre_usuarios).offset().top-120 }, tiempo);
			        
			            return false;
			    }
		    	else 
		    	{

		    		contador=0;
		    		numeroPalabras=0;
		    		contador = nombre_usuarios.split(" ");
		    		numeroPalabras = contador.length;
		    		
					if(numeroPalabras==2 || numeroPalabras==3 || numeroPalabras==4){

						$("#mensaje_nombre_usuarios").fadeOut("slow"); //Muestra mensaje de error
				                     
			             
					}else{
						$("#mensaje_nombre_usuarios").text("Introduzca Nombres y Apellidos");
			    		$("#mensaje_nombre_usuarios").fadeIn("slow"); //Muestra mensaje de error
			           
			            $("html, body").animate({ scrollTop: $(mensaje_nombre_usuarios).offset().top-120 }, tiempo);
			            return false;
					}
			    	
		    		
		            
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
				

				//los telefonos
		    	
		    	if (celular_usuarios == "" )
		    	{
			    	
		    		$("#mensaje_celular_usuarios").text("Ingrese un Celular");
		    		$("#mensaje_celular_usuarios").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_celular_usuarios).offset().top-120 }, tiempo);
					
			            return false;
			    }
		    	else 
		    	{


		    		if(celular_usuarios.length==10){

						$("#mensaje_celular_usuarios").fadeOut("slow"); //Muestra mensaje de error
					}else{
						
						$("#mensaje_celular_usuarios").text("Ingrese 10 dígitos");
			    		$("#mensaje_celular_usuarios").fadeIn("slow"); //Muestra mensaje de error
			           
			            $("html, body").animate({ scrollTop: $(mensaje_celular_usuarios).offset().top-120 }, tiempo);
			            return false;
					}

			    	
		    		
				}

				// correos
				
		    	if (correo_usuarios == "")
		    	{
			    	
		    		$("#mensaje_correo_usuarios").text("Introduzca un correo");
		    		$("#mensaje_correo_usuarios").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_correo_usuarios).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else if (regex.test($('#correo_usuarios').val().trim()))
		    	{
		    		$("#mensaje_correo_usuarios").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	else 
		    	{
		    		$("#mensaje_correo_usuarios").text("Introduzca un correo Valido");
		    		$("#mensaje_correo_usuarios").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_correo_usuarios).offset().top-120 }, tiempo);
					
			            return false;	
			    }

		    	
		    	if (id_rol == 0 )
		    	{
			    	
		    		$("#mensaje_id_rol").text("Seleccione");
		    		$("#mensaje_id_rol").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_rol).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_rol").fadeOut("slow"); //Muestra mensaje de error
		            
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


		        $( "#cedula_usuarios" ).focus(function() {
				  $("#mensaje_cedula_usuarios").fadeOut("slow");
			    });
				
				$( "#nombre_usuarios" ).focus(function() {
					$("#mensaje_nombre_usuarios").fadeOut("slow");
    			});
				
    			
				$( "#clave_usuarios" ).focus(function() {
					$("#mensaje_clave_usuarios").fadeOut("slow");
    			});
				$( "#clave_usuarios_r" ).focus(function() {
					$("#mensaje_clave_usuarios_r").fadeOut("slow");
    			});
				
				$( "#celular_usuarios" ).focus(function() {
					$("#mensaje_celular_usuarios").fadeOut("slow");
    			});
				
				$( "#correo_usuarios" ).focus(function() {
					$("#mensaje_correo_usuarios").fadeOut("slow");
    			});
			
				$( "#id_rol" ).focus(function() {
					$("#mensaje_id_rol").fadeOut("slow");
    			});

				$( "#id_estado" ).focus(function() {
					$("#mensaje_id_estado").fadeOut("slow");
    			});
				
		      
				    
		}); 

	</script>
        
        
        
        
         <script >
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    $("#Cancelar").click(function() 
			{
			 $("#cedula_usuarios").val("");
		     $("#nombre_usuarios").val("");
		     $("#clave_usuarios").val("");
		     $("#clave_usuarios_r").val("");
		     $("#telefono_usuarios").val("");
		     $("#celular_usuarios").val("");
		     $("#correo_usuarios").val("");
		     $("#id_rol").val("0");
		     $("#id_estado").val("0");
		     $("#fotografia_usuarios").val("");
		     $("#id_usuarios").val("");
		     
		    }); 
		    }); 
			</script>
        
        
     
    <script type="text/javascript">
    var interval, mouseMove;

    $(document).mousemove(function(){
        //Establezco la última fecha cuando moví el cursor
        mouseMove = new Date();
        /* Llamo a esta función para que ejecute una acción pasado x tiempo
         después de haber dejado de mover el mouse (en este caso pasado 3 seg) */
        inactividad(function(){
        	window.location.href = "index.php?controller=Usuarios&amp;action=cerrar_sesion";
        }, 10);
      });

    
    $(document).scroll(function(){
        //Establezco la última fecha cuando moví el cursor
        mouseMove = new Date();
        /* Llamo a esta función para que ejecute una acción pasado x tiempo
         después de haber dejado de mover el mouse (en este caso pasado 3 seg) */
        inactividad(function(){
        	window.location.href = "index.php?controller=Usuarios&amp;action=cerrar_sesion";
        }, 10);
      });

      $(document).keydown(function(){
          //Establezco la última fecha cuando moví el cursor
          mouseMove = new Date();
          /* Llamo a esta función para que ejecute una acción pasado x tiempo
           después de haber dejado de mover el mouse (en este caso pasado 3 seg) */
          inactividad(function(){
          	window.location.href = "index.php?controller=Usuarios&amp;action=cerrar_sesion";
          }, 10);
        });

     

      /* Función creada para ejecutar una acción (callback), al pasar x segundos 
         (seconds) de haber dejado de mover el cursor */
      var inactividad = function(callback, seconds){
        //Elimino el intervalo para que no se ejecuten varias instancias
        clearInterval(interval);
        //Creo el intervalo
        interval = setInterval(function(){
           //Hora actual
           var now = new Date();
           //Diferencia entre la hora actual y la última vez que se movió el cursor
           var diff = (now.getTime()-mouseMove.getTime())/1000;
           //Si la diferencia es mayor o igual al tiempo que pasastes por parámetro
           if(diff >= seconds){
            //Borro el intervalo
            clearInterval(interval);
            //Ejecuto la función que será llamada al pasar el tiempo de inactividad
            callback();          
           }
        }, 10);
      }
    </script>

	       <script src="view/bootstrap/otros/inputmask_bundle/jquery.inputmask.bundle.js"></script>
       
 	  
 	
  </body>
</html>

 