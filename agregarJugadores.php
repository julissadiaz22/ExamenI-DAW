<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Jugadores</title>
    <!-- Integración de Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
     
</head>
<body>
    <?php
    include 'index.php';
    ?>
    <div class="container">
        <h2 class="mt-3">Agregar un Jugador</h2>
        <form action="jugadoresAgregados.php" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <!-- Primera columna -->
                <div class="form-group col-md-6">
                    <label for="equipoS">Equipo:</label>
                    <input type="hidden" name="equipoS" value="<?php echo isset($_GET['equipo']) ? htmlspecialchars($_GET['equipo']) : ''; ?>">
<input type="text" class="form-control" id="equipoS" name="equipoS" value="<?php echo isset($_GET['equipo']) ? htmlspecialchars($_GET['equipo']) : ''; ?>" required disabled>

                </div>
                <div class="form-group col-md-6">
                    <label for="posiciones">Posición natural:</label>
                    <select class="form-control" id="posiciones" name="posiciones">
                        <option value="portero">Portero</option>
                        <option value="defensaCentral">Defensa Central</option>
                        <option value="lateralDerecho">Lateral Derecho</option>
                        <option value="lateralIzquierdo">Lateral Izquierdo</option>
                        <option value="centrocampistaD">Centrocampista defensivo</option>
                        <option value="centrocampistaC">Centrocampista central</option>
                        <option value="centrocampistaO">Centrocampista ofensivo</option>
                        <option value="extremoD">Extremo derecho</option>
                        <option value="extremoI">Extremo izquierdo</option>
                        <option value="delanteroC">Delantero centro</option>
                        <option value="delanteroS">Delantero segunda punta</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="foto">Fotografía del Jugador:</label>
                    <input type="file" class="form-control-file" id="fotoJu" name="foto" accept="image/*" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="fecha">Fecha de nacimiento:</label>
                    <input type="date" class="form-control" id="fechaJu" name="fecha" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombreJ">Nombre Completo:</label>
                    <input type="text" class="form-control" id="nombreJu" name="nombreJ" placeholder="Ingrese el nombre del jugador" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="nacionalidad">Nacionalidad:</label>
                    <input type="text" class="form-control" id="nacionalidadJu" name="nacionalidad" placeholder="Ingrese la nacionalidad" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="apodo">Apodo:</label>
                    <input type="text" class="form-control" id="apodoJu" name="apodo" placeholder="Ingrese el apodo del jugador">
                </div>
                <div class="form-group col-md-6">
                    <label for="altura">Altura:</label>
                    <input type="number" class="form-control" id="alturaJu" name="altura" step="any" placeholder="Altura en mts" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="dorsal">Dorsal:</label>
                    <input type="number" class="form-control" id="dorsalJu" name="dorsal" placeholder="Ingrese el número que identifica al jugador" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="peso">Peso:</label>
                    <input type="number" class="form-control" id="pesoJu" name="peso" step="any" placeholder="Peso del jugador en Kg" required>
                </div>
            </div>
            <!-- Los demás campos del formulario -->
            <div class="button-group">
                <button type="submit" class="btn btn-primary" name="inscribir">Inscribir Jugador</button>
                <button type="reset" class="btn btn-secondary" name="limpiar">Limpiar Campos</button>
            </div>
        </form>
    </div>

    <!-- Integración de Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>




