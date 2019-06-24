<!DOCTYPE HTML>
<html lang="es">
      <head>
         
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Milenio</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
 
   <?php include("view/modulos/links_css.php"); ?>
   

        
			        
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
        <li class="active">Tipo Rubros</li>
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
                        		    <div class="col-xs-12 col-md-3 col-md-3 ">
                            		    <div class="form-group">
                            		   						 
                                                              <label for="nombre_productos" class="control-label">Nombres</label>
                                                              <input type="text" class="form-control" id="nombre_productos" name="nombre_productos" value="<?php echo $resEdit->nombre_productos; ?>"  placeholder="Nombre"/>
                                                               <input type="hidden" name="id_productos" id="id_productos" value="<?php echo $resEdit->id_productos; ?>" class="form-control"/>
					                                          <div id="mensaje_nombre_productos" class="errores"></div>
					                                          				                                          
                            								
                            					                                          
                                        </div>
                            		  </div>
                            		  
                            		      <div class="col-xs-12 col-md-3 col-md-3 ">
                            		    <div class="form-group">
                            		   						 
                                                              <label for="codigo_productos" class="control-label">Nombres</label>
                                                              <input type="text" class="form-control" id="codigo_productos" name="codigo_productos" value="<?php echo $resEdit->codigo_productos; ?>"  placeholder="Código"/>
                                                               <input type="hidden" name="id_productos" id="id_productos" value="<?php echo $resEdit->id_productos; ?>" class="form-control"/>
					                                          <div id="mensaje_codigo_productos" class="errores"></div>
					                                          				                                          
                            								
                            					                                          
                                        </div>
                            		  </div>
                        	
                        	
                        	    <div class="col-xs-12 col-md-3 col-md-3 ">
                            		    <div class="form-group">
                            		   						 
                                                              <label for="marca_productos" class="control-label">Nombres</label>
                                                              <input type="text" class="form-control" id="marca_productos" name="marca_productos" value="<?php echo $resEdit->marca_productos; ?>"  placeholder="Marca"/>
                                                               <input type="hidden" name="id_productos" id="id_productos" value="<?php echo $resEdit->id_productos; ?>" class="form-control"/>
					                                          <div id="mensaje_marca_productos" class="errores"></div>
					                                          				                                          
                            								
                            					                                          
                                        </div>
                            		  </div>
                        	
                        	
                        	    <div class="col-xs-12 col-md-3 col-md-3 ">
                            		    <div class="form-group">
                            		   						 
                                                              <label for="precio_productos" class="control-label">Nombres</label>
                                                              <input type="text" class="form-control" id="precio_productos" name="precio_productos" value="<?php echo $resEdit->precio_productos; ?>"  placeholder="Precio"/>
                                                               <input type="hidden" name="id_productos" id="id_productos" value="<?php echo $resEdit->id_productos; ?>" class="form-control"/>
					                                          <div id="mensaje_precio_productos" class="errores"></div>
					                                          				                                          
                            								
                            					                                          
                                        </div>
                            		  </div>
                            		  
                            		     <div class="col-xs-12 col-md-3 col-md-3 ">
                            		    <div class="form-group">
                            		   						 
                                                              <label for="cantidad_stock_productos" class="control-label">Nombres</label>
                                                              <input type="text" class="form-control" id="cantidad_stock_productos" name="cantidad_stock_productos" value="<?php echo $resEdit->cantidad_stock_productos; ?>"  placeholder="Cantidad"/>
                                                               <input type="hidden" name="id_productos" id="id_productos" value="<?php echo $resEdit->id_productos; ?>" class="form-control"/>
					                                          <div id="mensaje_cantidad_stock_productos" class="errores"></div>
					                                          				                                          
                            								
                            					                                          
                                        </div>
                            		  </div>
                        	
                        			</div>	
                        		
            
            
							    
							     <?php } } else {?>
							    
							    
								    
								    <div class="row">
                        		    <div class="col-xs-12 col-md-3 col-md-3 ">
                            		    <div class="form-group">
                            		   						 
                                                              <label for="nombre_productos" class="control-label">Nombres</label>
                                                              <input type="text" class="form-control" id="nombre_productos" name="nombre_productos" value=""  placeholder="Nombre"/>
                                                               <input type="hidden" name="id_productos" id="id_productos" value="0" class="form-control"/>
					                                          <div id="mensaje_nombre_productos" class="errores"></div>
					                                          				                                          
                            								
                            					                                          
                                        </div>
                            		  </div>
                            		  
                            		      <div class="col-xs-12 col-md-3 col-md-3 ">
                            		    <div class="form-group">
                            		   						 
                                                              <label for="codigo_productos" class="control-label">Código</label>
                                                              <input type="text" class="form-control" id="codigo_productos" name="codigo_productos" value=""  placeholder="Código"/>
                                                               <input type="hidden" name="id_productos" id="id_productos" value="0" class="form-control"/>
					                                          <div id="mensaje_codigo_productos" class="errores"></div>
					                                          				                                          
                            								
                            					                                          
                                        </div>
                            		  </div>
                        	
                        	
                        	    <div class="col-xs-12 col-md-3 col-md-3 ">
                            		    <div class="form-group">
                            		   						 
                                                              <label for="marca_productos" class="control-label">Marca</label>
                                                              <input type="text" class="form-control" id="marca_productos" name="marca_productos" value=""  placeholder="Marca"/>
                                                               <input type="hidden" name="id_productos" id="id_productos" value="0" class="form-control"/>
					                                          <div id="mensaje_marca_productos" class="errores"></div>
					                                          				                                          
                            								
                            					                                          
                                        </div>
                            		  </div>
                        	
                        	
                        	    <div class="col-xs-12 col-md-3 col-md-3 ">
                            		    <div class="form-group">
                            		   						 
                                                              <label for="precio_productos" class="control-label">Precio</label>
                                                              <input type="text" class="form-control" id="precio_productos" name="precio_productos" value=""  placeholder="Precio"/>
                                                               <input type="hidden" name="id_productos" id="id_productos" value="0" class="form-control"/>
					                                          <div id="mensaje_precio_productos" class="errores"></div>
					                                          				                                          
                            								
                            					                                          
                                        </div>
                            		  </div>
                            		  
                            		     <div class="col-xs-12 col-md-3 col-md-3 ">
                            		    <div class="form-group">
                            		   						 
                                                              <label for="cantidad_stock_productos" class="control-label">Cantidad</label>
                                                              <input type="text" class="form-control" id="cantidad_stock_productos" name="cantidad_stock_productos" value=""  placeholder="Cantidad"/>
                                                               <input type="hidden" name="id_productos" id="id_productos" value="0" class="form-control"/>
					                                          <div id="mensaje_cantidad_stock_productos" class="errores"></div>
					                                          				                                          
                            								
                            					                                          
                                        </div>
                            		  </div>
                        	
                        			</div>	
                        		
            
							    
							   
					               	
							     <?php } ?>
					                		        
                           		   <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Guardar</i></button>
                                					  <button type="button" id="Cancelar" name="Cancelar" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></button>
                                
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
          <h3 class="box-title">Listado de Productos</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        
        <div class="box-body">
        
        
       <div class="ibox-content">  
      <div class="table-responsive">
        
		<table  class="table table-striped table-bordered table-hover dataTables-example">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre</th>
                          <th>Código</th>
                          <th>Marca</th>
                          <th>Precio</th>
                          <th>Cantidad</th>
                          <th>Editar</th>
                          <th>Borrar</th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php $i=0;?>
    						<?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
    						<?php $i++;?>
            	        		<tr>
            	                   <td > <?php echo $i; ?>  </td>
            		               <td > <?php echo $res->nombre_productos; ?>     </td> 
            		              <td > <?php echo $res->codigo_productos; ?>     </td> 
            		              <td > <?php echo $res->marca_productos; ?>     </td> 
            		              <td > <?php echo $res->precio_productos; ?>     </td> 
            		              <td > <?php echo $res->cantidad_stock_productos; ?>     </td> 
            		             
            		               <td>
            			           		<div class="right">
            			                    <a href="<?php echo $helper->url("Productos","index"); ?>&id_productos=<?php echo $res->id_productos; ?>" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class='glyphicon glyphicon-edit'></i></a>
            			                </div>
            			            
            			             </td>
            			             <td>   
            			                	<div class="right">
            			                    <a href="<?php echo $helper->url("Productos","borrarId"); ?>&id_productos=<?php echo $res->id_productos; ?>" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
            			                </div>
            			              
            		               </td>
            		    		</tr>
            		        <?php } } ?>
                    
                    </tbody>
                    </table>
       
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
	

       
         <script>
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Guardar").click(function() 
			{
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var nombre_tipo_rubros = $("#nombre_tipo_rubros").val();
		    	
		    	
		    	
		    	if (nombre_tipo_rubros == "")
		    	{
			    	
		    		$("#mensaje_nombre_tipo_rubros").text("Introduzca Nombre");
		    		$("#mensaje_nombre_tipo_rubros").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombre_tipo_rubros").fadeOut("slow"); //Muestra mensaje de error
		            
				}   


		    	
			}); 


		        $( "#nombre_tipo_rubros" ).focus(function() {
				  $("#mensaje_nombre_tipo_rubros").fadeOut("slow");
			    });
		        		      
				    
		}); 

	</script>

 	
	
	
  </body>
</html>   

