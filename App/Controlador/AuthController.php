<?php
require_once 'App/Modelo/Usuario.php';
require_once 'App/Config/Database.php';

class AuthController{
    private $usuarioModelo;

    public function __construct(){
        global $conn;
        $this->usuarioModelo = new Usuario($conn);
    }

    public function login(){
        session_start();

        if ($_SERVER['METHOD_REQUEST'] === "POST"){
            $num_doc = $_POST['num_doc'];
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];

            $usuario = $this->usuarioModelo->login($num_doc, $usuario, $password);

            if ($usuario){
                $_SESSION['usuario'] = $usuario;
                header('Location');
                exit;
            } else {
                $_SESSION['error'] = "Usuario o contraseña incorrectos";
            }
        }
        require 'App/Vista/login.php';
    }

    public function registrar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $num_doc = $_POST['num_doc'];
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];

            if($this->usuarioModelo->registrar($num_doc, $usuario, $password)){
                header('Location: login.php');
                exit;
            } else {
                $_SESSION['error'] = 'Error al registrar usuario';
            }
        }
        require 'App/Vista/registro.php';
    }

    public function logout(){
        session_start();
        session_destroy();
        header('Location: login.php');
        exit;
    }



}