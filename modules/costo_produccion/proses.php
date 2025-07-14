<?php
session_start();
require_once '../../config/database.php';

if (isset($_POST['Guardar'])) {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $codigo_pedido = $_POST['codigo_pedido'];
    $usuario = $_SESSION['id_user'];
    $estado = 'activo';

    // 1. Obtener id_sucursal del usuario
    $id_sucursal = 0;
    $sql_sucursal = "SELECT id_sucursal FROM usuarios WHERE id_user = ?";
    $stmt_suc = mysqli_prepare($mysqli, $sql_sucursal);
    mysqli_stmt_bind_param($stmt_suc, "i", $usuario);
    mysqli_stmt_execute($stmt_suc);
    mysqli_stmt_bind_result($stmt_suc, $id_sucursal);
    mysqli_stmt_fetch($stmt_suc);
    mysqli_stmt_close($stmt_suc);

    if ($id_sucursal == 0) {
        echo "<div class='alert alert-danger'>No se encontró la sucursal del usuario.</div>";
        exit;
    }

    // 2. Insertar cabecera de costo_produccion
    $query = "INSERT INTO costo_produccion (fecha, hora, estado, id_user, id_sucursal, id_pedido_cliente)
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "sssiii", $fecha, $hora, $estado, $usuario, $id_sucursal, $codigo_pedido);

    if (!mysqli_stmt_execute($stmt)) {
        echo "<div class='alert alert-danger'>Error al guardar cabecera: " . mysqli_error($mysqli) . "</div>";
        exit;
    }

    $id_costo_produccion = mysqli_insert_id($mysqli);
    mysqli_stmt_close($stmt);

    // 3. Insertar detalles
    if (!empty($_POST['producto']) && is_array($_POST['producto'])) {
        foreach ($_POST['producto'] as $id_producto => $cantidad) {
            if ($cantidad > 0) {
                $costo_ing = $_POST['costo_ingredientes'][$id_producto] ?? 0;
                $costo_h = $_POST['costo_hora'][$id_producto] ?? 0;
                $costo_total_prod = $_POST['costo_total'][$id_producto] ?? 0;

                $insert_detalle = "INSERT INTO detalle_costo (id_costo_produccion, id_producto, cantidad, costo_ingredientes, costo_hora, costo_total) 
                                VALUES (?, ?, ?, ?, ?, ?)";
                if ($stmt_detalle = mysqli_prepare($mysqli, $insert_detalle)) {
                    mysqli_stmt_bind_param($stmt_detalle, "iiiddd", $pedido_id, $id_producto, $cantidad, $costo_ing, $costo_h, $costo_total_prod);
                    mysqli_stmt_execute($stmt_detalle);
                    mysqli_stmt_close($stmt_detalle);
                }
            } 
        }

        // 4. Calcular costos solo una vez por pedido

        // Costo ingredientes
        $sql_ingredientes = "SELECT 
                                SUM(ri.cantidad * i.precio * dp.cantidad) AS costo_ingredientes
                             FROM detalle_pedido_cliente dp
                             LEFT JOIN receta r ON dp.id_producto = r.id_producto
                             LEFT JOIN detalle_receta ri ON r.id_receta = ri.id_receta
                             LEFT JOIN ingrediente i ON ri.id_ingrediente = i.id_ingrediente
                             WHERE dp.id_pedido_cliente = ?";
        $stmt_ingredientes = mysqli_prepare($mysqli, $sql_ingredientes);
        mysqli_stmt_bind_param($stmt_ingredientes, "i", $codigo_pedido);
        mysqli_stmt_execute($stmt_ingredientes);
        $result_ingredientes = mysqli_stmt_get_result($stmt_ingredientes);
        $row_ingredientes = mysqli_fetch_assoc($result_ingredientes);
        $total_costo_ingredientes = $row_ingredientes['costo_ingredientes'] ?? 0;
        mysqli_stmt_close($stmt_ingredientes);

        // Costo horas
        $sql_horas = "SELECT 
                        SUM(TIMESTAMPDIFF(MINUTE, d.hora_ini, d.hora_fin) * ch.costo_hora) / 60 AS costo_hora
                     FROM detalle_pedido_cliente dp
                     LEFT JOIN orden_produccion op ON dp.id_pedido_cliente = op.id_pedido_cliente
                     LEFT JOIN detalle_etapa_produccion d ON dp.id_producto = d.id_producto
                     LEFT JOIN empleados e ON d.id_empleado = e.id_empleados
                     LEFT JOIN costo_hora ch ON e.id_empleados = ch.id_empleados
                     WHERE dp.id_pedido_cliente = ?";
        $stmt_horas = mysqli_prepare($mysqli, $sql_horas);
        mysqli_stmt_bind_param($stmt_horas, "i", $codigo_pedido);
        mysqli_stmt_execute($stmt_horas);
        $result_horas = mysqli_stmt_get_result($stmt_horas);
        $row_horas = mysqli_fetch_assoc($result_horas);
        $total_costo_hora = $row_horas['costo_hora'] ?? 0;
        mysqli_stmt_close($stmt_horas);

        $costo_total = $total_costo_ingredientes + $total_costo_hora;
                    
        $query_update = mysqli_query($mysqli, "UPDATE pedido_cliente SET estado = 'Costeado' "
        . "WHERE id_pedido_cliente =" .$_GET['codigo_pedido_hidden'])
        or die('Error'.mysqli_error($mysqli));

    } else {
        echo "<div class='alert alert-warning'>No se han seleccionado productos.</div>";
        exit;
    }

    mysqli_close($mysqli);
    header("Location: ../../main.php?module=costo_produccion&alert=1");
    exit;
}
?>
