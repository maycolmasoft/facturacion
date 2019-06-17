<!DOCTYPE html>
<html lang="en">
  <head>
    
    <title>Milenio</title>

   
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->	
    	<link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="view/bootstrap/otros/login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="view/bootstrap/otros/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    
    <!--===============================================================================================-->
    	
    	<link rel="stylesheet" type="text/css" href="view/bootstrap/otros/login/css/main.css">
    <!--===============================================================================================-->
    
  </head>

  <body>
  
  
  <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="view/images/logo_milenio.png" alt="IMG">
				</div>

				
				<form class="login100-form validate-form" action="<?php echo $helper->url("Usuarios","resetear_clave_inicio"); ?>" method="post" >
					<span class="login100-form-title">
						Recuperar Clave
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Cedula es requerida">
						<input class="input100" type="text" id="cedula_usuarios" name="cedula_usuarios" placeholder="Cedula..">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					
					
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Recuperar
						</button>
					</div>

                    <div class="container-login100-form-btn">
						<a href="index.php?controller=Usuarios&action=cerrar_sesion" class="btn btn-primary" style="  width: 270px;"><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
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
	
	
  
  
  
  
				        
					        
    
    
    
    
<!--===============================================================================================-->	
	<script src="view/bootstrap/otros/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="view/bootstrap/otros/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="view/bootstrap/otros/login/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="view/bootstrap/otros/login/js/main.js"></script>
    
    
  
    
   
  </body>
</html>
