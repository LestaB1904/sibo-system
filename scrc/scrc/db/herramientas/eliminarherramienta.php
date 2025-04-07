<?php
include("../../db/config.php");

$id = $_POST['id'];
$sql = "DELETE FROM herramientas WHERE ID = $id";

if ($conexion->query($sql)) {
    header("Location: ../../php/herramientas.php");
} else {
    echo "Error al eliminar herramienta: " . $conexion->error;
}
?>
