<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Facturación</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <style>
    .scrollable-menu {
    height: auto;
    max-height: 200px;
    overflow-x: hidden;
}

	ul{
        list-style-type:none;
      }
  li{
    list-style-type:none;
    }
    li:hover font {
  color: black;
}

    </style>
    
    
   <?php include("view/modulos/links_css.php"); ?>
   
  </head>

  <body class="hold-transition skin-blue fixed sidebar-mini">
    
    
    
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
     
    </section>

    <section class="content">
    		<div id='pone_facturas'></div>
            <div id='pone_productos'></div>
            <div id='pone_clientes'></div>   
    </section>
  </div>
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    
   <?php include("view/modulos/links_js.php"); ?>
   
    <script type="text/javascript">
     
        	   $(document).ready( function (){
        		
        		   pone_facturas();
        		   pone_productos();
        		   pone_clientes();
        		   //cargar_sesiones();*/
        		  
	   			});
        	
        	   
        	   function pone_facturas(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_facturas").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=total_facturas',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_facturas").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_facturas").html("Ocurrio un error al cargar la informacion de usuarios..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }
        	   function pone_productos(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_productos").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=total_productos',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_productos").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_productos").html("Ocurrio un error al cargar la informacion de roles..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }
        	   function pone_clientes(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_clientes").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=total_clientes',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_clientes").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_clientes").html("Ocurrio un error al cargar la informacion de permisos..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }
        	   function cargar_sesiones(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_sesiones").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=cargar_sesiones',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_sesiones").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_sesiones").html("Ocurrio un error al cargar la informacion de sesiones..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }
     		  </script>
 
 	
  </body>
</html>
