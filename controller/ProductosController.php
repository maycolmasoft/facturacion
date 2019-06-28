<?php

class ProductosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$productos=new ProductosModel();
     	$resultSet=$productos->getAll("id_productos");
		
		$resultEdit = "";
	
	
		
		session_start();
        
	
		if (isset(  $_SESSION['nombre_usuarios']) )
		{

			$nombre_controladores = "Productos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $productos->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol'" );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_productos"])   )
				{

					$nombre_controladores = "Productos";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $productos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
					    $_id_productos = $_GET["id_productos"];
						$columnas = " productos.id_productos, 
                                      productos.nombre_productos, 
                                      productos.codigo_productos, 
                                      productos.marca_productos, 
                                      productos.precio_productos, 
                                      productos.creado, 
                                      productos.modificado";
						$tablas   =  "public.productos";
						$where    =  "productos.id_productos = '$_id_productos'"; 
						$id       = "productos.id_productos";
							
						$resultEdit = $productos->getCondiciones($columnas ,$tablas ,$where, $id);

					}
					else
					{
					    $this->view_Core("Error",array(
								"resultado"=>"No tiene Permisos de Editar Productos"
					
						));
					
					
					}
					
				}
		
				
				$this->view_Core("Participes",array(
				    "resultSet"=>$resultSet, "resultEdit" =>$resultEdit,
			
				));
		
				
				
			}
			else
			{
			    $this->view_Core("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Productos"
				
				));
				
				exit();	
			}
				
		}
	else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
	
	}
	
	public function InsertaProductos(){
			
		session_start();
		$productos=new ProductosModel();
		
		

		$nombre_controladores = "Productos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $productos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
		//die("llego");
		
			$resultado = null;
			$productos=new ProductosModel();
		
			if (isset ($_POST["codigo_productos"])   )
			{
			    
			    $_id_productos = $_POST["id_productos"];
			    $_nombre_productos = $_POST["nombre_productos"];
			    $_codigo_productos = $_POST["codigo_productos"];
			    $_marca_productos = $_POST["marca_productos"];
			    $_precio_productos = $_POST["precio_productos"];
			    
			  
			    
			    
			    
			    //die("llego");
			    if($_id_productos > 0){
					
					$columnas =    "id_productos = '$_id_productos',
                                    nombre_productos = '$_nombre_productos',
                                    codigo_productos = '$_codigo_productos',
                                    marca_productos = '$_marca_productos',
                                    precio_productos = '$_precio_productos'";
					
					        $tabla = "public.productos";
					        
					$where = "productos.id_productos = '$_id_productos'";
					
					$resultado=$productos->UpdateBy($columnas, $tabla, $where);
					
				}else{
				    
				    $_id_productos = $_POST["id_productos"];
				    $_nombre_productos =  $_POST["nombre_productos"];
				    $_codigo_productos = $_POST["codigo_productos"];
				    $_marca_productos = $_POST["marca_productos"];
				    $_precio_productos = $_POST["precio_productos"];
				    
					$funcion = "ins_productos";
					
					$parametros = " '$_id_productos',
                                    '$_nombre_productos',
                                    '$_codigo_productos',
                                    '$_marca_productos',
                                    '$_precio_productos'";
					
					$productos->setFuncion($funcion);
					$productos->setParametros($parametros);
					$resultado=$productos->Insert();
				}
				
		
			}
			$this->redirect("Productos", "index");

		}
		else
		{
		    $this->view_Inventario("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Productos"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{
	    
	    session_start();
	    $productos=new ProductosModel();
	    $nombre_controladores = "Productos";
	    $id_rol= $_SESSION['id_rol'];
	    $resultPer = $productos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	    
	    if (!empty($resultPer))
	    {
	        if(isset($_GET["id_productos"]))
	        {
	            $id_productos=(int)$_GET["id_productos"];
	            
	            
	            
	            $productos->deleteBy("id_productos",$id_productos);
	            
	        }
	        
	        $this->redirect("Productos", "index");
	        
	        
	    }
	    else
	    {
	        $this->view_Inventario("Error",array(
	            "resultado"=>"No tiene Permisos de Borrar Productos"
	            
	        ));
	    }
	    
	}
	
	public function consulta_productos_activos(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    
	    $usuarios = new UsuariosModel();
	   
	    
	    $columnas = " productos.id_productos,
                                      productos.nombre_productos,
                                      productos.codigo_productos,
                                      productos.marca_productos,
                                      productos.precio_productos,
                                      productos.creado,
                                      productos.modificado";
	    $tablas   =  "public.productos";
	    $where    =  "productos.id_productos = '$_id_productos'";
	    $id       = "productos.id_productos";
	    
	
	    
	    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    
	    if($action == 'ajax')
	    {
	  
	        
	        
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND (productos.nombre_productos LIKE '".$search."%' )";
	            
	            $where_to=$where.$where1;
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        $html="";
	        $resultSet=$usuarios->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 10; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$usuarios->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
	        $count_query   = $cantidadResult;
	        $total_pages = ceil($cantidadResult/$per_page);
	        
	        
	        
	        
	        
	        if($cantidadResult>0)
	        {
	            
	            $html.='<div class="pull-left" style="margin-left:15px;">';
	            $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	            $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	            $html.='</div>';
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<section style="height:425px; overflow-y:scroll;">';
	            $html.= "<table id='tabla_productos_activos' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Cuidad</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Apellido</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Cedula</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nacimiento</th>';;
	            
	            if($id_rol==1){
	                
	                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	                
	            }
	            
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            
	            $i=0;
	            
	            foreach ($resultSet as $res)
	            {
	                $i++;
	                $html.='<tr>';
	                $html.='<td style="font-size: 11px;">'.$i.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_ciudades.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->apellido_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->cedula_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_nacimiento_participes.'</td>';     
	                
	                
	             
	                
	                if($id_rol==1){
	                    
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Productos&action=index&id_participes='.$res->id_participes.'" class="btn btn-success" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Productos&action=borrarId&id_participes='.$res->id_participes.'" class="btn btn-danger" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
	                    
	                }
	                
	                $html.='</tr>';
	            }
	            
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate_participes_activos("index.php", $page, $total_pages, $adjacents).'';
	            $html.='</div>';
	            
	            
	            
	        }else{
	            $html.='<div class="col-lg-6 col-md-6 col-xs-12">';
	            $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
	            $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	            $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay usuarios registrados...</b>';
	            $html.='</div>';
	            $html.='</div>';
	        }
	        
	        
	        echo $html;
	        die();
	        
	    }
	}
	
	public function consulta_participes_inactivos(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    
	    $usuarios = new UsuariosModel();
	    
	    $estado_participes = null; $estado_participes = new EstadoParticipesModel();
	    $where_to="";
	    $columnas = "core_participes.id_participes,
                                      core_ciudades.id_ciudades,
                                      core_ciudades.nombre_ciudades,
                                      core_participes.apellido_participes,
                                      core_participes.nombre_participes,
                                      core_participes.cedula_participes,
                                      core_participes.fecha_nacimiento_participes,
                                      core_participes.direccion_participes,
                                      core_participes.telefono_participes,
                                      core_participes.celular_participes,
                                      core_participes.fecha_ingreso_participes,
                                      core_participes.fecha_defuncion_participes,
                                      core_estado_participes.id_estado_participes,
                                      core_estado_participes.nombre_estado_participes,
                                      core_estatus.id_estatus,
                                      core_estatus.nombre_estatus,
                                      core_participes.fecha_salida_participes,
                                      core_genero_participes.id_genero_participes,
                                      core_genero_participes.nombre_genero_participes,
                                      core_estado_civil_participes.id_estado_civil_participes,
                                      core_estado_civil_participes.nombre_estado_civil_participes,
                                      core_participes.observacion_participes,
                                      core_participes.correo_participes,
                                      core_entidad_patronal.id_entidad_patronal,
                                      core_entidad_patronal.nombre_entidad_patronal,
                                      core_participes.fecha_entrada_patronal_participes,
                                      core_participes.ocupacion_participes,
                                      core_tipo_instruccion_participes.id_tipo_instruccion_participes,
                                      core_tipo_instruccion_participes.nombre_tipo_instruccion_participes,
                                      core_participes.nombre_conyugue_participes,
                                      core_participes.apellido_esposa_participes,
                                      core_participes.cedula_conyugue_participes,
                                      core_participes.numero_dependencias_participes,
                                      core_participes.codigo_alternativo_participes,
                                      core_participes.fecha_numero_orden_participes,
                                      core_participes.creado,
                                      core_participes.modificado";
	    
	    $tablas = "public.core_participes,
                                      public.core_ciudades,
                                      public.core_estado_participes,
                                      public.core_estatus,
                                      public.core_genero_participes,
                                      public.core_estado_civil_participes,
                                      public.core_entidad_patronal,
                                      public.core_tipo_instruccion_participes";
	    
	    
	    $where    = "core_participes.id_tipo_instruccion_participes = core_tipo_instruccion_participes.id_tipo_instruccion_participes AND
                                      core_ciudades.id_ciudades = core_participes.id_ciudades AND
                                      core_estado_participes.id_estado_participes = core_participes.id_estado_participes AND
                                      core_estatus.id_estatus = core_participes.id_estatus AND
                                      core_genero_participes.id_genero_participes = core_participes.id_genero_participes AND
                                      core_estado_civil_participes.id_estado_civil_participes = core_participes.id_estado_civil_participes AND
                                      core_entidad_patronal.id_entidad_patronal = core_participes.id_entidad_patronal AND core_estado_participes.nombre_estado_participes = 'Inactivo'";
	    
	    $id       = "core_participes.id_participes";
	    
	    
	    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    
	    if($action == 'ajax')
	    {
	    
	        $whereestado = "nombre_estado_participes = 'Inactivo'";
	        $resultEstado = $estado_participes->getCondiciones('nombre_estado_participes' ,'public.core_estado_participes' , $whereestado , 'nombre_estado_participes');
	        
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND (core_participes.nombre_participes LIKE '".$search."%' )";
	            
	            $where_to=$where.$where1;
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        $html="";
	        $resultSet=$usuarios->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 10; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$usuarios->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
	        $count_query   = $cantidadResult;
	        $total_pages = ceil($cantidadResult/$per_page);
	        
	        
	        
	        if($cantidadResult>0)
	        {
	            
	            $html.='<div class="pull-left" style="margin-left:15px;">';
	            $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	            $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	            $html.='</div>';
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<section style="height:425px; overflow-y:scroll;">';
	            $html.= "<table id='tabla_participes_inactivos' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Cuidad</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Apellido</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Cedula</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nacimiento</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Direeción</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Telefono</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Celular</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Ingreso</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Defunción </th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Estatus</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Salida</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Genero</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Estado Civil</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Observación</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Correo</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Entidad</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Fecha Entrada</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Ocupación</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Tipo Instrucción</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Conyugue</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Apellido Conyugue</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Cedula Conyugue</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;"># Dependencias</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Código</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;"># Orden</th>';
	            if($id_rol==1){
	                
	                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	                
	            }
	            
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            
	            $i=0;
	            
	            foreach ($resultSet as $res)
	            {
	                $i++;
	                $html.='<tr>';
	                $html.='<td style="font-size: 11px;">'.$i.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_ciudades.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->apellido_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->cedula_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_nacimiento_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->direccion_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->telefono_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->celular_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_ingreso_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_defuncion_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_estado_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_estatus.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_salida_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_genero_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_estado_civil_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->observacion_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->correo_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_entidad_patronal.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_entrada_patronal_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->ocupacion_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_tipo_instruccion_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_conyugue_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->apellido_esposa_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->cedula_conyugue_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->numero_dependencias_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->codigo_alternativo_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_numero_orden_participes.'</td>';
	                
	                
	                if($id_rol==1){
	                    
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Participes&action=index&id_participes='.$res->id_participes.'" class="btn btn-success" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Participes&action=borrarId&id_participes='.$res->id_participes.'" class="btn btn-danger" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
	                    
	                }
	                
	                $html.='</tr>';
	            }
	            
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate_participes_inactivos("index.php", $page, $total_pages, $adjacents).'';
	            $html.='</div>';
	            
	            
	            
	        }else{
	            $html.='<div class="col-lg-6 col-md-6 col-xs-12">';
	            $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
	            $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	            $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay usuarios registrados...</b>';
	            $html.='</div>';
	            $html.='</div>';
	        }
	        
	        
	        echo $html;
	        die();
	        
	    }
	}
	
	public function consulta_participes_desafiliado(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    
	    $usuarios = new UsuariosModel();
	    
	    $estado_participes = null; $estado_participes = new EstadoParticipesModel();
	    $where_to="";
	    $columnas = "core_participes.id_participes,
                                      core_ciudades.id_ciudades,
                                      core_ciudades.nombre_ciudades,
                                      core_participes.apellido_participes,
                                      core_participes.nombre_participes,
                                      core_participes.cedula_participes,
                                      core_participes.fecha_nacimiento_participes,
                                      core_participes.direccion_participes,
                                      core_participes.telefono_participes,
                                      core_participes.celular_participes,
                                      core_participes.fecha_ingreso_participes,
                                      core_participes.fecha_defuncion_participes,
                                      core_estado_participes.id_estado_participes,
                                      core_estado_participes.nombre_estado_participes,
                                      core_estatus.id_estatus,
                                      core_estatus.nombre_estatus,
                                      core_participes.fecha_salida_participes,
                                      core_genero_participes.id_genero_participes,
                                      core_genero_participes.nombre_genero_participes,
                                      core_estado_civil_participes.id_estado_civil_participes,
                                      core_estado_civil_participes.nombre_estado_civil_participes,
                                      core_participes.observacion_participes,
                                      core_participes.correo_participes,
                                      core_entidad_patronal.id_entidad_patronal,
                                      core_entidad_patronal.nombre_entidad_patronal,
                                      core_participes.fecha_entrada_patronal_participes,
                                      core_participes.ocupacion_participes,
                                      core_tipo_instruccion_participes.id_tipo_instruccion_participes,
                                      core_tipo_instruccion_participes.nombre_tipo_instruccion_participes,
                                      core_participes.nombre_conyugue_participes,
                                      core_participes.apellido_esposa_participes,
                                      core_participes.cedula_conyugue_participes,
                                      core_participes.numero_dependencias_participes,
                                      core_participes.codigo_alternativo_participes,
                                      core_participes.fecha_numero_orden_participes,
                                      core_participes.creado,
                                      core_participes.modificado";
	    
	    $tablas = "public.core_participes,
                                      public.core_ciudades,
                                      public.core_estado_participes,
                                      public.core_estatus,
                                      public.core_genero_participes,
                                      public.core_estado_civil_participes,
                                      public.core_entidad_patronal,
                                      public.core_tipo_instruccion_participes";
	    
	    
	    $where    = "core_participes.id_tipo_instruccion_participes = core_tipo_instruccion_participes.id_tipo_instruccion_participes AND
                                      core_ciudades.id_ciudades = core_participes.id_ciudades AND
                                      core_estado_participes.id_estado_participes = core_participes.id_estado_participes AND
                                      core_estatus.id_estatus = core_participes.id_estatus AND
                                      core_genero_participes.id_genero_participes = core_participes.id_genero_participes AND
                                      core_estado_civil_participes.id_estado_civil_participes = core_participes.id_estado_civil_participes AND
                                      core_entidad_patronal.id_entidad_patronal = core_participes.id_entidad_patronal AND core_estado_participes.nombre_estado_participes = 'Desafiliado'";
	    
	    $id       = "core_participes.id_participes";
	    
	    
	    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    
	    if($action == 'ajax')
	    {
	        
	        $whereestado = "nombre_estado_participes = 'Desafiliado'";
	        $resultEstado = $estado_participes->getCondiciones('nombre_estado_participes' ,'public.core_estado_participes' , $whereestado , 'nombre_estado_participes');
	        
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND (core_participes.nombre_participes LIKE '".$search."%' )";
	            
	            $where_to=$where.$where1;
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        $html="";
	        $resultSet=$usuarios->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 10; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$usuarios->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
	        $count_query   = $cantidadResult;
	        $total_pages = ceil($cantidadResult/$per_page);
	        
	        
	        
	        if($cantidadResult>0)
	        {
	            
	            $html.='<div class="pull-left" style="margin-left:15px;">';
	            $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	            $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	            $html.='</div>';
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<section style="height:425px; overflow-y:scroll;">';
	            $html.= "<table id='tabla_participes_desafiliado' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Cuidad</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Apellido</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Cedula</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nacimiento</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Direeción</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Telefono</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Celular</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Ingreso</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Defunción </th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Estatus</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Salida</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Genero</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Estado Civil</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Observación</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Correo</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Entidad</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Fecha Entrada</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Ocupación</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Tipo Instrucción</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Conyugue</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Apellido Conyugue</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Cedula Conyugue</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;"># Dependencias</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Código</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;"># Orden</th>';
	            if($id_rol==1){
	                
	                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	                
	            }
	            
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            
	            $i=0;
	            
	            foreach ($resultSet as $res)
	            {
	                $i++;
	                $html.='<tr>';
	                $html.='<td style="font-size: 11px;">'.$i.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_ciudades.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->apellido_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->cedula_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_nacimiento_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->direccion_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->telefono_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->celular_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_ingreso_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_defuncion_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_estado_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_estatus.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_salida_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_genero_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_estado_civil_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->observacion_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->correo_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_entidad_patronal.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_entrada_patronal_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->ocupacion_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_tipo_instruccion_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_conyugue_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->apellido_esposa_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->cedula_conyugue_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->numero_dependencias_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->codigo_alternativo_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_numero_orden_participes.'</td>';
	                
	                
	                if($id_rol==1){
	                    
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Participes&action=index&id_participes='.$res->id_participes.'" class="btn btn-success" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Participes&action=borrarId&id_participes='.$res->id_participes.'" class="btn btn-danger" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
	                    
	                }
	                
	                $html.='</tr>';
	            }
	            
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate_participes_desafiliado("index.php", $page, $total_pages, $adjacents).'';
	            $html.='</div>';
	            
	            
	            
	        }else{
	            $html.='<div class="col-lg-6 col-md-6 col-xs-12">';
	            $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
	            $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	            $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay usuarios registrados...</b>';
	            $html.='</div>';
	            $html.='</div>';
	        }
	        
	        
	        echo $html;
	        die();
	        
	    }
	}
	
	public function consulta_participes_liquidado_cesante(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    
	    $usuarios = new UsuariosModel();
	    
	    $estado_participes = null; $estado_participes = new EstadoParticipesModel();
	    $where_to="";
	    $columnas = "core_participes.id_participes,
                                      core_ciudades.id_ciudades,
                                      core_ciudades.nombre_ciudades,
                                      core_participes.apellido_participes,
                                      core_participes.nombre_participes,
                                      core_participes.cedula_participes,
                                      core_participes.fecha_nacimiento_participes,
                                      core_participes.direccion_participes,
                                      core_participes.telefono_participes,
                                      core_participes.celular_participes,
                                      core_participes.fecha_ingreso_participes,
                                      core_participes.fecha_defuncion_participes,
                                      core_estado_participes.id_estado_participes,
                                      core_estado_participes.nombre_estado_participes,
                                      core_estatus.id_estatus,
                                      core_estatus.nombre_estatus,
                                      core_participes.fecha_salida_participes,
                                      core_genero_participes.id_genero_participes,
                                      core_genero_participes.nombre_genero_participes,
                                      core_estado_civil_participes.id_estado_civil_participes,
                                      core_estado_civil_participes.nombre_estado_civil_participes,
                                      core_participes.observacion_participes,
                                      core_participes.correo_participes,
                                      core_entidad_patronal.id_entidad_patronal,
                                      core_entidad_patronal.nombre_entidad_patronal,
                                      core_participes.fecha_entrada_patronal_participes,
                                      core_participes.ocupacion_participes,
                                      core_tipo_instruccion_participes.id_tipo_instruccion_participes,
                                      core_tipo_instruccion_participes.nombre_tipo_instruccion_participes,
                                      core_participes.nombre_conyugue_participes,
                                      core_participes.apellido_esposa_participes,
                                      core_participes.cedula_conyugue_participes,
                                      core_participes.numero_dependencias_participes,
                                      core_participes.codigo_alternativo_participes,
                                      core_participes.fecha_numero_orden_participes,
                                      core_participes.creado,
                                      core_participes.modificado";
	    
	    $tablas = "public.core_participes,
                                      public.core_ciudades,
                                      public.core_estado_participes,
                                      public.core_estatus,
                                      public.core_genero_participes,
                                      public.core_estado_civil_participes,
                                      public.core_entidad_patronal,
                                      public.core_tipo_instruccion_participes";
	    
	    
	    $where    = "core_participes.id_tipo_instruccion_participes = core_tipo_instruccion_participes.id_tipo_instruccion_participes AND
                                      core_ciudades.id_ciudades = core_participes.id_ciudades AND
                                      core_estado_participes.id_estado_participes = core_participes.id_estado_participes AND
                                      core_estatus.id_estatus = core_participes.id_estatus AND
                                      core_genero_participes.id_genero_participes = core_participes.id_genero_participes AND
                                      core_estado_civil_participes.id_estado_civil_participes = core_participes.id_estado_civil_participes AND
                                      core_entidad_patronal.id_entidad_patronal = core_participes.id_entidad_patronal AND core_estado_participes.nombre_estado_participes = 'Liquidado Cesante'";
	    
	    $id       = "core_participes.id_participes";
	    
	    
	    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    
	    if($action == 'ajax')
	    {
	        
	        $whereestado = "nombre_estado_participes = 'Liquidado Cesante'";
	        $resultEstado = $estado_participes->getCondiciones('nombre_estado_participes' ,'public.core_estado_participes' , $whereestado , 'nombre_estado_participes');
	        
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND (core_participes.nombre_participes LIKE '".$search."%' )";
	            
	            $where_to=$where.$where1;
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        $html="";
	        $resultSet=$usuarios->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 10; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$usuarios->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
	        $count_query   = $cantidadResult;
	        $total_pages = ceil($cantidadResult/$per_page);
	        
	        
	        
	        if($cantidadResult>0)
	        {
	            
	            $html.='<div class="pull-left" style="margin-left:15px;">';
	            $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	            $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	            $html.='</div>';
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<section style="height:425px; overflow-y:scroll;">';
	            $html.= "<table id='tabla_participes_liquidado_cesante' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Cuidad</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Apellido</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Cedula</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nacimiento</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Direeción</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Telefono</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Celular</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Ingreso</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Defunción </th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Estatus</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Salida</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Genero</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Estado Civil</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Observación</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Correo</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Entidad</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Fecha Entrada</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Ocupación</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Tipo Instrucción</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Conyugue</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Apellido Conyugue</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Cedula Conyugue</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;"># Dependencias</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Código</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;"># Orden</th>';
	            if($id_rol==1){
	                
	                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	                
	            }
	            
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            
	            $i=0;
	            
	            foreach ($resultSet as $res)
	            {
	                $i++;
	                $html.='<tr>';
	                $html.='<td style="font-size: 11px;">'.$i.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_ciudades.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->apellido_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->cedula_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_nacimiento_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->direccion_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->telefono_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->celular_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_ingreso_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_defuncion_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_estado_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_estatus.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_salida_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_genero_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_estado_civil_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->observacion_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->correo_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_entidad_patronal.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_entrada_patronal_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->ocupacion_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_tipo_instruccion_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_conyugue_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->apellido_esposa_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->cedula_conyugue_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->numero_dependencias_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->codigo_alternativo_participes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_numero_orden_participes.'</td>';
	                
	                
	                if($id_rol==1){
	                    
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Participes&action=index&id_participes='.$res->id_participes.'" class="btn btn-success" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Participes&action=borrarId&id_participes='.$res->id_participes.'" class="btn btn-danger" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
	                    
	                }
	                
	                $html.='</tr>';
	            }
	            
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate_participes_liquidado_cesante("index.php", $page, $total_pages, $adjacents).'';
	            $html.='</div>';
	            
	            
	            
	        }else{
	            $html.='<div class="col-lg-6 col-md-6 col-xs-12">';
	            $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
	            $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	            $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay usuarios registrados...</b>';
	            $html.='</div>';
	            $html.='</div>';
	        }
	        
	        
	        echo $html;
	        die();
	        
	    }
	}
	
	
	
	
	public function paginate_participes_activos($reload, $page, $tpages, $adjacents) {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_participes_activos(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_participes_activos(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_participes_activos(1)'>1</a></li>";
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
	            $out.= "<li><a href='javascript:void(0);' onclick='load_participes_activos(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_participes_activos(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_participes_activos($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_participes_activos(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}
	
	
	
	public function paginate_participes_inactivos($reload, $page, $tpages, $adjacents) {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_participes_inactivos(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_participes_inactivos(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_participes_inactivos(1)'>1</a></li>";
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
	            $out.= "<li><a href='javascript:void(0);' onclick='load_participes_inactivos(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_participes_inactivos(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_participes_inactivos($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_participes_inactivos(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}
	
	public function paginate_participes_desafiliado($reload, $page, $tpages, $adjacents) {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_participes_desafiliado(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_participes_desafiliado(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_participes_desafiliado(1)'>1</a></li>";
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
	            $out.= "<li><a href='javascript:void(0);' onclick='load_participes_desafiliado(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_participes_desafiliado(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_participes_desafiliado($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_participes_desafiliado(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}
	
	public function paginate_participes_liquidado_cesante($reload, $page, $tpages, $adjacents) {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_participes_liquidado_cesante(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_participes_liquidado_cesante(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_participes_liquidado_cesante(1)'>1</a></li>";
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
	            $out.= "<li><a href='javascript:void(0);' onclick='load_participes_liquidado_cesante(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_participes_liquidado_cesante(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_participes_liquidado_cesante($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_participes_liquidado_cesante(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}
	
	
	/**
	 * mod: compras
	 * title: carga_grupos
	 * ajax: si
	 */
	
	public function carga_grupos(){
	    
	    $grupos = null;
	    $grupos = new GruposModel();
	    
	    $resulset = $grupos->getAll("id_grupos");
	    
	    if(!empty($resulset)){
	        if(is_array($resulset) && count($resulset)>0){
	            echo json_encode($resulset);
	        }
	    }
	}
	
	
	
	/**
	 * mod: compras
	 * title: carga_unidadmedida
	 * ajax: si
	 */
	
	public function carga_unidadmedida(){
	    
	    $grupos = null;
	    $grupos = new GruposModel();
	    
	    $resulset = $grupos->getCondiciones("*","public.unidad_medida","1=1","id_unidad_medida");
	    
	    if(!empty($resulset)){
	        if(is_array($resulset) && count($resulset)>0){
	            echo json_encode($resulset);
	        }
	    }
	}
	
}
?>