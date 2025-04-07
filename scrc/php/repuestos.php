<?php
session_start();
include("../db/config.php");

$esAdmin = (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin');

if (!isset($_SESSION['rol'])) {
    header("Location: ../../index.php");
    exit();
}

// Obtener repuestos
$sql = "SELECT repuestos.*, maquinas.Tipo_Maquina FROM repuestos
        INNER JOIN maquinas ON repuestos.ID_Maquina = maquinas.ID
        ORDER BY repuestos.ID DESC";
$repuestos = $conexion->query($sql);

// Obtener máquinas (para el formulario)
$maquinas = $conexion->query("SELECT * FROM maquinas ORDER BY Tipo_Maquina ASC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Repuestos - SIBO</title>
    <link rel="stylesheet" href="../assets/css/cssderepuestos.css">
</head>
<body>

<header>
    <h1>Repuestos</h1>
    <a href="<?= $esAdmin ? 'admin_dashboard.php' : 'user_dashboard.php' ?>">Volver</a>
</header>

<main>
    <h2>Listado de repuestos</h2>

    <?php if ($esAdmin): ?>
    <section class="formulario">
        <form action="../db/repuestos/insertarrepuesto.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre del repuesto" required>
            <input type="number" name="cantidad" placeholder="Cantidad" required>
            <select name="id_maquina" required>
                <option value="">Asignar a máquina</option>
                <?php while ($m = $maquinas->fetch_assoc()): ?>
                    <option value="<?= $m['ID'] ?>"><?= $m['Tipo_Maquina'] ?> (<?= $m['Marca'] ?>)</option>
                <?php endwhile; ?>
            </select>
            <button type="submit">Agregar Repuesto</button>
        </form>
    </section>
    <?php endif; ?>

    <section class="tabla">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Máquina Asignada</th>
                    <?php if ($esAdmin): ?><th>Acción</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $repuestos->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['Nombre'] ?></td>
                    <td><?= $row['Cantidad'] ?></td>
                    <td><?= $row['Tipo_Maquina'] ?></td>
                    <?php if ($esAdmin): ?>
                    <td>
                        <form action="../db/repuestos/eliminarrepuesto.php" method="POST" onsubmit="return confirm('¿Eliminar este repuesto?');">
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
