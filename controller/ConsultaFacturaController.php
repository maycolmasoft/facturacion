<?php
class ConsultaFacturaController extends ControladorBase{
    public function index(){	  
        
    $consulta= new ConsultaFacturaModel();
    $mensaje="";
    $error="";
    session_start();
    
    if(empty( $_SESSION)){
        
        $this->redirect("Usuarios","sesion_caducada");
        return;
    }
    
    $nombre_controladores = "ConsultaFactura";
    $id_rol= $_SESSION['id_rol'];
    $resultPer = $consulta->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
    
    if (empty($resultPer)){
        
        $this->view("Error",array(
            "resultado"=>"No tiene Permisos de Acceso de consulta Factura"
            
        ));
        exit();
    }
    
    
    
    $this->view("ConsultaFactura",array(
        "mensaje"=>$mensaje,
        "error"=> $error
        
    ));
    }
    
    public function Consulta_Factura(){
        
        
        session_start();
        $id_rol=$_SESSION["id_rol"];
        $usuarios= new UsuariosModel();
        $consulta= new ConsultaFacturaModel();
        $clientes= new ClientesModel();
        $estadofactura= new EstadoFacturaModel();
        
        $where_to="";
        $columnas = "
                      factura_cabeza.id_factura_cabeza, 
                      clientes.id_clientes, 
                      clientes.razon_social_clientes, 
                      clientes.identificacion_clientes, 
                      factura_cabeza.numero_factura_cabeza, 
                      factura_cabeza.fecha_factura_cabeza, 
                      factura_cabeza.subtotal_factura_cabeza, 
                      factura_cabeza.total_factura_cabeza, 
                      usuarios.cedula_usuarios, 
                      usuarios.nombre_usuarios, 
                      estado_factura.id_estado_factura, 
                      estado_factura.nombre_estado_factura
                      ";
        $tablas   = "
                      public.clientes, 
                      public.factura_cabeza, 
                      public.estado_factura, 
                      public.usuarios
            
                    ";
        $where    = " factura_cabeza.id_clientes = clientes.id_clientes AND
                      factura_cabeza.id_estado_factura = estado_factura.id_estado_factura AND
                      usuarios.id_usuarios = factura_cabeza.id_usuarios";
        
        $id       = "factura_cabeza.id_factura_cabeza";
        
        
        
        
        $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
        $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
        
        
        if($action == 'ajax')
        {
            
            if(!empty($search)){
                
                
                $where1=" AND (razon_social_clientes LIKE '%".$search."%' OR identificacion_clientes LIKE '%".$search."%' OR numero_factura_cabeza LIKE '%".$search."%')
                ";
                
                $where_to=$where.$where1;
            }else{
                
                $where_to=$where;
                
            }
            
            $html="";
            $resultSet=$consulta->getCantidad("*", $tablas, $where_to);
            $cantidadResult=(int)$resultSet[0]->total;
            
            $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
            
            $per_page = 15; //la cantidad de registros que desea mostrar
            $adjacents  = 9; //brecha entre páginas después de varios adyacentes
            $offset = ($page - 1) * $per_page;
            
            $limit = " LIMIT   '$per_page' OFFSET '$offset'";
            
            $resultSet=$consulta->getCondicionesPagDesc($columnas, $tablas, $where_to, $id, $limit);
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
                $html.= "<table id='tabla_ConsultaFactura' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
                $html.= "<thead>";
                $html.= "<tr>";
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Cédula</th>';
                $html.='<th style="text-align: center;  font-size: 12px;">Nombre</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Número de Factura</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Fecha</th>';
                $html.='<th style="text-align: center;  font-size: 12px;">Valor</th>';
                $html.='<th style="text-align: center; font-size: 12px;">Usuario</th>';
                $html.='<th style="text-align: center; font-size: 12px;">Estado</th>';
                
                
                $html.='</tr>';
                $html.='</thead>';
                $html.='<tbody>';
                
                
                $i=0;
                
                foreach ($resultSet as $res)
                {
                    
                    
                    $i++;
                    $html.='<tr>';
                    $html.='<td style="text-align: center; font-size: 11px;">'.$i.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->identificacion_clientes.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->razon_social_clientes.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->numero_factura_cabeza.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fecha_factura_cabeza.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->total_factura_cabeza.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre_usuarios.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre_estado_factura.'</td>';
                    $html.='<td style="color:#000000;font-size:80%;"><span class="pull-right"><a href="index.php?controller=ConsultaFactura&action=generar_reporte_factura&id_factura_cabeza='.$res->id_factura_cabeza.'" target="_blank"><i class="glyphicon glyphicon-print"></i></a></span></td>';
                    
                    
                    
                    
                    
                    
                    $html.='</tr>';
                }
                
                
                
                $html.='</tbody>';
                $html.='</table>';
                $html.='</section></div>';
                $html.='<div class="table-pagination pull-right">';
                $html.=''. $this->paginate_Consulta_Factura("index.php", $page, $total_pages, $adjacents).'';
                $html.='</div>';
                
                
                
            }else{
                $html.='<div class="col-lg-6 col-md-6 col-xs-12">';
                $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
                $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay Clientes registrados...</b>';
                $html.='</div>';
                $html.='</div>';
            }
            
            
            echo $html;
            die();
            
        }
        
        
    }
    
    
    public function paginate_Consulta_Factura($reload, $page, $tpages, $adjacents) {
        
        $prevlabel = "&lsaquo; Prev";
        $nextlabel = "Next &rsaquo;";
        $out = '<ul class="pagination pagination-large">';
        
        // previous label
        
        if($page==1) {
            $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
        } else if($page==2) {
            $out.= "<li><span><a href='javascript:void(0);' onclick='load_ConsultaFactura(1)'>$prevlabel</a></span></li>";
        }else {
            $out.= "<li><span><a href='javascript:void(0);' onclick='load_ConsultaFactura(".($page-1).")'>$prevlabel</a></span></li>";
            
        }
        
        // first label
        if($page>($adjacents+1)) {
            $out.= "<li><a href='javascript:void(0);' onclick='load_ConsultaFactura(1)'>1</a></li>";
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
                $out.= "<li><a href='javascript:void(0);' onclick='load_ConsultaFactura(1)'>$i</a></li>";
            }else {
                $out.= "<li><a href='javascript:void(0);' onclick='load_ConsultaFactura(".$i.")'>$i</a></li>";
            }
        }
        
        // interval
        
        if($page<($tpages-$adjacents-1)) {
            $out.= "<li><a>...</a></li>";
        }
        
        // last
        
        if($page<($tpages-$adjacents)) {
            $out.= "<li><a href='javascript:void(0);' onclick='load_ConsultaFactura($tpages)'>$tpages</a></li>";
        }
        
        // next
        
        if($page<$tpages) {
            $out.= "<li><span><a href='javascript:void(0);' onclick='load_ConsultaFactura(".($page+1).")'>$nextlabel</a></span></li>";
        }else {
            $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
        }
        
        $out.= "</ul>";
        return $out;
    }
    
    public function generar_reporte_factura()
    {
        session_start();
        
        ///DATOS DE CABECERA
        $factura_cabeza = new FacturaCabezaModel( );
        
        $id_factura_cabeza =  (isset($_REQUEST['id_factura_cabeza'])&& $_REQUEST['id_factura_cabeza'] !=NULL)?$_REQUEST['id_factura_cabeza']:'';
        
        $datos_reporte = array();
        
        $columnas = " factura_cabeza.id_factura_cabeza, 
                      factura_cabeza.numero_factura_cabeza, 
                      factura_cabeza.fecha_factura_cabeza,
                      factura_cabeza.id_factura_cabeza, 
                      factura_cabeza.subtotal_factura_cabeza, 
                      iva.id_iva, 
                      iva.porcentaje_iva, 
                      factura_cabeza.valor_iva_factura_cabeza, 
                      descuento.id_descuento, 
                      descuento.porcentaje_descuento, 
                      factura_cabeza.valor_descuento_factura_cabeza, 
                      factura_cabeza.total_factura_cabeza, 
                      clientes.razon_social_clientes, 
                      clientes.identificacion_clientes, 
                      estado_factura.id_estado_factura, 
                      estado_factura.nombre_estado_factura, 
                      tipo_pago.id_tipo_pago, 
                      tipo_pago.nombre_tipo_pago, 
                      empresa.id_empresa, 
                      empresa.nombre_empresa, 
                      empresa.ruc_empresa, 
                      empresa.direccion_empresa, 
                      empresa.sucursal_empresa, 
                      empresa.telefono_empresa, 
                      empresa.creado, 
                      empresa.modificado";
        
        $tablas = "   public.factura_cabeza, 
                      public.clientes, 
                      public.estado_factura, 
                      public.tipo_pago, 
                      public.empresa,
                      public.iva, 
                      public.descuento";
        $where= " factura_cabeza.id_clientes = clientes.id_clientes AND
                  factura_cabeza.id_estado_factura = estado_factura.id_estado_factura AND
                  factura_cabeza.id_tipo_pago = tipo_pago.id_tipo_pago AND
                  factura_cabeza.id_empresa = empresa.id_empresa AND
                  factura_cabeza.id_descuento = descuento.id_descuento AND
                  iva.id_iva = factura_cabeza.id_iva
                  AND factura_cabeza.id_factura_cabeza='$id_factura_cabeza'";
        $id="factura_cabeza.id_factura_cabeza";
        
        $rsdatos = $factura_cabeza->getCondiciones($columnas, $tablas, $where, $id);
        
        $datos_reporte['NOMBREEMPRESA']=$rsdatos[0]->nombre_empresa;
        $datos_reporte['DIRECCIONEMPRESA']=$rsdatos[0]->direccion_empresa;
        $datos_reporte['SUCURSALEMPRESA']=$rsdatos[0]->sucursal_empresa;
        $datos_reporte['TELEFONO']=$rsdatos[0]->telefono_empresa;
        $datos_reporte['RUC']=$rsdatos[0]->ruc_empresa;
        $datos_reporte['NUMFACTURA']=$rsdatos[0]->numero_factura_cabeza;
        $datos_reporte['FECHAUTORIZ']=$rsdatos[0]->fecha_factura_cabeza;
        $datos_reporte['NOMBCLIENTE']=$rsdatos[0]->razon_social_clientes;
        $datos_reporte['CEDULACLIENTE']=$rsdatos[0]->identificacion_clientes;
        $datos_reporte['FECHAEMISION']=$rsdatos[0]->fecha_factura_cabeza;
        $datos_reporte['SUBTOTAL']=number_format((float)$rsdatos[0]->subtotal_factura_cabeza, 2, ',', '.');
        $datos_reporte['PORCENTAJEDESCUENTOS']=$rsdatos[0]->porcentaje_descuento;
        $datos_reporte['DESCUENTOS']=number_format((float)$rsdatos[0]->valor_descuento_factura_cabeza, 2, ',', '.');
        $datos_reporte['PORCENTAJEIVA']=$rsdatos[0]->porcentaje_iva;
        $datos_reporte['IVA']=number_format((float)$rsdatos[0]->valor_iva_factura_cabeza, 2, ',', '.');
        $datos_reporte['TOTALFACT']=number_format((float)$rsdatos[0]->total_factura_cabeza, 2, ',', '.');
            
        
        
        
        //////DATOS DEL DETALLE
        
        $columnas = " factura_cabeza.id_factura_cabeza, 
                      factura_cabeza.numero_factura_cabeza, 
                      iva.nombre_iva, 
                      iva.porcentaje_iva, 
                      factura_cabeza.fecha_factura_cabeza, 
                      factura_cabeza.subtotal_factura_cabeza, 
                      factura_cabeza.valor_iva_factura_cabeza, 
                      factura_cabeza.valor_descuento_factura_cabeza, 
                      factura_cabeza.total_factura_cabeza, 
                      productos.id_productos, 
                      productos.nombre_productos, 
                      productos.codigo_productos, 
                      productos.precio_productos,
                      factura_detalle.id_factura_detalle, 
                      factura_detalle.cantidad_factura_detalle, 
                      factura_detalle.precio_unitario_factura_detalle, 
                      factura_detalle.total_factura_detalle";
        
        $tablas = "   public.factura_detalle, 
                      public.factura_cabeza, 
                      public.iva, 
                      public.productos";
        $where= "     factura_detalle.id_productos = productos.id_productos AND
                      factura_cabeza.id_factura_cabeza = factura_detalle.id_factura_cabeza AND
                      iva.id_iva = factura_cabeza.id_iva AND  
                      factura_cabeza.id_factura_cabeza='$id_factura_cabeza'";
        $id="factura_detalle.id_factura_detalle";
        
        $facturadetalle = $factura_cabeza->getCondiciones($columnas, $tablas, $where, $id);
        
       
        
        
        
        $html='';
        
        
        $html.='<table class="info" style="width:100%;" border=1>';
        $html.='<tr>';
        $html.='<th colspan="2" style="text-align: center; font-size: 11px;">Cantidad</th>';
        $html.='<th colspan="2" style="text-align: center; font-size: 11px;">Descripción</th>';
        $html.='<th colspan="2" style="text-align: center; font-size: 11px;">Precio Unitario</th>';
        $html.='<th colspan="2" style="text-align: center; font-size: 11px;">Total</th>';
        $html.='</tr>';
        
        
        
        
        foreach ($facturadetalle as $res)
        {
            
            $html.='<tr >';
            $html.='<td colspan="2" style="text-align: center; font-size: 11px;">'.$res->cantidad_factura_detalle.'</td>';
            $html.='<td colspan="2" style="text-align: center; font-size: 11px;">'.$res->nombre_productos.'</td>';
            $html.='<td colspan="2" style="text-align: center; font-size: 11px;">'.number_format((float)$res->precio_productos, 2, ',', '.').'</td>';
            $html.='<td colspan="2" style="text-align: center; font-size: 11px;">'.number_format((float)$res->total_factura_detalle, 2, ',', '.').'</td>';
            
            
            $html.='</td>';
            $html.='</tr>';
        }
        
        $html.='</table>';
        
        $datos_reporte['DETALLE_FACTURA']= $html;
        
        
        
        
        $this->verReporte("ConsultaFactura", array('datos_reporte'=>$datos_reporte ));
        
        
        
    }
    
    
}

?>