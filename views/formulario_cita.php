<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Cita</title>

    <link rel="stylesheet" href="../css/styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<?php include_once './Includes/sesion_star.php'; ?>
<?php include_once './Includes/header.php'; ?>


<div class="container">
    <h2><?php echo isset($idCita) ? 'Modificar Cita' : 'Crear Cita'; ?></h2>

    <?php
    // Verificar si existe la cookie de mensaje de error
    if (isset($_COOKIE["mensaje_error"])) {
        echo $_COOKIE["mensaje_error"];
        // Eliminar la cookie para que no se muestre en futuras cargas de la página
        setcookie("mensaje_error", "", time() - 3600, "/");
    }
    ?>

    <form class="row g-3" action="index.php?controller=citas&action=<?php echo isset($idCita) ? 'modificar' : 'crearCita'; ?>" method="post">

        <?php if (isset($idCita)) : ?>

            <?php if (isset($id)) : ?>

                <input type="hidden" name="id" value="<?php echo $id; ?>">

            <?php endif; ?>

            <?php if (isset($admin)) : ?>

                <input type="hidden" name="admin" value="<?php echo $admin; ?>">

            <?php endif; ?>

            <input type="hidden" name="idCita" value="<?php echo $idCita; ?>">

            <label for="fecha" class="form-label">Fecha:</label>
            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha; ?>" required><br><br>

            <label for="motivo" class="form-label">Motivo:</label><br>
            <textarea id="motivo" class="form-control" name="motivo" rows="4" cols="50" required><?php echo $motivo; ?></textarea><br><br>

            <input type="submit" class="btn btn-primary" value="Modificar Cita">

        <?php else : ?>


            <?php if (isset($_GET['id'])) : ?>

                <input type="hidden" name="idUser" value="<?php echo $_GET['id']; ?>">

            <?php endif; ?>

            <label for="fecha" class="form-label">Fecha:</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required><br><br>

            <label for="motivo" class="form-label">Motivo:</label><br>
            <textarea id="motivo" class="form-control" name="motivo" rows="4" cols="50" required></textarea><br><br>

            <input type="submit" class="btn btn-primary" value="Crear Cita">

        <?php endif; ?>
    </form>

</div>



<?php include_once './Includes/footer.php'; ?>

</body>

</html>