<!DOCTYPE html>
<?php
if (isset($_POST['guardar'])) {
    unset($_POST['guardar']);
    if (isset($_POST['elemento'])) {
        $elemento = $_POST['elemento'];
        if (isset($_POST['inventario'])) {
            $inventario = intval(trim($_POST['inventario']));
            if (!is_nan($inventario)) {
                if ($inventario > 0) {
                    $resultadoElemento = [];
                    array_push($resultadoElemento, $inventario);
                    setcookie($elemento, serialize($resultadoElemento), time() + 3600);
                    header('Location: ejercicio2_2.php');
                    die();
                } else {
                    echo "<p>El valor introducido del inventario no es válido</p>";
                    die();
                }
            } else {
                echo "<p>El valor introducido de inventario no es numérico</p>";
                die();
            }
        } else {
            echo "<p>No existe un número de inventario</p>";
            die();
        }
    } else {
        echo "<p>No existe el elemento</p>";
        die();
    }
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
            <label id="idNumeroInventario">Escriba o Número de Inventario:</label>
            <input type="number" id="idNumeroInventario" name="inventario" min="1" step="1" />
        </div>
        <div>
            <label id="idTipoElemento">Escriba o Número de Inventario:</label>
            <select id="idTipoElemento" name="elemento">
                <option value="pc">PC</option>
                <option value="impresora">Impresora</option>
            </select>
        </div>
        <div>
            <button type="submit" name="guardar" value="ok">Guardar</button>
            <button type="reset" name="borrar" value="ok">Borrar</button>
        </div>
    </form>
</body>

</html>