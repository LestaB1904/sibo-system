<?php
include("../../db/config.php");

$nombre = $_POST['nombre'];
$cedula = $_POST['cedula'];
$telefono = $_POST['telefono'];
$tipo = $_POST['tipo_usuario'];

$sql = "INSERT INTO usuarios (Nombre, Cedula, Telefono, Tipo_Usuario) 
        VALUES ('$nombre', '$cedula', '$telefono', '$tipo')";

if ($conexion->query($sql)) {
    header("Location: ../../php/usuarios.php");
} else {
    echo "Error al insertar usuario: " . $conexion->error;
}
?>
