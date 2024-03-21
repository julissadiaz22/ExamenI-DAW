<?php 
    if (session_status() === PHP_SESSION_NONE) {
        
        session_start();
        
    
        
    }

?>
<!DOCTYPE html>
 

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen 1 DAW</title>
    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        .navbar-brand {
            font-size: 36px; 
            margin-right: 20px; 
        }
        .navbar-nav {
            margin-left: 0; 
        }
        .nav-link {
            color: #000; 
            margin-right: 15px; 
            font-weight: bold;
        }
        .sesiones-btn {
            margin-left: 20px; 
        }
        .sesiones-btn:focus {
            outline: none; 
        }
        .title-container {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: darkblue;
            color: white;
        }
        /* Estilo para el enlace "HOME" */
        .nav-item-home .nav-link {
            color: #000;
            font-weight: bold;
        }

        

         
       

    </style>
</head>
<body>
  
    <div class="title-container">
        <h1 class="navbar-brand">Examen 1 DAW</h1>
    </div>
 
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                   
                    <li class="nav-item nav-item-home">
                        <a href="principal.php" class="nav-link">INICIO</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            EJERCICIO 1
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                            <li><a class="dropdown-item" href="#">Agregar Usuario</a></li>
                            <li><a class="dropdown-item" href="#">Lista de Usuarios</a></li>
                         
                         
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            EJERCICIO 2
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                            <li><a class="dropdown-item" href="agregarEquipo.php">Agregar Equipo</a></li>
                            <li><a class="dropdown-item" href="equipoAgregado.php">Equipos Agregados</a></li>
                            <li><a class="dropdown-item" href="jugadoresAgregados.php">Jugadores Agregados</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            
            <button class="btn btn-primary sesiones-btn" onclick="mostrarModal()">Ver Sesiones</button>
        </div>
    </nav>

 
    <div class="container mt-4">
         
    </div>

    
    <div class="modal fade" id="sesionesModal" tabindex="-1" aria-labelledby="sesionesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sesionesModalLabel">Sesiones del Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <?php
                    
                    if (!isset($_SESSION['pagina_anterior']) || $_SESSION['pagina_anterior'] !== $_SERVER['PHP_SELF']) {
                        $_SESSION['pagina_anterior'] = $_SERVER['PHP_SELF'];
                        if (!isset($_SESSION['contador'])) {
                            $_SESSION['contador'] = 1;
                        } else {
                            $_SESSION['contador']++;
                        }
                    }
                    echo 'Visitas al sitio: ' . $_SESSION['contador'];
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
   
        function mostrarModal() {
            var myModal = new bootstrap.Modal(document.getElementById('sesionesModal'));
            myModal.show();
        }
    </script>

 
     
</body>
 
</html>







