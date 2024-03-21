<?php
session_start();

// Verificar si hay datos de jugadores en la sesión
if (!isset($_SESSION['jugadores'])) {
    $_SESSION['jugadores'] = array();
}

// Obtener el índice del jugador a editar
$index = null;
if(isset($_GET['index'])) {
    $index = $_GET['index'];
    if (!isset($_SESSION['jugadores'][$index])) {
        // Redireccionar si el índice no es válido
        header("Location: jugadoresAgregados.php");
        exit();
    }
    $jugador = $_SESSION['jugadores'][$index];
} else {
    // Redireccionar si no se proporciona un índice válido
    header("Location: jugadoresAgregados.php");
    exit();
}

// Obtener lista de equipos disponibles
$equipos_disponibles = array_unique(array_column($_SESSION['jugadores'], 'equipoS'));

// Definir un array asociativo con los nombres completos de las posiciones
$posiciones_completas = array(
    'portero' => 'Portero',
    'defensaCentral' => 'Defensa Central',
    'lateralDerecho' => 'Lateral Derecho',
    'lateralIzquierdo' => 'Lateral Izquierdo',
    'centrocampistaD' => 'Centrocampista defensivo',
    'centrocampistaC' => 'Centrocampista central',
    'centrocampistaO' => 'Centrocampista ofensivo',
    'extremoD' => 'Extremo derecho',
    'extremoI' => 'Extremo izquierdo',
    'delanteroC' => 'Delantero centro',
    'delanteroS' => 'Delantero segunda punta'
);

// Actualizar los datos del jugador si se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["actualizar"])) {
    
    $equipo = $_POST["equipoS"];
    $nombre=$_POST["nombreJ"];
    $posicion = $_POST["posiciones"];
    $fotoNombre = $_FILES["foto"]["name"];
    $fotoTemp = $_FILES["foto"]["tmp_name"];
    $fotoDestino = 'uploads/' . $fotoNombre; // Ruta de destino para guardar la foto

    // Verificar si se subió una nueva foto
    if (!empty($fotoNombre)) {
        // Mover la foto al directorio de subida
        if (move_uploaded_file($fotoTemp, $fotoDestino)) {
            $jugador['foto'] = $fotoDestino;
        } else {
            // Si ocurre algún error al subir la foto, muestra un mensaje de error
            echo '<p class="text-danger">Error al subir la foto.</p>';
        }
    }

    // Actualizar los datos del jugador en la sesión
    $_SESSION['jugadores'][$index] = array(
        'equipoS' => $equipo,
        'nombreJ' => $nombre,
        'posicion' => $posicion,
        'foto' => $jugador['foto'],
        'nacionalidad' => $_POST['nacionalidad'],
        'dorsal' => $_POST["dorsal"],
        'nacimiento' => $_POST["fecha"],
        'apodo' => $_POST["apodo"],
        'altura' => $_POST["altura"],
        'peso' => $_POST["peso"]
    );

    // Redireccionar a la página de jugadores agregados después de actualizar
    header("Location: jugadoresAgregados.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Jugador</title>
    <!-- Integración de Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   
</head>
<body>
    <?php
    include 'index.php';
    ?>
    <div class="container">
        <h2 class="mt-3">Editar Jugador</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?index=" . $index); ?>" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <!-- Primera columna -->
                <div class="form-group col-md-6">
                    <label for="equipoS">Equipo:</label>
                    <select class="form-control" id="equipoS" name="equipoS" required>
                        <?php foreach ($equipos_disponibles as $equipo) : ?>
                            <option value="<?= $equipo ?>" <?php if ($equipo == $jugador['equipoS']) echo 'selected'; ?>><?= $equipo ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="posiciones">Posición natural:</label>
                    <select class="form-control" id="posiciones" name="posiciones">
                        <?php foreach ($posiciones_completas as $clave => $valor) : ?>
                            <option value="<?= $clave ?>" <?php if ($clave == $jugador['posicion']) echo 'selected'; ?>><?= $valor ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="foto">Fotografía del Jugador:</label>
                    <input type="file" class="form-control-file" id="fotoJu" name="foto" accept="image/*">
                </div>
                <div class="form-group col-md-6">
                    <label for="fecha">Fecha de nacimiento:</label>
                    <input type="date" class="form-control" id="fechaJu" name="fecha" value="<?= $jugador['nacimiento'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombreJ">Nombre Completo:</label>
                    <input type="text" class="form-control" id="nombreJu" name="nombreJ" value="<?= $jugador['nombreJ'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="nacionalidad">Nacionalidad:</label>
                    <input type="text" class="form-control" id="nacionalidadJu" name="nacionalidad" value="<?= $jugador['nacionalidad'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="apodo">Apodo:</label>
                    <input type="text" class="form-control" id="apodoJu" name="apodo" value="<?= $jugador['apodo'] ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="altura">Altura:</label>
                    <input type="number" class="form-control" id="alturaJu" name="altura" step="any" value="<?= $jugador['altura'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="dorsal">Dorsal:</label>
                    <input type="number" class="form-control" id="dorsalJu" name="dorsal" value="<?= $jugador['dorsal'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="peso">Peso:</label>
                    <input type="number" class="form-control" id="pesoJu" name="peso" step="any" value="<?= $jugador['peso'] ?>" required>
                </div>
            </div>
            <!-- Los demás campos del formulario -->
            <div class="button-group">
                <button type="submit" class="btn btn-primary" name="actualizar">Actualizar Jugador</button>
                <a href="jugadoresAgregados.php" class="btn btn-secondary">Regresar</a>
            </div>
        </form>
    </div>

    <!-- Integración de Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


