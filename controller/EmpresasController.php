<?php

class EmpresasController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	    
	    session_start();
	    
	    $empresas=new EmpresaModel();
	    
	    
	    $resultEdit = "";
	    
	    
	    if (isset(  $_SESSION['nombre_usuarios']) )
	    {
	        $nombre_controladores = "Empresas";
	        $id_rol= $_SESSION['id_rol'];
	        $resultPer = $empresas->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol'" );
	        
	        if (!empty($resultPer))
	        {
	            if (isset ($_GET["id_empresa"])   )
	            {
	                
	                
	                $_id_empresa = $_GET["id_empresa"];
	                $columnas = " empresa.id_empresa, 
                                  empresa.nombre_empresa, 
                                  empresa.ruc_empresa, 
                                  empresa.direccion_empresa, 
                                  empresa.sucursal_empresa, 
                                  empresa.telefono_empresa";
	                $tablas   =  "public.empresa";
	                $where    =  "empresa.id_empresa = '$_id_empresa'";
	                $id       = "empresa.id_empresa";
	                
	                $resultEdit = $empresas->getCondiciones($columnas ,$tablas ,$where, $id);
	                
	            }
	            
	            $this->view("Empresas",array(
	                "resultEst"=>$resultEst, "resultEdit" =>$resultEdit
	                
	            ));
	            
	        }
	        else
	        {
	            $this->view("Error",array(
	                "resultado"=>"No tiene Permisos de Acceso a Empresas"
	                
	            ));
	            
	            exit();
	        }
	        
	    }
	    else{
	        
	        $this->redirect("Usuarios","sesion_caducada");
	        
	    }
	    
	}
	
	public function InsertaEmpresas(){
			
			session_start();
			$resultado = null;
			$empresas=new EmpresaModel();
		
			if (isset ($_POST["nombre_empresa"])   )
			{
			    
			    
			    $_id_empresa = $_POST["id_empresa"];
			    $_nombre_empresa = $_POST["nombre_empresa"];
			    $_ruc_empresa = $_POST["ruc_empresa"];
			    $_direccion_empresa = $_POST["direccion_empresa"];
			    $_sucursal_empresa = $_POST["sucursal_empresa"];
			    $_telefono_empresa = $_POST["telefono_empresa"];
			    
			  
			    if(id_empresa > 0){
					
					$columnas =    "nombre_empresa = '$_nombre_empresa',
                                    ruc_empresa = '$_ruc_empresa',
                                    direccion_empresa = '$_direccion_empresa',
                                    sucursal_empresa = '$_sucursal_empresa',
                                    telefono_empresa = '$_telefono_empresa'";
					
					        $tabla = "empresa";
					        
					$where = "empresa.id_empresa = '$_id_empresa'";
					
					$resultado=$empresas->UpdateBy($columnas, $tabla, $where);
					
				}else{
				    
					$funcion = "ins_empresas";
					$parametros = " '$_nombre_empresa',
                                    '$_ruc_empresa',
                                    '$_direccion_empresa',
                                    '$_sucursal_empresa',
                                    '$_telefono_empresa'";
					$empresas->setFuncion($funcion);
					$empresas->setParametros($parametros);
					$resultado=$empresas->Insert();
				}
				
		
			}
			$this->redirect("Empresas", "index");

		
		
	}
	
	public function borrarId()
	{
	    
	    session_start();
	    $empresas=new EmpresaModel();
	    $nombre_controladores = "Empresas";
	    $id_rol= $_SESSION['id_rol'];
	    $resultPer = $empresas->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	    
	    if (!empty($resultPer))
	    {
	        if(isset($_GET["id_empresa"]))
	        {
	            $id_empresa=(int)$_GET["id_empresa"];
	            
	            
	            
	            $empresas->deleteBy(" id_empresa",$id_empresa);
	            
	        }
	        
	        $this->redirect("Empresas", "index");
	        
	        
	    }
	    else
	    {
	        $error="No tiene permiso para eliminar empresas";
	        die($error);
	    }
	    
	}
	
	public function Consulta_Empresas(){
	    
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    $usuarios= new UsuariosModel();
	    
	    $empresas=new EmpresaModel();
	    
	    $where_to="";
	    $columnas = "
                      empresa.id_empresa, 
                      empresa.nombre_empresa, 
                      empresa.ruc_empresa, 
                      empresa.direccion_empresa, 
                      empresa.sucursal_empresa, 
                      empresa.telefono_empresa
                      ";
	    $tablas   = "
                   public.empresa
	        
                    ";
	    $where    = "empresa.id_empresa = id_empresa";
	    
	    $id       = "empresa.id_empresa";
	    
	    
	    
	    
	    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    
	    if($action == 'ajax')
	    {
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND (nombre_empresa LIKE '%".$search."%' OR ruc_empresa LIKE '%".$search."%' OR direccion_empresa LIKE '%".$search."%')
                ";
	            
	            $where_to=$where.$where1;
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        $html="";
	        $resultSet=$empresas->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 15; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$empresas->getCondicionesPagDesc($columnas, $tablas, $where_to, $id, $limit);
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
	            $html.= "<table id='tabla_Empresas' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
	            $html.='<th style="text-align: center;  font-size: 12px;">Ruc</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Dirección</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Sucursal</th>';
	            $html.='<th style="text-align: center;  font-size: 12px;">Teléfono</th>';
	            
	            
	            
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            
	            $i=0;
	            
	            foreach ($resultSet as $res)
	            {
	                
	                
	                $i++;
	                $html.='<tr>';
	                $html.='<td style="text-align: center; font-size: 11px;">'.$i.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_empresa.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->ruc_empresa.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->direccion_empresa.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->sucursal_empresa.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->telefono_empresa.'</td>';
	                
	                if($id_rol==1){
	                    
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Empresas&action=index&id_empresa='.$res->id_empresa.'" class="btn btn-success" style="font-size:65%;" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
	                    $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Empresas&action=borrarId&id_empresa='.$res->id_empresa.'" class="btn btn-danger" style="font-size:65%;" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
	                    
	                }
	                
	                
	                
	                
	                
	                $html.='</tr>';
	            }
	            
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate_Empresas("index.php", $page, $total_pages, $adjacents).'';
	            $html.='</div>';
	            
	            
	            
	        }else{
	            $html.='<div class="col-lg-6 col-md-6 col-xs-12">';
	            $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
	            $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	            $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay Empresas registradas...</b>';
	            $html.='</div>';
	            $html.='</div>';
	        }
	        
	        
	        echo $html;
	        die();
	        
	    }
	    
	    
	}
	
	public function paginate_Empresas($reload, $page, $tpages, $adjacents) {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_Empresas(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_Empresas(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_Empresas(1)'>1</a></li>";
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
	            $out.= "<li><a href='javascript:void(0);' onclick='load_Empresas(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_Empresas(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_Empresas($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_Empresas(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}
	
	
}
?>