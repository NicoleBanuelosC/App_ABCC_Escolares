<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once(__DIR__ . '/../backend/models/alumno_model.php');

class BajasAPI {
    private $modelo;
    
    public function __construct() {
        $this->modelo = new AlumnoModel();
    }
    
    public function manejarPeticion() {
        // validar que el metodo sea delete
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido. Use DELETE para dar de baja.']);
            return;
        }
        
        try {
            $nc = null;
            
            // 2. Buscar el número de control en la URL (?nc=...) o en el cuerpo JSON
            if (isset($_GET['nc'])) {
                $nc = $_GET['nc'];
            } else {
                $datos = json_decode(file_get_contents('php://input'), true);
                if (isset($datos['nc'])) {
                    $nc = $datos['nc'];
                }
            }
            
            // 3. validar que se haya puesto el numero de control
            if (!$nc) {
                http_response_code(400);
                echo json_encode(['error' => 'Se requiere el número de control (nc) para eliminar.']);
                return;
            }
            
            // ejecutar la eliminacion
            if ($this->modelo->eliminarAlumno($nc)) {
                http_response_code(200);
                echo json_encode([
                    'baja' => true,
                    'mensaje' => 'Alumno eliminado correctamente.',
                    'nc' => $nc
                ]);
            } else {
                http_response_code(404);
                echo json_encode([
                    'baja' => false,
                    'mensaje' => 'No se encontró ningún alumno con ese número de control.'
                ]);
            }
            
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error en el servidor: ' . $e->getMessage()]);
        }
    }
}

$api = new BajasAPI();
$api->manejarPeticion();
?>