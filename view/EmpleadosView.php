<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Empleados - Milenio</title>
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
                <li class="active">Empleados</li>
            </ol>
        </section>
        
        <!-- comienza diseño controles usuario -->
        
        <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Registrar Empleados</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">





            <form  action="<?php echo $helper->url("Empleados","InsertaEmpleados"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
                               
                           <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
                 
                 
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
                                                      <label for="identificacion_empleados" class="control-label">Identificación:</label>
                                                      <input type="hidden" class="form-control" id="id_empleados" name="id_empleados" value="<?php echo $resEdit->id_empleados; ?>" >
                                                      <input type="number" class="form-control" id="identificacion_empleados" name="identificacion_empleados" value="<?php echo $resEdit->identificacion_empleados; ?>"  placeholder="identificación..">
                                                      <div id="mensaje_identificacion_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                   <div class="col-lg-2 col-xs-12 col-md-2">
                        		   <div class="form-group">
                                                      <label for="apellidos_empleados" class="control-label">Apellidos:</label>
                                                      <input type="text" class="form-control" id="apellidos_empleados" name="apellidos_empleados" value="<?php echo $resEdit->apellidos_empleados; ?>"  placeholder="apellidos..">
                                                      <div id="mensaje_apellidos_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                   <div class="col-lg-2 col-xs-12 col-md-2">
                        		   <div class="form-group">
                                                      <label for="nombres_empleados" class="control-label">Nombres:</label>
                                                      <input type="text" class="form-control" id="nombres_empleados" name="nombres_empleados" value="<?php echo $resEdit->nombres_empleados; ?>"  placeholder="nombres..">
                                                      <div id="mensaje_nombres_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                   
                                   
                                       
                    		       <div class="col-lg-2 col-xs-12 col-md-2">
                            		<div class="form-group">
                                                              <label for="telefono_empleados" class="control-label">Teléfono:</label>
                                                              <input type="number" class="form-control" id="telefono_empleados" name="telefono_empleados" value="<?php echo $resEdit->telefono_empleados; ?>"  placeholder="teléfono..">
                                                              <div id="mensaje_telefono_empleados" class="errores"></div>
                                    </div>
                            	   </div>
                               
                               
 								    <div class="col-lg-2 col-xs-12 col-md-2">
                                    <div class="form-group">
                                                                  <label for="celular_empleados" class="control-label">Celular:</label>
                                                                  <input type="number" class="form-control" id="celular_empleados" name="celular_empleados" value="<?php echo $resEdit->celular_empleados; ?>"  placeholder="celular..">
                                                                  <div id="mensaje_celular_empleados" class="errores"></div>
                                    </div>
                                    </div>
                        		                                  
              		   
                    	      
             
                    		   
                        	    <div class="col-lg-2 col-xs-12 col-md-2">
                        		<div class="form-group">
                                                          <label for="correo_empleados" class="control-label">Correo:</label>
                                                          <input type="email" class="form-control" id="correo_empleados" name="correo_empleados" value="<?php echo $resEdit->correo_empleados; ?>" placeholder="email..">
                                                          <div id="mensaje_correo_empleados" class="errores"></div>
                                </div>
                        		</div>
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                        		<div class="form-group">
                                                          <label for="fecha_nacimiento_empleados" class="control-label">Fecha Nac:</label>
                                                          <input type="date" class="form-control" id="fecha_nacimiento_empleados" name="fecha_nacimiento_empleados" max="<?php echo date('Y-m-d'); ?>" value="<?php echo $resEdit->fecha_nacimiento_empleados; ?>" placeholder="fecha nacimiento..">
                                                          <div id="mensaje_fecha_nacimiento_empleados" class="errores"></div>
                                </div>
                        		</div>
                                
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_sexo" class="control-label">Género:</label>
                                                          <select name="id_sexo" id="id_sexo"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultSexo as $res) {?>
                        										<option value="<?php echo $res->id_sexo; ?>" <?php if ($res->id_sexo == $resEdit->id_sexo )  echo  ' selected="selected" '  ;  ?>><?php echo $res->nombre_sexo; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_sexo" class="errores"></div>
                                </div>
                    		    </div>       		    
                    		   
                    		   
                    		   
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_estado_civil" class="control-label">Estado Civil:</label>
                                                          <select name="id_estado_civil" id="id_estado_civil"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultEstCiv as $res) {?>
                        										<option value="<?php echo $res->id_estado_civil; ?>" <?php if ($res->id_estado_civil == $resEdit->id_estado_civil )  echo  ' selected="selected" '  ;  ?>><?php echo $res->nombre_estado_civil; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_estado_civil" class="errores"></div>
                                </div>
                    		    </div>   
                    		    
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="numero_hijos_empleados" class="control-label">Cargas Familiares:</label>
                                                          <select name="numero_hijos_empleados" id="numero_hijos_empleados"  class="form-control" >
                                                          <option value="" selected="selected">--Seleccione--</option>
                        								  <option value="0" <?php  if ( $resEdit->numero_hijos_empleados =='0')  echo ' selected="selected" ' ; ?>>0</option>
                        								  <option value="1" <?php  if ( $resEdit->numero_hijos_empleados =='1')  echo ' selected="selected" ' ; ?>>1</option>
                        								  <option value="2" <?php  if ( $resEdit->numero_hijos_empleados =='2')  echo ' selected="selected" ' ; ?>>2</option>
                        								  <option value="3" <?php  if ( $resEdit->numero_hijos_empleados =='3')  echo ' selected="selected" ' ; ?>>3</option>
                        								  <option value="4" <?php  if ( $resEdit->numero_hijos_empleados =='4')  echo ' selected="selected" ' ; ?>>4</option>
                        								  <option value="5" <?php  if ( $resEdit->numero_hijos_empleados =='5')  echo ' selected="selected" ' ; ?>>5</option>
                        								  <option value="6" <?php  if ( $resEdit->numero_hijos_empleados =='6')  echo ' selected="selected" ' ; ?>>6</option>
                        								  <option value="7" <?php  if ( $resEdit->numero_hijos_empleados =='7')  echo ' selected="selected" ' ; ?>>7</option>
                        								  <option value="8" <?php  if ( $resEdit->numero_hijos_empleados =='8')  echo ' selected="selected" ' ; ?>>8</option>
                        								  </select> 
                                                          <div id="mensaje_numero_hijos_empleados" class="errores"></div>
                                </div>
                    		    </div>  
                    		    
                    		    
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
                                                          <label for="fecha_empieza_a_laborar" class="control-label">Fecha Ini Labor:</label>
                                                          <input type="date" class="form-control" id="fecha_empieza_a_laborar" name="fecha_empieza_a_laborar" min="<?php echo date('Y-m-d', mktime(0,0,0, date('m'), date("d", mktime(0,0,0, date('m'), 1, date('Y'))), date('Y'))); ?>" max="<?php echo date('Y-m-d'); ?>" value="<?php echo $resEdit->fecha_empieza_a_laborar; ?>" placeholder="fecha labora..">
                                                          <div id="mensaje_fecha_empieza_a_laborar" class="errores"></div>
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
                        										<option value="<?php echo $res->id_cantones; ?>"  <?php if ($res->id_cantones == $resEdit->id_cantones )  echo  ' selected="selected" '  ;  ?>><?php echo $res->nombre_cantones; ?> </option>
                        							        <?php } ?>
                                                          </select> 
                                                          <div id="mensaje_id_cantones" class="errores"></div>
                                </div>
                    		    </div>
                    
                    
                    	
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
            
                    	           	
                
                    		    <div class="col-lg-4 col-xs-12 col-md-4">
                    		    <div class="form-group">
                                                      <label for="direccion_empleados" class="control-label">Barrio y/o sector:</label>
                                                      <input type="text" class="form-control" id="direccion_empleados" name="direccion_empleados" value="<?php echo $resEdit->direccion_empleados; ?>" placeholder="nombre barrio..">
                                                      <div id="mensaje_direccion_empleados" class="errores"></div>
                                </div>
                                </div>
                                
                               
                                
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
                    		       	
                    	           	
                    	           	
                    	           	
                    	           	
                    	           	
                    	        <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Actualizar</i></button>
                                					  <a href="index.php?controller=Empleados&action=index" class="btn btn-primary" ><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
				  		
                                </div>
                    		    </div>
                    		    </div>
                    	           	
                    
                 
                               
                    		  
                                
                    	   <?php } } else {?>
                    		    
                 				   
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
                                                      <label for="identificacion_empleados" class="control-label">Identificación:</label>
                                                      <input type="hidden" class="form-control" id="id_empleados" name="id_empleados" value="0" >
                                                      <input type="number" class="form-control" id="identificacion_empleados" name="identificacion_empleados" value=""  placeholder="identificación..">
                                                      <div id="mensaje_identificacion_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                   <div class="col-lg-2 col-xs-12 col-md-2">
                        		   <div class="form-group">
                                                      <label for="apellidos_empleados" class="control-label">Apellidos:</label>
                                                      <input type="text" class="form-control" id="apellidos_empleados" name="apellidos_empleados" value=""  placeholder="apellidos..">
                                                      <div id="mensaje_apellidos_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                   <div class="col-lg-2 col-xs-12 col-md-2">
                        		   <div class="form-group">
                                                      <label for="nombres_empleados" class="control-label">Nombres:</label>
                                                      <input type="text" class="form-control" id="nombres_empleados" name="nombres_empleados" value=""  placeholder="nombres..">
                                                      <div id="mensaje_nombres_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                   
                                   
                                       
                    		       <div class="col-lg-2 col-xs-12 col-md-2">
                            		<div class="form-group">
                                                              <label for="telefono_empleados" class="control-label">Teléfono:</label>
                                                              <input type="number" class="form-control" id="telefono_empleados" name="telefono_empleados" value=""  placeholder="teléfono..">
                                                              <div id="mensaje_telefono_empleados" class="errores"></div>
                                    </div>
                            	   </div>
                               
                               
 								    <div class="col-lg-2 col-xs-12 col-md-2">
                                    <div class="form-group">
                                                                  <label for="celular_empleados" class="control-label">Celular:</label>
                                                                  <input type="number" class="form-control" id="celular_empleados" name="celular_empleados" value=""  placeholder="celular..">
                                                                  <div id="mensaje_celular_empleados" class="errores"></div>
                                    </div>
                                    </div>
                        		                                  
              		   
                    	      
             
                    		   
                        	    <div class="col-lg-2 col-xs-12 col-md-2">
                        		<div class="form-group">
                                                          <label for="correo_empleados" class="control-label">Correo:</label>
                                                          <input type="email" class="form-control" id="correo_empleados" name="correo_empleados" value="" placeholder="email..">
                                                          <div id="mensaje_correo_empleados" class="errores"></div>
                                </div>
                        		</div>
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                        		<div class="form-group">
                                                          <label for="fecha_nacimiento_empleados" class="control-label">Fecha Nac:</label>
                                                          <input type="date" class="form-control" id="fecha_nacimiento_empleados" name="fecha_nacimiento_empleados" max="<?php echo date('Y-m-d'); ?>" value="" placeholder="fecha nacimiento..">
                                                          <div id="mensaje_fecha_nacimiento_empleados" class="errores"></div>
                                </div>
                        		</div>
                                
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_sexo" class="control-label">Género:</label>
                                                          <select name="id_sexo" id="id_sexo"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultSexo as $res) {?>
                        										<option value="<?php echo $res->id_sexo; ?>"><?php echo $res->nombre_sexo; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_sexo" class="errores"></div>
                                </div>
                    		    </div>       		    
                    		   
                    		   
                    		   
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_estado_civil" class="control-label">Estado Civil:</label>
                                                          <select name="id_estado_civil" id="id_estado_civil"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultEstCiv as $res) {?>
                        										<option value="<?php echo $res->id_estado_civil; ?>"><?php echo $res->nombre_estado_civil; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_estado_civil" class="errores"></div>
                                </div>
                    		    </div>   
                    		    
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="numero_hijos_empleados" class="control-label">Cargas Familiares:</label>
                                                          <select name="numero_hijos_empleados" id="numero_hijos_empleados"  class="form-control" >
                                                          <option value="" selected="selected">--Seleccione--</option>
                        								  <option value="0">0</option>
                        								  <option value="1">1</option>
                        								  <option value="2">2</option>
                        								  <option value="3">3</option>
                        								  <option value="4">4</option>
                        								  <option value="5">5</option>
                        								  <option value="6">6</option>
                        								  <option value="7">7</option>
                        								  <option value="8">8</option>
                        								  </select> 
                                                          <div id="mensaje_numero_hijos_empleados" class="errores"></div>
                                </div>
                    		    </div>  
                    		    
                    		    
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
                                                          <label for="fecha_empieza_a_laborar" class="control-label">Fecha Ini Labor:</label>
                                                          <input type="date" class="form-control" id="fecha_empieza_a_laborar" name="fecha_empieza_a_laborar" min="<?php echo date('Y-m-d', mktime(0,0,0, date('m'), date("d", mktime(0,0,0, date('m'), 1, date('Y'))), date('Y'))); ?>" max="<?php echo date('Y-m-d'); ?>" value="" placeholder="fecha labora..">
                                                          <div id="mensaje_fecha_empieza_a_laborar" class="errores"></div>
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
            
                    	           	
                
                    		    <div class="col-lg-4 col-xs-12 col-md-4">
                    		    <div class="form-group">
                                                      <label for="direccion_empleados" class="control-label">Barrio y/o sector:</label>
                                                      <input type="text" class="form-control" id="direccion_empleados" name="direccion_empleados" value="" placeholder="nombre barrio..">
                                                      <div id="mensaje_direccion_empleados" class="errores"></div>
                                </div>
                                </div>
                                 
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
              <h3 class="box-title">Listado Empleados</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
            
            
            
            
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activos" data-toggle="tab">Empleados Activos</a></li>
              <li><a href="#inactivos" data-toggle="tab">Empleados Inactivos</a></li>
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
           	               url: 'index.php?controller=Empleados&action=index10&search='+search,
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#empleados_activos_registrados").html(x);
           	               	 $("#tabla_empleados").tablesorter(); 
           	                 $("#load_activos_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#empleados_activos_registrados").html("Ocurrio un error al cargar la informacion de Empleados Activos..."+estado+"    "+error);
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
           	               url: 'index.php?controller=Empleados&action=index11&search='+search,
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#empleados_inactivos_registrados").html(x);
           	               	 $("#tabla_empleados").tablesorter(); 
           	                 $("#load_inactivos_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#empleados_inactivos_registrados").html("Ocurrio un error al cargar la informacion de Empleados Inactivos..."+estado+"    "+error);
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
	             
	            	
	         	   $.post("<?php echo $helper->url("Empleados","devuelveCanton"); ?>", datos, function(resultado) {

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
	             
	            	
	         	   $.post("<?php echo $helper->url("Empleados","devuelveParroquias"); ?>", datos, function(resultado) {

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
		    	$('#identificacion_empleados').val("");
				$('#apellidos_empleados').val("");
				$('#nombres_empleados').val("");
				$('#id_provincias').val("0");
				$('#id_cantones').val("0");
				$('#id_parroquias').val("0");
				$('#direccion_empleados').val("");
				$('#telefono_empleados').val("");
				$('#celular_empleados').val("");
				$('#fecha_nacimiento_empleados').val("");
				$('#correo_empleados').val("");
		        $("#id_empleados").val("0");
		        $("#id_estado").val("0");
		        $("#id_sexo").val("0");
		        $("#id_departamentos").val("0");
		        $("#id_estado_civil").val("0");
		        $("#numero_hijos_empleados").val("");
		        $("#fecha_empieza_a_laborar").val("");

		        
		        
		     
		    }); 
		    }); 
			</script>
        
        
          
        <script>
        

	       	$(document).ready(function(){

                        var id_empleados = $("#id_empleados").val();

                        if(id_empleados>0){}else{
        	       		
						$( "#identificacion_empleados" ).autocomplete({
		      				source: "<?php echo $helper->url("Empleados","AutocompleteCedula"); ?>",
		      				minLength: 1
		    			});
		
						$("#identificacion_empleados").focusout(function(){
		    				$.ajax({
		    					url:'<?php echo $helper->url("Empleados","AutocompleteDevuelveNombres"); ?>',
		    					type:'POST',
		    					dataType:'json',
		    					data:{identificacion_empleados:$('#identificacion_empleados').val()}
		    				}).done(function(respuesta){

		    				    $('#id_tipo_identificacion').val(respuesta.id_tipo_identificacion);
		    					$('#identificacion_empleados').val(respuesta.identificacion_empleados);
		    					$('#apellidos_empleados').val(respuesta.apellidos_empleados);
		    					$('#nombres_empleados').val(respuesta.nombres_empleados);
		    					$('#id_provincias').val(respuesta.id_provincias);
		    					$('#id_cantones').val(respuesta.id_cantones);
		    					$('#id_parroquias').val(respuesta.id_parroquias);
		    					$('#direccion_empleados').val(respuesta.direccion_empleados);
		    					$('#telefono_empleados').val(respuesta.telefono_empleados);
		    					$('#celular_empleados').val(respuesta.celular_empleados);
		    					$('#correo_empleados').val(respuesta.correo_empleados);
		    			        $("#id_empleados").val(respuesta.id_empleados);
		    			        $("#id_estado").val(respuesta.id_estado);
		    			        $("#id_sexo").val(respuesta.id_sexo);
		    			        $("#id_departamentos").val(respuesta.id_departamentos);
		    			        $("#id_estado_civil").val(respuesta.id_estado_civil);
		    			        $("#numero_hijos_empleados").val(respuesta.numero_hijos_empleados);
		    			        $("#fecha_nacimiento_empleados").val(respuesta.fecha_nacimiento_empleados);
		    			        $("#fecha_empieza_a_laborar").val(respuesta.fecha_empieza_a_laborar);

		    			        
		    					
		    					
		    				
		        			}).fail(function(respuesta) {

		        				
		        				$('#apellidos_empleados').val("");
		        				$('#nombres_empleados').val("");
		        				$('#id_provincias').val("0");
		        				$('#id_cantones').val("0");
		        				$('#id_parroquias').val("0");
		        				$('#direccion_empleados').val("");
		        				$('#telefono_empleados').val("");
		        				$('#celular_empleados').val("");
		        				$('#correo_empleados').val("");
		        		        $("#id_empleados").val("0");
		        		        $("#id_estado").val("0");
		        		        $("#id_sexo").val("0");
		        		        $("#id_departamentos").val("0");
		        		        $("#id_estado_civil").val("0");
		        		        $("#numero_hijos_empleados").val("");
		        		        $("#fecha_nacimiento_empleados").val("");
		        		        $("#fecha_empieza_a_laborar").val("");

		        		        
		    					
		        			    
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


		    	var id_tipo_identificacion = $("#id_tipo_identificacion").val();
		    	var identificacion_empleados  =  $('#identificacion_empleados').val();
		    	var apellidos_empleados  =  $('#apellidos_empleados').val();
		    	var nombres_empleados  =  $('#nombres_empleados').val();
		    	var id_provincias  =  $('#id_provincias').val();
		    	var id_cantones  =  $('#id_cantones').val();
		    	var id_parroquias  =  $('#id_parroquias').val();
		    	var direccion_empleados  =  $('#direccion_empleados').val();
		    	var telefono_empleados  =  $('#telefono_empleados').val();
		    	var celular_empleados  =  $('#celular_empleados').val();
		    	var correo_empleados  =  $('#correo_empleados').val();
		    	var fecha_nacimiento_empleados  =  $('#fecha_nacimiento_empleados').val();
		    	var id_empleados  =  $("#id_empleados").val();
		    	var id_estado  =  $("#id_estado").val();
		    	var id_sexo  =  $("#id_sexo").val();
		    	var id_departamentos  =  $("#id_departamentos").val();
		    	var id_estado_civil  =  $("#id_estado_civil").val();
		    	var numero_hijos_empleados  =  $("#numero_hijos_empleados").val();
				var fecha_empieza_a_laborar =  $("#fecha_empieza_a_laborar").val();
 	
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


		        for (i=0; i<identificacion_empleados.length && ok==1 ; i++){
		            var n = parseInt(identificacion_empleados.charAt(i));
		            if (isNaN(n)) ok=0;
		         }


		        /* Los primeros dos digitos corresponden al codigo de la provincia */
		        provincia = identificacion_empleados.substr(0,2);


		        /* Aqui almacenamos los digitos de la cedula en variables. */
		        d1  = identificacion_empleados.substr(0,1);         
		        d2  = identificacion_empleados.substr(1,1);         
		        d3  = identificacion_empleados.substr(2,1);         
		        d4  = identificacion_empleados.substr(3,1);         
		        d5  = identificacion_empleados.substr(4,1);         
		        d6  = identificacion_empleados.substr(5,1);         
		        d7  = identificacion_empleados.substr(6,1);         
		        d8  = identificacion_empleados.substr(7,1);         
		        d9  = identificacion_empleados.substr(8,1);         
		        d10 = identificacion_empleados.substr(9,1);                
		           
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


		    	 
		    	
		    	if (identificacion_empleados == "")
		    	{
			    	
		    		$("#mensaje_identificacion_empleados").text("Ingrese Identificación");
		    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error

		    		$("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
			        return false;
			    }
		    	else 
		    	{


					if(id_tipo_identificacion==1){


						 if (ok==0){
							 $("#mensaje_identificacion_empleados").text("Ingrese solo números");
					    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
					           
					            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
					            return false;
					      }else{

								$("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
						
						  }
						
						
						if(identificacion_empleados.length==10){

							$("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
						}else{
							
							$("#mensaje_identificacion_empleados").text("Ingrese 10 Digitos");
				    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
				            return false;
						}



						if (provincia < 1 || provincia > numeroProvincias){           
							$("#mensaje_identificacion_empleados").text("El código de la provincia (dos primeros dígitos) es inválido");
				    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
				            return false;

					      }else{

					    		$("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
								
						  }



						if (d3==7 || d3==8){           

							$("#mensaje_identificacion_empleados").text("El tercer dígito ingresado es inválido");
				    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
				            return false;
					      }
						else{

							$("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
							
							}



						if(nat == true){         
					         if (digitoVerificador != d10){    

					        	 $("#mensaje_identificacion_empleados").text("El número de cédula de la persona natural es incorrecto.");
						    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
						           
						            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
						            return false;
						       
					         }else{

						        	 $("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
						     }  

					     }else{

					    	 $("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
							   
						 }
						
					}else{



						 if (ok==0){
							 $("#mensaje_identificacion_empleados").text("Ingrese solo números");
					    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
					           
					            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
					            return false;
					      }else{

								$("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
						
						  }

						

						if(identificacion_empleados.length >=13){

							$("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
						}else{
							
							$("#mensaje_identificacion_empleados").text("Ingrese 13 Digitos");
				    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
				            return false;
						}



						if (provincia < 1 || provincia > numeroProvincias){           
							$("#mensaje_identificacion_empleados").text("El código de la provincia (dos primeros dígitos) es inválido");
				    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
				            return false;

					      }else{

					    		$("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
								
						  }



						if (d3==7 || d3==8){           

							$("#mensaje_identificacion_empleados").text("El tercer dígito ingresado es inválido");
				    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
				            return false;
					      }
						else{

							$("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
							
							}


						  if (pub==true){      


						         /* El ruc de las empresas del sector publico terminan con 0001*/         
					         if (identificacion_empleados.substr(9,4) != '0001' ){                    

					        	 $("#mensaje_identificacion_empleados").text("El ruc de la empresa del sector público debe terminar con 0001");
						    	 $("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
						           
						            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
						            return false;

						     }else{
						    	 $("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
							}
							       
						         if (digitoVerificador != d9){                          
										$("#mensaje_identificacion_empleados").text("El ruc de la empresa del sector público es incorrecto.");
							    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
							           
							            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
							            return false;
							           
						         } else{
						        	 $("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
										
							     }                 

						 }else{
				        	 $("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
								
					     }  

					               

					       if(pri == true){    
					    	   if ( identificacion_empleados.substr(10,3) != '001' ){   

					    		   $("#mensaje_identificacion_empleados").text("El ruc de la empresa del sector privado debe terminar con 001");
						    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
						           
						            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
						            return false;
						                             
						            
						         }else{
						        	 $("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
										
							         }
						              
						         if (digitoVerificador != d10){                          

						        	 $("#mensaje_identificacion_empleados").text("El ruc de la empresa del sector privado es incorrecto");
							    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
							           
							            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
							            return false;

							     } else{
						        	 $("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
										
						         }        
						         
						      } else{
						        	 $("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
										
							     }  


						if(nat == true){         

							if (identificacion_empleados.length >10 && identificacion_empleados.substr(10,3) != '001' ){                    
					         
					            $("#mensaje_identificacion_empleados").text("El ruc de la persona natural debe terminar con 001.");
					    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
					           
					            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
					            return false;
					            
					         }else{
					        	 if(identificacion_empleados.length >13){
					        		 $("#mensaje_identificacion_empleados").text("El ruc de la persona natural es incorrecto.");
							    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
							           
							            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
							            return false;

						        	 }else{
						         
					        	 $("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
						        	 }	

						         }

							
					         if (digitoVerificador != d10){    

					        	 $("#mensaje_identificacion_empleados").text("El ruc de la persona natural es incorrecto.");
						    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
						           
						            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
						            return false;
						       
					         }else{

						        	 $("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
						     }  

					     }else{

					    	 $("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
							   
						 }

					}
    
				}    


		    	if (apellidos_empleados == "")
		    	{
			    	
		    		$("#mensaje_apellidos_empleados").text("Introduzca Apellidos");
		    		$("#mensaje_apellidos_empleados").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_apellidos_empleados).offset().top-120 }, tiempo);
			        
			            return false;
			    }
		    	else 
		    	{

		    		contador=0;
		    		numeroPalabras=0;
		    		contador = apellidos_empleados.split(" ");
		    		numeroPalabras = contador.length;
		    		
					if(numeroPalabras==2){

						$("#mensaje_apellidos_empleados").fadeOut("slow"); //Muestra mensaje de error
				                     
			             
					}else{
						$("#mensaje_apellidos_empleados").text("Introduzca 2 Apellidos");
			    		$("#mensaje_apellidos_empleados").fadeIn("slow"); //Muestra mensaje de error
			           
			            $("html, body").animate({ scrollTop: $(mensaje_apellidos_empleados).offset().top-120 }, tiempo);
			            return false;
					}
			    	
				}



		    	if (nombres_empleados == "")
		    	{
			    	
		    		$("#mensaje_nombres_empleados").text("Introduzca Nombres");
		    		$("#mensaje_nombres_empleados").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_nombres_empleados).offset().top-120 }, tiempo);
			        
			            return false;
			    }
		    	else 
		    	{

		    		contador=0;
		    		numeroPalabras=0;
		    		contador = nombres_empleados.split(" ");
		    		numeroPalabras = contador.length;
		    		
					if(numeroPalabras==2){

						$("#mensaje_nombres_empleados").fadeOut("slow"); //Muestra mensaje de error
				                     
			             
					}else{
						$("#mensaje_nombres_empleados").text("Introduzca 2 Nombres");
			    		$("#mensaje_nombres_empleados").fadeIn("slow"); //Muestra mensaje de error
			           
			            $("html, body").animate({ scrollTop: $(mensaje_nombres_empleados).offset().top-120 }, tiempo);
			            return false;
					}
			    	
				}


		    	
						    			    	
		    	if (celular_empleados == "" )
		    	{
			    	
		    		$("#mensaje_celular_empleados").text("Ingrese # Celular");
		    		$("#mensaje_celular_empleados").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_celular_empleados).offset().top-120 }, tiempo);
					
			            return false;
			    }
		    	else 
		    	{


		    		if(celular_empleados.length==10){

						$("#mensaje_celular_empleados").fadeOut("slow"); //Muestra mensaje de error
					}else{
						
						$("#mensaje_celular_empleados").text("Ingrese 10 dígitos");
			    		$("#mensaje_celular_empleados").fadeIn("slow"); //Muestra mensaje de error
			           
			            $("html, body").animate({ scrollTop: $(mensaje_celular_empleados).offset().top-120 }, tiempo);
			            return false;
					}

			    	
		    		
				}

				// correos
				
		    	if (correo_empleados == "")
		    	{
			    	
		    		$("#mensaje_correo_empleados").text("Introduzca un correo");
		    		$("#mensaje_correo_empleados").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_correo_empleados).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else if (regex.test($('#correo_empleados').val().trim()))
		    	{
		    		$("#mensaje_correo_empleados").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	else 
		    	{
		    		$("#mensaje_correo_empleados").text("Introduzca un correo válido");
		    		$("#mensaje_correo_empleados").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_correo_empleados).offset().top-120 }, tiempo);
					
			            return false;	
			    }


		    	if (fecha_nacimiento_empleados == "" )
		    	{
			    	
		    		$("#mensaje_fecha_nacimiento_empleados").text("Seleccione Fecha Nac");
		    		$("#mensaje_fecha_nacimiento_empleados").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_fecha_nacimiento_empleados).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_fecha_nacimiento_empleados").fadeOut("slow"); //Muestra mensaje de error
		            
				}


		    	if (id_sexo == 0 )
		    	{
			    	
		    		$("#mensaje_id_sexo").text("Seleccione");
		    		$("#mensaje_id_sexo").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_sexo).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_sexo").fadeOut("slow"); //Muestra mensaje de error
		            
				}


		    	if (id_estado_civil == 0 )
		    	{
			    	
		    		$("#mensaje_id_estado_civil").text("Seleccione");
		    		$("#mensaje_id_estado_civil").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_estado_civil).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_estado_civil").fadeOut("slow"); //Muestra mensaje de error
		            
				}



		    	if (numero_hijos_empleados == "" )
		    	{
			    	
		    		$("#mensaje_numero_hijos_empleados").text("Seleccione");
		    		$("#mensaje_numero_hijos_empleados").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_numero_hijos_empleados).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_numero_hijos_empleados").fadeOut("slow"); //Muestra mensaje de error
		            
				}



		    	if (id_departamentos == 0 )
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

		    	
		    	if (fecha_empieza_a_laborar == "" )
		    	{
			    	
		    		$("#mensaje_fecha_empieza_a_laborar").text("Seleccione");
		    		$("#mensaje_fecha_empieza_a_laborar").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_fecha_empieza_a_laborar).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_fecha_empieza_a_laborar").fadeOut("slow"); //Muestra mensaje de error
		            
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

		    	if (direccion_empleados == "" )
		    	{
			    	
		    		$("#mensaje_direccion_empleados").text("Ingrese Barrio");
		    		$("#mensaje_direccion_empleados").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_direccion_empleados).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_direccion_empleados").fadeOut("slow"); //Muestra mensaje de error
		            
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
		        $( "#identificacion_empleados" ).focus(function() {
					  $("#mensaje_identificacion_empleados").fadeOut("slow");
				 });
		        $( "#apellidos_empleados" ).focus(function() {
					  $("#mensaje_apellidos_empleados").fadeOut("slow");
				 });
		        $( "#nombres_empleados" ).focus(function() {
					  $("#mensaje_nombres_empleados").fadeOut("slow");
				 });
		       
		        $( "#celular_empleados" ).focus(function() {
					  $("#mensaje_celular_empleados").fadeOut("slow");
				 });  

		        $( "#correo_empleados" ).focus(function() {
					  $("#mensaje_correo_empleados").fadeOut("slow");
				 });  

			     $( "#fecha_nacimiento_empleados" ).focus(function() {
					  $("#mensaje_fecha_nacimiento_empleados").fadeOut("slow");
				 });  


			     $( "#id_sexo" ).focus(function() {
					  $("#mensaje_id_sexo").fadeOut("slow");
				 }); 
				 $( "#id_departamentos" ).focus(function() {
					  $("#mensaje_id_departamentos").fadeOut("slow");
				 }); 

				 $( "#fecha_empieza_a_laborar" ).focus(function() {
					  $("#mensaje_fecha_empieza_a_laborar").fadeOut("slow");
				 }); 
				 
				 
				 $( "#id_estado_civil" ).focus(function() {
					  $("#mensaje_id_estado_civil").fadeOut("slow");
				 }); 
				 $( "#numero_hijos_empleados" ).focus(function() {
					  $("#mensaje_numero_hijos_empleados").fadeOut("slow");
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

		        $( "#direccion_empleados" ).focus(function() {
					  $("#mensaje_direccion_empleados").fadeOut("slow");
				 });

		        $( "#id_estado" ).focus(function() {
					  $("#mensaje_id_estado").fadeOut("slow");
				 });
		}); 

	</script>
        
      
   
	
  </body>
</html>   