<!DOCTYPE HTML>
	<html lang="es">
    <head>
        
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pedidos</title>
    <script lang=javascript src="view/js/xlsx.full.min.js"></script>
   	<script lang=javascript src="view/js/FileSaver.min.js"></script> 
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
     
    <?php include("view/modulos/links_css.php"); ?>		
      
    	
	
		    
	</head>
 
    <body class="hold-transition skin-blue fixed sidebar-mini" ng-app="myApp" ng-controller="myCtrl">
    
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
        <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Consultar Pedidos</li>
      </ol>
    </section>

    
    
    
    
    <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Consultar Pedidos</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
                     
                      
        <div class="box-body">
             <div class="row" style="margin-left:1px;">
            						<div class="col-lg-2 col-xs-12 col-md-2">
                        		    <div class="form-group">
                                                          <label for="desde" class="control-label">Desde:</label>
                                                          <input type="date" class="form-control" id="desde" name="desde" value="" >
                                                          <div id="mensaje_desde" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        		    <div class="col-lg-2 col-xs-12 col-md-2">
                        		    <div class="form-group">
                                                          <label for="hasta" class="control-label">Hasta:</label>
                                                          <input type="date" class="form-control" id="hasta" name="hasta" value="">
                                                          <div id="mensaje_hasta" class="errores"></div>
                                               
                                    </div>
                                    </div>
                        
                        
                                    <div class="col-xs-12 col-md-2 col-lg-2" style="text-align: center; margin-top:22px">
                    		        <div class="form-group">
                        		    <button type="button" id="buscar" name="buscar" class="btn btn-info"><i class="glyphicon glyphicon-search"></i></button>
                                	</div>
                                    </div>
            	</div>
            
                    <div class="pull-right" style="margin-right:15px;">
						<input type="text" value="" class="form-control" id="search_ConsultaFactura" name="search_ConsultaFactura" onkeyup="load_ConsultaFactura(1)" placeholder="search.."/>
				
					</div>
					<div id="load_ConsultaFactura" ></div>	
					<div id="clientes_registrados_detalle"></div>	
           </div>
           </div>
            </section>
    
     
    
  </div>
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
 
 
 
    
    <?php include("view/modulos/links_js.php"); ?>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    

    
	<script type="text/javascript">

     
        	   $(document).ready( function (){
        		   
        		   load_ConsultaFactura(1);


		 			  $("#buscar").click(function() 
					{
				    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
				    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

				    	var desde = $("#desde").val();
				    	var hasta = $("#hasta").val();
				    	
				    	
				    	


						if(desde > hasta){

							$("#mensaje_desde").text("Fecha desde no puede ser mayor a hasta");
				    		$("#mensaje_desde").fadeIn("slow"); //Muestra mensaje de error
				            return false;
				            
 					}else 
				    	{
				    		$("#mensaje_desde").fadeOut("slow"); //Muestra mensaje de error
				    		load_ConsultaFactura(1);
						} 


						if(hasta < desde){

							$("#mensaje_hasta").text("Fecha hasta no puede ser menor a desde");
				    		$("#mensaje_hasta").fadeIn("slow"); //Muestra mensaje de error
				            return false;
				            
 					}else 
				    	{
				    		$("#mensaje_hasta").fadeOut("slow"); //Muestra mensaje de error
				    		load_ConsultaFactura(1);
						} 
						
				    					    

					}); 


				        $( "#desde" ).focus(function() {
						  $("#mensaje_desde").fadeOut("slow");
					    });
						
				        $( "#hasta" ).focus(function() {
						  $("#mensaje_hasta").fadeOut("slow");
					    });
						

		   
        		   
	   			});

        	


	   function load_ConsultaFactura(pagina){

		   var search=$("#search_ConsultaFactura").val();
		   var desde=$("#desde").val();
		   var hasta=$("#hasta").val();
       
	       var con_datos={
					  action:'ajax',
					  page:pagina,
   					  desde:desde,
   					  hasta:hasta
					  };
			  
	     $("#load_ConsultaFactura").fadeIn('slow');
	     
	     $.ajax({
	               beforeSend: function(objeto){
	                 $("#load_ConsultaFactura").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');
	               },
	               url: 'index.php?controller=ConsultaFactura&action=Consulta_Factura_Clientes&search='+search,
	               type: 'POST',
	               data: con_datos,
	               success: function(x){
	                 $("#clientes_registrados_detalle").html(x);
	                 $("#load_ConsultaFactura").html("");
	                 $("#tabla_ConsultaFactura").tablesorter(); 
	                 
	               },
	              error: function(jqXHR,estado,error){
	                $("#clientes_registrados_detalle").html("Ocurrio un error al cargar la informacion de Pedidos..."+estado+"    "+error);
	              }
	            });


		   }

	   

 </script>
	

    
    
    
    
	
  </body>
</html> 