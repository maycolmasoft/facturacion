<?php
class EmpleadosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function index10(){
    
    	session_start();
    	$id_rol=$_SESSION["id_rol"];
    	$empleados = new EmpleadosModel();
    	$where_to="";
    	$columnas = " empleados.id_empleados, 
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
    	
    	
    	$where    = "empleados.id_tipo_identificacion = tipo_identificacion.id_tipo_identificacion AND
					  empleados.id_provincias = provincias.id_provincias AND
					  empleados.id_cantones = cantones.id_cantones AND
					  empleados.id_parroquias = parroquias.id_parroquias AND
					  empleados.id_sexo = sexo.id_sexo AND
					  empleados.id_estado = estado.id_estado AND
					  empleados.id_departamentos = departamentos.id_departamentos AND
					  empleados.id_estado_civil = estado_civil.id_estado_civil AND empleados.id_estado=1";
					    	
    
    	 
    	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    	$search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
    	 
    	 
    	 
    	 
    	if($action == 'ajax')
    	{
    
    		if(!empty($search)){
    
    
    			$where1=" AND (empleados.identificacion_empleados LIKE '".$search."%' OR empleados.apellidos_empleados LIKE '".$search."%' OR empleados.nombres_empleados LIKE '".$search."%' OR provincias.nombre_provincias LIKE '".$search."%' OR cantones.nombre_cantones LIKE '".$search."%' OR parroquias.nombre_parroquias LIKE '".$search."%' OR empleados.correo_empleados LIKE '".$search."%' OR sexo.nombre_sexo LIKE '".$search."%' OR sexo.nombre_sexo LIKE '".$search."%' OR departamentos.nombre_departamentos LIKE '".$search."%' OR estado_civil.nombre_estado_civil LIKE '".$search."%')";
    
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
    			$html.='<th style="text-align: left;  font-size: 12px;">Tipo Ide</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Ci /Ruc</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Apellidos y Nombres</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Correo</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Fecha Nac</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Celular</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Estado Civil</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Género</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Departamento</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Fecha Empieza Labores</th>';
    
    			
    			if($id_rol==1){
    				 
    				$html.='<th style="text-align: left;  font-size: 12px;"></th>';
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
    				$html.='<td style="font-size: 11px;">'.$res->nombre_tipo_identificacion.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->identificacion_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->apellidos_empleados.' '.$res->nombres_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->correo_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->fecha_nacimiento_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->celular_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_estado_civil.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_sexo.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_departamentos.'</td>';
    				$html.='<td style="font-size: 11px;">'.date("d/m/Y", strtotime($res->fecha_empieza_a_laborar)).'</td>';
    				 
    				if($id_rol==1){
    					 
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Empleados&action=index&id_empleados='.$res->id_empleados.'" class="btn btn-success" title="Editar" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Empleados&action=borrarId&id_empleados='.$res->id_empleados.'" class="btn btn-danger" title="Eliminar" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
    					
    					 
    				}else{
    					 
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Empleados&action=index&id_empleados='.$res->id_empleados.'" class="btn btn-success" title="Editar" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    					
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
    			$html.='<h4>Aviso!!!</h4> <b>Actualmente no hay empleados activos registrados...</b>';
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
    	$columnas = " empleados.id_empleados,
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
    	 
    	 
    	$where    = "empleados.id_tipo_identificacion = tipo_identificacion.id_tipo_identificacion AND
					  empleados.id_provincias = provincias.id_provincias AND
					  empleados.id_cantones = cantones.id_cantones AND
					  empleados.id_parroquias = parroquias.id_parroquias AND
					  empleados.id_sexo = sexo.id_sexo AND
					  empleados.id_estado = estado.id_estado AND
					  empleados.id_departamentos = departamentos.id_departamentos AND
					  empleados.id_estado_civil = estado_civil.id_estado_civil AND empleados.id_estado=2";
    	
    	
    	
    	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    	$search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
    	
    	
    	
    	
    	if($action == 'ajax')
    	{
    	
    		if(!empty($search)){
    	
    			$where1=" AND (empleados.identificacion_empleados LIKE '".$search."%' OR empleados.apellidos_empleados LIKE '".$search."%' OR empleados.nombres_empleados LIKE '".$search."%' OR provincias.nombre_provincias LIKE '".$search."%' OR cantones.nombre_cantones LIKE '".$search."%' OR parroquias.nombre_parroquias LIKE '".$search."%' OR empleados.correo_empleados LIKE '".$search."%' OR sexo.nombre_sexo LIKE '".$search."%' OR sexo.nombre_sexo LIKE '".$search."%' OR departamentos.nombre_departamentos LIKE '".$search."%' OR estado_civil.nombre_estado_civil LIKE '".$search."%')";
    			
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
    			$html.='<th style="text-align: left;  font-size: 12px;">Tipo Ide</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Ci /Ruc</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Apellidos y Nombres</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Correo</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Fecha Nac</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Celular</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Estado Civil</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Género</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Departamento</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Fecha Empieza Laborar.</th>';
    			
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
    				$html.='<td style="font-size: 11px;">'.$res->nombre_tipo_identificacion.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->identificacion_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->apellidos_empleados.' '.$res->nombres_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->correo_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->fecha_nacimiento_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->celular_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_estado_civil.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_sexo.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_departamentos.'</td>';
    				$html.='<td style="font-size: 11px;">'.date("d/m/Y", strtotime($res->fecha_empieza_a_laborar)).'</td>';
    					
    				if($id_rol==1){
    				
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Empleados&action=index&id_empleados='.$res->id_empleados.'" class="btn btn-success" title="Editar" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    						
    				
    				}else{
    				
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Empleados&action=index&id_empleados='.$res->id_empleados.'" class="btn btn-success" title="Editar" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    						
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
    			$html.='<h4>Aviso!!!</h4> <b>Actualmente no hay empleados inactivos registrados...</b>';
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
				
			$provincias = new ProvinciasModel();
			$resultProvincias= $provincias->getAll("nombre_provincias");
			
			$parroquias = new ParroquiasModel();
			$resultParroquias= $parroquias->getAll("nombre_parroquias");
			
			$cantones = new CantonesModel();
			$resultCantones= $cantones->getAll("nombre_cantones");
				
			$tipo_identificacion = new TipoIdentificacionModel();
			$resultTipIdenti= $tipo_identificacion->getAll("nombre_tipo_identificacion");
			
			$estado = new EstadoModel();
			$resultEst = $estado->getAll("nombre_estado");
			
			$sexo = new SexoModel();
			$resultSexo=$sexo->getAll("nombre_sexo");
			
			$estado_civil = new EstadoCivilModel();
			$resultEstCiv=$estado_civil->getAll("nombre_estado_civil");
				
			$estado_civil = new EstadoCivilModel();
			$resultEstCiv=$estado_civil->getAll("nombre_estado_civil");
				
			$departamentos = new DepartamentosModel();
			$resultDepa=$departamentos->getAll("nombre_departamentos");
				
			
			$nombre_controladores = "Empleados";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $empleados->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
					$resultEdit = "";
			
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
					}
			
					
					$this->view("Empleados",array(
							"resultEdit" =>$resultEdit, "resultProvincias"=>$resultProvincias,
							"resultParroquias"=>$resultParroquias, "resultCantones"=>$resultCantones,
							"resultTipIdenti"=>$resultTipIdenti, "resultEst"=>$resultEst,
							"resultSexo"=>$resultSexo, "resultEstCiv"=>$resultEstCiv, "resultDepa"=>$resultDepa
					
					));
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Empleados"
			
				));
			
			}
			
		
		}
		else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
		
	}
	
	
	
	
	
	
	
	
	public function InsertaEmpleados(){
			
		session_start();
		
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
			$empleados=new EmpleadosModel();
			
		if (isset ($_POST["identificacion_empleados"]))
		{
		
			$_id_tipo_identificacion    = $_POST["id_tipo_identificacion"];
			$_identificacion_empleados  = $_POST["identificacion_empleados"];
			$_apellidos_empleados       = $_POST["apellidos_empleados"];
			$_nombres_empleados         = $_POST["nombres_empleados"];
			$_direccion_empleados   	   = $_POST["direccion_empleados"];
			$_fecha_nacimiento_empleados   = $_POST["fecha_nacimiento_empleados"];
			$_telefono_empleados        = $_POST["telefono_empleados"];
			$_celular_empleados         = $_POST["celular_empleados"];
		    $_correo_empleados          = $_POST["correo_empleados"];
		    $_id_provincias             = $_POST["id_provincias"];
		    $_id_cantones               = $_POST["id_cantones"];
		    $_id_parroquias             = $_POST["id_parroquias"];
		
		    $_id_estado                 = $_POST["id_estado"];
		    $_id_empleados              = $_POST["id_empleados"];
		    $_id_sexo  					= $_POST["id_sexo"];
		    
		    $_id_departamentos          = $_POST["id_departamentos"];
		    $_id_estado_civil           = $_POST["id_estado_civil"];
		    $_numero_hijos_empleados    = $_POST["numero_hijos_empleados"];
		    $_fecha_empieza_a_laborar   = $_POST["fecha_empieza_a_laborar"];
		    $_id_usuarios               = $_SESSION["id_usuarios"];
		    
		    if($_id_empleados > 0){
		    	
		    		
		    		$colval = "id_tipo_identificacion='$_id_tipo_identificacion',
		    		identificacion_empleados= '$_identificacion_empleados',
		    		apellidos_empleados = '$_apellidos_empleados',
		    		nombres_empleados = '$_nombres_empleados',
		    		direccion_empleados='$_direccion_empleados',
		    		fecha_nacimiento_empleados = '$_fecha_nacimiento_empleados',
		    		telefono_empleados = '$_telefono_empleados',
		    		celular_empleados = '$_celular_empleados',
		    		correo_empleados = '$_correo_empleados',
		    		id_provincias = '$_id_provincias',
		    		id_cantones = '$_id_cantones',
		    		id_parroquias= '$_id_parroquias',
		    		id_estado='$_id_estado',
		    		id_sexo='$_id_sexo',
		    		id_departamentos='$_id_departamentos',
		    		id_estado_civil='$_id_estado_civil',
		    		numero_hijos_empleados='$_numero_hijos_empleados',
		    		fecha_empieza_a_laborar='$_fecha_empieza_a_laborar'";
		    		$tabla = "empleados";
		    		$where = "id_empleados = '$_id_empleados'";
		    		$resultado=$empleados->UpdateBy($colval, $tabla, $where);
		    		 
		    		
		    	
		    }else{
		    	

		    	
		    

		     	
		        	$funcion = "ins_empleados";
		        	$parametros = "'$_id_tipo_identificacion',
		        	'$_identificacion_empleados',
		        	'$_apellidos_empleados',
		        	'$_nombres_empleados',
		        	'1',
		        	'$_id_provincias',
		        	'$_id_cantones',
		        	'$_id_parroquias',
		        	'$_direccion_empleados',
		        	'$_telefono_empleados',
		        	'$_celular_empleados',
		        	'$_correo_empleados',
		        	'$_fecha_nacimiento_empleados',
		        	'$_id_sexo',
		        	'$_id_estado',
		        	'$_id_departamentos',
		        	'$_id_estado_civil',
		        	'$_numero_hijos_empleados',
		        	'$_fecha_empieza_a_laborar',
		        	'$_id_usuarios'";
		        	$empleados->setFuncion($funcion);
		        	$empleados->setParametros($parametros);
		        	$resultado=$empleados->Insert();
		        
		  }
		  
		   
		    $this->redirect("Empleados", "index");
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
	
	
	


	public function AutocompleteCedula(){
			
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		$empleados = new EmpleadosModel();
		$identificacion_empleados = $_GET['term'];
			
		$resultSet=$empleados->getBy("identificacion_empleados LIKE '$identificacion_empleados%'");
			
		if(!empty($resultSet)){
	
			foreach ($resultSet as $res){
					
				$_identificacion_empleados[] = $res->identificacion_empleados;
			}
			echo json_encode($_identificacion_empleados);
		}
			
	}
	
	
	
	
	
	public function AutocompleteDevuelveNombres(){
			
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		$empleados = new EmpleadosModel();
			
		$identificacion_empleados = $_POST['identificacion_empleados'];
		$resultSet=$empleados->getBy("identificacion_empleados = '$identificacion_empleados'");
			
		$respuesta = new stdClass();
			
		if(!empty($resultSet)){
	
			$respuesta->id_empleados = $resultSet[0]->id_empleados;
			$respuesta->id_tipo_identificacion = $resultSet[0]->id_tipo_identificacion;
			$respuesta->id_tipo_identificacion = $resultSet[0]->id_tipo_identificacion;
			$respuesta->identificacion_empleados = $resultSet[0]->identificacion_empleados;
			$respuesta->apellidos_empleados = $resultSet[0]->apellidos_empleados;
			$respuesta->nombres_empleados = $resultSet[0]->nombres_empleados;
			$respuesta->id_provincias = $resultSet[0]->id_provincias;
			$respuesta->id_cantones = $resultSet[0]->id_cantones;
			$respuesta->id_parroquias = $resultSet[0]->id_parroquias;
			$respuesta->direccion_empleados = $resultSet[0]->direccion_empleados;
			$respuesta->telefono_empleados = $resultSet[0]->telefono_empleados;
			$respuesta->celular_empleados = $resultSet[0]->celular_empleados;
			$respuesta->correo_empleados = $resultSet[0]->correo_empleados;
			$respuesta->id_estado = $resultSet[0]->id_estado;
			
			$respuesta->fecha_nacimiento_empleados = $resultSet[0]->fecha_nacimiento_empleados;
			$respuesta->id_sexo = $resultSet[0]->id_sexo;
			$respuesta->id_departamentos = $resultSet[0]->id_departamentos;
			$respuesta->id_estado_civil = $resultSet[0]->id_estado_civil;
			$respuesta->numero_hijos_empleados = $resultSet[0]->numero_hijos_empleados;
			$respuesta->fecha_empieza_a_laborar = $resultSet[0]->fecha_empieza_a_laborar;
			
			
			echo json_encode($respuesta);
		}
			
	}
	
	
	
	
	
	public function borrarId()
	{
		if(isset($_GET["id_empleados"]))
		{
			$id_empleados=(int)$_GET["id_empleados"];
			$empleados= new EmpleadosModel();
			$empleados->UpdateBy("id_estado=2","empleados","id_empleados='$id_empleados'");
				
		}
	
		$this->redirect("Empleados", "index");
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
	
	
	
	
	
	


	public function devuelveCanton()
	{
		session_start();
		$resultCan = array();
	
	
		if(isset($_POST["id_provincias"]))
		{
	
			$id_provincias=(int)$_POST["id_provincias"];
	
			$cantones=new CantonesModel();
	
			$resultCan = $cantones->getBy(" id_provincias = '$id_provincias'  ");
	
	
		}
	
		
			
		echo json_encode($resultCan);
	
	}
	
	
	
	
	
	
	
	public function devuelveParroquias()
	{
		session_start();
		$resultParr = array();
	
	
		if(isset($_POST["id_cantones"]))
		{
	
			$id_cantones_vivienda=(int)$_POST["id_cantones"];
	
			$parroquias=new ParroquiasModel();
	
			$resultParr = $parroquias->getBy(" id_cantones = '$id_cantones_vivienda'  ");
	
	
		}
		
			
		echo json_encode($resultParr);
	
	}
	
	
	
	
	
	
	
	

	
	
	
	
	
	
	
}
?>
