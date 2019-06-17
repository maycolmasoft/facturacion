<?php
class RolPagosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function index10(){
    
    	session_start();
    	$id_rol=$_SESSION["id_rol"];
    	$rol_pagos = new NominaModel();
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
    			      departamentos.nombre_departamentos";
    	
    	$tablas   = "public.nomina, 
					  public.empleados, 
					  public.cargos_departamentos, 
					  public.asignacion_empleados_cargos,
    			      public.departamentos";
    	
    	$id       = "nomina.id_empleados";
    	
    	
    	$where    = "departamentos.id_departamentos = empleados.id_departamentos AND
    			      empleados.id_empleados = nomina.id_empleados AND
					  asignacion_empleados_cargos.id_empleados = empleados.id_empleados AND
					  asignacion_empleados_cargos.id_cargos_departamentos = cargos_departamentos.id_cargos_departamentos AND nomina.estado_nomina='FALSE'";
					    	
    	 
    	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    	$search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
    	 
    	 
    	 
    	if($action == 'ajax')
    	{
    
    		if(!empty($search)){
    
    			$where1=" AND (empleados.identificacion_empleados LIKE '".$search."%' OR empleados.apellidos_empleados LIKE '".$search."%' OR empleados.nombres_empleados LIKE '".$search."%' OR empleados.correo_empleados LIKE '".$search."%' OR cargos_departamentos.nombre_cargo_departamentos LIKE '".$search."%')";
    			$where_to=$where.$where1;
    
    		}else{
    
    			$where_to=$where;
    
    		}
    
    		$html="";
    		$resultSet=$rol_pagos->getCantidad("*", $tablas, $where_to);
    		$cantidadResult=(int)$resultSet[0]->total;
    
    		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    
    		$per_page = 10; //la cantidad de registros que desea mostrar
    		$adjacents  = 9; //brecha entre páginas después de varios adyacentes
    		$offset = ($page - 1) * $per_page;
    
    		$limit = " LIMIT   '$per_page' OFFSET '$offset'";
    
    		$resultSet=$rol_pagos->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
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
    			$html.= "<table id='tabla_rol_pagos' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
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
    			$html.=$this->paginate_rol_pagos("index.php", $page, $total_pages, $adjacents);
    			$html.='</div>';
    
    			 
    		}else{
    			$html.='<div class="col-lg-6 col-md-6 col-xs-12">';
    			$html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
    			$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    			$html.='<h4>Aviso!!!</h4> <b>Actualmente no hay Roles de Pago Generados...</b>';
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
			
			$rol_pagos = new NominaModel();
			
			$nombre_controladores = "RolPagos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $rol_pagos->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
					$this->view("RolPagos",array(
							"" =>""
					));
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Generar Rol Pagos"
			
				));
			
			}
			
		
		}
		else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
		
	}
	
	
	
	
	
	
	
	
	public function InsertaRolPagos(){
			
		session_start();
		
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
		$rol_pagos=new NominaModel();
		$_lectura_biometrico = new LecturaBiometricoModel();
		
		
		$_valor_horas_extras_50_porciento=0;
		$_valor_horas_extras_100_porciento=0;
		$_valor_comision =0;
		$_valor_bono =0;
		$_valor_decimo_tercero =0;
		$_valor_decimo_cuarto =0;
		$_valor_fondo_reserva =0;
		$_total_ingresos =0;
		$_valor_subsidio_iess =0;
		$_valor_aporte_personal_iess =0;
		$_valor_impuesto_a_la_renta =0;
		$_valor_prestamos_iess =0;
		$_valor_prestamos_iess_ph =0;
		$_valor_prestamos_internos =0;
		$_valor_atrasos =0;
		$_dias_no_lavorados =0;
		$_total_egresos =0;
		
		
		
		
		if (isset ($_POST["mes_afectacion"]))
		{
		
			 $_mes_afectacion                = $_POST["mes_afectacion"];
			 $_anio_afectacion               = $_POST["anio_afectacion"];
			 $_id_usuarios                   = $_SESSION["id_usuarios"];
		    
			 
			 
			 
		    if($_mes_afectacion > 0 && $_anio_afectacion > 0){
		    	
		    	$_columnas="empleados.id_empleados, 
  							cargos_departamentos.valor_sueldo_cargo_departamentos,
		    			    empleados.fecha_empieza_a_laborar";
		    	$_tablas="public.empleados, 
						  public.asignacion_empleados_cargos, 
						  public.cargos_departamentos";
		    	$_where="asignacion_empleados_cargos.id_empleados = empleados.id_empleados AND
  						 cargos_departamentos.id_cargos_departamentos = asignacion_empleados_cargos.id_cargos_departamentos AND empleados.id_estado=1";
		    	$_id="empleados.id_empleados";
		    	
		    	$resultSet=$rol_pagos->getCondiciones($_columnas ,$_tablas ,$_where, $_id);
		    		
		    	if(!empty($resultSet)){
		    		
		    		foreach ($resultSet as $res){
		    			
		    			
		    			$_id_empelados = $res->id_empleados;
		    			$_sueldo_mensual =$res->valor_sueldo_cargo_departamentos;
		    			$_fecha_empieza_a_laborar =$res->fecha_empieza_a_laborar;
		    			
		    			if($_id_empelados >0){
		    			
		    				$_columnas_det="rubros_variables_empleados.id_empleados, 
										  rubros_variables_empleados.valor_rubros_variables_empleados, 
										  rubros_variables_empleados.id_tipo_rubros, 
										  rubros_variables_empleados.mes_afectacion, 
										  rubros_variables_empleados.anio_afectacion, 
										  rubros_variables_empleados.numero_horas_extras_50_porciento, 
										  rubros_variables_empleados.numero_horas_extras_100_porciento,
		    						      rubros_variables_empleados.valor_horas_extras_50_porciento,
		    						      rubros_variables_empleados.valor_horas_extras_100_porciento";
		    				$_tablas_det="public.rubros_variables_empleados";
		    				$_where_det="1=1 AND rubros_variables_empleados.id_empleados='$_id_empelados' AND rubros_variables_empleados.mes_afectacion='$_mes_afectacion' AND rubros_variables_empleados.anio_afectacion='$_anio_afectacion'";
		    				$_id_det="rubros_variables_empleados.id_empleados";
		    				 
		    				$resultDet=$rol_pagos->getCondiciones($_columnas_det ,$_tablas_det ,$_where_det, $_id_det);
		    				 
		    				
		    				if(!empty($resultDet)){
		    					
		    					foreach ($resultDet as $resDet){
		    						
		    						$_id_tipo_rubros = $resDet->id_tipo_rubros;
		    						
		    						if($_id_tipo_rubros ==1){
		    							
		    							$_valor_bono=$resDet->valor_rubros_variables_empleados;
		    							
		    						}
		    						if($_id_tipo_rubros ==2){
		    								
		    							$_valor_horas_extras_50_porciento=$resDet->valor_horas_extras_50_porciento;
		    							$_valor_horas_extras_100_porciento=$resDet->valor_horas_extras_100_porciento;
		    							
		    						}
		    						
		    						if($_id_tipo_rubros ==3){
		    						
		    							$_valor_comision=$resDet->valor_rubros_variables_empleados;
		    								
		    						}
		    						
		    						
		    						if($_id_tipo_rubros ==4){
		    						
		    							$_valor_subsidio_iess=$resDet->valor_rubros_variables_empleados;
		    						
		    						}
		    						
		    						if($_id_tipo_rubros ==5){
		    						
		    							$_valor_impuesto_a_la_renta=$resDet->valor_rubros_variables_empleados;
		    						
		    						}
		    						
		    						if($_id_tipo_rubros ==6){
		    						
		    							$_valor_prestamos_iess=$resDet->valor_rubros_variables_empleados;
		    						
		    						}
		    						
		    						if($_id_tipo_rubros ==7){
		    						
		    							$_valor_prestamos_iess_ph=$resDet->valor_rubros_variables_empleados;
		    						
		    						}
		    						
		    						
		    						if($_id_tipo_rubros ==8){
		    						
		    							$_valor_prestamos_internos=$resDet->valor_rubros_variables_empleados;
		    						
		    						}
		    						
		    					}
		    					
		    				}
		    				
		    			}
		    			
		    			
		    			$_total_ingresos_temporal=0;
		    			
		    			$result_biometrico=$_lectura_biometrico->getBy("id_empleados='$_id_empelados' AND mes_afectacion='$_mes_afectacion' AND anio_afectacion='$_anio_afectacion'");
		    			
		    			if(!empty($result_biometrico)){
		    				
		    				$dias_trabajados=$result_biometrico[0]->dias_trabajados;
		    				$dias_no_trabajados=$result_biometrico[0]->dias_no_trabajados;
		    				$atrasos =new DateTime($result_biometrico[0]->atrasos);
		    				
		    			
		    				$atrasos=$atrasos->format('H:i:s');
		    				
		    				
		    				
		    				$dias_pertenece_mes =$result_biometrico[0]->dias_pertenece_mes;
		    			
		    				$_total_ingresos_temporal=0;
		    				
		    				
		    				
		    				if($dias_pertenece_mes <> $dias_trabajados || $dias_no_trabajados > 0){
		    					
		    					$_valor_dia=$_sueldo_mensual/$dias_pertenece_mes;
		    					$_sueldo_mensual=$_valor_dia*$dias_trabajados;
		    					
		    					
		    				}
		    				
		    				
		    				
		    				if($atrasos>'00:00:00'){
		    					
		    					
		    					$horas = substr($atrasos,0,2);
		    					$minutos = substr($atrasos,3,2); //nos saltamos los : puntos
		    					$segundos = substr($atrasos,6,2);
		    					
		    					
		    					
		    					
		    					$_valor_dia=$_sueldo_mensual/$dias_pertenece_mes;
		    					$_valor_hora=$_valor_dia/8;
		    					$_valor_minuto=$_valor_hora/60;
		    					
		    					
		    					$_valor_final_horas_atrasos=$_valor_hora*$horas;
		    					$_valor_final_minutos_atrasos=$_valor_minuto*$minutos;
		    					 
		    					
		    					
		    					$_valor_atrasos=$_valor_final_horas_atrasos+$_valor_final_minutos_atrasos;
		    					
		    					
		    					
		    				}
		    				
		    				
		    			}
		    			
		    			
		    			
		    			$_total_ingresos_temporal=$_sueldo_mensual+$_valor_bono+$_valor_horas_extras_50_porciento+$_valor_horas_extras_100_porciento+$_valor_comision;
		    			
		    			$_valor_aporte_personal_iess=$_total_ingresos_temporal*0.0935;
		    			
		    			$_valor_decimo_tercero=$_total_ingresos_temporal/12;
		    			$_valor_decimo_cuarto=$_sueldo_mensual/12;
		    			
		    			
		    			$date2 = date('Y-m-d');//
		    			$dias = (strtotime($date2)-strtotime($_fecha_empieza_a_laborar))/86400;
		    			$dias = abs($dias); $dias = floor($dias);
		    			
		    			
		    			if($dias>365){
		    				
		    				$_valor_fondo_reserva=$_total_ingresos_temporal*0.0833;
		    				
		    			}else{
		    				$_valor_fondo_reserva=0;
		    				
		    			}
		    				
		    			
		    			 
		    			
		    			$_total_egresos=$_valor_subsidio_iess+$_valor_aporte_personal_iess+$_valor_impuesto_a_la_renta+$_valor_prestamos_iess+$_valor_prestamos_iess_ph+$_valor_prestamos_internos+$_valor_atrasos;
		    			$_total_ingresos=$_total_ingresos_temporal+$_valor_decimo_tercero+$_valor_decimo_cuarto+$_valor_fondo_reserva;
		    			
		    			$funcion = "ins_nomina";
		    			$parametros = "'$_id_empelados',
		    			'$_mes_afectacion',
		    			'$_anio_afectacion',
		    			'$_sueldo_mensual',
		    			'$_valor_horas_extras_50_porciento',
		    			'$_valor_horas_extras_100_porciento',
		    			'$_valor_comision',
		    			'$_valor_bono',
		    			'$_valor_decimo_tercero',
		    			'$_valor_decimo_cuarto',
		    			'$_valor_fondo_reserva',
		    			'$_total_ingresos_temporal',
		    			'$_valor_subsidio_iess',
		    			'$_valor_aporte_personal_iess',
		    			'$_valor_impuesto_a_la_renta',
		    			'$_valor_prestamos_iess',
		    			'$_valor_prestamos_iess_ph',
		    			'$_valor_prestamos_internos',
		    			'$_valor_atrasos',
		    			'$dias_no_trabajados',
		    			'$_total_egresos',
		    			'$dias_trabajados'";
		    			$rol_pagos->setFuncion($funcion);
		    			$rol_pagos->setParametros($parametros);
		    			$resultado=$rol_pagos->Insert();
		    			
		    		}
		    		
		    		
		    	}
		    		
		    	
		    		 
		    	
		    }
		  
		   
		    $this->redirect("RolPagos", "index");
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
	
	
	
	
	
	
	
	
	
	public function paginate_rol_pagos($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_rol_pagos(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_rol_pagos(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_rol_pagos(1)'>1</a></li>";
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
				$out.= "<li><a href='javascript:void(0);' onclick='load_rol_pagos(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_rol_pagos(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_rol_pagos($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_rol_pagos(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	
	
	
	public function print(){
		


		session_start();
		$rol_pagos = new NominaModel();
		
		$html="";
		$cedula_usuarios = $_SESSION["cedula_usuarios"];
		$fechaactual = getdate();
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$fechaactual=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
			
		$directorio = $_SERVER ['DOCUMENT_ROOT'] . '/nomina';
		$dom=$directorio.'/view/dompdf/dompdf_config.inc.php';
		$domLogo=$directorio.'/view/images/logo_2_milenio.png';
		$logo = '<img src="'.$domLogo.'" alt="Responsive image" width="100" height="50">';
			
			
			
		if(!empty($cedula_usuarios)){
		
		
			if(isset($_GET["id_nomina"])){
					
					
				$_id_nomina = $_GET["id_nomina"];
			
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
						cargos_departamentos.valor_sueldo_cargo_departamentos";
				 
				$tablas   = "public.nomina,
					  public.empleados,
					  public.cargos_departamentos,
					  public.asignacion_empleados_cargos,
    			      public.departamentos";
				 
				$id       = "nomina.id_empleados";
				 
				 
				$where    = "departamentos.id_departamentos = empleados.id_departamentos AND
    			      empleados.id_empleados = nomina.id_empleados AND
					  asignacion_empleados_cargos.id_empleados = empleados.id_empleados AND
					  asignacion_empleados_cargos.id_cargos_departamentos = cargos_departamentos.id_cargos_departamentos AND nomina.id_nomina='$_id_nomina'";
					
					
					
				$resultSetCabeza=$rol_pagos->getCondiciones($columnas, $tablas, $where, $id);
		
		
				if(!empty($resultSetCabeza)){
		
		
				    $_id_empleados     =$resultSetCabeza[0]->id_empleados;
				    $_identificacion_empleados     =$resultSetCabeza[0]->identificacion_empleados;
					$_apellidos_empleados       =$resultSetCabeza[0]->apellidos_empleados;
					$_nombres_empleados   =$resultSetCabeza[0]->nombres_empleados;
					$_direccion_empleados   =$resultSetCabeza[0]->direccion_empleados;
					$_telefono_empleados =$resultSetCabeza[0]->telefono_empleados;
					$_celular_empleados =$resultSetCabeza[0]->celular_empleados;
					$_nombre_cargo_departamentos	=$resultSetCabeza[0]->nombre_cargo_departamentos;
					$_mes_afectacion =$resultSetCabeza[0]->mes_afectacion;
					
					
					if($_mes_afectacion==1){
						
						$mes='ENERO';
						
					}ELSEIF($_mes_afectacion==2 ){
						$mes='FEBRERO';
							
						
					}ELSEIF( $_mes_afectacion==3){
						$mes='MARZO';
							
						
					}ELSEIF( $_mes_afectacion==4){
						$mes='ABRIL';
							
						
					}ELSEIF( $_mes_afectacion==5){
						$mes='MAYO';
							
						
					}ELSEIF( $_mes_afectacion==6){
						$mes='JUNIO';
							
						
					}ELSEIF( $_mes_afectacion==7){
						$mes='JULIO';
							
						
					}ELSEIF( $_mes_afectacion==8){
						$mes='AGOSTO';
							
						
					}ELSEIF($_mes_afectacion==9){
						$mes='SEPTIEMBRE';
							
						
					}ELSEIF($_mes_afectacion==10){
						$mes='OCTUBRE';
							
						
					}ELSEIF($_mes_afectacion==11){
						
						$mes='NOVIEMBRE';
							
					}ELSEIF($_mes_afectacion==12){
						$mes='DICIEMBRE';
							
						
					}
					
					
					$_anio_afectacion =$resultSetCabeza[0]->anio_afectacion;
		
				
					$_sueldo_mensual =$resultSetCabeza[0]->sueldo_mensual;
					$_valor_horas_extras_50_porciento =$resultSetCabeza[0]->valor_horas_extras_50_porciento;
					$_valor_horas_extras_100_porciento =$resultSetCabeza[0]->valor_horas_extras_100_porciento;
					$_valor_comision =$resultSetCabeza[0]->valor_comision;
					$_valor_bono =$resultSetCabeza[0]->valor_bono;
					$_valor_decimo_tercero =$resultSetCabeza[0]->valor_decimo_tercero;
					$_valor_decimo_cuarto =$resultSetCabeza[0]->valor_decimo_cuarto;
					$_valor_fondo_reserva =$resultSetCabeza[0]->valor_fondo_reserva;
					$_total_ingresos =$resultSetCabeza[0]->total_ingresos;
					$_valor_subsidio_iess =$resultSetCabeza[0]->valor_subsidio_iess;

					$_valor_aporte_personal_iess =$resultSetCabeza[0]->valor_aporte_personal_iess;
					$_valor_impuesto_a_la_renta =$resultSetCabeza[0]->valor_impuesto_a_la_renta;
					$_valor_prestamos_iess =$resultSetCabeza[0]->valor_prestamos_iess;
					$_valor_prestamos_iess_ph =$resultSetCabeza[0]->valor_prestamos_iess_ph;
					$_valor_atrasos =$resultSetCabeza[0]->valor_atrasos;
					$_valor_prestamos_internos =$resultSetCabeza[0]->valor_prestamos_internos;
					$_dias_no_lavorados =(int)$resultSetCabeza[0]->dias_no_lavorados;
					$_total_egresos =$resultSetCabeza[0]->total_egresos;
					
					$_dias_laborados =$resultSetCabeza[0]->dias_laborados;
					$_valor_sueldo_cargo_departamentos=$resultSetCabeza[0]->valor_sueldo_cargo_departamentos;
					$_valor_total =$_total_ingresos - $_total_egresos[0];
					$valor_FIN_INGRESOS=0; $valor_FIN_INGRESOS=$_total_ingresos+$_valor_decimo_tercero+$_valor_decimo_cuarto+$_valor_fondo_reserva;
					$valor_FIN=0; $valor_FIN=$valor_FIN_INGRESOS-$_total_egresos;
				
					
					
				
					$html.='<p style="text-align: right;">'.$logo.'<hr style="height: 0px; background-color: black;"></p>';
					$html.= "<table style='width: 100%; margin-top:10px;' border=1 cellspacing=0>";
					$html.= "<tr>";
					$html.='<th style="text-align: center; font-size: 20px; "><b>ROL DE PAGOS INDIVIDUAL</b></br>';
					$html.='<p style="text-align: left; font-size: 12px;">NÚMERO DEL EMPLEADO: '.$_id_empleados.'</p>';
					$html.='<p style="text-align: left; font-size: 12px;">NOMBRE DEL EMPLEADO: '.$_nombres_empleados.'</p>';
					$html.='<p style="text-align: left; font-size: 12px;">NÚMERO DEL CEDULA: '.$_identificacion_empleados.'</p>';
					$html.='<p style="text-align: left; font-size: 12px;">CARGO: '.$_nombre_cargo_departamentos.'</p>';
					$html.='<p style="text-align: left; font-size: 12px;">MES: '.$mes.'-'.$_anio_afectacion.'</p>';
					$html.='</tr>';
					$html.='</table>';
					
					$html.="<table style='width: 100%; margin-top:10px;' border=1 cellspacing=0>";
					$html.='<tr>';
					$html.='<th colspan="4" style="text-align:center; font-size: 13px;">INGRESOS:</th>';
					$html.='<th colspan="4" style="text-align:center; font-size: 13px;">EGRESOS:</th>';
					$html.='</tr>';
					$html.='<tr>';
					$html.='<td colspan="4" style="text-align:left; font-size: 13px; height:30px;" valign=";">
                    <BR><BR>                     
                    SUELDO BASE: '.$_valor_sueldo_cargo_departamentos.'

                    <BR><BR> 
                    DIAS TRABAJADOS: '.$_dias_laborados.'
					<BR><BR>
					SUELDO GANADO: '.$_sueldo_mensual.'
					<BR><BR> 
                    BONO: '.$_valor_bono.'
              		<BR><BR> 
                    COMISION: '.$_valor_comision.'
             		<BR><BR> 
				    HORAS 50 %: '.$_valor_horas_extras_50_porciento.'
					<BR><BR>
					HORAS 100%: '.$_valor_horas_extras_100_porciento.'
                    <BR><BR>
					DECIMO TERCERO: '.$_valor_decimo_tercero.'
                    <BR><BR>
					DECIMO CUARTO: '.$_valor_decimo_cuarto.'
                    <BR><BR>
					FONDO DE RESERVA: '.$_valor_fondo_reserva.'
                	<BR><BR><BR><BR>
					<B>TOTAL INGRESOS:</B> '.$valor_FIN_INGRESOS.'';
				
					
					$html.='<td colspan="4" style="text-align:left; font-size: 13px; height:30px;" valign=";">
                   <BR><BR>
                    SUBSIDIO IESS: '.$_valor_subsidio_iess.'
					<BR><BR>
					APORTE PERSONAL IESS: '.$_valor_aporte_personal_iess.'
					<BR><BR>
                    IMPUESTO A LA RENTA: '.$_valor_impuesto_a_la_renta.'
					<BR><BR>
					PRESTAMOS IESS: '.$_valor_prestamos_iess.'
                    <BR><BR>
					PRESTAMOS IESS PH: '.$_valor_prestamos_iess_ph.'
                    <BR><BR>
					PRESTAMOS INTERNOS: '.$_valor_prestamos_internos.'
                    <BR><BR>
					ATRASOS: '.$_valor_atrasos.'										
                    <BR><BR>
                    DIAS NO LABORADOS: '.$_dias_no_lavorados.'
					<BR><BR><BR><BR><BR><BR><BR><BR>
					
					<B>TOTAL EGRESOS:</B> '.$_total_egresos.'';
		          
					$html.='</tr>';
					$html.='</table>';
					$html.= "<table style='width: 100%; margin-top:0px;' border=1 cellspacing=0>";
					$html.='<p style="text-align: left; font-size: 15px;"><b>&nbsp; TOTAL A RECIBIR: </b>'.$valor_FIN.'';
					$html.='</table>';
					
					$html.="<table style='width: 100%; margin-top:30px;' border=1 cellspacing=0>";
					$html.='<tr>';
					$html.='<th colspan="4" style="text-align:center; font-size: 13px;">RECIBI CONFORME:</th>';
					$html.='<th colspan="4" style="text-align:center; font-size: 13px;">ENTREGUE CONFORME:</th>';
					$html.='</tr>';
					$html.='<tr>';
					$html.='<td colspan="4" style="text-align:center; font-size: 13px; height:70px;" valign="bottom;">EMPLEADO</td>';
					$html.='<td colspan="4" style="text-align:center; font-size: 13px; height:70px;" valign="bottom;">JEFE ADMINISTRATIVO</td>';
						
					$html.='</tr>';
					$html.='</table>';
					
					
						
		
				
		
				}
					
					
				$this->report("RolPagos",array( "resultSet"=>$html));
				die();
					
					
			}
		
		
		
		
		}else{
		
			$this->redirect("Usuarios","sesion_caducada");
		
		}
			
			
		
	}
	
	
	
	
	
	
	
}
?>
