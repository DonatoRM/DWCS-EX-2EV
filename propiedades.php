<!DOCTYPE html>
<?php
session_start();
if (isset($_POST['nuevo'])) {
    header('Location: ./nuevo.php');
    die();
}
if (isset($_POST['desconexion'])) {
    session_destroy();
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
    <main>
        <section>
            <?php
            $numero = count($_SESSION['usuarios']) - 1;
            $nombre = $_SESSION['usuarios'][$numero][0];
            $contrasena = $_SESSION['usuarios'][$numero][1];
            $rol = $_SESSION['usuarios'][$numero][2];
            echo "<p>Nome de usuario: $nombre</p>";
            echo "<p>Password: $contrasena</p>";
            if ($rol) {
                $respuesta = 'Administrador';
            } else {
                $respuesta = 'No Administrador';
            }
            echo "<p>Rol: $respuesta</p>";
            ?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
                <button type="submit" name="nuevo" value="ok">Novo Usuario</button>
                <button type="submit" name="desconexion" value="ok">Desconexion</button>
            </form>
        </section>
    </main>
</body>

</html>