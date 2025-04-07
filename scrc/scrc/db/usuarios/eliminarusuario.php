<?php
include("../../db/config.php");

$id = $_POST['id'];
$sql = "DELETE FROM usuarios WHERE ID = $id";

if ($conexion->query($sql)) {
    header("Location: ../../php/usuarios.php");
} else {
    echo "Error al eliminar usuario: " . $conexion->error;
}
?>
