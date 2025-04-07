<?php
session_start();
include("../proyecto/scrc/db/config.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'];
    $tipo = $_POST['tipo_usuario'];

    $sql = "SELECT * FROM usuarios WHERE Cedula = ? AND Tipo_Usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("is", $cedula, $tipo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        $_SESSION['usuario'] = $usuario['Nombre'];
        $_SESSION['rol'] = $usuario['Tipo_Usuario'];

        // ✅ RUTAS RELATIVAS CORREGIDAS
        if ($usuario['Tipo_Usuario'] === 'admin') {
            header("Location: ../../../proyecto/scrc/php/admin_dashboard.php");
        } else {
            header("Location: ../../../proyecto/scrc/php/user_dashboard.php");
        }
        exit();
    } else {
        $mensaje = "Credenciales incorrectas.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingreso - SIBO</title>
    <link rel="stylesheet" href="../proyecto/scrc/assets/css/cssdelindex.css">
</head>
<body>

<div class="login-box">
    <h2>Ingreso a SIBO</h2>

    <?php if ($mensaje): ?>
        <p class="error"><?= $mensaje ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="cedula">Cédula</label>
        <input type="number" name="cedula" placeholder="Ingrese su cédula" required>

        <label for="tipo_usuario">Tipo de Usuario</label>
        <select name="tipo_usuario" required>
            <option value="usuario">Usuario regular</option>
            <option value="admin">Administrador</option>
        </select>

        <button type="submit">Ingresar</button>
    </form>
</div>

</body>
</html>
