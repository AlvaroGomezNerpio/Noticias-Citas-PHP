<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas Admin</title>

    <link rel="stylesheet" href="../css/styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<?php include_once './Includes/sesion_star.php'; ?>
<?php include_once './Includes/header.php'; ?>


<div class="container">

    <h1>Administración de Citas</h1>

    <?php
    // Verificar si existe la cookie de mensaje de error
    if (isset($_COOKIE["mensaje_error"])) {
        echo $_COOKIE["mensaje_error"];
        // Eliminar la cookie para que no se muestre en futuras cargas de la página
        setcookie("mensaje_error", "", time() - 3600, "/");
    }
    ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                    <td><?php echo $usuario['nombre']; ?></td>
                    <td><?php echo $usuario['apellidos']; ?></td>
                    <td>
                        <a class="btn btn-primary" href="index.php?controller=Citas&action=getCitasAdminidUsuario&id=<?php echo $usuario['idUser']; ?>">Ver Citas</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</div>

<?php include_once './Includes/footer.php'; ?>

</body>

</html>