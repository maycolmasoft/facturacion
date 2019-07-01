<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Facturación</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    
    
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
            <div id='pone_users'></div>
            <div id='pone_roles'></div>
            <div id='pone_permisos'></div>
            <div id='pone_sesiones'></div>
          </section>


    
  </div>
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    
   <?php include("view/modulos/links_js.php"); ?>
 
 	
 	 <script type="text/javascript">
     
        	   $(document).ready( function (){
        		
        		   pone_users();
        		   pone_roles();
        		   pone_permisos_roles();
        		   cargar_sesiones();
        		  
	   			});
        	
        	   
        	   function pone_users(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_users").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=cargar_global_usuarios',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_users").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_users").html("Ocurrio un error al cargar la informacion de usuarios..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }
        	   function pone_roles(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_roles").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=contar_roles',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_roles").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_roles").html("Ocurrio un error al cargar la informacion de roles..."+estado+"    "+error);
        		                }
        		              });
        		     })
        		  }
        	   function pone_permisos_roles(){
        		   $(document).ready( function (){
        		       $.ajax({
        		                 beforeSend: function(objeto){
        		                   $("#pone_permisos").html('')
        		                 },
        		                 url: 'index.php?controller=Usuarios&action=cargar_permisos_roles',
        		                 type: 'POST',
        		                 data: null,
        		                 success: function(x){
        		                   $("#pone_permisos").html(x);
        		                 },
        		                error: function(jqXHR,estado,error){
        		                  $("#pone_permisos").html("Ocurrio un error al cargar la informacion de permisos..."+estado+"    "+error);
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
