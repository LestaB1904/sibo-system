<?php
include("../../db/config.php");

$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];

$sql = "INSERT INTO herramientas (Nombre_Herramienta, Cantidad) 
        VALUES ('$nombre', '$cantidad')";

if ($conexion->query($sql)) {
    header("Location: ../../php/herramientas.php");
} else {
    echo "Error al insertar herramienta: " . $conexion->error;
}
?>
