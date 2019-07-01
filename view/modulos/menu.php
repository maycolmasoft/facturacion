
<?php 
$controladores=$_SESSION['controladores'];
 function getcontrolador($controlador,$controladores){
 	$display="display:none";
 	
 	if (!empty($controladores))
 	{
 	foreach ($controladores as $res)
 	{
 		if($res->nombre_controladores==$controlador)
 		{
 			$display= "display:block";
 			break;
 		}
 	}
 	}
 	
 	return $display;
 }
 
?>


      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li class="treeview"  style="<?php echo getcontrolador("MenuAdministracion",$controladores) ?>"  >
          <a href="#">
            <i class="fa fa-folder"></i> <span>Administración</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li style="<?php echo getcontrolador("Usuarios",$controladores) ?>"><a href="index.php?controller=Usuarios&action=index"><i class="fa fa-circle-o"></i> Usuarios</a></li>
            <li style="<?php echo getcontrolador("Controladores",$controladores) ?>"><a href="index.php?controller=Controladores&action=index"><i class="fa fa-circle-o"></i> Controladores</a></li>
            <li style="<?php echo getcontrolador("Roles",$controladores) ?>"><a href="index.php?controller=Roles&action=index"><i class="fa fa-circle-o"></i> Roles de Usuario</a></li>
            <li style="<?php echo getcontrolador("PermisosRoles",$controladores) ?>"><a href="index.php?controller=PermisosRoles&action=index"><i class="fa fa-circle-o"></i> Permisos Roles</a></li>
         </ul>
       </li>
        
        
        <li class="treeview"  style="<?php echo getcontrolador("MenuMantenimiento",$controladores) ?>"  >
          <a href="#">
            <i class="fa fa-folder"></i> <span>Mantenimiento</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li style="<?php echo getcontrolador("Clientes",$controladores) ?>"><a href="index.php?controller=Clientes&action=index"><i class="fa fa-circle-o"></i> Clientes</a></li>
            <li style="<?php echo getcontrolador("Productos",$controladores) ?>"><a href="index.php?controller=Productos&action=index"><i class="fa fa-circle-o"></i> Productos</a></li>
          </ul>
        </li>
        
       
       
       <li class="treeview"  style="<?php echo getcontrolador("MenuProcesos",$controladores) ?>"  >
          <a href="#">
            <i class="fa fa-folder"></i> <span>Procesos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li style="<?php echo getcontrolador("Facturar",$controladores) ?>"><a href="index.php?controller=Facturar&action=index"><i class="fa fa-circle-o"></i> Facturar</a></li>
          </ul>
        </li>
        
       
       
       
        <li class="treeview"  style="<?php echo getcontrolador("MenuReportes",$controladores) ?>">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li style="<?php echo getcontrolador("Sesiones",$controladores) ?>"><a href="index.php?controller=Sesiones&action=index">Sesiones</a></li>
            <li style="<?php echo getcontrolador("ConsultaRoles",$controladores) ?>"><a href="index.php?controller=ConsultaRoles&action=index">Roles de Pago</a></li>
            <li style="<?php echo getcontrolador("ConsultaFactura",$controladores) ?>"><a href="index.php?controller=ConsultaFactura&action=index">Consultar Factura</a></li>
          
          </ul>
        </li>
        
        
      </ul>









