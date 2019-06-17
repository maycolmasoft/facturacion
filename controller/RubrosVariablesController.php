<?php
class RubrosVariablesController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function index10(){
    
    	session_start();
    	$id_rol=$_SESSION["id_rol"];
    	$rubros = new RubrosVariablesModel();
    		
			
    	$where_to="";
    	$columnas = " 
		    		  empleados.id_empleados, 
					  empleados.identificacion_empleados, 
					  empleados.apellidos_empleados, 
					  empleados.nombres_empleados, 
					  cargos_departamentos.id_cargos_departamentos, 
					  cargos_departamentos.nombre_cargo_departamentos, 
					  cargos_departamentos.valor_sueldo_cargo_departamentos, 
					  rubros_variables_empleados.id_rubros_variables_empleados, 
					  rubros_variables_empleados.valor_rubros_variables_empleados, 
					  rubros_variables_empleados.mes_afectacion, 
					  rubros_variables_empleados.anio_afectacion, 
					  rubros_variables_empleados.numero_horas_extras_50_porciento, 
					  rubros_variables_empleados.numero_horas_extras_100_porciento, 
					  rubros_variables_empleados.creado, 
					  departamentos.id_departamentos, 
					  departamentos.nombre_departamentos, 
					  usuarios.nombre_usuarios,
    			      tipo_rubros.id_tipo_rubros, 
  					  tipo_rubros.nombre_tipo_rubros";
    	
    	$tablas   = "public.rubros_variables_empleados, 
					  public.empleados, 
					  public.asignacion_empleados_cargos, 
					  public.cargos_departamentos, 
					  public.departamentos, 
					  public.usuarios, 
  					  public.tipo_rubros";
    	
    	$id       = "rubros_variables_empleados.id_rubros_variables_empleados";
    	
    	
    	$where    = "rubros_variables_empleados.id_tipo_rubros = tipo_rubros.id_tipo_rubros AND
    			     rubros_variables_empleados.id_empleados = empleados.id_empleados AND
					  empleados.id_empleados = asignacion_empleados_cargos.id_empleados AND
					  cargos_departamentos.id_cargos_departamentos = asignacion_empleados_cargos.id_cargos_departamentos AND
					  departamentos.id_departamentos = empleados.id_departamentos AND
					  usuarios.id_usuarios = rubros_variables_empleados.id_usuarios";
					    	
    	 
    	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    	$search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
    	 
    	 
    	 
