<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "sibo");

// Verificación de errores
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
