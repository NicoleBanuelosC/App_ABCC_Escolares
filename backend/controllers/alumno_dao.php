<?php

require_once __DIR__ . '/../config/database/conexion_mysql_escuela.php';

class AlumnoDAO {
    private $conexion;

    public function __construct() {
        $objetoConexion = new ConexionBDEscuela();
        $this->conexion = $objetoConexion->getConexion();
    }

    //================= METODOS ABCC (CRUD) ==============================
    
    //- - - - - A l t a s - - - - - 
    public function agregarAlumno($nc, $nombre, $primerAp, $segundoAp, $fechaNac, $semestre, $carrera) {
        $sql = "INSERT INTO alumnos VALUES('$nc', '$nombre', '$primerAp', '$segundoAp', '$fechaNac', $semestre, '$carrera')";
        $res = mysqli_query($this->conexion, $sql);
        return $res;
    }

    //- - - - - B a j a s - - - - - 
    public function eliminarAlumno($nc) {
        $sql = "DELETE FROM alumnos WHERE Num_Control = '$nc'";
        $res = mysqli_query($this->conexion, $sql);
        return $res;
    }
    
    //- - - - - C a m b i o s - - - - - 
    public function modificarAlumno($nc, $nombre, $primerAp, $segundoAp, $fechaNac, $semestre, $carrera) {
        $sql = "UPDATE alumnos SET 
            nombre = '$nombre', 
            Primer_Ap = '$primerAp', 
            Segundo_Ap = '$segundoAp', 
            Fecha_Nac = '$fechaNac', 
            Semestre = '$semestre', 
            Carrera = '$carrera' 
            WHERE Num_Control = '$nc'";

        $res = mysqli_query($this->conexion, $sql);
        return $res;
    }

    //- - - - - C o n s u l t a s - - - - - 

    public function mostrarAlumnos() {
        $sql = "SELECT Num_Control, nombre, Primer_Ap, Segundo_Ap FROM alumnos";
        return mysqli_query($this->conexion, $sql);
    }

    public function buscarAlumno($nc) {
        $sql = "SELECT * FROM alumnos WHERE Num_Control = '$nc'";
        $res = mysqli_query($this->conexion, $sql);
        
        if ($res && mysqli_num_rows($res) > 0) {
            return mysqli_fetch_assoc($res);
        }

        return null;
    }

    // filtrar desde los radiobuttos
    public function buscarAlumnos($filtro, $valor) {
        $valor = mysqli_real_escape_string($this->conexion, $valor);

        if ($filtro == 'nombre') {
            $sql = "SELECT Num_Control, nombre, Primer_Ap, Segundo_Ap FROM alumnos WHERE nombre LIKE '%$valor%'";
        } else {
            $sql = "SELECT Num_Control, nombre, Primer_Ap, Segundo_Ap FROM alumnos WHERE Num_Control LIKE '%$valor%'";
        }
        
        return mysqli_query($this->conexion, $sql);
    }
}

?>