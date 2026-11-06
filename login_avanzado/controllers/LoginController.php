<?php

namespace Controllers;

use Models\Usuario;

require_once __DIR__ . '/../Models/Usuario.php';

class LoginController {

    public function procesarLogin(): void {
            $nombre = $_POST['usuario'] ?? '';
            $telf = $_POST['telefono'] ?? '';
            $correo = $_POST['correo'] ?? '';
            $password = $_POST['password'] ?? '';

            $usuario = new Usuario($nombre, $correo, $password, $telf);

            $errores = $usuario->validarDatos();

            if (!empty($errores)) {
            
                session_start();
                $_SESSION['errores_validacion'] = $errores;
                $_SESSION['datos_viejos'] = $_POST;

                header('Location: /php/login_avanzado/views/login.php');
                exit;
            }

        
            if ($usuario->comprobarCredenciales()) {
                header('Location: /php/login_avanzado/views/bienvenida.php');
                exit;
            } 
            else {
                header('Location: /php/login_avanzado/views/error.php');
                exit;
            }
        
    }
}