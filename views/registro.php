<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <link rel="stylesheet" href="css/styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<?php include_once './Includes/sesion_star.php'; ?>
<?php include_once './Includes/header.php'; ?>


<div class="container">
    <h2>Registro de Usuario</h2>

    <?php
    // Verificar si existe la cookie de mensaje de error
    if (isset($_COOKIE["mensaje_error"])) {
        echo $_COOKIE["mensaje_error"];
        // Eliminar la cookie para que no se muestre en futuras cargas de la página
        setcookie("mensaje_error", "", time() - 3600, "/");
    }
    ?>

    <!-- Formulario para el resfgistro del Usuario -->
    <form class="row g-3" action="index.php?controller=registro&action=registrar" method="POST">

        <div class="col-md-6">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required><br><br>
        </div>

        <div class="col-md-6">
            <label for="apellidos" class="form-label">Apellidos:</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" required><br><br>
        </div>

        <div class="col-md-4">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required><br><br>
        </div>

        <div class="col-md-4">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" required><br><br>
        </div>

        <div class="col-md-4">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required><br><br>
        </div>

        <div class="col-md-6">
            <label for="direccion" class="form-label">Dirección:</label>
            <input type="text" class="form-control" id="direccion" name="direccion"><br><br>
        </div>

        <div class="col-md-6">
            <label for="sexo" class="form-label">Sexo:</label>
            <select id="sexo" name="sexo" class="form-select">
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
            </select><br><br>
        </div>

        <div class="col-md-6">
            <label for="usuario" class="form-label">Nombre de Usuario:</label>
            <input type="text" class="form-control" id="usuario" name="usuario" required><br><br>
        </div>


        <div class="col-md-6"> 
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" required><br><br>
        </div>

        <input type="submit" class="btn btn-primary" value="Registrar">

    </form>
</div>



<?php include_once './Includes/footer.php'; ?>

</body>

</html>