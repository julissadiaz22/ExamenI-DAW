<?php
session_start();

if (!isset($_SESSION['equipos']) || !is_array($_SESSION['equipos'])) {
    $_SESSION['equipos'] = array();
}

$equipo_nombre = $_GET['equipo'];

$equipo_encontrado = null;
foreach ($_SESSION['equipos'] as $equipo) {
    if ($equipo['nombre'] === $equipo_nombre) {
        $equipo_encontrado = $equipo;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
     
</head>
<body>
    <?php
    include 'index.php';
    ?>
    <div class="container">
        <h2 class="mb-4">Editar Equipo</h2>
        <?php
        if ($equipo_encontrado) {
            ?>
            <form action="equipoAgregado.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="equipo_original" value="<?= $equipo_encontrado['nombre'] ?>">
                <div class="form-group">
                    <label for="lista">Seleccione la Liga:</label>
                    <select class="form-control" name="lista" id="lista">
                        <option value="premiere" <?= ($equipo_encontrado['liga'] === 'Premier League (Inglaterra-UEFA)') ? 'selected' : '' ?>>Premier League (Inglaterra-UEFA)</option>
                        <option value="serieA" <?= ($equipo_encontrado['liga'] === 'Serie A (Italia-UEFA)') ? 'selected' : '' ?>>Serie A (Italia-UEFA)</option>
                        <option value="laliga" <?= ($equipo_encontrado['liga'] === 'La Liga (España-UEFA)') ? 'selected' : '' ?>>La Liga (España-UEFA)</option>
                        <option value="brasileirao" <?= ($equipo_encontrado['liga'] === 'Brasileirao (Brasil-Conmebol)') ? 'selected' : '' ?>>Brasileirao (Brasil-Conmebol)</option>
                        <option value="bundesliga" <?= ($equipo_encontrado['liga'] === 'Bundesliga (Alemania-UEFA)') ? 'selected' : '' ?>>Bundesliga (Alemania-UEFA)</option>
                        <option value="ligue1" <?= ($equipo_encontrado['liga'] === 'Ligue 1 (Francia-UEFA)') ? 'selected' : '' ?>>Ligue 1 (Francia-UEFA)</option>
                        <option value="primeira" <?= ($equipo_encontrado['liga'] === 'Primeira Liga (Portugal-UEFA)') ? 'selected' : '' ?>>Primeira Liga (Portugal-UEFA)</option>
                        <option value="eredivisie" <?= ($equipo_encontrado['liga'] === 'Eredivisie (Países Bajos-UEFA)') ? 'selected' : '' ?>>Eredivisie (Países Bajos-UEFA)</option>
                        <option value="belgian" <?= ($equipo_encontrado['liga'] === 'Belgian Pro League (Bélgica-UEFA)') ? 'selected' : '' ?>>Belgian Pro League (Bélgica-UEFA)</option>
                        <option value="primeraD" <?= ($equipo_encontrado['liga'] === 'Primera División (Argentina-Conmebol)') ? 'selected' : '' ?>>Primera División (Argentina-Conmebol)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nombreEquipo">Nombre Equipo:</label>
                    <input type="text" class="form-control" id="nombreEquipo" placeholder="Escriba el nombre del Equipo" required name="nombre" value="<?= $equipo_encontrado['nombre'] ?>">
                </div>
                <div class="form-group">
                    <label for="imagen">Seleccione la Imagen de su Equipo:</label>
                    <input type="file" class="form-control-file" id="imagen" name="imagen" onchange="mostrarImagen()" accept="image/*">
                    <img id="imagenMiniatura" src="<?= $equipo_encontrado['imagen'] ?>" alt="Vista previa de la imagen" style="display: block;">
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn btn-primary" name="actualizar">Actualizar Equipo</button>
                    <a href="equipoAgregado.php" class="btn btn-secondary">Regresar</a>
                </div>
            </form>
            <?php
        } else {
            echo "<p>No se encontró el equipo.</p>";
        }
        ?>
    </div>

    <script>
        function mostrarImagen() {
            var archivo = document.getElementById('imagen').files[0];
            var lector = new FileReader();
            
            lector.onload = function(e) {
                document.getElementById('imagenMiniatura').src = e.target.result;
            }
            
            lector.readAsDataURL(archivo);
        }
    </script>
</body>
</html>




