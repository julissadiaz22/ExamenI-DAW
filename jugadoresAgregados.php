<?php
session_start();
 
include 'index.php';

// Verificar si hay datos de jugadores en la sesión
if (!isset($_SESSION['jugadores'])) {
    $_SESSION['jugadores'] = array();
}

// Inicializar la variable $jugadores_filtrados
$jugadores_filtrados = $_SESSION['jugadores'];

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

// Agregar un nuevo jugador si se envían los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["inscribir"])) {
    $equipo = $_POST["equipoS"];
    $nombre = $_POST["nombreJ"];
    $posicion = $_POST["posiciones"];
    $fotoNombre = $_FILES["foto"]["name"];
    $fotoTemp = $_FILES["foto"]["tmp_name"];
    $fotoDestino = 'uploads/' . $fotoNombre; // Ruta de destino para guardar la foto

    // Mover la foto al directorio de subida
    if (move_uploaded_file($fotoTemp, $fotoDestino)) {
        // Agregar el nuevo jugador a la lista en sesión
        $_SESSION['jugadores'][] = array(
            'equipoS' => $equipo,
            'nombreJ' => $nombre,
            'posicion' => $posicion,
            'foto' => $fotoDestino,
            'nacionalidad' => $_POST['nacionalidad'],
            'dorsal' => $_POST["dorsal"],
            'nacimiento' => $_POST["fecha"],
            'apodo' => $_POST["apodo"],
            'altura' => $_POST["altura"],
            'peso' => $_POST["peso"]
        );
        // Actualizar la variable $jugadores_filtrados
        $jugadores_filtrados = $_SESSION['jugadores'];
    } else {
        // Si ocurre algún error al subir la foto, muestra un mensaje de error
        echo '<p class="text-danger">Error al subir la foto.</p>';
    }
}

// Eliminar un jugador si se envía el formulario de eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar"])) {
    $index = $_POST["index"];
    if (isset($_SESSION['jugadores'][$index])) {
        unset($_SESSION['jugadores'][$index]);
        $jugadores_filtrados = $_SESSION['jugadores'];
    }
}

// Actualizar un jugador si se envía el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["actualizar"])) {
    $index = $_POST["index"];
    $nombre = $_POST['nombreJ']; // Utiliza la variable $nombre para almacenar el nuevo nombre
    $equipo = $_POST["equipoS"];
    $posicion = $_POST["posiciones"];
    $fotoNombre = $_FILES["foto"]["name"];
    $fotoTemp = $_FILES["foto"]["tmp_name"];
    $fotoDestino = 'uploads/' . $fotoNombre; // Ruta de destino para guardar la foto

    // Verificar si se subió una nueva foto
    if (!empty($fotoNombre)) {
        // Mover la foto al directorio de subida
        if (move_uploaded_file($fotoTemp, $fotoDestino)) {
            $_SESSION['jugadores'][$index]['foto'] = $fotoDestino;
        } else {
            // Si ocurre algún error al subir la foto, muestra un mensaje de error
            echo '<p class="text-danger">Error al subir la foto.</p>';
        }
    }

    // Actualizar los datos del jugador en la sesión
    $_SESSION['jugadores'][$index]['nombreJ'] = $nombre; // Actualiza el nombre del jugador
    $_SESSION['jugadores'][$index]['equipoS'] = $equipo;
    $_SESSION['jugadores'][$index]['posicion'] = $posicion;
    $_SESSION['jugadores'][$index]['nacionalidad'] = $_POST['nacionalidad'];
    $_SESSION['jugadores'][$index]['dorsal'] = $_POST["dorsal"];
    $_SESSION['jugadores'][$index]['nacimiento'] = $_POST["fecha"];
    $_SESSION['jugadores'][$index]['apodo'] = $_POST["apodo"];
    $_SESSION['jugadores'][$index]['altura'] = $_POST["altura"];
    $_SESSION['jugadores'][$index]['peso'] = $_POST["peso"];
}

