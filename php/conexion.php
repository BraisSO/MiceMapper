<?php
// Conexion a la base de datos con el usuario por defecto de XAMPP
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

// Revisión de la conexion
if ($conn->connect_error) {
    die("Fallo de conexión: " . $conn->connect_error);
}