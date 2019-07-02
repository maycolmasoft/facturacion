<!DOCTYPE HTML>
	<html lang="es">
    <head>
        
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Factura</title>
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
        <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Reportes</a></li>
        <li class="active">Consultar Factura</li>
      </ol>
    </section>

    
    
    
    
    <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Consultar Factura</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
             
              
            </ul>
            
            <div class="col-md-5 col-lg-12 col-xs-5">
            <div class="tab-content">
            <br>
              <div class="tab-pane active" id="ConsultaFactura">
                
					<div class="pull-right" style="margin-right:15px;">
						<input type="text" value="" class="form-control" id="search_ConsultaFactura" name="search_ConsultaFactura" onkeyup="load_ConsultaFactura(1)" placeholder="search.."/>
					</div>
					<div id="load_ConsultaFactura" ></div>	
					<div id="clientes_registrados_detalle"></div>	
                
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
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    

    
	<script type="text/javascript">
	function DescargaExcel()
    {
   	
   	 var search=$('#search_ConsultaFactura').val();
   	 var  url='index.php?controller=ConsultaFactura&action=Excel_Consulta_Factura&search='+search;
   	 var nombre='Consulta Facturas';
      	 
   				var con_datos={
   						  search:search,
   						  action:'ajax'
   						  };
   				$.ajax({
   					url: url,
   			        type : "POST",
   			        async: true,			
   					data: con_datos,
   					success:function(data){
   						console.log(data)
   							
   						if(data.length>3)
   						   {
   				  var array = JSON.parse(data);
   				  var newArr = [];
   				   while(array.length) newArr.push(array.splice(0,7));
   				   console.log(newArr);
   				   
   				   var dt = new Date();
   				   var m=dt.getMonth();
   				   m+=1;
   				   var y=dt.getFullYear();
   				   var d=dt.getDate();
   				   var fecha=d.toString()+"/"+m.toString()+"/"+y.toString();
   				   var wb =XLSX.utils.book_new();
   				   wb.SheetNames.push(nombre);
   				   var ws = XLSX.utils.aoa_to_sheet(newArr);
   				   wb.Sheets[nombre] = ws;
   				   var wbout = XLSX.write(wb,{bookType:'xlsx', type:'binary'});
   				   function s2ab(s) { 
   			            var buf = new ArrayBuffer(s.length); //convert s to arrayBuffer
   			            var view = new Uint8Array(buf);  //create uint8array as viewer
   			            for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF; //convert to octet
   			            return buf;    
   				   }
   			       saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), nombre+fecha+'.xlsx');
   					   }
   				   else{
   					   alert("No hay información para descargar");
   				   }
   					}
   				});

    }
     
        	   $(document).ready( function (){
        		   
        		   load_ConsultaFactura(1);
        		   
        		   
	   			});

        	


	   function load_ConsultaFactura(pagina){

		   var search=$("#search_ConsultaFactura").val();
	       var con_datos={
					  action:'ajax',
					  page:pagina
					  };
			  
	     $("#load_ConsultaFactura").fadeIn('slow');
	     
	     $.ajax({
	               beforeSend: function(objeto){
	                 $("#load_ConsultaFactura").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');
	               },
	               url: 'index.php?controller=ConsultaFactura&action=Consulta_Factura&search='+search,
	               type: 'POST',
	               data: con_datos,
	               success: function(x){
	                 $("#clientes_registrados_detalle").html(x);
	                 $("#load_ConsultaFactura").html("");
	                 $("#tabla_ConsultaFactura").tablesorter(); 
	                 
	               },
	              error: function(jqXHR,estado,error){
	                $("#clientes_registrados_detalle").html("Ocurrio un error al cargar la informacion de Detalle Clientes..."+estado+"    "+error);
	              }
	            });


		   }

	   

 </script>
	

    
    
    
    
	
  </body>
</html> 