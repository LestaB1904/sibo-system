<?php
include("../../db/config.php");

$id_usuario = $_POST['id_usuario'];
$id_herramienta = $_POST['id_herramienta'] ?: "NULL";
$id_repuesto = $_POST['id_repuesto'] ?: "NULL";
$id_maquina = $_POST['id_maquina'] ?: "NULL";

$sql = "INSERT INTO movimientos (ID_Usuario, ID_Herramienta, ID_Repuesto, ID_Maquina)
        VALUES ($id_usuario, $id_herramienta, $id_repuesto, $id_maquina)";

if ($conexion->query($sql)) {
    header("Location: ../../php/movimientos.php");
} else {
    echo "Error al insertar movimiento: " . $conexion->error;
}
?>
