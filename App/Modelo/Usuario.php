<?php

class Usuario {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function registrar($num_doc , $usuario , $password){
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO usuarios (num_doc, usuario , password) VALUES ( ? , ? , ? )");
        $stmt->bind_param("iss" , $num_doc , $usuario , $hashedPassword);
        return $stmt->execute();
    }


    public function login($num_doc,$usuario, $password){
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE num_doc = ? AND password = ? LIMIT 1");
        $stmt->binParam("is", $num_doc, $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc(); 

        if($usuario && password_verify($password, $usuario['password'])){
            return $usuario;
        }
        return false;
        
    }


}