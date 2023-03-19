<!DOCTYPE html>
<?php
if (isset($_POST['inicio'])) {
    unset($_POST['inicio']);
    if (isset($_COOKIE['pc'])) {
        setcookie('pc', '', time() - 1);
    } else {
        setcookie('impresora', '', time() - 1);
    }
    header('Location: ./ejercicio2.php');
    die();
}
?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>

<body>
    <header>
        <h1>Formulario Equipamiento</h1>
    </header>
    <form name="equipamiento" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" target="_self">
        <div>
            <?php
            if (isset($_COOKIE['pc'])) {
                $pc = unserialize($_COOKIE['pc']);
                echo "<p>Número de inventario: " . $pc[0] . "</p>";
                echo "<p>Tipo: PC</p>";
                echo "<p>O tamaño de memoria é " . $pc[1] . "MB.</p>";
                echo "<p>O tamaño de disco é " . $pc[2] . "MB.</p>";
            } else {
                $impresora = unserialize($_COOKIE['impresora']);
                echo "<p>Número de inventario: " . $impresora[0] . "</p>";
                echo "<p>Tipo: Impresora</p>";
                echo "<p>Multifunción: " . $impresora[1] . ".</p>";
                echo "<p>O tipo de impresión é " . $impresora[2] . "</p>";
            }
            ?>
        </div>
        <div>
            <button type="submit" name="inicio" value="ok">Inicio</button>
        </div>
    </form>
</body>

</html>