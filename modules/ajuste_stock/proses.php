<?php
session_start();
require_once '../../config/database.php';

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
    exit;
}

if ($_GET['act'] == 'insert') {
    if (isset($_POST['Guardar'])) {
        $id_ajuste = intval($_POST['codigo']); // ID generado en el formulario con i++
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $tipo_ajuste = $_POST['tipo_ajuste'];
        $estado = 'pendiente';
        $usuario = intval($_SESSION['id_user']);
        $sessionId = session_id();

        // Verificar si el ID ya existe
        $verificar = $mysqli->prepare("SELECT id_ajuste FROM ajuste_stock WHERE id_ajuste = ?");
        $verificar->bind_param('i', $id_ajuste);
        $verificar->execute();
        $verificar->store_result();

        if ($verificar->num_rows > 0) {
            die("Error: El ID de ajuste ya existe. Refresque el formulario e intente nuevamente.");
        }

        // Insertar cabecera
        $insert_ajuste = $mysqli->prepare("
            INSERT INTO ajuste_stock (id_ajuste, fecha, hora, id_user, tipo_ajuste, estado, id_sucursal)
            VALUES (?, ?, ?, ?, ?, ?, (SELECT id_sucursal FROM usuarios WHERE id_user = ?))
        ");
        $insert_ajuste->bind_param('isssssi', $id_ajuste, $fecha, $hora, $usuario, $tipo_ajuste, $estado, $usuario);
        if (!$insert_ajuste->execute()) {
            die("Error al insertar cabecera: " . $insert_ajuste->error);
        }

        // Obtener detalles desde tmp_stock
        $sql = $mysqli->prepare("
            SELECT cod_ingrediente, cantidad_tmp, id_motivo 
            FROM tmp
            WHERE session_id = ?
        ");
        $sql->bind_param('s', $sessionId);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows == 0) {
            die("Error: No se encontraron productos para procesar.");
        }

        while ($row = $result->fetch_assoc()) {
            $codigo_producto = intval($row['cod_ingrediente']);
            $cantidad = intval($row['cantidad_tmp']);
            $id_motivo = intval($row['id_motivo']);

            // Insertar detalle
            $insert_detalle = $mysqli->prepare("
                INSERT INTO detalle_ajuste_stock (id_ajuste, id_ingrediente, cantidad, id_motivo)
                VALUES (?, ?, ?, ?)
            ");
            $insert_detalle->bind_param('iiii', $id_ajuste, $codigo_producto, $cantidad, $id_motivo);
            $insert_detalle->execute();

            // Actualizar stock
            $query_stock = $mysqli->prepare("SELECT cantidad FROM stock WHERE id_ingrediente = ?");
            $query_stock->bind_param('i', $codigo_producto);
            $query_stock->execute();
            $result_stock = $query_stock->get_result();

            if ($result_stock->num_rows == 0) {
                $insertar_stock = $mysqli->prepare("INSERT INTO stock (id_ingrediente, cantidad) VALUES (?, ?)");
                $insertar_stock->bind_param('ii', $codigo_producto, $cantidad);
                $insertar_stock->execute();
            } else {
                $sql_update = ($tipo_ajuste == 'Agregar') ?
                    "UPDATE stock SET cantidad = cantidad + ? WHERE id_ingrediente = ?" :
                    "UPDATE stock SET cantidad = cantidad - ? WHERE id_ingrediente = ?";
                $actualizar_stock = $mysqli->prepare($sql_update);
                $actualizar_stock->bind_param('ii', $cantidad, $codigo_producto);
                $actualizar_stock->execute();
            }
        }

        $delete = mysqli_query($mysqli, "DELETE FROM tmp WHERE session_id = '".session_id()."'")
            or die('Error al eliminar TMP: ' . mysqli_error($mysqli));
        header("Location: ../../main.php?module=ajuste_stock&alert=1");
        exit;
    }
}

// ANULAR AJUSTE
elseif ($_GET['act'] == 'anular') {
    if (isset($_GET['id_ajuste'])) {
        $id_ajuste = intval($_GET['id_ajuste']);

        $sql_detalle = $mysqli->prepare("
            SELECT da.id_ingrediente, da.cantidad, a.tipo_ajuste
            FROM detalle_ajuste_stock da
            JOIN ajuste_stock a ON da.id_ajuste = a.id_ajuste
            WHERE da.id_ajuste = ?
        ");
        $sql_detalle->bind_param('i', $id_ajuste);
        $sql_detalle->execute();
        $result_detalle = $sql_detalle->get_result();

        if ($result_detalle->num_rows == 0) {
            die("Error: No se encontraron detalles para este ajuste.");
        }

        while ($row = $result_detalle->fetch_assoc()) {
            $codigo_producto = intval($row['id_ingrediente']);
            $cantidad = intval($row['cantidad']);
            $tipo_ajuste = $row['tipo_ajuste'];

            $sql_update = ($tipo_ajuste == 'Agregar') ?
                "UPDATE stock SET cantidad = cantidad - ? WHERE id_ingrediente = ?" :
                "UPDATE stock SET cantidad = cantidad + ? WHERE id_ingrediente = ?";
            $update_stock = $mysqli->prepare($sql_update);
            $update_stock->bind_param('ii', $cantidad, $codigo_producto);
            $update_stock->execute();
        }

        $update_ajuste = $mysqli->prepare("UPDATE ajuste_stock SET estado = 'anulado' WHERE id_ajuste = ?");
        $update_ajuste->bind_param('i', $id_ajuste);
        $update_ajuste->execute();

        header("Location: ../../main.php?module=ajuste_stock&alert=2");
        exit;
    }
}
?>
