<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Perfil</title>

    <link rel="stylesheet" href="../css/styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<?php include_once './Includes/sesion_star.php'; ?>
<?php include_once './Includes/header.php'; ?>


<div class="container">
    <h2>Editar Perfil</h2>

    <?php
    // Verificar si existe la cookie de mensaje de error
    if (isset($_COOKIE["mensaje_error"])) {
        echo $_COOKIE["mensaje_error"];
        // Eliminar la cookie para que no se muestre en futuras cargas de la página
        setcookie("mensaje_error", "", time() - 3600, "/");
    }
    ?>

    <div class="formEditPerfil">
        <form class="row g-3" action="index.php?controller=perfil&action=actualizar" method="post">
        
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required><br><br>
            </div>
            <div class="col-md-6">
        
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $usuario['apellidos']; ?>" required><br><br>
            </div>
            <div class="col-md-4">
        
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $usuario['email']; ?>" required><br><br>
            </div>
            <div class="col-md-4">
        
                <label for="telefono" class="form-label">Telefono:</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $usuario['telefono']; ?>" required><br><br>
            </div>
            <div class="col-md-4">
        
                <label for="fecha_nacimiento" class="form-label">Fecha nacimiento:</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $usuario['fecha_nacimiento']; ?>" required><br><br>
            </div>
            <div class="col-md-6">
        
                <label for="direccion" class="form-label">Direccion:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $usuario['direccion']; ?>" required><br><br>
            </div>
        
            <div class="col-md-6">
                <label for="sexo" class="form-label">Sexo:</label>
                <select id="sexo" name="sexo" class="form-select">
                    <option value="masculino" <?php echo ($usuario['sexo'] === 'masculino') ? 'selected' : ''; ?>>Masculino</option>
                    <option value="femenino" <?php echo ($usuario['sexo'] === 'femenino') ? 'selected' : ''; ?>>Femenino</option>
                </select><br><br>
            </div class="col-md-6">
        
            <?php if (isset($userLogin)) : ?>
        
                <div class="col-md-4">
                    <label for="sexo" class="form-label">Rol:</label>
                    <select id="sexo" name="rol" class="form-select">
                        <option value="user" <?php echo ($userLogin['rol'] === 'user') ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo ($userLogin['rol'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select><br><br>
                </div>
        
                <input type="text" id="idUser" name="idUser" value="<?php echo $usuario['idUser']; ?>" hidden>
        
            <?php endif; ?>
        
        
                <input type="submit" class="btn btn-primary" value="Guardar Cambios">
        
        </form>
    </div>
</div>

<?php include_once './Includes/footer.php'; ?>

</body>

</html>