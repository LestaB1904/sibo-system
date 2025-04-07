<?php
session_start();
include("../db/config.php");

$esAdmin = (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin');

if (!isset($_SESSION['rol'])) {
    header("Location: ../../index.php");
    exit();
}

// Consultas para mostrar
$sql = "SELECT m.*, u.Nombre AS Usuario, h.Nombre_Herramienta, r.Nombre AS Repuesto, ma.Tipo_Maquina
        FROM movimientos m
        LEFT JOIN usuarios u ON m.ID_Usuario = u.ID
        LEFT JOIN herramientas h ON m.ID_Herramienta = h.ID
        LEFT JOIN repuestos r ON m.ID_Repuesto = r.ID
        LEFT JOIN maquinas ma ON m.ID_Maquina = ma.ID
        ORDER BY m.Fecha DESC";
$movs = $conexion->query($sql);

// Datos para formulario
$usuarios = $conexion->query("SELECT * FROM usuarios ORDER BY Nombre ASC");
$herramientas = $conexion->query("SELECT * FROM herramientas ORDER BY Nombre_Herramienta ASC");
$repuestos = $conexion->query("SELECT * FROM repuestos ORDER BY Nombre ASC");
$maquinas = $conexion->query("SELECT * FROM maquinas ORDER BY Tipo_Maquina ASC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Movimientos - SIBO</title>
    <link rel="stylesheet" href="../assets/css/cssdemovimientos.css">
</head>
<body>

<header>
    <h1>Movimientos</h1>
    <a href="<?= $esAdmin ? 'admin_dashboard.php' : 'user_dashboard.php' ?>">Volver</a>
</header>

<main>
    <h2>Historial de asignaciones</h2>

    <?php if ($esAdmin): ?>
    <section class="formulario">
        <form action="../db/movimientos/insertarmovimiento.php" method="POST">
            <select name="id_usuario" required>
                <option value="">Seleccionar Usuario</option>
                <?php while ($u = $usuarios->fetch_assoc()): ?>
                    <option value="<?= $u['ID'] ?>"><?= $u['Nombre'] ?></option>
                <?php endwhile; ?>
            </select>

            <select name="id_herramienta">
                <option value="">Asignar Herramienta</option>
                <?php while ($h = $herramientas->fetch_assoc()): ?>
                    <option value="<?= $h['ID'] ?>"><?= $h['Nombre_Herramienta'] ?></option>
                <?php endwhile; ?>
            </select>

            <select name="id_repuesto">
                <option value="">Asignar Repuesto</option>
                <?php while ($r = $repuestos->fetch_assoc()): ?>
                    <option value="<?= $r['ID'] ?>"><?= $r['Nombre'] ?></option>
                <?php endwhile; ?>
            </select>

            <select name="id_maquina">
                <option value="">Asignar Máquina</option>
                <?php while ($m = $maquinas->fetch_assoc()): ?>
                    <option value="<?= $m['ID'] ?>"><?= $m['Tipo_Maquina'] ?> (<?= $m['Marca'] ?>)</option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Registrar Movimiento</button>
        </form>
    </section>
    <?php endif; ?>

    <section class="tabla">
        <table>
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Herramienta</th>
                    <th>Repuesto</th>
                    <th>Máquina</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $movs->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['Usuario'] ?></td>
                    <td><?= $row['Nombre_Herramienta'] ?? '-' ?></td>
                    <td><?= $row['Repuesto'] ?? '-' ?></td>
                    <td><?= $row['Tipo_Maquina'] ?? '-' ?></td>
                    <td><?= $row['Fecha'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>
</main>

</body>
</html>
