<!DOCTYPE html>
<?php
require_once './conexion.php';
session_start();
if (isset($_POST['guardar'])) {
    unset($_POST['guardar']);
    // Comprobamos si existe o no el usuario en la BD
    $usuario = $_POST['nombre'];
    $contrasena = hash('sha256', $_POST['contrasena']);
    $rol = $_POST['administrador'];
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
    if ($registro) {
        echo "<p>Usuario no se puede registrar en la BD porque ya está registrado con anterioridad</p>";
        $stmt = null;
        $conexion = null;
        die();
    }
    // El usuario no está registrado en la BD. Luego lo registramos.
    $consulta2 = "INSERT INTO usuarios(usuario,contrasena,rol) VALUES('$usuario','$contrasena',$rol);";
    $stmt = consulta($consulta2);
    try {
        $stmt->execute();
    } catch (Exception $ex3) {
        echo "<p>Error al recuperar los usuarios en la BD</p>";
        $stmt = null;
        $conexion = null;
        die();
    }
    array_push($_SESSION['usuarios'], array($usuario, $_POST['contrasena'], intval($_POST['administrador'])));
}
if (isset($_POST['propiedades'])) {
    header('Location: ./propiedades.php');
    $conexion = null;
    die();
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
        <h1>Formulario Datos Persoais</h1>
    </header>
    <form name="insertar" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" target="_self">
        <div>
            <label for="idNombre">Escriba Nome do usuario</label>
            <input type="text" name="nombre" id="idNombre" />
        </div>
        <div>
            <label for="idContrasena">Escriba Contrasinal</label>
            <input type="password" name="contrasena" id="idContrasena" />
        </div>
        <div>
            <label for="idAdministrador">Administrador?</label>
            <select name="administrador" id="idAdministrador">
                <option value='1'>Sí</option>
                <option value='0'>No</option>
            </select>
        </div>
        <button type="submit" name="guardar" value="ok">Guardar</button>
        <button type="reset" name="borrar">Borrar</button>
        <button type="submit" name="propiedades" value="ok">Propiedades Usuario</button>
    </form>
</body>

</html>