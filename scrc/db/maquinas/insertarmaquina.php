<?php
include("../../db/config.php");

$tipo = $_POST['tipo'];
$marca = $_POST['marca'];

$sql = "INSERT INTO maquinas (Tipo_Maquina, Marca) 
        VALUES ('$tipo', '$marca')";

if ($conexion->query($sql)) {
    header("Location: ../../php/maquinas.php");
} else {
    echo "Error al insertar máquina: " . $conexion->error;
}
?>
