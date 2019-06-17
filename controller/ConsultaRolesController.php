<?php

class ConsultaRolesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}


	
	public function search_sesiones(){
	
		session_start();
		
			$roles_pago = new NominaModel();
		$where_to="";
		

		$columnas = "empleados.identificacion_empleados,
					  empleados.apellidos_empleados,
					  empleados.nombres_empleados,
					  empleados.direccion_empleados,
					  empleados.telefono_empleados,
					  empleados.celular_empleados,
					  empleados.correo_empleados,
					  empleados.fecha_nacimiento_empleados,
					  empleados.fecha_empieza_a_laborar,
					  cargos_departamentos.nombre_cargo_departamentos,
					  nomina.id_nomina,
					  nomina.id_empleados,
					  nomina.mes_afectacion,
					  nomina.anio_afectacion,
					  nomina.sueldo_mensual,
					  nomina.valor_horas_extras_50_porciento,
					  nomina.valor_horas_extras_100_porciento,
					  nomina.valor_comision,
					  nomina.valor_bono,
					  nomina.valor_decimo_tercero,
					  nomina.valor_decimo_cuarto,
					  nomina.valor_fondo_reserva,
					  nomina.total_ingresos,
					  nomina.valor_subsidio_iess,
					  nomina.valor_aporte_personal_iess,
					  nomina.valor_impuesto_a_la_renta,
					  nomina.valor_prestamos_iess,
					  nomina.valor_prestamos_iess_ph,
					  nomina.valor_atrasos,
					  nomina.valor_prestamos_internos,
					  nomina.dias_no_lavorados,
					  nomina.total_egresos,
					  nomina.estado_nomina,
    			      departamentos.nombre_departamentos,
						nomina.dias_laborados,
						cargos_departamentos.valor_sueldo_cargo_departamentos,
				nomina.creado";
			
		$tablas   = "public.nomina,
					  public.empleados,
					  public.cargos_departamentos,
					  public.asignacion_empleados_cargos,
    			      public.departamentos";
			
		$id       = "nomina.id_empleados";
			
			
		$where    = "departamentos.id_departamentos = empleados.id_departamentos AND
		empleados.id_empleados = nomina.id_empleados AND
		asignacion_empleados_cargos.id_empleados = empleados.id_empleados AND
		asignacion_empleados_cargos.id_cargos_departamentos = cargos_departamentos.id_cargos_departamentos";
			
			
			
		
		 
		 
		 
		$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
		$search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
		$desde=  (isset($_REQUEST['desde'])&& $_REQUEST['desde'] !=NULL)?$_REQUEST['desde']:'';
		$hasta=  (isset($_REQUEST['hasta'])&& $_REQUEST['hasta'] !=NULL)?$_REQUEST['hasta']:'';
		 
		$where2="";
		 
		 
		if($action == 'ajax')
		{
	
			if(!empty($search)){
	
				
				if($desde!="" && $hasta!=""){
					
					$where2=" AND DATE(nomina.creado)  BETWEEN '$desde' AND '$hasta'";
					
					
				}
	
				$where1=" AND (empleados.identificacion_empleados LIKE '".$search."%' OR empleados.apellidos_empleados LIKE '".$search."%' OR empleados.nombres_empleados LIKE '".$search."%')";
	
				$where_to=$where.$where1.$where2;
			}else{
				if($desde!="" && $hasta!=""){
						
					$where2=" AND DATE(nomina.creado)  BETWEEN '$desde' AND '$hasta'";	
						
				}
				
				$where_to=$where.$where2;
	
			}
	
			$html="";
			$resultSet=$roles_pago->getCantidad("*", $tablas, $where_to);
			$cantidadResult=(int)$resultSet[0]->total;
	
			$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	
			$per_page = 15; //la cantidad de registros que desea mostrar
			$adjacents  = 9; //brecha entre páginas después de varios adyacentes
			$offset = ($page - 1) * $per_page;
	
			$limit = " LIMIT   '$per_page' OFFSET '$offset'";
	
			$resultSet=$roles_pago->getCondicionesPagDesc($columnas, $tablas, $where_to, $id, $limit);
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
				$html.= "<table id='tabla_sesiones' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
				$html.= "<thead>";
				$html.= "<tr>";
				$html.='<th style="text-align: left;  font-size: 13px;">Ci / Ruc</th>';
				$html.='<th style="text-align: left;  font-size: 13px;">Apellidos y Nombres</th>';
				$html.='<th style="text-align: left;  font-size: 13px;">Departamento</th>';
				$html.='<th style="text-align: left;  font-size: 13px;">Cargo</th>';
				$html.='<th style="text-align: left;  font-size: 13px;">Mes-Año</th>';
				$html.='<th style="text-align: left;  font-size: 13px;">Total Ingresos</th>';
				$html.='<th style="text-align: left;  font-size: 13px;">Total Egresos</th>';
				$html.='<th style="text-align: left;  font-size: 13px;">Liquido a Recibir</th>';
				 
				 
				$html.='<th style="text-align: left;  font-size: 12px;"></th>';
				 
				$html.='</tr>';
				$html.='</thead>';
				$html.='<tbody>';
				 
				$i=0;
				
				
				$mes="";
				$total_ingresos=0;
				$total_egresos=0;
				$total_a_recibir=0;
	
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
					
					$total_ingresos= $res->total_ingresos + $res->valor_decimo_tercero + $res->valor_decimo_cuarto + $res->valor_fondo_reserva;
					$total_egresos=$res->total_egresos;
					$total_a_recibir=$total_ingresos-$total_egresos;
					$i++;
					$html.='<tr>';
					$html.='<td style="font-size: 12px;">'.$res->identificacion_empleados.'</td>';
					$html.='<td style="font-size: 12px;">'.$res->apellidos_empleados.' '.$res->nombres_empleados.'</td>';
					$html.='<td style="font-size: 12px;">'.$res->nombre_departamentos.'</td>';
					$html.='<td style="font-size: 12px;">'.$res->nombre_cargo_departamentos.'</td>';
					$html.='<td style="font-size: 12px;">'.$mes.'-'.$res->anio_afectacion.'</td>';
					$html.='<td style="font-size: 12px;">'.$total_ingresos.'</td>';
					$html.='<td style="font-size: 12px;">'.$total_egresos.'</td>';
					$html.='<td style="font-size: 12px;">'.$total_a_recibir.'</td>';
					
					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=RolPagos&action=print&id_nomina='.$res->id_nomina.'" target="blank" class="btn btn-info" title="Imprimir" style="font-size:65%;"><i class="glyphicon glyphicon-print"></i></a></span></td>';
					
					$html.='</tr>';
				}
	
	
				$html.='</tbody>';
				$html.='</table>';
				$html.='</section></div>';
				$html.='<div class="table-pagination pull-right">';
				$html.=''. $this->paginate_sesiones("index.php", $page, $total_pages, $adjacents).'';
				$html.='</div>';
	
	 
			}else{
				$html.='<div class="col-lg-6 col-md-6 col-xs-12">';
				$html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
				$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
				$html.='<h4>Aviso!!!</h4> <b>Actualmente no hay roles de pago registrados...</b>';
				$html.='</div>';
				$html.='</div>';
			}
			 
			 
			 
	
			echo $html;
			die();
	
		}
	
	
	}
	
	
	
	
	
	
	
	public function index(){
	
		session_start();
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
			
			$roles_pago = new NominaModel();
	
			$nombre_controladores = "ConsultaRoles";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $roles_pago->getPermisosEditar("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
				
					
					
				$this->view("ConsultaRoles",array(
						"resultSet"=>""
	
				));
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Consultar Roles de Pago"
		
				));
					
			}
				
	
		}
		else
		{
		$error = TRUE;
	   	$mensaje = "Te sesión a caducado, vuelve a iniciar sesión.";
	   		
	   	$this->view("Login",array(
	   			"resultSet"=>"$mensaje", "error"=>$error
	   	));
	   		
	   		
	   	die();
				
		}
	
	}
	
	
	public function paginate_sesiones($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_sesiones(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_sesiones(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_sesiones(1)'>1</a></li>";
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
				$out.= "<li><a href='javascript:void(0);' onclick='load_sesiones(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_sesiones(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_sesiones($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_sesiones(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	
	
	
}
?>