<?php

namespace Controllers;

use Models\Candidato;

require_once __DIR__ . '/../models/Candidato.php';

class CandidatoController
{
    private function obtenerTexto(string $campo): string
    {
        if (!isset($_POST[$campo]) || !is_string($_POST[$campo])) {
            return '';
        }

        return trim(strip_tags($_POST[$campo]));
    }

    public function procesarFormulario(): void
    {
        $errores = [];
        $candidatoValido = false;

        $datos = [
            'nombre' => '',
            'apellidos' => '',
            'correo' => '',
            'telefono' => '',
            'situacion' => '',
            'lenguajes' => [],
            'url' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $this->obtenerTexto('nombre');
            $apellidos = $this->obtenerTexto('apellidos');
            $correo = $this->obtenerTexto('correo');
            $telefono = $this->obtenerTexto('telefono');
            $situacion = $this->obtenerTexto('situacion');
            $url = $this->obtenerTexto('url');

            $lenguajes = $_POST['lenguajes'] ?? [];

            if (!is_array($lenguajes)) {
                $lenguajes = ['valor no válido'];
            } else {
                $lenguajesLimpios = [];

                foreach ($lenguajes as $lenguaje) {
                    if (is_string($lenguaje)) {
                        $lenguajesLimpios[] = trim(strip_tags($lenguaje));
                    } else {
                        $lenguajesLimpios[] = '';
                    }
                }

                $lenguajes = $lenguajesLimpios;
            }

            $candidato = new Candidato(
                $nombre,
                $apellidos,
                $correo,
                $telefono,
                $situacion,
                $lenguajes,
                $url
            );

            $errores = $candidato->validarDatos();
            $datos = $candidato->getDatos();

            if (empty($errores)) {
                $candidatoValido = true;
            }
        }

        require __DIR__ . '/../views/formulario.php';
    }
}
