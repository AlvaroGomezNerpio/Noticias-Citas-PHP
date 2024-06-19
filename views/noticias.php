<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias</title>

    <link rel="stylesheet" href="css/styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<?php include_once './Includes/sesion_star.php'; ?>
<?php include_once './Includes/header.php'; ?>


<div class="container">
    <h2>Noticias</h2>

    <?php
    // Verificar si existe la cookie de mensaje de error
    if (isset($_COOKIE["mensaje_error"])) {
        echo $_COOKIE["mensaje_error"];
        // Eliminar la cookie para que no se muestre en futuras cargas de la página
        setcookie("mensaje_error", "", time() - 3600, "/");
    }
    ?>

    <div class="noticias-container row g-3">

        <?php foreach ($noticias as $noticia) : ?>

            <div class="card" >
                <img class="card-img-top" src="<?php echo $noticia['imagen']; ?>">
                <h2><?php echo $noticia['titulo']; ?></h2>
                <div class="card-body">
                    <p class="card-text"><?php echo $noticia['texto']; ?></p>
                </div>
                <p><strong>Fecha:</strong> <?php echo $noticia['fecha']; ?></p>
                <p><strong>Autor:</strong> <?php echo $noticia['nombre_usuario']; ?></p>
            </div>

        <?php endforeach; ?>

    </div>
</div>



<?php include_once './Includes/footer.php'; ?>

</body>

</html>