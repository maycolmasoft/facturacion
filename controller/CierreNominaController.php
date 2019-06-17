<?php

class CierreNominaController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    //maycol
    
    public function index(){
        
        
        $cierre_nomina = new CierreNominaModel();
        $resultSet=$cierre_nomina->getBy("id_estado=1");
        $resultEdit = "";
        
        session_start();
        
        if (isset($_SESSION['nombre_usuarios']))
        {
            $nombre_controladores = "CierreNomina";
            $id_rol= $_SESSION['id_rol'];
            $resultPer = $cierre_nomina->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
            
            if (!empty($resultPer))
            {
                
                
                if (isset ($_GET["id_cierre_nomina"]))
                {
                    
                   
                        
                        $_id_cierre_nomina = $_GET["id_cierre_nomina"];
                        $columnas = " id_cierre_nomina, mes_cierre_nomina, anio_cierre_nomina, id_estado";
                        $tablas   = "cierre_nomina";
                        $where    = "id_cierre_nomina = '$_id_cierre_nomina' ";
                        $id       = "id_cierre_nomina";
                        
                        $resultEdit = $cierre_nomina->getCondiciones($columnas ,$tablas ,$where, $id);
                        
                    
                    
                }
                
                
                $this->view("CierreNomina",array(
                    "resultSet"=>$resultSet, "resultEdit" =>$resultEdit
                    
                ));
                
            }
            else
            {
                $this->view("Error",array(
                    "resultado"=>"No tiene Permisos de Acceso a Cierre Nomina"
                    
                ));
                
                exit();
            }
            
        }
        else{
            
            $this->redirect("Usuarios","sesion_caducada");
            
        }
        
    }
    
    public function InsertaCierreNomina(){
        
        session_start();
        
       
        if (isset($_SESSION["id_usuarios"]))
        {
          
              $cierre_nomina = new CierreNominaModel();
      
            if (isset ($_POST["mes_afectacion"]) )
            
            {
                
                $_mes_afectacion = $_POST["mes_afectacion"];
                $_anio_afectacion = $_POST["anio_afectacion"];
                
                $_id_estado = $_POST["id_estado"];
                
                
                $_id_cierre_nomina = $_POST["id_cierre_nomina"];
                
                if($_id_cierre_nomina>0)
                {
                    
                    $colval = " id_estado = '$_id_estado'   ";
                    $tabla = "cierre_nomina";
                    $where = "id_cierre_nomina = '$_id_cierre_nomina'    ";
                    
                    $resultado=$cierre_nomina->UpdateBy($colval, $tabla, $where);
                    
                    
                    
                }else {
                    
                    
                    
                	$colval = " id_estado = '$_id_estado'   ";
                	$tabla = "cierre_nomina";
                	$where = "mes_cierre_nomina = '$_mes_afectacion' AND anio_cierre_nomina='$_anio_afectacion'   ";
                	
                	$resultado=$cierre_nomina->UpdateBy($colval, $tabla, $where);
                	
                    
                }
                
            }
            $this->redirect("CierreNomina", "index");
            
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
    
    public function borrarId()
    {
        
        session_start();
        
        if (isset($_SESSION["id_usuarios"]))
        {
            if(isset($_GET["id_departamentos"]))
            {
                $id_departamentos=(int)$_GET["id_departamentos"];
                
                $departamentos=new DepartamentosModel();
                
                $departamentos->deleteBy(" id_departamentos",$id_departamentos);
                
            }
            
            $this->redirect("Departamentos", "index");
            
            
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
    
    
    
    
    
    
    
    
}
?>