<?php


require_once __DIR__ . '/../Modelo/Usuario.php';
require_once __DIR__ .'../App/Config/Database.php';
require_once __DIR__.'../App/Helper/Sesion.php';

class AuthController {
    private $usuarioModelo;

    public function __construct() {
        global $conn;
        $this->usuarioModelo = new Usuario($conn);
    }

    public function logearse() {
        Sesion::iniciar();
        
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $num_doc = $_POST['num_doc'];
            $password = $_POST['password'];

            $usuario = $this->usuarioModelo->logearse($num_doc, $password);

            if ($usuario) {
                Sesion::establecerUsuario([
                'num_doc' => $usuario['num_doc'],
                'nombre' => $usuario['nombreCompleto'],
                'email' => $usuario['email'],
                'rol' => $usuario['rol']
            ]);
                $rol = ($usuario['rol'] === 1) ? '1' : '2'; // 1 admin //2 cajero
                $_SESSION['usuario']['rol'] = $rol;

                if ($rol === '1') {
                    header('Location: dashboard');
                } else {
                    header('Location: formularioVenta');
                }
                exit;
            } else {
                $_SESSION['error'] = "Usuario o contraseña incorrectos";
                header('Location: login');
                exit;
            }

        }
    }

    public function registrar() {
        
    Sesion::iniciar();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $num_doc = $_POST['num_doc'];
        $nombreCompleto = $_POST['nombreCompleto'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if ($this->usuarioModelo->registrar($num_doc, $nombreCompleto, $email, $password)) {
            header('Location: login');
            exit;
        } else {
            $_SESSION['error'] = 'Error al registrar usuario.';
            header('Location: registro.php');
            exit;
        }
    }
}


    public function validarSesion() {
        Sesion::verificarSesion();
    }
    public function obtenerUsuario(){
        return Sesion::obtenerUsuario();
    }

    public function logout() {
        Sesion::cerrarSesion();
    }
}
