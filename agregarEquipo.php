<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Equipo</title>
    <!-- Enlace de Estilos Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    
</head>
 

<body>
    <?php 
    include 'index.php';
    ?>
    

    <div class="container formulario-container">
        <form action="equipoAgregado.php" method="post" enctype="multipart/form-data">
            <h2 class="mb-4">Agregar un Equipo</h2>
            <div class="form-group">
                <label for="lista">Seleccione la Liga:</label>
                <select class="form-control" name="lista" id="lista">
                    <option value="premiere">Premier League (Inglaterra-UEFA)</option>
                    <option value="serieA">Serie A (Italia-UEFA)</option>
                    <option value="laliga">La Liga (España-UEFA)</option>
                    <option value="brasileirao">Brasileirao (Brasil-Conmebol)</option>
                    <option value="bundesliga">Bundesliga (Alemania-UEFA)</option>
                    <option value="ligue1">Ligue 1 (Francia-UEFA)</option>
                    <option value="primeira">Primeira Liga (Portugal-UEFA)</option>
                    <option value="eredivisie">Eredivisie (Países Bajos-UEFA)</option>
                    <option value="belgian">Belgian Pro League (Bélgica-UEFA)</option>
                    <option value="primeraD">Primera División (Argentina-Conmebol)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nombreEquipo">Nombre Equipo:</label>
                <input type="text" class="form-control" id="nombreEquipo" placeholder="Escriba el nombre del Equipo" required name="nombre">
            </div>
            <div class="form-group">
                <label for="imagen">Seleccione la Imagen de su Equipo:</label>
                <input type="file" class="form-control-file" id="imagen" name="imagen" onchange="mostrarImagen()" required accept="image/*">
                <img id="imagenMiniatura" src="#" alt="Vista previa de la imagen" style="display: none;">
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="agregar">Agregar Equipo</button>
             
            
        </form>
    </div>

    <script>
        function mostrarImagen() {
            var archivo = document.getElementById('imagen').files[0];
            var lector = new FileReader();
            
            lector.onload = function(e) {
                document.getElementById('imagenMiniatura').src = e.target.result;
                document.getElementById('imagenMiniatura').style.display = 'block';
            }
            
            lector.readAsDataURL(archivo);
        }
    </script>
</body>
</html>
