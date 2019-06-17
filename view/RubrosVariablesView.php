<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rubros Variables - Milenio</title>
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
                <li class="active">Rubros Variables</li>
            </ol>
        </section>
        
        <!-- comienza diseño controles usuario -->
        
        
                
        
        <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Rubros Extras Empleados</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">


            <form  action="<?php echo $helper->url("RubrosVariables","InsertaRubrosVariables"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
                               
                          
                    	   <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
       
                    	        <div class="col-lg-2 col-xs-12 col-md-2">
                        		   <div class="form-group">
                                                      <label for="identificacion_empleados" class="control-label">Identificación:</label>
                                                      <input type="hidden" class="form-control" id="id_empleados" name="id_empleados" value="<?php echo $resEdit->id_empleados; ?>" >
                                                      <input type="hidden" class="form-control" id="id_rubros_variables_empleados" name="id_rubros_variables_empleados" value="<?php echo $resEdit->id_rubros_variables_empleados; ?>">
                                                      
                                                      
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
                        										<option value="<?php echo $res->id_departamentos; ?>" <?php if ($res->id_departamentos == $resEdit->id_departamentos )  echo  ' selected="selected" '  ;  ?>><?php echo $res->nombre_departamentos; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_departamentos" class="errores"></div>
                                </div>
                    		    </div>
                    		    
                    		    
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_cargos_departamentos" class="control-label">Cargo:</label>
                                                          <select name="id_cargos_departamentos" id="id_cargos_departamentos"  class="form-control" disabled>
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultCar as $res) {?>
                        										<option value="<?php echo $res->id_cargos_departamentos; ?>" <?php if ($res->id_cargos_departamentos == $resEdit->id_cargos_departamentos )  echo  ' selected="selected" '  ;  ?>><?php echo $res->nombre_cargo_departamentos; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_cargos_departamentos" class="errores"></div>
                                </div>
                    		    </div>
                    		    
	                    	
					             <div class="col-md-2 col-lg-2 col-xs-12">
					             <div class="form-group">
							     					   <label for="valor_sueldo_cargo_departamentos" class="control-label">Salario:</label>
							        				   <input type="text" class="form-control cantidades1" id="valor_sueldo_cargo_departamentos" name="valor_sueldo_cargo_departamentos" value='<?php echo $resEdit->valor_sueldo_cargo_departamentos; ?>' 
                                                       data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" readonly>
                                 		        	   <div id="mensaje_valor_sueldo_cargo_departamentos" class="errores"></div>
					             </div>
					             </div>
                    	
                    	        
                    	        
                    	        <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_tipo_rubros" class="control-label">Tipo Rubro:</label>
                                                          <select name="id_tipo_rubros" id="id_tipo_rubros"  class="form-control">
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultTipRub as $res) {?>
                        										<option value="<?php echo $res->id_tipo_rubros; ?>" <?php if ($res->id_tipo_rubros == $resEdit->id_tipo_rubros )  echo  ' selected="selected" '  ;  ?>><?php echo $res->nombre_tipo_rubros; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_tipo_rubros" class="errores"></div>
                                </div>
                    		    </div>
                    		    
                    	    
                    	    
	                    	    <div id="div_datos_bono" style="display: none;">
	                    	     <div class="col-md-2 col-lg-2 col-xs-12">
					             <div class="form-group">
							     					   <label for="valor_rubros_variables_empleados" class="control-label">Valor:</label>
							        				   <input type="text" class="form-control cantidades1" id="valor_rubros_variables_empleados" name="valor_rubros_variables_empleados" value='<?php echo $resEdit->valor_rubros_variables_empleados; ?>' 
                                                       data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false">
                                 		        	   <div id="mensaje_valor_rubros_variables_empleados" class="errores"></div>
					             </div>
					             </div>
	                    	    </div>
	                    	    
	                    	    
	                    	    <div id="div_datos_horas_extras" style="display: none;">
	                    	    
	                    	    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="numero_horas_extras_50_porciento" class="control-label">Número Horas 50%:</label>
                                                          <select name="numero_horas_extras_50_porciento" id="numero_horas_extras_50_porciento"  class="form-control">
                                                          <option value="0" selected="selected">--Seleccione--</option>
                                                          <option value="1" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='1')  echo ' selected="selected" ' ; ?>>1</option>
                                                          <option value="2" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='2')  echo ' selected="selected" ' ; ?>>2</option>
                                                          <option value="3" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='3')  echo ' selected="selected" ' ; ?>>3</option>
                                                          <option value="4" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='4')  echo ' selected="selected" ' ; ?>>4</option>
                                                          <option value="5" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='5')  echo ' selected="selected" ' ; ?>>5</option>
                                                          <option value="6" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='6')  echo ' selected="selected" ' ; ?>>6</option>
                                                          <option value="7" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='7')  echo ' selected="selected" ' ; ?>>7</option>
                                                          <option value="8" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='8')  echo ' selected="selected" ' ; ?>>8</option>
                                                          <option value="9" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='9')  echo ' selected="selected" ' ; ?>>9</option>
                                                          <option value="10" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='10')  echo ' selected="selected" ' ; ?>>10</option>
                                                          <option value="11" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='11')  echo ' selected="selected" ' ; ?>>11</option>
                                                          <option value="12" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='12')  echo ' selected="selected" ' ; ?>>12</option>
                                                          <option value="13" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='13')  echo ' selected="selected" ' ; ?>>13</option>
                                                          <option value="14" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='14')  echo ' selected="selected" ' ; ?>>14</option>
                                                          <option value="15" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='15')  echo ' selected="selected" ' ; ?>>15</option>
                                                          <option value="16" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='16')  echo ' selected="selected" ' ; ?>>16</option>
                                                          <option value="17" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='17')  echo ' selected="selected" ' ; ?>>17</option>
                                                          <option value="18" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='18')  echo ' selected="selected" ' ; ?>>18</option>
                                                          <option value="19" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='19')  echo ' selected="selected" ' ; ?>>19</option>
                                                          <option value="20" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='20')  echo ' selected="selected" ' ; ?>>20</option>
                                                          <option value="21" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='21')  echo ' selected="selected" ' ; ?>>21</option>
                                                          <option value="22" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='22')  echo ' selected="selected" ' ; ?>>22</option>
                                                          <option value="23" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='23')  echo ' selected="selected" ' ; ?>>23</option>
                                                          <option value="24" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='24')  echo ' selected="selected" ' ; ?>>24</option>
                                                          <option value="25" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='25')  echo ' selected="selected" ' ; ?>>25</option>
                                                          <option value="26" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='26')  echo ' selected="selected" ' ; ?>>26</option>
                                                          <option value="27" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='27')  echo ' selected="selected" ' ; ?>>27</option>
                                                          <option value="28" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='28')  echo ' selected="selected" ' ; ?>>28</option>
                                                          <option value="29" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='29')  echo ' selected="selected" ' ; ?>>29</option>
                                                          <option value="30" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='30')  echo ' selected="selected" ' ; ?>>30</option>
                                                          <option value="31" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='31')  echo ' selected="selected" ' ; ?>>31</option>
                                                          <option value="32" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='32')  echo ' selected="selected" ' ; ?>>32</option>
                                                          <option value="33" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='33')  echo ' selected="selected" ' ; ?>>33</option>
                                                          <option value="34" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='34')  echo ' selected="selected" ' ; ?>>34</option>
                                                          <option value="35" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='35')  echo ' selected="selected" ' ; ?>>35</option>
                                                          <option value="36" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='36')  echo ' selected="selected" ' ; ?>>36</option>
                                                          <option value="37" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='37')  echo ' selected="selected" ' ; ?>>37</option>
                                                          <option value="38" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='38')  echo ' selected="selected" ' ; ?>>38</option>
                                                          <option value="39" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='39')  echo ' selected="selected" ' ; ?>>39</option>
                                                          <option value="40" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='40')  echo ' selected="selected" ' ; ?>>40</option>
                                                          <option value="41" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='41')  echo ' selected="selected" ' ; ?>>41</option>
                                                          <option value="42" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='42')  echo ' selected="selected" ' ; ?>>42</option>
                                                          <option value="43" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='43')  echo ' selected="selected" ' ; ?>>43</option>
                                                          <option value="44" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='44')  echo ' selected="selected" ' ; ?>>44</option>
                                                          <option value="45" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='45')  echo ' selected="selected" ' ; ?>>45</option>
                                                          <option value="46" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='46')  echo ' selected="selected" ' ; ?>>46</option>
                                                          <option value="47" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='47')  echo ' selected="selected" ' ; ?>>47</option>
                                                          <option value="48" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='48')  echo ' selected="selected" ' ; ?>>48</option>
                                                          <option value="49" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='49')  echo ' selected="selected" ' ; ?>>49</option>
                                                          <option value="50" <?php  if ( $resEdit->numero_horas_extras_50_porciento =='50')  echo ' selected="selected" ' ; ?>>50</option>
                        								  </select> 
                                                          <div id="mensaje_numero_horas_extras_50_porciento" class="errores"></div>
                                 </div>
                    		     </div>
	                    	    
	                    	    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="numero_horas_extras_100_porciento" class="control-label">Número Horas 100%:</label>
                                                          <select name="numero_horas_extras_100_porciento" id="numero_horas_extras_100_porciento"  class="form-control">
                                                          <option value="0" selected="selected">--Seleccione--</option>
                                                          <option value="1" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='1')  echo ' selected="selected" ' ; ?>>1</option>
                                                          <option value="2" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='2')  echo ' selected="selected" ' ; ?>>2</option>
                                                          <option value="3" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='3')  echo ' selected="selected" ' ; ?>>3</option>
                                                          <option value="4" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='4')  echo ' selected="selected" ' ; ?>>4</option>
                                                          <option value="5" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='5')  echo ' selected="selected" ' ; ?>>5</option>
                                                          <option value="6" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='6')  echo ' selected="selected" ' ; ?>>6</option>
                                                          <option value="7" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='7')  echo ' selected="selected" ' ; ?>>7</option>
                                                          <option value="8" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='8')  echo ' selected="selected" ' ; ?>>8</option>
                                                          <option value="9" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='9')  echo ' selected="selected" ' ; ?>>9</option>
                                                          <option value="10" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='10')  echo ' selected="selected" ' ; ?>>10</option>
                                                          <option value="11" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='11')  echo ' selected="selected" ' ; ?>>11</option>
                                                          <option value="12" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='12')  echo ' selected="selected" ' ; ?>>12</option>
                                                          <option value="13" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='13')  echo ' selected="selected" ' ; ?>>13</option>
                                                          <option value="14" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='14')  echo ' selected="selected" ' ; ?>>14</option>
                                                          <option value="15" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='15')  echo ' selected="selected" ' ; ?>>15</option>
                                                          <option value="16" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='16')  echo ' selected="selected" ' ; ?>>16</option>
                                                          <option value="17" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='17')  echo ' selected="selected" ' ; ?>>17</option>
                                                          <option value="18" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='18')  echo ' selected="selected" ' ; ?>>18</option>
                                                          <option value="19" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='19')  echo ' selected="selected" ' ; ?>>19</option>
                                                          <option value="20" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='20')  echo ' selected="selected" ' ; ?>>20</option>
                                                          <option value="21" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='21')  echo ' selected="selected" ' ; ?>>21</option>
                                                          <option value="22" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='22')  echo ' selected="selected" ' ; ?>>22</option>
                                                          <option value="23" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='23')  echo ' selected="selected" ' ; ?>>23</option>
                                                          <option value="24" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='24')  echo ' selected="selected" ' ; ?>>24</option>
                                                          <option value="25" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='25')  echo ' selected="selected" ' ; ?>>25</option>
                                                          <option value="26" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='26')  echo ' selected="selected" ' ; ?>>26</option>
                                                          <option value="27" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='27')  echo ' selected="selected" ' ; ?>>27</option>
                                                          <option value="28" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='28')  echo ' selected="selected" ' ; ?>>28</option>
                                                          <option value="29" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='29')  echo ' selected="selected" ' ; ?>>29</option>
                                                          <option value="30" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='30')  echo ' selected="selected" ' ; ?>>30</option>
                                                          <option value="31" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='31')  echo ' selected="selected" ' ; ?>>31</option>
                                                          <option value="32" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='32')  echo ' selected="selected" ' ; ?>>32</option>
                                                          <option value="33" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='33')  echo ' selected="selected" ' ; ?>>33</option>
                                                          <option value="34" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='34')  echo ' selected="selected" ' ; ?>>34</option>
                                                          <option value="35" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='35')  echo ' selected="selected" ' ; ?>>35</option>
                                                          <option value="36" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='36')  echo ' selected="selected" ' ; ?>>36</option>
                                                          <option value="37" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='37')  echo ' selected="selected" ' ; ?>>37</option>
                                                          <option value="38" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='38')  echo ' selected="selected" ' ; ?>>38</option>
                                                          <option value="39" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='39')  echo ' selected="selected" ' ; ?>>39</option>
                                                          <option value="40" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='40')  echo ' selected="selected" ' ; ?>>40</option>
                                                          <option value="41" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='41')  echo ' selected="selected" ' ; ?>>41</option>
                                                          <option value="42" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='42')  echo ' selected="selected" ' ; ?>>42</option>
                                                          <option value="43" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='43')  echo ' selected="selected" ' ; ?>>43</option>
                                                          <option value="44" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='44')  echo ' selected="selected" ' ; ?>>44</option>
                                                          <option value="45" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='45')  echo ' selected="selected" ' ; ?>>45</option>
                                                          <option value="46" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='46')  echo ' selected="selected" ' ; ?>>46</option>
                                                          <option value="47" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='47')  echo ' selected="selected" ' ; ?>>47</option>
                                                          <option value="48" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='48')  echo ' selected="selected" ' ; ?>>48</option>
                                                          <option value="49" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='49')  echo ' selected="selected" ' ; ?>>49</option>
                                                          <option value="50" <?php  if ( $resEdit->numero_horas_extras_100_porciento =='50')  echo ' selected="selected" ' ; ?>>50</option>
                        								  </select> 
                                                          <div id="mensaje_numero_horas_extras_100_porciento" class="errores"></div>
                                 </div>
                    		     </div>
	                    	    
	                    	    </div>
                    	    
                    	    
                    	        <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="mes_afectacion" class="control-label">Mes afectación:</label>
                                                          <input type="hidden" class="form-control" id="mes_afectacion_verificacion" name="mes_afectacion_verificacion" value="" >
                                                          
                                                          <select name="mes_afectacion" id="mes_afectacion"  class="form-control">
                                                          <option value="0" selected="selected">--Seleccione--</option>
                                                          <option value="1" <?php  if ( $resEdit->mes_afectacion =='1')  echo ' selected="selected" ' ; ?>>Enero</option>
                                                          <option value="2" <?php  if ( $resEdit->mes_afectacion =='2')  echo ' selected="selected" ' ; ?>>Febrero</option>
                                                          <option value="3" <?php  if ( $resEdit->mes_afectacion =='3')  echo ' selected="selected" ' ; ?>>Marzo</option>
                                                          <option value="4" <?php  if ( $resEdit->mes_afectacion =='4')  echo ' selected="selected" ' ; ?>>Abril</option>
                                                          <option value="5" <?php  if ( $resEdit->mes_afectacion =='5')  echo ' selected="selected" ' ; ?>>Mayo</option>
                                                          <option value="6" <?php  if ( $resEdit->mes_afectacion =='6')  echo ' selected="selected" ' ; ?>>Junio</option>
                                                          <option value="7" <?php  if ( $resEdit->mes_afectacion =='7')  echo ' selected="selected" ' ; ?>>Julio</option>
                                                          <option value="8" <?php  if ( $resEdit->mes_afectacion =='8')  echo ' selected="selected" ' ; ?>>Agosto</option>
                                                          <option value="9" <?php  if ( $resEdit->mes_afectacion =='9')  echo ' selected="selected" ' ; ?>>Septiembre</option>
                                                          <option value="10" <?php  if ( $resEdit->mes_afectacion =='10')  echo ' selected="selected" ' ; ?>>Octubre</option>
                                                          <option value="11" <?php  if ( $resEdit->mes_afectacion =='11')  echo ' selected="selected" ' ; ?>>Noviembre</option>
                                                          <option value="12" <?php  if ( $resEdit->mes_afectacion =='12')  echo ' selected="selected" ' ; ?>>Diciembre</option>
                        								  </select> 
                                                          <div id="mensaje_mes_afectacion" class="errores"></div>
                                 </div>
                    		     </div>
                    	
                    	
                    	        <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="anio_afectacion" class="control-label">Año afectación:</label>
                                                          <select name="anio_afectacion" id="anio_afectacion"  class="form-control">
                                                          <option value="0" selected="selected">--Seleccione--</option>
                                                          <option value="2019" <?php  if ( $resEdit->anio_afectacion =='2019')  echo ' selected="selected" ' ; ?>>2019</option>
                                                          </select> 
                                                          <div id="mensaje_anio_afectacion" class="errores"></div>
                                 </div>
                    		     </div>
        
                    	
                    	           	
                    	        <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Actualizar</i></button>
                                					  <a href="index.php?controller=RubrosVariables&action=index" class="btn btn-primary" ><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
				  		
                                </div>
                    		    </div>
                    		    </div>
                                   
                    	       
                    	       
                    	       
                    	        <?php }} else{ ?>	    
                    	        
                    	           <div class="col-lg-2 col-xs-12 col-md-2">
                        		   <div class="form-group">
                                                      <label for="identificacion_empleados" class="control-label">Identificación:</label>
                                                      <input type="hidden" class="form-control" id="id_empleados" name="id_empleados" value="0" >
                                                      <input type="hidden" class="form-control" id="id_rubros_variables_empleados" name="id_rubros_variables_empleados" value="0" >
                                                      
                                                      
                                                      <input type="number" class="form-control" id="identificacion_empleados" name="identificacion_empleados" value=""  placeholder="identificación..">
                                                      <div id="mensaje_identificacion_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                   <div class="col-lg-2 col-xs-12 col-md-2">
                        		   <div class="form-group">
                                                      <label for="apellidos_empleados" class="control-label">Apellidos:</label>
                                                      <input type="text" class="form-control" id="apellidos_empleados" name="apellidos_empleados" value=""  placeholder="apellidos.." readonly>
                                                      <div id="mensaje_apellidos_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                   <div class="col-lg-2 col-xs-12 col-md-2">
                        		   <div class="form-group">
                                                      <label for="nombres_empleados" class="control-label">Nombres:</label>
                                                      <input type="text" class="form-control" id="nombres_empleados" name="nombres_empleados" value=""  placeholder="nombres.." readonly>
                                                      <div id="mensaje_nombres_empleados" class="errores"></div>
                                    </div>
                                    </div>
                    	           
                    	        <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_departamentos" class="control-label">Departamentos:</label>
                                                          <select name="id_departamentos" id="id_departamentos"  class="form-control" disabled>
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
                                                          <label for="id_cargos_departamentos" class="control-label">Cargo:</label>
                                                          <select name="id_cargos_departamentos" id="id_cargos_departamentos"  class="form-control" disabled>
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultCar as $res) {?>
                        										<option value="<?php echo $res->id_cargos_departamentos; ?>" ><?php echo $res->nombre_cargo_departamentos; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_cargos_departamentos" class="errores"></div>
                                </div>
                    		    </div>
                    		    
	                    	
					             <div class="col-md-2 col-lg-2 col-xs-12">
					             <div class="form-group">
							     					   <label for="valor_sueldo_cargo_departamentos" class="control-label">Salario:</label>
							        				   <input type="text" class="form-control cantidades1" id="valor_sueldo_cargo_departamentos" name="valor_sueldo_cargo_departamentos" value='0.00' 
                                                       data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" readonly>
                                 		        	   <div id="mensaje_valor_sueldo_cargo_departamentos" class="errores"></div>
					             </div>
					             </div>
                    	
                    	        
                    	        
                    	        <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_tipo_rubros" class="control-label">Tipo Rubro:</label>
                                                          <select name="id_tipo_rubros" id="id_tipo_rubros"  class="form-control">
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultTipRub as $res) {?>
                        										<option value="<?php echo $res->id_tipo_rubros; ?>" ><?php echo $res->nombre_tipo_rubros; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_tipo_rubros" class="errores"></div>
                                </div>
                    		    </div>
                    		    
                    	    
                    	    
	                    	    <div id="div_datos_bono" style="display: none;">
	                    	     <div class="col-md-2 col-lg-2 col-xs-12">
					             <div class="form-group">
							     					   <label for="valor_rubros_variables_empleados" class="control-label">Valor:</label>
							        				   <input type="text" class="form-control cantidades1" id="valor_rubros_variables_empleados" name="valor_rubros_variables_empleados" value='0.00' 
                                                       data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false">
                                 		        	   <div id="mensaje_valor_rubros_variables_empleados" class="errores"></div>
					             </div>
					             </div>
	                    	    </div>
	                    	    
	                    	    
	                    	    <div id="div_datos_horas_extras" style="display: none;">
	                    	    
	                    	    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="numero_horas_extras_50_porciento" class="control-label">Número Horas 50%:</label>
                                                          <select name="numero_horas_extras_50_porciento" id="numero_horas_extras_50_porciento"  class="form-control">
                                                          <option value="0" selected="selected">--Seleccione--</option>
                                                          <option value="1">1</option>
                                                          <option value="2">2</option>
                                                          <option value="3">3</option>
                                                          <option value="4">4</option>
                                                          <option value="5">5</option>
                                                          <option value="6">6</option>
                                                          <option value="7">7</option>
                                                          <option value="8">8</option>
                                                          <option value="9">9</option>
                                                          <option value="10">10</option>
                                                          <option value="11">11</option>
                                                          <option value="12">12</option>
                                                          <option value="13">13</option>
                                                          <option value="14">14</option>
                                                          <option value="15">15</option>
                                                          <option value="16">16</option>
                                                          <option value="17">17</option>
                                                          <option value="18">18</option>
                                                          <option value="19">19</option>
                                                          <option value="20">20</option>
                                                          <option value="21">21</option>
                                                          <option value="22">22</option>
                                                          <option value="23">23</option>
                                                          <option value="24">24</option>
                                                          <option value="25">25</option>
                                                          <option value="26">26</option>
                                                          <option value="27">27</option>
                                                          <option value="28">28</option>
                                                          <option value="29">29</option>
                                                          <option value="30">30</option>
                                                          <option value="31">31</option>
                                                          <option value="32">32</option>
                                                          <option value="33">33</option>
                                                          <option value="34">34</option>
                                                          <option value="35">35</option>
                                                          <option value="36">36</option>
                                                          <option value="37">37</option>
                                                          <option value="38">38</option>
                                                          <option value="39">39</option>
                                                          <option value="40">40</option>
                                                          <option value="41">41</option>
                                                          <option value="42">42</option>
                                                          <option value="43">43</option>
                                                          <option value="44">44</option>
                                                          <option value="45">45</option>
                                                          <option value="46">46</option>
                                                          <option value="47">47</option>
                                                          <option value="48">48</option>
                                                          <option value="49">49</option>
                                                          <option value="50">50</option>
                        								  </select> 
                                                          <div id="mensaje_numero_horas_extras_50_porciento" class="errores"></div>
                                 </div>
                    		     </div>
	                    	    
	                    	    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="numero_horas_extras_100_porciento" class="control-label">Número Horas 100%:</label>
                                                          <select name="numero_horas_extras_100_porciento" id="numero_horas_extras_100_porciento"  class="form-control">
                                                          <option value="0" selected="selected">--Seleccione--</option>
                                                          <option value="1">1</option>
                                                          <option value="2">2</option>
                                                          <option value="3">3</option>
                                                          <option value="4">4</option>
                                                          <option value="5">5</option>
                                                          <option value="6">6</option>
                                                          <option value="7">7</option>
                                                          <option value="8">8</option>
                                                          <option value="9">9</option>
                                                          <option value="10">10</option>
                                                          <option value="11">11</option>
                                                          <option value="12">12</option>
                                                          <option value="13">13</option>
                                                          <option value="14">14</option>
                                                          <option value="15">15</option>
                                                          <option value="16">16</option>
                                                          <option value="17">17</option>
                                                          <option value="18">18</option>
                                                          <option value="19">19</option>
                                                          <option value="20">20</option>
                                                          <option value="21">21</option>
                                                          <option value="22">22</option>
                                                          <option value="23">23</option>
                                                          <option value="24">24</option>
                                                          <option value="25">25</option>
                                                          <option value="26">26</option>
                                                          <option value="27">27</option>
                                                          <option value="28">28</option>
                                                          <option value="29">29</option>
                                                          <option value="30">30</option>
                                                          <option value="31">31</option>
                                                          <option value="32">32</option>
                                                          <option value="33">33</option>
                                                          <option value="34">34</option>
                                                          <option value="35">35</option>
                                                          <option value="36">36</option>
                                                          <option value="37">37</option>
                                                          <option value="38">38</option>
                                                          <option value="39">39</option>
                                                          <option value="40">40</option>
                                                          <option value="41">41</option>
                                                          <option value="42">42</option>
                                                          <option value="43">43</option>
                                                          <option value="44">44</option>
                                                          <option value="45">45</option>
                                                          <option value="46">46</option>
                                                          <option value="47">47</option>
                                                          <option value="48">48</option>
                                                          <option value="49">49</option>
                                                          <option value="50">50</option>
                        								  </select> 
                                                          <div id="mensaje_numero_horas_extras_100_porciento" class="errores"></div>
                                 </div>
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
                    	
                    	
                    	           	
                    	        <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Guardar</i></button>
                                					  <a href="index.php?controller=RubrosVariables&action=index" class="btn btn-primary" ><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
				  		
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
              <h3 class="box-title">Listado Rubros Extras Empleados</h3>
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
    		 consulta_mes_a_generar_rol();
  		   
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
		    

    	</script>
   
   
   
   <script>
   $("#id_tipo_rubros").click(function() {
		
 	  var id_tipo_rubros = $(this).val();
			
       if(id_tipo_rubros == 0 )
       {
    	  
    	   $("#div_datos_bono").fadeOut("slow");
    	   $("#div_datos_horas_extras").fadeOut("slow");

    	   $('#valor_rubros_variables_empleados').val("0.00");
    	   $('#numero_horas_extras_50_porciento').val("0");
    	   $('#numero_horas_extras_100_porciento').val("0");
    	   
    	   
       }
    	  else
       {


    		  if(id_tipo_rubros == 1 || id_tipo_rubros == 3 || id_tipo_rubros == 4 || id_tipo_rubros == 5 || id_tipo_rubros == 6 || id_tipo_rubros == 7 || id_tipo_rubros == 8)
    	       {
    	    	  
    	    	   $("#div_datos_bono").fadeIn("slow");
    	    	   $("#div_datos_horas_extras").fadeOut("slow");
    	    	   $('#numero_horas_extras_50_porciento').val("0");
    	    	   $('#numero_horas_extras_100_porciento').val("0");
    	       }
    	    	  else
    	       {
    	    	   $("#div_datos_bono").fadeOut("slow");
    	    	   $('#valor_rubros_variables_empleados').val("0.00");
    	       }


	    		  if(id_tipo_rubros == 2 )
	   	       {
	    			  $("#div_datos_horas_extras").fadeIn("slow");
	    			  $("#div_datos_bono").fadeOut("slow");
	    			  $('#valor_rubros_variables_empleados').val("0.00");
	   	    	   
	   	       }
	   	    	  else
	   	       {
	   	    	   $("#div_datos_horas_extras").fadeOut("slow");
	   	    	   $('#numero_horas_extras_50_porciento').val("0");
   	    	       $('#numero_horas_extras_100_porciento').val("0");
	   	       }

	    		 
    	   
       }
      
	    });
	    
	    $("#id_tipo_rubros").change(function() {
			  
	    	  if(id_tipo_rubros == 0 )
	          {
	       	  
	       	   $("#div_datos_bono").fadeOut("slow");
	       	   $("#div_datos_horas_extras").fadeOut("slow");

	       	   $('#valor_rubros_variables_empleados').val("0.00");
	       	   $('#numero_horas_extras_50_porciento').val("0");
	       	   $('#numero_horas_extras_100_porciento').val("0");
	       	   
	       	   
	          }
	       	  else
	          {


	       		 if(id_tipo_rubros == 1 || id_tipo_rubros == 3 || id_tipo_rubros == 4 || id_tipo_rubros == 5 || id_tipo_rubros == 6 || id_tipo_rubros == 7 || id_tipo_rubros == 8)
	        	     
		       	  {
	       	    	  
	       	    	   $("#div_datos_bono").fadeIn("slow");
	       	    	   $("#div_datos_horas_extras").fadeOut("slow");
	       	    	   $('#numero_horas_extras_50_porciento').val("0");
	       	    	   $('#numero_horas_extras_100_porciento').val("0");
	       	       }
	       	    	  else
	       	       {
	       	    	   $("#div_datos_bono").fadeOut("slow");
	       	    	   $('#valor_rubros_variables_empleados').val("0.00");
	       	       }


	   	    	  if(id_tipo_rubros == 2 )
	   	   	       {
	   	    			  $("#div_datos_horas_extras").fadeIn("slow");
	   	    			  $("#div_datos_bono").fadeOut("slow");
	   	    			  $('#valor_rubros_variables_empleados').val("0.00");
	   	   	    	   
	   	   	       }
	   	   	    	  else
	   	   	       {
	   	   	    	   $("#div_datos_horas_extras").fadeOut("slow");
	   	   	    	   $('#numero_horas_extras_50_porciento').val("0");
	      	    	       $('#numero_horas_extras_100_porciento').val("0");
	   	   	       }


	   	    	
	       	   
	          }
           
     });


	     

		
   </script>
   
 
          
        <script>
         	$(document).ready(function(){

                        var id_empleados = $("#id_empleados").val();

                        if(id_empleados>0){}else{
        	       		
						$( "#identificacion_empleados" ).autocomplete({
		      				source: "<?php echo $helper->url("RubrosVariables","AutocompleteCedula"); ?>",
		      				minLength: 1
		    			});
		
						$("#identificacion_empleados").focusout(function(){
		    				$.ajax({
		    					url:'<?php echo $helper->url("RubrosVariables","AutocompleteDevuelveNombres"); ?>',
		    					type:'POST',
		    					dataType:'json',
		    					data:{identificacion_empleados:$('#identificacion_empleados').val()}
		    				}).done(function(respuesta){
	
		    				    $('#identificacion_empleados').val(respuesta.identificacion_empleados);
		    					$('#apellidos_empleados').val(respuesta.apellidos_empleados);
		    					$('#nombres_empleados').val(respuesta.nombres_empleados);
		    					$("#id_empleados").val(respuesta.id_empleados);
		    			        $("#id_departamentos").val(respuesta.id_departamentos);
		    			        $("#id_cargos_departamentos").val(respuesta.id_cargos_departamentos);
		    			        $("#valor_sueldo_cargo_departamentos").val(respuesta.valor_sueldo_cargo_departamentos);

		    			        
		    				
		        			}).fail(function(respuesta) {

		        				
		        		        $('#identificacion_empleados').val("");
		    					$('#apellidos_empleados').val("");
		    					$('#nombres_empleados').val("");
		    					$("#id_empleados").val("0");
		    			        $("#id_departamentos").val("0");
		    			        $("#id_cargos_departamentos").val("0");
		    			        $("#valor_sueldo_cargo_departamentos").val("0.00");
		        		        
		    					
		        			    
		        			  });
		    				 
		    				
		    			});  
                        }
						
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
           	               url: 'index.php?controller=RubrosVariables&action=index10&search='+search,
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#empleados_activos_registrados").html(x);
           	               	 $("#tabla_empleados").tablesorter(); 
           	                 $("#load_activos_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#empleados_activos_registrados").html("Ocurrio un error al cargar la información de Rubros Variables..."+estado+"    "+error);
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


		    	var id_empleados = $("#id_empleados").val();
		    	var id_tipo_rubros  =  $('#id_tipo_rubros').val();
		    	var valor_rubros_variables_empleados  =  $('#valor_rubros_variables_empleados').val();
		    	var numero_horas_extras_50_porciento  =  $('#numero_horas_extras_50_porciento').val();
		    	var numero_horas_extras_100_porciento  =  $('#numero_horas_extras_100_porciento').val();
		    	var mes_afectacion  =  $('#mes_afectacion').val();
		    	var anio_afectacion  =  $('#anio_afectacion').val();
		    	var mes_afectacion_verificacion =  $('#mes_afectacion_verificacion').val();
		    	
		    	var contador=0;
		    	var tiempo = tiempo || 1000;


		    	
		    	if (id_empleados==0 )
		    	{
			    	
		    		$("#mensaje_identificacion_empleados").text("Ingrese Cédula");
		    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
		            
				}


				
		    	if (id_tipo_rubros == 0 )
		    	{
			    	
		    		$("#mensaje_id_tipo_rubros").text("Seleccione");
		    		$("#mensaje_id_tipo_rubros").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_tipo_rubros).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{


		    		if (id_tipo_rubros == 1 )
			    	{
				    	
		    			if (valor_rubros_variables_empleados == 0.00 )
				    	{
					    	
				    		$("#mensaje_valor_rubros_variables_empleados").text("Ingrese Valor");
				    		$("#mensaje_valor_rubros_variables_empleados").fadeIn("slow"); //Muestra mensaje de error
				    		$("html, body").animate({ scrollTop: $(mensaje_valor_rubros_variables_empleados).offset().top-120 }, tiempo);
							
				            return false;
					    }else{
					    	$("#mensaje_valor_rubros_variables_empleados").fadeOut("slow"); //Muestra mensaje de error
						}
				    }else if (id_tipo_rubros == 2 ){

				    	if (numero_horas_extras_50_porciento == 0 && numero_horas_extras_100_porciento == 0 )
				    	{
					    	
				    		$("#mensaje_numero_horas_extras_50_porciento").text("Seleccione Horas del 50% o el 100%");
				    		$("#mensaje_numero_horas_extras_50_porciento").fadeIn("slow"); //Muestra mensaje de error
				    		$("html, body").animate({ scrollTop: $(mensaje_numero_horas_extras_50_porciento).offset().top-120 }, tiempo);
							
				            return false;
					    }else{
					    	$("#mensaje_numero_horas_extras_50_porciento").fadeOut("slow"); //Muestra mensaje de error
						}
						
					}else{
						if (valor_rubros_variables_empleados == 0.00 )
				    	{
					    	
				    		$("#mensaje_valor_rubros_variables_empleados").text("Ingrese Valor");
				    		$("#mensaje_valor_rubros_variables_empleados").fadeIn("slow"); //Muestra mensaje de error
				    		$("html, body").animate({ scrollTop: $(mensaje_valor_rubros_variables_empleados).offset().top-120 }, tiempo);
							
				            return false;
					    }else{
					    	$("#mensaje_valor_rubros_variables_empleados").fadeOut("slow"); //Muestra mensaje de error
						}

					}



					

				}


		    	if (mes_afectacion == 0 )
		    	{
			    	
		    		$("#mensaje_mes_afectacion").text("Seleccione");
		    		$("#mensaje_mes_afectacion").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_mes_afectacion).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		if(mes_afectacion_verificacion.trim()==mes_afectacion){

	                   	 $("#mensaje_mes_afectacion").fadeOut("slow"); //Muestra mensaje de error
	    		            
	                    }else{

	                   	 $("#mensaje_mes_afectacion").text("El mes seleccionado no se puede procesar o ya se encuentra cerrado.");
	    		    		$("#mensaje_mes_afectacion").fadeIn("slow"); //Muestra mensaje de error
	    		    		$("html, body").animate({ scrollTop: $(mensaje_mes_afectacion).offset().top-120 }, tiempo);
	    					
	    		            return false;
		                     }
	                
				}



		    	if (anio_afectacion == 0 )
		    	{
			    	
		    		$("#mensaje_anio_afectacion").text("Seleccione");
		    		$("#mensaje_anio_afectacion").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_anio_afectacion).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_anio_afectacion").fadeOut("slow"); //Muestra mensaje de error
		            
				}

			}); 

		      
		        $( "#identificacion_empleados" ).focus(function() {
					  $("#mensaje_identificacion_empleados").fadeOut("slow");
				});
		        $( "#id_tipo_rubros" ).focus(function() {
					  $("#mensaje_id_tipo_rubros").fadeOut("slow");
				    });
		        $( "#valor_rubros_variables_empleados" ).focus(function() {
					  $("#mensaje_valor_rubros_variables_empleados").fadeOut("slow");
				    });
		        $( "#numero_horas_extras_50_porciento" ).focus(function() {
					  $("#mensaje_numero_horas_extras_50_porciento").fadeOut("slow");
				    });
		        $( "#numero_horas_extras_100_porciento" ).focus(function() {
					  $("#mensaje_numero_horas_extras_100_porciento").fadeOut("slow");
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