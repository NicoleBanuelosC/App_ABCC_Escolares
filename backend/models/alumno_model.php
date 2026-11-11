<?php
class AlumnoModel {
    private $conexion;

    public function __construct() {
        include_once(__DIR__ . '/../config/database/conexion_mysql_escuela.php');
        $con = new ConexionBDEscuela();
        $this->conexion = $con->getConexionPDO();
    }

    // GET - Obtener todos o por Num_Control
    public function obtenerAlumnos($nc = null) {
        if ($nc) {
            $sql = "SELECT Num_Control as nc, nombre as n, Primer_Ap as pa, Segundo_Ap as sa, Fecha_Nac as fn, Semestre as s, Carrera as c FROM Alumnos WHERE Num_Control = :nc";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nc', $nc);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT Num_Control as nc, nombre as n, Primer_Ap as pa, Segundo_Ap as sa, Fecha_Nac as fn, Semestre as s, Carrera as c FROM Alumnos";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // POST - Crear nuevo alumno
    public function crearAlumno($datos) {
        $sql = "INSERT INTO Alumnos (Num_Control, nombre, Primer_Ap, Segundo_Ap, Fecha_Nac, Semestre, Carrera) 
                VALUES (:nc, :n, :pa, :sa, :fn, :s, :c)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':nc' => $datos['nc'],
            ':n'  => $datos['n'],
            ':pa' => $datos['pa'],
            ':sa' => $datos['sa'],
            ':fn' => $datos['fn'],
            ':s'  => $datos['s'],
            ':c'  => $datos['c']
        ]);
    }

    // PUT - Modificación completa
    public function actualizarCompleto($datos) {
        $sql = "UPDATE Alumnos SET nombre = :n, Primer_Ap = :pa, Segundo_Ap = :sa, Fecha_Nac = :fn, Semestre = :s, Carrera = :c WHERE Num_Control = :nc";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':nc' => $datos['nc'],
            ':n'  => $datos['n'],
            ':pa' => $datos['pa'],
            ':sa' => $datos['sa'],
            ':fn' => $datos['fn'],
            ':s'  => $datos['s'],
            ':c'  => $datos['c']
        ]);
        return $stmt->rowCount() > 0;
    }

    // PATCH - Modificación parcial
    public function actualizarParcial($datos) {
        $nc = $datos['nc'];
        unset($datos['nc']);
        
        $campos = [];
        $params = [':nc' => $nc];

        $mapeo = [
            'n'  => 'nombre',
            'pa' => 'Primer_Ap',
            'sa' => 'Segundo_Ap',
            'fn' => 'Fecha_Nac',
            's'  => 'Semestre',
            'c'  => 'Carrera'
        ];

        foreach ($mapeo as $key => $col) {
            if (isset($datos[$key])) {
                $campos[] = "$col = :$key";
                $params[":$key"] = $datos[$key];
            }
        }

        if (empty($campos)) {
            return false;
        }

        $sql = "UPDATE Alumnos SET " . implode(', ', $campos) . " WHERE Num_Control = :nc";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount() > 0;
    }

    // DELETE - Eliminar
    public function eliminarAlumno($nc) {
        $sql = "DELETE FROM Alumnos WHERE Num_Control = :nc";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':nc' => $nc]);
        return $stmt->rowCount() > 0;
    }
}
?>