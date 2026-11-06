<?php

require_once __DIR__ . '/controllers/CandidatoController.php';

use Controllers\CandidatoController;

$controller = new CandidatoController();
$controller->procesarFormulario();
