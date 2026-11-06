
<?php

require_once __DIR__ . '/models/Usuario.php';
require_once __DIR__ . '/controllers/LoginController.php';

use Controllers\LoginController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $controlador = new LoginController();
    $controlador->procesarLogin();

} else {
    require_once __DIR__ . '/views/login.php';
}


