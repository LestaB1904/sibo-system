<?php
session_start();
include("../db/config.php");

$esAdmin = (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin');

if (!isset($_SESSION['rol'])) {
    header("Location: ../../index.php");
    exit();
}

$sql = "SELECT * FROM herramientas ORDER BY ID DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Herramientas - SIBO</title>
    <link rel="stylesheet" href="../assets/css/cssdeherramientas.css">
</head>
<body>

<header>
    <h1>Herramientas</h1>
    <a href="<?= $esAdmin ? 'admin_dashboard.php' : 'user_dashboard.php' ?>">Volver</a>
</header>

<main>
    <h2>Listado de herramientas</h2>

    <?php if ($esAdmin): ?>
    <section class="formulario">
        <form action="../db/herramientas/insertarherramienta.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre de la herramienta" required>
            <input type="number" name="cantidad" placeholder="Cantidad" required>
            <button type="submit">Agregar Herramienta</button>
        </form>
    </section>
    <?php endif; ?>

    <section class="tabla">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <?php if ($esAdmin): ?><th>Acción</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['Nombre_Herramienta'] ?></td>
                    <td><?= $row['Cantidad'] ?></td>
                    <?php if ($esAdmin): ?>
                    <td>
                        <form action="../db/herramientas/eliminarherramienta.php" method="POST" onsubmit="return confirm('¿Eliminar esta herramienta?');">
                            <input type="hidden" name="id" value="<?= $row['ID'] ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>
</main>

</body>
</html>
