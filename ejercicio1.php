<!DOCTYPE html>
<?php
require_once './conexion.php';
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic Realm="Acceso Restringido"');
    header('HTTP/1.0 401 Unathorized');
    echo "<p>Acceso no autorizado</p>";
    $conexion = null;
    die();
}
if (isset($_POST['nuevo'])) {
    $conexion = null;
    header('Location: ./nuevo.php');
    die();
}
if (isset($_POST['propiedades'])) {
    $conexion = null;
    header('Location: ./propiedades.php');
    die();
}
if (isset($_POST['desconexión'])) {
    $conexion = null;
    session_destroy();
    die();
}
// Veamos si el usuario está en la BD
$usuario = $_SERVER['PHP_AUTH_USER'];
$contrasena = hash('sha256', $_SERVER['PHP_AUTH_PW']);
$consulta = "SELECT * FROM usuarios WHERE usuario=:u AND contrasena=:p;";
$stmt = consulta($consulta);
$stmt->bindParam(':u', $usuario, PDO::PARAM_STR);
$stmt->bindParam(':p', $contrasena, PDO::PARAM_STR);
try {
    $stmt->execute();
} catch (Exception $ex3) {
    echo "<p>Error al recuperar los usuarios en la BD</p>";
    $stmt = null;
    $conexion = null;
    die();
}
$registro = $stmt->fetch(PDO::FETCH_BOTH);
if (!$registro) {
    echo "<p>Usuario no registrado en la BD</p>";
    $stmt = null;
    $conexion = null;
    die();
}
session_start();
if (!isset($_SESSION['usuarios'])) {
    $_SESSION['usuarios'] = array();
    array_push($_SESSION['usuarios'], array($registro['usuario'], $registro['contrasena'], $registro['rol']));
} else {
    array_push($_SESSION['usuarios'], array($registro['usuario'], $registro['contrasena'], $registro['rol']));
}
?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <header>
        <h1>Xestión de Usuarios</h1>
    </header>
    <form name="gestion" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" target="_self">
        <button type="submit" name="nuevo" value="ok">Novo Usuario</button>
        <button type="submit" name="propiedades" value="ok">Propiedades Usuario</button>
        <button type="submit" name="Desconexion" value="ok">Desconexión</button>
    </form>
</body>

</html>