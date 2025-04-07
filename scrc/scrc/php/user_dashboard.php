<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: ../../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario - SIBO</title>
    <link rel="stylesheet" href="../assets/css/cssdeluser.css">
</head>
<body>

<header>
    <h1>SIBO</h1>
    <a href="../../index.php">Atrás</a>
</header>

<nav>
    <ul>
        <li><a href="#" class="active">Panel</a></li>
        <li><a href="#">Herramientas</a></li>
        <li><a href="#">Máquinas</a></li>
        <li><a href="#">Piezas de repuesto</a></li>
        <li><a href="#">Movimientos</a></li>
        <li><span>Prueba de usuario (usuario)</span></li>
    </ul>
</nav>

<main>
    <h2>Panel</h2>

    <section class="cards">
        <div class="card herramientas">
            <h3>Herramientas totales</h3>
            <p>0</p>
        </div>
        <div class="card maquinas">
            <h3>Máquinas totales</h3>
            <p>0</p>
        </div>
        <div class="card repuestos">
            <h3>Piezas de repuesto</h3>
            <p>0</p>
        </div>
        <div class="card usuarios">
            <h3>Usuarios</h3>
            <p>0</p>
        </div>
        <div class="card movimientos">
            <h3>Movimientos recientes</h3>
            <p>0</p>
        </div>
    </section>

    <section class="actividad">
        <h2>Actividad reciente</h2>
        <p>No hay actividad reciente</p>
    </section>
</main>

</body>
</html>
