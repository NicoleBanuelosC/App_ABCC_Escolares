<?php
class ConexionBDEscuela {
    private $host = "localhost";
    private $port = "3306";
    private $usuario = "nicole";
    private $password = "2021";
    private $bd = "BD_Escuela_Web_2026";
    private $charset = "utf8mb4";
    
    private $conexionMysqli;
    private $conexionPDO;

    public function __construct() {
        // 1. Inicializar MySQLi (PARA ARCHIVOS VIEJOS, no se tocan)
        $this->conexionMysqli = mysqli_connect($this->host, $this->usuario, $this->password, $this->bd);
        if (!$this->conexionMysqli) {
            die("Error en la conexión MySQLi: " . mysqli_connect_error());
        }
        mysqli_set_charset($this->conexionMysqli, $this->charset);

        // 2. Inicializar PDO (PARA LA NUEVA API)
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->bd};charset={$this->charset}";
            $opciones = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->conexionPDO = new PDO($dsn, $this->usuario, $this->password, $opciones);
        } catch (PDOException $e) {
            die("Error en la conexión PDO: " . $e->getMessage());
        }
    }

    public function getConexion() {
        return $this->conexionMysqli; 
    }

    public function getConexionPDO() {
        return $this->conexionPDO; 
    }
}
?>