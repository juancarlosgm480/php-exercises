<?php

session_start();

$errores = $_SESSION['errores_validacion'] ?? [];
$datos = $_SESSION['datos_viejos'] ?? [];

unset($_SESSION['errores_validacion']);
unset($_SESSION['datos_viejos']);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio de sesión</title>
</head>

<body>

    <h1>Iniciar sesión</h1>

    <form action="/php/login_avanzado/index.php" method="POST">

        <div style="margin-bottom: 15px;">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario"
                value="<?= htmlspecialchars($datos['usuario'] ?? '') ?>" required>

            <?php if(isset($errores['usuario'])): ?>
                <span style="color: red;"><?= $errores['usuario'] ?></span>
            <?php endif ?>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo"
                value="<?= htmlspecialchars($datos['correo'] ?? '') ?>" required>

            <?php if(isset($errores['correo'])): ?>
                <span style="color: red;"><?= $errores['correo'] ?></span>
            <?php endif ?>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono"
                value="<?= htmlspecialchars($datos['telefono'] ?? '') ?>" required>

            <?php if(isset($errores['telefono'])): ?>
                <span style="color: red;"><?= $errores['telefono'] ?></span>
            <?php endif ?>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <?php if(isset($errores['password'])): ?>
                <span style="color: red;"><?= $errores['password'] ?></span>
            <?php endif ?>
        </div>

        <button type="submit">Entrar</button>

    </form>

</body>
</html>
