<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../../index.php");
    exit();
}
include("../db/config.php");

$herramientas = $conexion->query("SELECT COUNT(*) AS total FROM herramientas")->fetch_assoc()['total'];
$maquinas     = $conexion->query("SELECT COUNT(*) AS total FROM maquinas")->fetch_assoc()['total'];
$repuestos    = $conexion->query("SELECT COUNT(*) AS total FROM repuestos")->fetch_assoc()['total'];
$usuarios     = $conexion->query("SELECT COUNT(*) AS total FROM usuarios")->fetch_assoc()['total'];
$movimientos  = $conexion->query("SELECT COUNT(*) AS total FROM movimientos")->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador - SIBO</title>
    <link rel="stylesheet" href="../assets/css/cssdeladmin.css">
</head>
<body>

<header>
    <h1>SIBO</h1>
    <a href="../../index.php">Atrás</a>
</header>

<nav>
    <ul>
        <li><a href="admin_dashboard.php" class="active">Panel</a></li>
        <li><a href="herramientas.php">Herramientas</a></li>
        <li><a href="maquinas.php">Máquinas</a></li>
        <li><a href="repuestos.php">Piezas de repuesto</a></li>
        <li><a href="usuarios.php">Usuarios</a></li>
        <li><a href="movimientos.php">Movimientos</a></li>
        <li><span>Admin (<?php echo $_SESSION['usuario']; ?>)</span></li>
    </ul>
</nav>

<main>

    <section class="cards">
    <a class="card herramientas" href="herramientas.php">
        <h3>Herramientas totales</h3>
        <p><?= $herramientas ?></p>
    </a>
    <a class="card maquinas" href="maquinas.php">
        <h3>Máquinas totales</h3>
        <p><?= $maquinas ?></p>
    </a>
    <a class="card repuestos" href="repuestos.php">
        <h3>Piezas de repuesto</h3>
        <p><?= $repuestos ?></p>
    </a>
    <a class="card usuarios" href="usuarios.php">
        <h3>Usuarios</h3>
        <p><?= $usuarios ?></p>
    </a>
    <a class="card movimientos" href="movimientos.php">
        <h3>Movimientos recientes</h3>
        <p><?= $movimientos ?></p>
    </a>
</section>

</main>

</body>
</html>

