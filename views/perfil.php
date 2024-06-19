<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>

    <link rel="stylesheet" href="css/styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<?php include_once './Includes/sesion_star.php'; ?>
<?php include_once './Includes/header.php'; ?>


<div class="container">

    <h2>Perfil</h2>

    <?php
    // Verificar si existe la cookie de mensaje de error
    if (isset($_COOKIE["mensaje_error"])) {
        echo $_COOKIE["mensaje_error"];
        // Eliminar la cookie para que no se muestre en futuras cargas de la página
        setcookie("mensaje_error", "", time() - 3600, "/");
    }
    ?>

    <div class="infoPerfil row g-3">
        <div class="col-md-6">
            <label class="form-label">Nombre:</label>
            <input type="text" class="form-control" value="<?php echo $usuario['nombre']; ?>" readonly><br>
        </div>

        <div class="col-md-6">
            <label class="form-label">Apellidos:</label>
            <input type="text" class="form-control" value="<?php echo $usuario['apellidos']; ?>" readonly><br>
        </div>

        <div class="col-md-4">
            <label class="form-label">E-mail</label>
            <input type="text" class="form-control" value="<?php echo $usuario['email']; ?>" readonly><br>
        </div>

        <div class="col-md-4">
            <label class="form-label">Telefono</label>
            <input type="text" class="form-control" value="<?php echo $usuario['telefono']; ?>" readonly><br>
        </div>

        <div class="col-md-4">
            <label class="form-label">Fecha De Nacimiento</label>
            <input type="text" class="form-control" value="<?php echo $usuario['fecha_nacimiento']; ?>" readonly><br>
        </div>

        <div class="col-md-6">
            <label class="form-label">Direccion</label>
            <input type="text" class="form-control" value="<?php echo $usuario['direccion']; ?>" readonly><br>
        </div>

        <div class="col-md-6">
            <label class="form-label">Sexo</label>
            <input type="text" class="form-control" value="<?php echo $usuario['sexo']; ?>" readonly><br>
        </div>
    </div>

    <a href="index.php?controller=perfil&action=editar" class="btn btn-light text-dark me-2">Editar Perfil</a>

    <hr>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Cambiar Contraseña
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar Contraseña</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="index.php?controller=perfil&action=cambiarContrasena" method="post">
                        <div>
                            <labe class="form-label" l for="contraseña_actual">Contraseña Antigua:</labe>
                            <input type="password" class="form-control" name="contraseña_actual" id="contraseña_actual" required><br>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="nueva_contraseña">Nueva Contraseña:</label>
                            <input type="password" class="form-control" name="nueva_contraseña" id="nueva_contraseña" required><br>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="confirmar_nueva_contraseña">Confirmar Nueva Contraseña:</label>
                            <input type="password" class="form-control" name="confirmar_nueva_contraseña" id="confirmar_nueva_contraseña" required><br>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Cambiar Contraseña">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


</div>

<?php include_once './Includes/footer.php'; ?>

</body>

</html>