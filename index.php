<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controller\QualidadeAguaController;

$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $controller = new QualidadeAguaController();
        $resultado = $controller->processarAmostraEFiltragem($_POST);
    } catch (\Throwable $e) {
        $erro = $e->getMessage();
    }
}

require_once __DIR__ . '/view/home.php';