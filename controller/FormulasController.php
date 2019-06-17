<?php

class FormulasController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    //maycol
    
    public function index(){
        
      
        session_start();
        
        if (isset($_SESSION['nombre_usuarios']))
        {
            
            
            $formulas = new FormulasModel();
            
            $columnas="formulas.id_formulas, 
                      tipo_formulas.id_tipo_formulas, 
                      tipo_formulas.nombre_tipo_formulas, 
                      formulas.porcentaje_formulas, 
                      formulas.creado";
            $tablas="public.formulas, 
                     public.tipo_formulas";
            $where="tipo_formulas.id_tipo_formulas = formulas.id_tipo_formulas";
            $id="formulas.id_formulas";
            
            $resultSet=$formulas->getCondiciones($columnas, $tablas, $where, $id);
            
            
            
            
            $resultEdit = "";
            $tipo_formulas = new TipoFormulasModel();
            $resultFor=$tipo_formulas->getAll("nombre_tipo_formulas");
            
            
            
            
            $nombre_controladores = "Formulas";
            $id_rol= $_SESSION['id_rol'];
            $resultPer = $formulas->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
            
            if (!empty($resultPer))
            {
                
                
                if (isset ($_GET["id_formulas"]))
                {
                    
                    $nombre_controladores = "Formulas";
                    $id_rol= $_SESSION['id_rol'];
                    $resultPer = $formulas->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
                    
                    if (!empty($resultPer))
                    {
                        
                        $_id_formulas = $_GET["id_formulas"];
                        $columnas = " id_formulas, id_tipo_formulas, porcentaje_formulas";
                        $tablas   = "formulas";
                        $where    = "id_formulas = '$_id_formulas' ";
                        $id       = "id_formulas";
                        
                        $resultEdit = $formulas->getCondiciones($columnas ,$tablas ,$where, $id);
                        
                    }
                    else
                    {
                        $this->view("Error",array(
                            "resultado"=>"No tiene Permisos de Editar Formulas"
                            
                        ));
                        
                        
                    }
                    
                }
                
                
                $this->view("Formulas",array(
                    "resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultFor" =>$resultFor
                    
                ));
                
            }
            else
            {
                $this->view("Error",array(
                    "resultado"=>"No tiene Permisos de Acceso a Formulas"
                    
                ));
                
                exit();
            }
            
        }
        else{
            
            $this->redirect("Usuarios","sesion_caducada");
            
        }
        
    }
    
    public function InsertaFormulas(){
        
        session_start();
        
       
        if (isset($_SESSION["id_usuarios"]))
        {
           
            $formulas=new FormulasModel();
            
            if (isset ($_POST["id_tipo_formulas"]) )
            
            {
                
                
                $_id_formulas = $_POST["id_formulas"];
                $_id_tipo_formulas = $_POST["id_tipo_formulas"];
                $_porcentaje_formulas = $_POST["porcentaje_formulas"];
                
                if($_id_formulas>0)
                {
                    
                    $colval = " id_tipo_formulas = '$_id_tipo_formulas', porcentaje_formulas = '$_porcentaje_formulas'   ";
                    $tabla = "formulas";
                    $where = "id_formulas = '$_id_formulas'    ";
                    
                    $resultado=$formulas->UpdateBy($colval, $tabla, $where);
                    
                    
                    
                }else {
                    
                    
                    
                    $funcion = "ins_formulas";
                    $parametros = " '$_id_tipo_formulas','$_porcentaje_formulas'  ";
                    $formulas->setFuncion($funcion);
                    $formulas->setParametros($parametros);
                    $resultado=$formulas->Insert();
                    
                }
                
            }
            $this->redirect("Formulas", "index");
            
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
            
            if(isset($_GET["id_formulas"]))
            {
               
                
                $id_formulas=(int)$_GET["id_formulas"];
                
                $formulas=new FormulasModel();
                
                $formulas->deleteBy('id_formulas', $id_formulas);
                
            }
            
            $this->redirect("Formulas", "index");
            
            
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