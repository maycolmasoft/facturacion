<?php

class ProcesosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		
		session_start();

	
		if (isset(  $_SESSION['nombre_usuarios']) )
		{

		    $_biometrico = new LecturaBiometricoModel();
		    
			$nombre_controladores = "LecturasBiometrico";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $_biometrico->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				$this->view("Procesos",array(
						""=>""
				));
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos a Cargar Lecturas de Biométrico"
				
				));
				
				exit();	
			}
				
		}
	else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
	
	}
	
	
	
	public function  consulta_mes_a_generar_rol(){
			
		session_start();
		$_id_usuarios = $_SESSION["id_usuarios"];
		$cierre_nomina = new CierreNominaModel();
			
		$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
			
		if($action == 'ajax')
		{
			$columnas_enc = " max(cierre_nomina.mes_cierre_nomina) as max";
			$tablas_enc ="public.cierre_nomina";
			$where_enc ="id_estado=1";
			$resultSet=$cierre_nomina->getCondicionesSinOrder($columnas_enc ,$tablas_enc ,$where_enc);
	
			
			$_numero=0;
			$_numero_impri=0;
			
			if(!empty($resultSet)){
					
				$_numero    =$resultSet[0]->max;
					
			}else{
				
				$_numero=0;
			}
			(int)$_numero_impri=(int)$_numero+1;
	
			echo $_numero_impri;
			
			
			
			
		}
			
	}
	
	
	
	public function inserta_datos(){
	    
	    
	    
	    session_start();
	    $resultado = null;
	    $errores_importacion = new ErroresImportacionModel();
	    $empledos = new EmpleadosModel();
	    $temp_lectura_biometrico = new TempLecturaBiometricoModel();
	    $_lectura_biometrico = new LecturaBiometricoModel();
	     
	    
	    if (isset(  $_SESSION['nombre_usuarios']) )
	    {
	        
	    	$_mes_afectacion_vista = $_POST["mes_afectacion"];
	    	$_anio_afectacion_vista = $_POST["anio_afectacion"];
	    	
	    	
	         if ($_FILES['file_biometrico']['tmp_name']!="")
	        {
	            
	            $errores_importacion->deleteAll("1=1");
	            $temp_lectura_biometrico->deleteAll("1=1");
	            $_lectura_biometrico->deleteById("mes_afectacion='$_mes_afectacion_vista' AND anio_afectacion='$_anio_afectacion_vista'");
	            
	            
	            
	            $_id_usuarios= $_SESSION['id_usuarios'];
	            
	            $directorio = $_SERVER['DOCUMENT_ROOT'].'/nomina/view/biometrico/';
	            
	            $nombre = $_FILES['file_biometrico']['name'];
	            $tipo = $_FILES['file_biometrico']['type'];
	            $tamano = $_FILES['file_biometrico']['size'];
	            move_uploaded_file($_FILES['file_biometrico']['tmp_name'],$directorio.$nombre);
	            
	            
	            $lineas = file($directorio.$nombre);
	            $numero_linea=0;
	            $errores=false;
	            $error_encontrado="";
	            
	            if(!empty($lineas)){
	                
	                
	                foreach ($lineas as $linea_num => $linea)
	                {
	                    $numero_linea++;
	                    $error_encontrado="";
	                    $datos = explode("\t",$linea);
	                    
	                    if(count($datos) == 3 && !empty(trim($datos[0])) && !empty(trim($datos[1])) && !empty(trim($datos[2]))){
	                        
	                        $identificacion_empleado              = trim($datos[0]);
	                        $fecha_correspondiente                = trim($datos[1]);
	                        $hora_correspondiente                 = trim($datos[2]);
	                        
	                        
	                    }else{
	                        
	                        $errores=true;
	                        
	                        $error_encontrado="Esta linea no contiene el formato establecido (cedula, fecha, hora), las columnas no estan separadas por tabulaciones.";
	                        
	                        $funcion = "ins_errores_importacion";
	                        $parametros = "'$numero_linea',
							'$error_encontrado',
							'$_id_usuarios'";
	                        $errores_importacion->setFuncion($funcion);
	                        $errores_importacion->setParametros($parametros);
	                        $resultado=$errores_importacion->Insert();
	                        
	                    }
	                    
	                }
	                
	                
	                
	                
	                // cuando pasa la primera validacion de verificar tabulaciones.
	                if($errores==false){
	                    
	                    $numero_linea=0;
	                    
	                    $identificacion_empleado="";
	                    $fecha_correspondiente="";
	                    $hora_correspondiente="";
	                    // AQUI VALIDAMOS QUE LA CEDULA EXISTA REGISTRADA EN LA BASE DE DATOS.
	                    foreach ($lineas as $linea_num => $linea)
	                    {
	                        $numero_linea++;
	                        $error_encontrado="";
	                        $datos = explode("\t",$linea);
	                        
	                        if(count($datos) == 3 && !empty(trim($datos[0])) && !empty(trim($datos[1])) && !empty(trim($datos[2]))){
	                            
	                            $identificacion_empleado              = trim($datos[0]);
	                            $fecha_correspondiente                = trim($datos[1]);
	                            $hora_correspondiente                 = trim($datos[2]);
	                            
	                            
	                            
	                            if(!is_numeric($identificacion_empleado)){
	                                
	                                $errores=true;
	                                
	                                $error_encontrado="La cedula $identificacion_empleado debe ser solo numeros.";
	                                
	                                $funcion = "ins_errores_importacion";
	                                $parametros = "'$numero_linea',
                    								'$error_encontrado',
                    								'$_id_usuarios'";
	                                $errores_importacion->setFuncion($funcion);
	                                $errores_importacion->setParametros($parametros);
	                                $resultado=$errores_importacion->Insert();
	                                
	                            }else{
	                                
	                                
	                                if(strlen($identificacion_empleado)==10 || strlen($identificacion_empleado)==13){
	                                    
	                                }else{
	                                    
	                                    
	                                    $errores=true;
	                                    
	                                    $error_encontrado="La cedula $identificacion_empleado debe estar compuesta de 10 dígitos o 13 dígitos.";
	                                    
	                                    $funcion = "ins_errores_importacion";
	                                    $parametros = "'$numero_linea',
                									'$error_encontrado',
                									'$_id_usuarios'";
	                                    $errores_importacion->setFuncion($funcion);
	                                    $errores_importacion->setParametros($parametros);
	                                    $resultado=$errores_importacion->Insert();
	                                    
	                                }
	                                
	                                
	                                
	                            }
	                            
	                            
	                            $columnas="empleados.identificacion_empleados";
	                            
	                            $tablas ="empleados";
	                            
	                            $where ="empleados.identificacion_empleados= '$identificacion_empleado'";
	                            
	                            $id="empleados.identificacion_empleados";
	                            
	                            $resultEmple=$empledos->getCondiciones($columnas,$tablas,$where,$id);
	                            
	                            
	                            if(!empty($resultEmple)){
	                                
	                                
	                                
	                            }else{
	                                
	                                $errores=true;
	                                
	                                $error_encontrado="La cedula número $identificacion_empleado no existe registrada en la base de datos.";
	                                
	                                $funcion = "ins_errores_importacion";
	                                $parametros = "'$numero_linea',
								    '$error_encontrado',
								    '$_id_usuarios'";
	                                $errores_importacion->setFuncion($funcion);
	                                $errores_importacion->setParametros($parametros);
	                                $resultado=$errores_importacion->Insert();
	                                
	                            }
	                            
	                            
	                            $valores = explode('/', $fecha_correspondiente);
	                            
	                            if(count($valores) == 3){
	                                
	                            }else{
	                                
	                                $errores=true;
	                                
	                                $error_encontrado="La fecha $fecha_correspondiente debe contener el formato YYYY/MM/DD. Separada por (/)";
	                                
	                                $funcion = "ins_errores_importacion";
	                                $parametros = "'$numero_linea',
								                   '$error_encontrado',
								                   '$_id_usuarios'";
	                                $errores_importacion->setFuncion($funcion);
	                                $errores_importacion->setParametros($parametros);
	                                $resultado=$errores_importacion->Insert();
	                            }
	                            
	                          
	                            
	                            if(checkdate($valores[1], $valores[2], $valores[0])){
	                                
	                                
	                            }else{
	                                
	                                $errores=true;
	                                
	                                $error_encontrado="La fecha $fecha_correspondiente no existe en el calendario.";
	                                
	                                $funcion = "ins_errores_importacion";
	                                $parametros = "'$numero_linea',
								                   '$error_encontrado',
								                   '$_id_usuarios'";
	                                $errores_importacion->setFuncion($funcion);
	                                $errores_importacion->setParametros($parametros);
	                                $resultado=$errores_importacion->Insert();
	                            }
	                            
	                            
	                            
	                            
	                            
	                            
	                            ///////VALIDAR QUE LOS REGISTROS SON SOLO DEL MES SELECCIONADO
	                            
	                             
	                             
	                            $mes_afectacion_v = substr($fecha_correspondiente, -5, 2);
	                            $mes_afectacion_v=(int)$mes_afectacion_v;
	                            
	                            $anio_afectacion_v = substr($fecha_correspondiente, -0, 4);
	                             
	                           
	                            
	                            if($mes_afectacion_v == $_mes_afectacion_vista && $anio_afectacion_v==$_anio_afectacion_vista){
	                            	
	                            	
	                            }else{
	                            	
	                            	$errores=true;
	                            	 
	                            	$error_encontrado="La fecha $fecha_correspondiente no pertenece al mes de afectación $_mes_afectacion_vista y el año $_anio_afectacion_vista.";
	                            	 
	                            	$funcion = "ins_errores_importacion";
	                            	$parametros = "'$numero_linea',
	                            	'$error_encontrado',
	                            	'$_id_usuarios'";
	                            	$errores_importacion->setFuncion($funcion);
	                            	$errores_importacion->setParametros($parametros);
	                            	$resultado=$errores_importacion->Insert();
	                            	
	                            }
	                            
	                            
	                            $valores1 = explode(':', $hora_correspondiente);
	                            
	                            if(count($valores1) == 3){
	                                
	                            }else{
	                                
	                                $errores=true;
	                                
	                                $error_encontrado="La hora $hora_correspondiente debe contener el formato HH:MM:SS. Separada por (:)";
	                                
	                                $funcion = "ins_errores_importacion";
	                                $parametros = "'$numero_linea',
								                   '$error_encontrado',
								                   '$_id_usuarios'";
	                                $errores_importacion->setFuncion($funcion);
	                                $errores_importacion->setParametros($parametros);
	                                $resultado=$errores_importacion->Insert();
	                            }
	                           
	                            
	                            
	                            if ($valores1[0] < 0 || $valores1[0] > 23 || !is_numeric($valores1[0])) {
	                               
	                                $errores=true;
	                                $error_encontrado="La hora $valores1[0] no existe en el reloj. $hora_correspondiente";
	                                
	                                $funcion = "ins_errores_importacion";
	                                $parametros = "'$numero_linea',
								                   '$error_encontrado',
								                   '$_id_usuarios'";
	                                $errores_importacion->setFuncion($funcion);
	                                $errores_importacion->setParametros($parametros);
	                                $resultado=$errores_importacion->Insert();
	                            }
	                            
	                            
	                            if ($valores1[1] < 0 || $valores1[1] > 59 || !is_numeric($valores1[1])) {
	                                
	                                $errores=true;
	                                $error_encontrado="El minuto $valores1[1] no existe en el reloj. $hora_correspondiente";
	                                
	                                $funcion = "ins_errores_importacion";
	                                $parametros = "'$numero_linea',
								                   '$error_encontrado',
								                   '$_id_usuarios'";
	                                $errores_importacion->setFuncion($funcion);
	                                $errores_importacion->setParametros($parametros);
	                                $resultado=$errores_importacion->Insert();
	                            }
	                            
	                            
	                            if ($valores1[2] < 0 || $valores1[2] > 59 || !is_numeric($valores1[2])) {
	                                
	                                $errores=true;
	                                $error_encontrado="El segundo $valores1[2] no existe en el reloj. $hora_correspondiente";
	                                
	                                $funcion = "ins_errores_importacion";
	                                $parametros = "'$numero_linea',
								                   '$error_encontrado',
								                   '$_id_usuarios'";
	                                $errores_importacion->setFuncion($funcion);
	                                $errores_importacion->setParametros($parametros);
	                                $resultado=$errores_importacion->Insert();
	                            }
	                           
	                            
	                            
	                            
	                        }else{
	                            
	                            $errores=true;
	                            
	                            $error_encontrado="Esta linea no contiene el formato establecido, las columnas no estan separadas por tabulaciones.";
	                            
	                            $funcion = "ins_errores_importacion";
	                            $parametros = "'$numero_linea',
                    							'$error_encontrado',
                    							'$_id_usuarios'";
	                            $errores_importacion->setFuncion($funcion);
	                            $errores_importacion->setParametros($parametros);
	                            $resultado=$errores_importacion->Insert();
	                            
	                        }
	                        
	                        
	                    }
	                     
	                }
	                
	                
	                
	                
	                
	                // POR FIN INSERTO EN EL TEMPORAL
	                
	                if($errores==false){
	                   
	                    
	                    $numero_linea=0;
	                    
	                    $identificacion_empleado="";
	                    $fecha_correspondiente="";
	                    $hora_correspondiente="";
	                    
	                    $funcion = "ins_temp_lectura_biometrico";
	                    
	                    foreach ($lineas as $linea_num => $linea)
	                    {
	                        $numero_linea++;
	                        $error_encontrado="";
	                        $datos = explode("\t",$linea);
	                        
	                        if(count($datos) == 3 && !empty(trim($datos[0])) && !empty(trim($datos[1])) && !empty(trim($datos[2]))){
	                            
	                            $identificacion_empleado              = trim($datos[0]);
	                            $fecha_correspondiente                = trim($datos[1]);
	                            $hora_correspondiente                 = trim($datos[2]);
	                            
	                            
	                            
	                            
	                            $parametros = "'$identificacion_empleado',
							                   '$fecha_correspondiente',
							                   '$hora_correspondiente',
                                               '$numero_linea'";
	                            $temp_lectura_biometrico->setFuncion($funcion);
	                            $temp_lectura_biometrico->setParametros($parametros);
	                            $resultado=$temp_lectura_biometrico->Insert();
	                            
	                            
	                            
	                        }else{
	                            
	                            $errores=true;
	                            
	                            $error_encontrado="Esta linea no contiene el formato establecido (cedula, fecha, hora), las columnas no estan separadas por tabulaciones.";
	                            
	                            $funcion = "ins_errores_importacion";
	                            $parametros = "'$numero_linea',
							               '$error_encontrado',
							               '$_id_usuarios'";
	                            $errores_importacion->setFuncion($funcion);
	                            $errores_importacion->setParametros($parametros);
	                            $resultado=$errores_importacion->Insert();
	                            
	                        }
	                        
	                    }
	                    
	                    
	                    $resultEmpleAct = $empledos->getBy("id_estado=1");
	                    
	                    if(!empty($resultEmpleAct)){
	                        
	                        foreach ($resultEmpleAct as $resEmp){
	                            
	                            $_identificacion_empleados = $resEmp->identificacion_empleados;
	                            $_nombres_empleados = $resEmp->nombres_empleados;
	                            $_apellidos_empleados = $resEmp->apellidos_empleados;
	                            
	                            
	                            $columnas_temp="cedula_temp_lectura_biometrico, fecha_temp_lectura_biometrico, count(*) as total";
	                            $tablas_temp="temp_lectura_biometrico";
	                            $where_temp="1=1 AND cedula_temp_lectura_biometrico='$_identificacion_empleados' group by cedula_temp_lectura_biometrico, fecha_temp_lectura_biometrico";
	                            $id_temp="cedula_temp_lectura_biometrico";
	                            
	                            $resultTempGrupo= $temp_lectura_biometrico->getCondiciones($columnas_temp,$tablas_temp,$where_temp,$id_temp);
	                            
	                            if(!empty($resultTempGrupo)){
	                                
	                                
	                                foreach ($resultTempGrupo as $resTempGrupo){
	                                    
	                                    $fecha_correspondiente_temp = $resTempGrupo->fecha_temp_lectura_biometrico;
	                                    $cantidad_marcaciones_dia = $resTempGrupo->total;
	                                    
	                                    
	                                    /*$mes_afectacion = substr($fecha_correspondiente_temp, -5, 2);
	                                    $mes_afectacion = (int)$mes_afectacion;
	                                     
	                                     
	                                    $timestamp = strtotime( $fecha_correspondiente_temp );
	                                    $dias_afectacion = date( "t", $timestamp);
	                                    */
	                                  
	                                    
	                                    if($cantidad_marcaciones_dia <>2){
	                                    	

	                                    	$errores=true;
	                                    	 
	                                    	$error_encontrado="Debe Ingresar Horario de Entrada y Salida del Empleado CI: $_identificacion_empleados Nombres: $_nombres_empleados $_apellidos_empleados de la fecha $fecha_correspondiente_temp.";
	                                    	 
	                                    	$funcion = "ins_errores_importacion";
	                                    	$parametros = "'$numero_linea',
	                                    	'$error_encontrado',
	                                    	'$_id_usuarios'";
	                                    	$errores_importacion->setFuncion($funcion);
	                                    	$errores_importacion->setParametros($parametros);
	                                    	$resultado=$errores_importacion->Insert();
	                                    	 
	                                    	
	                                    }
	                                    
	                                    
	                                 //tengo verificado los dias.
	                                    
	                                }
	                                
	                                
	                                
	                                
	                                
	                                if($errores==false){
	                                	
	                                	
	                                	
	                                	
	                                	$columnas_temp1="empleados.id_empleados, count(*) as total";
	                                	$tablas_temp1="public.temp_lectura_biometrico, 
  														public.empleados";
	                                	$where_temp1="empleados.identificacion_empleados = temp_lectura_biometrico.cedula_temp_lectura_biometrico AND empleados.identificacion_empleados='$_identificacion_empleados'
  														GROUP BY empleados.id_empleados";
	                                	$id_temp1="empleados.id_empleados";
	                                	 
	                                	$resultTempGrupo1= $temp_lectura_biometrico->getCondiciones($columnas_temp1,$tablas_temp1,$where_temp1,$id_temp1);
	                                	
	                                	
	                                	foreach ($resultTempGrupo1 as $resTempGrupo1){
	                                		 
	                                		 $id_empleados = $resTempGrupo1->id_empleados;
	                                		 $total = $resTempGrupo1->total;
	                                		 
	                                		 
	                                		 $total=$total/2;
	                                		 $total_dias_trabajados=$total+8;
	                                		 
	                                		
	                                		 
	                                		 
	                                		 $mes_afectacion = substr($fecha_correspondiente_temp, -5, 2);
	                                		 $mes_afectacion = (int)$mes_afectacion;
	                                	
	                                	
	                                		 $timestamp = strtotime( $fecha_correspondiente_temp );
	                                		 $dias_afectacion = date( "t", $timestamp);
	                                		 
	                                		 
	                                		 $total_dias_no_trabajados=$dias_afectacion-$total_dias_trabajados;
	                                		 
	                                		 
	                                		 
	                                		 $funcion = "ins_lectura_biometrico";
	                                		 $parametros = "'$id_empleados',
	                                		 '$mes_afectacion_v',
	                                		 '$anio_afectacion_v',
	                                		 '$total_dias_trabajados',
	                                		 '$total_dias_no_trabajados',
	                                		 '$dias_afectacion'";
	                                		 $_lectura_biometrico->setFuncion($funcion);
	                                		 $_lectura_biometrico->setParametros($parametros);
	                                		 $resultado=$_lectura_biometrico->Insert();
	                                		 
	                                		 
	                                		                 
	                                	}
	                                	
	                                	
	                                	$columnas_hora="temp_lectura_biometrico.hora_temp_lectura_biometrico, 
  														empleados.id_empleados";
	                                	$tablas_hora="public.temp_lectura_biometrico, 
  														public.empleados";
	                                	$where_hora="empleados.identificacion_empleados = temp_lectura_biometrico.cedula_temp_lectura_biometrico AND
 													 hora_temp_lectura_biometrico > '08:10:59' AND  hora_temp_lectura_biometrico < '12:00:00' AND cedula_temp_lectura_biometrico='$_identificacion_empleados'";
	                                	$id_hora="cedula_temp_lectura_biometrico";
	                                	
	                                	$resultTempGrupo2= $temp_lectura_biometrico->getCondiciones($columnas_hora,$tablas_hora,$where_hora,$id_hora);
	                                	
	                                	
	                                	
	                                	if(!empty($resultTempGrupo2)){
	                                		
	                                		foreach ($resultTempGrupo2 as $res){
	                                			
	                                			$_hora_temp=new DateTime($res->hora_temp_lectura_biometrico);
	                                			$_hora_temp=$_hora_temp->format('H:i:s');
	                                			
	                                			
	                                			
	                                			
	                                			$_id_empleados_H=$res->id_empleados;
	                                			
	                                			$_hora_real=new DateTime('08:00:00');
	                                			$_hora_real=$_hora_real->format('H:i:s');
	                                			
	                                			
	                                			
	                                			$atrazos = strtotime($_hora_temp) - strtotime($_hora_real);
	                                			
	                                			
	                                			$atrazos=date("H:i:s", $atrazos); 
	                                			$atrazos = strtotime ( '-1 hour' , strtotime ($atrazos) ) ;
	                                			$atrazos=date("H:i:s", $atrazos);
	                                			
	                                			
	                                			
	                                			$_lectura_biometrico->UpdateBy("atrasos='$atrazos'","lectura_biometrico","id_empleados='$_id_empleados_H'");
	                                			
	                                		}
	                                	}
	                                	
	                                	
	                                	
	                                		
	                                }
	                                
	                                
	                                
	                                
	                                
	                            }else{
	                                
	                                $errores=true;
	                                $error_encontrado="No existen Marcaciones del Empleado CI: $_identificacion_empleados Nombres: $_nombres_empleados $_apellidos_empleados";
	                                $funcion = "ins_errores_importacion";
	                                $parametros = "'0',
							               '$error_encontrado',
							               '$_id_usuarios'";
	                                $errores_importacion->setFuncion($funcion);
	                                $errores_importacion->setParametros($parametros);
	                                $resultado=$errores_importacion->Insert();
	                            }
	                            
	                            
	                            
	                        }
	                        
	                    }else{
	                        
	                        $errores=true;
	                        
	                        $error_encontrado="No existen Empleados Activos Para Registrar Marcaciones.";
	                        
	                        $funcion = "ins_errores_importacion";
	                        $parametros = "'0',
							               '$error_encontrado',
							               '$_id_usuarios'";
	                        $errores_importacion->setFuncion($funcion);
	                        $errores_importacion->setParametros($parametros);
	                        $resultado=$errores_importacion->Insert();
	                    }
	                    
	                    
	                    
	                    
	                    // RECUPERO EL TEMPORAL PARA SEGUIR LA VALIDACION
	                   
	                    /*
	                    
	                    $resultTemp=$temp_lectura_biometrico->getAll("cedula_temp_lectura_biometrico, fecha_temp_lectura_biometrico, hora_temp_lectura_biometrico");
	                    
	                    if(!empty($resultTemp)){
	                        
	                        
	                        
	                        
	                        
	                    }
	                    
	                    */
	                    
	                    
	                    
	                    
	                     
	                 }
	                
	                
	                
	                
	                
	                
	                
	                
	                
	                
	                
	                
	                
	                
	            }else{
	                
	                $errores=true;
	                
	                $error_encontrado="El archivo seleccionado no contiene registros, esta vacio.";
	                
	                $funcion = "ins_errores_importacion";
	                $parametros = "'0',
					'$error_encontrado',
					'$_id_usuarios'";
	                $errores_importacion->setFuncion($funcion);
	                $errores_importacion->setParametros($parametros);
	                $resultado=$errores_importacion->Insert();
	                
	            }
	            
	        }
	        
	        
	        $this->redirect("Procesos", "index");
	        
	        
	    }else{
	        
	        $error = TRUE;
	        $mensaje = "Te sesión a caducado, vuelve a iniciar sesión.";
	        
	        $this->view("Login",array(
	            "resultSet"=>"$mensaje", "error"=>$error
	        ));
	        
	        
	        die();
	        
	    }
	    
	    
	}

	
	
	
	public function is_date($date){
		return (bool)preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date);
	}
	
	public function is_time($time)
	{
	    return (bool)preg_match("/^([0-1][0-9]|[2][0-3])[\:]([0-5][0-9])[\:]([0-5][0-9])$/",$time);
	   
	}
	
	
	
	public function consulta_bitacora_validacion(){
	
		session_start();
		$id_usuarios=$_SESSION["id_usuarios"];
	
	
		 
	
		$errores = new ErroresImportacionModel();
	
		$where_to="";
		$columnas = "errores_importacion.id_errores_importacion,
                      errores_importacion.linea_errores_importacion,
                      errores_importacion.errores_encontrados_importacion,
                      errores_importacion.id_usuarios_registra_carga,
                      errores_importacion.creado,
                      errores_importacion.modificado";
	
		$tablas   = "public.errores_importacion";
	
		$id       = "errores_importacion.id_errores_importacion";
	
	
		$where    = "errores_importacion.id_usuarios_registra_carga='$id_usuarios'";
	
	
	
		$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
		$search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	
	
	
	
		if($action == 'ajax')
		{
	
			if(!empty($search)){
	
	
				$where1=" AND (errores_importacion.errores_encontrados_importacion LIKE '".$search."%')";
	
				$where_to=$where.$where1;
			}else{
	
				$where_to=$where;
	
			}
	
			$html="";
			$resultSet=$errores->getCantidad("*", $tablas, $where_to);
	
			 
	
			$cantidadResult=(int)$resultSet[0]->total;
	
			$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	
			$per_page = 15; //la cantidad de registros que desea mostrar
			$adjacents  = 9; //brecha entre páginas después de varios adyacentes
			$offset = ($page - 1) * $per_page;
	
			$limit = " LIMIT   '$per_page' OFFSET '$offset'";
	
			$resultSet=$errores->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
			$count_query   = $cantidadResult;
			$total_pages = ceil($cantidadResult/$per_page);
	
	
			 
	
			if($cantidadResult>0)
			{
	
				$html.='<div class="pull-left" style="margin-left:11px;">';
				$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
				$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
				$html.='</div>';
				$html.='<div class="col-lg-12 col-md-12 col-xs-12">';
				$html.='<section style="height:425px; overflow-y:scroll;">';
				$html.= "<table id='tabla_bitacora_validacion' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
				$html.= "<thead>";
				$html.= "<tr>";
	
				$html.='<th style="text-align: left;  font-size: 14px;">Línea</th>';
				$html.='<th style="text-align: left;  font-size: 14px;">Descripción del Error</th>';
				$html.='<th style="text-align: left;  font-size: 14px;">Fecha Registro.</th>';
	
				$html.='</tr>';
				$html.='</thead>';
				$html.='<tbody>';
	
				$i=0;
	
	
	
				foreach ($resultSet as $res)
				{
					$i++;
					$html.='<tr>';
					 
					$html.='<td style="font-size: 12px;">'.$res->linea_errores_importacion.'</td>';
					$html.='<td style="font-size: 12px;">'.$res->errores_encontrados_importacion.'</td>';
					$html.='<td style="font-size: 12px;">'.date("d/m/Y", strtotime($res->creado)).'</td>';
					 
					$html.='</tr>';
				}
	
	
				$html.='</tbody>';
				$html.='</table>';
				$html.='</section></div>';
				$html.='<div class="table-pagination pull-right">';
				$html.=''. $this->paginate_bitacora_validacion("index.php", $page, $total_pages, $adjacents).'';
				$html.='</div>';
	
	
	
			}else{
				$html.='<div class="col-lg-6 col-md-6 col-xs-12">';
				$html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
				$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
				$html.='<h4>Aviso!!!</h4> <b>Actualmente no hay errores en tu carga...</b>';
				$html.='</div>';
				$html.='</div>';
			}
	
	
			echo $html;
			die();
	
		}
	
	
	}
	
	public function paginate_bitacora_validacion($reload, $page, $tpages, $adjacents) {
		 
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
		 
		// previous label
		 
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_bitacora_validacion(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_bitacora_validacion(".($page-1).")'>$prevlabel</a></span></li>";
			 
		}
		 
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_bitacora_validacion(1)'>1</a></li>";
		}
		// interval
		if($page>($adjacents+2)) {
			$out.= "<li><a>...</a></li>";
		}
		 
		// pages
		 
		$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
		$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
		for($i=$pmin; $i<=$pmax; $i++) {
			if($i==$page) {
				$out.= "<li class='active'><a>$i</a></li>";
			}else if($i==1) {
				$out.= "<li><a href='javascript:void(0);' onclick='load_bitacora_validacion(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_bitacora_validacion(".$i.")'>$i</a></li>";
			}
		}
		 
		// interval
		 
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
		 
		// last
		 
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_bitacora_validacion($tpages)'>$tpages</a></li>";
		}
		 
		// next
		 
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_bitacora_validacion(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
		 
		$out.= "</ul>";
		return $out;
	}
	
	
	
	
	
	
	
	
	
	
}
?>