<?php

class db {
    private $hostname = "localhost";
    private $namedb = "sgcitas";
    private $username = "root";
    private $password = "";

    private $conn;

    function conectar() {
        try {
            $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->namedb", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            return null;
        }
    }
}

?>
