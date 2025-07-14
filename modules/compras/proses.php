<?php
session_start();
require_once '../../config/database.php';

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
    exit;
}

if ($_GET['act'] == 'insert') {
    if (isset($_POST['Guardar'])) {

        $codigo = intval($_POST['codigo']);
        $id_orden = intval($_POST['codigo_orden']);
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $nro_factura = $_POST['nro_factura'];
        $timbrado = intval($_POST['timbrado']);
        $total_compra = floatval($_POST['total_compra']);
        $intervalo = intval($_POST['intervalo']);
        $cantidad_cuotas = intval($_POST['cantidad_cuotas']);
        $fecha_vto = $_POST['fecha_vto'];
        $condicion = $_POST['condicion_pago'];
        $estado = 'activo';
        $usuario = intval($_SESSION['id_user']);
        $session_id = session_id();

        // Actualizar estado de la orden
        $orden = mysqli_query($mysqli, "UPDATE orden_compra SET estado = 'UTILIZADO' WHERE id_orden=$id_orden")
            or die('Error al actualizar orden: ' . mysqli_error($mysqli));

        // Insertar cabecera
        $query = mysqli_query($mysqli, "
            INSERT INTO compra (
                cod_compra, id_sucursal, fecha, hora, nro_factura, timbrado, total_compra,
                intervalo, cantidad_cuotas, fecha_vto, estado, id_orden, cod_proveedor,
                id_user, condicion
            )
            VALUES (
                $codigo,
                (SELECT id_sucursal FROM orden_compra WHERE id_orden = $id_orden),
                '$fecha', '$hora', '$nro_factura', $timbrado, $total_compra,
                $intervalo, $cantidad_cuotas, '$fecha_vto', '$estado', $id_orden,
                (SELECT cod_proveedor FROM orden_compra WHERE id_orden = $id_orden),
                $usuario, '$condicion'
            )
        ") or die('Error al insertar compra: ' . mysqli_error($mysqli));

        // Variables acumuladoras para IVA
        $total = 0;
        $t_exenta = 0;
        $t_iva5 = 0;
        $t_iva10 = 0;

        $sql = mysqli_query($mysqli, "
            SELECT * FROM ingrediente i
            JOIN tmp t ON i.id_ingrediente = t.cod_ingrediente
            WHERE t.session_id = '$session_id'
        ");

        while ($row = mysqli_fetch_array($sql)) {
            $codigo_producto = intval($row['id_ingrediente']);
            $precio = floatval($row['precio_tmp']);
            $cantidad = intval($row['cantidad_tmp']);
            $iva = intval($row['iva']);

            $subtotal = $precio * $cantidad;
            $total += $subtotal;

            $exenta = $iva5 = $iva10 = 0;

            if ($iva == 0) {
                $exenta = $subtotal;
                $t_exenta += $exenta;
            } elseif ($iva == 10) {
                $iva10 = $subtotal - ($subtotal / 1.1);
                $t_iva10 += $iva10;
            } elseif ($iva == 5) {
                $iva5 = $subtotal - ($subtotal / 1.05);
                $t_iva5 += $iva5;
            }

            mysqli_query($mysqli, "
                INSERT INTO detalle_compra (
                    id_ingrediente, cod_compra, precio, cantidad, iva5, iva10, exenta
                ) VALUES (
                    $codigo_producto, $codigo, $precio, $cantidad, $iva5, $iva10, $exenta
                )
            ") or die('Error en detalle_compra: ' . mysqli_error($mysqli));

            // Stock
            $stock_q = mysqli_query($mysqli, "SELECT cantidad FROM stock WHERE id_ingrediente = $codigo_producto");
            if (mysqli_num_rows($stock_q) == 0) {
                mysqli_query($mysqli, "
                    INSERT INTO stock (id_ingrediente, cantidad, id_sucursal)
                    VALUES ($codigo_producto, $cantidad, (SELECT id_sucursal FROM orden_compra WHERE id_orden = $id_orden))
                ") or die('Error insertando stock: ' . mysqli_error($mysqli));
            } else {
                mysqli_query($mysqli, "
                    UPDATE stock SET cantidad = cantidad + $cantidad
                    WHERE id_ingrediente = $codigo_producto
                ") or die('Error actualizando stock: ' . mysqli_error($mysqli));
            }
        }

        // Insertar en libro de compras (una sola vez)
        mysqli_query($mysqli, "
            INSERT INTO libro_compra (cod_compra, fecha, iva5, iva10, estado)
            VALUES ($codigo, '$fecha', $t_iva5, $t_iva10, 'activo')
        ") or die('Error libro_compra: ' . mysqli_error($mysqli));

        // Insertar en cuentas a pagar (una sola vez)
        mysqli_query($mysqli, "
            INSERT INTO cuentas_a_pagar (cod_compra, monto, fecha_vencimiento, estado, saldo)
            VALUES ($codigo, $total_compra, DATE_ADD(CURDATE(), INTERVAL 30 DAY), 'pendiente', 0)
        ") or die('Error cuentas_a_pagar: ' . mysqli_error($mysqli));

        header("Location: ../../main.php?module=compras&alert=1");
    }

} elseif ($_GET['act'] == 'anular' && isset($_GET['cod_compra'])) {
    $codigo = intval($_GET['cod_compra']);

    mysqli_query($mysqli, "UPDATE compra SET estado='anulado' WHERE cod_compra=$codigo")
        or die('Error anulando compra: ' . mysqli_error($mysqli));

    mysqli_query($mysqli, "UPDATE libro_compra SET estado='anulado' WHERE cod_compra=$codigo")
        or die('Error anulando libro: ' . mysqli_error($mysqli));

    mysqli_query($mysqli, "UPDATE cuentas_a_pagar SET estado='anulado' WHERE cod_compra=$codigo")
        or die('Error anulando cuenta: ' . mysqli_error($mysqli));

    $sql = mysqli_query($mysqli, "SELECT * FROM detalle_compra WHERE cod_compra=$codigo");
    while ($row = mysqli_fetch_array($sql)) {
        $codigo_producto = intval($row['id_ingrediente']);
        $cantidad = intval($row['cantidad']);
        mysqli_query($mysqli, "
            UPDATE stock SET cantidad = cantidad - $cantidad
            WHERE id_ingrediente = $codigo_producto
        ") or die('Error actualizando stock: ' . mysqli_error($mysqli));
    }

    header("Location: ../../main.php?module=compras&alert=2");
}
?>