// Filtrar jugadores por equipo si se envía el formulario de filtro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["filtrar"])) {
    $equipo_filtrado = $_POST["equipoFiltro"];
    if ($equipo_filtrado != "todos") {
        $jugadores_filtrados = array_filter($_SESSION['jugadores'], function ($jugador) use ($equipo_filtrado) {
            return $jugador['equipoS'] == $equipo_filtrado;
        });
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Jugadores</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        img {
            max-width: 100px;
            max-height: 80px;
        }

        tr,
        th {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h2 class="mb-4">Lista de Jugadores</h2>
                <!-- Formulario de filtro -->
                <form method="post">
                    <div class="form-group row">
                        <label for="equipoFiltro" class="col-sm-3 col-form-label">Filtrar por equipo:</label>
                        <div class="col-sm-4">
                            <select name="equipoFiltro" id="equipoFiltro" class="form-control">
                                <option value="todos">Todos los equipos</option>
                                <?php foreach ($equipos_disponibles as $equipo) : ?>
                                    <option value="<?= $equipo ?>"><?= $equipo ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" name="filtrar" class="btn btn-primary">Filtrar Jugadores</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Equipo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Dorsal</th>
                    <th scope="col">Posición</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jugadores_filtrados as $index => $jugador) : ?>
                    <tr>
                        <td><?= isset($jugador['equipoS']) && $jugador['equipoS'] !== null ? $jugador['equipoS'] : '' ?></td>
                        <td><?= isset($jugador['nombreJ']) ? $jugador['nombreJ'] : '' ?></td>
                        <td><?= isset($jugador['dorsal']) ? $jugador['dorsal'] : '' ?></td>
                        <td><?= isset($posiciones_completas[$jugador['posicion']]) ? $posiciones_completas[$jugador['posicion']] : '' ?></td>
                        <td><img src="<?= $jugador['foto'] ?>" alt="Foto del jugador" style="max-width: 100px;"></td>
                        <td>
                            <a href="editarJugadores.php?index=<?= $index ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="index" value="<?= $index ?>">
                                <button type="submit" name="eliminar" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este jugador?')"><i class="fas fa-trash"></i></button>
                            </form>
                            <button type="button" class="btn btn-primary" onclick="mostrarFicha('<?= $jugador['nombreJ'] ?>', '<?= $jugador['dorsal']?>', '<?= $jugador['nacionalidad']?>', '<?= $jugador['nacimiento']?>', '<?= $jugador['apodo']?>', '<?= $jugador['altura'].' Mts'?>', '<?= $jugador['peso'].'Kg'?>')"><i class="fas fa-eye"></i> Más información</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Modal de ficha de jugador -->
        <div class="modal fade" id="fichaJugadorModal" tabindex="-1" role="dialog" aria-labelledby="fichaJugadorModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fichaJugadorModalLabel">Información del Jugador</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nombre:</strong> <span id="nombreJu"></span></p>
                        <p><strong>Dorsal:</strong> <span id="dorsalJu"></span></p>
                        <p><strong>Nacionalidad:</strong> <span id="nacionalidadJu"></span></p>
                        <p><strong>Fecha de Nacimiento:</strong> <span id="fechaJu"></span></p>
                        <p><strong>Apodo:</strong> <span id="apodoJu"></span></p>
                        <p><strong>Altura:</strong> <span id="alturaJu"></span></p>
                        <p><strong>Peso:</strong> <span id="pesoJu"></span></p>
                        <!-- Aquí puedes agregar más detalles del jugador si lo deseas -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap y JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
    // Función para mostrar la ficha del jugador
    function mostrarFicha(nombre, dorsal, nacionalidad, fechaNacimiento, apodo, altura, peso) {
        // Asignar los valores a los elementos del modal
        document.getElementById("nombreJu").textContent = nombre;
        document.getElementById("dorsalJu").textContent = dorsal;
        document.getElementById("nacionalidadJu").textContent = nacionalidad;
        document.getElementById("fechaJu").textContent = fechaNacimiento;
        document.getElementById("apodoJu").textContent = apodo;
        document.getElementById("alturaJu").textContent = altura;
        document.getElementById("pesoJu").textContent = peso;

        // Mostrar el modal
        $('#fichaJugadorModal').modal('show');
    }
</script>

</body>

</html>














