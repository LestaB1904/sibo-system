<?php
session_start();
include("../db/config.php");

$esAdmin = (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin');

if (!isset($_SESSION['rol'])) {
    header("Location: ../../index.php");
    exit();
}

$sql = "SELECT * FROM maquinas ORDER BY ID DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Máquinas - SIBO</title>
    <link rel="stylesheet" href="../assets/css/cssdemaquinas.css">
</head>
<body>

<header>
    <h1>Máquinas</h1>
    <a href="<?= $esAdmin ? 'admin_dashboard.php' : 'user_dashboard.php' ?>">Volver</a>
</header>

<main>
    <h2>Listado de máquinas</h2>

    <?php if ($esAdmin): ?>
    <section class="formulario">
        <form action="../db/maquinas/insertarmaquina.php" method="POST">
            <input type="text" name="tipo" placeholder="Tipo de máquina" required>
            <input type="text" name="marca" placeholder="Marca" required>
            <button type="submit">Agregar Máquina</button>
        </form>
    </section>
    <?php endif; ?>

    <section class="tabla">
        <table>
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <?php if ($esAdmin): ?><th>Acción</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['Tipo_Maquina'] ?></td>
                    <td><?= $row['Marca'] ?></td>
                    <?php if ($esAdmin): ?>
                    <td>
                        <form action="../db/maquinas/eliminarmaquina.php" method="POST" onsubmit="return confirm('¿Eliminar esta máquina?');">
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
