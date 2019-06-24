<?php

class ProductosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    //maycol
    
    public function index(){
        
        
        $productos = new ProductosModel();
        $resultSet=$productos->getAll("id_productos");
        $resultEdit = "";
        
        session_start();
        
        if (isset($_SESSION['nombre_usuarios']))
        {
             $nombre_controladores = "Productos";
            $id_rol= $_SESSION['id_rol'];
            $resultPer = $productos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
            
            if (!empty($resultPer))
            {
                
                
                if (isset ($_GET["id_productos"]))
                {
                    
                    $nombre_controladores = "Productos";
                    $id_rol= $_SESSION['id_rol'];
                    $resultPer = $productos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
                    
                    if (!empty($resultPer))
                    {
                        
                        $_id_productos = $_GET["id_productos"];
                        $columnas = "id_productos, nombre_productos, codigo_productos, marca_productos, precio_productos, cantidad_stock_productos";
                        $tablas   = "productos";
                        $where    = "id_productos = '$_id_productos' ";
                        $id       = "nombre_productos";
                        
                        $resultEdit = $productos->getCondiciones($columnas ,$tablas ,$where, $id);
                        
                    }
                    else
                    {
                        $this->view("Error",array(
                            "resultado"=>"No tiene Permisos de Editar Productos"
                            
                        ));
                        
                        
                    }
                    
                }
                
                
                $this->view("Productos",array(
                    "resultSet"=>$resultSet, "resultEdit" =>$resultEdit
                    
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
        
       
        if (isset($_SESSION["id_usuarios"]))
        {
          
            
            $productos=new ProductosModel();
            
            if (isset ($_POST["nombre_productos"]) )
            
            {
                
                $_nombre_productos = $_POST["nombre_productos"];
                $_codigo_productos = $_POST["codigo_productos"];
                $_marca_productos = $_POST["marca_productos"];
                $_precio_productos = $_POST["precio_productos"];
                $_cantidad_stock_productos = $_POST["cantidad_stock_productos"];
            
                if($_id_productos>0)
                {
                    
                    $colval = "nombre_productos = '$_nombre_productos',codigo_productos = '$_codigo_productos',marca_productos = '$_marca_productos',precio_productos = '$_precio_productos',cantidad_stock_productos = '$_cantidad_stock_productos',";
                    $tabla = "productos";
                    $where = "id_productos = '$_id_productos'    ";
                    
                    $resultado=$productos->UpdateBy($colval, $tabla, $where);
                    
                    
                    
                }else {
                    
                    
                    
                    $funcion = "ins_productos";
                    $parametros = " '$_nombre_productos','$_codigo_productos','$_marca_productos','$_precio_productos','$_cantidad_stock_productos'  ";
                    $productos->setFuncion($funcion);
                    $productos->setParametros($parametros);
                    $resultado=$productos->Insert();
                    
                }
                
            }
            $this->redirect("Productos", "index");
            
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
            if(isset($_GET["id_productos"]))
            {
                $id_productos=(int)$_GET["id_productos"];
                
                $productos=new ProductosModel();
                
                $productos->deleteBy(" id_productos",$id_productos);
                
            }
            
            $this->redirect("Productos", "index");
            
            
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