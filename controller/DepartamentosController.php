<?php

class DepartamentosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    //maycol
    
    public function index(){
        
        
        $departamentos = new DepartamentosModel();
        $resultSet=$departamentos->getAll("id_departamentos");
        $resultEdit = "";
        
        session_start();
        
        if (isset($_SESSION['nombre_usuarios']))
        {
            $nombre_controladores = "Departamentos";
            $id_rol= $_SESSION['id_rol'];
            $resultPer = $departamentos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
            
            if (!empty($resultPer))
            {
                
                
                if (isset ($_GET["id_departamentos"]))
                {
                    
                    $nombre_controladores = "Departamentos";
                    $id_rol= $_SESSION['id_rol'];
                    $resultPer = $departamentos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
                    
                    if (!empty($resultPer))
                    {
                        
                        $_id_departamentos = $_GET["id_departamentos"];
                        $columnas = " id_departamentos, nombre_departamentos";
                        $tablas   = "departamentos";
                        $where    = "id_departamentos = '$_id_departamentos' ";
                        $id       = "nombre_departamentos";
                        
                        $resultEdit = $departamentos->getCondiciones($columnas ,$tablas ,$where, $id);
                        
                    }
                    else
                    {
                        $this->view("Error",array(
                            "resultado"=>"No tiene Permisos de Editar Departamentos"
                            
                        ));
                        
                        
                    }
                    
                }
                
                
                $this->view("Departamentos",array(
                    "resultSet"=>$resultSet, "resultEdit" =>$resultEdit
                    
                ));
                
            }
            else
            {
                $this->view("Error",array(
                    "resultado"=>"No tiene Permisos de Acceso a Departamentos"
                    
                ));
                
                exit();
            }
            
        }
        else{
            
            $this->redirect("Usuarios","sesion_caducada");
            
        }
        
    }
    
    public function InsertaDepartamentos(){
        
        session_start();
        
       
        if (isset($_SESSION["id_usuarios"]))
        {
          
            $departamentos=new DepartamentosModel();
            
            if (isset ($_POST["nombre_departamentos"]) )
            
            {
                
                
                
                $_nombre_departamentos = $_POST["nombre_departamentos"];
                $_id_departamentos = $_POST["id_departamentos"];
                
                if($_id_departamentos>0)
                {
                    
                    $colval = " nombre_departamentos = '$_nombre_departamentos'   ";
                    $tabla = "departamentos";
                    $where = "id_departamentos = '$_id_departamentos'    ";
                    
                    $resultado=$departamentos->UpdateBy($colval, $tabla, $where);
                    
                    
                    
                }else {
                    
                    
                    
                    $funcion = "ins_departamentos";
                    $parametros = " '$_nombre_departamentos'  ";
                    $departamentos->setFuncion($funcion);
                    $departamentos->setParametros($parametros);
                    $resultado=$departamentos->Insert();
                    
                }
                
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