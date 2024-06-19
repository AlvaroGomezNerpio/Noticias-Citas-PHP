<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias Admin</title>

    <link rel="stylesheet" href="../css/styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<?php include_once './Includes/sesion_star.php'; ?>
<?php include_once './Includes/header.php'; ?>


<div class="container">
    <h1>Noticias admin</h1>

    <?php
    // Verificar si existe la cookie de mensaje de error
    if (isset($_COOKIE["mensaje_error"])) {
        echo $_COOKIE["mensaje_error"];
        // Eliminar la cookie para que no se muestre en futuras cargas de la página
        setcookie("mensaje_error", "", time() - 3600, "/");
    }
    ?>

    <div class="formNoticia m-5">
        <form action="index.php?controller=noticias&action=agregarNoticia" method="post" enctype="multipart/form-data">
            <label for="titulo" class="form-label">Título:</label><br>
            <input type="text" class="form-control" id="titulo" name="titulo" required><br>

            <label for="texto" class="form-label">Texto:</label><br>
            <textarea id="texto" class="form-control" name="texto" required></textarea><br>

            <label for="imagen" class="form-label">Imagen:</label><br>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required><br>

            <input type="submit" class="btn btn-primary" value="Agregar Noticia">
        </form>
    </div>


    <hr>

    <div class="noticias-container row g-2 justify-content-between">
        <?php foreach ($noticias as $noticia) : ?>

            <div class="card col-md-5 text-center mb-2" >
                <img class="card-img-top" src="<?php echo $noticia['imagen']; ?>">
                <h2><?php echo $noticia['titulo']; ?></h2>
                <div class="card-body">
                    <p class="card-text"><?php echo $noticia['texto']; ?></p>
                </div>
                <p><strong>Fecha:</strong> <?php echo $noticia['fecha']; ?></p>
                <p><strong>Autor:</strong> <?php echo $noticia['nombre_usuario']; ?></p>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Modificar Noticia
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Noticia</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="formActNoticia m-3">

                                    <!-- Formulario para modificar la noticia -->
                                    <form action="index.php?controller=noticias&action=modificar" method="post" enctype="multipart/form-data">
                                        <!-- Campos ocultos para enviar el ID de la noticia -->
                                        <input type="hidden" name="idNoticia" value="<?php echo $noticia['idNoticia']; ?>">

                                        <!-- Campos para modificar los datos de la noticia -->
                                        <label for="titulo" class="form-label">Título:</label>
                                        <input type="text" class="form-control" name="titulo" value="<?php echo $noticia['titulo']; ?>"><br>

                                        <label for="texto" class="form-label">Texto:</label>
                                        <textarea class="form-control" name="texto"><?php echo $noticia['texto']; ?></textarea><br>

                                        <label for="imagen" class="form-label">Imagen:</label>
                                        <input type="file" class="form-control" name="imagen"><br>

                                        <!-- Botón para enviar el formulario de modificación -->
                                        <input type="submit" class="btn btn-primary" value="Modificar Noticia">
                                    </form>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botón para eliminar la noticia -->
                <a class="btn btn-danger" href="index.php?controller=noticias&action=eliminar&id=<?php echo $noticia['idNoticia']; ?>">Eliminar</a>

            </div>




        <?php endforeach; ?>
    </div>
</div>


<?php include_once './Includes/footer.php'; ?>

</body>

</html>