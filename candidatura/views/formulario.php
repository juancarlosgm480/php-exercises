<?php

function limpiar(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

$situaciones = ['sin empleo', 'media jornada', 'tiempo completo'];
$lenguajesDisponibles = ['Python', 'PHP', 'JavaScript', 'Java', 'C++'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de candidatura</title>
</head>
<body>
    <h1>Formulario de candidatura</h1>

    <?php if ($candidatoValido): ?>
        <h2>Candidatura enviada correctamente</h2>
        <h3>Datos recibidos</h3>
        <p><strong>Nombre:</strong> <?= limpiar($datos['nombre']) ?></p>
        <p><strong>Apellidos:</strong> <?= limpiar($datos['apellidos']) ?></p>
        <p><strong>Correo:</strong> <?= limpiar($datos['correo']) ?></p>
        <p><strong>Teléfono:</strong> <?= limpiar($datos['telefono']) ?></p>
        <p><strong>Situación laboral:</strong> <?= limpiar($datos['situacion']) ?></p>
        <p><strong>Lenguajes:</strong>
            <?= limpiar(implode(', ', $datos['lenguajes'])) ?>
        </p>
        <p><strong>URL:</strong>
            <a href="<?= limpiar($datos['url']) ?>" target="_blank">
                <?= limpiar($datos['url']) ?>
            </a>
        </p>
    <?php else: ?>

        <?php if (!empty($errores)): ?>
            <p>Hay errores en el formulario. Revísalos antes de enviarlo.</p>
        <?php endif; ?>

        <form action="" method="POST">
            <p>
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" name="nombre"
                       value="<?= limpiar($datos['nombre']) ?>" required>
                <?php if (isset($errores['nombre'])): ?>
                    <br><span><?= limpiar($errores['nombre']) ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="apellidos">Apellidos:</label><br>
                <input type="text" id="apellidos" name="apellidos"
                       value="<?= limpiar($datos['apellidos']) ?>" required>
                <?php if (isset($errores['apellidos'])): ?>
                    <br><span><?= limpiar($errores['apellidos']) ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="correo">Correo electrónico:</label><br>
                <input type="email" id="correo" name="correo"
                       value="<?= limpiar($datos['correo']) ?>" required>
                <?php if (isset($errores['correo'])): ?>
                    <br><span><?= limpiar($errores['correo']) ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="telefono">Teléfono:</label><br>
                <input type="text" id="telefono" name="telefono"
                       maxlength="9" value="<?= limpiar($datos['telefono']) ?>" required>
                <?php if (isset($errores['telefono'])): ?>
                    <br><span><?= limpiar($errores['telefono']) ?></span>
                <?php endif; ?>
            </p>

            <fieldset>
                <legend>Situación laboral actual:</legend>
                <?php foreach ($situaciones as $situacion): ?>
                    <label>
                        <input type="radio" name="situacion"
                               value="<?= limpiar($situacion) ?>"
                               <?= $datos['situacion'] === $situacion ? 'checked' : '' ?>>
                        <?= limpiar(ucfirst($situacion)) ?>
                    </label><br>
                <?php endforeach; ?>
                <?php if (isset($errores['situacion'])): ?>
                    <span><?= limpiar($errores['situacion']) ?></span>
                <?php endif; ?>
            </fieldset>

            <fieldset>
                <legend>Lenguajes de programación que dominas:</legend>
                <?php foreach ($lenguajesDisponibles as $lenguaje): ?>
                    <label>
                        <input type="checkbox" name="lenguajes[]"
                               value="<?= limpiar($lenguaje) ?>"
                               <?= in_array($lenguaje, $datos['lenguajes'], true) ? 'checked' : '' ?>>
                        <?= limpiar($lenguaje) ?>
                    </label><br>
                <?php endforeach; ?>
                <?php if (isset($errores['lenguajes'])): ?>
                    <span><?= limpiar($errores['lenguajes']) ?></span>
                <?php endif; ?>
            </fieldset>

            <p>
                <label for="url">URL de alguno de tus trabajos:</label><br>
                <input type="url" id="url" name="url"
                       value="<?= limpiar($datos['url']) ?>" required>
                <?php if (isset($errores['url'])): ?>
                    <br><span><?= limpiar($errores['url']) ?></span>
                <?php endif; ?>
            </p>

            <button type="submit">Enviar candidatura</button>
        </form>
    <?php endif; ?>
</body>
</html>
