<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH');
header('Access-Control-Allow-Headers: Content-Type');

require_once(__DIR__ . '/../backend/models/alumno_model.php');

class AlumnoAPI {
    private $modelo;
    
    public function __construct() {
        $this->modelo = new AlumnoModel();
    }
    
    private function getAlumnos() {
        try {
            $nc = isset($_GET['nc']) ? $_GET['nc'] : null;
            $alumnos = $this->modelo->obtenerAlumnos($nc);
            http_response_code(200);
            echo json_encode($alumnos);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    
    private function createAlumno() {
        try {
            $datos = json_decode(file_get_contents('php://input'), true);
            if (!$datos) {
                http_response_code(400);
                echo json_encode(['error' => 'No se recibieron datos JSON']);
                return;
            }
            $camposRequeridos = ['nc', 'n', 'pa', 'sa', 'fn', 's', 'c'];
            foreach ($camposRequeridos as $campo) {
                if (!isset($datos[$campo])) {
                    http_response_code(400);
                    echo json_encode(['error' => "Campo requerido faltante: $campo"]);
                    return;
                }
            }
            if ($this->modelo->crearAlumno($datos)) {
                http_response_code(201);
                echo json_encode(['mensaje' => 'Alumno creado correctamente', 'nc' => $datos['nc']]);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Error al crear el alumno']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    
    private function updateAlumnoCompleto() {
        try {
            $datos = json_decode(file_get_contents('php://input'), true);
            if (!isset($datos['nc'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Se requiere el número de control (nc)']);
                return;
            }
            if ($this->modelo->actualizarCompleto($datos)) {
                http_response_code(200);
                echo json_encode(['mensaje' => 'Alumno actualizado correctamente']);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Alumno no encontrado']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    
    private function updateAlumnoParcial() {
        try {
            $datos = json_decode(file_get_contents('php://input'), true);
            if (!isset($datos['nc'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Se requiere el número de control (nc)']);
                return;
            }
            if ($this->modelo->actualizarParcial($datos)) {
                http_response_code(200);
                echo json_encode(['mensaje' => 'Alumno actualizado parcialmente']);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'No hay campos para actualizar o alumno no encontrado']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    
    private function deleteAlumno() {
        try {
            $nc = null;
            if (isset($_GET['nc'])) {
                $nc = $_GET['nc'];
            } else {
                $datos = json_decode(file_get_contents('php://input'), true);
                if (isset($datos['nc'])) {
                    $nc = $datos['nc'];
                }
            }
            if (!$nc) {
                http_response_code(400);
                echo json_encode(['error' => 'Se requiere el número de control (nc)']);
                return;
            }
            if ($this->modelo->eliminarAlumno($nc)) {
                http_response_code(200);
                echo json_encode(['mensaje' => 'Alumno eliminado correctamente']);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Alumno no encontrado']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    
    public function manejarPeticion() {
        $metodo = $_SERVER['REQUEST_METHOD'];
        switch ($metodo) {
            case 'GET': $this->getAlumnos(); break;
            case 'POST': $this->createAlumno(); break;
            case 'PUT': $this->updateAlumnoCompleto(); break;
            case 'PATCH': $this->updateAlumnoParcial(); break;
            case 'DELETE': $this->deleteAlumno(); break;
            default:
                http_response_code(405);
                echo json_encode(['error' => 'Método no permitido']);
        }
    }
}

$api = new AlumnoAPI();
$api->manejarPeticion();
?>