<?php
namespace Models;

class Usuario {

    private string $usuario;
    private string $correo;
    private string $password;
    private string $telf;

    public function __construct(string $usuario, string $correo, string $password, string $telf) {

        $this->usuario = $usuario;
        $this->telf = $telf;
        $this->correo = $correo;
        $this->password = $password;
        
    }

    public function comprobarCredenciales(): bool {
        return $this->usuario === "usuario" &&
               $this->correo === "usuario@dominio.es" &&
               $this->password === "usuario2026" &&
               $this->telf === "624337750"; 
    }

    public function validarDatos(): array {
        $errores = [];
    
        if (!preg_match('/^[a-zA-Z0-9]{4,20}$/' , $this->usuario)) {
            $errores['usuario'] = "Error: Nombre de usuario no válido";
        }

        if(!preg_match('/^[0-9]{9}$/' , $this->telf)) {
            $errores['telefono'] = "Error: El teléfono no es válido";
        }

        if(!preg_match('/^[a-zA-Z0-9._%+-]{8,20}$/' , $this->password)) {
            $errores['password'] = "Error: Contraseña no válida";
        }

        if (!filter_var($this->correo, FILTER_VALIDATE_EMAIL)) {
            $errores['correo'] = "Error: El correo no es válido";
        }

        return $errores;
    }
}
