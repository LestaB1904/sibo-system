<?php
include("../../db/config.php");

$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$id_maquina = $_POST['id_maquina'];

$sql = "INSERT INTO repuestos (Nombre, Cantidad, ID_Maquina) 
        VALUES ('$nombre', '$cantidad', '$id_maquina')";

if ($conexion->query($sql)) {
    header("Location: ../../php/repuestos.php");
} else {
    echo "Error al insertar repuesto: " . $conexion->error;
}
?>
