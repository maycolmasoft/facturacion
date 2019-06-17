<?php
class AsignacionEmpleadosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function index10(){
    
    	session_start();
    	$id_rol=$_SESSION["id_rol"];
    	$empleados = new EmpleadosModel();
    	$where_to="";
    	$columnas = " 
		    		  empleados.id_empleados,
		    		  empleados.identificacion_empleados, 
					  empleados.apellidos_empleados, 
					  empleados.nombres_empleados, 
					  empleados.direccion_empleados, 
					  empleados.telefono_empleados, 
					  empleados.celular_empleados, 
					  empleados.correo_empleados, 
					  empleados.fecha_nacimiento_empleados, 
					  empleados.numero_hijos_empleados, 
					  empleados.fecha_empieza_a_laborar,
  					  departamentos.nombre_departamentos";
    	
    	$tablas   = "public.empleados, public.departamentos";
    	
    	$id       = "empleados.id_empleados";
    	
    	
    	$where    = "empleados.id_departamentos = departamentos.id_departamentos AND empleados.id_estado=1 AND empleados.id_empleados not in (select asignacion_empleados_cargos.id_empleados from asignacion_empleados_cargos)";
					    	
    	 
    	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    	$search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
    	 
    	 
    	 
    	if($action == 'ajax')
    	{
    
    		if(!empty($search)){
    
    			$where1=" AND (empleados.identificacion_empleados LIKE '".$search."%' OR empleados.apellidos_empleados LIKE '".$search."%' OR empleados.nombres_empleados LIKE '".$search."%' OR empleados.correo_empleados LIKE '".$search."%' OR departamentos.nombre_departamentos LIKE '".$search."%')";
    			$where_to=$where.$where1;
    
    		}else{
    
    			$where_to=$where;
    
    		}
    
    		$html="";
    		$resultSet=$empleados->getCantidad("*", $tablas, $where_to);
    		$cantidadResult=(int)$resultSet[0]->total;
    
    		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    
    		$per_page = 10; //la cantidad de registros que desea mostrar
    		$adjacents  = 9; //brecha entre páginas después de varios adyacentes
    		$offset = ($page - 1) * $per_page;
    
    		$limit = " LIMIT   '$per_page' OFFSET '$offset'";
    
    		$resultSet=$empleados->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
    		$count_query   = $cantidadResult;
    		$total_pages = ceil($cantidadResult/$per_page);
    
    		 
    
    		if($cantidadResult>0)
    		{
    
    			$html.='<div class="pull-left" style="margin-left:11px;">';
    			$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
    			$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
    			$html.='</div>';
    			$html.='<div class="col-lg-12 col-md-12 col-xs-12">';
    			$html.='<section style="height:400px; overflow-y:scroll;">';
    			$html.= "<table id='tabla_empleados' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
    			$html.= "<thead>";
    			$html.= "<tr>";
    			$html.='<th style="text-align: left;  font-size: 12px;">Ci / Ruc</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Apellidos y Nombres</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Correo</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Fecha Nac</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Celular</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Departamento</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Fecha Empieza Labores</th>';
    
    			
    			if($id_rol==1){
    				 
    				$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    					 
    			}else{
    				 
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
    				$html.='<td style="font-size: 11px;">'.$res->identificacion_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->apellidos_empleados.' '.$res->nombres_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->correo_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->fecha_nacimiento_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->celular_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_departamentos.'</td>';
    				$html.='<td style="font-size: 11px;">'.date("d/m/Y", strtotime($res->fecha_empieza_a_laborar)).'</td>';
    				 
    				if($id_rol==1){
    					 
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=AsignacionEmpleados&action=index&id_empleados='.$res->id_empleados.'" class="btn btn-success" title="Asignar" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    					 
    				}else{
    					 
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=AsignacionEmpleados&action=index&id_empleados='.$res->id_empleados.'" class="btn btn-success" title="Asignar" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    					
    				}
    				 
    				$html.='</tr>';
    			
    			}
    
    
    			$html.='</tbody>';
    			$html.='</table>';
    			$html.='</section></div>';
    			$html.='<div class="table-pagination pull-right">';
    			$html.=''. $this->paginate_empleados_activos("index.php", $page, $total_pages, $adjacents).'';
    			$html.='</div>';
    
    			 
    		}else{
    			$html.='<div class="col-lg-6 col-md-6 col-xs-12">';
    			$html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
    			$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    			$html.='<h4>Aviso!!!</h4> <b>Actualmente no hay empleados para asignar rubros...</b>';
    			$html.='</div>';
    			$html.='</div>';
    		}
    		 
    		 
    		echo $html;
    		die();
    
    	}
    
    
    }
    
    
    
    public function  index11(){
    	
    	session_start();
    	$id_rol=$_SESSION["id_rol"];
    	$empleados = new EmpleadosModel();
    	$where_to="";
    	$columnas = " empleados.identificacion_empleados, 
					  empleados.apellidos_empleados, 
					  empleados.nombres_empleados, 
					  empleados.direccion_empleados, 
					  empleados.telefono_empleados, 
					  empleados.celular_empleados, 
					  empleados.correo_empleados, 
					  empleados.fecha_nacimiento_empleados, 
					  empleados.numero_hijos_empleados, 
					  empleados.fecha_empieza_a_laborar, 
					  departamentos.nombre_departamentos, 
					  usuarios.cedula_usuarios, 
					  usuarios.nombre_usuarios, 
					  asignacion_empleados_cargos.id_asignacion_empleados_cargos, 
					  cargos_departamentos.nombre_cargo_departamentos, 
					  cargos_departamentos.valor_sueldo_cargo_departamentos";
    	 
    	$tablas   = "public.asignacion_empleados_cargos, 
					  public.empleados, 
					  public.departamentos, 
					  public.usuarios, 
					  public.cargos_departamentos";
    	 
    	$id       = "empleados.id_empleados";
    	 
    	 
    	$where    = "asignacion_empleados_cargos.id_cargos_departamentos = cargos_departamentos.id_cargos_departamentos AND
				  empleados.id_empleados = asignacion_empleados_cargos.id_empleados AND
				  empleados.id_departamentos = departamentos.id_departamentos AND
				  usuarios.id_usuarios = asignacion_empleados_cargos.id_usuarios AND empleados.id_estado=1";
    	
    	
    	
    	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    	$search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
    	
    	
    	
    	
    	if($action == 'ajax')
    	{
    	
    		if(!empty($search)){
    	
    			$where1=" AND (empleados.identificacion_empleados LIKE '".$search."%' OR empleados.apellidos_empleados LIKE '".$search."%' OR empleados.nombres_empleados LIKE '".$search."%' OR empleados.correo_empleados LIKE '".$search."%' OR departamentos.nombre_departamentos LIKE '".$search."%')";
    			
    			$where_to=$where.$where1;
    		}else{
    	
    			$where_to=$where;
    	
    		}
    	
    		$html="";
    		$resultSet=$empleados->getCantidad("*", $tablas, $where_to);
    		$cantidadResult=(int)$resultSet[0]->total;
    	
    		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    	
    		$per_page = 10; //la cantidad de registros que desea mostrar
    		$adjacents  = 9; //brecha entre páginas después de varios adyacentes
    		$offset = ($page - 1) * $per_page;
    	
    		$limit = " LIMIT   '$per_page' OFFSET '$offset'";
    	
    		$resultSet=$empleados->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
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
    			$html.= "<table id='tabla_clientes' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
    			$html.= "<thead>";
    			$html.= "<tr>";
    			$html.='<th style="text-align: left;  font-size: 12px;">Ci / Ruc</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Apellidos y Nombres</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Correo</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Celular</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Departamento</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Fecha Empieza Labores</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Cargo</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Sueldo</th>';
    			 
    			
    			
    			
    			if($id_rol==1){
    					
    				$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    					
    			}else{
    					
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
    				$html.='<td style="font-size: 11px;">'.$res->identificacion_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->apellidos_empleados.' '.$res->nombres_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->correo_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->celular_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_departamentos.'</td>';
    				$html.='<td style="font-size: 11px;">'.date("d/m/Y", strtotime($res->fecha_empieza_a_laborar)).'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_cargo_departamentos.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->valor_sueldo_cargo_departamentos.'</td>';
    				
    				
    				if($id_rol==1){
    				
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=AsignacionEmpleados&action=index&id_asignacion_empleados_cargos='.$res->id_asignacion_empleados_cargos.'" class="btn btn-success" title="Editar" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    						
    				
    				}else{
    				
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=AsignacionEmpleados&action=index&id_asignacion_empleados_cargos='.$res->id_asignacion_empleados_cargos.'" class="btn btn-success" title="Editar" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    						
    				}
    					
    				$html.='</tr>';
    			}
    	
    	
    			$html.='</tbody>';
    			$html.='</table>';
    			$html.='</section></div>';
    			$html.='<div class="table-pagination pull-right">';
    			$html.=''. $this->paginate_empleados_inactivos("index.php", $page, $total_pages, $adjacents).'';
    			$html.='</div>';
    	
    	
    	
    		}else{
    			$html.='<div class="col-lg-6 col-md-6 col-xs-12">';
    			$html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
    			$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    			$html.='<h4>Aviso!!!</h4> <b>Actualmente no hay empleados con rubros asignados...</b>';
    			$html.='</div>';
    			$html.='</div>';
    		}
    		 
    		 
    		echo $html;
    		die();
    	
    	}
    	
    	
    	
    	
    }
    
    
  
    
		public function index(){
	
		session_start();
		if (isset(  $_SESSION['id_usuarios']) )
		{
			
			$empleados = new EmpleadosModel();
			
			$asignacion_empleados = new AsignacionEmpleadosModel();
			$cargos = new CargosDepartamentosModel();
			$departamentos = new DepartamentosModel();
			$resultDepa=$departamentos->getAll("nombre_departamentos");
			
				
			
			$nombre_controladores = "AsignacionEmpleados";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $asignacion_empleados->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
					$resultEdit = "";
					$resultEdit1 = "";
					$resultCar = "";
			
					if (isset ($_GET["id_empleados"])   )
					{
						$_id_empleados = $_GET["id_empleados"];
						
						$columnas = "empleados.id_empleados, 
									  tipo_identificacion.id_tipo_identificacion, 
									  tipo_identificacion.nombre_tipo_identificacion, 
									  empleados.identificacion_empleados, 
									  empleados.apellidos_empleados, 
									  empleados.nombres_empleados, 
									  provincias.id_provincias, 
									  provincias.nombre_provincias, 
									  cantones.id_cantones, 
									  cantones.nombre_cantones, 
									  parroquias.id_parroquias, 
									  parroquias.nombre_parroquias, 
									  empleados.direccion_empleados, 
									  empleados.telefono_empleados, 
									  empleados.celular_empleados, 
									  empleados.correo_empleados, 
									  empleados.fecha_nacimiento_empleados, 
									  sexo.id_sexo, 
									  sexo.nombre_sexo, 
									  estado.id_estado, 
									  estado.nombre_estado, 
									  departamentos.id_departamentos, 
									  departamentos.nombre_departamentos, 
									  estado_civil.id_estado_civil, 
									  estado_civil.nombre_estado_civil, 
									  empleados.numero_hijos_empleados, 
									  empleados.creado,
								      empleados.fecha_empieza_a_laborar";
						
						$tablas   = "public.empleados, 
									  public.estado_civil, 
									  public.sexo, 
									  public.tipo_identificacion, 
									  public.departamentos, 
									  public.provincias, 
									  public.cantones, 
									  public.parroquias, 
									  public.estado";
						
						$id       = "empleados.id_empleados";
						
						
						$where    = " empleados.id_tipo_identificacion = tipo_identificacion.id_tipo_identificacion AND
								  empleados.id_provincias = provincias.id_provincias AND
								  empleados.id_cantones = cantones.id_cantones AND
								  empleados.id_parroquias = parroquias.id_parroquias AND
								  empleados.id_sexo = sexo.id_sexo AND
								  empleados.id_estado = estado.id_estado AND
								  empleados.id_departamentos = departamentos.id_departamentos AND
								  empleados.id_estado_civil = estado_civil.id_estado_civil AND empleados.id_empleados = '$_id_empleados' "; 
						$resultEdit = $empleados->getCondiciones($columnas ,$tablas ,$where, $id); 
					
						
						if(!empty($resultEdit)){
							
							$_id_departamentos     =$resultEdit[0]->id_departamentos;
							
								if($_id_departamentos>0){
									
									$resultCar=$cargos->getBy("id_departamentos='$_id_departamentos'");
										
								}
						}
					
						
						
					}
					
					
					if (isset ($_GET["id_asignacion_empleados_cargos"])   )
					{
						$_id_asignacion_empleados_cargos = $_GET["id_asignacion_empleados_cargos"];
					
						$columnas = "empleados.id_empleados, 
								  empleados.identificacion_empleados, 
								  empleados.apellidos_empleados, 
								  empleados.nombres_empleados, 
								  empleados.direccion_empleados, 
								  empleados.celular_empleados, 
								  empleados.telefono_empleados, 
								  empleados.correo_empleados, 
								  empleados.fecha_nacimiento_empleados, 
								  empleados.fecha_empieza_a_laborar, 
								  departamentos.id_departamentos, 
								  departamentos.nombre_departamentos, 
								  cargos_departamentos.id_cargos_departamentos, 
								  cargos_departamentos.nombre_cargo_departamentos, 
								  cargos_departamentos.valor_sueldo_cargo_departamentos";
					
						$tablas   = " public.empleados, 
									  public.asignacion_empleados_cargos, 
									  public.cargos_departamentos, 
									  public.departamentos";
					
						$id       = "empleados.id_empleados";
					
					
						$where    = " empleados.id_departamentos = departamentos.id_departamentos AND
							  asignacion_empleados_cargos.id_empleados = empleados.id_empleados AND
							  cargos_departamentos.id_cargos_departamentos = asignacion_empleados_cargos.id_cargos_departamentos AND asignacion_empleados_cargos.id_asignacion_empleados_cargos = '$_id_asignacion_empleados_cargos' ";
						$resultEdit1 = $empleados->getCondiciones($columnas ,$tablas ,$where, $id);
					
					
						if(!empty($resultEdit1)){
								
							$_id_departamentos     =$resultEdit1[0]->id_departamentos;
								
							if($_id_departamentos>0){
									
								$resultCar=$cargos->getBy("id_departamentos='$_id_departamentos'");
						
							}
						}
					
					
					}
			
					
					$this->view("AsignacionEmpleados",array(
							"resultEdit" =>$resultEdit, "resultEdit1" =>$resultEdit1, "resultDepa"=>$resultDepa,
							"resultCar"=>$resultCar
					
					));
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Asignación Empleados"
			
				));
			
			}
			
		
		}
		else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
		
	}
	
	
	
	
	
	
	
	
	public function InsertaAsignacionEmpleados(){
			
		session_start();
		
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
		$asignacion_empleados=new AsignacionEmpleadosModel();
			
		if (isset ($_POST["id_empleados"]))
		{
		
			$_id_empleados                = $_POST["id_empleados"];
			 $_id_cargos_departamentos    = $_POST["id_cargos_departamentos"];
			 $_id_usuarios                = $_SESSION["id_usuarios"];
		    
		    if($_id_empleados > 0){
		    	
		    		
		    	$funcion = "ins_asignacion_empleados_cargos";
		    	$parametros = "'$_id_empleados',
		    	'$_id_usuarios',
		    	'$_id_cargos_departamentos'";
		    	$asignacion_empleados->setFuncion($funcion);
		    	$asignacion_empleados->setParametros($parametros);
		    	$resultado=$asignacion_empleados->Insert();
		    		 
		    	
		    }
		  
		   
		    $this->redirect("AsignacionEmpleados", "index");
		}
		
	   }else{
	   	
	   	$error = TRUE;
	   	$mensaje = "Te sesión a caducado, vuelve a iniciar sesión.";
	   		
	   	$this->view("Login",array(
	   			"resultSet"=>"$mensaje", "error"=>$error
	   	));
	   		
	   		
	   	die();
	   	
	   }
	}
	
	
	
	
	

	public function ActualizaAsignacionEmpleados(){
			
		session_start();
	
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
			$asignacion_empleados=new AsignacionEmpleadosModel();
				
			if (isset ($_POST["id_empleados"]))
			{
	
				$_id_empleados                = $_POST["id_empleados"];
				$_id_cargos_departamentos    = $_POST["id_cargos_departamentos"];
				$_id_usuarios                = $_SESSION["id_usuarios"];
	
				if($_id_empleados > 0){
					 
	
					$funcion = "ins_asignacion_empleados_cargos";
					$parametros = "'$_id_empleados',
					'$_id_usuarios',
					'$_id_cargos_departamentos'";
					$asignacion_empleados->setFuncion($funcion);
					$asignacion_empleados->setParametros($parametros);
					$resultado=$asignacion_empleados->Insert();
			   
					 
				}
	
				 
				$this->redirect("AsignacionEmpleados", "index");
			}
	
		}else{
		  
			$error = TRUE;
			$mensaje = "Te sesión a caducado, vuelve a iniciar sesión.";
	
			$this->view("Login",array(
					"resultSet"=>"$mensaje", "error"=>$error
			));
	
	
			die();
		  
		}
	}
	
	
	
	
	
	
	
	
	public function paginate_empleados_activos($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_empleados_activos(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_empleados_activos(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_empleados_activos(1)'>1</a></li>";
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
				$out.= "<li><a href='javascript:void(0);' onclick='load_empleados_activos(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_empleados_activos(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_empleados_activos($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_empleados_activos(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	
	
	
	

	public function paginate_empleados_inactivos($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_empleados_inactivos(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_empleados_inactivos(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_empleados_inactivos(1)'>1</a></li>";
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
				$out.= "<li><a href='javascript:void(0);' onclick='load_empleados_inactivos(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_empleados_inactivos(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_empleados_inactivos($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_empleados_inactivos(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	
	


	public function  consulta_salarios(){
		 
		session_start();
		$_id_usuarios = $_SESSION["id_usuarios"];
		$cargos = new CargosDepartamentosModel();
		 
		$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
		$id_cargos_departamentos =  (isset($_REQUEST['id_cargos_departamentos'])&& $_REQUEST['id_cargos_departamentos'] !=NULL)?$_REQUEST['id_cargos_departamentos']:0;
		 
		if($action == 'ajax' && $_id_usuarios>0 && $id_cargos_departamentos > 0)
		{
			 
			$columnas_enc = " cargos_departamentos.id_cargos_departamentos, 
							  cargos_departamentos.nombre_cargo_departamentos, 
							  cargos_departamentos.valor_sueldo_cargo_departamentos";
			$tablas_enc ="public.cargos_departamentos";
			$where_enc ="1=1
			AND cargos_departamentos.id_cargos_departamentos='$id_cargos_departamentos'";
			$id_enc="cargos_departamentos.id_cargos_departamentos";
			$resultSet=$cargos->getCondiciones($columnas_enc ,$tablas_enc ,$where_enc, $id_enc);
				
			if(!empty($resultSet)){
				 
				$_numero    =$resultSet[0]->valor_sueldo_cargo_departamentos;
				 
				 
				 
				echo $_numero;
			}
				
		  
		}
		 
	}
	
	
	
	
}
?>
