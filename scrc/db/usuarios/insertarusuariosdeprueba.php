<?php
include("../../db/config.php");

// Verificar si ya existen los usuarios de prueba
$verificar = $conexion->query("SELECT * FROM usuarios WHERE Cedula IN (111, 222)");

if ($verificar->num_rows > 0) {
    echo "⚠️ Los usuarios de prueba ya existen en la base de datos.";
} else {
    $sql = "INSERT INTO usuarios (Nombre, Cedula, Telefono, Tipo_Usuario) VALUES 
            ('Admin de prueba', 111, 88888888, 'admin'),
            ('Usuario de prueba', 222, 77777777, 'usuario')";

    if ($conexion->query($sql)) {
        echo "✅ Usuarios de prueba agregados correctamente:<br>";
        echo "<ul>
                <li><strong>Admin:</strong> Cédula: 111 - Tipo: admin</li>
                <li><strong>Usuario:</strong> Cédula: 222 - Tipo: usuario</li>
              </ul>";
    } else {
        echo "❌ Error al insertar usuarios: " . $conexion->error;
    }
}
?>
