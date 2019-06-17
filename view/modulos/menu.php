
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
            <li style="<?php echo getcontrolador("TipoRubros",$controladores) ?>"><a href="index.php?controller=TipoRubros&action=index"><i class="fa fa-circle-o"></i>Tipo Rubros</a></li>
            <li style="<?php echo getcontrolador("Departamentos",$controladores) ?>"><a href="index.php?controller=Departamentos&action=index"><i class="fa fa-circle-o"></i>Departamentos</a></li>
            <li style="<?php echo getcontrolador("CargosDepartamentos",$controladores) ?>"><a href="index.php?controller=CargosDepartamentos&action=index"><i class="fa fa-circle-o"></i> Cargos Departamentos</a></li>
            <li style="<?php echo getcontrolador("Formulas",$controladores) ?>"><a href="index.php?controller=Formulas&action=index"><i class="fa fa-circle-o"></i>Formulas</a></li>
            <li style="<?php echo getcontrolador("Empleados",$controladores) ?>"><a href="index.php?controller=Empleados&action=index"><i class="fa fa-circle-o"></i> Empleados</a></li>
            <li style="<?php echo getcontrolador("AsignacionEmpleados",$controladores) ?>"><a href="index.php?controller=AsignacionEmpleados&action=index"><i class="fa fa-circle-o"></i> Asignar Rubros Empleados</a></li>
           
          </ul>
        </li>
        
       
         <li class="treeview"  style="<?php echo getcontrolador("MenuContador",$controladores) ?>">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Procesos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li style="<?php echo getcontrolador("LecturasBiometrico",$controladores) ?>"><a href="index.php?controller=Procesos&action=index"><i class="fa fa-circle-o"></i>Subir Biometrico</a></li>
            <li style="<?php echo getcontrolador("RubrosVariables",$controladores) ?>"><a href="index.php?controller=RubrosVariables&action=index"><i class="fa fa-circle-o"></i> Rubros Variables</a></li>
            <li style="<?php echo getcontrolador("RolPagos",$controladores) ?>"><a href="index.php?controller=RolPagos&action=index"><i class="fa fa-circle-o"></i> Generar Rol Pagos</a></li>
            <li style="<?php echo getcontrolador("CierreNomina",$controladores) ?>"><a href="index.php?controller=CierreNomina&action=index"><i class="fa fa-circle-o"></i> Cierre Nómina</a></li>
         
          </ul>
        </li>
        
       
        <li class="treeview"  style="<?php echo getcontrolador("MenuAuditoria",$controladores) ?>">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Auditoría</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li style="<?php echo getcontrolador("Sesiones",$controladores) ?>"><a href="index.php?controller=Sesiones&action=index">Sesiones</a></li>
            <li style="<?php echo getcontrolador("ConsultaRoles",$controladores) ?>"><a href="index.php?controller=ConsultaRoles&action=index">Roles de Pago</a></li>
          
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
          
          </ul>
        </li>
      </ul>









