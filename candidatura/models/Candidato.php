<?php

namespace Models;

class Candidato
{
    private string $nombre;
    private string $apellidos;
    private string $correo;
    private string $telefono;
    private string $situacion;
    private array $lenguajes;
    private string $url;

    public function __construct(
        string $nombre,
        string $apellidos,
        string $correo,
        string $telefono,
        string $situacion,
        array $lenguajes,
        string $url
    ) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->situacion = $situacion;
        $this->lenguajes = $lenguajes;
        $this->url = $url;
    }

    public function validarDatos(): array
    {
        $errores = [];

        $situaciones = ['sin empleo', 'media jornada', 'tiempo completo'];
        $lenguajesPermitidos = ['Python', 'PHP', 'JavaScript', 'Java', 'C++'];

        if ($this->nombre === '') {
            $errores['nombre'] = 'El nombre es obligatorio.';
        }

        if ($this->apellidos === '') {
            $errores['apellidos'] = 'Los apellidos son obligatorios.';
        }

        if (!filter_var($this->correo, FILTER_VALIDATE_EMAIL)) {
            $errores['correo'] = 'Introduce un correo electrónico válido.';
        }

        if (!preg_match('/^[0-9]{9}$/', $this->telefono)) {
            $errores['telefono'] = 'El teléfono debe tener 9 cifras.';
        }

        if (!in_array($this->situacion, $situaciones, true)) {
            $errores['situacion'] = 'Selecciona una situación laboral válida.';
        }

        foreach ($this->lenguajes as $lenguaje) {
            if (!is_string($lenguaje) || !in_array($lenguaje, $lenguajesPermitidos, true)) {
                $errores['lenguajes'] = 'Has enviado un lenguaje que no está permitido.';
                break;
            }
        }

        if (!filter_var($this->url, FILTER_VALIDATE_URL)) {
            $errores['url'] = 'Introduce una URL válida.';
        } else {
            $protocolo = parse_url($this->url, PHP_URL_SCHEME);

            if ($protocolo !== 'http' && $protocolo !== 'https') {
                $errores['url'] = 'La URL debe comenzar por http:// o https://.';
            }
        }

        return $errores;
    }

    public function getDatos(): array
    {
        return [
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'correo' => $this->correo,
            'telefono' => $this->telefono,
            'situacion' => $this->situacion,
            'lenguajes' => $this->lenguajes,
            'url' => $this->url
        ];
    }
}
