<?php
    $u = $_POST['caja_usuario'];
    $c = $_POST['caja_password'];

    $u_cifrado = sha1($u);
    $c_cifrado = sha1($c);

    require_once dirname(__DIR__) . '/config/database/conexion_mysql_escuela.php';    
    $con = new ConexionBDEscuela();
    $conexion = $con->getConexion();

    if($conexion){
        $sql = "SELECT * FROM Usuarios WHERE Usuario='$u_cifrado' AND Password='$c_cifrado'";

        $res = mysqli_query($conexion, $sql);
        
        if(mysqli_num_rows($res) == 1) {
            session_start();
            $_SESSION['usuario_autenticado'] = true;
            $_SESSION['nombre_usuario'] = $u;
            
            header('location: ../../frontend/menu_principal.php');

        } else {
            echo "NO ENCONTRADO";
        }
    }
?>