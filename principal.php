<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrusel</title>
    <!-- Enlace de Estilos Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .carousel-item img {
            height: 500px; /* Ajusta la altura de las imágenes */
            object-fit: cover; /* Escala las imágenes para que cubran todo el contenedor */
            opacity: 0.8; /* Define la opacidad de las imágenes */
        }

        .carousel-item {
            background-color: rgba(0, 0, 0, 0.3); /* Fondo semi-transparente para las imágenes */
        }

        .carousel-control-prev,
        .carousel-control-next {
            opacity: 0.2; /* Define la opacidad de los botones de control */
        }
    </style>
</head>
<body>
    <?php
    include 'index.php';
    ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> <!-- Añadido el atributo data-ride -->
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="https://e00-marca.uecdn.es/assets/multimedia/imagenes/2020/07/27/15958041270911.jpg" alt="Primera imagen">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://www.sopitas.com/wp-content/uploads/2022/08/10-jugadores-mas-caros-premier-league-haaland-salah-foden.jpg" alt="Segunda imagen">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://st1.uvnimg.com/22/a1/49a589b34b749564fcae4596029a/01afbb0980704d1d9eff162fb3d75470" alt="Tercera imagen">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://www.diarioextra.com/files/Dnews/images/detail/415785_premierleague1660x360.jpg" alt="Cuarta imagen">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Enlace de JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>




