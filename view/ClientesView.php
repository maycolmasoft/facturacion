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
        <li class="active">Clientes</li>
      </ol>
    </section>   

    <section class="content">
     <div class="box box-primary">
     <div class="box-header">
          <h3 class="box-title">Registra Clientes</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        
                  
   <div class="box-body">
     <form  action="<?php echo $helper->url("Clientes","InsertaClientes"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
                               
                           <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
                 
                 
                           <div class="row">
                           
         					   <div class="col-lg-2 col-xs-12 col-md-2">
                    		   <div class="form-group">
                                                      <label for="id_tipo_identificacion" class="control-label">Tipo Identificación:</label>
                                                      <select name="id_tipo_identificacion" id="id_tipo_identificacion"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                    									<?php foreach($resultTipIdenti as $res) {?>
                    										<option value="<?php echo $res->id_tipo_identificacion; ?>" <?php if ($res->id_tipo_identificacion == $resEdit->id_tipo_identificacion )  echo  ' selected="selected" '  ;  ?>><?php echo $res->nombre_tipo_identificacion; ?> </option>
                    							    
                    							        <?php } ?>
                    								   </select> 
                                                      <div id="mensaje_id_tipo_identificacion" class="errores"></div>
                                </div>
                                </div>
                                
                                
                               <div class="col-lg-2 col-xs-12 col-md-2">
                    		   <div class="form-group">
                                                  <label for="identificacion_clientes" class="control-label">Identificación:</label>
                                                  <input type="hidden" class="form-control" id="id_clientes" name="id_clientes" value="<?php echo $resEdit->id_clientes; ?>" >
                                                  <input type="number" class="form-control" id="identificacion_clientes" name="identificacion_clientes" value="<?php echo $resEdit->identificacion_clientes; ?>"  placeholder="identificación..">
                                                  <div id="mensaje_identificacion_clientes" class="errores"></div>
                                </div>
                                </div>
                                    
                                  
                                    
                               <div class="col-lg-4 col-xs-12 col-md-4">
                    		   <div class="form-group">
                                                  <label for="razon_social_clientes" class="control-label">Razón Social:</label>
                                                  <input type="text" class="form-control" id="razon_social_clientes" name="razon_social_clientes" value="<?php echo $resEdit->razon_social_clientes; ?>"  placeholder="nombres..">
                                                  <div id="mensaje_razon_social_clientes" class="errores"></div>
                                </div>
                                </div>
                                    
                                 
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_provincias" class="control-label">Provincia:</label>
                                                          <select name="id_provincias" id="id_provincias"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultProvincias as $res) {?>
                        										<option value="<?php echo $res->id_provincias; ?>" <?php if ($res->id_provincias == $resEdit->id_provincias )  echo  ' selected="selected" '  ;  ?>><?php echo $res->nombre_provincias; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_provincias" class="errores"></div>
                                </div>
                    		    </div>       		    
                    		   
                    		    
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_cantones" class="control-label">Cantón:</label>
                                                          <select name="id_cantones" id="id_cantones"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                                                            <?php foreach($resultCantones as $res) {?>
                        										<option value="<?php echo $res->id_cantones; ?>" <?php if ($res->id_cantones == $resEdit->id_cantones )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_cantones; ?> </option>
                        							        <?php } ?>
                                                          </select> 
                                                          <div id="mensaje_id_cantones" class="errores"></div>
                                </div>
                    		    </div>
                                
           </div>        		   
                    			
           <div class="row">
                    		        
                        		    <div class="col-lg-2 col-xs-12 col-md-2">
                        		    <div class="form-group">
                                                          <label for="id_parroquias" class="control-label">Parroquia:</label>
                                                          <select name="id_parroquias" id="id_parroquias"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        								  <?php foreach($resultParroquias as $res) {?>
                        										<option value="<?php echo $res->id_parroquias; ?>" <?php if ($res->id_parroquias == $resEdit->id_parroquias )  echo  ' selected="selected" '  ;  ?>><?php echo $res->nombre_parroquias; ?> </option>
                        							      <?php } ?>
                        							      </select> 
                                                          <div id="mensaje_id_parroquias" class="errores"></div>
                                    </div>
                        		    </div>
                    		        
                    		          
                    			    <div class="col-lg-2 col-xs-12 col-md-2">
                        		    <div class="form-group">
                                                          <label for="telefono_clientes" class="control-label">Teléfono:</label>
                                                          <input type="number" class="form-control" id="telefono_clientes" name="telefono_clientes" value="<?php echo $resEdit->telefono_clientes; ?>"  placeholder="teléfono..">
                                                          <div id="mensaje_telefono_clientes" class="errores"></div>
                                    </div>
                            	    </div>
                                   
                                    
                        			<div class="col-lg-2 col-xs-12 col-md-2">
                        		    <div class="form-group">
                                                          <label for="celular_clientes" class="control-label">Celular:</label>
                                                          <input type="number" class="form-control" id="celular_clientes" name="celular_clientes" value="<?php echo $resEdit->celular_clientes; ?>"  placeholder="celular..">
                                                          <div id="mensaje_celular_clientes" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                    
                        		    <div class="col-lg-2 col-xs-12 col-md-2">
                        		    <div class="form-group">
                                                          <label for="correo_clientes" class="control-label">Correo:</label>
                                                          <input type="email" class="form-control" id="correo_clientes" name="correo_clientes" value="<?php echo $resEdit->correo_clientes; ?>" placeholder="email..">
                                                          <div id="mensaje_correo_clientes" class="errores"></div>
                                    </div>
                        		    </div>
                                    
                                    <div class="col-lg-4 col-xs-12 col-md-4">
                        		    <div class="form-group">
                                                          <label for="direccion_clientes" class="control-label">Barrio y/o sector:</label>
                                                          <input type="text" class="form-control" id="direccion_clientes" name="direccion_clientes" value="<?php echo $resEdit->direccion_clientes; ?>" placeholder="nombre barrio..">
                                                          <div id="mensaje_direccion_clientes" class="errores"></div>
                                    </div>
                                    </div>
                                
              </div>
                    	           	
                
              <div class="row">
             		          
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                      <label for="id_estado" class="control-label">Estado:</label>
                                                      <select name="id_estado" id="id_estado"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                    								  <?php foreach($resultEst as $res) {?>
                    										<option value="<?php echo $res->id_estado; ?>" <?php if ($res->id_estado == $resEdit->id_estado )  echo  ' selected="selected" '  ;  ?>><?php echo $res->nombre_estado; ?> </option>
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
            					  <a href="index.php?controller=Clientes&action=index" class="btn btn-primary" ><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
	
            </div>
		    </div>
		    </div>
        	           	
                                 
              <?php } } else {?>
                    		    
                    		   
                    		   
            <div class="row">
             					  
         					   <div class="col-lg-2 col-xs-12 col-md-2">
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
                                    
                                    
                               <div class="col-lg-2 col-xs-12 col-md-2">
                    		   <div class="form-group">
                                                  <label for="identificacion_clientes" class="control-label">Identificación:</label>
                                                  <input type="hidden" class="form-control" id="id_clientes" name="id_clientes" value="0" >
                                                  <input type="number" class="form-control" id="identificacion_clientes" name="identificacion_clientes" value=""  placeholder="identificación..">
                                                  <div id="mensaje_identificacion_clientes" class="errores"></div>
                                </div>
                                </div>
                                
                               <div class="col-lg-4 col-xs-12 col-md-4">
                    		   <div class="form-group">
                                                  <label for="razon_social_clientes" class="control-label">Razón Social:</label>
                                                  <input type="text" class="form-control" id="razon_social_clientes" name="razon_social_clientes" value=""  placeholder="razón social..">
                                                  <div id="mensaje_razon_social_clientes" class="errores"></div>
                                </div>
                                </div>
                                    
                                    
                                <div class="col-lg-2 col-xs-12 col-md-2">
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
                    		   
                    		    
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
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
                    
                                    
            </div>        		   
                    	      
                    			
           <div class="row">
                    		   	<div class="col-lg-2 col-xs-12 col-md-2">
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
                                       
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                      <label for="telefono_clientes" class="control-label">Teléfono:</label>
                                                      <input type="number" class="form-control" id="telefono_clientes" name="telefono_clientes" value=""  placeholder="teléfono..">
                                                      <div id="mensaje_telefono_clientes" class="errores"></div>
                                </div>
                            	</div>
                            	    
                        	    <div class="col-lg-2 col-xs-12 col-md-2">
                                <div class="form-group">
                                                      <label for="celular_clientes" class="control-label">Celular:</label>
                                                      <input type="number" class="form-control" id="celular_clientes" name="celular_clientes" value=""  placeholder="celular..">
                                                      <div id="mensaje_celular_clientes" class="errores"></div>
                                </div>
                                </div>
                    			
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                      <label for="correo_clientes" class="control-label">Correo:</label>
                                                      <input type="email" class="form-control" id="correo_clientes" name="correo_clientes" value="" placeholder="email..">
                                                      <div id="mensaje_correo_clientes" class="errores"></div>
                                </div>
                    		    </div>
                                    
                                <div class="col-lg-4 col-xs-12 col-md-4">
                    		    <div class="form-group">
                                                      <label for="direccion_clientes" class="control-label">Barrio y/o sector:</label>
                                                      <input type="text" class="form-control" id="direccion_clientes" name="direccion_clientes" value="" placeholder="nombre barrio..">
                                                      <div id="mensaje_direccion_clientes" class="errores"></div>
                                </div>
                                </div>
                               
                    			            
              </div>
                    	           	
                
              <div class="row">
                    		     
             					
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_estado" class="control-label">Estado:</label>
                                                          <select name="id_estado" id="id_estado"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        								  
                        								  <?php foreach($resultEst as $res) {?>
                        										<option value="<?php echo $res->id_estado; ?>" ><?php echo $res->nombre_estado; ?> </option>
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
              <h3 class="box-title">Listado Clientes</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
            
            
            
            
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li id="nav-activos" class="active"><a href="#activos" data-toggle="tab">Clientes Activos</a></li>
              <li id="nav-inativos"><a href="#inactivos" data-toggle="tab" >Clientes Inactivos</a></li>
            </ul>
            
            <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="tab-content">
            <br>
              <div class="tab-pane active" id="activos">
                
					<div class="pull-right" style="margin-right:11px;">
					<input type="text" value="" class="form-control" id="search_activos" name="search_activos" onkeyup="load_clientes_activos(1)" placeholder="search.."/>
					</div>
					
					
					<div id="load_activos_registrados" ></div>	
					<div id="clientes_activos_registrados"></div>
                
              </div>
              
              <div class="tab-pane" id="inactivos">
                
                    <div class="pull-right" style="margin-right:11px;">
					<input type="text" value="" class="form-control" id="search_inactivos" name="search_inactivos" onkeyup="load_clientes_inactivos(1)" placeholder="search.."/>
					</div>
					
					<div id="load_inactivos_registrados" ></div>	
					<div id="clientes_inactivos_registrados"></div>
                
                
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
      
        <script type="text/javascript">
     
        	   $(document).ready( function (){
        		
        		   load_clientes_activos(1);
        		   load_clientes_inactivos(1);
	   			});

        	


        	   
        	   function load_clientes_activos(pagina){

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
           	               url: 'index.php?controller=Clientes&action=index10&search='+search,
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#clientes_activos_registrados").html(x);
           	               	 $("#tabla_clientes").tablesorter(); 
           	                 $("#load_activos_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#clientes_activos_registrados").html("Ocurrio un error al cargar la informacion de Clientes Activos..."+estado+"    "+error);
           	              }
           	            });

           		   }


        	   function load_clientes_inactivos(pagina){

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
           	               url: 'index.php?controller=Clientes&action=index11&search='+search,
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#clientes_inactivos_registrados").html(x);
           	               	 $("#tabla_clientes").tablesorter(); 
           	                 $("#load_inactivos_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#clientes_inactivos_registrados").html("Ocurrio un error al cargar la informacion de Clientes Inactivos..."+estado+"    "+error);
           	              }
           	            });

           		   }

       		   
        </script>
        
        
        
        
        
	
	<script>
		$(document).ready(function(){

			$("#id_provincias").change(function(){
			
	            // obtenemos el combo de resultado combo 2
	           var $id_cantones = $("#id_cantones");
	       	

	            // lo vaciamos
	           var id_provincias = $(this).val();

	          
	          
	            if(id_provincias != 0)
	            {
	            	 $id_cantones.empty();
	            	
	            	 var datos = {
	                   	   
	            			 id_provincias:$(this).val()
	                  };
	             
	            	
	         	   $.post("<?php echo $helper->url("Clientes","devuelveCanton"); ?>", datos, function(resultado) {

	          		  if(resultado.length==0)
	          		   {
	          				$id_cantones.append("<option value='0' >--Seleccione--</option>");	
	             	   }else{
	             		    $id_cantones.append("<option value='0' >--Seleccione--</option>");
	          		 		$.each(resultado, function(index, value) {
	          		 			$id_cantones.append("<option value= " +value.id_cantones +" >" + value.nombre_cantones  + "</option>");	
	                     		 });
	             	   }	
	            	      
	         		  }, 'json');


	            }else{

	            	var id_cantones=$("#id_cantones");
	            	id_cantones.find('option').remove().end().append("<option value='0' >--Seleccione--</option>").val('0');
	            	var id_parroquias=$("#id_parroquias");
	            	id_parroquias.find('option').remove().end().append("<option value='0' >--Seleccione--</option>").val('0');
	            	
	            	
	            	
	            }
	            

			});
		});
	
       

	</script>
		 
		 
		 
		 
		 
		 
		 <script>
		$(document).ready(function(){

			$("#id_cantones").change(function(){

				
	            // obtenemos el combo de resultado combo 2
	           var $id_parroquias = $("#id_parroquias");
	       	

	            // lo vaciamos
	           var id_cantones = $(this).val();

	          
	          
	            if(id_cantones != 0)
	            {
	            	 $id_parroquias.empty();
	            	
	            	 var datos = {
	                   	   
	            			 id_cantones:$(this).val()
	                  };
	             
	            	
	         	   $.post("<?php echo $helper->url("Clientes","devuelveParroquias"); ?>", datos, function(resultado) {

	          		  if(resultado.length==0)
	          		   {
	          				$id_parroquias.append("<option value='0' >--Seleccione--</option>");	
	             	   }else{
	             		    $id_parroquias.append("<option value='0' >--Seleccione--</option>");
	          		 		$.each(resultado, function(index, value) {
	          		 			$id_parroquias.append("<option value= " +value.id_parroquias +" >" + value.nombre_parroquias  + "</option>");	
	                     		 });
	             	   }	
	            	      
	         		  }, 'json');


	            }else{

	            	var id_parroquias=$("#id_parroquias");
	            	id_parroquias.find('option').remove().end().append("<option value='0' >--Seleccione--</option>").val('0');
	            	
	            	
	            }
	            

			});
		});
	
       

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

                        var id_clientes = $("#id_clientes").val();

                        if(id_clientes>0){}else{
        	       		
						$( "#identificacion_clientes" ).autocomplete({
		      				source: "<?php echo $helper->url("Clientes","AutocompleteCedula"); ?>",
		      				minLength: 1
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
		    					$('#id_estado').val(respuesta.id_estado);
		    					
		    					

		    					
		    					
		    				
		        			}).fail(function(respuesta) {

		        				$('#razon_social_clientes').val("");
		    					$('#id_provincias').val("0");
		    					$('#id_cantones').val("0");
		    					$('#id_parroquias').val("0");
		    					$('#direccion_clientes').val("");
		    					$('#telefono_clientes').val("");
		    					$('#celular_clientes').val("");
		    					$('#correo_clientes').val("");
		    					$('#id_estado').val("0");
		    				
		        			    
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
			    	
		    		$("#mensaje_razon_social_clientes").text("Introduzca Razón Social");
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
						$("#mensaje_razon_social_clientes").text("Introduzca Razón Social Completa");
			    		$("#mensaje_razon_social_clientes").fadeIn("slow"); //Muestra mensaje de error
			           
			            $("html, body").animate({ scrollTop: $(mensaje_razon_social_clientes).offset().top-120 }, tiempo);
			            return false;
					}
			    	
		    		
		            
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

