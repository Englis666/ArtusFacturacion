<?php
class VistaController {
    public function mostrar($vista) {
        $archivo = __DIR__ . "/../Vista/{$vista}.php";
        if (file_exists($archivo)) {
            require_once $archivo;
        } else {
            http_response_code(404);
            echo "Página no encontrada.";
        }
    }
}
