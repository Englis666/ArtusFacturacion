<?php

class Venta {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function obtenerTodasLasVentas(){
        $resultado = $this->conn->query("SELECT * FROM ventas");
        return $resultado->fetch_all(FETCH_ASSOC);
    }

}