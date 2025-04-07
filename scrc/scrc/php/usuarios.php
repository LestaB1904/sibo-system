<?php
session_start();
include("../db/config.php");

$esAdmin = (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin');

if (!isset($_SESSION['rol'])) {
    header("Location: ../../index.php");
    exit();
}

// Obtener todos los usuarios
$sql = "SELECT * FROM usuarios ORDER BY ID DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios - SIBO</title>
    <link rel="stylesheet" href="../assets/css/cssdeusuarios.css">
</head>
<body>

<header>
    <h1>Usuarios - SIBO</h1>
    <a href="<?= $esAdmin ? 'admin_dashboard.php' : 'user_dashboard.php' ?>">Volver</a>
</header>

<main>
    <h2>Lista de Usuarios</h2>

    <?php if ($esAdmin): ?>
    <section class="formulario">
        <form action="../db/usuarios/insertarusuario.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre completo" required>
            <input type="number" name="cedula" placeholder="Cédula" required>
            <input type="number" name="telefono" placeholder="Teléfono">
            <select name="tipo_usuario" required>
                <option value="">Tipo de Usuario</option>
                <option value="admin">Administrador</option>
                <option value="usuario">Usuario</option>
            </select>
            <button type="submit">Agregar Usuario</button>
        </form>
    </section>
    <?php endif; ?>

    <section class="tabla">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cédula</th>
                    <th>Teléfono</th>
                    <th>Tipo</th>
                    <?php if ($esAdmin): ?><th>Acción</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['Nombre'] ?></td>
                    <td><?= $row['Cedula'] ?></td>
                    <td><?= $row['Telefono'] ?></td>
                    <td><?= ucfirst($row['Tipo_Usuario']) ?></td>
                    <?php if ($esAdmin): ?>
                    <td>
                        <form action="../db/usuarios/eliminarusuario.php" method="POST" onsubmit="return confirm('¿Eliminar este usuario?');">
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