    	if($action == 'ajax')
    	{
    
    		
    		
    		if(!empty($search)){
    
    			$where1=" AND (empleados.identificacion_empleados LIKE '".$search."%' OR empleados.nombres_empleados LIKE '".$search."%' OR empleados.apellidos_empleados LIKE '".$search."%' OR cargos_departamentos.nombre_cargo_departamentos LIKE '".$search."%' OR departamentos.nombre_departamentos LIKE '".$search."%' OR tipo_rubros.nombre_tipo_rubros LIKE '".$search."%')";
    			$where_to=$where.$where1;
    
    		}else{
    
    			$where_to=$where;
    
    		}
    
    		$html="";
    		$resultSet=$rubros->getCantidad("*", $tablas, $where_to);
    		$cantidadResult=(int)$resultSet[0]->total;
    
    		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    
    		$per_page = 15; //la cantidad de registros que desea mostrar
    		$adjacents  = 9; //brecha entre páginas después de varios adyacentes
    		$offset = ($page - 1) * $per_page;
    
    		$limit = " LIMIT   '$per_page' OFFSET '$offset'";
    
    		$resultSet=$rubros->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
    		$count_query   = $cantidadResult;
    		$total_pages = ceil($cantidadResult/$per_page);
    
    		$cierre_nomina = new CierreNominaModel();
    
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
    			$html.='<th style="text-align: left;  font-size: 14px;">Ci/Ruc</th>';
    			$html.='<th style="text-align: left;  font-size: 14px;">Nombres y Apellidos</th>';
    			$html.='<th style="text-align: left;  font-size: 14px;">Departamento</th>';
    			$html.='<th style="text-align: left;  font-size: 14px;">Cargo</th>';
    			$html.='<th style="text-align: left;  font-size: 14px;">Tipo Rubros</th>';
    			$html.='<th style="text-align: left;  font-size: 14px;">Valor Extra</th>';
    			$html.='<th style="text-align: left;  font-size: 14px;">Mes-Año Afectación</th>';
    			 
    			
    		    $html.='<th style="text-align: left;  font-size: 12px;"></th>';
    		    $html.='<th style="text-align: left;  font-size: 12px;"></th>';
    		     
    			
    
    			$html.='</tr>';
    			$html.='</thead>';
    			$html.='<tbody>';
    			 
    			$i=0;
    
    			$mes="";
    
    			foreach ($resultSet as $res)
    			{
    				
    				if($res->mes_afectacion==1){
    					$mes="Enero";
    				}
    				else if($res->mes_afectacion==2){
    					$mes="Febrero";
    				}else if($res->mes_afectacion==3){
    					$mes="Marzo";
    				}else if($res->mes_afectacion==4){
    					$mes="Abril";
    				}else if($res->mes_afectacion==5){
    					$mes="Mayo";
    				}else if($res->mes_afectacion==6){
    					$mes="Junio";
    				}else if($res->mes_afectacion==7){
    					$mes="Julio";
    				}else if($res->mes_afectacion==8){
    					$mes="Agosto";
    				}else if($res->mes_afectacion==9){
    					$mes="Septiembre";
    				}else if($res->mes_afectacion==10){
    					$mes="Octubre";
    				}else if($res->mes_afectacion==11){
    					$mes="Noviembre";
    				}else if($res->mes_afectacion==12){
    					$mes="Diciembre";
    				}
    				
    				$i++;
    				$html.='<tr>';
    			
    				$html.='<td style="font-size: 13px;">'.$res->identificacion_empleados.'</td>';
    				$html.='<td style="font-size: 13px;">'.$res->nombres_empleados.' '.$res->apellidos_empleados.'</td>';
    				$html.='<td style="font-size: 13px;">'.$res->nombre_departamentos.'</td>';
    				$html.='<td style="font-size: 13px;">'.$res->nombre_cargo_departamentos.'</td>';
    				$html.='<td style="font-size: 13px;">'.$res->nombre_tipo_rubros.'</td>';
    				$html.='<td style="font-size: 13px;">'.$res->valor_rubros_variables_empleados.'</td>';
    				$html.='<td style="font-size: 13px;">'.$mes.'-'.$res->anio_afectacion.'</td>';
    				
    				
    					
    				$resultaa=$cierre_nomina->getBy("mes_cierre_nomina='$res->mes_afectacion' AND anio_cierre_nomina='$res->anio_afectacion' AND id_estado=1");
    				
    				if(!empty($resultaa)){
    					
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="" class="btn btn-success" disabled title="Editar" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="" class="btn btn-danger" disabled title="Eliminar" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
    					
    					
    				}else{
    				
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=RubrosVariables&action=index&id_rubros_variables_empleados='.$res->id_rubros_variables_empleados.'" class="btn btn-success" title="Editar" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=RubrosVariables&action=borrarId&id_rubros_variables_empleados='.$res->id_rubros_variables_empleados.'" class="btn btn-danger" title="Eliminar" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
    					
    					
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
    			$html.='<h4>Aviso!!!</h4> <b>Actualmente no hay rubros extras para empleados registrados...</b>';
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
			
			$rubros_variables= new RubrosVariablesModel();
			
			$departamentos = new DepartamentosModel();
			$resultDepa=$departamentos->getAll("nombre_departamentos");
			
			$cargos = new CargosDepartamentosModel();
			$resultCar=$cargos->getAll("nombre_cargo_departamentos");
				
			$tipo_rubros = new TipoRubrosModel();
			$resultTipRub =$tipo_rubros->getAll("nombre_tipo_rubros");
				
			
			
			$nombre_controladores = "RubrosVariables";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $rubros_variables->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
					$resultEdit = "";
			
					if (isset ($_GET["id_rubros_variables_empleados"])   )
					{
						$_id_rubros_variables_empleados = $_GET["id_rubros_variables_empleados"];
						
						$columnas = "empleados.id_empleados, 
								  empleados.identificacion_empleados, 
								  empleados.apellidos_empleados, 
								  empleados.nombres_empleados, 
								  empleados.id_departamentos, 
								  cargos_departamentos.id_cargos_departamentos, 
								  cargos_departamentos.nombre_cargo_departamentos, 
								  cargos_departamentos.valor_sueldo_cargo_departamentos, 
								  rubros_variables_empleados.id_rubros_variables_empleados, 
								  rubros_variables_empleados.valor_rubros_variables_empleados, 
								  rubros_variables_empleados.id_tipo_rubros, 
								  rubros_variables_empleados.mes_afectacion, 
								  rubros_variables_empleados.anio_afectacion, 
								  rubros_variables_empleados.numero_horas_extras_50_porciento, 
								  rubros_variables_empleados.numero_horas_extras_100_porciento, 
								  rubros_variables_empleados.creado";
						
						$tablas   = "public.rubros_variables_empleados, 
								  public.empleados, 
								  public.asignacion_empleados_cargos, 
								  public.cargos_departamentos";
						
						$id       = "empleados.id_empleados";
						
						
						$where    = " rubros_variables_empleados.id_empleados = empleados.id_empleados AND
					  empleados.id_empleados = asignacion_empleados_cargos.id_empleados AND
					  cargos_departamentos.id_cargos_departamentos = asignacion_empleados_cargos.id_cargos_departamentos AND rubros_variables_empleados.id_rubros_variables_empleados = '$_id_rubros_variables_empleados' "; 
											
				       $resultEdit = $rubros_variables->getCondiciones($columnas ,$tablas ,$where, $id); 
					
					}
					
							
					$this->view("RubrosVariables",array(
							"resultEdit" =>$resultEdit, "resultDepa"=>$resultDepa, "resultCar"=>$resultCar,
							"resultTipRub"=>$resultTipRub
					
					));
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Rubros Variables"
			
				));
			
			}
			
		
		}
		else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
		
	}
	
	
	
	
	
	
	
	
	public function InsertaRubrosVariables(){
			
		session_start();
		
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
		
			$rubros = new RubrosVariablesModel();
			
				
		if (isset ($_POST["id_empleados"]))
		{
		
			 $_id_empleados                     = $_POST["id_empleados"];
			 $_id_tipo_rubros           = $_POST["id_tipo_rubros"];
			 $_valor_rubros_variables_empleados     = $_POST["valor_rubros_variables_empleados"];
			 $_numero_horas_extras_50_porciento     = $_POST["numero_horas_extras_50_porciento"];
			 $_sueldo_mensual =  $_POST["valor_sueldo_cargo_departamentos"];
			 $_numero_horas_extras_100_porciento     = $_POST["numero_horas_extras_100_porciento"];
			 $_mes_afectacion     = $_POST["mes_afectacion"];
			 $_anio_afectacion     = $_POST["anio_afectacion"];
			 $_id_rubros_variables_empleados     = $_POST["id_rubros_variables_empleados"];
			 
			 $_id_usuarios = $_SESSION["id_usuarios"];
			 
			 
			 $_valor_hora=0;
			 $_50=1.50;
			 $_100=2;
			 
			 $_valor_horas_50=0;
			 $_valor_horas_100=0;
			 
			 if($_id_tipo_rubros==2){
			 	
			 
			 	$_valor_hora=$_sueldo_mensual/240;
			 		
			 	if($_numero_horas_extras_50_porciento>0){
			 	
			 	// calcular horas del 50%
			 	
			 	$_valor_horas_50=$_valor_hora*$_50;
			 	$_valor_horas_50=$_valor_horas_50*$_numero_horas_extras_50_porciento;
			 	}else{
			 		
			 		$_valor_rubros_variables_empleados=0.00;
			 		
			 	}
			 	
			 	if($_numero_horas_extras_100_porciento>0){
			 			
			 	// calcular horas del 100%
			 	$_valor_horas_100=$_valor_hora*$_100;
			 	$_valor_horas_100=$_valor_horas_100*$_numero_horas_extras_100_porciento;
			 	}else{
			 		
			 		$_valor_rubros_variables_empleados=0.00;
			 		
			 	}	
			 	
			 	
			 	$_valor_rubros_variables_empleados=$_valor_horas_50+$_valor_horas_100;
			 	
			 	
			 }
			 
			 
			 
			 
			 
		    if($_id_rubros_variables_empleados > 0){
		    	
		    		
		    	$colval = "id_empleados='$_id_empleados',
		    	valor_rubros_variables_empleados= '$_valor_rubros_variables_empleados',
		    	id_tipo_rubros = '$_id_tipo_rubros',
		    	mes_afectacion = '$_mes_afectacion',
		    	anio_afectacion = '$_anio_afectacion',
		    	numero_horas_extras_50_porciento = '$_numero_horas_extras_50_porciento',
		    	numero_horas_extras_100_porciento = '$_numero_horas_extras_100_porciento',
		    	valor_horas_extras_50_porciento = '$_valor_horas_50',
		    	valor_horas_extras_100_porciento = '$_valor_horas_100'";
		    	$tabla = "rubros_variables_empleados";
		    	$where = "id_rubros_variables_empleados = '$_id_rubros_variables_empleados'";
		    	$resultado=$rubros->UpdateBy($colval, $tabla, $where);
		    	 
		    	
		    		 
		    	
		    }else{
		    	
		    	
		    	$funcion = "ins_rubros_variables_empleados";
		    	$parametros = "'$_id_empleados',
		    	'$_id_usuarios',
		    	'$_valor_rubros_variables_empleados',
		    	'$_id_tipo_rubros',
		    	'$_mes_afectacion',
		    	'$_anio_afectacion',
		    	'$_numero_horas_extras_50_porciento',
		    	'$_numero_horas_extras_100_porciento',
		    	'$_valor_horas_50',
		    	'$_valor_horas_100'";
		    	$rubros->setFuncion($funcion);
		    	$rubros->setParametros($parametros);
		    	$resultado=$rubros->Insert();
		    	
		    	
		    }
		  
		   
		    $this->redirect("RubrosVariables", "index");
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
	
	
	
	public function borrarId()
	{
	
		session_start();
	
			if(isset($_GET["id_rubros_variables_empleados"]))
			{
				$id_rubros_variables_empleados=(int)$_GET["id_rubros_variables_empleados"];
	
				$rubros=new RubrosVariablesModel();
	
				$rubros->deleteBy(" id_rubros_variables_empleados",$id_rubros_variables_empleados);
	
			}
				
			$this->redirect("RubrosVariables", "index");
				
				
		
		
	
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
		$resultSet=$empleados->getCondiciones("empleados.id_empleados, 
											  empleados.identificacion_empleados, 
											  empleados.apellidos_empleados, 
											  empleados.nombres_empleados, 
											  empleados.id_departamentos, 
											  asignacion_empleados_cargos.id_cargos_departamentos, 
											  cargos_departamentos.valor_sueldo_cargo_departamentos",
				
											"public.empleados, 
											  public.asignacion_empleados_cargos, 
											  public.cargos_departamentos",
											
											"asignacion_empleados_cargos.id_empleados = empleados.id_empleados AND
  											 cargos_departamentos.id_cargos_departamentos = asignacion_empleados_cargos.id_cargos_departamentos
				                             AND empleados.identificacion_empleados = '$identificacion_empleados'",
				
											"empleados.id_empleados");
																					
		$respuesta = new stdClass();
			
		if(!empty($resultSet)){
	
			$respuesta->id_empleados = $resultSet[0]->id_empleados;
			$respuesta->identificacion_empleados = $resultSet[0]->identificacion_empleados;
			$respuesta->apellidos_empleados = $resultSet[0]->apellidos_empleados;
			$respuesta->nombres_empleados = $resultSet[0]->nombres_empleados;
			$respuesta->id_departamentos = $resultSet[0]->id_departamentos;
			$respuesta->id_cargos_departamentos = $resultSet[0]->id_cargos_departamentos;
			$respuesta->valor_sueldo_cargo_departamentos = $resultSet[0]->valor_sueldo_cargo_departamentos;
			
				
			echo json_encode($respuesta);
		}
			
	}
	
	
	
	

	
	
}
?>
