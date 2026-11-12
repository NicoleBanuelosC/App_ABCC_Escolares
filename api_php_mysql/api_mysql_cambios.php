<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, PATCH');
header('Access-Control-Allow-Headers: Content-Type');

require_once(__DIR__ . '/../backend/models/alumno_model.php');

class CambiosAPI {
    private $modelo;
    
    public function __construct() {
        $this->modelo = new AlumnoModel();
    }
    
    public function manejarPeticion() {
        $metodo = $_SERVER['REQUEST_METHOD'];
        
        // 1. Validar que el método sea PUT o PATCH
        if ($metodo !== 'PUT' && $metodo !== 'PATCH') {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido. Use PUT o PATCH para modificar.']);
            return;
        }
        
        try {
            $datos = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($datos['nc'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Se requiere el número de control (nc)']);
                return;
            }
            
            // 2. Si es PUT, exige TODOS los campos
            if ($metodo === 'PUT') {
                $camposRequeridos = ['nc', 'n', 'pa', 'sa', 'fn', 's', 'c'];
                foreach ($camposRequeridos as $campo) {
                    if (!isset($datos[$campo])) {
                        http_response_code(400);
                        echo json_encode(['error' => "Campo requerido faltante para PUT: $campo"]);
                        return;
                    }
                }
                
                if ($this->modelo->actualizarCompleto($datos)) {
                    http_response_code(200);
                    echo json_encode(['cambio' => true, 'mensaje' => 'Alumno actualizado completamente', 'nc' => $datos['nc']]);
                } else {
                    http_response_code(404);
                    echo json_encode(['cambio' => false, 'error' => 'Alumno no encontrado']);
                }
                
            } 
            // 3. Si es PATCH, solo actualiza los campos que envíes
            elseif ($metodo === 'PATCH') {
                if ($this->modelo->actualizarParcial($datos)) {
                    http_response_code(200);
                    echo json_encode(['cambio' => true, 'mensaje' => 'Alumno actualizado parcialmente', 'nc' => $datos['nc']]);
                } else {
                    http_response_code(400);
                    echo json_encode(['cambio' => false, 'error' => 'No hay campos válidos para actualizar o alumno no encontrado']);
                }
            }
            
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error en el servidor: ' . $e->getMessage()]);
        }
    }
}

$api = new CambiosAPI();
$api->manejarPeticion();
?>