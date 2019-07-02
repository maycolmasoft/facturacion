<?php

class ProductosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		session_start();
		
		$productos=new ProductosModel();
     	$estado = new EstadoModel();
		$resultEst = $estado->getAll("nombre_estado");
		
		$resultEdit = "";
		
		
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
			$nombre_controladores = "Productos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $productos->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol'" );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_productos"])   )
				{

					
					    $_id_productos = $_GET["id_productos"];
						$columnas = " productos.id_productos, 
                                      productos.nombre_productos, 
                                      productos.codigo_productos, 
                                      productos.precio_productos,
								      productos.id_estado,
                                      productos.creado, 
                                      productos.modificado";
						$tablas   =  "public.productos";
						$where    =  "productos.id_productos = '$_id_productos'"; 
						$id       = "productos.id_productos";
							
						$resultEdit = $productos->getCondiciones($columnas ,$tablas ,$where, $id);
					
				}
				
				$this->view("Productos",array(
				    "resultEst"=>$resultEst, "resultEdit" =>$resultEdit
			
				));
				
			}
			else
			{
			    $this->view("Error",array(
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
			$resultado = null;
			$productos=new ProductosModel();
		
			if (isset ($_POST["codigo_productos"])   )
			{
			    
			    $_id_productos = $_POST["id_productos"];
			    $_nombre_productos = $_POST["nombre_productos"];
			    $_codigo_productos = $_POST["codigo_productos"];
			    $_id_estado        = $_POST["id_estado"];
			    $_precio_productos = $_POST["precio_productos"];
			    
			  
			    if($_id_productos > 0){
					
					$columnas =    "nombre_productos = '$_nombre_productos',
                                    codigo_productos = '$_codigo_productos',
                                    id_estado        = '$_id_estado',
                                    precio_productos = '$_precio_productos'";
					
					        $tabla = "productos";
					        
					$where = "id_productos = '$_id_productos'";
					
					$resultado=$productos->UpdateBy($columnas, $tabla, $where);
					
				}else{
				    
					$funcion = "ins_productos";
					$parametros = " '$_nombre_productos',
                                    '$_codigo_productos',
                                    '$_precio_productos',
                                    '$_id_estado'";
					$productos->setFuncion($funcion);
					$productos->setParametros($parametros);
					$resultado=$productos->Insert();
				}
				
		
			}
			$this->redirect("Productos", "index");

		
		
	}
	
	public function borrarId()
	{
	    session_start();
	    $productos=new ProductosModel();
	    
	        if(isset($_GET["id_productos"]))
	        {
	            $id_productos=(int)$_GET["id_productos"];
	            $productos->UpdateBy("id_estado=2","productos","id_productos='$id_productos'");
	        }
	        
	        $this->redirect("Productos", "index");
	    
	}
	
	public function consulta_productos_activos(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    
	    $productos = new ProductosModel();
	   
	    
	    $columnas = " productos.id_productos,
                                      productos.nombre_productos,
                                      productos.codigo_productos,
                                      productos.precio_productos,
                                      productos.creado,
                                      productos.modificado";
	    $tablas   =  "public.productos";
	    $where    =  "productos.id_estado = 1";
	    $id       = "productos.id_productos";
	    
	
	    
	    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    
	    if($action == 'ajax')
	    {
	  
	        
	        
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND (productos.nombre_productos LIKE '".$search."%' OR  productos.codigo_productos LIKE '".$search."%')";
	            
	            $where_to=$where.$where1;
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        $html="";
	        $resultSet=$productos->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 10; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$productos->getCondicionesPagDesc($columnas, $tablas, $where_to, $id, $limit);
	        $count_query   = $cantidadResult;
	        $total_pages = ceil($cantidadResult/$per_page);
	        
	        
	        if($cantidadResult>0)
	        {
	            
	            $html.='<div class="pull-left" style="margin-left:15px;">';
	            $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	            $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	            $html.='</div>';
	            $html.='<button type="button" id="Guardar" name="Guardar" class="btn btn-success pull-left" onclick="DescargaExcel(1)"><i class="glyphicon glyphicon-download-alt"></i></button>';
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<section style="height:425px; overflow-y:scroll;">';
	            $html.= "<table id='tabla_productos_activos' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Codigo</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Precio</th>';
	            
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
	                $html.='<td style="font-size: 11px;">'.$res->codigo_productos.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_productos.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->precio_productos.'</td>';
	                
	                
	             
	                
	                if($id_rol==1){
	                    
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Productos&action=index&id_productos='.$res->id_productos.'" class="btn btn-success" style="font-size:65%;" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Productos&action=borrarId&id_productos='.$res->id_productos.'" class="btn btn-danger" style="font-size:65%;" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
	                    
	                }
	                
	                $html.='</tr>';
	            }
	            
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate_productos_activos("index.php", $page, $total_pages, $adjacents).'';
	            $html.='</div>';
	            
	            
	            
	        }else{
	            $html.='<div class="col-lg-6 col-md-6 col-xs-12">';
	            $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
	            $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	            $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay productos activos registrados...</b>';
	            $html.='</div>';
	            $html.='</div>';
	        }
	        
	        
	        echo $html;
	        die();
	        
	    }
	}
	
	public function excel_productos_activos(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    
	    $productos = new ProductosModel();
	    
	    
	    $columnas = " productos.id_productos,
                                      productos.nombre_productos,
                                      productos.codigo_productos,
                                      productos.precio_productos,
                                      productos.creado,
                                      productos.modificado";
	    $tablas   =  "public.productos";
	    $where    =  "productos.id_estado = 1";
	    $id       = "productos.id_productos";
	    
	    
	    
	    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    
	    if($action == 'ajax')
	    {
	        
	        
	        
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND (productos.nombre_productos LIKE '".$search."%' OR  productos.codigo_productos LIKE '".$search."%')";
	            
	            $where_to=$where.$where1;
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        $resultSet=$productos->getCondiciones($columnas, $tablas, $where_to, $id);

	        $_respuesta=array();
	        
	        array_push($_respuesta, 'Código', 'Nombre', 'Precio');
	        
	        if(!empty($resultSet)){
	            
	            foreach ($resultSet as $res){
	                
	                array_push($_respuesta,$res->codigo_productos,$res->nombre_productos, $res->precio_productos);
	            }
	            echo json_encode($_respuesta);
	        }
	    }
	}
	
	public function consulta_productos_inactivos(){


		session_start();
		$id_rol=$_SESSION["id_rol"];
		 
		$productos = new ProductosModel();
		
		 
		$columnas = " productos.id_productos,
                                      productos.nombre_productos,
                                      productos.codigo_productos,
                                      productos.precio_productos,
                                      productos.creado,
                                      productos.modificado";
		$tablas   =  "public.productos";
		$where    =  "productos.id_estado = 2";
		$id       = "productos.id_productos";
		 
		
		 
		$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
		$search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
		 
		 
		if($action == 'ajax')
		{
			 
			 
			 
			 
			if(!empty($search)){
				 
				 
				$where1=" AND (productos.nombre_productos LIKE '".$search."%' OR  productos.codigo_productos LIKE '".$search."%')";
				 
				$where_to=$where.$where1;
			}else{
				 
				$where_to=$where;
				 
			}
			 
			$html="";
			$resultSet=$productos->getCantidad("*", $tablas, $where_to);
			$cantidadResult=(int)$resultSet[0]->total;
			 
			$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
			 
			$per_page = 10; //la cantidad de registros que desea mostrar
			$adjacents  = 9; //brecha entre páginas después de varios adyacentes
			$offset = ($page - 1) * $per_page;
			 
			$limit = " LIMIT   '$per_page' OFFSET '$offset'";
			 
			$resultSet=$productos->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
			$count_query   = $cantidadResult;
			$total_pages = ceil($cantidadResult/$per_page);
			 
			 
			 
			 
			 
			if($cantidadResult>0)
			{
			    
				$html.='<div class="pull-left" style="margin-left:15px;">';
				$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
				$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
				$html.='</div>';
				$html.='<button type="button" id="Guardar" name="Guardar" class="btn btn-success pull-left" onclick="DescargaExcel(2)"><i class="glyphicon glyphicon-download-alt"></i></button>';
				$html.='<div class="col-lg-12 col-md-12 col-xs-12">';
				$html.='<section style="height:425px; overflow-y:scroll;">';
				$html.= "<table id='tabla_productos_inactivos' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
				$html.= "<thead>";
				$html.= "<tr>";
				$html.='<th style="text-align: left;  font-size: 12px;"></th>';
				$html.='<th style="text-align: left;  font-size: 12px;">Codigo</th>';
				$html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
				$html.='<th style="text-align: left;  font-size: 12px;">Precio</th>';
				 
				if($id_rol==1){
					 
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
					$html.='<td style="font-size: 11px;">'.$res->codigo_productos.'</td>';
					$html.='<td style="font-size: 11px;">'.$res->nombre_productos.'</td>';
					$html.='<td style="font-size: 11px;">'.$res->precio_productos.'</td>';
					 
					 
		
					 
					if($id_rol==1){
						 
						$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Productos&action=index&id_productos='.$res->id_productos.'" class="btn btn-success" style="font-size:65%;" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
						 
					}
					 
					$html.='</tr>';
				}
				 
				 
				 
				$html.='</tbody>';
				$html.='</table>';
				$html.='</section></div>';
				$html.='<div class="table-pagination pull-right">';
				$html.=''. $this->paginate_productos_inactivos("index.php", $page, $total_pages, $adjacents).'';
				$html.='</div>';
				 
				 
				 
			}else{
				$html.='<div class="col-lg-6 col-md-6 col-xs-12">';
				$html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
				$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
				$html.='<h4>Aviso!!!</h4> <b>Actualmente no hay productos inactivos registrados...</b>';
				$html.='</div>';
				$html.='</div>';
			}
			 
			 
			echo $html;
			die();
			 
		}
		
	}
	
	public function excel_productos_inactivos(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    
	    $productos = new ProductosModel();
	    
	    
	    $columnas = " productos.id_productos,
                                      productos.nombre_productos,
                                      productos.codigo_productos,
                                      productos.precio_productos,
                                      productos.creado,
                                      productos.modificado";
	    $tablas   =  "public.productos";
	    $where    =  "productos.id_estado = 2";
	    $id       = "productos.id_productos";
	    
	    
	    
	    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    
	    if($action == 'ajax')
	    {
	        
	        
	        
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND (productos.nombre_productos LIKE '".$search."%' OR  productos.codigo_productos LIKE '".$search."%')";
	            
	            $where_to=$where.$where1;
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        $resultSet=$productos->getCondiciones($columnas, $tablas, $where_to, $id);
	        
	        $_respuesta=array();
	        
	        array_push($_respuesta, 'Código', 'Nombre', 'Precio');
	        
	        if(!empty($resultSet)){
	            
	            foreach ($resultSet as $res){
	                
	                array_push($_respuesta,$res->codigo_productos,$res->nombre_productos, $res->precio_productos);
	            }
	            echo json_encode($_respuesta);
	        }
	    }
	}
	
	
	
	
	
	public function paginate_productos_activos($reload, $page, $tpages, $adjacents) {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_productos_activos(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_productos_activos(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_productos_activos(1)'>1</a></li>";
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
	            $out.= "<li><a href='javascript:void(0);' onclick='load_productos_activos(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_productos_activos(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_productos_activos($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_productos_activos(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}
	
	
	
	public function paginate_productos_inactivos($reload, $page, $tpages, $adjacents) {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_productos_inactivos(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_productos_inactivos(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_productos_inactivos(1)'>1</a></li>";
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
	            $out.= "<li><a href='javascript:void(0);' onclick='load_productos_inactivos(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_productos_inactivos(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_productos_inactivos($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_productos_inactivos(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}
	
	
	
	


	public function AutocompleteCodigo(){
			
		session_start();
		$productos = new ProductosModel();
		$codigo_productos = $_GET['term'];
			
		$resultSet=$productos->getBy("codigo_productos LIKE '$codigo_productos%'");
			
		if(!empty($resultSet)){
	
			foreach ($resultSet as $res){
					
				$_codigo_productos[] = $res->codigo_productos;
			}
			echo json_encode($_codigo_productos);
		}
			
	}
	
	
	
	
	
	public function AutocompleteDevuelveNombres(){
			
		session_start();
		$productos = new ProductosModel();
			
		$codigo_productos = $_POST['codigo_productos'];
		$resultSet=$productos->getBy("codigo_productos = '$codigo_productos'");
			
		$respuesta = new stdClass();
			
		if(!empty($resultSet)){
	
			$respuesta->nombre_productos = $resultSet[0]->nombre_productos;
			$respuesta->codigo_productos = $resultSet[0]->codigo_productos;
			$respuesta->precio_productos = $resultSet[0]->precio_productos;
			$respuesta->id_estado = $resultSet[0]->id_estado;
				
			echo json_encode($respuesta);
		}
			
	}
	
	
	


	public function AutocompleteNombre(){
			
		session_start();
		$productos = new ProductosModel();
		$nombre_productos = $_GET['term'];
			
		$resultSet=$productos->getBy("nombre_productos LIKE '$nombre_productos%'");
			
		if(!empty($resultSet)){
	
			foreach ($resultSet as $res){
					
				$_nombre_productos[] = $res->nombre_productos;
			}
			echo json_encode($_nombre_productos);
		}
			
	}
	
	
	
	
	
	public function AutocompleteDevuelveCodigo(){
			
		session_start();
		$productos = new ProductosModel();
			
		$nombre_productos = $_POST['nombre_productos'];
		$resultSet=$productos->getBy("nombre_productos = '$nombre_productos'");
			
		$respuesta = new stdClass();
			
		if(!empty($resultSet)){
	
			$respuesta->nombre_productos = $resultSet[0]->nombre_productos;
			$respuesta->codigo_productos = $resultSet[0]->codigo_productos;
			$respuesta->precio_productos = $resultSet[0]->precio_productos;
			$respuesta->id_estado = $resultSet[0]->id_estado;
	
			echo json_encode($respuesta);
		}
			
	}
	
	public function generar_reporte(){
	    
	    session_start();
	    
	    $html="";
	    $id_usuarios = $_SESSION["id_usuarios"];
	    $fechaactual = getdate();
	    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	    $fechaactual=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
	    
	    $directorio = $_SERVER ['DOCUMENT_ROOT'] . '/facturacion';
	    $dom=$directorio.'/view/dompdf/dompdf_config.inc.php';
	    $domLogo=$directorio.'/view/images/logo_milenio.png';
	    $logo = '<img src="'.$domLogo.'" alt="Responsive image" width="50" height="50">';
	    $productos = new ProductosModel;  
	    
	    if(!empty($id_usuarios)){
	        
	        
	        if(isset($_POST["search_activos"]) ){
	            
	            
	          
	            $search = $_POST["search_activos"];
	           
	            $where_to="";
	            $where1="";
	            //$_id_productos = $_GET["id_productos"];
	            $columnas = " productos.id_productos,
                                      productos.nombre_productos,
                                      productos.codigo_productos,
                                      productos.precio_productos,
								      productos.id_estado,
                                      productos.creado,
                                      productos.modificado";
	            $tablas   =  "public.productos";
	            $where    =  "1=1";
	            $id       = "productos.id_productos";
	            
	            $resultEdit = $productos->getCondiciones($columnas ,$tablas ,$where, $id);
	            
	            
	            
	            
	            if(!empty($search)){
	                
	                
	                $where1=" AND (productos.codigo_productos LIKE '%".$search."%' OR productos.nombre_productos LIKE '%".$search."%')";
	                
	                $where_to=$where.$where1;
	            }else{
	          
	                $where_to=$where;
	                
	            }
	            
	            
	            
	            
	            
	            
	            $resultSet=$productos->getCondicionesDesc($columnas, $tablas, $where_to, $id);
	            
	            
	            $html.='<p style="text-align: right;">'.$logo.'<hr style="height: 2px; background-color: black;"></p>';
	            $html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
	            $html.='<p style="text-align: center; font-size: 16px;"><b>PRODUCTOS REGISTRADOS</b></p>';
	            
	            
	            if(!empty($resultSet)){
	                $cantidadResult=count($resultSet);
	                
	                
	                $html.='<span style="text-align: left;  font-size: 15px;"><strong>Total Registros: </strong>'.$cantidadResult.'</span>';
	                $html.= "<table style='width: 100%;' border=1 cellspacing=0>";
	                $html.= "<thead>";
	                $html.= "<tr>";
	                $html.='<th style="text-align: left;  font-size: 13px;"></th>';
	                $html.='<th style="text-align: left;  font-size: 13px;">Nombre</th>';
	                $html.='<th style="text-align: left;  font-size: 13px;">Código</th>';
	                $html.='<th style="text-align: left;  font-size: 13px;">Precio</th>';
	                $html.='<th style="text-align: left;  font-size: 13px;">Fecha Ingreso</th>';
	                $html.='</tr>';
	                $html.='</thead>';
	                $html.='<tbody>';
	                
	                $i=0;
	                $Excelente=0;
	                $Bueno=0;
	                $Reguar=0;
	                $Malo=0;
	                
	                foreach ($resultSet as $res)
	                {
	                   
	                    $i++;
	                    $html.='<tr>';
	                    $html.='<td style="font-size: 11px;">'.$i.'</td>';
	                    $html.='<td style="font-size: 11px;">'.$res->nombre_productos.'</td>';
	                    $html.='<td style="font-size: 11px;">'.$res->codigo_productos.'</td>';
	                    $html.='<td style="font-size: 11px;">'.$res->precio_productos.'</td>';
	                    $html.='<td style="font-size: 11px;">'.date("d/m/Y", strtotime($res->creado)).'</td>';
	                    $html.='</tr>';
	                }
	                
	                
	                $html.='</tbody>';
	                $html.='</table>';
	                
	                
	            
	                
	            }
	            
	            
	            
	            $this->report("Productos",array( "resultSet"=>$html));
	            die();
	            
	            
	        }
	        
	        
	        
	        
	    }else{
	        
	        $this->redirect("Usuarios","sesion_caducada");
	        
	    }
	    
	    
	    
	    
	}
	
	public function search(){
	    
	    session_start();
	    
	    $productos = new ProductosModel();
	    $where_to="";
	    $columnas = " productos.id_productos,
                                      productos.nombre_productos,
                                      productos.codigo_productos,
                                      productos.precio_productos,
								      productos.id_estado,
                                      productos.creado,
                                      productos.modificado";
	    $tablas   =  "public.productos";
	    $where    =  "productos.id_productos = '$_id_productos'";
	    $id       = "productos.id_productos";
	    
	    
	    
	    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    $where2="";
	    
	    
	    if($action == 'ajax')
	    {
	        
	        if(!empty($search)){
	            
	            
	     
	            
	            $where1=" AND (productos.nombre_productos LIKE '%".$search."%' OR productos.codigo_productos LIKE '%".$search."%')";
	            
	            $where_to=$where.$where1;
	        }else{
	  
	            
	            $where_to=$where;
	            
	        }
	        
	        $html="";
	        $resultSet=$evaluacion->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 50; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$evaluacion->getCondicionesPagDesc($columnas, $tablas, $where_to, $id, $limit);
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
	            $html.= "<table id='tabla_calificaciones_realizadas' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Código</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Precio</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Fecha Registro</th>';
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            $i=0;
	            $Excelente=0;
	            $Bueno=0;
	            $Reguar=0;
	            $Malo=0;
	            foreach ($resultSet as $res)
	            {
	                
	                $i++;
	                $html.='<tr>';
	                $html.='<td style="font-size: 11px;">'.$i.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_productos.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->codigo_productos.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->precio_productos.'</td>';
	                $html.='<td style="font-size: 11px;">'.date("d/m/Y", strtotime($res->creado)).'</td>';
	                $html.='</tr>';
	            }
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate_load_calificaciones("index.php", $page, $total_pages, $adjacents).'';
	            $html.='</div>';
	            
	            
	            
	        }else{
	            $html.='<div class="col-lg-6 col-md-6 col-xs-12">';
	            $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
	            $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	            $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay calificaciones registradas...</b>';
	            $html.='</div>';
	            $html.='</div>';
	        }
	        
	        echo $html;
	        die();
	        
	    }
	    
	}
	
	
	public function paginate_load_calificaciones($reload, $page, $tpages, $adjacents) {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_calificaciones(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_calificaciones(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_calificaciones(1)'>1</a></li>";
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
	            $out.= "<li><a href='javascript:void(0);' onclick='load_calificaciones(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_calificaciones(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_calificaciones($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_calificaciones(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}
	
}
?>