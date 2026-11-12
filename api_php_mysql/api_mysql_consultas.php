<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once(__DIR__ . '/../backend/models/alumno_model.php');

class ConsultasAPI {
    private $modelo;
    
    public function __construct() {
        $this->modelo = new AlumnoModel();
    }
    
    public function manejarPeticion() {
        // 1. Validar que el método sea estrictamente GET
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido. Use GET para consultar.']);
            return;
        }
        
        try {
            // 2. Verificar si nos piden un alumno específico o todos
            $nc = isset($_GET['nc']) ? $_GET['nc'] : null;
            
            // 3. Llamar al modelo (que ya usa PDO de forma segura)
            $alumnos = $this->modelo->obtenerAlumnos($nc);
            
            // 4. Responder según el resultado
            if ($alumnos) {
                http_response_code(200);
                echo json_encode([
                    'consulta' => true,
                    'alumnos' => $alumnos,
                    'mensaje' => $nc ? 'Alumno encontrado' : 'Lista de alumnos obtenida correctamente'
                ]);
            } else {
                http_response_code(404);
                echo json_encode([
                    'consulta' => false,
                    'alumnos' => [],
                    'mensaje' => 'No se encontraron registros'
                ]);
            }
            
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error en el servidor: ' . $e->getMessage()]);
        }
    }
}

$api = new ConsultasAPI();
$api->manejarPeticion();
        ?>