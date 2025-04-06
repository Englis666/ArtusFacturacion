<?php

class Sesion {
    public static function iniciar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function establecerUsuario($usuario) {
        $_SESSION['usuario'] = $usuario;
    }

    public static function obtenerUsuario() {
        self::iniciar();
        return $_SESSION['usuario'] ?? null;
    }

    public static function verificarSesion() {
        self::iniciar();
        if (!isset($_SESSION['usuario'])) {
            header('Location: login');
            exit();
        }
    }

    public static function cerrarSesion() {
        self::iniciar();
        session_unset();
        session_destroy();
        header('Location: login');
        exit();
    }
}
