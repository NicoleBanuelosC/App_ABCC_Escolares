<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once(__DIR__ . '/../backend/models/alumno_model.php');

class AltasAPI {
    private $modelo;
    
    public function __construct() {
        $this->modelo = new AlumnoModel();
    }
    
    public function manejarPeticion() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido. Use POST para dar de alta.']);
            return;
        }
        
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
}

$api = new AltasAPI();
$api->manejarPeticion();
?>