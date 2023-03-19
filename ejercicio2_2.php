<!DOCTYPE html>
<?php
if (isset($_POST['guardar'])) {
    unset($_POST['guardar']);
    if (isset($_COOKIE['pc'])) {
        $pc = unserialize($_COOKIE['pc']);
        array_push($pc, $_POST['memoria'], $_POST['disco']);
        setcookie('pc', serialize($pc), time() + 3600);
    } else if (isset($_COOKIE['impresora'])) {
        $impresora = unserialize($_COOKIE['impresora']);
        array_push($impresora, $_POST['multifuncion'], $_POST['impresion']);
        setcookie('impresora', serialize($impresora), time() + 3600);
    } else {
        header('Location: ./ejercicio2.php');
        die();
    }
    header('Location: ejercicio2_3.php');
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
        <h1>Formulario Inventario</h1>
    </header>
    <form name="inventario" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" target="_self">
        <div>
            <?php
            if (isset($_COOKIE['pc'])) {
                echo "<label for='idMemoria'>Tamaño Memoria</label>";
                echo "<input type='number' name='memoria' id='idMemoria' min='1' step='1'/>";
            } else {
                echo "<label for='idMultifuncion'>Multifunción?</label>";
                echo "<select id='idMultifuncion' name='multifuncion'>";
                echo "<option value='si'>Sí</option>";
                echo "<option value='no'>No</option>";
                echo "</select>";
            }
            ?>
        </div>
        <div>
            <?php
            if (isset($_COOKIE['pc'])) {
                echo "<label for='idDisco'>Tamaño Disco</label>";
                echo "<input type='number' name='disco' id='idDisco' min='1' step='1'/>";
            } else {
                echo "<label for='idImpresion'>Tipo Impresión(Laser, tinta,...)</label>";
                echo "<select id='idImpresion' name='impresion'>";
                echo "<option value='laser'>Laser</option>";
                echo "<option value='tinta'>Tinta</option>";
                echo "</select>";
            }
            ?>
        </div>
        <div>
            <button type="submit" name="guardar" value="ok">Guardar</button>
            <button type="reset" name="borrar" value="ok">Borrar</button>
        </div>
    </form>
</body>

</html>