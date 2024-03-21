<?php
session_start();
include 'index.php';

if (!isset($_SESSION['equipos'])) {
    $_SESSION['equipos'] = array();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["actualizar"])) {
        $nombreEquipoOriginal = $_POST["equipo_original"];
        $nombreEquipoNuevo = $_POST["nombre"];
        $nombreCompletoLiga = obtenerNombreLiga($_POST["lista"]);
        $imagenNombre = $_FILES["imagen"]["name"];
        $imagenTemp = $_FILES["imagen"]["tmp_name"];

        // Verificar si se ha subido una nueva imagen
        if (!empty($imagenNombre)) {
            $imagenDestino = 'uploads/' . $imagenNombre;

            if (move_uploaded_file($imagenTemp, $imagenDestino)) {
                // Actualizar el equipo con la nueva imagen
                foreach ($_SESSION['equipos'] as &$equipo) {
                    if ($equipo['nombre'] === $nombreEquipoOriginal) {
                        $equipo['nombre'] = $nombreEquipoNuevo;
                        $equipo['liga'] = $nombreCompletoLiga;
                        $equipo['imagen'] = $imagenDestino;
                        break;
                    }
                }
                unset($equipo);
                
            }  
        } else {
            // No se subió una nueva imagen, solo actualizar el nombre y la liga
            foreach ($_SESSION['equipos'] as &$equipo) {
                if ($equipo['nombre'] === $nombreEquipoOriginal) {
                    $equipo['nombre'] = $nombreEquipoNuevo;
                    $equipo['liga'] = $nombreCompletoLiga;
                    break;
                }
            }
            unset($equipo);
             
        }
    } elseif (isset($_POST["eliminar"])) {
        $nombreEquipoEliminar = $_POST["nombreEquipo"];
        foreach ($_SESSION['equipos'] as $key => $equipo) {
            if ($equipo['nombre'] === $nombreEquipoEliminar) {
                unset($_SESSION['equipos'][$key]);
                
                break;
            }
        }
    } elseif (isset($_POST["agregar"])) {
        $nombreEquipo = $_POST["nombre"];
        $nombreCompletoLiga = obtenerNombreLiga($_POST["lista"]);
        $imagenNombre = $_FILES["imagen"]["name"];
        $imagenTemp = $_FILES["imagen"]["tmp_name"];

        if (!empty($imagenNombre)) {
            $imagenDestino = 'uploads/' . $imagenNombre;
            

            if (move_uploaded_file($imagenTemp, $imagenDestino)) {
                $_SESSION['equipos'][] = array(
                    'nombre' => $nombreEquipo,
                    'liga' => $nombreCompletoLiga,
                    'imagen' => $imagenDestino
                );

                
                 
            }  
        } else {
            $_SESSION['equipos'][] = array(
                'nombre' => $nombreEquipo,
                'liga' => $nombreCompletoLiga,
                'imagen' => '' // Opcional: puedes establecer una imagen predeterminada aquí si no se sube ninguna imagen.
            );
            
        }
    }
}

function obtenerNombreLiga($codigoLiga) {
    switch ($codigoLiga) {
        case 'premiere':
            return 'Premier League (Inglaterra-UEFA)';
        case 'serieA':
            return 'Serie A (Italia-UEFA)';
        case 'laliga':
            return 'La Liga (España-UEFA)';
        case 'brasileirao':
            return 'Brasileirao (Brasil-Conmebol)';
        case 'bundesliga':
            return 'Bundesliga (Alemania-UEFA)';
        case 'ligue1':
            return 'Ligue 1 (Francia-UEFA)';
        case 'primeira':
            return 'Primeira Liga (Portugal-UEFA)';
        case 'eredivisie':
            return 'Eredivisie (Países Bajos-UEFA)';
        case 'belgian':
            return 'Belgian Pro League (Bélgica-UEFA)';
        case 'primeraD':
            return 'Primera División (Argentina-Conmebol)';
        default:
            return 'Nombre de liga no encontrado';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<style>
    img{
        max-width: 100px;
        max-height: 80px;
    }

    tr, th{
        text-align: center;
    }
</style>
<body>
     
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h2 class="mb-4">Lista de Equipos</h2>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="filtroEquipos" placeholder="Buscar equipos">
                </div>
            </div>
        </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Liga</th>
                    <th scope="col">Logo de Equipo</th>
                    <th scope="col">Nombre de Equipo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($_SESSION['equipos'] as $equipo) : ?>
                <tr class="equipo">
                    <td><?= $equipo['liga'] ?></td>
                    <td><img src="<?= $equipo['imagen'] ?>" alt="Imagen del equipo" style="max-width: 100px;"></td>
                    <td><?= $equipo['nombre'] ?></td>
                    <td>
                        <a href="agregarJugadores.php?equipo=<?= urlencode($equipo['nombre']) ?>" class="btn btn-primary btn-sm mr-2"><i class="fas fa-user-plus"></i> Agregar Jugadores</a>
                        <a href="editarEquipo.php?equipo=<?= urlencode($equipo['nombre']) ?>" class="btn btn-info btn-sm mr-2"><i class="fas fa-edit"></i> Editar Equipo</a>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este equipo?')">
                            <input type="hidden" name="nombreEquipo" value="<?= $equipo['nombre'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm" name="eliminar"><i class="fas fa-trash-alt"></i> Eliminar Equipo</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('filtroEquipos').addEventListener('keyup', function() {
            var filtro = this.value.toLowerCase();
            var equipos = document.querySelectorAll('.equipo');

            equipos.forEach(function(equipo) {
                var nombreEquipo = equipo.querySelector('td:nth-child(3)').textContent.toLowerCase();

                if (nombreEquipo.includes(filtro)) {
                    equipo.style.display = 'table-row';
                } else {
                    equipo.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>








