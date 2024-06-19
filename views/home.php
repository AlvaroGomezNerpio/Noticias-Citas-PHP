<?php include_once './Includes/sesion_star.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>

    <link rel="stylesheet" href="../css/styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<?php include_once './Includes/header.php'; ?>

<div class="container">

    <?php
    // Verificar si existe la cookie de mensaje de error
    if (isset($_COOKIE["mensaje_error"])) {
        echo $_COOKIE["mensaje_error"];
        // Eliminar la cookie para que no se muestre en futuras cargas de la página
        setcookie("mensaje_error", "", time() - 3600, "/");
    }
    ?>

    <div class="inicio text-center">
        <h1>Inicio</h1>
        <p>Etiam eget ante pellentesque, ullamcorper nibh ut, porta elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus justo accumsan consequat semper. Vivamus facilisis ut dolor lacinia ornare. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis maximus porta turpis, non porta risus tempus id. Quisque porttitor enim egestas erat feugiat malesuada.</p>
    </div>

    <hr>

    <div class="">

        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/beiheng-guo-IAVVv6z3D6g-unsplash.jpg" class="d-block w-100 h-25" alt="4000px" width="6000px">
                </div>
                <div class="carousel-item">
                    <img src="img/roberto-nickson-lGCfApDzhYw-unsplash.jpg" class="d-block w-100 h-25" alt="3648px"  width="5472px">
                </div>
                <div class="carousel-item">
                    <img src="img/visar-neziri-CAQvwCoHLhw-unsplash.jpg" class="d-block w-100 h-25" alt="5491px"  width="8237px">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>

    <hr>

    <div class="nosotros container text-center">

        <h2>Sobre nosotros</h2>

        <div class="row">
            <div class="col">
                <h3>Ordenado</h3>
                <p>Etiam eget ante pellentesque, ullamcorper nibh ut, porta elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus justo accumsan consequat semper. Vivamus facilisis ut dolor lacinia ornare. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis maximus porta turpis, non porta risus tempus id. Quisque porttitor enim egestas erat feugiat malesuada.</p>
            </div>
            <div class="col">
                <h3>Cuidadoso</h3>
                <p>Etiam eget ante pellentesque, ullamcorper nibh ut, porta elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus justo accumsan consequat semper. Vivamus facilisis ut dolor lacinia ornare. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis maximus porta turpis, non porta risus tempus id. Quisque porttitor enim egestas erat feugiat malesuada.</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3>Original</h3>
                <p>Etiam eget ante pellentesque, ullamcorper nibh ut, porta elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus justo accumsan consequat semper. Vivamus facilisis ut dolor lacinia ornare. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis maximus porta turpis, non porta risus tempus id. Quisque porttitor enim egestas erat feugiat malesuada.</p>
            </div>
            <div class="col">
                <h3>Fuerte</h3>
                <p>Etiam eget ante pellentesque, ullamcorper nibh ut, porta elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus justo accumsan consequat semper. Vivamus facilisis ut dolor lacinia ornare. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis maximus porta turpis, non porta risus tempus id. Quisque porttitor enim egestas erat feugiat malesuada.</p>
            </div>
            <div class="col">
                <h3>Creativo</h3>
                <p>Etiam eget ante pellentesque, ullamcorper nibh ut, porta elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus justo accumsan consequat semper. Vivamus facilisis ut dolor lacinia ornare. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis maximus porta turpis, non porta risus tempus id. Quisque porttitor enim egestas erat feugiat malesuada.</p>

            </div>
        </div>
    </div>

</div>

<?php include_once './Includes/footer.php'; ?>

</body>

</html>