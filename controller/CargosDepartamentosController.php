<?php
class CargosDepartamentosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function index10(){
    
    	session_start();
    	$id_rol=$_SESSION["id_rol"];
    	$cargos = new CargosDepartamentosModel();
    	$asignacion_empleados = new AsignacionEmpleadosModel();
    		
			
    	$where_to="";
    	$columnas = " 
		    		  cargos_departamentos.id_cargos_departamentos, 
					  cargos_departamentos.nombre_cargo_departamentos, 
					  cargos_departamentos.valor_sueldo_cargo_departamentos, 
					  departamentos.id_departamentos, 
					  departamentos.nombre_departamentos,
    			      departamentos.creado";
    	
    	$tablas   = "public.cargos_departamentos, 
					  public.departamentos";
    	
    	$id       = "departamentos.nombre_departamentos";
    	
    	
    	$where    = "cargos_departamentos.id_departamentos = departamentos.id_departamentos";
					    	
    	 
    	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    	$search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
    	 
    	 
    	 
    	if($action == 'ajax')
    	{
    
    		$columnas1 = "count(cargos_departamentos.id_cargos_departamentos) as total, cargos_departamentos.id_cargos_departamentos";
    		 
    		$tablas1   = "public.asignacion_empleados_cargos, 
  						 public.cargos_departamentos";
    		 
    		$id1       = "cargos_departamentos.id_cargos_departamentos";
    		 
    		$where1    = "cargos_departamentos.id_cargos_departamentos = asignacion_empleados_cargos.id_cargos_departamentos  group by cargos_departamentos.id_cargos_departamentos";
    		$resultAsig = $asignacion_empleados->getCondiciones($columnas1 ,$tablas1 ,$where1, $id1);
    			
    		
    		if(!empty($search)){
    
    			$where1=" AND (cargos_departamentos.nombre_cargo_departamentos LIKE '".$search."%' OR departamentos.nombre_departamentos LIKE '".$search."%')";
    			$where_to=$where.$where1;
    
    		}else{
    
    			$where_to=$where;
    
    		}
    
    		$html="";
    		$resultSet=$cargos->getCantidad("*", $tablas, $where_to);
    		$cantidadResult=(int)$resultSet[0]->total;
    
    		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    
    		$per_page = 15; //la cantidad de registros que desea mostrar
    		$adjacents  = 9; //brecha entre páginas después de varios adyacentes
    		$offset = ($page - 1) * $per_page;
    
    		$limit = " LIMIT   '$per_page' OFFSET '$offset'";
    
    		$resultSet=$cargos->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
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
    			$html.='<th style="text-align: left;  font-size: 14px;">Departamento</th>';
    			$html.='<th style="text-align: left;  font-size: 14px;">Cargo</th>';
    			$html.='<th style="text-align: left;  font-size: 14px;">Rubro</th>';
    			$html.='<th style="text-align: left;  font-size: 14px;">Fecha Registro</th>';
    			$html.='<th style="text-align: left;  font-size: 14px;">Total Empleados con Este Cargo</th>';
    
    			
    				$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    					 
    			
    
    			$html.='</tr>';
    			$html.='</thead>';
    			$html.='<tbody>';
    			 
    			$i=0;
    
    
    
    			foreach ($resultSet as $res)
    			{
    				$i++;
    				$html.='<tr>';
    			
    				$html.='<td style="font-size: 13px;">'.$res->nombre_departamentos.'</td>';
    				$html.='<td style="font-size: 13px;">'.$res->nombre_cargo_departamentos.'</td>';
    				$html.='<td style="font-size: 13px;">'.$res->valor_sueldo_cargo_departamentos.'</td>';
    				$html.='<td style="font-size: 13px;">'.date("d/m/Y", strtotime($res->creado)).'</td>';
    				
    				
    				if(!empty($resultAsig)){
    					foreach ($resultAsig as $r){
    						if($r->id_cargos_departamentos == $res->id_cargos_departamentos ){
    							$html.='<td style="text-align: left; font-size: 13px;">'.$r->total.'</td>';
    							$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=CargosDepartamentos&action=index&id_cargos_departamentos='.$res->id_cargos_departamentos.'" class="btn btn-success" title="Editar" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    							$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="javascript:void(0);" class="btn btn-danger" style="font-size:65%;" title="Eliminar" disabled><i class="glyphicon glyphicon-trash"></i></a></span></td>';
    							
    						}else{
    						
    							$html.='<td style="text-align: left; font-size: 13px;">0</td>';
    							$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=CargosDepartamentos&action=index&id_cargos_departamentos='.$res->id_cargos_departamentos.'" class="btn btn-success" title="Editar" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    							$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=CargosDepartamentos&action=borrarId&id_cargos_departamentos='.$res->id_cargos_departamentos.'" class="btn btn-danger" title="Eliminar" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
    							
    						}
    					}
    				}else{
    						
    						    $html.='<td style="text-align: left; font-size: 13px;">0</td>';
    						    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=CargosDepartamentos&action=index&id_cargos_departamentos='.$res->id_cargos_departamentos.'" class="btn btn-success" title="Editar" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    						    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=CargosDepartamentos&action=borrarId&id_cargos_departamentos='.$res->id_cargos_departamentos.'" class="btn btn-danger" title="Eliminar" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
    						    
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
    			$html.='<h4>Aviso!!!</h4> <b>Actualmente no hay cargos por departamentos registrados...</b>';
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
			
			$cargos = new CargosDepartamentosModel();
			
			$departamentos = new DepartamentosModel();
			$resultDepa=$departamentos->getAll("nombre_departamentos");
				
			
			$nombre_controladores = "CargosDepartamentos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $cargos->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
					$resultEdit = "";
			
					if (isset ($_GET["id_cargos_departamentos"])   )
					{
						$_id_cargos_departamentos = $_GET["id_cargos_departamentos"];
						
						$columnas = "cargos_departamentos.id_cargos_departamentos, 
									  cargos_departamentos.nombre_cargo_departamentos, 
									  cargos_departamentos.valor_sueldo_cargo_departamentos, 
									  departamentos.id_departamentos, 
									  departamentos.nombre_departamentos";
						
						$tablas   = "public.cargos_departamentos, 
  									public.departamentos";
						
						$id       = "cargos_departamentos.id_cargos_departamentos";
						
						
						$where    = "cargos_departamentos.id_departamentos = departamentos.id_departamentos AND cargos_departamentos.id_cargos_departamentos = '$_id_cargos_departamentos' "; 
						$resultEdit = $cargos->getCondiciones($columnas ,$tablas ,$where, $id); 
					
					}
					
							
					$this->view("CargosDepartamentos",array(
							"resultEdit" =>$resultEdit, "resultDepa"=>$resultDepa
					
					));
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Cargos por Departamentos"
			
				));
			
			}
			
		
		}
		else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
		
	}
	
	
	
	
	
	
	
	
	public function InsertaCargos(){
			
		session_start();
		
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
		
			$cargos = new CargosDepartamentosModel();
			
				
		if (isset ($_POST["id_departamentos"]))
		{
		
			 $_id_departamentos                     = $_POST["id_departamentos"];
			 $_nombre_cargo_departamentos           = $_POST["nombre_cargo_departamentos"];
			 $_valor_sueldo_cargo_departamentos     = $_POST["valor_sueldo_cargo_departamentos"];
			 $_id_cargos_departamentos     = $_POST["id_cargos_departamentos"];
			 
		    if($_id_cargos_departamentos > 0){
		    	
		    		
		    	$colval = "nombre_cargo_departamentos='$_nombre_cargo_departamentos',
		    	valor_sueldo_cargo_departamentos= '$_valor_sueldo_cargo_departamentos',
		    	id_departamentos = '$_id_departamentos'";
		    	$tabla = "cargos_departamentos";
		    	$where = "id_cargos_departamentos = '$_id_cargos_departamentos'";
		    	$resultado=$cargos->UpdateBy($colval, $tabla, $where);
		    	 
		    	
		    		 
		    	
		    }else{
		    	
		    	
		    	$funcion = "ins_cargos_departamentos";
		    	$parametros = "'$_nombre_cargo_departamentos',
		    	'$_valor_sueldo_cargo_departamentos',
		    	'$_id_departamentos'";
		    	$cargos->setFuncion($funcion);
		    	$cargos->setParametros($parametros);
		    	$resultado=$cargos->Insert();
		    	
		    	
		    }
		  
		   
		    $this->redirect("CargosDepartamentos", "index");
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
	
			if(isset($_GET["id_cargos_departamentos"]))
			{
				$id_cargos_departamentos=(int)$_GET["id_cargos_departamentos"];
	
				$cargos=new CargosDepartamentosModel();
	
				$cargos->deleteBy(" id_cargos_departamentos",$id_cargos_departamentos);
	
			}
				
			$this->redirect("CargosDepartamentos", "index");
				
				
		
		
	
	}
	
	
	
	

	
	
}
?>
