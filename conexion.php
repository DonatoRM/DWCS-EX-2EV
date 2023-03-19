<?php
$host = 'localhost';
$user = 'admin';
$pass = 'admin';
$db = 'ejercicio1';
$port = 3307;
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;port=$port;charset=$charset";
try {
    $conexion = new PDO($dsn, $user, $pass);
} catch (Exception $ex1) {
    echo "<p>Error al conectar con la BD</p>";
    $conexion = null;
    die();
}
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
function consulta($consulta)
{
    global $conexion;
    try {
        $stmt = $conexion->prepare($consulta);
    } catch (Exception $ex2) {
        echo "<p>La sentencia SQL no es correcta</p>";
        $stmt = null;
        $conexion = null;
        die();
    }
    return $stmt;
}
