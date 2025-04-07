<?php
include("../../db/config.php");

$id = $_POST['id'];
$sql = "DELETE FROM maquinas WHERE ID = $id";

if ($conexion->query($sql)) {
    header("Location: ../../php/maquinas.php");
} else {
    echo "Error al eliminar máquina: " . $conexion->error;
}
?>
