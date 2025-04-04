<?php
require_once __DIR__. '../App/Modelo/Proveedores.php';
require_once __DIR__.'../App/Config/Database.php';

class ProveedoresController{
    private $proveedoresModelo;

    public function __construct(){
        global $conn;
        $this->proveedoresModelo = new Proveedores($conn);
    }

    public function obtenerProveedores(){
        return $this->proveedoresModelo->obtenerProveedores();
    }

    public function agregarProveedor(){
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $nombreProveedor = $_POST['nombreProveedor'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $direccion = $_POST['direccion'];

            if($this->proveedoresModelo->agregarProveedor($nombreProveedor,$telefono , $email, $direccion)){
                header('Location: Proveedores.php?success=1');
            } else {
                header('Location: Proveedores.php?error=1');
            }
        }
    }
    public function obtenerComprasDeProductoPorProveedor(){
        return $this->proveedoresModelo->obtenerComprasDeProductoPorProveedor();
    }



}