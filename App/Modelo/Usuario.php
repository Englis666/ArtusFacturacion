<?php

class Usuario {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrar($num_doc, $nombreCompleto, $email, $password) {
    $rol = 2;
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (num_doc, nombreCompleto, email, password, rol) 
            VALUES (:num_doc, :nombreCompleto, :email, :contrasena, $rol)";

    $stmt = $this->conn->prepare($sql);

    $stmt->bindParam(':num_doc', $num_doc, PDO::PARAM_INT);
    $stmt->bindParam(':nombreCompleto', $nombreCompleto, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':contrasena', $hashedPassword, PDO::PARAM_STR); 

    return $stmt->execute();
}


public function logearse($num_doc, $password) {
    $sql = "SELECT * FROM usuarios WHERE num_doc = :num_doc LIMIT 1"; 
    $stmt = $this->conn->prepare($sql); 
    
    $stmt->bindParam(':num_doc', $num_doc, PDO::PARAM_INT);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC); 
    if ($usuario && password_verify($password, $usuario['password'])) {
        return $usuario;
    }
    
    return false;
}

}
?>