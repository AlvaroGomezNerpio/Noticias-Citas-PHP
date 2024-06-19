<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicion De Sesion</title>

    <link rel="stylesheet" href="css/styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<?php include_once './Includes/sesion_star.php'; ?>
<?php include_once './Includes/header.php'; ?>


<div class="container">
    <h2>Iniciar Sesión</h2>

    <?php
    // Verificar si existe la cookie de mensaje de error
    if (isset($_COOKIE["mensaje_error"])) {
        echo $_COOKIE["mensaje_error"];
        // Eliminar la cookie para que no se muestre en futuras cargas de la página
        setcookie("mensaje_error", "", time() - 3600, "/");
    }
    ?>

    <!-- Formualario para el login del usuario -->
    <form class="row g-3" action="index.php?controller=login&action=autenticar" method="POST">

        <label for="usuario" class="form-label">Usuario:</label>
        <input type="text" class="form-control" id="usuario" name="usuario" required><br><br>

        <label for="password" class="form-label">Contraseña:</label>
        <input type="password" class="form-control" id="password" name="password" required><br><br>

        <input type="submit" class="btn btn-primary" value="Iniciar Sesión">

    </form>
</div>

<?php include_once './Includes/footer.php'; ?>

</body>

</html>