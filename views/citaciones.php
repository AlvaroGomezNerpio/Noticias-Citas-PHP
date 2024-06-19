<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>

    <link rel="stylesheet" href="../css/styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<?php include_once './Includes/sesion_star.php'; ?>
<?php include_once './Includes/header.php'; ?>


<div class="container">

    <h2>Citaciones</h2>

    <?php
    // Verificar si existe la cookie de mensaje de error
    if (isset($_COOKIE["mensaje_error"])) {
        echo $_COOKIE["mensaje_error"];
        // Eliminar la cookie para que no se muestre en futuras cargas de la página
        setcookie("mensaje_error", "", time() - 3600, "/");
    }
    ?>

    <div class="tableCitas">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Motivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($citas as $cita) : ?>
                    <tr>
                        <td><?php echo $cita['fecha_cita']; ?></td>
                        <td><?php echo $cita['motivo_cita']; ?></td>
                        <td>
                            <!-- Enlace para modificar la cita -->
                            <a class="btn btn-primary" href="index.php?controller=citas&action=formulario&idCita=<?php echo $cita['idCita']; ?>&fecha=<?php echo $cita['fecha_cita']; ?>&motivo=<?php echo $cita['motivo_cita']; ?>&id=<?php echo $idUsuario ?>">Modificar</a>
                            <!-- Enlace para borrar la cita -->
                            <a class="btn btn-danger" href="index.php?controller=citas&action=borrar&idCita=<?php echo $cita['idCita']; ?>">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a class="btn btn-primary" href="index.php?controller=citas&action=mostrarFormularioCita&id=<?php echo $idUsuario ?>">Crear Nueva Cita</a>

</div>

<?php include_once './Includes/footer.php'; ?>

</body>

</html>